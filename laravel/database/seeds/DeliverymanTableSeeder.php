<?php

use Illuminate\Database\Seeder;
use App\Entities\Deliveryman;

class DeliverymanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("TRUNCATE TABLE \"deliveryman\" CASCADE");
        factory(Deliveryman::class,20)->create();
    }
}
