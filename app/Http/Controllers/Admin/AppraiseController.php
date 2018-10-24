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
        // dd($data);
        if(Appraise::create($data)){
            echo'评论成功';
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
        // 获取个人用户详情
        // session判断是否有值
        if(session()->has('hname')){
            $value = session('hid');
            $data = DB::table('user')->where('id','=',$value)->first();
            $datas = DB::table('user_info')->where('user_id','=',$value)->first();
            // 加载模板
        //加载用户评价模板
        return view('Home.pingjia.add',['data'=>$data,'datas'=>$datas]);
        }else{
            // 跳转到登录
            return redirect('/homelogin');
        }
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
