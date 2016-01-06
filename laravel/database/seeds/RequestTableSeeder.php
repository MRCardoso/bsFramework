<?php

use Illuminate\Database\Seeder;
use App\Entities\Request;

class RequestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("TRUNCATE TABLE \"request\" CASCADE");
        factory(Request::class,20)->create();
    }
}
