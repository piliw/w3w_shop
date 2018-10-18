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

// 后台 我的桌面
Route::get("/welcome","Admin\IndexController@welcome");

// 后台订单模块
Route::group([],function(){
	Route::resource("/order","Admin\OrderController");
});
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

// ----------------后台控制器-------------------------
// 后台登录操作
Route::resource('/login','Admin\LoginController');
// 验证码
Route::get('/fcode','Admin\LoginController@fcode');
// ajax验证码验证是否正确
Route::get('/fcodes','Admin\LoginController@fcodes');
// 登录中间件路由组
Route::group(['middleware'=>'login'],function(){
// 后台首页
Route::resource('/admin','Admin\IndexController');
// 后台用户列表
Route::resource('/adminuser','Admin\AdminUserController');
// 修改管理员等级操作
Route::post('/level','Admin\AdminUserController@level');
// ajax用户名验证
Route::get('/name','Admin\AdminUserController@name');
// 后台用户删除
Route::get('/del','Admin\AdminUserController@del');
// 后台是否禁用操作
Route::get('/status','Admin\AdminUserController@status');
// 后台修改密码时,旧密码验证
Route::get('/pass','Admin\AdminUserController@pass');

// 后台的前台用户列表
Route::resource('/homeuser','Admin\HomeUsersController');
// 后台的前台用户删除
Route::get('/homedel','Admin\HomeUsersController@homedel');
// 后台的前台用户列表是否禁用操作
Route::get('/homestatus','Admin\HomeUsersController@homestatus');
// ajax改变用户等级
Route::get('/vip','Admin\HomeUsersController@vip');
});
// ----------------前台控制器-------------------------
// 前台登录操作
Route::resource('/homelogin','Home\LoginController');
// 前台登录成功操作
Route::post('/dologin1','Home\LoginController@dologin1');
// 找回密码
Route::get('/forget','Home\LoginController@forget');
// 重置密码界面
Route::post('/doforget','Home\LoginController@doforget');
// 邮箱点击后的重置密码操作
Route::get('/reset','Home\LoginController@reset');
// 重置密码操作
Route::post('/doreset','Home\LoginController@doreset');
// 前台注册用户
Route::resource('/zhuce','Home\HomeUsersController');
// 邮箱激活状态
Route::get('/jihuo','Home\HomeUsersController@jihuo');
// ajax账户验证
Route::get('/phone','Home\HomeUsersController@phone');
// 自定义短信接口调用
Route::get('/demo','Home\HomeUsersController@demo');
// ajax短信校验
Route::get('/code','Home\HomeUsersController@code');


