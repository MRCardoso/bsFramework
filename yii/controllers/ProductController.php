<?php

namespace app\controllers;

use app\commands\MyController;
use app\models\Product;

class ProductController extends MyController
{
    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->_model = new Product();
    }
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $validate = count($model->productRequests);
        if( $validate > 0)
        {
            \Yii::$app->session->setFlash('alert-danger', t("this_product_is_bound_to_{request},_and_can_not_be_removed!",['request'=>$validate]));
        }
        else
        {
            if( $model->delete() )
                msf('success', t('removed'));
            else
                msf('error', t('removed'));
        }
        return $this->redirect(['index']);
    }
}
