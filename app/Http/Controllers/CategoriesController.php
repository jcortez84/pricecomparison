<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Category::where('parent_id', 0)->get();
        $categories = Category::where('is_featured', 1)->take(9)->get();
        
        return view('shopfront.categories.index')->with(compact('categories', 'list'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $categories = Category::where('is_featured', 1)->take(9)->get();
        return view('shopfront.categories.show')->with(compact('category', $category, 'categories', $categories));
    }

}
