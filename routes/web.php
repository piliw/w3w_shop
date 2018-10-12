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

Route::get('/', function () {
    return view('welcome');
});

//后台主页
Route::resource('/admin','Admin\IndexController');

// 后台 我的桌面
Route::get("/welcome","Admin\IndexController@welcome");

// 后台订单模块
Route::group([],function(){
	Route::resource("/order","Admin\OrderController");
});