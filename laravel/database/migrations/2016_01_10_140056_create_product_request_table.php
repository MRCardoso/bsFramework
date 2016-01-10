<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_request', function (Blueprint $table) {
            $table->integer("product_id");
            $table->integer("request_id");
            $table->integer('quantity');
            $table->decimal('price');

            $table->foreign("product_id")->references('id')->on('product')->onDelete('cascade');
            $table->foreign("request_id")->references('id')->on('request')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('product_request');
    }
}
