<?php

namespace App\Console\Commands;

use App\Category;
use App\Company;
use App\Pattern;
use App\Scraper;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Console\Command;
use QueryPath;

// !!!!!WARNING!!!!
//the below can be removed when done coding. This is to see the full content of long strings for debugging purposes
ini_set("xdebug.var_display_max_children", -1);
ini_set("xdebug.var_display_max_data", -1);
ini_set("xdebug.var_display_max_depth", -1);

class GetNamed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:named';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetches contents of Named Clothing pattern shop.';

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
        $company = ['id' => '1', 'name' => 'Named'];
        $dbCompany = Company::findOrNew($company['id']);
        $dbCompany->fill($company)->save();
        //$company_id = $dbCompany->id;

        $i = 1;
        do {
            try {
                $client = new Client();
                $res = $client->request('GET', "https://www.namedclothing.com/product-category/all-patterns/page/" . $i . "/");
                $this->namedScraper($res->getBody()->getContents());
                $this->info("Found page: ".$i);
                $statusCode = $res->getStatusCode();
            }
            catch (RequestException $e) {
                $statusCode = $e->getResponse()->getStatusCode();
            }
            $i++;
        } while ($statusCode == 200);
        $this->info("DONE");
    }

    /**
     * @param $response
     */
    function namedScraper($response)
    {
        $this->info("Scraping Named pattern shop...");

        $this->info("Scraping names...");
        $queryPath = QueryPath::withHTML($response);
        $names = $queryPath->find('.product h3')->toArray();

        $this->info("Scraping prices...");
        $prices = $queryPath->find('.product .price')->toArray();

        $this->info("Scraping redirect URLs...");
        $urls = [];
        foreach ($queryPath->find('.product a') as $product) {
            $red_url = $product->attr('href');
            $urls[] = $red_url;
        };

        $this->info("Scraping images...");
        $images = [];
        foreach ($queryPath->find('.product a img') as $product) {
            $img_url = $product->attr('src');
            $images[] = $img_url;
        };

        $this->info("Restructuring patterns & fetching info on individual product pages...");
        $patterns = [];
        foreach ($names as $key => $value) {
            $this->info("Now processing product ===============> " . strtoupper($value->textContent));
            $price = $prices[$key];
            $response = $urls[$key];
            $image = $images[$key];

            $subQueryPath = QueryPath::withHTML($response);

            $this->info("Scraping company product ID...");
            $product_id = $subQueryPath->find('form.cart')->attr('data-product_id');
            $product_id = "1-" . $product_id; // Adds company ID in front of company pattern ID

            $this->info("Scraping short description...");
            $description = $subQueryPath->find('ul:nth(4)')->text();

            $this->info("Scraping short supplies...");
            $supplies = $subQueryPath->find('ul:nth(6)')->text();

            $this->info("Scraping format & language...");
            $string = "";
            foreach ($subQueryPath->find('#pa_pattern-type-and-language option') as $option) {
                $format = $option->attr('value');
                $string = $string . $format;
            }

            $this->info("Reading format...");
            $format = Scraper::readFormat($string);

            $this->info("Reading language...");
            $language = Scraper::readLanguage($string);

/*
 * Ask Marcus:
 * Problem with characters for patterns with name
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
                'name' => $value->textContent,
                'price' => $price->textContent,
                //'category_id' => $category_id,
                'company_id' => '1', // change this later on
                'redirect_url' => $response,
                'image_url' => $image,
                'company_pattern_id' => $product_id,
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
