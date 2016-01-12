<?php

namespace app\models;

use app\commands\MyModel;
use Yii;

/**
 * This is the model class for table "product_request".
 *
 * @property integer $product_id
 * @property integer $request_id
 * @property integer $quantity
 * @property string $price
 *
 * @property Product $product
 * @property Request $request
 */
class ProductRequest extends MyModel
{
    public $created_at=NULL;
    public $updated_at=NULL;
    protected $_withCorporate = false;
    protected $_withUser = false;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_request';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'request_id', 'quantity', 'price'], 'required'],
            [['product_id', 'request_id', 'quantity'], 'integer'],
            [['price'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_id' => 'Product ID',
            'request_id' => 'Request ID',
            'quantity' => 'Quantity',
            'price' => 'Price',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequest()
    {
        return $this->hasOne(Request::className(), ['id' => 'request_id']);
    }
}
