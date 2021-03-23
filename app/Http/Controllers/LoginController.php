<?php

namespace App\Http\Controllers;

use App\Constants\UserRole;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index(){
        return view("login");
    }
    public function login(Request $request){
        if(Auth::attempt(['username'=>$request->username,'password'=> $request->password ],$request->has('remember') )){
           $user = Auth::user();
           if ($user->role == UserRole::admin) {
               return redirect()->action('UserController@showListRequest');
           }else{
               return redirect('/');
           }
        }else{
            return view("login", ['message' => "Vui lòng kiểm tra lại thông tin !"]);
        }
        return view('home');
    }
    public function logout(){

        Auth::logout();
        return view('home');
    }
}
