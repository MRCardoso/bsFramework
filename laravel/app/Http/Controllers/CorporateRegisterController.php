<?php

namespace App\Http\Controllers;

use App\Repositories\CorporateRegisterRepository;
use App\Services\CorporateRegisterService;

class CorporateRegisterController extends MainController
{
    protected $_controller_name = 'corporate_register';

    public function __construct(CorporateRegisterRepository $repository, CorporateRegisterService $service)
    {
        $this->_repository = $repository;
        $this->_service = $service;
    }
    public function active()
    {
        $where = [
            'status' => 1,
            ['code', '<>', 'admin_management']
        ];
        if( ($user = authData()) != NULL && !checkGroup("admin") )
            $where["id"] = $user;
        return response()->json(
            $this->_repository->findWhere($where,
                ['id', 'name']
            )
        );
    }
}
