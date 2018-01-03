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

        print QueryPath::withHTML('https://www.namedclothing.com/product-category/all-patterns/page/2/', 'title')->text();
        die();

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
