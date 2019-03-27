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

class SSHProductsController extends Controller
{


    /**
     * Run the datafeed to update prices
     */
    public function run($id)
    {
        ini_set('max_execution_time', 0); //No limit

        $feed = Datafeed::find($id);

        /**
         * Merchant ID is set here
         */
        $mId = $feed->merchant_id;

        /**
         * Datafeed url is set here
         */
        $url = $feed->url;

        $infile_path = 'storage/feed';
        if(!is_dir($infile_path)){
            mkdir($infile_path, 0777, $url);
        }
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
         * Initiate counter that is used to skip hearders
         */
        /**
         * Process the file
         * Add new produts to the database
         */
        $nextId = Product::max('id');

        $flag = true;

        
        while (($data = fgetcsv($handle, 0, ',')) !== FALSE){
            if($flag) { $flag = false; continue; }
            $isbn = null;
            $mpn = null;
            $gtin = null;
            $upc = null;
            $ean = null;
            
                dd($data);
                /**
                 * Now we check if the brand column isset in feed parameters
                 * If isset we check if the value  is in csv file,
                 * If found we check DB for this value. 
                 * If exists we skip record otherwise add the new brand
                 */
                if ($feed->column_brand !== null){
                    if($data[$feed->column_brand] !== null){
                        $brand = Brand::where('name', $data[$feed->column_brand])->first();
                        if(!$brand){
                            $new_brand = new Brand;
                            $new_brand->name = $data[$feed->column_brand];
                            $new_brand->save();
                        }
                    }
                }
                
                    /**
                     * Here we check if this feed is allowed to add new prodcuts to our database
                     * If yes we add product as permitted otherwise we skip this step
                     */
                    
                    $mpn = @ProductCode::where('mpn','=',$data[$feed->column_mpn])->first();
                    $ean = @ProductCode::where('ean','=',$data[$feed->column_ean])->first();
                    $gtin = @ProductCode::where('gtin','=',$data[$feed->column_gtin])->first();
                    $upc = @ProductCode::where('upc','=',$data[$feed->column_upc])->first();

                /**
                 * We check if we can add new products and that the 
                 * product is not already in our database
                 */
                if($feed->add_new_products && !$mpn || !$ean || !$gtin || !$upc){
                
                        $brandId = Brand::where('name', $data[$feed->column_brand])->first();
                        
                        $category_id = $data[$feed->column_category_id]; //) || $data[$feed->column_category_id] > 999)?$data[$feed->column_category_id]:30;

                        $title = $data[$feed->column_name];
                        $slug = $nextId.'-'.makeSlug($data[$feed->column_name]);
                        if($feed->column_mpn && $data[$feed->column_mpn]){
                            $mpn = $data[$feed->column_mpn];
                        }else{
                            $mpn = null;
                        }
                        if($feed->column_ean && $data[$feed->column_ean]){
                            $ean = $data[$feed->column_ean];
                        }else{
                            $ean = null;
                        }
                        if($feed->column_upc && $data[$feed->column_upc]){
                            $upc = $data[$feed->column_upc];
                        }else{
                            $upc = null;
                        }
                        if($feed->column_gtin && $data[$feed->column_gtin]){
                            $gtin = $data[$feed->column_gtin];
                        }else{
                            $gtin = null;
                        }
                        if($feed->column_isbn && $data[$feed->column_isbn]){
                            $isbn = $data[$feed->column_isbn];
                        }else{
                            $isbn = null;
                        }
                        if($feed->column_description && $data[$feed->column_description]){
                            $description = $data[$feed->column_description];
                        }else{
                            $description = null;
                        }

                        $min_price = 0;
                        $max_price = 0;
                        $brand_id = $brandId->id;
                        /**
                         * Add new roduct 
                         */
                        
                            
                        if(!is_dir($infile_path)){
                            mkdir($infile_path, 0777, true);
                        }
                        $product_infile_path = $infile_path.'/products.csv';
                        $prods_data = $nextId.'|'.$category_id.'|'.$title.'|'.$slug.'|'.$mpn.'|'.$ean.'|'.$upc.'|'.$gtin.'|'.$isbn.'|'.$description.'|'.$min_price.'|'.$max_price.'|'.$brand_id."\r\n";

                        echo $prods_data;
                        file_put_contents($product_infile_path, trim($prods_data).PHP_EOL, FILE_APPEND);
                        
                        /**
                         * Add images
                         */
                        if($feed->column_image_url && $data[$feed->column_image_url]){
                            $download_path = $data[$feed->column_image_url];
                            $image_infile_path = $infile_path.'/images.csv';
                            $image_data = $nextId.'|'.$mId.'|'.$download_path."\r\n";
                            file_put_contents($image_infile_path, trim($image_data).PHP_EOL, FILE_APPEND);
                        }
                        

                        /**
                         * Add product codes
                         */
                        $product_codes_infile_path = $infile_path.'/product_codes.csv';

                        $codes_data = $nextId.'|'.$mpn.'|'.$gtin.'|'.$ean.'|'.$isbn.'|'.$upc.'|'."\r\n";

                        file_put_contents($product_codes_infile_path, trim($codes_data).PHP_EOL, FILE_APPEND);
                        /**
                         * We now check to see if there is a product image link
                         * if it exists we get this to download later
                         */

                         $nextId++;
                }else{
                    echo 'No new products added<br/>';
                }
        
            }
            fclose($handle);
                    
        /**
         * Now lets load_data_infile
         */
        
        $products_file = 'storage/feed/products.csv';

        $product_codes_file = 'storage/feed/product_codes.csv';

        $images_file = 'storage/feed/images.csv';

        DB::connection()->getpdo()->exec('SET autocommit=0'); 
        DB::connection()->getpdo()->exec('SET unique_checks=0'); 
        DB::connection()->getpdo()->exec('SET foreign_key_checks=0');

        if(file_exists($products_file)){
            $prod_query = "LOAD DATA LOCAL INFILE '" . $products_file . "'
            INTO TABLE products FIELDS TERMINATED BY '|'
                (id,category_id,title,slug,mpn,ean,upc,gtin,isbn,description,min_price,max_price,brand_id,@created_at,@updated_at)
                SET created_at=NOW(), updated_at=NOW()";
            DB::connection()->getpdo()->exec($prod_query);
    
        }
        if(file_exists($product_codes_file)){
            $prod_codes_query = "LOAD DATA LOCAL INFILE '" . $product_codes_file . "'
            INTO TABLE product_codes FIELDS TERMINATED BY '|'
                (product_id,mpn,gtin,ean,isbn,upc,@created_at,@updated_at)
                SET created_at=NOW(), updated_at=NOW()";
            DB::connection()->getpdo()->exec($prod_codes_query);
        }
        if(file_exists($images_file)){
            $image_query = "LOAD DATA LOCAL INFILE '" . $images_file . "'
            INTO TABLE product_image_links FIELDS TERMINATED BY '|'
                (product_id,merchant_id,download_path,@created_at,@updated_at)
                SET created_at=NOW(), updated_at=NOW()";
            DB::connection()->getpdo()->exec($image_query);
        }
        DB::connection()->getpdo()->exec('SET autocommit=1'); 
        DB::connection()->getpdo()->exec('SET unique_checks=1'); 
        DB::connection()->getpdo()->exec('SET foreign_key_checks=1');

        /**
         * Now process the file 
         * Add prices to the database;
         */
        
         @unlink($product_codes_file);
         @unlink($images_file);
         @unlink($products_file);
    }

    /**
     * Run all
     */
    public function runAll()
    {
        $feeds = Datafeed::all();
        foreach($feeds as $feed){
            $this->run($feed->id);
        }
    }
}

