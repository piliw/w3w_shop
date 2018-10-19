<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Notece;
class NoteceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 获取数据
        $data=Notece::get();
        //加载公告模板
        return view('Admin.notece.list',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //加载添加公告模板
        return view('Admin.notece.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // 获取输数据
        $data =$request->except('_token');
        if(Notece::create($data)){
            echo'添加公告成功';
        }else{
            return redirect('/notece/create');
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
        $data=Notece::where('id','=',$id)->first();
        return view('Admin.notece.edit',['data'=>$data]);
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
        // dd($request->all());
        $data = $request->except(['_token','_method']);
        // 判断是否改变为下架状态
        if($data['status']==1){
            $data['ntime']=date('Y-m-d H:i:s');
        }
        if(Notece::where('id','=',$id)->update($data)){
            echo'修改成功';
        }else{
            echo'修改失败';
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
        //
    }
    public function notecedel(Request $request)
    {
        $id = $request->input('id');
        // echo $id;
        if(Notece::where('id','=',$id)->delete()){
  
            echo 1;
        }else{
            echo 2;
        }
    }
}
