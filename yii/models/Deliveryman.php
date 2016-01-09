<?php

namespace app\models;

use Yii;
use app\commands\MyModel;
use app\validators\DeliverymanValidator;

/**
 * This is the model class for table "deliveryman".
 *
 * @property integer $id
 * @property integer $corporate_register_id
 * @property integer $company_id
 * @property string $name
 * @property string $cpf
 * @property string $rg
 * @property string $cellphone
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Company $company
 * @property CorporateRegister $corporateRegister
 * @property Request[] $requests
 */
class Deliveryman extends MyModel
{
    public $companyName;

    public function __construct($config = [])
    {
        parent::__construct($config);

        $this->_model = self::find();
        $this->_validator = DeliverymanValidator::getRules();
        $this->_label = DeliverymanValidator::getLabels();
        $this->_filters = [
            "equal" => ['company_id', 'status'],
            "like" => ['name', 'cpf', 'rg', 'cellphone']
        ];
    }
    /*
     | -------------------------------------------------------------------------------------------
     | Methods of the Framework
     | -------------------------------------------------------------------------------------------
     */
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'deliveryman';
    }

    public function afterFind()
    {
        if( $this->cpf != NULL && strlen($this->cpf) == 11)
            $this->cpf = join('', [substr($this->cpf,0,3),'.', substr($this->cpf,3,3),'.', substr($this->cpf,6,3),'-', substr($this->cpf,9) ]);

        if( $this->cellphone != NULL )
            $this->cellphone = join('', ['(', substr($this->cellphone,0,2), ') ', substr($this->cellphone,2)]);

        parent::afterFind();
    }
    /*
     | -------------------------------------------------------------------------------------------
     | Relations
     | -------------------------------------------------------------------------------------------
     */
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'company_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCorporateRegister()
    {
        return $this->hasOne(CorporateRegister::className(), ['id' => 'corporate_register_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequests()
    {
        return $this->hasMany(Request::className(), ['deliveryman_id' => 'id']);
    }
}
