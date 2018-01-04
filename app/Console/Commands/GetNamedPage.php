<?php

namespace App\Console\Commands;

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


        /*
         * Product page URL
        print QueryPath::withHTML('https://www.namedclothing.com/product-category/all-patterns/page/2/', '.product a')->attr('href');
        //Alternatively
        var_dump(QueryPath::withHTML('https://www.namedclothing.com/product-category/all-patterns/page/2/')->find('.product a')->attr('href'));
        die();
        */

        /*
        First product picture URL, but only for the first child... don't know why
        print QueryPath::withHTML('https://www.namedclothing.com/product-category/all-patterns/page/2/', '.product a img')->attr('src');
        die();
        */

        /* Creates a long string joining all text from product on the page corresponding to the path
        print QueryPath::withHTML('https://www.namedclothing.com/product-category/all-patterns/page/2/', '.product')->text();
        ///ALSO the below will select only the h3
        print QueryPath::withHTML('https://www.namedclothing.com/product-category/all-patterns/page/2/', '.product h3')->text();
        die();
         */
        function lastWord($string){
            $pieces = explode(' ', $string);
            $last_word = array_pop($pieces);
            return $last_word;
        }

        $url = "https://www.namedclothing.com/product-category/all-patterns/page/2/";
        $this->info("Importing data from ".$url);
        $this->info("Importing names...");
        $names = QueryPath::withHTML($url, '.product h3')->toArray();
        $this->info("Importing prices...");
        $prices = QueryPath::withHTML($url, '.product .price')->toArray();
        $this->info("Reorganizing data...");
        $data = [];
        foreach($names as $key => $value) {
            $value2 = $prices[$key];
            $value3 = lastWord($value->textContent);
            $data[$key] = ['name' => $value->textContent, 'price' => $value2->textContent, 'category' => $value3];
        }
        $this->info("Looping through data...");
        foreach($data as $item) {
            $this->info("Inserting/updating pattern with name". $item['name']);
            // create pattern model, migrations, and all that jazz...
        }
    }


}
