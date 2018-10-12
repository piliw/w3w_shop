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
        return view("Admin.Order.order",["user"=>$user,'usera'=>$usera,'userb'=>$userb,'userc'=>$userc,'userd'=>$userd]);
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
        //订单详情
        return view("/Admin.Order.order_info");
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
