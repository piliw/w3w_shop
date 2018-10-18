<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// 引入Hash加密
use Hash;
// 数据库操作
use DB;
// 引入邮箱类
use Mail;

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
        // 查询数据
        $datas = DB::table('user')->where('phone','=',$name)->first();
        // dd($datas);
            if($datas){
                if(Hash::check($_POST['password'],$datas->password)){
                    if($datas->status == 0){
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
                        // 阻止跳转并把错误信息储存
                        return back()->with('error', '该账户已被禁用,请联系客服人员!');
                    }
                }else{
                    // 阻止跳转并把错误信息储存
                    return back()->with('error', '用户名或者密码不正确!');
                }
            }else{
                // 阻止跳转并把错误信息储存
                return back()->with('error', '用户名或者密码不正确!');
            }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    // 前台退出操作
    public function create(Request $request)
    {
        // 删除登录session
        $a = $request->session()->pull('hname');
        $a = $request->session()->pull('hid');
        // 跳转模板
        return redirect("/");
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

    // 邮箱发送
    //发送纯文本 视图和数据 $email 接收方 $id注册用户id $token 校验参数
    public function sendMail($email,$id,$token){
        //在闭包函数内部使用闭包函数外部的变量 必须use 导入
        Mail::send('Home.login.a',['id'=>$id,'token'=>$token],
        function($message)use($email){
        //发送主题
        $message->subject('唯尚衣族用户密码重置');
        //接收方
        $message->to($email);
        });
        return true;
    }

    // 邮箱点击后重置密码界面
    public function reset(Request $request){
        // 获取数据
        $id = $request->input('id');
        // 查询数据
        $info = DB::table('user')->where('id','=',$id)->first();
        // 获取数据
        $token = $request->input('token');
        // 判断两者是否相等
        if($token == $info->token){
            return view('Home.login.reset',['id'=>$id]);
        }
    } 

    // 重置密码操作
    public function doreset(Request $request){
        // echo 1;
        // 获取隐藏域的id
        $id = $request->input('id');
        // 获取加密后的密码
        $data['password'] = Hash::make($request->input('password'));
        // 设置新的token
        $data['token'] = rand(1,10000);
        // 修改密码
        $info = DB::table('user')->where('id','=',$id)->update($data);
        if($info){
            return redirect('/homelogin');
        }
    }

    // 找回密码页面
    public function forget(){
        // echo 1;
        return view('Home.login.forget');
    }

    // 发送邮件
    public function doforget(Request $request){
        $email = $request->input('email');
        // echo $email;
        $info = DB::table('user')->where('email','=',$email)->first();
        // 判断邮箱是否跟数据库的邮箱一样
        if($info){
            // 调用sendMa方法
            $res = $this->sendMail($email,$info->id,$info->token);
            if($res){
                echo '重置密码的邮箱已经发送成功,请登录邮箱重置密码';
            }
        }else{
            return back()->with('error', '与注册时的邮箱不一致!');
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
