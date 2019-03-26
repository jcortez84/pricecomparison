<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductImageLink;
use App\ProductImage;
use App\Match;
use App\Brand;
use App\Category;
use App\ProductCodes as ProductCode;
use App\Price;

class ProductsController extends Controller
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
        $products = Product::paginate(10);
        if(Request()->get('q') !== null){
            $q = Request()->get('q');
            $products = Product::where('title','like', '%'.$q.'%')->paginate(10);  
        }
        return view('admin.products.index')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subcategories = Category::all()->pluck('title', 'id');
        $categories = Category::orderBy('title', 'asc')->pluck('title', 'id');
        return view('admin.products.create')->with('subcats', $subcategories, 'categories');
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
            'title' => 'required|max:100',
            'mpn' => 'nullable|max:60',
            'ean' =>'nullable',
            'upc' => 'nullable',
            'gtin' => 'nullable',
            'isbn' => 'nullable',
            'description' => 'nullable',
            'min_price' => 'required|between:0,99.99',
            'max_price' => 'required|between:0,99.99'
        ]);
        $nextId = Product::max('id')+1;
        $product = new Product;
        $product->title = $request->input('title');
        $product->slug = $nextId.'-'.makeSlug($product->title);
        $product->mpn = $request->input('mpn');
        $product->category_id = $request->input('cat_id');
        $product->ean = $request->input('ean');
        $product->upc = $request->input('upc');
        $product->gtin = $request->input('gtin');
        $product->isbn = $request->input('isbn');
        $product->description = $request->input('description');
        $product->min_price = (float)$request->input('min_price');
        $product->max_price = (float)$request->input('max_price');
        dd($product);
        $product->save();

        $pc = new ProductCode;
        $pc->product_id = $product->id;
        $pc->mpn = $product->mpn;
        $pc->ean = $product->ean;
        $pc->upc = $product->upc;
        $pc->gtin = $product->gtin;
        $pc->isbn = $product->isbn;
        $pc->save();
        return redirect('/admin/products')->with('success', 'Product added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.products.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::orderBy('title', 'asc')->pluck('title', 'id');
        return view('admin.products.edit')->with(compact('product', 'categories'));
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
            'title' => 'required|max:100',
            'category_id' =>'required',
            'mpn' => 'nullable|max:60',
            'ean' =>'nullable',
            'upc' => 'nullable',
            'gtin' => 'nullable',
            'isbn' => 'nullable',
            'description' => 'nullable'
        ]);

        $product = Product::find($id);

        $product->title = $request->input('title');
        $product->mpn = $request->input('mpn');
        $product->category_id = $request->input('category_id');
        $product->ean = $request->input('ean');
        $product->upc = $request->input('upc');
        $product->gtin = $request->input('gtin');
        $product->isbn = $request->input('isbn');
        $product->description = $request->input('description');
        $product->save();
        //Set the product minimum and maximum prices
        $this->set_min_max_price($product->id);
        
        $pc = ProductCode::find($product->id);
        $pc->mpn = $product->mpn;
        $pc->ean = $product->ean;
        $pc->upc = $product->upc;
        $pc->gtin = $product->gtin;
        $pc->isbn = $product->isbn;
        $pc->save();

        return redirect('/admin/products')->with('success', 'Product updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        $price = Price::where('product_id', $id)->delete();

        $product_code = ProductCode::where('product_id', $id)->delete();

        $product_image_link = ProductImageLink::where('product_id', $id)->delete();

        $product_image = ProductImage::where('product_id', $id)->get();

        foreach($product_image as $image){

            if(file_exists($image->path)){
                unlink($image->path);
            }
            
        }

        $product->delete();
        return redirect()->back()->with('success', $product->title.' Has been deleted');
    }

    /**
     * Delete a batch of products
     */
    public function batchDelete()
    {
        $prods = Product::where('max_price', '=', '0.00')->get();
        $i=1;
        foreach($prods as $prod){
            $this->destroy($prod->id);
            echo $i.'---'.$prod->title.' deleted <br>';

            $i++;
        }
    }
     /**
     * Method for displaying a mercants csv form
     */
    public function csvform()
    {
        return view('admin.products.csv-form');
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
            $filename_save = 'product.'.$ext;
            $file = $request->file('file')->storeAs('public/products', $filename_save); 
        }
        $handle = fopen($request->file, 'r');
        $i = 0;
        while (($data = fgetcsv($handle, 0, ',')) !== FALSE){
            if($i === 0){
                //Skip headers in CSV file
            }else{
                if (isset($data[4])){
                $brand = Brand::where('name', $data[4])->first();
                    if(!$brand){
                        $new_brand = new Brand;
                        $new_brand->name = $data[4];
                        $new_brand->save();
                    }
                }

                $product = new Product;
                $nextId = Product::max('id')+1;
                $brandId = Brand::where('name', $data[4])->first();
                
                if(isset($data[3])){
                    $product->cat_id = (!is_numeric((int)$data[3]) || (int)$data[3] > 999)?(int)$data[3]:30;
                }
                $product->title = $data[0];
                $product->slug = $nextId.'_'.makeSlug($data[0]);
                $product->mpn = isset($data[5])?$data[5]:'';
                $product->ean = @(int)$data[6]??0;
                $product->upc = '';//$data[1];
                $product->gtin = '';//$data[1];
                $product->isbn = '';//$data[1];
                $product->description = isset($data[2])?$data[2]:'';
                $product->min_price = 0;
                $product->max_price = 0;
                $product->brand_id = $brandId->id;

                $product->save();

                $image = new ProductImageLink;
                $image->product_id = $product->id;
                $image->download_path = isset($data[1])?$data[1]:'';
               // $image->is_downloaded = 0;

                $image->save();

                $pc = new ProductCode;
                $pc->product_id = $product->id;
                $pc->mpn = $product->mpn;
                $pc->ean = $product->ean;
                $pc->upc = $product->upc;
                $pc->gtin = $product->gtin;
                $pc->isbn = $product->isbn;
                $pc->save();
            }
            $i++;//Counter used to skip csv file headers
        }
        fclose($handle);
        return redirect('/admin/products')->with('success', 'Products successfully imported');
    }

    /**
     * Update minimum and maximum prices
     */
    public function set_min_max_price($id)
    {
        $product = Product::find($id);

        $min_price = Price::where('product_id', $id)->min('amount');
        $max_price = Price::where('product_id', $id)->max('amount');

        if($min_price){
            $product->min_price = $min_price;
            $product->max_price = $max_price;
            $product->save();

            return redirect()->back()->with('success', 'Product prices set');
        }
        return redirect()->back()->with('error', 'Product prices not set');
        
    }

    /**
     * Set product minimum and maximum prices in one batch.
     */
    public function profile_all_prices()
    {
        ini_set('max_execution_time', 0); //No limit
        $products = Product::where('max_price', 0)->get();
        foreach($products as $product){
            $this->set_min_max_price($product->id);
        }
    }
}
