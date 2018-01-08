<?php

namespace App\Console\Commands;

use App\Pattern;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
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
        function lastWord($string)
        {
            $pieces = explode(' ', $string);
            $last_word = array_pop($pieces);
            return $last_word;
        }

        $i = 1;
        do {
            try {
                $client = new Client();
                $res = $client->request('GET', "https://www.namedclothing.com/product-category/all-patterns/page/" . $i . "/");
                //$this->scrapeNamed($res->getBody()->getContents());
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

    function scrapeNamed($response)
    {
        $this->info("Scraping page " . $response . "...");

        $this->info("Scraping names...");
        $queryPath = QueryPath::withHTML($response);
        $names = $queryPath->find('.product h3')->toArray();

        $this->info("Scraping prices...");
        $prices = $queryPath->find('.product h3')->toArray();

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

        $this->info("Restructuring data & fetching info on individual product pages...");
        $data = [];
        foreach ($names as $key => $value) {
            $this->info("Now processing product ===============> " . strtoupper($value->textContent));
            $price = $prices[$key];
            $category = lastWord($value->textContent);
            $response = $urls[$key];
            $image = $images[$key];

            $this->info("Scraping pattern description...");
            $raw_description = $queryPath->find('.span6')->first('p')->text();
            $full_description = preg_replace('/\s+/', ' ', $raw_description);

            $this->info("Scraping company product ID...");
            $product_id = $queryPath->find('form.cart')->attr('data-product_id');
            $product_id = "1-" . $product_id; // Adds company ID in front of company pattern ID

            $this->info("Scraping short description...");
            $description = $queryPath->find('ul:nth(4)')->text();

            $this->info("Scraping short supplies...");
            $supplies = $queryPath->find('ul:nth(6)')->text();

            $this->info("Scraping format & language...");
            $string = "";
            foreach ($queryPath->find('#pa_pattern-type-and-language option') as $option) {
                $format = $option->attr('value');
                $string = $string . $format;
            }

            $this->info("Reading format...");
            $format = null;
            if (strpos($string, 'pdf') !== false && strpos($string, 'print') !== false) {
                $format = 3;
            } elseif (strpos($string, 'pdf') !== false) {
                $format = 1;
            } elseif (strpos($string, 'print') !== false) {
                $format = 2;
            }

            $this->info("Reading language...");
            $language = "";
            if (strpos($string, 'english') !== false) {
                $language = $language . "English ";
            }
            if (strpos($string, 'finnish') !== false) {
                $language = $language . "Finnish ";
            }
            if (strpos($string, 'french') !== false) {
                $language = $language . "French ";
            }
            if (strpos($string, 'german') !== false) {
                $language = $language . "German ";
            }
            if (strpos($string, 'japanese') !== false) {
                $language = $language . "Japanese ";
            }
            if (strpos($string, 'spanish') !== false) {
                $language = $language . "Spanish ";
            }

            $data[$key] = [
                'name' => $value->textContent,
                'price' => $price->textContent,
                //'category_id' => $category,
                //'company_id' => $company_id,
                'redirect_url' => $response,
                'image_url' => $image,
                'company_pattern_id' => $product_id,
                'description' => $description,
                'supplies' => $supplies,
                'format' => $format,
                'language' => $language,
            ];
        }

        $this->info("Looping through data...");
        foreach ($data as $item) {
            $this->info("Inserting/updating: " . $item['name']);
            $item['company_id'] = '1';
            // is it okay to use the method findOrNew here??
            $dbPattern = Pattern::findOrNew($item['name']);
            $dbPattern->fill($item)->save();
        }

        /*
         * Add insert into COMPANIES + CATEGORIES tables
         *
         * */

    }

}
