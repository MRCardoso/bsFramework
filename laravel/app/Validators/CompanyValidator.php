<?php
/*
 * | ------------------------------------------------------------ |
 * | Validate back-end submit of the form before save in database |
 * | ------------------------------------------------------------ |
 */
namespace App\Validators;

use Prettus\Validator\LaravelValidator;

class CompanyValidator extends LaravelValidator
{
    protected $rules = [
        "corporate_register_id"     => "required|integer",
        "user_id"                   => "required|integer",
        "name"                      => "required|max:90",
        "cnpj"                      => "required|with_mask:14",
        "address"                   => "max:120",
        "phone"                     => "with_mask:11",
        "email"                     => "max:90|email",
        "start_date"                => "dateValid",
        "end_date"                  => "dateValid",
    ];
}