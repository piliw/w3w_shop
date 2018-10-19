<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// 导入模型类
use App\Models\Lunbotu;
use App\Models\Abs;
use DB;
class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function getCatesBypid($pid){
        // 获取分类表
        $res = DB::table('cate')->where('pid','=',$pid)->get();
        // 遍历数据
        foreach($res as $key=>$value){
            // 获取当前分类信息子类信息
            $value->dev=self::getCatesBypid($value->id);
            $data[]=$value;
        } 
        return $res;
    }

    public function index(Request $request)
    {
        // 广告数据
        $abs = Abs::where('status','=',0)->get();
        // 插入轮播图图片路径数据
        $pic = Lunbotu::where('status','=',0)->get();
        // dd($data);
        // 获取分类数据
        // $cate = DB::table('cate')->get();
        $cate = self::getCatesBypid(0);
        // dd($cate);
            //加载前台首页 
            return view('Home.index',['pic'=>$pic,'cate'=>$cate,'abs'=>$abs]);
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
}
