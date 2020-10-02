<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdCondCommeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prod_cond_comme', function (Blueprint $table) {
            $table->increments('id');
           $table->integer('product_id')->unsigned();
            $table->integer('comment_id')->unsigned();
            $table->integer('condition_id')->index()->unsigned();
            $table->timestamps();

            $table->foreign('product_id')
            ->references('id')->on('products')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreign('comment_id')
            ->references('id')->on('comments')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreign('condition_id')
            ->references('id')->on('conditions')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            //$table->primary(['id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prod_cond_comme');
    }
}
