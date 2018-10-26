<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class CateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //加载分类管理模板
        return view('Admin.Cate.category');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //获取添加等级号
        $type=$request->input('type');
        // 判断是否有文件上传
        if($request->hasFile('pic')){
            // 初始化文件名
            $name=time().rand(1,10000);
            //获取文件后缀名
            $ext=$request->file('pic')->getClientOriginalExtension();
            //初始化文件夹
            $dir='/uploads/'.date('Y-m-d').'/';
        }
        if($type==0){
            // 添加一级分类
            $data['name']=$request->input('name');
            $data['display']=$request->input('display');
            $data['pid']=0;
            $data['path']='0,';
            $data['curl']=$dir.$name.'.'.$ext;
            if(DB::table('cate')->insert($data)){
                // 存储图片
                $request->file('pic')->move('.'.$dir,$name.'.'.$ext);
                 return redirect('/categoryadd')->with('error','分类添加成功!');
            }else{
                return redirect('/categoryadd')->with('error','分类添加失败,请重新添加!');
            }
        }else{
            //添加子分类
            $pid=$request->input('pid');
            $path=DB::table('cate')->where('id','=',$pid)->first();
            $data['name']=$request->input('name');
            $data['pid']=$pid;
            $data['path']=$path->path.$path->id.',';
            $data['display']=$request->input('display');
            $data['curl']=$dir.$name.'.'.$ext;
            if(DB::table('cate')->insert($data)){
                  // 存储图片
                $request->file('pic')->move('.'.$dir,$name.'.'.$ext);
                return redirect('/categoryadd')->with('error','分类添加成功!');
            }else{
                return redirect('/categoryadd')->with('error','分类添加失败,请重新添加!');
            }
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
        //分类信息
        $cate=DB::table('cate')->where('id','=',$id)->first();
        $display=['禁用','启用'];
        $cate->display=$display[$cate->display];
        return view('Admin.Cate.catelist',['cate'=>$cate]);

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
        $cate=DB::table('cate')->where('id','=',$id)->first();
        return view('Admin.Cate.edit',['cate'=>$cate]);
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

    public function cateAdd(){
        //加载添加分类模板
        return view('Admin.Cate.category-add');
    }

    public function getCates(){
        //获取分类信息
        $cates=DB::table('cate')->select('id','pid','name','display')->get();
        foreach($cates as $key=>$val){
                if($val->display==0){
                     $cates[$key]->name .= '(已禁用)';
                }
                if($val->pid==0){
                    $cates[$key]->open=true;
                }
        }
        echo json_encode($cates);
    }

    public function getCate(Request $request){
        $cate=$request->input('cate');
         //获取分类信息
        $cates=DB::table('cate')->select('id','name','path')->orderBy('path','asc')->get();
        foreach($cates as $key=>$val){
                // 获取二级分类名
               if($cate==1){
                    if(substr_count($val->path,',')==1){
                        $data[]=$val;
                    }
               }

               // 获取三级分类名
                if($cate==2){
                    if(substr_count($val->path,',')==2){
                        $data[]=$val;
                    }
               }
        }
        echo json_encode($data);
    }

    // 修改下拉列表获取数据
    public function getCateAll(){
          $cate=DB::table("cate")->select(DB::raw('*,concat(path,id,",") as paths'))->orderBy('paths')->get();
          foreach($cate as $key=>$value){
            // echo $value->path."<br>";
            //转换为数组
            $arr=explode(",",$value->path);
            // echo "<pre>";
            // var_dump($arr);
            //获取逗号个数
            $len=count($arr)-1;
            //给当前分类添加分割符
            $cate[$key]->name=str_repeat("--|",$len).$value->name;
        }
          echo json_encode($cate);
    }

    public function cateOne(Request $request){
            $id=$request->input('id');
            $info=DB::table('cate')->where('id','=',$id)->first();
            echo json_encode($info);
    }
    
    //修改分类
    public function cateUpdate(Request $request){
        $id=$request->input('id');
        $data=$request->except('id','_token','pic');
        if($request->hasFile('pic')){
             // 初始化文件名
            $name=time().rand(1,10000);
            //获取文件后缀名
            $ext=$request->file('pic')->getClientOriginalExtension();
            //初始化文件夹
            $dir='/uploads/'.date('Y-m-d').'/';
            $data['curl']=$dir.$name.'.'.$ext;
            //获取原来图片
            $inof=DB::table('cate')->select('curl')->where('id','=',$id)->first();
            $old=$inof->curl;
        }
        if(DB::table('cate')->where('id','=',$id)->update($data)){
            if($request->hasFile('pic')){
                $request->file('pic')->move('.'.$dir,$name.'.'.$ext);
                unlink('.'.$old);
            }
            echo "修改成功";
        }else{
            echo '修改失败';
        }
    }

    public function delete(Request $request){
        //分类删除
        $id=$request->input('id');
        if(count(DB::table('cate')->where('pid','=',$id)->get())>0){
                // echo '该分类下有子分类,请先删除子分类在执行操作';
               return redirect('/category/'.$id)->with('error','该分类下有子分类,请先删除子分类在执行操作');
        }elseif(count(DB::table('goods')->where('cate_id','=',$id)->get())>0){
                    return redirect('/category/'.$id)->with('error','该分类下有商品,请先修改商品信息');
        }else{
            $info=DB::table('cate')->select('curl')->where('id','=',$id)->first();
            $old=$info->curl;
            if(DB::table('cate')->where('id','=',$id)->delete()){
                unlink('.'.$old);
                return redirect('/categoryadd')->with('error','分类删除成功');
            }
        }
    }

    //分类状态改变
    public function display(Request $request){
        $id=$request->input('id');
        $display=$request->input('display');
        if($display==1){
            if(DB::table('cate')->where('id','=',$id)->update(['display'=>0])){
                echo 0;
            }
        }else{
            if(DB::table('cate')->where('id','=',$id)->update(['display'=>1])){
                echo 1;
            }
        }
    }
}
