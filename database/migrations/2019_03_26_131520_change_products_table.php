<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('category_id');
            $table->string('title');
            $table->string('slug');
            $table->string('mpn', 50)->nullable();  // Manufacturer Part Number
            $table->string('ean', 50)->nullable();  // European Article Number
            $table->string('upc', 50)->nullable();  // Universal Product Code
            $table->string('gtin', 50)->nullable(); // Global Trade Item Number
            $table->string('isbn', 50)->nullable(); // Internationl Standard Book Number
            $table->text('description')->nullable();
            $table->unsignedDecimal('min_price', 9, 2);
            $table->unsignedDecimal('max_price', 9, 2);
            $table->integer('brand_id')->nullable();
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
