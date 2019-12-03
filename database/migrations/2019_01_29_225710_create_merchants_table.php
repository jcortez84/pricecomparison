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
            $table->string('name');
            $table->string('slug');
            $table->string('logo')->nullable();
            $table->string('url')->nullable();
            $table->string('email')->nullable();
            $table->string('address_line_1')->nullable();
            $table->string('address_line_2')->nullable();
            $table->string('county')->nullable();
            $table->string('city')->nullable();
            $table->string('post_code')->nullable();
            $table->string('strapline')->nullable();
            $table->text('description')->nullable();
            $table->enum('is_valid', [1, 0])->default(1);
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
