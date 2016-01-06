<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepositoryEloquent;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;

abstract class MainController extends Controller
{
    /**
     * Define the current controller
     *
     * @var
     */
    protected $_controller_name;
    /**
     * Object that stores the class with layer Service
     *
     * @var {$_controller_name]Repository
     */
    protected $_repository;
    /**
     * Object that stores the class with layer Repository
     *
     * @var {$_controller_name]Service
     */
    protected $_service;
    /**
     * Display a listing of the resource.
     * if the _with is not empty make the relation with table dependency
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json($this->_repository->findRule());
    }
    /**
     * Show the form for editing the specified resource.
     * verify if the record exist else return a json with 404 status
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function loadId($id)
    {
        $result = $this->_repository->findRule($id);
        if( count($result) == 0 )
            return response()->json(Lang::get('app.not_action',['action'=>'encontrado']), 404);
        return $result[0];
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return $this->_service->create($request->all());
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->_service->update($request->all(),$id);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->_service->destroy($id);
    }
}
