<?php
namespace App\Services;

use App\Repositories\ProductRepository;
use App\Validators\ProductValidator;

class ProductService extends Service
{
    /**
     * @param ProductRepository $repository
     * @param ProductValidator $validator
     */
    public function __construct(ProductRepository $repository, ProductValidator $validator)
    {
        $this->_repository = $repository;
        $this->_validator = $validator;
    }
}