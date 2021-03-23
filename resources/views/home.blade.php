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


   @if(Auth::check() )

        @if(isset($request))
               <div class="fs-5 mt-5">Yêu cầu thành người bán của bạn:</div>
               <table class="table">
                   <thead>
                   <tr>
                       <th scope="col">#</th>
                       <th scope="col">Nội dung</th>
                       <th scope="col">Ngày yêu cầu</th>
                       <th scope="col">Trạng thái </th>
                   </tr>
                   </thead>
                   <tbody>
                   <tr>
                       <th scope="row">1</th>
                       <td>{{$request['info']}}</td>
                       <td>{{$request['created_at']}}</td>
                       <td>{{$request['status_name']}}</td>
                   </tr>
                   </tbody>

               </table>
               @if($request['status'] == \App\Constants\RequestStatus::rejected)
                   <div class="row justify-content-center mt-5">
                       <div class="col-4">
                           <div class="fs-4">Đăng ký bán hàng</div>
                           <form method="post" action="{{url("/submit_request")}}">
                               @csrf
                               <div class="form-floating">
                                   <textarea required class="form-control" name="info" style="height: 100px"></textarea>
                                   <label for="floatingTextarea2">Lý do bạn muốn bán hàng</label>
                               </div>
                               <button type="submit" class="btn btn-primary mt-3">Gửi lại yêu cầu</button>
                           </form>
                       </div>
                   </div>
               @endif

        @else
         <div class="row justify-content-center mt-5">
            <div class="col-4">
                <div class="fs-4">Đăng ký bán hàng</div>
                <form method="post" action="{{url("/submit_request")}}">
                    @csrf
                    <div class="form-floating">
                        <textarea required class="form-control" name="info" style="height: 100px"></textarea>
                        <label for="floatingTextarea2">Lý do bạn muốn bán hàng</label>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Gửi yêu cầu</button>
                </form>
            </div>
         </div>

        @endif
    @else
           <div class="row justify-content-center mt-5">
               <div class="col-8 text-center">
                   <div class="fs-4">Chào mừng bạn đến  với trang web của chúng tôi</div>
               </div>
           </div>
    @endif
</div>
</body>
</html>
