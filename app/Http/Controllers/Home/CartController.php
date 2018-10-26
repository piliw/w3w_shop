<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
   
    // 购物车列表方法
    public function index(Request $request)
    {
        $uname=session('hname');
        //获取session数组数据 id和num
        if($request->session()->has('cart')){
            $cart=session('cart');
            // dd($cart);
            $data=[];
            // 总计
            $total='';
            // 总条数
            $tot='';
            // 遍历$cart
            foreach($cart as $key=>$value){
                // 获取商品数据
                $info=DB::table('goods')->join('pic_url','pic_url.gid','=','goods.id')->select('goods.*','pic_url.p_url')->where('goods.id','=',$value['id'])->where('pic_url.main','=',1)->first();
                // dd($info);
                $row['name']=$info->name;
                $row['price']=$info->price;
                $row['p_url']=$info->p_url;
                $row['size']=$value['size'];
                $row['num']=$value['num'];
                $total+=$row['price']*$row['num'];
                $tot+=$row['num'];
                $row['id']=$value['id'];
                $data[]=$row;
            }
            // dd($data);
            return view('Home.Cart.index',['data'=>$data,'total'=>$total,'tot'=>$tot,'uname'=>$uname]);
        }else{
            return view('Home.Cart.nullcart');
        }
    }

    // 购物车减
    public function updatee($id){
        // echo $id;
        // 获取session数据
        $data=session('cart');
        // 遍历
        foreach($data as $key=>$value){
            if($value['id']==$id){
                $s=$value['num']-1;
                $data[$key]['num']=$s;
                // 判断
                if($data[$key]['num']<1){
                    $data[$key]['num']=1;
                }
            }
        }

        // 重新给session赋值
        session(['cart'=>$data]);
        // 跳转到购物车页面
        return redirect("/homecart");
    }

    // 购物车加
    public function updates($id){
        // echo $id;
        // 获取session数据
        $data=session('cart');
        // 遍历
        foreach($data as $key=>$value){
            if($value['id']==$id){
                $s=$value['num']+1;
                $data[$key]['num']=$s;
                // 获取商品库存数据
                $info=DB::table('goods')->where('id','=',$id)->first();
                // 判断
                if($data[$key]['num']>$info->store){
                    $data[$key]['num']=$info->store;
                }
            }
        }

        // 重新给session赋值
        session(['cart'=>$data]);
        // 跳转到购物车页面
        return redirect("/homecart");
    }

    // 购物车商品删除
    public function del($id){
        // echo $id;
        // 获取session数据
        $data=session('cart');
        // 遍历
        foreach($data as $key=>$value){
            if($value['id']==$id){
                // 直接删除
                unset($data[$key]);
            }
        }

        // 重新给session赋值
        session(['cart'=>$data]);
        // 跳转到购物车页面
        return redirect("/homecart");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    // cart购物车去重复商品
    public function checkShop($id){
        // 获取cart1购物车的信息
        $shopcart=session('cart');
        if(empty($shopcart)) return false;
        // 遍历
        foreach($shopcart as $k=>$v){
            if($v['id']==$id){
                return true;
            }
        }
    }
    // cart购物车商品存进session
    public function create(Request $request)
    {
        //加入购物车
        $req=$request->all();
        // dd($req);
        
        if(!$this->checkShop($req['id'])){
            // 把商品添加到session里
            $request->session()->push('cart',$req);
            echo 1;
        }else{
            echo 2;
        }
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    

    // 直接到订单结算页
    public function store(Request $request)
    {
        // dd($request->all());
        $req=$request->except('_token');
        // dd($req);
        $result=[];
        $total='';
        $infos=DB::table('goods')->join('pic_url','goods.id','=','pic_url.gid')->select('goods.*','pic_url.p_url')->where('pic_url.main','=',1)->where('goods.id','=',$req['id'])->first();
        // dd($infos);
        $rows['name']=$infos->name;
        $rows['price']=$infos->price;
        $rows['p_url']=$infos->p_url;
        $rows['num']=$req['num'];
        // 总数
        $total+=$rows['price']*$rows['num'];
        // 商品数量的小计
        $rows['toot']=$rows['price']*$rows['num'];
        $rows['id']=$req['id'];
        
        $result[]=$rows;
        // dd($result);
        // 获取登录的用户
        $sid=session('hid');
        // 获取收货地址的数据
        $data1=DB::table('address')->where('user_id','=',$sid)->get();
        $adda=DB::table('address')->where('user_id','=',$sid)->where('default','=',1)->first();
        // 直接跳转到结算页
        return view("Home.orders.orders",['sid'=>$sid,'result'=>$result,'total'=>$total,'data1'=>$data1,'adda'=>$adda]);
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
