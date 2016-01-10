<?php
namespace App\Services;


use App\Repositories\RequestRepository;
use App\Validators\RequestValidator;
use Illuminate\Support\Facades\DB;
use Prettus\Validator\Exceptions\ValidatorException;

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

    public function create(Array $data)
    {
        return $this->save($data);
    }
    public function update(Array $data, $id)
    {
        return $this->save($data, $id);
    }
    public function save(Array $data, $id = NULL)
    {
        DB::beginTransaction();
        try{
            $list = [];
            $products = [];

            $data["corporate_register_id"] = authData();
            $data["user_id"] = authData('id');

            $this->_validator->with($data)->passesOrFail();
            if( isset($data["products"]) )
            {
                $products = $data["products"];
                unset($data["products"]);
            }
            validateField($this->_repository->attributes(), $data);
            if( $id == NULL )
                $module = $this->_repository->create($data);
            else
                $module = $this->_repository->update($data, $id);

            foreach($products as $product)
            {
                validateField(["price"], $product["pivot"]);

                $list[$product["pivot"]["product_id"]] = [
                    'quantity' => $product["pivot"]["quantity"],
                    'price' => $product["pivot"]["price"]
                ];

            }
            if( !empty($list) )
                $module->products()->sync($list);
            DB::commit();

            return response()->json([
                'module'=> $module,
                "message"=> $this->output_msg[$id==NULL?"create":"update"]
            ]);
        } catch(ValidatorException $e) {
            DB::rollback();
            return response()->json($e->getMessageBag(), 400);
        }
    }
}