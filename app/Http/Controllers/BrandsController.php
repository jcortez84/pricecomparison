<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Brand;
use App\Product;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::orderBy('name', 'asc')->paginate(30);
        $categories = Category::where('is_featured', 1)->take(9)->get();
        return view('shopfront.brands.index')->with(compact('brands', $brands, 'categories', $categories));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($name)
    {
        $brand = Brand::where('name', $name)->first();
        $categories = Category::where('parent_id', 0)->get();
        return view('shopfront.brands.show')->with(compact('brand', $brand, 'categories', $categories));
    }

}
