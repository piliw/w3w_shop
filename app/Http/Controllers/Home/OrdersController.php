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
            // 总计
            $total+=$row['price']*$row['num'];
            // 商品条数的小计
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
        return view("Home.orders.ordera",['sid'=>$sid,'data1'=>$data1,'result'=>$result,'total'=>$total]);
        
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

    // 立即购买商品提交的商品处理
    public function ordershop(Request $request)
    {
        // 获取收货人信息
        $pres=$request->except('_token');
        // dd($pres);
        $o_number = date('Ymd').time().mt_rand(0,99999);
        // 下单时间
        $addtime=time();
        // 获取用户id
        $id=session('hid');
        $oid=DB::table('order')->insertGetId(['user_id'=>$id,'o_number'=>$o_number,'name'=>$pres['name'],'address'=>$pres['address'],'total'=>$pres['total'],'status'=>0,'addtime'=>$addtime,'o_phone'=>$pres['phone']]);
            // dd($id);
            if($id>0){
                // $info=$request->only('id','num','price');
                // dd($info);
                $oiid=DB::table('order_info')->insert(['order_id'=>$oid,'goods_id'=>$pres['id'],'g_number'=>$pres['num'],'g_price'=>$pres['price'],'g_total'=>$pres['num']*$pres['price']]);
               // dd($oiid);
             // 获取订单数据
            $data=DB::table('order')->where('id','=',$oid)->first();
            }

            return view("Home.Payment.payment",['data'=>$data]);
    }

    // 购物车购买的商品处理
     public function ordershopa(Request $request)
    {
        // 获取收货人信息
        $prea=$request->except('_token');
        // dd($prea);
        $o_number = date('Ymd').time().mt_rand(0,99999);
        // 下单时间
        $addtime=time();
        // 获取用户id
        $id=session('hid');
        $pda=session('cart');
        // dd($pda);
        $totals=$pda[0]['num']*$pda[0]['price'];
            $aid=DB::table('order')->insertGetId(['user_id'=>$id,'o_number'=>$o_number,'name'=>$prea['name'],'address'=>$prea['address'],'total'=>$prea['total'],'status'=>0,'addtime'=>$addtime,'o_phone'=>$prea['phone']]);
            // dd($aid);
            if($aid>0){
                foreach($pda as $key){
                    // dd($key);
                    DB::table('order_info')->insert(['order_id'=>$aid,'goods_id'=>$key['id'],'g_number'=>$key['num'],'g_price'=>$key['price'],'g_total'=>$key['num']*$key['price']]);
                }
                $request->session()->pull('cart');
                // 获取订单数据
                $data=DB::table('order')->where('id','=',$aid)->first();
            }
            return view("Home.Payment.payment",['data'=>$data]);
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
