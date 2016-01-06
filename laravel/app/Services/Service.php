<?php
/*
 | --------------------------------------------------------------------------------------------------------------------
 | Service layer
 | --------------------------------------------------------------------------------------------------------------------
 | Class to manage the business rule of the modules
 |
 */
namespace App\Services;

use Prettus\Validator\Exceptions\ValidatorException;

class Service
{
    /**
     * define if the corporate_id is put as a field of the current table
     *
     * @var bool
     */
    protected $_withCorporate = true;
    /**
     * define if the user_id is put as a field of the current table
     *
     * @var bool
     */
    protected $_withUser = true;
    /**
     * message standard for CRUD
     * @var array
     */
    protected $output_msg = [
        "create" => "Registro criado com sucesso!",
        "update" => "Registro atualizado com sucesso!",
        "delete" => [
            "Falha ao remover registro",
            "Registro removido com sucesso"
        ]
    ];
    /**
     * @var
     */
    protected $_repository;
    /**
     * @var
     */
    protected $_validator;
    /**
     * CREATE a new register to the Repository loaded
     *
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function create( Array $data )
    {
        try{
            $return = false;
            if( isset($data["return_data"]) )
            {
                $return = $data["return_data"];
                unset($data["return_data"]);
            }
            if( $this->_withCorporate && ($auth = authData()) != NULL)
                $data["corporate_register_id"] = $auth;

            if( $this->_withUser && ($auth = authData('id')) != NULL)
                $data["user_id"] = $auth;

            $this->_validator->with($data)->passesOrFail();
            validateField($this->_repository->attributes(), $data);
            $module = $this->_repository->create($data);

            if( $return ) return $module->id;

            return response()->json([
                'module'=> $module,
                "message"=> $this->output_msg["create"]
            ]);
        } catch(ValidatorException $e) {
            return response()->json($e->getMessageBag(), 400);
        }
    }
    /**
     * UPDATE the register to the Repository loaded
     *
     * @param array $data
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update( Array $data, $id )
    {
        try{
            $return = false;
            if( isset($data["return_data"]) )
            {
                $return = $data["return_data"];
                unset($data["return_data"]);
            }

            $this->_validator->with($data)->passesOrFail();
            validateField($this->_repository->attributes(), $data);
            $module = $this->_repository->update($data, $id);

            if( $return ) return $module->id;

            return response()->json([
                'module'=> $module,
                "message"=> $this->output_msg["update"]
            ]);
        } catch(ValidatorException $e){
            return response()->json($e->getMessageBag(),400);
        }
    }
    /**
     * DELETE a register to the Repository loaded
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if( $this->_repository->delete($id) )
            $output = [ "message" => $this->output_msg["delete"][1] ];
        else
            $output = [ "message" => $this->output_msg["delete_msg"][0] ];

        return response()->json($output);
    }
}