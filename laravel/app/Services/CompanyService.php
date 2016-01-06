<?php
namespace App\Services;

use App\Repositories\CompanyRepository;
use App\Validators\CompanyValidator;

/**
 * @property CompanyRepository $_repository
 * @property CompanyValidator $_validator
 */
class CompanyService extends Service
{
    public function __construct(CompanyRepository $repository, CompanyValidator $validator)
    {
        $this->_repository = $repository;
        $this->_validator = $validator;
    }
}