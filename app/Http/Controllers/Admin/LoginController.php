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
        $request->session()->pull('username');
        $request->session()->pull('id');
        $request->session()->pull('nodelist');
        // $data = $request->session()->all();
        // dd($data);die;
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
                // 获取当前登录用户权限信息
                $list = DB::select("select n.name,n.mname,n.aname from user_role as ur,node_role as nr,node as n where ur.rid=nr.rid and nr.rid=n.id and uid ={$data->id}");
                
                // 初始化权限
                // 让所有的管理员具有公共的权限
                // 后台首页
                $nodelist['IndexController'][]='index';
                foreach($list as $v){
                    $nodelist[$v->mname][]=$v->aname;
                    if($v->aname=='create'){
                        $nodelist[$v->mname][]='store';
                    }
                    if($v->aname=='edit'){
                        $nodelist[$v->mname][]='update';
                    }
                }
                // echo '<pre>';
                // var_dump($nodelist);die;
                // 3把所有权限信息存储在session
                session(['nodelist'=>$nodelist]);
                
                
                // 跳转后台首页
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
