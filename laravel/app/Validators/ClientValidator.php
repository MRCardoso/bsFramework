<?php
/*
 * | ------------------------------------------------------------ |
 * | Validate back-end submit of the form before save in database |
 * | ------------------------------------------------------------ |
 */
namespace App\Validators;

use Prettus\Validator\LaravelValidator;

class ClientValidator extends LaravelValidator
{
    protected $rules = [
        "corporate_register_id" => "required|integer",
        "user_id"               => "required|integer",
        "city"              => "max:90",
        "name"              => "required|max:180",
        "phone"             => "max:15",
        "number"            => "integer",
        "address"           => "max:90",
        "reference"         => "max:60",
        "neightborhood"     => "max:90",
    ];
}