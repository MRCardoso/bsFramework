<?php

namespace App\Http\Controllers;

use App\Repositories\DeliverymanRepository;
use App\Services\DeliverymanService;

class DeliverymanController extends MainController
{
    protected $_controller_name = 'deliveryman';
    /**
     * Start repositories and services
     *
     * @param DeliverymanRepository $repository
     * @param DeliverymanService $service
     */
    public function __construct(DeliverymanRepository $repository, DeliverymanService $service)
    {
        $this->_repository = $repository;
        $this->_service = $service;
    }
    public function active()
    {
        return response()->json($this->_repository->findRule(NULL, [], ['id','name'], true,['name','ASC']));
    }
}