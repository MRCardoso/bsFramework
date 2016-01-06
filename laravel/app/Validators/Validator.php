<?php

namespace App\Validators;

use App\Entities\User;
use Illuminate\Support\Facades\Input;
use Prettus\Validator\LaravelValidator;

class Validator extends LaravelValidator
{
    public function validate($attribute,$value,$parameters)
    {
        $regex = "(\)|\(| |\/|\.|-)";
        if($attribute=="cpf")
            return strlen(preg_replace($regex,"",$value)) == $parameters[0];
        elseif($attribute=="cnpj")
            return strlen(preg_replace($regex,"",$value)) == $parameters[0];
        elseif($attribute=="phone")
            return !(strlen(preg_replace($regex,"",$value)) > $parameters[0]);
        return true;
    }
    public function replace($message, $attribute, $rule, $parameters)
    {
        return str_replace(':parameter', $parameters[0], $message);
    }

    public function uniqueUser($attribute, $value, $parameters)
    {
        $user = User::where($attribute, $value);

        if( Input::get('id') != null )
            $user = $user->where('id', '<>', intval(Input::get('id')));

        return count($user->get()) == 0;
    }
}