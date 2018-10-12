<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminUsers extends Model
{
    //定义与模型关联的数据表
    protected $table="admin_user";
    //主键
    protected $primaryKey="id";
    // 设置是否需要自动维护时间戳 created_at updated_at
    public $timestamps =false;

    // 可以被批量赋值的属性
    protected $fillable = ['username','password','level','status','addtime'];

    //修改器的方法
		//对完成的数据(状态 status)做自动处理
		public function getStatusAttribute($value){
			$status=[0=>'已启用',1=>'已禁用'];
			return $status[$value];
		}

		public function getLevelAttribute($value){
			$level=[0=>'一级管理员',1=>'二级管理员',2=>'三级管理员',3=>'超级管理员'];
			return $level[$value];
		}
}
