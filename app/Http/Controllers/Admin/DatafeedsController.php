<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
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

class DatafeedsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if($mId = Request()->get('mId')){
            $mId = Request()->get('mId');
            $datafeeds = Datafeed::where('merchant_id', $mId)->paginate(10);
            //dd($datafeeds);
        }else{
            $datafeeds = Datafeed::paginate(10);
        }
        
        return view('admin.datafeeds.index')->with(compact('datafeeds', 'mId'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mId = Request()->get('mId');
        $merchants = Merchant::orderBy('name', 'asc')->pluck('name', 'id');

        return view('admin.datafeeds.create')->with(compact('merchants', 'mId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'merchantId' => 'required',
            'feed_url' => 'required'
        ]);

        $feed = new Datafeed;

        $feed->merchant_id = $request->input('merchantId');
        $feed->url = $request->input('feed_url');
        $feed->save();

        return redirect()->back()->with('success', 'Datafeed successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.datafeeds.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $feed = Datafeed::find($id);

        $mId = $feed->merchant_id;
        $merchants = Merchant::orderBy('name', 'asc')->pluck('name', 'id');

        return view('admin.datafeeds.edit')->with(compact('merchants', $merchants, 'feed', $feed));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'merchantId' => 'required',
            'feed_url' => 'required'
        ]);

        $feed = Datafeed::find($id);
        $feed->merchant_id = $request->input('merchantId');
        $feed->url = $request->input('feed_url');

        $feed->save();

        return redirect()->back()->with('success', 'Datafeed successfully updates.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $feed = Datafeed::find($id);
        $feed->delete();
        return redirect()->back()->with('success', 'Feed deleted successfuly');
    }

    /**
     * Test run method to set the feed parameters
     */
    public function test($id)
    {
        $feed = Datafeed::find($id);
        $mId = $feed->merchant_id;
        $url = $feed->url;//url goes here
        
        $dest = 'storage/autofeeds/'.$mId;
        if(!is_dir($dest)){
            mkdir($dest, 0777, $url);
        }

        getRemoteFile($url, $dest.'/testrun');
        copy($url, $dest.'/testrun');
        $fname = 'testrun.csv';
        
        $zip = new ZipArchive;
        if ($zip->open($dest.'/testrun') === TRUE) {
            $zip->renameName($zip->getNameIndex(0), $fname);
            $zip->extractTo($dest, $fname);
            $zip->close();
            unlink($dest.'/testrun');
        }

        $handle = fopen($dest.'/'.$fname, 'r');
        $i = 0;
        while (($data = fgetcsv($handle, 0, ',')) !== FALSE){
            $params[] = $data;
            // count($data) is the number of columns
            $numcols = count($data);
            if ($i< 5) {
                continue;
            }
           
            $i++;
        }
        //print_r($params);
        //die;
        return view('admin.datafeeds.test')->with(compact('params', 'numcols', 'feed'));
    }

    /**
     * Rest post route that creates the settings form
     */
    public function testCreate(Request $request, $id)
    {
        $feed = Datafeed::find($id);

        foreach($request->params as $key => $value){
            if(isset($value)){
                switch ($value) {
                    case 'productName':
                        $feed->column_name = $key;
                        break;
                    case 'productDesc':
                        $feed->column_description = $key;
                        break;
                    case 'productPrice':
                        $feed->column_price = $key;
                        break;
                    case 'categoryName':
                        $feed->column_category_name = $key;
                        break;
                    case 'categoryId':
                        $feed->column_category_id = $key;
                        break;
                    case 'shipping':
                        $feed->column_shipping = $key;
                        break;
                    case 'buyUrl':
                        $feed->column_buy_url = $key;
                        break;
                    case 'promoText':
                        $feed->column_promo = $key;
                        break;
                    case 'mpn':
                        $feed->column_mpn = $key;
                        break;
                    case 'upc':
                        $feed->column_upc = $key;
                        break;
                    case 'isbn':
                        $feed->column_isbn = $key;
                        break;
                    case 'ean':
                        $feed->column_ean = $key;
                        break;
                    case 'image':
                        $feed->column_image_url = $key;
                        break;
                    case 'brand':
                        $feed->column_brand = $key;
                        break;
                }
            }
        }
        $feed->add_new_products = $request->add_new_products;
        $feed->match_by = $request->match_by;
        $feed->save();
        return redirect('/admin/datafeeds')->with('success', 'Datafeed Parameters Added Successfully!');
    }

    /**
     * Run the datafeed to update prices
     */
    public function run($id)
    {
        $feed = Datafeed::find($id);

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
        copy($url, $dest.'/feed');
        $fname = 'datafeed.csv';

        /**
         * Unzip / Extract datafeed to $fname and unlink the zip file
         */
        $zip = new ZipArchive;
        if ($zip->open($dest.'/feed') === TRUE) {
            $zip->renameName($zip->getNameIndex(0), $fname);
            $zip->extractTo($dest, $fname);
            $zip->close();
            unlink($dest.'/feed');
        }
        /**
         * Open the datafile with fopen and create a handle
         */
        $handle = fopen($dest.'/'.$fname, 'r');
        /**
         * Initiate counter that is used to skip hearders
         */
        $i = 0;

        /**
         * Now process the file
         */
        while (($data = fgetcsv($handle, 0, ',')) !== FALSE){
            if($i === 0){
                //Skip headers in CSV file
            }else{
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
                        
                        $product = new Product;
                        $nextId = Product::max('id')+1;
                        $brandId = Brand::where('name', $data[$feed->column_brand])->first();
                        
                        $product->category_id = $data[$feed->column_category_id]; //) || $data[$feed->column_category_id] > 999)?$data[$feed->column_category_id]:30;

                        $product->title = $data[$feed->column_name];
                        $product->slug = $nextId.'-'.makeSlug($data[$feed->column_name]);
                        if($feed->column_mpn && $data[$feed->column_mpn]){
                            $product->mpn = $data[$feed->column_mpn];
                        }
                        if($feed->column_ean && $data[$feed->column_ean]){
                            $product->ean = $data[$feed->column_ean];
                        }
                        if($feed->column_upc && $data[$feed->column_upc]){
                            $product->upc = $data[$feed->column_upc];
                        }
                        if($feed->column_gtin && $data[$feed->column_gtin]){
                            $product->gtin = $data[$feed->column_gtin];
                        }
                        if($feed->column_isbn && $data[$feed->column_isbn]){
                            $product->isbn = $data[$feed->column_isbn];
                        }
                        if($feed->column_description && $data[$feed->column_description]){
                            $product->description = $data[$feed->column_description];
                        }

                        $product->min_price = 0;
                        $product->max_price = 0;
                        $product->brand_id = $brandId->id;
        
                        $product->save();
                        
                        /**
                         * We now check to see if there is a product image link
                         * if it exists we get this to download later
                         */

                        if($feed->column_image_url && $data[$feed->column_image_url]){
                            $image = new ProductImageLink;
                            $image->product_id = $product->id;
                            $image->merchant_id = $mId;
                            $image->download_path = $data[$feed->column_image_url];
                            $image->save();
                        }
                        
                        /**
                         * This part will add product codes in in the product matching table
                        */
                        $pc = new ProductCode;
                        $pc->product_id = $product->id;
                        $pc->mpn = $product->mpn;
                        $pc->ean = $product->ean;
                        $pc->upc = $product->upc;
                        $pc->gtin = $product->gtin;
                        $pc->isbn = $product->isbn;
                        $pc->save();
                    }
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

                        if(!$price){
                            //This bit will add a new price if not in database yet
                            $price = new Price;
                            $price->product_id = $prod_id;
                            $price->merchant_id = $mId;
                            $price->amount = (float)$data[$feed->column_price];
                            $price->shipping = (float)(!$data[$feed->column_shipping])??0.00;
                            $price->product_title = $data[$feed->column_name];
                            $price->buy_link = $data[$feed->column_buy_url];
                            $price->save();

                            if($feed->column_image_url && $data[$feed->column_image_url]){
                                $image = new ProductImageLink;
                                $image->product_id = $match->product_id;
                                $image->merchant_id = $mId;
                                $image->download_path = $data[$feed->column_image_url];
                                $image->save();
                            }

                        }else{
                            // This means price has been found so we update
                            $price->amount = (float)$data[$feed->column_price];
                            $price->shipping = (float)(!$data[$feed->column_shipping])??0.00;
                            $price->product_title = $data[$feed->column_name];
                            $price->buy_link = $data[$feed->column_buy_url];
                            $price->save();
                        }

                    }else{
                        echo 'Product not found.<br/>';
                    }
                }

            $i++;//Counter used to skip csv file headers
        }
        fclose($handle);

        return redirect()->back()->with('success', 'Product feed ran successfully');
    }
}
