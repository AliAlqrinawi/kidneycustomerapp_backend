<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\ProviderRequest;
use App\Models\Admin;
use App\Models\Area;
use App\Repositories\ProviderRepository;
use Illuminate\Support\Facades\Auth;

class ProviderController extends Controller
{
    private $providers;

    public function __construct(ProviderRepository $providers_repository)
    {
        $this->providers = $providers_repository;
    }

    public function index()
    {
        return view('panel.providers.all');
    }

    public function getDataTable()
    {
        return $this->providers->getDataTable();
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

        $areas = Area::get();

        return view('panel.providers.create', compact("institutions", "institutionId" , "areas"));
    }

    public function store(ProviderRequest $request)
    {
        $response = $this->providers->store($request);

        return $this->responseApi($response['status'], $response['message']);
    }

    public function edit($id)
    {
        $data = $this->providers->edit($id);

        return view('panel.providers.create', $data);
    }

    public function update($id, ProviderRequest $request)
    {
        $response = $this->providers->update($id, $request);

        return $this->responseApi($response['status'], $response['message']);
    }

    public function delete($id)
    {

        $response = $this->providers->delete($id);

        return $this->responseApi($response['status'], $response['message']);
    }
}
