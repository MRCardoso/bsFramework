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
 * @property string $description
 * @property string $request_date
 * @property string $freight
 * @property string $observation
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
            "equal" => ['deliveryman_id', 'client_id', 'request_date' => 'filter:formatDatabase', 'freight', 'discount', 'situation'],
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
        $total = 0;
        foreach($this->productRequests as $productRequest)
            $total += ($productRequest->quantity * $productRequest->price);

        $this->totalValue =  Yii::$app->formatter->asCurrency( ( $total + $this->freight ) - $this->discount);
        $this->request_date = formatDate($this->request_date,'d/m/Y',"Date");

        parent::afterFind();
    }
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert))
        {
            $this->request_date = formatDatabase($this->request_date);
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
    public function getClient()
    {
        return $this->hasOne(Client::className(), ['id' => 'client_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductRequests()
    {
        return $this->hasMany(ProductRequest::className(), ['request_id' => 'id']);
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

    public function saveRequest($products)
    {
        $transaction = Yii::$app->db->beginTransaction();
        if( $this->save() )
        {
            ProductRequest::deleteAll(['request_id'=> $this->id]);
            foreach($products as $product )
            {
                if( substr_count($product["price"], ',') == 1)
                {
                    $product["price"] = str_replace(',', '.', str_replace('.', '',$product["price"]));
                }
                $product_request = new ProductRequest();
                $product_request->request_id = $this->id;
                $product_request->product_id = $product["product_id"];
                $product_request->quantity = $product["quantity"];
                $product_request->price = $product["price"];

                if( !$product_request->save() )
                    dd($product_request->getErrors());
            }
            $transaction->commit();
            return true;
        }
        $transaction->rollBack();
        return false;
    }
}
