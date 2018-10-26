<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //判断是否为Ajax请求
        if($request->ajax()){
            // 获取附加订单状态的status
            $id=$request->input('id'); 
            // 获取用户id
            $nid=session('hid');
            // echo $hid;
            // 当id==5时全查
            if($id==5){
                $data1=DB::table('order')->where('user_id','=',$nid)->get();
                // dd($data);
                $info=[];
                foreach($data1 as $key=>$value){
                    $value->addtime=date('Y-m-d',$value->addtime);
                    $value->dev=DB::table('order_info')->join('goods','order_info.goods_id','=','goods.id')->join('pic_url','goods.id','=','pic_url.gid')->select('order_info.*','goods.*','pic_url.p_url')->where('order_info.order_id','=',$value->id)->where('pic_url.main','=',1)->get();
                $info[]=$value;
                }
            }else{
               $data1=DB::table('order')->where('order.status','=',$id)->where('user_id','=',$nid)->get();
               // dd($data);
               $info=[];
               foreach($data1 as $key=>$value){
                    $value->addtime=date('Y-m-d',$value->addtime);
                    $value->dev=DB::table('order_info')->join('goods','order_info.goods_id','=','goods.id')->join('pic_url','goods.id','=','pic_url.gid')->select('order_info.*','goods.*','pic_url.p_url')->where('order_info.order_id','=',$value->id)->where('pic_url.main','=',1)->get();
                    $info[]=$value;
               }
            }
           // dd($info);
           echo json_encode($info);
        }
    }

    // 确认收货
    public function affirm($id){
        $pid=$id;
        DB::table('order')->where('id','=',$id)->update(['status'=>3]);
        return view("Home.orders.affirm",['pid'=>$pid]);
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

    // 商品评价
    public function evaluate($id)
    {
        // dd($id);
        // 获取个人用户详情
        $hid = session('hid');
        $hname=DB::table('user_info')->where('user_id','=',$hid)->first();
        $goodsinfo=DB::table('order')->join('order_info','order.id','=','order_info.order_id')->join('goods','order_info.goods_id','=','goods.id')->join('pic_url','goods.id','=','pic_url.gid')->select('order.user_id','order_info.*','goods.name','pic_url.p_url')->where('order.id','=',$id)->where('order.user_id','=',$hid)->where('pic_url.main','=',1)->get();
        // dd($goodsinfo);
        //加载用户评价模板
        return view('Home.pingjia.add',['goodsinfo'=>$goodsinfo,'hname'=>$hname]);
      
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');
        $oid = $request->input('order_id');
        DB::table('order')->where('id','=',$oid)->update(['status'=>4]);       
        return view("Home.orders.evaluate"); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // echo $id;
        $data=DB::table('order')->where('id','=',$id)->first();
        // dd($data);
        return view("Home.Payment.payment",['data'=>$data]);
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
