<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Merchant;
use App\Category;

class RetailersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $retailers = Merchant::orderBy('name', 'asc')->paginate(30);

        return view('shopfront.retailers.index')->with(compact('retailers'));
    }

    /**
     * Display the specified resource.
     *
     * @param   $mId
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $retailer = Merchant::where('slug', $slug)->first();

        return view('shopfront.retailers.show')->with(compact('retailer'));
    }
}