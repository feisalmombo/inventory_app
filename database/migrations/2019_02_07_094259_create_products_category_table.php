<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_category', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->timestamps();

                
            $table->foreign('product_id')
            ->references('id')->on('products')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreign('category_id')
            ->references('id')->on('categories')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            //$table->primary(['product_id','category_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products_category');
    }
}
