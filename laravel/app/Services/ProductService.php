<?php
namespace App\Services;

use App\Repositories\ProductRepository;
use App\Validators\ProductValidator;
use Illuminate\Support\Facades\Lang;

class ProductService extends Service
{
    /**
     * @param ProductRepository $repository
     * @param ProductValidator $validator
     */
    public function __construct(ProductRepository $repository, ProductValidator $validator)
    {
        $this->_repository = $repository;
        $this->_validator = $validator;
    }
    public function destroy($id)
    {
        $validate = count($this->_repository->find($id)->requests);
        if( $validate > 0)
        {
            return response()->json(Lang::get("app.product_not_allow_drop",["request" => $validate]),403);
        }
        else
        {
            return parent::destroy($id);
        }
    }
}