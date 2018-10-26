<?php

namespace App\Http\Controllers\Home\Goods;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class HomeGoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
      return view('Home.Public.public');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //测试
        $info=getExpress('yd',3914230347665);
        return view('Home.orders.express',['info'=>$info]);

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
        //商品展示
        $data=DB::table('goods')->where('id','=',$id)->first();
        //获取图片
        $photo=DB::table('pic_url')->where('gid','=',$id)->get();
        //当前分类
        $cate=DB::table('cate')->where('id','=',$data->cate_id)->select('id','name','pid')->first();
        //获取当前分类下的商品 取6条
        $categoods=DB::table('goods')->join('pic_url','pic_url.gid','=','goods.id')->select('goods.id','goods.name','summ','price','pic_url.p_url')->where('pic_url.main','=',1)->where('cate_id','=',$cate->id)->where('goods.status','=',1)->where('goods.store','>',0)->orderBy('sales','desc')->limit(6)->get();
        //$data->cate_id重新赋值
        $data->cate_id=$cate->name;
        //获取同等相关分类
        $cates=DB::table('cate')->select('id','name')->where('pid','=',$cate->pid)->where('display','=',1)->get();
        //其它相关分类数据
        //获取当前二级分类下的pid
         $pid=DB::table('cate')->select('id','pid')->where('id','=',$cate->pid)->where('display','=',1)->first();
         if($pid!=null){
                $othercate=DB::table('cate')->select('id')->where('pid','=',$pid->pid)->where('id','!=',$pid->id)->where('display','=',1)->get();
         }else{
                 $othercate=DB::table('cate')->select('id')->where('pid','=',0)->where('id','!=',$id)->where('display','=',1)->get();
         }
         foreach($othercate as $other){
                $oth=DB::table('cate')->select('id','name')->where('pid','=',$other->id)->where('display','=',1)->get();
                foreach($oth as $v){
                    $others[]=$v;
                }
         }
        //瞧 了又瞧数据
         if(!isset($others)){
            $others=[];
         }
          $sales=DB::table('goods')->join('pic_url','pic_url.gid','=','goods.id')->select('goods.id','goods.name','summ','price','pic_url.p_url')->where('pic_url.main','=',1)->where('goods.status','=',1)->where('goods.store','>',0)->orderBy('sales','desc')->limit(5)->get();
        //达人推荐数据
           $rows=DB::table('goods')->join('pic_url','pic_url.gid','=','goods.id')->select('goods.id','goods.name','summ','price','pic_url.p_url')->where('pic_url.main','=',1)->where('goods.status','=',1)->where('goods.store','>',0)->orderBy('sales','desc')->limit(10)->get();
        //商品评价
           $appraise=DB::table('appraise')->join('user','user.id','=','appraise.user_id')->join('goods','goods.id','=','appraise.goods_id')->select('appraise.*','user.phone','goods.name as gname','goods.price')->where('goods_id','=',$id)->get();
        //好评率
        //获取商品评价条数   
        $total=count($appraise);
        //获取好评条数
        if($total!=0){
            $hping=DB::table('appraise')->where('goods_id','=',$id)->where('gscore','>=',4)->count();
            //计算好评率
            $per=round($hping/$total,2)*100;
            //中评
            $zhong=DB::table('appraise')->where('goods_id','=',$id)->where('gscore','=',3)->count();
            $zper=round($zhong/$total,2)*100;
             //差评
            $cha=DB::table('appraise')->where('goods_id','=',$id)->where('gscore','<',3)->count();
            $cper=round($cha/$total,2)*100;   
        }else{
            $per='00';
            $zper='00';
            $cper='00';
            $hping=0;
            $zhong=0;
            $cha=0;
        }

        return view('Home.Goods.xiangqingye',['data'=>$data,'photo'=>$photo,'categoods'=>$categoods,'cates'=>$cates,'sales'=>$sales,'rows'=>$rows,'others'=>$others,'appraise'=>$appraise,'per'=>$per,'zper'=>$zper,'cper'=>$cper,'total'=>$total,'hping'=>$hping,'zhong'=>$zhong,'cha'=>$cha]);
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
