<?php
namespace App\Http\Controllers;

use App\Repositories\UserRepositoryEloquent;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Services\UserService;

class UserController extends MainController
{
    protected $_controller_name = 'user';
    /**
     * @param UserRepository $repository
     * @param UserService $service
     */
    public function __construct(UserRepository $repository, UserService $service)
    {
        $this->_repository = $repository;
        $this->_service = $service;
    }
    public function index()
    {
        $id = ( checkGroup("employee|user") ? auth()->user()->id : NULL);

        return response()->json($this->_repository->findRule($id));
    }
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        return $this->_service->create($request->all());
    }

    /**
     * get the employee active for the company(group)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getEmployees()
    {
        return response()->json(
            $this->_repository->findRule(NULL, ['group' => 'employee'],['name','email'],true)
        );
    }

    /**
     * arrayList of the ids of employees of the corporate_register_id authenticated
     *
     * @param UserRepositoryEloquent $eloquent
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPermission(UserRepositoryEloquent $eloquent)
    {
        return response()->json($eloquent::employeeByCompany(false));
    }
}
