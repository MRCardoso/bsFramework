<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
//*/

$user = App\Entities\User::orderByRaw("RANDOM()")->first();
$factory->define(App\Entities\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'username' => $faker->name,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});
$factory->define(App\Entities\Client::class, function (Faker\Generator $faker) use ($user) {
    return [
        'user_id' => $user->id,
        'name' => $faker->name,
        'phone' => Faker\Provider\pt_BR\PhoneNumber::landlineNumber(false),
        'address' => $faker->streetName,
        'number' => $faker->buildingNumber,
        'neightborhood' => $faker->citySuffix,
        'city' => $faker->city,
        'reference' => $faker->word,
        'birthday' => $faker->date()
    ];
});
$factory->define(App\Entities\Company::class, function (Faker\Generator $faker) use($user){
    return [
        'user_id' => $user->id,
        'name' => $faker->company,
        'cnpj' => Faker\Provider\pt_BR\PhoneNumber::landlineNumber(false).'1239',
        'address' => $faker->address,
        'phone' => Faker\Provider\pt_BR\PhoneNumber::landlineNumber(false),
        'email' => $faker->email
    ];
});
$factory->define(App\Entities\Product::class, function (Faker\Generator $faker) use($user){
    return [
        'user_id' => $user->id,
        'name' => $faker->word,
        'description' => $faker->sentence(),
        'size' => random_int(1,3),
        'cost' => rand(10.00,100.00),
    ];
});
$factory->define(App\Entities\Deliveryman::class, function (Faker\Generator $faker) use($user){
    $company = App\Entities\Company::orderByRaw("RANDOM()")->first();
    return [
        'user_id' => $user->id,
        'company_id' => $company->id,
        'name' => $faker->name,
        'cpf' => rand(12345678910,19345678910),
        'rg' => rand(12345679,23545678910),
        'cellphone' => Faker\Provider\pt_BR\PhoneNumber::landlineNumber(false),
    ];
});
$factory->define(App\Entities\Request::class, function (Faker\Generator $faker) use($user){

    $client = App\Entities\Client::orderByRaw("RANDOM()")->first();
    $deliveryman = App\Entities\Deliveryman::orderByRaw("RANDOM()")->first();
    $product = App\Entities\Product::orderByRaw("RANDOM()")->first();

    return [
        'user_id' => $user->id,
        'deliveryman_id' => $deliveryman->id,
        'client_id' => $client->id,
        'product_id' => $product->id,
        'description' => $faker->word,
        'request_date' => date('Y-m-d'),
        'quantity' => rand(0,10),
        'price' => rand(10.00,500.00),
        'situation' => random_int(1,4)
    ];
});
$factory->define(App\Entities\CorporateRegister::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'code' => $faker->word,
        'status' => rand(0,1)
    ];
});