<?php

use Illuminate\Database\Seeder;
use App\Entities\Company;
class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("TRUNCATE TABLE \"company\" CASCADE");
        factory(Company::class,20)->create();
    }
}
