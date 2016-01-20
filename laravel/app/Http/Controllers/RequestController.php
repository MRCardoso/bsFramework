<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ProductRepository;
use App\Repositories\RequestRepository;
use App\Services\RequestService;

class RequestController extends MainController
{
    protected $_controller_name = 'request';
    /**
     * @var ProductRepository
     */
    private $_productRepository;
    /**
     * @param RequestRepository $repository
     * @param RequestService $service
     * @param ProductRepository $productRepository
     */
    public function __construct(RequestRepository $repository, RequestService $service, ProductRepository $productRepository)
    {
        $this->_repository = $repository;
        $this->_service = $service;
        $this->_productRepository = $productRepository;
    }

    public function productInfo(Request $request)
    {
        $product = $this->_productRepository->findRule($request["id"], [], ['cost', 'name', 'size']);
        if( count($product) > 0)
            return response()->json($product[0]);
        else
            return response()->json("nenhum registro encontrado", 404);

    }
    /**
     * Get all request that is pending or in transit
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function recent()
    {
        $query = \App\Entities\Request::with(['client'])
            ->where(['request.corporate_register_id' => authData()]);

        if( checkGroup("user") )
            $query->where(['request.user_id' => authData('id')]);

        return response()->json(
            $query->whereIn('situation', [1,2])
            ->orderBy('id', 'desc')
            ->get()
        );
    }
}
