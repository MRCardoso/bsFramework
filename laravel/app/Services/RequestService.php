<?php
namespace App\Services;


use App\Repositories\RequestRepository;
use App\Validators\RequestValidator;

class RequestService extends Service
{
    /**
     * @param RequestRepository $repository
     * @param RequestValidator $validator
     */
    public function __construct(RequestRepository $repository, RequestValidator $validator)
    {
        $this->_repository = $repository;
        $this->_validator = $validator;
    }
}