<?php
namespace App\Repositories;

use App\Entities\Request;

class RequestRepositoryEloquent extends Repository implements RequestRepository
{
    protected $_with = ["corporateRegister","user","deliveryman", "client", "products"];
    protected $_model = Request::class;
    public $_table_name = 'request';

}