<?php
/**
 * Created by PhpStorm.
 * User: mrcardoso
 * Date: 27/11/15
 * Time: 23:02
 */

namespace App\Validators;


use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class UserValidator extends LaravelValidator
{
    protected $rules = [
        'corporate_register_id' => 'required',
        'username' => 'required|uniqueUser',
        'name' => 'required|max:255',
        'group' => 'required',
        'password' => 'required|confirmed|min:6',
        'email' => 'required|email|max:255|uniqueUser',
    ];
    public function prepareRules( $update = false)
    {
        if( $update )
        {
            $this->rules["password"] = 'confirmed|min:6';
        }
    }
}