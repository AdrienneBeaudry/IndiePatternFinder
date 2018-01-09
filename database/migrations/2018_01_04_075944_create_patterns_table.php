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
            $table->unsignedInteger('company_id', false);
            $table->string('redirect_url');
            $table->string('company_pattern_id')->nullable();
            // PRICE below
            // change to decimal('price', 12, 4) when figure out how to remove price range in Named
            // and dealing with different currencies
            $table->string('price')->nullable();
            $table->string('size_type', 100)->nullable();
            $table->tinyInteger('format', false, true)->nullable();
            $table->unsignedInteger('category_id', false)->nullable();
            $table->string('image_url')->nullable();
            $table->text('description')->nullable();
            $table->text('supplies')->nullable();
            $table->string('language')->nullable();
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
