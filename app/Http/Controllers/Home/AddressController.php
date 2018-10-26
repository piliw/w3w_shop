<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // 地址管理
    public function index(Request $request)
    {
        // 获取session用户id
        $hid = session('hid');
        // dd($hid);
        // 查询
        $data = DB::table('address')->where('user_id','=',$hid)->orderBy('default','desc')->get();
        // dd($data);
        // 加载模板
        return view('Home.gerenzhongxin.dizhiguanli',['data'=>$data]);
    }

    // 执行地址添加操作
    public function addres(Request $request){
        // echo 1;
        // 获取session用户id
        $hid = session('hid');
        // 设置空数组准备赋值
        $result=[];
        // 获取表单信息
        $data = $request->except(['_token']);
        // 重新赋值
        $result['u_address']=$data['hcity'].'-'.$data['hproper'].'-'.$data['harea'].'-'.$data['u_addres'];
        $result['u_name']=$data['u_name'];
        $result['u_phone'] = $data['u_phone'];
        $result['user_id'] = $hid;
        $result['default'] = '0';
        // dd($result);
        if(DB::table('address')->insert($result)){
            return redirect('/address')->with('success','地址添加成功');
        }else{
            return redirect('/address')->with('error','地址添加失败');
        }
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    // 修改地址
    public function edit($id)
    {
        $data = DB::table('address')->where('id','=',$id)->first();
        // mb_substr 截取字符串
        // $str = mb_substr($data->u_address,'-');
        // dd($data);
        // 加载修改地址模板
        return view('Home.gerenzhongxin.dizhixiugai',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // 地址修改操作
    public function update(Request $request, $id)
    {
        $data = $request->except('_token','_method');
        $hid = session('hid');
        $data['user_id'] = $hid;
        $data['default'] = '0';
        // dd($data);
        if(DB::table('address')->where('id','=',$id)->update($data)){
            return redirect('/address')->with('success','地址修改成功');
        }else{
            return redirect('/address')->with('error','地址修改失败');
        }
    }

    // 地址删除
    public function addrdel(Request $request){
        $id = $_GET['id'];
        // echo $id;
        if(DB::table('address')->where('id','=',$id)->delete()){
            return redirect('/address')->with('success','地址删除成功');
        }else{
            return redirect('/address')->with('error','地址删除失败');
        }
    }

    // 地址默认设置
    public function moren($id){
        $uid = session('hid');
        // 先把用户id的default为1改为0
        DB::table('address')->where('user_id','=',$uid)->where('default','=',1)->update(['default'=>0]);
        // 然后再把id为0的default改为1
        DB::table('address')->where('id','=',$id)->update(['default'=>1]);
        // 跳转返回
        return redirect('/address');  
    }


    public function destroy($id)
    {

    }
}
