<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
// 引入模型类
use App\Models\Appraise;
class AppraiseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 获取数据
        $data = Appraise::get();
        //加载评价模板
        return view('Admin.appraise.list',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }
    public function goapp($id)
    {
        // dd($id);
        // 获取个人用户详情
        // session判断是否有值
        if(session()->has('hname')){
            $value = session('hid');
            $data = DB::table('user')->where('id','=',$value)->first();
            $datas = DB::table('user_info')->where('user_id','=',$value)->first();
           // 获取订单信息
           // 获取订单号
           // dd($id);
            $order = DB::table('order_info')->where('order_id','=',$id)->first(); 
            // dd($order);
            $goods = DB::table('goods')->where('goods.id','=',$order->goods_id)->first();
            // dd($res);
            $pic = DB::table('pic_url')->where('gid','=',$goods->id)->where('main','=',1)->first();
            // dd($pic);
            //加载用户评价模板
             return view('Home.pingjia.add',['data'=>$data,'datas'=>$datas,'order'=>$order,'goods'=>$goods,'pic'=>$pic]);
        }else{
            // 跳转到登录
            return redirect('/homelogin');
        }
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
        // dd($request->all());
        $data['addtime']=date('Y-m-d H:i:s');
        dd($data);
        if(Appraise::create($data)){
            return redirect("/zhuce/{{$data->user_id}}")->with('success','评价成功');
        }else{
            return redirect('/appraise/create');
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
    public function appraisedel(Request $request){
        $id = $request->input('id');
        // echo $id;
        // echo $paths;
        if(Appraise::where('id','=',$id)->delete()){
            echo 1;
        }else{
            echo 2;
        }
    }
}
