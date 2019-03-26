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
            $table->unsignedInteger('user_id')->unsigned();
            $table->string('name', 50);
            $table->string('slug', 50);
            $table->string('logo')->nullable();
            $table->string('url', 60)->nullable();
            $table->string('email', 60)->nullable();
            $table->string('address_line_1', 50)->nullable();
            $table->string('address_line_2', 50)->nullable();
            $table->string('county', 30)->nullable();
            $table->string('city', 30)->nullable();
            $table->string('post_code', 15)->nullable();
            $table->string('strapline')->nullable();
            $table->text('description')->nullable();
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
