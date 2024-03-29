<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function login(){
        return view('admin.login');
    }
    public function postLogin(Request $request){
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role' => 1])){
            return redirect()->route('admin.index');
        } else{
            return redirect()->back()->with('err', 'Sai tài khoản hoạt mật khẩu!');
        }
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('index');
    }
}
