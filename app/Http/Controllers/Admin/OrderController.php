<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //后台订单模块
        $user=DB::table('order')->get();
        // 未付款状态为0的
        $usera=DB::table('order')->where('status','=',0)->get();
        // 已付款状态为1的
        $userb=DB::table('order')->where('status','=',1)->get();
        // 待收货状态为2的
        $userc=DB::table('order')->where('status','=',2)->get();
        // 已收货状态为3的
        $userd=DB::table('order')->where('status','=',3)->get();
        // dd($userd);
        // 获取相关订单商品信息
        // $data=$this->show();
        return view("Admin.Order.order",["user"=>$user,'usera'=>$usera,'userb'=>$userb,'userc'=>$userc,'userd'=>$userd]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $id=$request->input('id');
        $info=DB::table('order')->where('id','=',$id)->first();
        return view("Admin.Order.cargo",['info'=>$info]);
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
        $id=$request->input('id');
        $result=$request->only('send_area','send_number','send_code');
        $result['send_time']=time();
        $result['status']=2;
        // dd($result);
        DB::table('order')->where('id','=',$id)->update($result);
        echo '发货成功';
    }

    // 查看物流信息
    public function logistics($id){
        // echo $id;
        $sult=DB::table('order')->where('id','=',$id)->first();
        $res=$sult->send_code;
        $req=$sult->send_number;
        $sarea=$sult->send_area;
        // 传参到物流接口
        $info=getExpress($res,$req);
        return view('Home.orders.express',['info'=>$info,'sarea'=>$sarea,'req'=>$req]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //订单详情
        // dd($id);
        $data=DB::table('order_info')->join('goods','order_info.goods_id','=','goods.id')->join('pic_url','goods.id','=','pic_url.gid')->select('goods.*','order_info.*','pic_url.*')->where('pic_url.main','=',1)->where("order_info.order_id",'=',$id)->get();
        // dd($data);
        return view("Admin.Order.shot",['data'=>$data]);
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
