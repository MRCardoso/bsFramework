<?php

use Illuminate\Database\Seeder;
use App\Entities\Client;

class ClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("TRUNCATE TABLE \"client\" CASCADE");
        factory(Client::class,20)->create();
    }
}