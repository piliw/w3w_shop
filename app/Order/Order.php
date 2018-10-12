<?php

namespace App\Order;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  //定义与该模型的数据库
	// protected $table="order";
	// 对完成的数据(状态 status)做处理
	// public function getStatusAttribute($value){
		// $status=[0=>'未付款',1=>'已付款',2=>'待收货',3=>'已收货'];
		// return $status[$value];
	}
}
