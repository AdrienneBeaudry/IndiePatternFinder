<?php

namespace App\Console\Commands;

use App\Company;
use App\Pattern;
use App\Scraper;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Console\Command;
use QueryPath;

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
        $company = ['id' => '1', 'company_name' => 'Named Patterns'];
        $dbCompany = Company::findOrNew($company['id']);
        $dbCompany->fill($company)->save();

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
            $format = Scraper::readFormat($string, 'pdf', 'print');

            $this->info("Reading language...");
            $language = Scraper::readLanguage($string);

            $patterns[$key] = [
                'name' => $value->textContent,
                'price' => $price->textContent,
                'company_id' => '1',
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
            $dbPattern = Pattern::findOrNew($pattern['name']);
            $dbPattern->fill($pattern)->save();
        }
    }
}
