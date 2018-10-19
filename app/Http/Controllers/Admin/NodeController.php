<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class NodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 获取数据
        $data = DB::table('role')->get();
        //加载模板
        return view('Admin.admin_user.node',['data'=>$data]);
    }

    // 分配权限
    public function auth($id)
    {
        // 获取当前角色
        $role = DB::table('role')->where('id','=',$id)->first();
        // 获取所有权限
        $auth = DB::table('node')->get();
        // 获取当前角色已有的权限列表
        $data = DB::table('node_role')->where('rid','=',$id)->get();
        // 判断
        if(count($data)){
            // 遍历
            foreach($data as $v){
                $nids[] = $v->nid;
            }
          return view('Admin.admin_user.node-edit',['role'=>$role,'auth'=>$auth,'nids'=>$nids]);  
        }else{
          return view('Admin.admin_user.node-edit',['role'=>$role,'auth'=>$auth,'nids'=>array()]);     
        }
        
    }

    // 保存权限
    public function saveauth(Request $request)
    {
        // dd($request->all());
        // user_role插在数据
        // uid 角色id   rid 节点id
        // 获取角色id
        $rid = $_POST['rid'];
        // dd($uid);
        // 获取节点id
        $nids=$_POST['nids'];
        // dd($rids);
        // 删除当前角色已有的权限
        DB::table('node_role')->where('rid','=',$rid)->delete();
        // 遍历
        foreach($nids as $key=>$value){
            // 入库操作
            $data['rid']=$rid;
            $data['nid']=$value;
            // 插入
            DB::table('node_role')->insert($data);
        }
        echo'添加成功';
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
