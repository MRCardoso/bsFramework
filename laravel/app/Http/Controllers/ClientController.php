<?php

namespace App\Http\Controllers;

use App\Repositories\ClientRepository;
use App\Services\ClientService;

class ClientController extends MainController
{
    protected $_controller_name = 'client';
    /**
     * @param ClientRepository $repository
     * @param ClientService $service
     */
    public function __construct(ClientRepository $repository, ClientService $service)
    {
        $this->_repository = $repository;
        $this->_service = $service;
    }
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function active()
    {
        return response()->json($this->_repository->findRule(NULL,[], ['id','name'], true));
    }
}