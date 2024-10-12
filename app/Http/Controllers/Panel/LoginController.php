<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('guest:admin')->except('loggedOut');

    }

    public function showLoginForm()
    {
        return view('panel.auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            $device_token = $request->device_token;
            Auth::guard('admin')->user()->update(['device_token' => $device_token]);
            return redirect()->intended('/panel');

        }

        Session::flash('error-message', 'Invalid Email or Password');
        return back();



    }

    public function loggedOut(Request $request)
    {
        $this->guard()->logout();

        return redirect('/panel/login');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

}
