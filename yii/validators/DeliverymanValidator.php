<?php
/*
 | ---------------------------------------------------------------------------------
 | Layer Validator
 | ---------------------------------------------------------------------------------
 | generate the validators and labels for model user
*/
namespace app\validators;


use yiibr\brvalidator\CpfValidator;

class DeliverymanValidator
{
    public static function getRules()
    {
        return [
            [['company_id', 'name', 'cpf', 'status'], 'required', 'on' => 'save'],
            [['corporate_register_id', 'company_id', 'status'], 'integer', 'on' => 'save'],
            [['company_id', 'status', 'name', 'companyName','cpf'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['cpf'], 'string', 'on' => 'save'],
            [['cellphone','cpf'],'validateNoMask', 'on' => 'save'],
            ['cpf', CpfValidator::className(), 'on' => 'save'],
            ['cpf', 'unique'],
            [['rg'], 'string', 'max' => 18, 'on' => 'save'],
            [['cellphone'], 'string', 'max' => 15, 'on' => 'save']
        ];
    }
    public static function getLabels()
    {
        return [
            'id' => t('ID'),
            'corporate_register_id' => t('Corporate Register ID'),
            'company_id' => t("company"),
            'name' => t('Name'),
            'cpf' => t('Cpf'),
            'rg' => t('Rg'),
            'cellphone' => t('Cellphone'),
            'status' => t('Status'),
            'created_at' => t('Created At'),
            'updated_at' => t('Updated At'),
        ];
    }
}