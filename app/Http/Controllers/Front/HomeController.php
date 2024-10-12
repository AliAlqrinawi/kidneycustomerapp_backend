<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\Redirect;
class HomeController extends Controller
{
    //

    public function __construct()
    {

    }

    public function index()
    {

        return '';
    }

    public function changeLang(Request $request)
    {
        $request["lang"] = $request->lang;
        $lang = $request->lang;
        app()->setLocale($lang);
        $url = LaravelLocalization::getLocalizedURL($lang, url()->previous());

        return Redirect::to($url);
    }

}
