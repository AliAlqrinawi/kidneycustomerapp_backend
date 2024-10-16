<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\InstitutionsRequest;
use App\Repositories\AdminRepository;
use Illuminate\Support\Facades\DB;

class InstitutionsController extends Controller
{
    private $admins;
    public function __construct(AdminRepository $admins)
    {
        $this->admins = $admins;
    }

    public function index()
    {
        return view('panel.institutions.all');
    }

    public function getDataTable()
    {
        return $this->admins->getDataTable("institutions");
    }

    public function create()
    {
        $data['roles'] = DB::table('roles')->where("name" , "institutions")->get();

        return view('panel.institutions.create' , $data);
    }

    public function store(InstitutionsRequest $institutionsRequest)
    {
        $response = $this->admins->store($institutionsRequest);

        return $this->responseApi($response['status'], $response['message']);
    }

    public function edit(string $id)
    {
        $data = $this->admins->edit($id);
        $data['roles'] = DB::table('roles')->where("name" , "institutions")->get();
        return view('panel.institutions.create', $data);
    }

    public function update(InstitutionsRequest $institutionsRequest, string $id)
    {
        $response = $this->admins->update($id, $institutionsRequest);

        return $this->responseApi($response['status'], $response['message']);
    }

    public function delete(string $id)
    {
        $response = $this->admins->delete($id);

        return $this->responseApi($response['status'], $response['message']);
    }
}
