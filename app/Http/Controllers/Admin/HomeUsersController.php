<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// 引入数据操作类
use DB;
use App\Models\HomeUser;
use App\Models\UserInfo;

class HomeUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // echo 1;
        $sname = $request->input('sname');
        // echo $sname;die;
        // 获取数据
        // paginate(2) 分页
        $data = HomeUser::where("phone",'like',"%".$sname."%")->paginate(5);
        // dd($data);
        // echo 1;
        // 计算数据条数
        $count=DB::table('user')->count();
        // dd($count);
        // 加载模板
        return view('Admin.home_user.home-list',['data'=>$data,'request'=>$request->all(),'count'=>$count]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
        // 获取id数据
        $data = UserInfo::where('user_id','=',$id)->first();
        // dd($data);die;
        return view('Admin.home_user.user-info',['data'=>$data]);
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

    // ajax删除操作
    public function homedel(Request $request){
        // echo 1;
        // 获取ajax参数
        $id = $request->input('id');
        $d = HomeUser::where('id','=',$id)->first();
        // echo $d['level'];exit;
        // echo $id;
        // 执行删除操作
        $data = HomeUser::where('id','=',$id)->delete();
        if($data){
            echo 1;exit;
        }else{
            echo 2;exit;
        }
    }

    // ajax状态是否禁用操作
    public function homestatus(Request $request){
        // echo 1;
        $id = $request->input('id');
        // echo $id;
        $data = DB::table('user')->where('id','=',$id)->value('status');
        // echo $data;
        // 将状态禁用
        if($data == 0){
            $data = DB::table('user')->where('id','=',$id)->update(['status'=>1]);
            echo $data;
        }else{
            // 将状态激活
            $data = DB::table('user')->where('id','=',$id)->update(['status'=>0]);
            echo $data;
        }
    }

    // ajax改变用户等级
    public function vip(Request $request){
        $id = $request->input('id');
        $data = DB::table('user')->where('id','=',$id)->value('level');
        // 改变等级
        if($data == 0){
            $data = DB::table('user')->where('id','=',$id)->update(['level'=>1]);
            echo $data;
        }else{
            // 改变等级
            $data = DB::table('user')->where('id','=',$id)->update(['level'=>0]);
            echo $data;
        }
    }

}
