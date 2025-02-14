<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function showLoginForm(){
        return view('auth.login');
    }

    public function login(LoginRequest $request){
        $credentials = $request->only('email', 'password');

        if(Auth::guard('admin')->attempt($credentials, $request->remember)){
            return redirect('/admin/attendance/list');
        }

        return back()->withErrors(['login' => 'ログイン情報が間違っています。']);
    }

}
