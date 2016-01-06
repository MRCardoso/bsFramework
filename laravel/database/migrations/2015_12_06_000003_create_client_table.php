<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('corporate_register_id');
            $table->integer('user_id');
            $table->string('name',180);
            $table->string('phone', 15)->nullable();
            $table->date('birthday')->nullable();
            $table->string('address',90)->nullable();
            $table->integer('number')->nullable();
            $table->string('neightborhood',90)->nullable();
            $table->string('city',90)->nullable(); // city - state
            $table->string('reference',60)->nullable();
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
        Schema::drop('client');
    }
}
