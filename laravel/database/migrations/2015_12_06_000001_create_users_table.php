<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('corporate_register_id');
            $table->string('name');
            $table->string('group');
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->string('password', 60);
            $table->integer('status')->default(1);
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('corporate_register_id')
                ->references('id')
                ->on('corporate_register')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user');
    }
}
