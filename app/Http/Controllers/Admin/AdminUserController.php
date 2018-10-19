<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// 引入DB类
use DB;
// 引入加密类
use Hash;
//导入要调用的模型类
use App\Models\AdminUsers;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sname = $request->input('sname');
        // 获取数据
        // paginate(2) 分页
        $data = AdminUsers::where("username",'like',"%".$sname."%")->paginate(5);
        // dd($data);
        // echo 1;
        // 计算数据条数
        $count=DB::table('admin_user')->count();
        // dd($count);
        // 加载用户列表模板
        return view('Admin.admin_user.admin-list',['data'=>$data,'request'=>$request->all(),'count'=>$count]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 加载用户添加模板
        return view('Admin.admin_user.admin-add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // 用户添加
    public function store(Request $request)
    {
        // echo 2;
        //$d = $request->all();
        //获取除去下面两个参数外的所以参数
        $d = $request->except(['_token','password2']);
        // hash进行密码加密
        $d['password']=Hash::make($d['password']);
        // 设置初始化时间
        $d['addtime']=date('Y-m-d H:i:s');
        // dd($d);
        // 添加操作
        $data = DB::table('admin_user')->insert($d);
        if($data){
            echo '<h2>添加成功,点击右上角关闭后刷新页面...</h2>';
        }else{
            echo '<h2>添加失败,点击右上角关闭后刷新页面...</h2>';
        }
    }

    // ajax用户名验证
    public function name(Request $request){
        // echo 2;
        // 获取数据
        $d = $request->input('name');
        // 查找数据
        $data = AdminUsers::where('username','=',$d)->value('username');
        // echo $data;exit;
        if($data){
            echo 1;exit;
        }else{
            echo 2;exit;
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
        // 修改管理员等级页面
        // echo 1;
        // 查询数据
        $data = DB::table('admin_user')->where('id','=',$id)->first();
        // 加载模板  分配数据
        return view('Admin.admin_user.admin-level',['data'=>$data]);
    }

    // 修改管理员等级操作
    public function level(Request $request){
        $id = $request->input('id');
        // 获取表单值
        $level['level'] = $request->input('level');
        // dd($level);
        // 修改level
        $res = DB::table('admin_user')->where('id','=',$id)->update($level);
        if($res){
            echo '<h2>修改成功,点击右上角关闭后刷新页面...</h2>';
        }else{
            return redirect('/adminuser/'.$id);
        }
    }
 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 查询数据
        $pass = AdminUsers::where('id','=',$id)->first();
        // echo $pass;
        // 加载模板
        return view('Admin.admin_user.admin-edit',['pass'=>$pass]);
    }

    // 修改密码时旧密码验证
    public function pass(Request $request){
        // 获取隐藏域的id
        $id = $request->input('id');
        // echo $id;die;
        // 获取ajax参数
        $pass = $request->input('oldpassword');
        // echo $pass;
        $repass = DB::table('admin_user')->where('id','=',$id)->first();
        // 判断是否有值
        if(Hash::check($pass,$repass->password)){
            echo 1;exit;
        }else{
            echo 2;exit;
        }

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
        //echo 2;
        // $data = $request->all();
        // 筛选所需字段
        $data = $request->only(['password']);
        // 密码加密
        $data['password']=Hash::make($data['password']);
        // dd($data);
        // 修改
        $datas = AdminUsers::where('id','=',$id)->update($data);
        if($datas){
            echo '<h2>修改成功,点击右上角关闭后刷新页面...</h2>';
        }else{
            echo '<h2>修改失败,点击右上角关闭后刷新页面...</h2>';
        }
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

    // ajax删除操作
    public function del(Request $request){
        // echo 1;
        // 获取ajax参数
        $id = $request->input('id');
        $d = AdminUsers::where('id','=',$id)->first();
        // echo $d['level'];exit;
        // echo $id;
        // 执行删除操作
        $data = AdminUsers::where('id','=',$id)->delete();
        if($data){
            echo 1;exit;
        }else{
            echo 2;exit;
        }
    }

    // ajax状态是否禁用操作
    public function status(Request $request){
        // echo 1;
        $id = $request->input('id');
        // echo $id;
        $data = DB::table('admin_user')->where('id','=',$id)->value('status');
        // echo $data;
        // 将状态禁用
        if($data == 0){
            $data = DB::table('admin_user')->where('id','=',$id)->update(['status'=>1]);
            echo $data;
        }else{
            // 将状态激活
            $data = DB::table('admin_user')->where('id','=',$id)->update(['status'=>0]);
            echo $data;
        }
    }

}
