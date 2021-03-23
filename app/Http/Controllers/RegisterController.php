<?php

namespace App\Http\Controllers;

use App\Constants\UserRole;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $checkExitsUsername = User::where(['username'=> $request->username])->first();
        if($checkExitsUsername) {
            return view("register", ['message' => 'Tên người dùng đã tồn tại!']);
        }
        if($request->password != $request->repassword){
            return view("register", ['message' => 'Hai mật khẩu không khớp!']);
        }
        $user = User::create(['username'=> $request->username, 'password'=> \Hash::make($request->password), 'role'=>UserRole::buyer]);
        if($user) {
            if(Auth::attempt(['username'=>$request->username,'password'=> $request->password])){
                return redirect('/');
            }
        }
        return view('login');
    }
}
