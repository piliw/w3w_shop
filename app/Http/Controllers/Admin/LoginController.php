<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// 导入数据操作类
use DB;
// 引入hash加密类
use Hash;
// 引入验证码类
use Gregwar\Captcha\CaptchaBuilder;

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
    // 登录界面
    public function create()
    {
        // 加载模板
        return view('Admin.login.login');
    }

    // 图片验证码
    public function fcode(){
        // 生成校验码代码
        ob_clean();//清除操作
        $builder = new CaptchaBuilder;
        //可以设置图片宽高及字体
        $builder->build($width = 100, $height = 40, $font = null);
        //获取验证码的内容
        $phrase = $builder->getPhrase();
        //把内容存入session
        session(['fcode'=>$phrase]);
        //生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-Type: image/jpeg');
        // 输出验证码
        $builder->output();
        // die;
    }
    // 验证码验证是否正确
    public function fcodes(Request $request){
        $v = $request->input('v');
        $session = session('fcode');
        // echo $session;
        if($v == $session){
            echo 1;
        }else{
            echo 2;
        }
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
        // dd($data->status);die;
            if(!empty($data)){
                if(Hash::check($request->input('password'),$data->password)){
                    if($data->status == 0){
                    //把用户信息写入到session
                    session(['id'=>$data->id]);
                    session(['username'=>$data->username]);
                    return redirect('/admin');
                    }else{
                        echo 3;
                        // 跳转并把错误信息储存
                        return back()->with('message', '该用户已被禁用,请联系客服人员!');
                    }
                }else{
                    // 跳转并把错误信息储存
                    return back()->with('message', '用户名或者密码不正确!');
                    // echo 1;
                }
            }else{
                // echo 2;
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
