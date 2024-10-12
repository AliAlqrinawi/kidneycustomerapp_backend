<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ProductsRepository;
use App\Http\Resources\Products\ProductResource;
use App\Traits\ResponseTrait;

class ProductsController extends Controller
{
    //

    use ResponseTrait;

    private $products;

    public function __construct(ProductsRepository $products)
    {
        $this->products = $products;
    }

    public function all(Request $request)
    {
        $data = $this->products->getByPaginate($request);

        return $this->successResponse(
            __('done'),
            200,
            true,
            $data
        );


    }

    public function single($id)
    {
        $item = $this->products->edit($id);

        return $this->successResponse(
            __('done'),
            200,
            true,
            [
                'item' => new ProductResource($item)
            ]
        );


    }

}
