<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('corporate_register_id');
            $table->integer('user_id');
            $table->string('name', 90);
            $table->string('description', 180)->nullable();
            $table->decimal('cost', 12, 2)->nullable();
            // 1 - small | 2 - average | 3 - big
            $table->integer('size');
            // 0 - inactive | 1 - active
            $table->integer('status')->default(1);
            $table->timestamps();

            $table->foreign('corporate_register_id')->references('id')->on('corporate_register')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('product');
    }
}
