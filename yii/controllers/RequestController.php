<?php

namespace app\controllers;

use app\commands\MyController;
use app\models\Product;
use app\models\ProductRequest;
use app\models\Request;
use app\widgets\MyLabels;
use yii\helpers\Json;

class RequestController extends MyController
{
    protected $_freeActions = ["product_data", "product_list", "index"];
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
        return Json::encode([
                "name" => $product->name,
                "size" => MyLabels::widget(['model'=>$product,'type'=>'size']),
                "cost" => $product->cost
        ]);
    }

    public function actionProduct_list()
    {
        $post = \Yii::$app->request->post();
        $condition = [];
        if( !empty($post["product_id"]) )
            $condition = ['not in', 'id', $post["product_id"]];

        return Json::encode($this->_model->arrayListModel(Product::class, $condition));
    }

    protected function save($model)
    {
        $model->setScenario('save');

        $action = t($model->isNewRecord?'create':'updated_at');
        $post = \Yii::$app->request->post();
        if ( $model->load($post) )
        {
            if( permission($model,"interface") )
            {
                if( !isset($post["products"]) )
                {
                    \Yii::$app->session->setFlash('alert-danger', t("do you need inform a product!"));
                }
                else
                {
                    if( $model->saveRequest($post["products"]) )
                    {
                        msf('success', $action);
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                    else
                    {
                        msf('error', $action);
                    }
                }
            }
            else
            {
                msf('exception403');
            }
        }
        return $this->render('save', [ 'model' => $model, 'params' => $this->_params ]);
    }
}
