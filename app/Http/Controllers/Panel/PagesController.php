<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Panel\PagesRequest;
use App\Repositories\PagesRepository;

class PagesController extends Controller
{
    private $pages;
    public function __construct(PagesRepository $pages_repository)
    {
        $this->pages = $pages_repository;
    }


    public function index(Request $request)
    {

        return view('panel.pages.all');
    }


    public function getDataTable()
    {
        return $this->pages->getDataTable();
    }

    public function create()
    {

        return view('panel.pages.create');
    }

    public function store(PagesRequest $request)
    {


        $response = $this->pages->store($request);

        return $this->responseApi($response['status'], $response['message']);
    }

    public function edit($id)
    {

        $data = $this->pages->edit($id);


        return view('panel.pages.create', $data);
    }

    public function update($id, PagesRequest $request)
    {
        $response = $this->pages->update($id, $request);

        return $this->responseApi($response['status'], $response['message']);
    }


    public function delete($id)
    {
        $response = $this->pages->delete($id);
        return $this->responseApi($response['status'], $response['message']);
    }

}
