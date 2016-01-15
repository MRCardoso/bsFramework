<?php

namespace app\models;

use app\commands\MyModel;
use app\validators\CorporateRegisterValidator;
use Yii;

/**
 * This is the model class for table "corporate_register".
 *
 * @property integer $id
 * @property string $name
 * @property string $code
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Client[] $clients
 * @property Company[] $companies
 * @property Deliveryman[] $deliverymen
 * @property Product[] $products
 * @property Request[] $requests
 * @property User[] $users
 */
class CorporateRegister extends MyModel
{
    protected $_withCorporate = false;
    protected $_withUser = false;

    public function __construct($config = [])
    {
        parent::__construct($config);

        $this->_model = self::find();
        $this->_validator = CorporateRegisterValidator::getRules();
        $this->_label = CorporateRegisterValidator::getLabels();
        $this->_filters = ["equal" => ['status'], "like" => ['name', 'code'] ];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'corporate_register';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClients()
    {
        return $this->hasMany(Client::className(), ['corporate_register_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompanies()
    {
        return $this->hasMany(Company::className(), ['corporate_register_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeliverymen()
    {
        return $this->hasMany(Deliveryman::className(), ['corporate_register_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['corporate_register_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequests()
    {
        return $this->hasMany(Request::className(), ['corporate_register_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['corporate_register_id' => 'id']);
    }
}
