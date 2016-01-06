<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('corporate_register_id');
            $table->integer('user_id');
            $table->string('name', 90);
            $table->string('cnpj',14);
            $table->string('address', 120)->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('phone', 14)->nullable();
            $table->string('email',90)->nullable();
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
        Schema::drop('company');
    }
}
