<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Price;
use App\Merchant;

class PricesController extends Controller
{
    private $prod_id;
    /**
     * Display the specified resource.
     *
     * @param  int  $prod_id
     * @return \Illuminate\Http\Response
     */
    public function api_show($prod_id)
    {
        $this->prod_id = $prod_id;

        $prices = Price::join('merchants', function ($join) {
            $join->on('prices.merchant_id', '=', 'merchants.mId')
                 ->where('product_id', $this->prod_id);
        })->orderBy('amount', 'asc')->get();
        return response($prices, 200);
    }

}