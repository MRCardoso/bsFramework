<?php
namespace App\Services;

use App\Repositories\ClientRepository;
use App\Validators\ClientValidator;

/**
 * Class ClientService
 * @package App\Services
 *
 * @property ClientRepository $_repository
 * @property ClientValidator $_validator
 */
class ClientService extends Service
{
    /**
     * @param ClientRepository $repository
     * @param ClientValidator $validator
     */
    public function __construct(ClientRepository $repository, ClientValidator $validator)
    {
        $this->_repository = $repository;
        $this->_validator = $validator;
    }
}