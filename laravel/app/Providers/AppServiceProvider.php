<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('with_mask', 'App\\Validators\\Validator@validate');
        Validator::extend('uniqueUser', 'App\\Validators\\Validator@uniqueUser');
        Validator::replacer('with_mask', 'App\\Validators\\Validator@replace');
        Blade::extend(function ($value) {
            return preg_replace('/(\s*)@(break|continue)(\s*)/', '$1<?php $2; ?>$3', $value);
        });
    }
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        config('config/constants.php');
    }
}
