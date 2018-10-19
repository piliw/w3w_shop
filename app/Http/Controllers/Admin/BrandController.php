<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// 导入模型类
use App\Models\Brand;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        // 加载数据库
        $data = Brand::get();
        //加载品牌模板
        return view('Admin.brand.list',['data'=>$data,'request'=>$request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //加载添加品牌模板
        return view('Admin.brand.add');
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
        $data['add_time']=date('Y-m-d H:i:s');
        // dd($data);
        //文件上传操作
        // 1判断是否有文件上传
        if($request->hasFile('logo')){
           // 2将上传的文件移动到指定的目录下
           // 初始化文件 
           $pic = time()+rand(1,100);
           // 获取文件后缀;
           $ext = $request->file('logo')->getClientOriginalExtension();
           $newPath=$request->file('logo')->move('./logo/',$pic.'.'.$ext);
        }
        // dd($newPath);
        // 获取图片路径
        $data['logo']=$newPath->getPathName();

        // dd($path);
        if(Brand::create($data)){
            echo '添加成功';
        }else{
            return redirect('/brand/create');
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
        $data = Brand::where('id','=',$id)->first();
        //加载编辑模板
        return view('Admin.brand.edit',['data'=>$data]);
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
         $ylogo=$request['ylogo'];
         // dd($ylogo);
         $data = $request->except(['_token','_method','ylogo']);
        //文件上传操作
        // 1判断是否有文件上传
        if($request->hasFile('logo')){
           // 2将上传的文件移动到指定的目录下
           // 初始化文件 
           $pic = time()+rand(1,100);
           // 获取文件后缀;
           $ext = $request->file('logo')->getClientOriginalExtension();
            // 获取图片路径
           $newPath=$request->file('logo')->move('./logo/',$pic.'.'.$ext);
            // dd($newPath);
            $data['logo']=$newPath->getPathName();     
        }
        // 若有新上传图片，删除原来图片
        if($request->hasFile('logo')){
         unlink($ylogo);
        }
        // 判断是否改变上架状态
        if($data['status']==1){
            $data['ntime']=date('Y-m-d H:i:s');
        }
        if(Brand::where('id','=',$id)->update($data)){
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

    public function branddel(Request $request)
    {
        $id = $request->input('id');
        // echo $id;
        $path=Brand::where('id','=',$id)->first();
        // 获取图片路径
        $paths=$path['logo'];
        if(Brand::where('id','=',$id)->delete()){
            // 删除图片
            unlink($paths);
            echo 1;
        }else{
            echo 2;
        }
    }
}
