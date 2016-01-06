<?php
namespace App\Services;

use App\Repositories\DeliverymanRepository;
use App\Validators\DeliverymanValidator;

class DeliverymanService extends Service
{
    /**
     * @param DeliverymanRepository $repository
     * @param DeliverymanValidator $validator
     */
    public function __construct(DeliverymanRepository $repository, DeliverymanValidator $validator)
    {
        $this->_repository = $repository;
        $this->_validator = $validator;
    }
}