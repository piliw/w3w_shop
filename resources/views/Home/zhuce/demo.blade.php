<?php
//获取参数p
$p=isset($_GET['p'])?$_GET['p']:'';
// echo $p;
//调用短信接口 给$p发送短信校验码
//载入ucpass类
require_once('/home/zhuce/lib/Ucpaas.class.php');

//初始化必填
//填写在开发者控制台首页上的Account Sid
// $options['accountsid']='712054710b780cbea4e532d044b0d6aa'; //欧
// $options['accountsid']='b58e8547bd750f617f8567f8234884f7'; //秦杰
// $options['accountsid']='9185cac3023946dfc0e4747863ccab22'; //秦博雄
$options['accountsid']='6754e217a2c8b65b70012a2f4e71f67d'; //王俊荣
//填写在开发者控制台首页上的Auth Token
// $options['token']='135a3a55ae2c4f11a54c5f46084856a1'; //欧
// $options['token']='0413994ae3be5ce2870065506462b0b2';  //秦杰
// $options['token']='d4b7b0cd374430dfe6bb9f6865036344';  //秦博雄
$options['token']='af82e8c5b892c89c3e2814844dbc47a1'; //王俊荣

//初始化 $options必填
$ucpass = new Ucpaas($options); 
// $appid = "126e5d2ff40d49d9a4c24e71b7da96a7"; //欧
// $appid = "bfe2f139c742462ea8400568fcccbdde";	//秦杰
// $appid = "f2873517ac8b4d958b557c01e0bcdb6d";  //秦博雄
$appid = "9d288f87f0e046f491ad416882c9a547";	//王俊荣

//应用的ID，可在开发者控制台内的短信产品下查看
//短信模板id (必须通过审核)
// $templateid = "386245";    //欧 
// $templateid = "374188";   //秦杰
// $templateid = "373936";  //秦博雄
$templateid = "374174";   //王俊荣

//可在后台短信产品→选择接入的应用→短信模板-模板ID，查看该模板ID
//短信校验码
$param = rand(1234,10000); 
//存储在cookie 10分钟后过期
setcookie('fcode',$param,time()+180);
//多个参数使用英文逗号隔开（如：param=“a,b,c”），如为参数则留空
//接收短信校验码的手机号
$mobile = $p;
$uid = "";

//70字内（含70字）计一条，超过70字，按67字/条计费，超过长度短信平台将会自动分割为多条发送。分割后的多条短信将按照具体占用条数计费。
echo $ucpass->SendSms($appid,$templateid,$param,$mobile,$uid);
/*****************************************************/

 ?>