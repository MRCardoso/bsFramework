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
}
