<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddComissionToDeliverymanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deliveryman', function (Blueprint $table) {
            $table->string('salary_type', 16)->nullable();
            $table->decimal('salary_value')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deliveryman', function (Blueprint $table) {
            $table->dropColumn(['salary_type', 'salary_value']);
        });
    }
}
