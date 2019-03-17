<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id');
            $table->string('mpn');
            $table->string('gtin');
            $table->string('ean');
            $table->string('isbn');
            $table->string('upc');
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
        Schema::dropIfExists('product_codes');
    }
}
