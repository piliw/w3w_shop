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


// ----------------后台控制器-------------------------

// 后台登录操作
Route::resource('/login','Admin\LoginController');

// 登录中间件路由组
Route::group(['middleware'=>'login'],function(){

// 后台首页
Route::resource('/admin','Admin\IndexController');
// 后台用户列表
Route::resource('/adminuser','Admin\AdminUserController');
// ajax用户名验证
Route::get('/name','Admin\AdminUserController@name');
// 后台用户删除
Route::get('/del','Admin\AdminUserController@del');
// 后台是否禁用操作
Route::get('/status','Admin\AdminUserController@status');
// 后台修改密码时,旧密码验证
Route::get('/pass','Admin\AdminUserController@pass');

});
// ----------------前台控制器-------------------------

// 前台登录操作
Route::resource('/homelogin','Home\LoginController');
// 前台登录成功操作
Route::post('/dologin1','Home\LoginController@dologin1');
// 前台首页
Route::resource('/','Home\IndexController');