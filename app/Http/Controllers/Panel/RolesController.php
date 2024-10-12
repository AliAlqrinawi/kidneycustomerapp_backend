<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Panel\RoleRequest;
use App\Repositories\RoleRepository;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
    //
    private $role;
    public function __construct(RoleRepository $role_repository)
    {

        $this->role = $role_repository;
    }

    public function index(Request $request)
    {

        return view('panel.roles.all');
    }

    public function getDataTable()
    {

        return $this->role->getDataTable();
    }

    public function create()
    {
        $data['permission'] = Permission::all()->groupBy('group_key');
        return view('panel.roles.create', $data);
    }

    public function store(RoleRequest $request)
    {

        $response = $this->role->store($request);

        return $this->responseApi($response['status'], $response['message']);
    }


    public function edit($id)
    {

        $data = $this->role->edit($id);
        $data['permission'] = Permission::all()->groupBy('group_key');

        return view('panel.roles.create', $data);
    }

    public function update($id, RoleRequest $request)
    {
        $response = $this->role->update($id, $request);

        return $this->responseApi($response['status'], $response['message']);
    }

    public function delete($id)
    {
        $response = $this->role->delete($id);

        return $this->responseApi($response['status'], $response['message']);
    }
}
