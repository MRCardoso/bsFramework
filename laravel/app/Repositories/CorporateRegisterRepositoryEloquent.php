<?php
namespace App\Repositories;

use App\Entities\CorporateRegister;

class CorporateRegisterRepositoryEloquent extends Repository implements CorporateRegisterRepository
{
    protected $_model = CorporateRegister::class;
    public $_table_name = 'corporate_register';
}