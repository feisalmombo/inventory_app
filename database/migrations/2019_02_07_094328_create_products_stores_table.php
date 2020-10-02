<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_stores', function (Blueprint $table) {
            $table->integer('product_id')->unsigned();
            $table->integer('store_id')->unsigned();
            $table->timestamps();

                
            $table->foreign('product_id')
            ->references('id')->on('products')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreign('store_id')
            ->references('id')->on('stores')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->primary(['product_id','store_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products_stores');
    }
}
