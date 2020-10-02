<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->index()->unsigned();
            $table->integer('pro_status_id')->index()->unsigned();
            $table->integer('bank_id')->index()->unsigned()->default(21);
            $table->integer('pro_quantity')->default(1);
            $table->integer('user_id')->index()->unsigned();
            $table->boolean('request_status')->default(0); // 0 - Requested  1 - Confirmed
            $table->timestamps();

            $table->foreign('product_id')
            ->references('id')->on('products')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreign('pro_status_id')
            ->references('id')->on('product_statuses')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreign('bank_id')
            ->references('id')->on('banks')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreign('user_id')
            ->references('id')->on('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            //$table->primary(['id','product_id','pro_status_id','bank_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('request_products');
    }
}
