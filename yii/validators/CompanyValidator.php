<?php
/*
 | ---------------------------------------------------------------------------------
 | Layer Validator
 | ---------------------------------------------------------------------------------
 | generate the validators and labels for model user
*/
namespace app\validators;


use yiibr\brvalidator\CnpjValidator;

class CompanyValidator
{
    public static function getRules()
    {
        return [
            [['name', 'cnpj', 'status'], 'required', 'on' => 'save'],
            [['id', 'corporate_register_id', 'status'], 'integer', 'on' => 'save'],
            [['name', 'status', 'cnpj', 'address', 'start_date', 'end_date', 'phone', 'email', 'created_at', 'updated_at'], 'safe'],
            [['name', 'email'], 'string', 'max' => 90],
            [['cnpj', 'phone'], 'string'],
            ['cnpj', CnpjValidator::className(), 'on' => 'save'],
            [['cnpj', 'phone'],'validateNoMask', 'on' => 'save'],
            ['cnpj', 'unique'],
            [['address'], 'string', 'max' => 120],
            [['email'], 'email']
        ];
    }
    public static function getLabels()
    {
        return [
            'id' => t("id"),
            'name' => t('Name'),
            'cnpj' => t('Cnpj'),
            'address' => t('Address'),
            'start_date' => t('start date'),
            'end_date' => t('end date'),
            'phone' => t('Phone'),
            'email' => t('Email'),
            'status' => t('Status'),
            'created_at' => t('Created At'),
            'updated_at' => t('Updated At'),
        ];
    }
}