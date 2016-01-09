<?php
/*
 | ---------------------------------------------------------------------------------
 | Layer Validator
 | ---------------------------------------------------------------------------------
 | generate the validators and labels for model user
*/
namespace app\validators;


class ProductValidator
{
    public static function getRules()
    {
        return [
            [['name', 'size', 'status'], 'required', 'on' => 'save'],
            [['corporate_register_id', 'size', 'status'], 'integer', 'on' => 'save'],
            [['cost'], 'number'],
            [['name', 'cost', 'size', 'status'], 'safe'],
            [['name'], 'string', 'max' => 90],
            [['description'], 'string', 'max' => 180]
        ];
    }

    public static function getLabels()
    {
        return [
            'id' => t('id'),
            'corporate_register_id' => t('Corporate Register ID'),
            'name' => t('Name'),
            'description' => t('Description'),
            'cost' => t('Cost'),
            'size' => t('Size'),
            'status' => t('Status'),
            'created_at' => t('Created At'),
            'updated_at' => t('Updated At'),
        ];
    }
}