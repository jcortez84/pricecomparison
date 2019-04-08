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

        $prices = Merchant::join('prices', function ($join) {
            $join->on('merchants.id', '=','prices.merchant_id' )
                 ->where('product_id', $this->prod_id);
        })->orderByRaw(('amount+shipping'), 'asc')->get();
        return response($prices, 200);
    }

}