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
Route::group([],function(){
	//分类管理
	Route::resource('/category','Admin\CateController');
	//加载添加分类模板
	Route::get('/categoryadd','Admin\CateController@cateAdd');
	//获取分类信息
	Route::post('/getcates','Admin\CateController@getCates');
	Route::get('/getcate','Admin\CateController@getCate');
	Route::get('/getcateall','Admin\CateController@getCateAll');
	Route::get('/cateone','Admin\CateController@cateOne');
	// 分类修改
	Route::post('/cateupdate','Admin\CateController@cateUpdate');
	//分类删除
	Route::get('/catedelete','Admin\CateController@delete');

});

