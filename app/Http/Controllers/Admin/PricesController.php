<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Price;
use App\Product;
use App\ProductCodes as ProductCode;
use App\ProductImageLink;
use App\Brand;
use App\Merchant;

class PricesController extends Controller
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
        $mId = Request()->get('mId');
        $prices = Price::where('merchant_id', '=', $mId)->paginate(10);
        return view('admin.prices.index')->with(compact('prices', 'mId'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.prices.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Method for displaying a prices csv form
     */
    public function csvform()
    {
        return view('admin.prices.csv-form');
    }

    /**
     * Method for processing the csv file
     */
    public function csvStore(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,txt'
        ]);

        if($request->hasFile('file'))
        {
            //get the file extension
            $ext = $request->file('file')->getClientOriginalExtension();
            $filename_save = $request->mId.'.'.$ext;
            $file = $request->file('file')->storeAs('storage/products/prices', $filename_save); 
        }

        $handle = fopen($request->file, 'r');
        $i = 0;
        while (($prod = fgetcsv($handle, 0, ',')) !== FALSE){
            if($i === 0){
                //Skip headers in CSV file
            }else{
               $p = Product::where('mpn', $prod[28])->where('ean', $prod[21])->first();
               if(!$p)
               {
                    echo 'Not Found so adding to database<br>';
                    //start with adding the brand
                    $brand = Brand::where('name', $prod[30])->first();
                    if(!$brand){
                        $new_brand = new Brand;
                        $new_brand->name = $prod[30];
                        $new_brand->save();
                    }
                    //add the product
                    $product = new Product;
                    $nextId = Product::max('id')+1;
                    $brandId = Brand::where('name', $prod[30])->first();
                    
                    if(isset($prod[11])){
                        $product->category_id = (!is_numeric((int)$prod[11]) || (int)$prod[11] > 999)?(int)$prod[11]:30;
                    }
                    $product->title = $prod[1];
                    $product->slug = $nextId.'_'.makeSlug($prod[1]);
                    $product->mpn = isset($prod[28])?$prod[28]:'';
                    $product->ean = $prod[21]??0;
                    $product->upc = '';//$data[1];
                    $product->gtin = '';//$data[1];
                    $product->isbn = '';//$data[1];
                    $product->description = isset($prod[5])?$prod[5]:'';
                    $product->min_price = 0;
                    $product->max_price = 0;
                    $product->brand_id = $brandId->id;
                    $product->save();

                    //Add the image link
                    $image = new ProductImageLink;
                    $image->product_id = $product->id;
                    $image->merchant_id = 'AW'.$prod[9];
                    $image->download_path = $prod[27];
                    // $image->is_downloaded = 0;
                    $image->save();

                    //Add product code
                    $pc = new ProductCode;
                    $pc->product_id = $product->id;
                    $pc->mpn = $product->mpn;
                    $pc->ean = $product->ean;
                    $pc->upc = $product->upc;
                    $pc->gtin = $product->gtin;
                    $pc->isbn = $product->isbn;
                    $pc->save();

                    //Check if price is in database and update
                    $p = Price::where('product_id', $product->id)->where('merchant_id', 'AW361');
                    if(!$p){
                        //update price
                        
                    }else{
                        //add new price
                        $np = new Price;
                        $np->buy_link = $prod[0];
                        $np->product_title = $prod[1];
                        $np->product_id = $product->id;
                        $np->merchant_id = 'AW'.$prod[9];
                        $np->amount = $prod[7];
                        $np->shipping = $prod[15];

                        $np->save();
                        return redirect()->back()->with('success', 'Prices successfully imported');
                    }

               }else{
                   //get the product id
                   $product = ProductCode::where('mpn', $prod[28])->orWhere('ean', $prod[21])->first();

                    //add new price
                    $np = new Price;
                    $np->buy_link = $prod[0];
                    $np->product_title = $prod[1];
                    $np->product_id = $product->prod_id;
                    $np->merchant_id = 'AW'.$prod[9];
                    $np->amount = $prod[7];
                    $np->shipping = $prod[15];

                    $np->save();

                    return redirect()->back()->with('success', 'Prices successfully imported');
               }
               
            }
            $i++;
        }
    }

    //     $handle = fopen($request->file, 'r');
    //     $i = 0;
    //     while (($data = fgetcsv($handle, 0, ',')) !== FALSE){
    //         if($i === 0){
    //             //Skip headers in CSV file
    //         }else{
    //             if (isset($data[4])){
    //             $brand = Brand::where('name', $data[4])->first();
    //                 if(!$brand){
    //                     $new_brand = new Brand;
    //                     $new_brand->name = $data[4];
    //                     $new_brand->save();
    //                 }
    //             }

    //             $product = new Product;
    //             $nextId = Product::max('id')+1;
    //             $brandId = Brand::where('name', $data[4])->first();
                
    //             if(isset($data[3])){
    //                 $product->cat_id = (!is_numeric((int)$data[3]) || (int)$data[3] > 999)?(int)$data[3]:30;
    //             }
    //             $product->title = $data[0];
    //             $product->slug = $nextId.'_'.$this->makeSlug($data[0]);
    //             $product->mpn = isset($data[5])?$data[5]:'';
    //             $product->ean = @(int)$data[6]??0;
    //             $product->upc = '';//$data[1];
    //             $product->gtin = '';//$data[1];
    //             $product->isbn = '';//$data[1];
    //             $product->description = isset($data[2])?$data[2]:'';
    //             $product->min_price = 0;
    //             $product->max_price = 0;
    //             $product->brand_id = $brandId->id;

    //             $product->save();

    //             $image = new ProductImageLink;
    //             $image->prod_id = $product->id;
    //             $image->download_path = isset($data[1])?$data[1]:'';
    //            // $image->is_downloaded = 0;

    //             $image->save();

    //             $pc = new ProductCode;
    //             $pc->prod_id = $product->id;
    //             $pc->mpn = $product->mpn;
    //             $pc->ean = $product->ean;
    //             $pc->upc = $product->upc;
    //             $pc->gtin = $product->gtin;
    //             $pc->isbn = $product->isbn;
    //             $pc->save();
    //         }
    //         $i++;//Counter used to skip csv file headers
    //     }
    //     fclose($handle);
    //     return redirect('/admin/products')->with('success', 'Products successfully imported');
     


}
