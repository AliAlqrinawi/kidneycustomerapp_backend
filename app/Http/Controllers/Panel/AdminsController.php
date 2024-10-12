<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\AdminsRequest;
use Illuminate\Support\Facades\DB;
use App\Repositories\AdminRepository;


class AdminsController extends Controller
{
    private $admins;
    public function __construct(AdminRepository $admins_repository)
    {
        $this->admins = $admins_repository;
    }
    public function index()
    {
        return view('panel.admins.all');
    }

    public function getDataTable()
    {
        return $this->admins->getDataTable();
    }

    public function create()
    {

        $data['roles'] = DB::table('roles')->get();

        return view('panel.admins.create', $data);
    }

    public function store(AdminsRequest $request)
    {
        $response = $this->admins->store($request);

        return $this->responseApi($response['status'], $response['message']);
    }

    public function edit($id)
    {
        $data = $this->admins->edit($id);

        return view('panel.admins.create', $data);
    }




    public function update($id, AdminsRequest $request)
    {

        $response = $this->admins->update($id, $request);

        return $this->responseApi($response['status'], $response['message']);
    }

    public function delete($id)
    {

        $response = $this->admins->delete($id);

        return $this->responseApi($response['status'], $response['message']);
    }
}
