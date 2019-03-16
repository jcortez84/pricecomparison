<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id');
            $table->string('title');
            $table->string('slug');
            $table->string('mpn');  // Manufacturer Part Number
            $table->string('ean');  // European Article Number
            $table->string('upc');  // Universal Product Code
            $table->string('gtin'); // Global Trade Item Number
            $table->string('isbn'); // Internationl Standard Book Number
            $table->text('description');
            $table->unsignedDecimal('min_price', 9, 2);
            $table->unsignedDecimal('max_price', 9, 2);
            $table->integer('brand_id');
            $table->softDeletes();
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
        Schema::dropIfExists('products');
    }
}
