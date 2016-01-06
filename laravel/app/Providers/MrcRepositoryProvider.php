<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MrcRepositoryProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \App\Repositories\ClientRepository::class,
            \App\Repositories\ClientRepositoryEloquent::class
        );
        $this->app->bind(
            \App\Repositories\CompanyRepository::class,
            \App\Repositories\CompanyRepositoryEloquent::class
        );
        $this->app->bind(
            \App\Repositories\ProductRepository::class,
            \App\Repositories\ProductRepositoryEloquent::class
        );
        $this->app->bind(
            \App\Repositories\DeliverymanRepository::class,
            \App\Repositories\DeliverymanRepositoryEloquent::class
        );
        $this->app->bind(
            \App\Repositories\RequestRepository::class,
            \App\Repositories\RequestRepositoryEloquent::class
        );
        $this->app->bind(
            \App\Repositories\UserRepository::class,
            \App\Repositories\UserRepositoryEloquent::class
        );
        $this->app->bind(
            \App\Repositories\CorporateRegisterRepository::class,
            \App\Repositories\CorporateRegisterRepositoryEloquent::class
        );
    }
}
