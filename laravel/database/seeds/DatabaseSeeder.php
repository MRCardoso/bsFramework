<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

//        $this->call(CorporateRegisterTableSeeder::class);
//        $this->call(UserTableSeeder::class);
        $this->call(ClientTableSeeder::class);
        $this->call(CompanyTableSeeder::class);
        $this->call(ProductTableSeeder::class);
        $this->call(DeliverymanTableSeeder::class);
        $this->call(RequestTableSeeder::class);

        Model::reguard();
    }
}
