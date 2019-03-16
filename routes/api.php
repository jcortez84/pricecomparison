<?php

use Illuminate\Http\Request;
use App\Product;
use App\Price;
use App\Merchant;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


 
Route::get('products/{cat_id}', 'ProductsController@api_category_products')->name('category_products');
Route::get('brand-products/{brad_id}', 'ProductsController@api_brand_products')->name('brand_products');
Route::get('retailer-products/{mId}', 'ProductsController@api_retailer_products')->name('retailer_products');

Route::get('product/{id}', 'ProductsController@api_show')->name('get_product');
  
Route::get('prices/{prod_id}', 'PricesController@api_show')->name('get_prices');

Route::get('product-images/{prod_id}', 'ProductsController@api_show_images')->name('get_images');

Route::get('search/{q}', 'ResultsController@search')->name('search');

Route::get('top-products', 'ProductsController@api_top_products')->name('top_products');

Route::get('feat-products', 'ProductsController@api_featured_products')->name('featured_products');
 
// Route::post('products', function() {
//     return  response()->json([
//             'message' => 'Create success'
//         ], 201);
// });
 
// Route::put('products/{product}', function() {
//     return  response()->json([
//             'message' => 'Update success'
//         ], 200);
// });
 
// Route::delete('products/{product}',function() {
//     return  response()->json(null, 204);
// });