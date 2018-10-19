<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
// 导入模型类
use App\Models\Lunbotu;
class LunbotuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
       // 加载列表视图
       $data=Lunbotu::get();
       // dd($data);
       // dd(1);
       return view('Admin.lunbotu.list',['data'=>$data,'request'=>$request->all()]);
       // 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
       //加载轮播图添加模板
        return view('Admin.lunbotu.add');
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
        // 获取输数据
        $data =$request->except('_token');
        // $data['created_ad']=time();
        // dd($data);
        //文件上传操作
        // 1判断是否有文件上传
        if($request->hasFile('path')){
           // 2将上传的文件移动到指定的目录下
           // 初始化文件 
           $pic = time()+rand(1,100);
           // 获取文件后缀;
           $ext = $request->file('path')->getClientOriginalExtension();
           $newPath=$request->file('path')->move('./uploads/'.date("Y-m-d")."/",$pic.'.'.$ext);
        }
        // dd($newPath);
        // 获取图片路径
        $data['path']=$newPath->getPathName();

        // dd($path);
        if(Lunbotu::create($data)){
            echo '添加成功';
        }else{
            return redirect('/lunbotu/create');
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
        // 获取关联的id
        // dd($id);
        $pic= Lunbotu::where('id','=',$id)->first();
        return view('Admin.lunbotu.show',['pic'=>$pic]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //加载编辑模板
        // echo $id;
        $data= Lunbotu::where('id','=',$id)->first();
        // dd($data);
        return view('Admin.lunbotu.edit',['data'=>$data]);
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
         $ypic=$request['pth'];
         $data = $request->except(['_token','_method','pth']);
   
         // dd($ypic);
        //文件上传操作
        // 1判断是否有文件上传
        if($request->hasFile('path')){
           // 2将上传的文件移动到指定的目录下
           // 初始化文件 
           $pic = time()+rand(1,100);
           // 获取文件后缀;
           $ext = $request->file('path')->getClientOriginalExtension();
           $newPath=$request->file('path')->move('./uploads/'.date("Y-m-d")."/",$pic.'.'.$ext);
            $data['path']=$newPath->getPathName(); 
            $num=$request->hasFile('path');      
        }
        // 获取图片路径
        // dd($newPath);

        // 若有新上传图片，删除原来图片
        if($request->hasFile('path')){
         unlink($ypic);
        }
        if(Lunbotu::where('id','=',$id)->update($data)){
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
        
    }

    public function lunbotudel(Request $request)
    {
        $id = $request->input('id');
        // echo $ypic;
        $path=Lunbotu::where('id','=',$id)->first();
        // 获取图片路径
        $paths=$path['path'];
        if(Lunbotu::where('id','=',$id)->delete()){
            // 删除图片
            unlink($paths);
            echo 1;exit;
        }else{
            echo 2;exit;
        }
    }
}
