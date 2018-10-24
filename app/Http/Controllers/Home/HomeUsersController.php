<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// 引入数据库操作
use DB;
// 引入哈希加密
use Hash;
// 引入配置类
use Config;
// 引入邮箱类
use Mail;

class HomeUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 加载注册模板
        return view('Home.zhuce.index');
    }

    // 自定义短信接口调用
    public function demo(Request $request){
        return view('Home.zhuce.demo');
    }

    // ajax短信校验
    public function code(Request $request){
        //获取输入的校验码
        $code=isset($_GET['code'])?$_GET['code']:'';
        // echo $code;
        if(isset($_COOKIE['fcode']) && !empty($code)){
            //输入的校验码和手机接收的校验码做对比
            if($code==$_COOKIE['fcode']){
                echo 1;//ok
            }else{
                echo 2;//校验码有误
            }
        }elseif(empty($code)){
            echo 3;//输入的校验码不能为空
        }else{
            echo 4;//校验码已经过期
        } 
    }


    // 邮箱激活用户状态
    public function jihuo(Request $request){
        //获取id
        $id = $request->input('id');
        //获取数据表数据
        $info = DB::table('user')->where('id','=',$id)->first();
        //获取token
        $token = $request->input('token');
        // 判断
        //把状态值 由1=>0
        //检测token参数
        if($token == $info->token){
            //封装需要修改的数据
            $res['status'] = 0;
            //token 重新赋值
            $res['token'] = str_random(50);
            DB::table('user')->where('id','=',$id)->update($res);
            echo "<a href='/homelogin'>用户已经激活,点击请前去登录</a>";
        }
    }

    //发送纯文本 视图和数据 $email 接收方 $id注册用户id $token 校验参数
    public function sendMail($email,$id,$token){
        //在闭包函数内部使用闭包函数外部的变量 必须use 导入
        Mail::send('Home.zhuce.a',['id'=>$id,'token'=>$token],
        function($message)use($email){
        //发送主题
        $message->subject('唯尚衣族用户激活');
        //接收方
        $message->to($email);
        });
        return true;
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
        // 获取注册需要添加的数据
        // 用户手机号
        $data['phone']=$_POST['phone'];
        // 用户密码
        $data['password']=Hash::make($_POST['password']);
        // 邮箱
        $data['email']=$_POST['email'];
        // 默认0激活状态,1为禁用状态
        $data['status']=1;
        // 默认0普通用户
        $data['level']=0;
        // // 地区
        $data['area'] = $_POST['area'];
        // 添加时间
        $data['addtime'] = date('Y-m-d H:i:s');
        // token
        $data['token'] = rand(1,10000);
        // echo'<pre>';
        // var_dump($data);
        // dd($data);
        // 插入数据  
        // GetId  获取添加成功的id
        $id = DB::table('user')->insertGetId($data);
        if($id){
            // 跳转到登录页面
            // return redirect('/homelogin');
            //向注册的邮箱发送邮件 激活用户
            //email   插入的email,也就是接收方
            //$id  添加时候的id
            //token 插入的数据token
            $res = $this->sendMail($data['email'],$id,$data['token']);
            if($res){
                echo '<a href="homelogin">激活用户邮件已经发送,请登录邮箱激活用户后再点击我去登陆</a>';
            }
        }else{
            // 返回注册
            return back()->with('chuce','注册失败,请重新注册!');
        }
       
    }

    // ajax账户验证
    public function phone(Request $request){
        // echo 1;
        // 获取ajax参数
        $phone = $request->input('phone');
        // 查询数据
        $phones = DB::table('user')->where('phone','=',$phone)->first();
        // 判断是否有数据
        if($phones){
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
    // 个人中心首页
    public function show($id)
    {
        // session判断是否有值
        if(session()->has('hname')){
            $value = session('hid');
            $data = DB::table('user')->where('id','=',$value)->first();
            $datas = DB::table('user_info')->where('user_id','=',$value)->first();

            // 获取商品订单数据
            $info=DB::table('order')->where('user_id','=',$value)->get();
            // 获取订单全部条数
            $sall=DB::table('order')->where('user_id','=',$value)->count();
            // 获取订单各个状态的条数
            $szero=DB::table('order')->where('user_id','=',$value)->where('status','=',0)->count();
            $sone=DB::table('order')->where('user_id','=',$value)->where('status','=',1)->count();
            $stwo=DB::table('order')->where('user_id','=',$value)->where('status','=',2)->count();
            $sthree=DB::table('order')->where('user_id','=',$value)->where('status','=',3)->count();
            // dd($szero);
            $result=[];
            foreach($info as $key=>$v){
                $v->addtime=date('Y-m-d',$v->addtime);
                $v->dev=DB::table('order_info')->join('goods','order_info.goods_id','=','goods.id')->join('pic_url','goods.id','=','pic_url.gid')->select('order_info.*','goods.*','pic_url.p_url')->where('order_info.order_id','=',$v->id)->where('pic_url.main','=',1)->get();
                $result[]=$v;
            }
            // dd($result);
            // 加载模板
            return view('Home.gerenzhongxin.index',['data'=>$data,'datas'=>$datas,'result'=>$result,'sall'=>$sall,'szero'=>$szero,'sone'=>$sone,'stwo'=>$stwo,'sthree'=>$sthree]);
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
        // 修改资料展示
    public function edit($id)
    {
        // 获取session数据
        $value = session('hid');
        // 查询数据
        $data = DB::table('user_info')->where('user_id','=',$value)->first();
        // dd($data);
        // dd($value);
        // 加载模板
        return view('Home.gerenzhongxin.xiugaiziliao',['data'=>$data]);
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
        // 获取除符合条件的数据
        $input = $request->except(['_method','_token']);
        // 获取登录时存的用户id
        $input['user_id'] = session('hid');
        $data = DB::table('user_info')->where('user_id','=',$id)->first();
        // dd($input);  
        if($data){
            // 这是已有数据要进行修改
            if($request->hasFile('user_pic')){
                // 获取旧图数据
                $m = ".".$data->user_pic;
                // 初始化图片名
                $name = time()+rand(1,10000);
                // 获取文件后缀
                $ext = $request->file('user_pic')->getClientOriginalExtension();
                // 上传的图片路径
                $request->file("user_pic")->move(Config::get('app.app_upload'),$name.".".$ext);
                // 处理
                $input['user_pic']=trim(Config::get('app.app_upload')."/".$name.".".$ext,'.');
                // dd($input); 
                // 修改数据
                if(DB::table('user_info')->where('user_id','=',$id)->update($input)){
                    if(!empty($data->user_pic)){
                        unlink($m);
                    }
                    return redirect("/zhuce/".session('hid')."/edit");
                }else{
                    return back()->with('error', '修改失败');
                }
                // 有新图上传的时候
            }else{
                // 不上传新图保留旧图的时候
                // 修改数据
                if(DB::table('user_info')->where('user_id','=',$id)->update($input)){
                    return redirect("/zhuce/".session('hid')."/edit");
                }else{
                    return back()->with('error', '修改失败');
                }
            }
        }else{
            // dd(1);
            // 这是没数据要进行添加
            if($request->hasFile('user_pic')){
                // 初始化图片名
                $name = time()+rand(1,10000);
                // 获取文件后缀
                $ext = $request->file('user_pic')->getClientOriginalExtension();
                // 上传的图片路径
                $request->file("user_pic")->move(Config::get('app.app_upload'),$name.".".$ext);
                // 处理
                $input['user_pic']=trim(Config::get('app.app_upload')."/".$name.".".$ext,'.');
                // dd($input); 
                // 添加数据
                if(DB::table('user_info')->where('user_id','=',$id)->insert($input)){
                    // 成功后跳转
                    return redirect("/zhuce/".session('hid')."/edit");
                }else{
                    return back()->with('error', '添加数据失败');
                }
                // 有新图上传的时候
            }else{
                // 添加数据数据
                if(DB::table('user_info')->where('user_id','=',$id)->insert($input)){
                    return redirect("/zhuce/".session('hid')."/edit");
                }else{
                    return back()->with('error', '修改失败');
                }
            }
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
