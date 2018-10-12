<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// 引入Hash加密
use Hash;
// 数据库操作
use DB;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->session()->has('hname')){
            // 加载登录成功页面
            return redirect('/');
        }else{
            // 加载前台登录页面
            return view('Home.login.login');
        } 
    }

    // 自定义登录成功页面
    public function dologin1(Request $request)
    {
        // 获取表单信息     
        $name = $_POST['username'];
        $pass = $_POST['password'];
        // 查询数据
        $datas = DB::table('user')->where('phone','=',$name)->first();
        // dd($datas);
        if($datas){
            // if(Hash::check($_POST['password'],$datas->password)){
            if($pass == $datas->password){
                // dd(1);
               //把用户信息写入到session
                session(['hid'=>$datas->id]);
                session(['hname'=>$datas->phone]);
                // 获取session数据
                // $data = $request->session()->all();
                // dd($data);
                // 登录成功跳转到首页
                return redirect('/');
            }else{
                // 跳转并把错误信息储存
                return back()->with('error', '用户名或者密码不正确!');
            }
        }else{
            // 跳转并把错误信息储存
            return back()->with('error', '用户名或者密码不正确!');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // echo '1';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
