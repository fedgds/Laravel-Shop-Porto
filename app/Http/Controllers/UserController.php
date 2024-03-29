<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(){
        return view('clients.login');
    }
    public function postLogin(Request $request){
        // validate

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect()->route('index');
        } else{
            return redirect()->back()->with('err', 'Sai tài khoản hoạt mật khẩu!');
        }
        // dd($request->all());
    }
    public function register(){
        return view('clients.register');
    }
    public function postRegister(Request $request){
        // validate

        $request->merge(['password' => Hash::make($request->password)]);
        try{
            User::create($request->all());
        }catch(\Throwable $th){

        }
        return redirect()->route('login');
    }
    public function logout(){
        Auth::logout();
        return redirect()->back();
    }
}
