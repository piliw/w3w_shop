<?php

namespace App\Http\Controllers\Admin\Goods;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// 引入模型类
use App\Models\Goods;
use DB;

class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       return view('Admin.Goods.operate');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //获取分类信息
        $cate=$this->getCateAll();
        // 获取品牌信息
        $brand=DB::table('admin_brand')->get();
        return view("Admin.Goods.addgoods",['cate'=>$cate,'brand'=>$brand]);
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
        $data=$request->except('pic','_token');
        $data['status']=$request->input('status', 0);
        // 获取图片信息
        $pic=$request->input('pic');
        $id=Goods::insertGetId($data);
        if($id){
                foreach($pic as $k=>$v){
                    if($k==0){
                         DB::table('pic_url')->insert(['gid'=>$id,'p_url'=>$v,'main'=>1]);
                     }else{
                         DB::table('pic_url')->insert(['gid'=>$id,'p_url'=>$v,'main'=>0]);
                     }
                }
                echo '添加成功!你可以<a href="/goodsinfo/create">继续添加</a>或者<a href="/goodsinfo">查看商品列表</a>';
        }else{
            echo '添加失败';
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
        echo 123;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 商品修改
        // 获取商品信息
        $data=DB::table('goods')->where('id','=',$id)->first();
         //获取分类信息
        $cate=$this->getCateAll();
        // 获取品牌信息
        $brand=DB::table('admin_brand')->get();
        //获取商品图片
        $photos=DB::table('pic_url')->where('gid','=',$id)->orderBy('main','desc')->get();
        return view('Admin.Goods.editgoods',['cate'=>$cate,'brand'=>$brand,'data'=>$data,'photos'=>$photos]);
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
        //获取要修改后的商品信息
        $data=$request->except('pic','del','_method','_token');
        $data['status']=$request->input('status',0);
        //获取修改后的图片
        $pic=$request->input('pic');
        if(empty($pic)){
            return back()->with('error','请至少上传一张图片');
        }
        // 获取要删除的图片文件信息
        $del=$request->input('del');
        // 修改商品信息
        DB::table('goods')->where('id','=',$id)->update($data);
         //删除原来数据库的图片信息
        DB::table('pic_url')->where('gid','=',$id)->delete();
        // 存入新的图片信息
        foreach($pic as $k=>$v){
                if($k==0){
                    DB::table('pic_url')->insert(['gid'=>$id,'p_url'=>$v,'main'=>1]);
                    }else{
                    DB::table('pic_url')->insert(['gid'=>$id,'p_url'=>$v,'main'=>0]);
                     }
                }
        //删除不需要的旧文件信息
        if(!empty($del)){
             foreach($del as $val){
                unlink('.'.$val);
             }
        }
        return redirect('/goodsinfo');  
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

    public function getGoods(Request $request){
        // 分页
        $page=$request->input('page');
        $limit=$request->input('limit');
        $offset=($page-1)*$limit;
        //搜索
        $key=$request->input('key');
        // 获取所有商品信息
        $infos=Goods::join('admin_brand','admin_brand.id','=','goods.bid')->join('pic_url','pic_url.gid','=','goods.id')->join('cate','cate.id','=','goods.cate_id')->select('goods.id as gid','goods.name','goods.number','goods.price','goods.store','goods.sales','goods.status','goods.summ','goods.size','admin_brand.name as bname','pic_url.p_url','cate.name as cname')->where('goods.name','like','%'.$key.'%')->where('pic_url.main','=',1)->orderBy('goods.id','asc')->offset($offset)->limit($limit)->get();
        // 统计数量
        $total=Goods::count();
        foreach($infos as $info){
            $data[]=$info;
        }
            $data=implode($data,',');
            echo '{"code":0,"msg":"","count":'.$total.',"data":['.$data.']}';
        }

        public function upload(Request $request){
             $file = $request->file('pic');
            // 获取文件路径
            $transverse_pic = $file->getRealPath();
            // public路径
            $path = '/uploads/'.date('Y-m-d').'/';
            // 获取后缀名
            $postfix = $file->getClientOriginalExtension();
            // 拼装文件名
            $fileName = md5(time().rand(0,10000)).'.'.$postfix;
            // 移动
            if(!$file->move('.'.$path,$fileName)){
                return response()->json(['ServerNo' => '400','ResultData' => '文件保存失败']);
            }
            // 这里处理 数据库逻辑
            /**
            *Store::uploadFile(['fileName'=>$fileName]);
            **/
            return response()->json(['code'=>0,'ServerNo' => '200','ResultData' => $path.$fileName]);
            }


         public function getCateAll(){
                //获取所有分类信息
                  $cate=DB::table("cate")->select(DB::raw('*,concat(path,id,",") as paths'))->orderBy('paths')->get();
                  foreach($cate as $key=>$value){
                        // echo $value->path."<br>";
                        //转换为数组
                        $arr=explode(",",$value->path);
                        // echo "<pre>";
                        // var_dump($arr);
                        //获取逗号个数
                        $len=count($arr)-1;
                        //给当前分类添加分割符
                        $cate[$key]->name=str_repeat("--|",$len).$value->name;
                }
                  return $cate;
        }

        public function goodsDel(Request $request){
                // 商品删除
                $id=$request->input('id');
                if(DB::table('goods')->where('id','=',$id)->delete()){
                 // 查询商品图片
                    $img=DB::table('pic_url')->where('gid','=',$id)->get();
                    foreach($img as $ppic){
                        if(DB::table('pic_url')->where('id','=',$ppic->id)->delete()){
                                 unlink('.'.$ppic->p_url);
                        }
                    }
                    echo 1;
                }else{
                    echo 0;
                }
        }

        // 商品批量上下架
        public function status(Request $request,$d){
            $data=$request->input('id');
            $data=explode(',',rtrim($data,','));
            if($d==1){
                DB::table('goods')->whereIn('id',$data)->update(['status'=>1]);
                echo 1;
            }else{
                DB::table('goods')->whereIn('id',$data)->update(['status'=>0]);
                echo 0;
            }
        }

}
