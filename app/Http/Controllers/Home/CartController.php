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
    
    // 商品购物测试
    public function test(){
        $info=DB::table('goods')->where('id','=',13)->first();
        // dd($info);
        return view("Home.test.test",['info'=>$info]);
    }

    // 购物车列表方法
    public function index(Request $request)
    {
        //获取session数组数据 id和num
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
            // $info=DB::table('goods')->where('id','=',$value['id'])->first();
            $info=DB::table('goods')->join('pic_url','pic_url.gid','=','goods.id')->select('goods.*','pic_url.p_url')->where('goods.id','=',$value['id'])->where('pic_url.main','=',1)->first();
            // dd($info);
            $row['name']=$info->name;
            $row['price']=$info->price;
            $row['p_url']=$info->p_url;
            $row['size']=$info->size;
            $row['num']=$value['num'];
            $total+=$row['price']*$row['num'];
            $tot+=$row['num'];
            $row['id']=$value['id'];
            $data[]=$row;
        }
        // dd($data);
        return view('Home.Cart.index',['data'=>$data,'total'=>$total,'tot'=>$tot]);
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
    
    // 购物车去重
    public function checkExists($id){
        // 获取所有购物车的信息
        $goods=session('cart');
        // 判断
        if(empty($goods)) return false;
        // 遍历
        foreach($goods as $key=>$value){
            if($value['id']==$id){
                return true;
            }
        }
    }

    // 购物车设计
    public function store(Request $request)
    {
        // dd($request->all());
        $res=$request->except('_token');

        if(!$this->checkExists($res['id'])){
            // 把当前购买的商品加入到session里
            $request->session()->push('cart',$res);
        }
        // 跳转
        return redirect("/homecart");
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
