<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatternsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patterns', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('company_id');
            $table->string('redirect_url');
            $table->string('company_product_id')->nullable();
            $table->string('price')->nullable();
            $table->string('size_type')->nullable();
            $table->string('format')->nullable();
            $table->string('category')->nullable();
            $table->string('image_url')->nullable();
            $table->string('description', 3000)->nullable();
            $table->string('supplies', 3000)->nullable();
            $table->string('language')->nullable();
            $table->string('full_description', 3000)->nullable();
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
        Schema::dropIfExists('patterns');
    }
}
