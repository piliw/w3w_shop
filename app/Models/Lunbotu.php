<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lunbotu extends Model
{
  // 与模型关联的数据表
  protected $table = 'carousel';
  // 指定主键
  protected $primaryKey = 'id';
  // 该模型是否自动维护时间戳
  public $timestamps = true;
  // 可以被批量赋值的属性。
  protected $fillable = ['pic','url','status','path'];
   // 修改器对获取的status值做处理
  public function getStatusAttribute($value){
  	$status=[0=>'展示',1=>'关闭'];
  	return $status[$value];
  }
}
