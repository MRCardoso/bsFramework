<?php

namespace app\controllers;

use app\commands\MyController;
use app\models\Product;
use app\models\Request;
use yii\helpers\Json;

class RequestController extends MyController
{
    protected $_freeActions = ["product_data", "index"];
    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->_model = new Request();
    }

    public function actionProduct_data()
    {
        $product = Product::find()
                ->where(['id' => \Yii::$app->request->post('product_id')])
                ->andWhere($this->_model->corporateFilter())
                ->one();
        return Json::encode($product);
    }
}
