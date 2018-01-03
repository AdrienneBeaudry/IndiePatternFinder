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
         * NAMES OK
        // getting all product name in an array
        print_r(QueryPath::withHTML('https://www.namedclothing.com/product-category/all-patterns/page/2/', '.product h3')->toArray());
        die();
        */

        /*
         * PRICES OK
         * Storing all prices in an array
        print_r(QueryPath::withHTML('https://www.namedclothing.com/product-category/all-patterns/page/2/', '.product .price')->toArray());
        die();
        */


        var_dump(QueryPath::withHTML('https://www.namedclothing.com/product-category/all-patterns/page/2/')->find('.product a')->attr());
        die();

        /*
         * Product page URL
        print QueryPath::withHTML('https://www.namedclothing.com/product-category/all-patterns/page/2/', '.product a')->attr('href');
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

        $ch = curl_init();
        $url = "https://www.namedclothing.com/product-category/all-patterns/page/2/";
        $this->info("Importing data from: ".$url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $this->info("Sending request...");
        $page = curl_exec($ch);
        curl_close($ch);

        //Parse the data to only get what I need:
        //      - name
        //      - category
        //      - product images
        //      - product description
        //      - price
        //      - format
        //
        // page saved into $page variable.... Now use something for
        
    }
}
