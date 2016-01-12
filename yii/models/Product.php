<?php

namespace app\models;

use Yii;
use app\commands\MyModel;
use app\validators\ProductValidator;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property integer $corporate_register_id
 * @property string $name
 * @property string $description
 * @property string $cost
 * @property integer $size
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property CorporateRegister $corporateRegister
 * @property Request[] $requests
 */
class Product extends MyModel
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
        $this->_validator = ProductValidator::getRules();
        $this->_label = ProductValidator::getLabels();
        $this->_filters = [
            "equal" => ['cost', 'size', 'status'],
            "like" => ['name', 'description']
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
        return 'product';
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
    public function getProductRequests()
    {
        return $this->hasMany(ProductRequest::className(), ['product_id' => 'id']);
    }
}