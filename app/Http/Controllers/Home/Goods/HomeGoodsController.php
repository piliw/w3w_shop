<?php

namespace App\Http\Controllers\Home\Goods;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class HomeGoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

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
        //商品展示
        $data=DB::table('goods')->where('id','=',$id)->first();
        //获取图片
        $photo=DB::table('pic_url')->where('gid','=',$id)->get();
        //当前分类
        $cate=DB::table('cate')->where('id','=',$data->cate_id)->select('id','name')->first();
        //获取当前分类下的商品 取6条
        $categoods=DB::table('goods')->join('pic_url','pic_url.gid','=','goods.id')->select('goods.id','goods.name','summ','price','pic_url.p_url')->where('pic_url.main','=',1)->where('cate_id','=',$cate->id)->where('goods.status','=',1)->where('goods.store','>',0)->orderBy('sales','desc')->limit(6)->get();
        //$data->cate_id重新赋值
        $data->cate_id=$cate->name;

        // 购物车显示,获取sessio的商品cart1
        $data1=session('cart');
        // dd($data1);
        $datas=[];
        // 获取用户id
        if(!empty($data1)){
            foreach($data1 as $key=>$value){
                // dd($value['id']);
                $result=DB::table('goods')->join('pic_url','pic_url.gid','=','goods.id')->select('goods.name as gname','pic_url.p_url')->where('goods.id','=',$value['id'])->where('pic_url.main','=',1)->first();
                $row['name']=$result->gname;
                $row['p_url']=$result->p_url;
                $datas[]=$row;
            }
        // dd($datas);
        }
        return view('Home.Goods.xiangqingye',['data'=>$data,'photo'=>$photo,'categoods'=>$categoods,'datas'=>$datas]);
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
