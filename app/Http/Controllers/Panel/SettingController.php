<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\SettingRepository;

class SettingController extends Controller
{
    //

    private $setting;
    public function __construct(SettingRepository $setting_eloquent)
    {

        $this->setting = $setting_eloquent;
    }


    public function index()
    {

        $data = $this->setting->index();

        return view('panel.settings.edit', $data);
    }



    public function update(Request $request)
    {

        $response = $this->setting->update($request);

        return $this->responseApi($response['status'], $response['message']);
    }
}
