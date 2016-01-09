<?php
/*
 | ---------------------------------------------------------------------------------
 | Layer Validator
 | ---------------------------------------------------------------------------------
 | generate the validators and labels for model user
*/
namespace app\validators;


class RequestValidator
{
    public static function getRules()
    {
        return [
            [['deliveryman_id', 'client_id', 'product_id', 'quantity', 'price', 'situation'], 'required', 'on' => 'save'],
            [['corporate_register_id', 'deliveryman_id', 'client_id', 'product_id', 'quantity', 'situation'], 'integer', 'on' => 'save'],
            [['price', 'freight', 'discount'], 'number'],
            [['request_date', 'freight', 'situation', 'deliveryman_id', 'client_id', 'product_id', 'description', 'observation', 'filter'], 'safe'],
            [['description'], 'string', 'max' => 255]
        ];
    }

    public static function getLabels()
    {
        return [
            'id' => t('ID'),
            'corporate_register_id' => t('Corporate Register ID'),
            'deliveryman_id' => t('deliveryman'),
            'client_id' => t('client'),
            'product_id' => t('product'),
            'description' => t('Description'),
            'quantity' => t('Quantity'),
            'price' => t('Price'),
            'request_date' => t('Request Date'),
            'totalValue' => t('total value'),
            'freight' => t('Freight'),
            'observation' => t('observation'),
            'discount' => t('Discount'),
            'situation' => t('Situation'),
            'created_at' => t('Created At'),
            'updated_at' => t('Updated At'),
        ];
    }
}