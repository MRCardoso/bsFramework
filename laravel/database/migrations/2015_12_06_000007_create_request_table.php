<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('request', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('corporate_register_id');
            $table->integer('user_id');
            $table->integer('deliveryman_id');
            $table->integer('client_id');
            $table->integer('product_id');
            $table->integer('quantity');
            $table->decimal('price');
            $table->string('description')->nullable();
            $table->date('request_date')->nullable();
            $table->decimal('freight')->nullable();
            $table->text('observation')->nullable();
            $table->decimal('discount')->nullable();
            $table->integer('situation'); // 1 - pending | 2 - in transit | 3 - canceled | 4 - delivered
            $table->timestamps();

            // corporate_register_id connect with table corporate_register
            $table->foreign('corporate_register_id')
                ->references('id')
                ->on('corporate_register')
                ->onDelete('cascade');
            // deliveryman_id connect with table deliveryman
            $table->foreign('deliveryman_id')
                ->references('id')
                ->on('deliveryman')
                ->onDelete('cascade');
            // client_id connect with table client
            $table->foreign('client_id')
                ->references('id')
                ->on('client')
                ->onDelete('cascade');
            // product_id connect with table product
            $table->foreign('product_id')
                ->references('id')
                ->on('product')
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
        Schema::drop('request');
    }
}
