<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use App\Category;

class PagesController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $categories = Category::where('parent_id', 0)->get();
        $page = Page::where('slug', $slug)->first();
        return view('shopfront.pages.show')->with(compact('page', $page, 'categories', $categories));
    }

}