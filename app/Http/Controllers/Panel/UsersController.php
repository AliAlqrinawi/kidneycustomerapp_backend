<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\UsersRequest;
use Illuminate\Support\Facades\DB;
use App\Repositories\UsersRepository;


class UsersController extends Controller
{
    private $users;
    public function __construct(UsersRepository $users_repository)
    {
        $this->users = $users_repository;
    }
    public function index()
    {
        return view('panel.users.all');
    }

    public function getDataTable()
    {
        return $this->users->getDataTable();
    }

    public function create()
    {

        return view('panel.users.create');
    }

    public function store(UsersRequest $request)
    {
        $response = $this->users->store($request);

        return $this->responseApi($response['status'], $response['message']);
    }

    public function edit($id)
    {
        $data['item'] = $this->users->edit($id);

        return view('panel.users.create', $data);
    }




    public function update($id, UsersRequest $request)
    {

        $response = $this->users->update($id, $request);

        return $this->responseApi($response['status'], $response['message']);
    }

    public function delete($id)
    {

        $response = $this->users->delete($id);

        return $this->responseApi($response['status'], $response['message']);
    }
}
