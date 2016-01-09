<?php

namespace app\controllers;

use app\commands\MyController;
use app\models\Client;

class ClientController extends MyController
{
    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config = []);
        $this->_model = new Client();
    }
}
