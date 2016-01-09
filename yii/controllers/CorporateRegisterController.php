<?php

namespace app\controllers;

use app\models\CorporateRegister;
use Yii;
use app\commands\MyController;
/**
 * CorporateRegisterController implements the CRUD actions for CorporateRegister model.
 */
class CorporateRegisterController extends MyController
{
    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->_model = new CorporateRegister();
    }
}
