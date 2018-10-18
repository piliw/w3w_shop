<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    //定义与模型关联的数据表
    protected $table="user_info";
    //主键
    protected $primaryKey="id";
    // 设置是否需要自动维护时间戳 created_at updated_at
    public $timestamps =false;

    // 可以被批量赋值的属性
    protected $fillable = ['user_id','user_pic','nickname','sex','birthday','email','edu','u_addr'];

    //修改器的方法
		//对完成的数据(状态 sex)做自动处理
		public function getSexAttribute($value){
			$sex=[0=>'女',1=>'男',2=>'保密'];
			return $sex[$value];
		}

}
