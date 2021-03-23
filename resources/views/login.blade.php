@extends('master')
    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Bai test</title>

</head>
<body style="height: 100vh">
<div class="container h-100">
    <div class='row  w-100 mt-2  justify-content-end '>
        <div class='col col-2 text-center font-weight-bold'>
            <span class='fs-4 text-decoration-none'>
                <a class='fs-4 text-decoration-none' href='/login'> Đăng nhập </a></span>
        </div>
        <div class='col col-2 '>
            <a class='fs-4 text-decoration-none' href='/register'> Đăng ký </a>
        </div>
    </div>
    <div class='mt-5 text-center h-100'>
        <div class="row h-50 justify-content-center align-items-center">
            <div class="col col-4">
                <form action="{{url('/login')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <input type="text" required class="form-control" name="username" placeholder="Tên đăng nhập">
                    </div>
                    <div class="form-group mt-3">
                        <input type="password" required class="form-control" name="password" placeholder="Mật khẩu">
                    </div>
                    <div class="text-end mt-3">
                        <input type="checkbox" name="remember" class="form-check-input">
                        <label class="form-check-label" >Ghi nhớ tôi</label>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Đăng nhập</button>
                    <div>
                        @if(isset($message))
                           <div class="text-danger mt-3"> {{$message}}</div>
                            @endif

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
