<?php
/*
 | ---------------------------------------------------------------------------------
 | Layer Validator
 | ---------------------------------------------------------------------------------
 | generate the validators and labels for model user
*/
namespace app\validators;

class UserValidator
{
    public static function getRules()
    {
        return [
            [['name', 'group', 'email', 'username', 'password'], 'required', 'on' => 'create'],
            [['name', 'group', 'email', 'username'], 'required', 'on' => 'save'],
            [['corporate_register_id'], 'integer', 'on' => 'corporateSave'],
            [['corporate_register_id'], 'required', 'on' => 'corporateSave'],
            [['corporate_register_id', 'status','created_at', 'updated_at'], 'safe'],
            [['name', 'group', 'email', 'username'], 'string', 'max' => 255],
            [['password'], 'string', 'max' => 60],
            [['remember_token'], 'string', 'max' => 100],
            [['email'], 'unique'],
            [['email'], 'email', 'on' => ['create', 'save']],
            [['username'], 'unique']
        ];
    }
    public static function getLables()
    {
        return [
            'id' => t('ID'),
            'corporate_register_id' => t('Corporate Register'),
            'name' => t('Name'),
            'group' => t('Group'),
            'email' => t('Email'),
            'username' => t('Username'),
            'password' => t('Password'),
            'remember_token' => t('Remember Token'),
            'created_at' => t('Created At'),
            'updated_at' => t('Updated At'),
        ];
    }
}