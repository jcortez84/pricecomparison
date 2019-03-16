<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchants', function (Blueprint $table) {
            $table->string('id', 11)->index();
            $table->integer('user_id')->unsigned();
            $table->string('name', 50);
            $table->string('slug', 50);
            $table->string('logo');
            $table->string('url', 60);
            $table->string('email', 60);
            $table->string('address_line_1', 50);
            $table->string('address_line_2', 50);
            $table->string('county', 30);
            $table->string('city', 30);
            $table->string('post_code', 15);
            $table->string('strapline');
            $table->text('description');
            $table->enum('is_valid', [1, 0]);
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
        Schema::dropIfExists('merchants');
    }
}
