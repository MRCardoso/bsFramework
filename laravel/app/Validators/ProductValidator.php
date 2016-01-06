<?php
/*
 * | ------------------------------------------------------------ |
 * | Validate back-end submit of the form before save in database |
 * | ------------------------------------------------------------ |
 */
namespace App\Validators;

use Prettus\Validator\LaravelValidator;

class ProductValidator extends LaravelValidator
{
    protected $rules = [
        "corporate_register_id"  => "required|integer",
        "user_id"                => "required|integer",
        "name"                   => "required|max:90",
        "description"            => "max:180",
        "size"                   => "required|integer",
        "cost"                   => "regex:/^\d*(\.\d{0,3})?(\.\d{0,3})?(\,\d{2})?$/"
    ];
}