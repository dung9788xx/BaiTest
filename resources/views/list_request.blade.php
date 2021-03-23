@extends('master')
    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Bai test</title>

</head>
<body>
<div class="container">
    @if(!Auth::check())
        <div class='row w-100 mt-2  justify-content-end align-items-center'>
            <div class='col col-2 text-center font-weight-bold'>
            <span class='fs-4 text-decoration-none'>
                <a class='fs-4 text-decoration-none' href='/login'> Đăng nhập </a></span>
            </div>
            <div class='col col-2 '>
                <a class='fs-4 text-decoration-none' href='/register'> Đăng ký </a>
            </div>
        </div>
    @else
        <div class="row w-100">

            <div class="col col-2">
                Xin chào: {{Auth::user()->username}}
            </div>
            <div class="col col-2">
                <a href="/logout">Đăng xuất</a>
            </div>
        </div>
    @endif
    <div class='mt-5 text-center'>
        <span class='fs-4'>Danh sách yêu cầu thành người bán:</span>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nội dung </th>
                <th scope="col">Người yêu cầu</th>
                <th scope="col">Ngày</th>
                <th scope="col">Hành động</th>
            </tr>
            </thead>
            <tbody>
            @if(isset($users))
            @foreach($users as $user)
            <tr>
                <th scope="row">{{$loop->index}}</th>
                <td>{{$user->request->info}}</td>
                <td>{{$user->username}}</td>
                <td>{{$user->request->created_at}}</td>
                <td>
                    <a href="/change_request_status?id={{$user->request->id}}&status={{\App\Constants\RequestStatus::approved}}" class="m-lg-1"> Đồng ý</a>
                    <a href="/change_request_status?id={{$user->request->id}}&status={{\App\Constants\RequestStatus::rejected}}" class="text-danger">Từ chối</a>
                </td>
            </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>


</div>
</body>
</html>
