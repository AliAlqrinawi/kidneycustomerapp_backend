<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Product;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    //
    public function index()
    {

        $data['products_count'] = Product::count();
        $data['posts_count'] = Post::count();
        return view('panel.home.index', $data);
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
