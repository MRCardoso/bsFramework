<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliverymanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliveryman', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('corporate_register_id');
            $table->integer('user_id');
            $table->integer('company_id');
            $table->string('name');
            $table->string('cpf', 11);
            $table->string('rg', 18)->nullable();
            $table->string('cellphone', 15)->nullable();
            // 0 - inactive | 1 - active
            $table->integer('status')->default(1);
            $table->timestamps();

            $table->foreign('corporate_register_id')->references('id')->on('corporate_register')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('company')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('deliveryman');
    }
}
