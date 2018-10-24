<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
// 模型类
use App\Models\AdminNode;
class NodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // 权限管理
    public function index()
    {
        // 获取数据
        $data = DB::table('role')->get();
        //加载模板
        return view('Admin.node.node',['data'=>$data]);
    }

    // 分配角色
    public function rolelist(Request $request){
        // 获取get参数
        $id = $_GET['id'];
        // echo $id;
        // 获取管理员信息
        $adminuser = DB::table('admin_user')->where('id','=',$id)->first();
        // 获取角色信息
        $data = AdminNode::where('uid','=',$id)->first();
        // dd($role);
        // 加载模板
        return view('Admin.node.node-level',['adminuser'=>$adminuser,'data'=>$data]);
    }
    // 保存角色
    public function saverole(Request $request){
        // 获取表单信息
        $role['rid'] = $request->input('rid');
        $role['uid'] = $request->input('uid');
        // dd($role);
        // 判断是否有值
        $data = DB::table('user_role')->where('uid','=',$role['uid'])->first();
        if($data){
            // 修改
            if(DB::table('user_role')->where('uid','=',$role['uid'])->update($role)){
                // 修改成功
                return back()->with('success','重新分配成功');
            }else{
                // 修改失败
                return back()->with('error','重新分配失败');
            }
        }else{
            // 添加
            if(DB::table('user_role')->where('uid','=',$role['uid'])->insert($role)){
                // 添加成功
                return back()->with('success','分配成功');
            }else{
                // 添加失败
                return back()->with('error','分配失败');
            }
        }
    }

    // 角色列表
    public function roles(){
        // echo 1;
        // 获取表数据
        // $data = DB::table('role')->get();
        $data = DB::select('select au.id,au.username,r.name from admin_user as au,user_role as ur,role as r where au.id=ur.uid and ur.rid=r.id');
        // dd($data);
        // 加载模板
        return view('Admin.node.node-list',['data'=>$data]);
    }
    // ajax角色删除
    public function rolesdel(Request $request){
        $id = $request->input('id');
        // echo $id;
        if(DB::table('user_role')->where('uid','=',$id)->delete()){
            echo 1;
        }else{
            echo 2;
        }
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
          return view('Admin.node.node-edit',['role'=>$role,'auth'=>$auth,'nids'=>$nids]);  
        }else{
          return view('Admin.node.node-edit',['role'=>$role,'auth'=>$auth,'nids'=>array()]);     
        }
        
    }

    // 保存权限
    public function saveauth(Request $request)
    {
        // dd($request->all());
        // user_role插入数据
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
        return redirect('/auth/'.$rid)->with('success','分配成功');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // 权限列表
    public function nodelist(){
        // 获取表数据
        $data = DB::table('node')->get();
        // 加载模板
        return view('Admin.node.nodelist',['data'=>$data]);
    }

    // 添加权限
    public function create()
    {  
        // 加载模板
        return view('Admin.node.node-add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    // 权限添加操作
    public function store(Request $request)
    {
        $data = $request->except('_token');
        // dd($data);
        // 插入数据
        $res = DB::table('node')->insert($data);
        if($res){
            echo '<h2>添加成功,点击右上角关闭后刷新页面...</h2>';
        }else{
            echo '<h2>添加成功,点击右上角关闭后刷新页面...</h2>';
        }
    }

    // ajax权限删除
    public function nodedel(Request $request){
        $id = $request->input('id');
        // echo $id;
        if(DB::table('node')->where('id','=',$id)->delete()){
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
    
    // 修改权限
    public function edit($id)
    {
        // echo 1;
        // 获取数据
        $data = DB::table('node')->where('id','=',$id)->first();
        // 加载模板
        return view('Admin.node.nodeedit',['data'=>$data]);
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
        // echo 1;
        // 获取表单数据
        $data = $request->except(['_token','_method']);
        // dd($data);
        // 判断并修改
        if(DB::table('node')->where('id','=',$id)->update($data)){
            return back()->with('success','修改成功');
        }else{
            return back()->with('error','修改失败');
        }
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
