<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\User;
use App\Price;
use App\Merchant;
use App\ProductImageLink;
use App\Brand;

class DashboardController extends Controller
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
    public function index(Request $request)
    {
        
        $request->user()->authorizeRoles(['employee', 'manager']);

        $total_products = Product::count();
        $total_users = User::count();
        $total_prices = Price::count();
        $total_merchants = Merchant::count();
        $total_images_to_download = ProductImageLink::where('is_downloaded', '=', '0')->count();
        $total_brands = Brand::count();
        return view('admin.dashboard.index')->with(compact('total_merchants','total_prices', 'total_products', 'total_users', 'total_images_to_download', 'total_brands'));
    }

}