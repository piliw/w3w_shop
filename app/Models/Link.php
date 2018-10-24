<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
  //绑定数据表
	protected $table="link";
	//绑定主键
	protected $primaryKey="id";
	//时间戳是否自动维护
	public $timestamps=false;
	//可以被批量赋值的参数
	public $fillable=['name','url','email','status','decr'];
	// 状态转换
	public function getStatusAttribute($value){
		$status=['待审核','审核通过'];
		return $status[$value];
		}
}
