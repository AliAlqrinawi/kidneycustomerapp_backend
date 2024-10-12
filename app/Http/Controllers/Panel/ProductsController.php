<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Panel\ProductsRequest;
use App\Repositories\ProductsRepository;
use App\Repositories\ConstantsRepository;

class ProductsController extends Controller
{
    private $products;

    private $constants;

    public function __construct(
        productsRepository $products_repository,
        ConstantsRepository $constants_repository
    ) {
        $this->products = $products_repository;
        $this->constants = $constants_repository;
    }


    public function index(Request $request)
    {
        return view('panel.products.all');
    }


    public function getDataTable()
    {
        return $this->products->getDataTable();
    }

    public function create()
    {
        $data['categories']=$this->constants->getAll('products_categories');

        return view('panel.products.create',$data);
    }

    public function store(ProductsRequest $request)
    {


        $response = $this->products->store($request);

        return $this->responseApi($response['status'], $response['message']);
    }

    public function edit($id)
    {

        $data['item'] = $this->products->edit($id);
        $data['categories']=$this->constants->getAll('products_categories');


        return view('panel.products.create', $data);
    }

    public function update($id, ProductsRequest $request)
    {
        $response = $this->products->update($id, $request);

        return $this->responseApi($response['status'], $response['message']);
    }


    public function delete($id)
    {
        $response = $this->products->delete($id);
        return $this->responseApi($response['status'], $response['message']);
    }

}
