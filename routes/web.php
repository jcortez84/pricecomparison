<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/c/{slug}', 'CategoriesController@show')->name('category');
Route::get('/compare/{slug}/prices', 'ProductsController@show')->name('product');
Route::get('/gotostore/{id}', 'ProductsController@goToStore')->name('gotostore');
Route::get('/page/{slug}', 'PagesController@show')->name('page');
Route::get('/categories', 'CategoriesController@index')->name('categories');
Route::get('/brands', 'BrandsController@index')->name('brands');
Route::get('/brand/{name}', 'BrandsController@show')->name('brand');
Route::get('/retailers', 'RetailersController@index')->name('retailers');
Route::get('/retailer/{slug}', 'RetailersController@show')->name('retailer');
Route::get('/results', 'ResultsController@index')->name('results');
Route::post('/set-price-alert', 'AlertsController@store')->name('set_alert');
Route::get('/contact', 'MessagesController@create')->name('contact');
Route::post('/contact', 'MessagesController@store')->name('contact_store');


/**
 * Admin routes declared below.
 */
Route::get('/admin', 'Admin\DashboardController@index');
Route::resource('/admin/clicks', 'Admin\ClicksController');
Route::resource('/admin/datafeeds', 'Admin\DatafeedsController');
Route::resource('/admin/matches', 'Admin\MatchesController');
Route::resource('/admin/merchants', 'Admin\MerchantsController');
Route::resource('/admin/pages', 'Admin\PagesController');
Route::resource('/admin/prices', 'Admin\PricesController');
Route::get('/admin/products/delete-without-prices', 'Admin\ProductsController@batchDelete');
Route::resource('/admin/products', 'Admin\ProductsController');
Route::get('/admin/merge-products', 'Admin\ProductsController@merge_index');
Route::post('/admin/merge-products', 'Admin\ProductsController@merge_store');
Route::get('/admin/bulk-products', 'Admin\ProductsController@bulk_index');
Route::post('/admin/bulk-products', 'Admin\ProductsController@bulk_move');
Route::resource('/admin/categories', 'Admin\CategoriesController');
Route::resource('/admin/users', 'Admin\UsersController');
Route::resource('/admin/reports', 'Admin\ReportsController');
Route::resource('/admin/migrations', 'Admin\MigrationController');

Route::get('/admin/set_prices/{id}', 'Admin\ProductsController@set_min_max_price');
Route::get('/admin/set_all_prices', 'Admin\ProductsController@profile_all_prices');
Route::get('/admin/image/{id}/download', 'Admin\ImagesController@download');
Route::get('/admin/images/download-all', 'Admin\ImagesController@downloadAll');
Route::resource('/admin/images', 'Admin\ImagesController');


/**
 * Admin routes for processing CSV files
 */
Route::get('/admin/categories-csv', 'Admin\CategoriesController@csvform');
Route::post('/admin/categories-csv', 'Admin\CategoriesController@csvStore');

Route::get('/admin/merchants-csv', 'Admin\MerchantsController@csvform');
Route::post('/admin/merchants-csv', 'Admin\MerchantsController@csvStore');

Route::get('/admin/products-csv', 'Admin\ProductsController@csvform');
Route::post('/admin/products-csv', 'Admin\ProductsController@csvStore');

Route::get('/admin/prices-csv', 'Admin\PricesController@csvform');
Route::post('/admin/prices-csv', 'Admin\PricesController@csvStore');

/**
 * Custom routes
 */
Route::get('/admin/datafeed/{id}/test', 'Admin\DatafeedsController@test');
Route::get('/admin/datafeed/{id}/run', 'Admin\DatafeedsController@run');

Route::post('/admin/datafeed/{id}/test', 'Admin\DatafeedsController@testCreate');
Route::post('/admin/datafeed/{id}/run', 'Admin\DatafeedsController@run');

/**
 * SSH routes
 */
Route::get('/admin/prices-ssh/{id}/run', 'Admin\PriceUpdatesController@run');
Route::get('/admin/prices-ssh-all', 'Admin\PriceUpdatesController@runAll');

Route::get('/admin/products-ssh/{id}/run', 'Admin\SSHProductsController@run');
Route::get('/admin/products-ssh-all', 'Admin\SSHProductsController@runAll');