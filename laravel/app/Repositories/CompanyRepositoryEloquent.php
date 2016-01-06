<?php
namespace App\Repositories;

use App\Entities\Company;

class CompanyRepositoryEloquent extends Repository implements CompanyRepository
{
    protected $_model = Company::class;
    public $_table_name = 'company';
    protected $_with = ['user','corporateRegister'];
}