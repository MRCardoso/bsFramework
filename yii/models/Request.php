<?php

namespace app\models;

use Yii;
use app\commands\MyModel;
use app\validators\RequestValidator;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "request".
 *
 * @property integer $id
 * @property integer $corporate_register_id
 * @property integer $deliveryman_id
 * @property integer $client_id
 * @property integer $product_id
 * @property string $description
 * @property integer $quantity
 * @property string $price
 * @property string $request_date
 * @property string $freight
 * @property string $change
 * @property string $discount
 * @property integer $situation
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Client $client
 * @property CorporateRegister $corporateRegister
 * @property Deliveryman $deliveryman
 * @property Product $product
 */
class Request extends MyModel
{
    public $filter;
    public $totalValue = 0;
    public $status = 0;
    /*
     | -------------------------------------------------------------------------------------------
     | Load data to run the parent model in the standard of the Application
     | -------------------------------------------------------------------------------------------
     */
    public function __construct($config = [])
    {
        parent::__construct($config);

        $this->_model = self::find();
        $this->_validator = RequestValidator::getRules();
        $this->_label = RequestValidator::getLabels();
        $this->_filters = [
            "equal" => ['deliveryman_id', 'client_id', 'product_id', 'quantity', 'price', 'request_date', 'freight', 'discount', 'situation'],
            "like" => ['description']
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
        return 'request';
    }

    public function afterFind()
    {
        $this->totalValue =  Yii::$app->formatter->asCurrency( ( ($this->quantity * $this->price) + $this->freight) - $this->discount);
        $this->request_date = formatDate($this->request_date,'d/m/Y');

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
    public function getCorporateRegister()
    {
        return $this->hasOne(CorporateRegister::className(), ['id' => 'corporate_register_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Client::className(), ['id' => 'client_id']);
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
    public function getDeliveryman()
    {
        return $this->hasOne(Deliveryman::className(), ['id' => 'deliveryman_id']);
    }
    /*
     | --------------------------------------------------------------------------------------------
     | My Methods of the model
     | --------------------------------------------------------------------------------------------
     */
    /**
     * run the search to show in the home, the recent requests
     * @param $params
     * @return ActiveDataProvider
     */
    public function findRecent($params)
    {
        $query = Request::find()
                    ->where(['request.corporate_register_id' => self::corporateId()])
                    ->andWhere(['in', 'situation', [1,2]]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query->orderBy("id DESC"),
            'pagination' => [
                'pageSize' => 6
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) return $dataProvider;

        $query->joinWith(["client"]);

        $query->andFilterWhere(['or',
            ['like', 'description', $this->filter],
            ['like', 'client.name', $this->filter],
        ]);

        return $dataProvider;
    }
}
