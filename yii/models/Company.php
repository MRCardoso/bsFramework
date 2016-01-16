<?php

namespace app\models;

use Yii;
use app\commands\MyModel;
use app\validators\CompanyValidator;
use yii\behaviors\AttributeBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "company".
 *
 * @property integer $id
 * @property integer $corporate_register_id
 * @property string $name
 * @property string $cnpj
 * @property string $address
 * @property string $start_date
 * @property string $end_date
 * @property string $phone
 * @property string $email
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property CorporateRegister $corporateRegister
 * @property Deliveryman[] $deliverymen
 */
class Company extends MyModel
{
    /*
     | -------------------------------------------------------------------------------------------
     | Load data to run the parent model in the standard of the Application
     | -------------------------------------------------------------------------------------------
     */
    public function __construct($config = [])
    {
        parent::__construct($config);

        $this->_model = self::find();
        $this->_validator = CompanyValidator::getRules();
        $this->_label = CompanyValidator::getLabels();
        $this->_filters = [
            "equal" => ['start_date', 'end_date', 'status'],
            "like" => ['name', 'cnpj', 'address', 'phone', 'email']
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
        return 'company';
    }
    /**
     * run a action for each record found
     */
    public function afterFind()
    {
        if( $this->phone != NULL )
            $this->phone = join('', ['(', substr($this->phone,0,2), ') ', substr($this->phone,2)]);

        if( $this->cnpj != NULL && strlen($this->cnpj) == 14)
            $this->cnpj = join('', [substr($this->cnpj,0,2), '.', substr($this->cnpj,2,3), '.', substr($this->cnpj,5,3), '/', substr($this->cnpj,8,4), '-', substr($this->cnpj,12) ]);

        $this->start_date = formatDate($this->start_date,'d/m/Y',"Date");
        $this->end_date = formatDate($this->end_date,'d/m/Y',"Date");

        parent::afterFind();
    }
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert))
        {
            $this->start_date = formatDatabase($this->start_date);
            $this->end_date = formatDatabase($this->end_date);
            return true;
        }
        return false;
    }
    /*
     | -------------------------------------------------------------------------------------------
     | Relations
     | -------------------------------------------------------------------------------------------
     */
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
    public function getDeliverymen()
    {
        return $this->hasMany(Deliveryman::className(), ['company_id' => 'id']);
    }
    /*
     | -------------------------------------------------------------------------------------------
     | my own methods
     | -------------------------------------------------------------------------------------------
     */
    /**
     * validate if start_date is less that end_date
     * @param $attribute
     * @param $params
     */
    public function validStartEnd($attribute, $params)
    {
        if( $this->end_date != NULL )
        {
            if( $this->start_date == NULL )
                $this->addError("start_date", t("the_start_date_can_not_be_large_that_the_end_date"));
            if( formatDatabase($this->start_date) > formatDatabase($this->end_date) )
                $this->addError("start_date", t("the_start_date_can_not_be_large_that_the_end_date"));
            if( formatDatabase($this->end_date) < formatDatabase($this->start_date) )
                $this->addError("end_date", t("the_end_date_can_not_be_less_that_the_start_date"));
        }
    }
}
