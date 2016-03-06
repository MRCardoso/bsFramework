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
        Validator::extend('uniqueField', 'App\\Validators\\Validator@uniqueField');
        Validator::extend('validGroup', 'App\\Validators\\Validator@validGroup');
        Validator::extend('dateValid', 'App\\Validators\\Validator@dateValid');
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
