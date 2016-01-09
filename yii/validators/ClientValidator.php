<?php
/*
 | ---------------------------------------------------------------------------------
 | Layer Validator
 | ---------------------------------------------------------------------------------
 | generate the validators and labels for model user
*/
namespace app\validators;


class ClientValidator
{
    public static function getRules()
    {
        return [
            [['name','status'], 'required', 'on' => 'save'],
            [['number', 'status'], 'integer', 'on' => 'save'],
            [['name', 'status', 'birthday'], 'safe'],
            [['name'], 'string', 'max' => 180],
            [['phone'], 'string'],
            ['phone', 'validateNoMask', 'on' => 'save'],
            [['address', 'neightborhood', 'city'], 'string', 'max' => 90],
            [['reference'], 'string', 'max' => 60]
        ];
    }

    public static function getLabels()
    {
        return [
            'id' => t('id'),
            'name' => t('Name'),
            'phone' => t('Phone'),
            'birthday' => t('Birthday'),
            'address' => t('Address'),
            'number' => t('Number'),
            'neightborhood' => t('Neightborhood'),
            'city' => t('City'),
            'reference' => t('Reference'),
            'status' => t('Status'),
            'created_at' => t('Created At'),
            'updated_at' => t('Updated At'),
        ];
    }
}