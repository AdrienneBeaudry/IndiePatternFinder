<?php

namespace App\Console\Commands;

use App\Pattern;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Console\Command;
use QueryPath;

class GetPauline extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:pauline';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrape Pauline Alice pattern shop.';

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

        // Clean up the below code. What is essential really?
        try {
            $client = new Client();
            $res = $client->request('GET', "https://www.paulinealicepatterns.com/en/");
            $this->paulineScraper($res->getBody()->getContents());
            $statusCode = $res->getStatusCode();
        } catch (RequestException $e) {
            $statusCode = $e->getResponse()->getStatusCode();
        }
        $this->info("DONE");
    }

    public function paulineScraper($response)
    {
        $this->info("Scraping Pauline Alice pattern shop...");

        $this->info("Scraping names...");
        $names = [];
        $queryPath = QueryPath::withHTML($response);
        foreach ($queryPath->find('.title') as $name) {
            $name = $name->text();
            $names[] = $name;
        }

        $this->info("Scraping company product ID...");
        $ids = [];
        foreach ($queryPath->find('.product_img_link') as $product) {
            $id = $product->attr('data-id-product');
            $id = "3-" . $id; // Adds company ID in front of company pattern ID
            // Also need to add company ID into company database later...
            $ids[] = $id;
        }

        $this->info("Scraping redirect URLs...");
        $urls = [];
        foreach ($queryPath->find('.product_img_link') as $product) {
            $red_url = $product->attr('href');
            $urls[] = $red_url;
        }

        $this->info("Restructuring patterns & fetching info on individual product pages...");
        $patterns = [];
        foreach ($names as $key => $value) {
            $this->info("Now processing product ===============> " . strtoupper($value));
            $response = $urls[$key];
            $pattern_id = $ids[$key];

            $subQueryPath = QueryPath::withHTML($response);

            $this->info("Scraping description...");
            $description = $subQueryPath->find('#short_description_content p:nth(1)')->text();

            $this->info("Reading format...");
            $raw_format = $subQueryPath->find('#short_description_content p:nth(5)')->text();
            if (stristr($raw_format, 'pdf') === false) {
                $format = "3";
            } else {
                $format = "2";
            }

            $this->info("Scraping supplies...");
            $supplies = $subQueryPath->find('div#tabs-1')->text();
            $position = strpos($supplies, "FABRIC REQUIREMENT");
            $supplies = trim(substr($supplies, 0, $position));

            $this->info("Scraping prices...");
            $price = $subQueryPath->find('#our_price_display')->text();

            $this->info("Adding language...");
            $language = "English French Spanish";

            $this->info("Scraping image URLs...");
            $img = $subQueryPath->find('.shown')->attr('href');

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
                'company_id' => '3', // change this later on
                'redirect_url' => $response,
                'image_url' => $img,
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
