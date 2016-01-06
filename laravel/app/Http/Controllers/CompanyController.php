<?php

namespace App\Http\Controllers;

use App\Repositories\CompanyRepository;
use App\Services\CompanyService;

class CompanyController extends MainController
{
    protected $_controller_name = 'company';
    /**
     * @param CompanyRepository $repository
     * @param CompanyService $service
     */
    public function __construct(CompanyRepository $repository,CompanyService $service)
    {
        $this->_repository = $repository;
        $this->_service = $service;
    }
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function active()
    {
        return response()->json($this->_repository->findRule(NULL, [],['id','name'],true,['name', 'ASC']));
    }
}
