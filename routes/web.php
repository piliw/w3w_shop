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
// 前台主页
Route::resource('/','Home\IndexController');
// Route::get('/welcome',function(){
// 	return view('Admin.welcome');
// });
//后台主页
Route::resource('/admin','Admin\IndexController');
// 后台轮播图管理
Route::resource('/lunbotu','Admin\LunbotuController');
// 后台轮播图Ajax删除
Route::get('/lunbotudel','Admin\LunbotuController@lunbotudel');
// 后台品牌管理
Route::resource('/brand','Admin\BrandController');
// 后台品牌Ajax删除
Route::get('/branddel','Admin\BrandController@branddel');
// 后台广告管理
Route::resource('/adminabs','Admin\AbsController');
// 后台广告Ajax删除
Route::get('/absdel','Admin\AbsController@absdel');