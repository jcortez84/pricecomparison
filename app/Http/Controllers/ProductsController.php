<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Click;
use App\Price;
use App\ProductImage;

class ProductsController extends Controller
{
    private $mId;
    private $id;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::where('parent_id', 0)->get();

        return view('shopfront.products.index')->with(compact('categories', $categories));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $categories = Category::where('parent_id', 0)->get();
        $product = Product::where('slug', $slug)->first();
        //dd($product->prices());
        return view('shopfront.products.show')->with(compact('categories', 'product'));
    }

    /**
     * Redirect to merchant
     * 
     * @param int $id
     * 
     * @return \Illuminate\Http\Response
     */
    public function goToStore($id)
    {
        $price = Price::find($id);
        $click = new Click;
        $click->merchant_id = $price->merchant_id;
        $click->ip_address = Request()->ip();
        $click->product_id = $price->product_id;
        $click->price_id = $id;

        $click->save();
        return redirect($price->buy_link);
    }

    /**
     * Get products for a retailer
     * @param $mId
     * @return @json object
     */
    public function api_retailer_products($mId)
    {
        $this->mId = $mId;

        $products = Price::with('images')->join('products', function ($join) {
            $join->on('products.id', '=', 'prices.product_id')
                 ->where('merchant_id', $this->mId);
        })->paginate(16);
        return response($products, 200);
    }

    /**
     * Get the product and show 
     * @param $id
     * @return json object
     */
     public function api_show($id)
     {
        $product = Product::with('images')->find($id);
            return response()->json($product, 200);
     }
    
     /**
     * Get the product images and show 
     * @param $id
     * @return json object
     */
    public function api_show_images($id)
    {
       $images = ProductImage::where('product_id',$id)->get();
           return response()->json($images, 200);
    }

    /**
     * Get products for a category
     * @param $cat_id
     * @return @json object
     */
    public function api_category_products($cat_id)
    {
        $products = Product::where('category_id', $cat_id)->with('images')->paginate(16);
        return response($products, 200);
    }
    
    /**
     * Get products for a brand
     * @param $brand_id
     * @return @json object
     */
    public function api_brand_products($brand_id)
    {
        $products = Product::where('brand_id', $brand_id)->with('images')->paginate(16);
        return response($products, 200);
    }

    /**
     * Get top products for index page
     * @param $cat_id
     * @return @json object
     */
    public function api_top_products()
    {
        $products = Product::inRandomOrder()->with('images')->take(8)->get();
        return response($products, 200);
    }
    /**
     * Get featured products for index page
     * @param $cat_id
     * @return @json object
     */
    public function api_featured_products()
    {
        $products = Product::where('category_id', '=',651)->inRandomOrder()->with('images')->take(4)->get();
        return response($products, 200);
    }

    /**
     * Get featured products for index page
     * @param $cat_id
     * @return @json object
     */
    public function api_index_products($cat_id)
    {
        $products = Product::where('category_id', '=',$cat_id)->inRandomOrder()->with('images')->take(4)->get();
        return response($products, 200);
    }
}
