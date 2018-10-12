<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// 导入数据操作类
use DB;
// 引入hash加密类
use Hash;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        // 删除登录session
        $a = $request->session()->pull('username');
        $a = $request->session()->pull('id');
        // $data = $request->session()->all();
        // dd($a);die;
        // 加载模板
        return redirect("/login/create");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 加载模板
        return view('Admin.login.login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $k = $request->all();
        // $k = $request->except(['_token','vercode']);
        // 获取表单信息
        $name = $request->input('username');
        // dd($name);die;
        // 查询字段
        $data = DB::table('admin_user')->where('username','=',$name)->first();
        // dd($pass1);die;
        if($data){
            if(Hash::check($request->input('password'),$data->password)){
                //把用户信息写入到session
                session(['id'=>$data->id]);
                session(['username'=>$data->username]);
                return redirect('/admin');
            }else{
                // 跳转并把错误信息储存
                return back()->with('message', '用户名或者密码不正确!');
            }
        }else{
            // 跳转并把错误信息储存
            return back()->with('message', '用户名或者密码不正确!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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
        
    }
}
