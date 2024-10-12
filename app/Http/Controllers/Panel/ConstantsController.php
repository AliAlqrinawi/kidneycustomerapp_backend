<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Panel\ConstantsRequest;
use App\Repositories\ConstantsRepository;

class ConstantsController extends Controller
{
    private $constants;
    public function __construct(ConstantsRepository $constants_repository)
    {
        $this->constants = $constants_repository;
    }


    public function index(Request $request, $parent)
    {

        return view('panel.constants.all');
    }


    public function getDataTable($parent)
    {
        return $this->constants->getDataTable($parent);
    }

    public function create($parent)
    {

        return view('panel.constants.create');
    }

    public function store(ConstantsRequest $request, $parent)
    {


        $response = $this->constants->store($request, $parent);

        return $this->responseApi($response['status'], $response['message']);
    }

    public function edit($parent, $id)
    {

        $data = $this->constants->edit($id, $parent);


        return view('panel.constants.create', $data);
    }

    public function update($parent, $id, ConstantsRequest $request)
    {
        $response = $this->constants->update($id, $parent, $request);

        return $this->responseApi($response['status'], $response['message']);
    }


    public function delete($parent, $id)
    {
        $response = $this->constants->delete($id, $parent);
        return $this->responseApi($response['status'], $response['message']);
    }

}
