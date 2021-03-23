<?php

namespace App\Http\Controllers;

use App\Constants\RequestStatus;
use App\Constants\UserRole;
use App\UserRequest;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        if(\Auth::check()){
            if(\Auth::user()->role == UserRole::admin) {
                return redirect()->action('UserController@showListRequest');
            }
            $requestInfo = UserRequest::where(['user_id'=> \Auth::user()->id])->first();
            if($requestInfo){
                if($requestInfo->status == RequestStatus::approved) {
                    $requestInfo->status_name = 'Approved';
                }elseif ($requestInfo->status == RequestStatus::pending){
                    $requestInfo->status_name = 'Pending';
                }else{
                    $requestInfo->status_name = 'Reject';
                }
                return view('home', ['request'=>$requestInfo]);
            }
        }
        return view('home');
    }
    //
}
