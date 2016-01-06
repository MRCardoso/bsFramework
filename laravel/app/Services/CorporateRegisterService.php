<?php
namespace App\Services;

use App\Repositories\CorporateRegisterRepository;
use App\Validators\CorporateRegisterValidator;

class CorporateRegisterService extends Service
{
    protected $_withCorporate = false;
    protected $_withUser = false;
    /**
     * @param CorporateRegisterRepository $repository
     * @param CorporateRegisterValidator $validator
     */
    public function __construct(CorporateRegisterRepository $repository, CorporateRegisterValidator $validator)
    {
        $this->_repository = $repository;
        $this->_validator = $validator;
    }
}