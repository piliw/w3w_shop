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