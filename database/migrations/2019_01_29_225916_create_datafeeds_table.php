<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatafeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datafeeds', function (Blueprint $table) {
            $table->increments('id');
            $table->string('merchant_id');
            $table->text('url');
            $table->tinyInteger('column_name')->unsigned()->nullable();
            $table->tinyInteger('column_description')->unsigned()->nullable();
            $table->tinyInteger('column_price')->unsigned()->nullable();
            $table->tinyInteger('column_category_name')->unsigned()->nullable();
            $table->tinyInteger('column_category_id')->unsigned()->nullable();
            $table->tinyInteger('column_shipping')->unsigned()->nullable();
            $table->tinyInteger('column_buy_url')->unsigned()->nullable();
            $table->tinyInteger('column_promo')->unsigned()->nullable();
            $table->tinyInteger('column_image_url')->unsigned()->nullable();
            $table->tinyInteger('column_mpn')->unsigned()->nullable();
            $table->tinyInteger('column_upc')->unsigned()->nullable();
            $table->tinyInteger('column_isbn')->unsigned()->nullable();
            $table->tinyInteger('column_ean')->unsigned()->nullable();
            $table->tinyInteger('column_gtin')->unsigned()->nullable();
            $table->tinyInteger('column_brand')->unsigned()->nullable();
            $table->enum('add_new_products', ['1', '0']);
            $table->enum('match_by', ['mpn', 'ean', 'isbn', 'upc', 'gtin', 'name']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('datafeeds');
    }
}
