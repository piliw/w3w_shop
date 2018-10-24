<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class PayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
        // echo $id;die;
        // $data=DB::table('order')->join('order_info','order.id','=','order_info.order_id')->join('goods','goods.id','=','order_info.goods_id')->select('order.o_number','goods.name','goods.summ')->where('order.id','=',$id)->get();
        $data=DB::table('order')->where('id','=',$id)->first();
        // dd($data);
        pay($data->o_number,'唯尚依族收款界面','0.01','支付订单款项');
    }

    // 支付成功通知界面
    public function returnurl(Request $request)
    {
        $info=$request->only('out_trade_no');
        // 支付的时间
        $paytime=time();
        // echo "123";
        DB::table('order')->where('o_number','=',$info)->update(['status'=>1,'paytime'=>$paytime]);


        return view("Home.Payment.emptypay");
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
