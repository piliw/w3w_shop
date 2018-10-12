<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Abs extends Model
{
  // 与模型关联的数据表
  protected $table = 'admin_abs';
  // 指定主键
  protected $primaryKey = 'id';
  // 该模型是否自动维护时间戳
  public $timestamps = false;
  // 可以被批量赋值的属性。
  protected $fillable = ['name','file','status','url','created_at','pic'];
   // 修改器对获取的status值做处理
  public function getStatusAttribute($value){
    $status=[0=>'上架',1=>'下架'];
    return $status[$value];
  }
}
