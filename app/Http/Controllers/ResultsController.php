<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Brand;
use App\Merchant;

class ResultsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::where('parent_id', 0)->get();
        
        return view('shopfront.results.index')->with(compact('categories'));
    }

    /**
     * API search url
     */
    public function search($q)
    {
       // $result = Product::where('title', 'like', '%'.$q.'%')->with('images')->orderBy('title', 'asc')->paginate(16);
        $result = Product::search($q, null, true)->paginate(16);
        return response($result, 200);
    }
}
