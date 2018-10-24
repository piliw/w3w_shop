<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Link;
class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Link::get();
        // 加载友情管理模板
        return view('Admin.youqing.list',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Link::where('status','=',1)->get();
        // 加载友情前台链接
        return view('Home.youqing.add',['data'=>$data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //插入数据库
        // $data = $request->all();
        // dd($data);
        $data =$request->except('_token');
        $data['status']=0;
        if(Link::create($data)){
            return back()->with('success','申请成功，请等待审核');
        }else{
            return back()->with('error','申请失败');
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
     // ajax状态更改状态操作
    public function link_status(Request $request){
        // echo 1;
        $id = $request->input('id');
        // echo $id;
        $data = Link::where('id','=',$id)->value('status');
        // echo $data;
        // 将状态更改
        if($data == 0){
            $data = Link::where('id','=',$id)->update(['status'=>1]);
            echo $data;
        }else{
            $data =Link::where('id','=',$id)->update(['status'=>0]);
            echo $data;
        }
    }
     public function linkdel(Request $request)
    {
        $id = $request->input('id');
        // echo $id;
        if(Link::where('id','=',$id)->delete()){
            echo 1;
        }else{
            echo 2;
        }
    }

}
