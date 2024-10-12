<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\InstitutionsRequest;
use App\Repositories\InstitutionsRepository;
use Spatie\Permission\Models\Role;

class InstitutionsController extends Controller
{
    private $institutionsRepository;
    public function __construct(InstitutionsRepository $institutionsRepository)
    {
        $this->institutionsRepository = $institutionsRepository;
    }

    public function index()
    {
        return view('panel.institutions.all');
    }

    public function getDataTable()
    {
        return $this->institutionsRepository->getDataTable();
    }

    public function create()
    {
        return view('panel.institutions.create');
    }

    public function store(InstitutionsRequest $institutionsRequest)
    {
        $response = $this->institutionsRepository->store($institutionsRequest);

        return $this->responseApi($response['status'], $response['message']);
    }

    public function edit(string $id)
    {
        $data['item'] = $this->institutionsRepository->edit($id);

        return view('panel.institutions.create', $data);
    }

    public function update(InstitutionsRequest $institutionsRequest, string $id)
    {
        $response = $this->institutionsRepository->update($id, $institutionsRequest);

        return $this->responseApi($response['status'], $response['message']);
    }

    public function delete(string $id)
    {
        $response = $this->institutionsRepository->delete($id);

        return $this->responseApi($response['status'], $response['message']);
    }
}
