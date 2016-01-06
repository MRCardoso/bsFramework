<?php

namespace App\Http\Controllers;

use App\Repositories\ProductRepository;
use App\Services\ProductService;

class ProductController extends MainController
{
    protected $_controller_name = 'product';
    /**
     * @param ProductRepository $repository
     * @param ProductService $service
     */
    public function __construct(ProductRepository $repository, ProductService $service)
    {
        $this->_repository = $repository;
        $this->_service = $service;
    }
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function active()
    {
        return response()->json($this->_repository->findRule(NULL, [],['id','name','size','cost'], true,['name','ASC']));
    }
}