<?php

namespace App\Http\Controllers;

use App\Constants\RequestStatus;
use App\Constants\UserRole;
use App\User;
use App\UserRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showListRequest()
    {
        $requestList = User::where('role', UserRole::buyer)->with("request")
            ->whereHas("request", function ($q) {
                $q->where("status", '=', "2");
            })->get();
        if ($requestList) {

            return view('list_request', ['users' => $requestList]);

        }
        return view('list_request');
    }

    public function submitRequest(Request $request)
    {
        $requestToBeBuy = new UserRequest(['info' => $request->info, 'status' => RequestStatus::pending]);
        $user = \Auth::user();
        if($user->request){
            $user->request()->update(['info' => $request->info, 'status' => RequestStatus::pending]);
        }else{
            $user->request()->save($requestToBeBuy);

        }
        return redirect('/');

    }

    public function changeRequestStatus(Request $request)
    {
        $userRequest = UserRequest::where('id', $request->id)->first();

        if ($userRequest) {
            $status = in_array($request->status, [RequestStatus::pending, RequestStatus::rejected, RequestStatus::approved]) ? $request->status : RequestStatus::rejected;
            $userRequest->status = $status;
            $userRequest->save();
        }
        return redirect()->action('UserController@showListRequest');
    }
}
