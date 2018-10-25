<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use DB;
// use App\Repositories\UserRepository;

class ProfileComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $homecate;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct()
    {
       //
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $homecate=self:: getCageByPid(0);
        $view->with('homecate', $homecate);

        //购物车
          $data1=session('cart');
        // dd($data1);
        $datas=[];
        // 获取用户id
        if(!empty($data1)){
            foreach($data1 as $key=>$value){
                // dd($value['id']);
                $result=DB::table('goods')->join('pic_url','pic_url.gid','=','goods.id')->select('goods.name as gname','pic_url.p_url')->where('goods.id','=',$value['id'])->where('pic_url.main','=',1)->first();
                $row['name']=$result->gname;
                $row['p_url']=$result->p_url;
                $datas[]=$row;
            }
        }
        $view->with('datas', $datas);
    }

    public static function getCageByPid($id){
        $cates=DB::table('cate')->where('pid','=',$id)->where('display','=',1)->limit(11)->get();
        $data=[];
        foreach($cates as $key=>$value){
                $value->dev=self::getCageByPid($value->id);
                $data[]=$value;
        }
        return $data;
    }
}