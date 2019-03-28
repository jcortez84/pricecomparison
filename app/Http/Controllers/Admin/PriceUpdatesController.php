<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Datafeed;
use App\Merchant;
use App\Product;
use App\ProductCodes as ProductCode;
use App\Price;
use App\ProductImageLink;
use App\Match;
use App\Brand;
use App\Category;
use ZipArchive;

class PriceUpdatesController extends Controller
{


    /**
     * Run the datafeed to update prices
     */
    public function run($id)
    {
        ini_set('max_execution_time', 0); //No limit

        $feed = Datafeed::where('merchant_id',$id)->first();

        $infile_path = 'storage/feed';

        /**
         * Merchant ID is set here
         */
        $mId = $feed->merchant_id;

        /**
         * Datafeed url is set here
         */
        $url = $feed->url;

        /**
         * Now we create the merchant autofeed
         * folder if it does not exist
         */
        $dest = 'storage/autofeeds/'.$mId;
        if(!is_dir($dest)){
            mkdir($dest, 0777, $url);
        }

        /**
         * Download the latest datafeed from merchant 
         * and copy to our newly created folder / server
         */
         //copy($url, $dest.'/feed');
         $fname = 'datafeed.csv';

        /**
         * Unzip / Extract datafeed to $fname and unlink the zip file
         */
        $zip = new ZipArchive;
        if ($zip->open($dest.'/feed') === TRUE) {
            $zip->renameName($zip->getNameIndex(0), $fname);
            $zip->extractTo($dest, $fname);
            $zip->close();
            //unlink($dest.'/feed');
        }

         /**
         * Open the datafile with fopen and create a handle
         */
        $handle = fopen($dest.'/'.$fname, 'r');

        /**
         * Next ID for new price
         */
        $newPriceId = Price::max('id')+1;
         /**
          * No we add prices
          */
          
        $header = null;
        while (($data = fgetcsv($handle, 0, ',')) !== FALSE){
            if($header) { $header = false; continue; }

                    /**
                     * This section will add product prices for merchant.
                     *
                     * We will search for product in the database based on the Match by parameter
                     * Once we locate the product we check if price is already in database
                     */
                    if($feed->match_by === 'mpn'){
                        $match = ProductCode::where('mpn','=',$data[$feed->column_mpn])->first();
                    }elseif($feed->match_by === 'ean'){
                        $match = ProductCode::where('ean','=',$data[$feed->column_ean])->first();
                    }elseif($feed->match_by === 'isbn'){
                        $match = ProductCode::where('isbn','=',$data[$feed->column_isbn])->first();
                    }elseif($feed->match_by === 'gtin'){
                        $match = ProductCode::where('gtin','=',$data[$feed->column_gtin])->first();
                    }elseif($feed->match_by === 'upc'){
                        $match = ProductCode::where('upc','=',$data[$feed->column_upc])->first();
                    }elseif($feed->match_by === 'name'){
                        $match = Product::where('title','=',$data[$feed->column_name])->first();
                    }

                    /**
                     * Is price in database?
                     * Lets find out
                     */
                    if($match){
                        $prod_id = $match->product_id;
                        $fields = ['product_id' => $prod_id, 'merchant_id' => $mId];
                        $price = Price::where($fields)->first();

                        $price_column = (float)$data[$feed->column_price];
                        if($data[$feed->column_shipping] !== ''){
                            $shipping_column = number_format($data[$feed->column_shipping], 2);
                        }else{
                            $shipping_column = 0.00;
                        }
                        
                        $name_column = $data[$feed->column_name];
                        if($feed->column_promo){
                        $promo_column = $data[$feed->column_promo];
                        }else{
                            $promo_column = null;
                        }
                        $buy_url_column = $data[$feed->column_buy_url];

                        if(!$price){
                            /**
                             * This is the path to the load data infile
                             */
 
                            $price_path = $infile_path.'/new_'.$mId.'.csv';

                            $new_price_data = $prod_id.'|'.$mId.'|'.$price_column.'|'.$shipping_column.'|'.$name_column.'|'.$promo_column.'|'.$buy_url_column."\r\n";

                            file_put_contents($price_path, trim($new_price_data).PHP_EOL, FILE_APPEND);

                            echo 'New price for: <b>'.$name_column.'</b> added £'.number_format($price_column, 2,'.', ' ').' - '.$shipping_column.'<br/>';
                            
                        }else{

                            $update_path = $infile_path.'/old_'.$price->merchant_id.'.csv';

                            $old_price_data = $price->id.'|'.$price->product_id.'|'.$price->merchant_id.'|'.$price_column.'|'.$shipping_column.'|'.$name_column.'|'.$promo_column.'|'.$buy_url_column."\r\n";

                            file_put_contents($update_path, trim($old_price_data).PHP_EOL, FILE_APPEND);

                            echo 'Price for: <b>'.$name_column.'</b> updated £'.number_format($price_column, 2, '.', ' ').'<br/>';
                        }

                    }else{
                        echo 'Product: <b>'.$data[$feed->column_name]. '</b> not found.<br/>';
                    }

        }
        fclose($handle);
        $prices_file = $infile_path.'/new_'.$mId.'.csv';
        $update_prices_file = $infile_path.'/old_'.$mId.'.csv';

        DB::connection()->getpdo()->exec('SET autocommit=0'); 
        DB::connection()->getpdo()->exec('SET unique_checks=0'); 
        DB::connection()->getpdo()->exec('SET foreign_key_checks=0');

        if(file_exists($prices_file)){
            $price_query = "LOAD DATA LOCAL INFILE '" . $prices_file . "'
            REPLACE INTO TABLE prices FIELDS TERMINATED BY '|'
                (product_id,merchant_id,amount,shipping,product_title,promo_text,buy_link,@created_at,@updated_at)
                SET created_at=NOW(),updated_at=NOW()";
            DB::connection()->getpdo()->exec($price_query);
        }
        
        if(file_exists($update_prices_file)){
            $update_price_query = "LOAD DATA LOCAL INFILE '" . $update_prices_file . "'
            REPLACE INTO TABLE prices FIELDS TERMINATED BY '|'
                (id,product_id,merchant_id,amount,shipping,product_title,promo_text,buy_link,@updated_at)
                SET updated_at=NOW()";
            DB::connection()->getpdo()->exec($update_price_query);
        }
        
    
        DB::connection()->getpdo()->exec('SET autocommit=1'); 
        DB::connection()->getpdo()->exec('SET unique_checks=1'); 
        DB::connection()->getpdo()->exec('SET foreign_key_checks=1');

        /**
         * Now process the file 
         * Add prices to the database;
         */
        if(file_exists($prices_file)){
            unlink($prices_file);
        }

        if(file_exists($update_prices_file)){
            unlink($update_prices_file);
        }
         
         
    }
    
    /**
     * Run all
     */
    public function runAll()
    {
        $feeds = Datafeed::all();
        foreach($feeds as $feed){
            $this->run($feed->merchant_id);
        }
    }
}
