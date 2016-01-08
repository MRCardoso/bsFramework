<?php
/*
 * | ------------------------------------------------------------ |
 * | Validate back-end submit of the form before save in database |
 * | ------------------------------------------------------------ |
 */
namespace App\Validators;

use Prettus\Validator\LaravelValidator;

class RequestValidator extends LaravelValidator
{
    protected $rules = [
        "corporate_register_id" => "integer|required",
        "user_id"               => "integer|required",
        "deliveryman_id"        => "integer|required",
        "client_id"             => "integer|required",
        "product_id"            => "integer|required",
        "quantity"              => "integer|required",
        "price"                 => "required|regex:/^\d*(\.\d{0,3})?(\.\d{0,3})?(\,\d{2})?$/",
        "freight"               => "regex:/^\d*(\.\d{0,3})?(\.\d{0,3})?(\,\d{2})?$/",
        "discount"              => "regex:/^\d*(\.\d{0,3})?(\.\d{0,3})?(\,\d{2})?$/",
        "situation"             => "integer|required",
        "description"           => "max:255"
    ];
}