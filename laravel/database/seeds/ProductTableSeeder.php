<?php

use Illuminate\Database\Seeder;
use App\Entities\Product;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("TRUNCATE TABLE \"product\" CASCADE");
        factory(Product::class,20)->create();
    }
}
