<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 获取session里的商品信息
        $res=session('cart');
        $result=[];
        // 总计
        $total='';
        // 总条数
        foreach($res as $key=>$value){
            $info=DB::table('goods')->join('pic_url','goods.id','=','pic_url.gid')->select('goods.*','pic_url.p_url')->where('goods.id','=',$value['id'])->where('pic_url.main','=',1)->first();
            // dd($info);
            $row['name']=$info->name;
            $row['price']=$info->price;
            $row['p_url']=$info->p_url;
            $row['size']=$info->size;
            $row['num']=$value['num'];
            $total+=$row['price']*$row['num'];
            // 商品的条数的小计
            $row['toot']=$row['price']*$row['num'];
            $row['id']=$value['id'];
            $result[]=$row;
        }
        // dd($result);
        // 获取登录的用户
        $sid=session('hid');
        // 获取收货地址的数据
        $data1=DB::table('address')->where('user_id','=',$sid)->get();
        // dd($data1);
        // 加载订单模板
        return view("Home.orders.orders",['sid'=>$sid,'data1'=>$data1,'result'=>$result,'total'=>$total]);
        
    }

    // 删除收货地址
    public function del(Request $request)
    {
        $id=$request->input('id');
        if(DB::table('address')->where('id','=',$id)->delete()){
            echo 1;
        }else{
            echo 2;
        }
    }

    // 提交的订单
    public function ordershop(Request $request)
    {
        dd($request->all());
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
        $data=($request->all());
        // dd($data);
        if(DB::table('address')->insert($data)){
            echo 1;
        }else{
            echo 2;
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
}