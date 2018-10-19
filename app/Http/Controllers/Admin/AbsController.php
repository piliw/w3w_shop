<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Abs;
use DB;
class AbsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 获取Abs数据
        $data = Abs::get();
        //加载广告管理模板
        return view('Admin.abs.list',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    
        //加载添加模板
        return view('Admin.abs.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        // 获取输数据
        $data =$request->except('_token');
        $data['created_at']=date('Y-m-d H:i:s');
        // dd($data);
        //文件上传操作
        // 1判断是否有文件上传
        if($request->hasFile('file')){
           // 2将上传的文件移动到指定的目录下
           // 初始化文件 
           $pic = time()+rand(1,100);
           // 获取文件后缀;
           $ext = $request->file('file')->getClientOriginalExtension();
           $newPath=$request->file('file')->move('./abs/',$pic.'.'.$ext);
        }
        // dd($newPath);
        // 获取图片路径
        $data['file']=$newPath->getPathName();
        $data['pic']=$newPath->getPathName();
        // dd($data);
        if(Abs::create($data)){
            echo '添加成功';
        }else{
            return redirect('/abs/create');
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
        $data = Abs::where('id','=',$id)->first();
        //加载编辑模板
        return view('Admin.abs.edit',['data'=>$data]);
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
        // echo $id;
        // 获取修改后的数据
        // dd($request->all());
        // 去除method 和 _token
        // 获取原上传图片名字
         $yfile=$request['yfile'];
         // dd($yfile);
         $data = $request->except(['_token','_method','yfile']);
        //文件上传操作
        // 1判断是否有文件上传
        if($request->hasFile('file')){
           // 2将上传的文件移动到指定的目录下
           // 初始化文件 
           $pic = time()+rand(1,100);
           // 获取文件后缀;
           $ext = $request->file('file')->getClientOriginalExtension();
            // 获取图片路径
           $newPath=$request->file('file')->move('./abs/',$pic.'.'.$ext);
            // dd($newPath);
            $data['file']=$newPath->getPathName(); 
            $data['pic']=$newPath->getPathName();      
        }
        // 若有新上传图片，删除原来图片
        if($request->hasFile('file')){
         unlink($yfile);
        }
        // dd($data);
        if(Abs::where('id','=',$id)->update($data)){
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
    public function absdel(Request $request)
    {
        $id = $request->input('id');
        // echo $id;
        $path=Abs::where('id','=',$id)->first();
        // 获取图片路径
        $paths=$path['pic'];
        // echo $paths;
        if(Abs::where('id','=',$id)->delete()){
            // 删除图片
            unlink($paths);
            echo 1;
        }else{
            echo 2;
        }
    }

}
