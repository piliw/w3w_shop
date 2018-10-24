<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    	//绑定数据表
	protected $table="goods";
	//绑定主键
	protected $primaryKey="id";
	//时间戳是否自动维护
	public $timestamps=false;
	//可以被批量赋值的参数
	public $fillable=['name','cate_id','price','store','sales','bid','status','descr'];
	// 状态转换
	public function getStatusAttribute($value){
		$status=['<font style="color:red">下架</font>','<font style="color:green">上架</font>'];
		return $status[$value];
	}
}
