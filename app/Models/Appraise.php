<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appraise extends Model
{
  // 与模型关联的数据表
  protected $table = 'appraise';
  // 指定主键
  protected $primaryKey = 'id';
  // 该模型是否自动维护时间戳
  public $timestamps = false;
  // 可以被批量赋值的属性。
  protected $fillable = ['user_id','goods_id','order_id','content','addtime','gscore'];
   // 修改器对获取的status值做处理
  public function getGscoreAttribute($value){
  	$gscore=[1=>'严重差评',2=>'差评',3=>'中评',4=>'比较好',5=>'好评'];
  	return $gscore[$value];
  }
}
