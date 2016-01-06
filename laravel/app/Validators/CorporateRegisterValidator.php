<?php
namespace App\Validators;

use Prettus\Validator\LaravelValidator;

class CorporateRegisterValidator extends LaravelValidator
{
    protected $rules = [
        "name" => "required",
        "code" => "required",
        "status" => "integer"
    ];
}