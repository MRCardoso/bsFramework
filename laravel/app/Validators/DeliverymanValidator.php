<?php
/*
 | ------------------------------------------------------------
 | Validator Layer
 | ------------------------------------------------------------
 | Validate back-end submit of the form before save in database
 |
 */
namespace App\Validators;

use Prettus\Validator\LaravelValidator;

class DeliverymanValidator extends LaravelValidator
{
    protected $rules = [
        "corporate_register_id"         => "required|integer",
        "user_id"                       => "required|integer",
        "company_id"                    => "required|integer",
        "name"                          => "required|max:255",
        "cpf"                           => "required|with_mask:11",
        "rg"                            => "max:18",
        "cellphone"                     => "with_mask:11",
    ];
}