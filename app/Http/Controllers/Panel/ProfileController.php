<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Admins;
use App\Repositories\AdminRepository;

class ProfileController extends Controller
{
    //

    private $admin;
    public function __construct(AdminRepository $admin_eloquent)
    {

        $this->admin = $admin_eloquent;
    }


    public function index()
    {

        $data['item'] = getAdmin();

        return view("panel.profile.edit", $data);
    }

    public function update(Request $request)
    {

        $admin = getAdmin();

        $response = $this->admin->updateProfile($request, $admin->id);
        return $this->responseApi($response['status'], $response['message']);


    }

    public function resetPassword(Request $request)
    {
        $admin = getAdmin();
        $response = $this->admin->chnagePassword($request, $admin);
        return $this->responseApi($response['status'], $response['message']);
    }
}
