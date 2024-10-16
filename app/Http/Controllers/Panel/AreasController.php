<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\AreasRequest;
use App\Models\Admin;
use App\Models\Area;
use App\Repositories\AreasRepository;
use Illuminate\Support\Facades\Auth;

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
        $institutionId = 0;

        if ($institutionsLogin->hasRole("institutions")) {
            $institutionId = $institutionsLogin->id;
        }

        $institutions = Admin::whereHas('roles', function ($q) {
            $q->where('name', 'institutions');
        })->get();

        return view('panel.areas.create', compact("institutions", "institutionId"));
    }

    public function store(AreasRequest $request)
    {
        $response = $this->areas->store($request);

        return $this->responseApi($response['status'], $response['message']);
    }

    public function edit($id)
    {
        $data = $this->areas->edit($id);

        return view('panel.areas.create', $data);
    }

    public function update($id, AreasRequest $request)
    {

        $response = $this->areas->update($id, $request);

        return $this->responseApi($response['status'], $response['message']);
    }

    public function delete($id)
    {

        $response = $this->areas->delete($id);

        return $this->responseApi($response['status'], $response['message']);
    }
}
