<?php

namespace App\Console\Commands;

use App\Pattern;
use Illuminate\Console\Command;
use QueryPath;

class GetNamedPage extends Command
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
        
        function lastWord($string){
            $pieces = explode(' ', $string);
            $last_word = array_pop($pieces);
            return $last_word;
        }

        /// Repeat the process for each page on Named, without knowing exactly how many pages
        /// So build in a process that would check whether a page is existing, or is live
        /// at the moment. Would need to check for header and status?
        /// Bot would need to be able to distinguish between a page that is temporarily down
        /// and a page that is non existent (ex: there is not "page 4" to Named patterns).

        $url = "https://www.namedclothing.com/product-category/all-patterns/page/2/";
        $this->info("Scraping page ".$url."...");

        $this->info("Scraping names...");
        $names = QueryPath::withHTML($url, '.product h3')->toArray();

        $this->info("Scraping prices...");
        $prices = QueryPath::withHTML($url, '.product .price')->toArray();

        $this->info("Scraping redirect URLs...");
        $urls = [];
        foreach(QueryPath::withHTML('https://www.namedclothing.com/product-category/all-patterns/page/2/')->find('.product a') as $product){
            $red_url = $product->attr('href');
            $urls[] = $red_url;
        };
        // array saved in $urls variable ==> add it to db below

        $this->info("Scraping images...");
        $images = [];
        foreach(QueryPath::withHTML('https://www.namedclothing.com/product-category/all-patterns/page/2/')->find('.product a img') as $product){
            $img_url = $product->attr('src');
            $images[] = $img_url;
        };
        // array saved into $images variable

        $this->info("Reorganizing data...");
        $data = [];
        foreach($names as $key => $value) {
            $price = $prices[$key];
            $category = lastWord($value->textContent);
            $url = $urls[$key];
            $image = $images[$key];
            $data[$key] = [
                'name' => $value->textContent,
                'price' => $price->textContent,
                'category' => $category,
                'redirect_url' => $url,
                'image_url' => $image,
            ];
        }

        $this->info("Looping through data...");
        foreach($data as $item) {
            $this->info("Inserting/updating pattern with name: ". $item['name']);
            $item['company_id'] = '1';
            $dbPattern = Pattern::findOrNew($item['name']);
            $dbPattern->fill($item)->save();
        }

    }

}
