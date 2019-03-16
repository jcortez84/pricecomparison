<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prices', function (Blueprint $table) {
            $table->increments('id', 15);
            $table->integer('product_id')->unsigned();
            $table->string('merchant_id', 11);
            $table->unsignedDecimal('amount', 9,2);
            $table->unsignedDecimal('shipping', 9,2);
            $table->string('product_title');
            $table->string('promo_text');
            $table->string('buy_link');
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
        Schema::dropIfExists('prices');
    }
}
