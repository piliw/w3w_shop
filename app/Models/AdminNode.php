<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminNode extends Model
{
    //定义与模型关联的数据表
    protected $table="user_role";
    //主键
    protected $primaryKey="uid";
    // 设置是否需要自动维护时间戳 created_at updated_at
    public $timestamps =false;

    // 可以被批量赋值的属性
    protected $fillable = ['rid'];

    //修改器的方法
		//对完成的数据(状态 status)做自动处理
		public function getRidAttribute($value){
			$status=[1=>'超级管理员',2=>'一级管理员',3=>'二级管理员',4=>'三级管理员'];
			return $status[$value];
		}
}
