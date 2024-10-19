<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\AreasRequest;
use App\Models\Admin;
use App\Repositories\AreasRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AreasController extends Controller
{
    private $areas;
    public function __construct(AreasRepository $areas_repository)
    {
        $this->areas = $areas_repository;
    }
    public function index()
    {
        return view('panel.areas.all');
    }

    public function getDataTable()
    {
        return $this->areas->getDataTable();
    }

    public function create()
    {
        $institutionsLogin = Auth::guard('admin')->user();
        $data['institutionId']  = 0;

        if ($institutionsLogin->hasRole("institutions")) {
            $data['institutionId'] = $institutionsLogin->id;
        }

        $data['institutions'] = Admin::whereHas('roles', function ($q) {
            $q->where('name', 'institutions');
        })->get();

        $data['roles'] = DB::table('roles')->where("name", "areas")->get();

        return view('panel.areas.create', $data);
    }

    public function store(AreasRequest $request)
    {
        $response = $this->areas->store($request);

        return $this->responseApi($response['status'], $response['message']);
    }

    public function edit($id, $admin_id,)
    {
        $data = $this->areas->edit($id);
        $data["admin_id"] = $admin_id;

        return view('panel.areas.create', $data);
    }

    public function update($id, $admin_id, AreasRequest $request)
    {
        // return $request->all();
        $response = $this->areas->update($id, $admin_id, $request);

        return $this->responseApi($response['status'], $response['message']);
    }

    public function delete($id)
    {

        $response = $this->areas->delete($id);

        return $this->responseApi($response['status'], $response['message']);
    }
}
