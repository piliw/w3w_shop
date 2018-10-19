<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeUser extends Model
{
    //定义与模型关联的数据表
    protected $table="user";
    //主键
    protected $primaryKey="id";
    // 设置是否需要自动维护时间戳 created_at updated_at
    public $timestamps =false;

    // 可以被批量赋值的属性
    protected $fillable = ['phone','password','level','status','area','addtime'];

    //修改器的方法
		//对完成的数据(状态 status)做自动处理
		public function getStatusAttribute($value){
			$status=[0=>'已启用',1=>'已禁用'];
			return $status[$value];
		}

		public function getLevelAttribute($value){
			$level=[0=>'普遍会员',1=>'VIP会员'];
			return $level[$value];
		}
}
