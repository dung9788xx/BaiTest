<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index');

Route::get('login', 'LoginController@index');
Route::post('login', 'LoginController@login');

Route::get('register', 'RegisterController@index');
Route::post('register', 'RegisterController@register');

Route::middleware([\App\Http\Middleware\CheckLoginMiddleware::class])->group(function () {
    Route::get('logout', 'LoginController@logout');
    Route::post('submit_request', 'UserController@submitRequest');

});
Route::middleware([\App\Http\Middleware\AdminMiddleware::class])->group(function () {
    Route::get('request_list', 'UserController@showListRequest');
    Route::get('change_request_status', 'UserController@changeRequestStatus');
});
