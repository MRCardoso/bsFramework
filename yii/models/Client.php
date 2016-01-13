<?php

namespace app\models;

use Yii;
use app\commands\MyModel;
use app\validators\ClientValidator;
/**
 * This is the model class for table "client".
 *
 * @property integer $id
 * @property integer $corporate_register_id
 * @property string $name
 * @property string $phone
 * @property string $birthday
 * @property string $address
 * @property integer $number
 * @property string $neightborhood
 * @property string $city
 * @property string $reference
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property CorporateRegister $corporateRegister
 * @property Request[] $requests
 */
class Client extends MyModel
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
        $this->_validator = ClientValidator::getRules();
        $this->_label = ClientValidator::getLabels();
        $this->_filters = [
            'equal' => [ 'birthday' => 'filter:formatDatabase', 'status'],
            'like' => ['name', 'phone', 'address']
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
        return 'client';
    }
    /**
     * run a action for each record found
     */
    public function afterFind()
    {
        if( $this->phone != NULL )
            $this->phone = join('', ['(', substr($this->phone,0,2), ') ', substr($this->phone,2)]);

        $this->birthday = formatDate($this->birthday,'d/m/Y');

        parent::afterFind();
    }
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert))
        {
            $this->birthday = formatDatabase($this->birthday);
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
    public function getRequests()
    {
        return $this->hasMany(Request::className(), ['client_id' => 'id']);
    }
}
