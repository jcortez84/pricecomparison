<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Click;
use App\Price;
use App\ProductImage;
use App\View;
use Illuminate\Support\Facades\DB;

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
        return view('shopfront.products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->first();
        $view = new View;
        $view->ip_address = Request()->ip();
        $view->product_id = $product->id;
        $view->save();

        return view('shopfront.products.show')->with(compact('product'));
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
       $products = DB::table('products')
        ->join('product_images', 'products.id', '=', 'product_images.product_id')
        ->join('views', 'products.id', '=', 'views.product_id')
        ->select('products.*', DB::raw("count(views.product_id) as total"))
        ->groupBy('products.id')->orderBy('total', 'desc')
        ->take(4)
        ->get();
 
        $c = View::groupBy('product_id')
        ->selectRaw('count(*) as total, product_id')->orderBy('total', 'desc')->get();

        $ids = [$c[0]->product_id,$c[1]->product_id,$c[2]->product_id,$c[3]->product_id];

        $products = Product::whereIn('id',$ids)->with('images')->take(4)->get();
        return response($products, 200);
    }
    /**
     * Get featured products for index page
     * @param $cat_id
     * @return @json object
     */
    public function api_featured_products()
    {
        $products = Product::where('category_id', '=',651)->inRandomOrder()->with('images')->take(10)->get();
        return response($products, 200);
    }

    /**
     * Get featured products for index page
     * @return @json object
     */
    public function api_top_deals()
    {
        $products = Product::inRandomOrder()->with('images')->take(10)->get();
        $c = Click::groupBy('product_id')
        ->selectRaw('count(id) as total, product_id')->orderBy('total', 'desc')->limit(4)->pluck('product_id');
        if(sizeof($c)> 0){
            // $ids = [$c[0]->product_id,$c[1]->product_id,$c[2]->product_id,$c[3]->product_id];
            $products = Product::whereIn('id',$c)->with('images')->take(10)->get();
        }
        return response($products, 200);
    }
    /**
     * Get featured products for index page
     * @return @json object
     */
    public function api_category_prods($id)
    {
        $cats = Category::where('parent_id', $id)->pluck('id');

        //dd($cats);

            $products = Product::whereIn('category_id',$cats)->with('images')->take(10)->get();
        
        return response($products, 200);
    }
}
