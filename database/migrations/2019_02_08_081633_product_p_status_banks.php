<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductPStatusBanks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_status_banks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->index()->unsigned();
            $table->integer('pstatus_id')->index()->unsigned();
            $table->integer('bank_id')->index()->unsigned()->default(21);
            $table->timestamps();

            $table->foreign('product_id')
            ->references('id')->on('products')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreign('pstatus_id')
            ->references('id')->on('product_statuses')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreign('bank_id')
            ->references('id')->on('banks')
            ->onUpdate('cascade')
            ->onDelete('cascade');

           // $table->primary(['id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products_status_banks');
    }
}
