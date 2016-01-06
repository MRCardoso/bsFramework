<?php
namespace App\Repositories;

use App\Entities\Product;

class ProductRepositoryEloquent extends Repository implements ProductRepository
{
    protected $_with = ['user', 'corporateRegister'];
    protected $_model = Product::class;
    public $_table_name = 'product';
}