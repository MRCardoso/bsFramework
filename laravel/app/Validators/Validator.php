<?php

namespace App\Validators;

use App\Entities\Deliveryman;
use App\Entities\User;
use App\Entities\Company;
use App\Http\Requests\Request;
use App\Services\UserService;
use Carbon\Carbon;
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

    public function uniqueField($attribute, $value, $parameters)
    {
        $model = NULL;
        $regex = "(\)|\(| |\/|\.|-)";

        if ( !isset($parameters[0]) )
            $model = User::where($attribute, $value);
        elseif ( isset($parameters[0]) && $parameters[0] == "company" )
            $model = Company::where($attribute, preg_replace($regex,"",$value));
        elseif ( isset($parameters[0]) && $parameters[0] == "deliveryman" )
            $model = Deliveryman::where($attribute, preg_replace($regex,"",$value));
        
        if( $model != NULL )
        {
            if( Input::get('id') != null )
                $model = $model->where('id', '<>', intval(Input::get('id')));

            return count($model->get()) == 0;
        }
        return false;
    }
    public function validGroup($attribute, $value, $parameters)
    {

        $groupAllow = UserService::groupAllow();
        if( isset($parameters[0]) && $parameters[0] == "signup")
        {
            array_splice($groupAllow,0,1);
        }
        return ( in_array($value, $groupAllow) );
    }

    public function dateValid($attribute, $value, $parameters)
    {
        $start_date = (request("start_date") != "" ? Carbon::createFromFormat('d/m/Y', request("start_date"))->format('Y-m-d') : NULL);
        $end_date = (request("end_date") != "" ? Carbon::createFromFormat('d/m/Y', request("end_date"))->format('Y-m-d') : NULL);

        if( $end_date != NULL )
        {
            if( $start_date == NULL )
                return false;
            if( $start_date > $end_date )
                return false;
            if( $end_date < $start_date )
                return false;
        }
        return true;
    }
}