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
        $this->info("Inserting company into db.");
        $company = ['id' => '2', 'company_name' => 'Grainline Studio'];
        $dbCompany = Company::findOrNew($company['id']);
        $dbCompany->fill($company)->save();

        try {
            $client = new Client();
            $res = $client->request('GET', "https://grainlinestudio.com/shop/");
            $this->grainlineScraper($res->getBody()->getContents());
        } catch (RequestException $e) {
            return $e;
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

            /* Adds all product to array, except gift certificate
             * */
            if (stristr($name, 'gift') === false) {
                /* Remove generic words "Pattern" and "Download" from end of pattern names
                * */
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

        $this->info("Scraping company product ID...");
        $ids = [];
        foreach ($queryPath->find('.ajax_add_to_cart') as $product) {
            $id = $product->attr('data-product_id');
            // Check for product ID 21321, giftcard
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
            $format = Scraper::readFormat($value, 'PDF', 'Paper');

            $patterns[$key] = [
                'name' => $value,
                'price' => $price,
                'company_id' => '2',
                'redirect_url' => $response,
                'image_url' => $image,
                'company_pattern_id' => $pattern_id,
                'description' => $description,
                'supplies' => $supplies,
                'format' => $format,
                'language' => "English",
            ];
        }

        $this->info("Looping for insert...");
        foreach ($patterns as $pattern) {
            $this->info("Inserting/updating: " . $pattern['name']);
            $dbPattern = Pattern::findOrNew($pattern['name']);
            $dbPattern->fill($pattern)->save();
        }
    }
}
