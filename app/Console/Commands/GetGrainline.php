<?php

namespace App\Console\Commands;

use App\Company;
use App\Pattern;
use App\Scraper;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Console\Command;
use QueryPath;

class GetGrainline extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:grainline';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrape patterns from Grainline Studio';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        /*
        $this->info("Inserting company into db.");
        $company = ['id' => '2', 'name' => 'Grainline'];
        $dbCompany = Company::findOrNew($company['id']);
        $dbCompany->fill($company)->save();
        //$company_id = $dbCompany->id;

        */

        try {
            $client = new Client();
            $res = $client->request('GET', "https://grainlinestudio.com/shop/");
            $this->grainlineScraper($res->getBody()->getContents());
            $statusCode = $res->getStatusCode();
        } catch (RequestException $e) {
            $statusCode = $e->getResponse()->getStatusCode();
        }
        $this->info("DONE");
    }

    function grainlineScraper($response)
    {
        $this->info("Scraping Grainline pattern shop...");

        $this->info("Scraping names...");
        $names = [];
        $queryPath = QueryPath::withHTML($response);
        foreach ($queryPath->find('.product-title-link') as $name) {
            $name = $name->text();
            /*
             * the below code was to remove pattern duplicates, i.e. the same pattern in PDF and Paper format
             * Turns out it will probably be easier to remove each version of the same product
             *  after the final array is constructed, and we have the links paired with the correct name etc.
             *
             * */
            //$name = stristr($name,' – ', true);
            //$name = trim($name);

            /* Adds all product to array, except gift certificate
             * */
            if (stristr($name, 'gift') === false) {
                if (stristr($name, 'Pattern', true) !== false) {
                    $name = stristr($name, 'Pattern', true);
                }
                if (stristr($name, 'Download', true) !== false) {
                    $name = stristr($name, 'Download', true);
                }
                $name = trim($name);
                $names[] = $name;
            }
        }
        //$names = array_unique(array_filter($names));

        $this->info("Scraping prices...");
        $prices = [];
        foreach ($queryPath->find('.price') as $price) {
            $price = $price->text();
            $prices[] = $price;
        }

        $this->info("Scraping redirect URLs...");
        $urls = [];
        foreach ($queryPath->find('.product_thumbnail a') as $product) {
            $red_url = $product->attr('href');
            if (stristr($red_url, 'gift') === false) {
                $urls[] = $red_url;
            }
        }

        //This works, except for item with index 8, which is empty for a reason that I don't understand.
        $this->info("Scraping company product ID...");
        $ids = [];
        foreach ($queryPath->find('.ajax_add_to_cart') as $product) {
            $id = $product->attr('data-product_id');
            if (stristr($id, '21321') === false) {
                $id = "2-" . $id; // Adds company ID in front of company pattern ID
                $ids[] = $id;
            }
        }

        $this->info("Scraping images...");
        $images = [];
        foreach ($queryPath->find('.size-shop_catalog') as $image) {
            $img_url = $image->attr('src');
            if (stristr($img_url, 'gift') === false) {
                $images[] = $img_url;
            }
        }

        $this->info("Restructuring patterns & fetching info on individual product pages...");
        $patterns = [];
        foreach ($names as $key => $value) {
            $this->info("Now processing product ===============> " . strtoupper($value));
            $price = $prices[$key];
            $response = $urls[$key];
            $image = $images[$key];
            $pattern_id = $ids[$key];

            $subQueryPath = QueryPath::withHTML($response);

            $this->info("Scraping description...");
            $description = trim($subQueryPath->find('.woocommerce-product-details__short-description')->text());

            $this->info("Scraping supplies...");
            $supplies = trim($subQueryPath->find('#tab-description')->text());

            $this->info("Reading format...");
            if (stristr($value, 'pdf') === false) {
                $format = "3";
            } else {
                $format = "2";
            }

            $this->info("Adding language...");
            $language = "English";

            /*
             * Ask Marcus:
             *  Problem with characters for patterns with name
             *  LAHJA DRESSING GOWN ? WOMEN´S / LAHJA DRESSING GOWN - WOMEN´S
             *  LAHJA DRESSING GOWN ? MEN´S / LAHJA DRESSING GOWN - MEN´S
             *
             *
                        $this->info("Reading category...");
                        // lastWord() function moved to scraper class, so call it like so Scraper::lastWord instead !!!!!!
                        $category = lastWord($value->textContent);
                        $category = strtolower($category);
                        $category = ['name' => $category];
                        $this->info("Inserting category into db.");
                        $dbCategory = Category::findOrNew($category['name']);
                        $dbCategory->fill($category)->save();
                        //$category_id = $dbCategory->id;
            */

            $patterns[$key] = [
                'name' => $value,
                'price' => $price,
                //'category_id' => $category_id,
                'company_id' => '1', // change this later on
                'redirect_url' => $response,
                'image_url' => $image,
                'company_pattern_id' => $pattern_id,
                'description' => $description,
                'supplies' => $supplies,
                'format' => $format,
                'language' => $language,
            ];
        }

        $this->info("Looping for insert...");
        foreach ($patterns as $pattern) {
            $this->info("Inserting/updating: " . $pattern['name']);
            // is findOrNew the best method here??
            $dbPattern = Pattern::findOrNew($pattern['name']);
            $dbPattern->fill($pattern)->save();
        }
    }
}
