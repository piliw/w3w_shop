<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// 引入数据库类
use DB;

class listController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // 递归分类
    public function getCatesBypid($pid){
    $s=DB::table("cate")->where("pid",'=',$pid)->get();
    //遍历
    $data=[];
    foreach($s as $key=>$value){
    $value->dev=$this->getCatesBypid($value->id);
    $data[]=$value;
    }
    return $data;
    }


    // 列表首页
    public function index(Request $request)
    {
        // 获取品牌数据
        $brand = DB::table('admin_brand')->get();
        // 获取品牌商品
        
        // dd($brand);
        // 获取分类数据
        $cate=$this->getCatesBypid(0);
        // dd($cates);
        // 获取商品数据
         $goods = DB::table('goods')
        ->join('pic_url','pic_url.gid','=','goods.id')
        ->join('cate','cate.id','=','goods.cate_id')
        ->select('goods.id','goods.name','price','summ','pic_url.p_url','cate.id')
        ->where('pic_url.main','=',1)->where('goods.status','=',1)->get();
        // dd($goods);
        
        // 首页和列表的方法
        // 判断是否为post的数据
        if($request->isMethod('post')){
            // 获取搜索表单信息
            $data = $request->input('keywords');
            // 查询
            $goods = DB::table('goods')->join('pic_url','pic_url.gid','=','goods.id')->where('name','like','%'.$data.'%')->where('pic_url.main','=',1)->where('goods.status','=',1)->get();
            // dd($goods);
            // 加载模板分配数据
            return view('Home.list.index',['brand'=>$brand,'cate'=>$cate,'goods'=>$goods]);
        }

        // 判断是否为ajax请求
        if(!$request->ajax()){
            // 获取商品
            // 获取无限分类
            // 加载模板
            return view('Home.list.index',['brand'=>$brand,'cate'=>$cate,'goods'=>$goods]);
        }
        // 获取此类id
        $id = $request->get('id');
        // echo $id;
        // 获取当前分类下的所有商品
        $res = DB::table('goods')->join('cate','goods.cate_id','=','cate.id')->join('pic_url','pic_url.gid','=','goods.id')->select(DB::raw('*,cate.id as cid,cate.name as cname,goods.id as gid,goods.name as gname,pic_url.p_url as pp'))->where('goods.cate_id','=',$id)->where('pic_url.main','=',1)->where('goods.status','=',1)->get();
        echo json_encode($res);
        
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
