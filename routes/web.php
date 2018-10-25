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
	Route::get("/logistics/{id}","Admin\OrderController@logistics");
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
	//改变分类状态
	Route::get('/catedisplay','Admin\CateController@display');

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
// 后台公告管理模块
Route::resource('/notece','Admin\NoteceController');
// 前台公告
Route::get('/homenotece','Home\IndexController@homenotece');
// 后台公告Ajax删除
Route::get('/notecedel','Admin\NoteceController@notecedel');
// 后台评价管理模块
Route::resource('/appraise','Admin\AppraiseController');
// 后台评价Ajax评价删除
Route::get('/appraisedel','Admin\AppraiseController@appraisedel');
// 后台友情链接管理模块
Route::resource('/link','Admin\LinkController');
// 友情链接更改状态
Route::get('/link_status','Admin\LinkController@link_status');
// 友情链接ajax删除
Route::get('/linkdel','Admin\LinkController@linkdel');
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
// 后台分配角色
Route::get('/adminrole','Admin\NodeController@rolelist');
// 后台保存角色
Route::post('/saverole','Admin\NodeController@saverole');
// 后台角色列表
Route::get('/roles','Admin\NodeController@roles');
// 后台角色删除
Route::get('/rolesdel','Admin\NodeController@rolesdel');
// 后台用户权限管理
Route::resource('/node','Admin\NodeController');
// 后台分配权限
Route::get('/auth/{id}','Admin\NodeController@auth');
// 后台保存分权限
Route::post('/saveauth','Admin\NodeController@saveauth');
// 权限列表
Route::get('/nodelist','Admin\NodeController@nodelist');
// ajax权限删除
Route::get('/nodedel','Admin\NodeController@nodedel');
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
// 前台列表页
Route::resource('/list','Home\listController');
// 前台和列表搜索
Route::post('/keywords','Home\listController@index');


// 购物车控制器
Route::resource("/homecart","Home\CartController");
// 购物车减
Route::get("/updatee/{id}","Home\CartController@updatee");
// 购物车加
Route::get("/updates/{id}","Home\CartController@updates");
// 购物车商品删除
Route::get("/cartdel/{id}","Home\CartController@del");

// 前台订单操作
Route::group(['middleware'=>'homelogin'],function(){
	// 订单控制器
	Route::resource("/orders","Home\OrdersController");
	// 订单状态
	Route::resource("/status","Home\StatusController");
	// 确认收货处理
	Route::get("/affirm/{id}","Home\StatusController@affirm");
	// 物流信息
	Route::get("/logistics/{id}","Home\StatusController@logistics");
	
	// 收货地址删除
	Route::get("/addressdel","Home\OrdersController@del");
	// 立即购买订单处理
	Route::post("/ordershop","Home\OrdersController@ordershop");
	// 购物车购买订单处理
	Route::post("/ordershopa","Home\OrdersController@ordershopa");

	// 支付宝接口调用
	Route::resource("/pays","Home\PayController");
	// 支付完成的通知页面
	Route::get("/returnurl","Home\PayController@returnurl");
});
// 商品管理
Route::group([],function(){
	// 商品列表
	Route::resource('/goodsinfo','Admin\Goods\GoodsController');
	//ajax获取所有商品信息
	Route::get('/getgoods','Admin\Goods\GoodsController@getGoods');
	Route::post('/goodsupload','Admin\Goods\GoodsController@upload');
	// 商品删除
	Route::get('goodsdel','Admin\Goods\GoodsController@goodsDel');
	//商品批量删除
	Route::post('/goodsup/{d}','Admin\Goods\GoodsController@status');
});

// Home商品详情
Route::resource('/homegoods','Home\Goods\HomeGoodsController');
