<?php
/**
 * Created by PhpStorm.
 * User: mrcardoso
 * Date: 01/01/16
 * Time: 20:05
 */

namespace app\validators;


class CorporateRegisterValidator
{
    public static function getRules()
    {
        return [
            [['name', 'code'], 'required', 'on' => 'save'],
            [['status', 'created_at', 'updated_at'], 'safe'],
            [['name', 'code'], 'string', 'max' => 255],
            [['code'], 'unique']
        ];
    }

    public static function getLabels()
    {
        return [
            'id' => t('ID'),
            'name' => t('Name'),
            'code' => t('Code'),
            'status' => t('Status'),
            'created_at' => t('Created At'),
            'updated_at' => t('Updated At'),
        ];
    }
}