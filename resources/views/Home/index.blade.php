<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>唯尚衣族-首页</title>
<link rel="stylesheet" type="text/css" href="/home/css/index.css">
<link rel="stylesheet" type="text/css" href="/home/css/lunbo.css">
<script src="/home/js/jquery-1.8.3.min.js"></script>
<script src="/home/js/public.js"></script>
<style>
  .pp{
    overflow: hidden;text-overflow: ellipsis;white-space: nowrap;
  }
</style>
</head>
<body>
  <div style="width:100%;text-align:center;font-size:0;" id="abs">
@foreach($abs as $f)
<a href=""><img src="{{$f->file}}" alt="" style="width:100%;"></a>
@endforeach
</div>
<!--顶部菜单-->
<div class="dy1">
  <div class="dy2">
        <ul class="dy3">
          <li><a href="/homenotece" class="notece">官方公告<br/>官方公告</a></li>
         <li><a href="#">维尚衣族官网<br/>维尚衣族官网</a></li>
        </ul>
        <a href="#" class="dy5">购物车</a>
        <ul class="dy4">
            @if(Session::has('hname'))
            <li><a href="/homelogin/create">退出<br/>退出</a></li>
            <li><a href="#">欢迎您登录!<br/>欢迎您登录!</a></li>
            <li><a href="/zhuce/{{Session::get('hid')}}">个人中心<br/>个人中心</a></li>
            @else
            <li><a href="/homelogin">登录<br/>登录</a></li>
            <li><a href="/zhuce/create">注册<br/>注册</a></li>
            @endif
        </ul>
        <div class="dy6">
            <ul>
                <li>
                    <b><img src="/home//home/img/wxrzhuji.jpg"/></b>
                    <a href="#" class="dy7">外星人主机</a>
                    <a href="#" class="dy8">删除</a>
                </li>
                <li>
                    <b><img src="/home//home/img/gaoqingxianshiqi.jpg"/></b>
                    <a href="#" class="dy7">4k高清显示器</a>
                    <a href="#" class="dy8">删除</a>
                </li>
             </ul>
         </div>
         <div class="dy9">
          <img src="/home//home/img/phone.png"/>
         </div>
    </div>
</div>
<!--logo加时间加搜索框-->
<div class="dy10">
  <div class="dy11">
      <img src="/home/img/logo.png"/>
    </div>
    <div class="dy13">
      <embed src="/home//home//home/img/honehone_clock_wh.swf" style=" height:45px; width:120px"></embed>
    </div>
    <div class="dy12">
      <input type="text" value="搜索商品/店铺" onFocus="if(value=='搜索商品/店铺') {value=''}" onBlur="if (value=='') {value='搜索商品/店铺'}" style="width:500px; height:36px; text-indent:12px; font-size:12px; color:#666; float:left">
        <input type="search" value="搜索" style=" cursor:pointer; width:70px; height:36px; float:right; text-align:center; background:#333;" class="shousuo">
    </div>
</div>
<!--全部商品分类-->
<div class="qbspfl">
  <div class="djfl">
      全部商品分类
    </div>
    <div class="morelist">
      @foreach($cate as $c)
      @foreach($c->dev as $d)
      <a href="#">{{$d->name}}</a>
      @endforeach
      @endforeach 
    </div>
</div>

<!--banner轮播引入lunbo.css和daohang.js-->
<?php $n=20; ?>
 <div id="big_banner_wrap" style="display:block">
   <ul id="banner_menu_wrap">
   @foreach($cate as $c)
     <li class="active"img>
       <a>{{$c->name}}</a>
       <a class="banner_menu_i">&gt;</a>
       <div class="banner_menu_content"  
       style="width: 600px;  top:-<?php echo $n?>px;">
       <?php $n+=42; ?>
         @foreach($c->dev as $d)
          <ul class="banner_menu_content_ul">
         @foreach($d->dev as $dd)
           <li>
             <a><img src="/home/img/headphone.jpg"></a><a>{{$dd->name}}</a><span>选购</span></li>
          @endforeach
         </ul>
          @endforeach 
       
       </div>
     </li>
    @endforeach   
   </ul>
   <div id="big_banner_pic_wrap">
     <ul id="big_banner_pic">
       @foreach($pic as $p) 
       <li><a>
       <img src="{{$p->path}}" width="100%" height="100%">
       </a></li>
       @endforeach
     </ul>
   </div>
   <div id="big_banner_change_wrap">
     <div id="big_banner_change_prev"> &lt;</div>
     <div id="big_banner_change_next">&gt;</div>
   </div>
 </div>
 <script src="/home/js/daohang.js"></script>
<!--乐乐周边啊-->
<div class="dy14">
  <h4 style="color:#333;font-size:16px;font-family:'微软雅黑';">官方品牌</h4>
  <div class="dy15">
      <ul>
        <!-- 遍历品牌 -->
        @foreach($brand as $bra)
        <li><a href="#">{{$bra->name}}<br/>{{$bra->name}}</a></li>
        @endforeach
      </ul>
    </div>
    <div class="dy16">
      <ul>
        @foreach($brand_pic as $bp)
        <li><a href="#"><img src="{{$bp->logo}}" width="318px" height="160"/></a></li>
        @endforeach
        </ul>
    </div>
</div>
<!--一个推荐商品的轮播-->
<div class="kongzhianniu">
<div class="lunbobanner">
  <ul class="lunboimg">
      <li>
      @foreach($res as $key=>$row)
      @if($key<5)
          <a href="#">
              <b><img src="{{$row->p_url}}"/></b>
                    <h5 class="pp">{{$row->name}}</h5>
                    <p class="pp">{{$row->summ}}</p>
                    <span>{{$row->price}}元</span>
            </a>
        @endif   
        @endforeach          
        </li>
        <li>
          @foreach($res as $key=>$row)
          @if($key>=5)
          <a href="#">
              <b><img src="{{$row->p_url}}"/></b>
                    <h5 class="pp">{{$row->name}}</h5>
                    <p class="pp">{{$row->summ}}</p>
                    <span>{{$row->price}}元</span>
            </a>
           @endif 
        @endforeach  
        </li>
    </ul>
</div>    
  <div class="btnl"><</div>
    <div class="btnr">></div>
    <h4 class="guanfangremai">官方热卖</h4>
</div>
<!--其它商品-->
<div class="dy17">
  <?php $o=1; ?>
  @foreach($cate as $c)
  @foreach($c->dev as $cc)  
  <!--服装鞋包-->
  <div class="dy18" id="f{{$cc->id}}">
      <div class="dy20">
          <h3>{{$cc->name}}</h3>
            <div class="xxddh">
               <?php $i=1; ?>
               @foreach($cc->dev as $ccc)  
                <a href="#" class="cate a-<?php echo $o;?>-list0<?php echo $i;?>"  mt-floor="<?php echo $o;?>" mt-ct="list0<?php echo $i;?>">{{$ccc->name}}</a>
              <?php $i++; ?>
               @endforeach  
               <a href="#" class="cate a-<?php echo $o;?>-dy23" mt-floor="<?php echo $o;?>"  mt-ct="dy23">{{$cc->name}}</a>
              <?php $o++ ?>
            </div>
        </div>
        <div class="dy21">
          <div class="dy22">
              <div class="dy24"><a href="#"><img src="{{$cc->curl}}"/></a></div> 
            </div>
            <div class="bigrongqi">
                <div class="pinpai b-<?php echo $o-1?>-dy23">
                    <ul>
                    @foreach($res as $row)
                    @if($row->id==$cc->id)
                        <li>
                            <a href="#">
                                <b>
                                    <img src="{{$row->p_url}}"/>
                                </b>
                                <h2 class="pp">{{$row->name}}</h2>
                                <p class="pp">{{$row->summ}}</p>
                                <span>{{$row->price}}元</span>
                            </a>    
                            <a href="#" style=" width:100%; height:20px; line-height:20px; font-size:12px; color:#666; text-align:left; text-indent:10px" class="dianpud">维尚旗舰店</a>
                        </li>
                        @endif
                        @endforeach
                    </ul>
                </div>
                <?php $j=1 ?>
                @foreach($cc->dev as $ccc)
                <div class="pinpai b-<?php echo $o-1?>-list0<?php echo $j;?>">
                  <ul> 
                       @foreach($res as $row)
                       @if($row->id==$ccc->id)
                        <li>
                            <a href="#">
                                <b>
                                    <img src="{{$row->p_url}}"/>
                                </b>
                                <h2 class="pp">{{$row->name}}</h2>
                                <p class="pp">{{$row->summ}}</p>
                                <span>{{$row->price}}元</span>
                            </a>    
                            <a href="#" style=" width:100%; height:20px; line-height:20px; font-size:12px; color:#666; text-align:left; text-indent:10px" class="dianpud">乐乐旗舰店</a>
                        </li>
                        @endif
                        @endforeach
                    </ul>
                </div>
                <?php $j++ ?>
               @endforeach
            </div>    
        </div> 
    </div>
    @endforeach
    @endforeach 
    
    <!--天天特价-->
            
    <!--快速导航菜单-->
    <div class="dy19">
      @foreach($cate as $c)
      @foreach($c->dev as $cc)
      
      <a href="#f{{$cc->id}}">{{$cc->name}}</a>
      @endforeach
      @endforeach
    </div>
</div>
<script type="text/javascript"> 
$(function() { 
$(window).scroll(function() { 
var top = $(window).scrollTop()-$(this).scrollTop()+200
$(".dy19").css({top: top }); 
}); 
}); 
</script> 
<!--页脚-->
<!--footer-->
<div class="footer">
  <div class="box" style=" width:1226px; margin:0 auto">
        <ul class="lian">
            <li>
                <p><img src="/home/img/fot.png">新手指南</p>
                <a href="#">账户注册</a>
                <a href="#">购物流程</a>
                <a href="#">网站地图</a>
            </li>
            <li>
                <p><img src="/home/img/fot1.png">支付方式</p>
                <a href="#">货到付款</a>
                <a href="#">在线支付</a>
                <a href="#">礼品卡及账户余额</a>
                <a href="#">其他支付方式</a>
            </li>
            <li>
                <p><img src="/home/img/fot2.png">配送说明</p>
                <a href="#">配送运费</a>
                <a href="#">配送时间</a>
            </li>
            <li>
                <p><img src="/home/img/fot3.png">售后服务</p>
                <a href="#">退换货政策</a>
                <a href="#">退换货办理流程</a>
                <a href="#">退换货网上办理</a>
                <a href="#">退款说明</a>
            </li>
            <li>
                <p><img src="/home/img/fot4.png">关于我们</p>
                <a href="#">公司简介</a>
                <a href="#">合作专区</a>
                <a href="#">联系我们</a>
                <a href="/link/create">友情链接</a>
            </li>
            <li>
                <p><img src="/home/img/fot5.png">帮助中心</p>
                <a href="#">找回密码</a>
                <a href="#">邮件订阅</a>
                <a href="#">产品册订阅</a>
                <a href="#">隐私声明</a>
            </li>
        </ul>
        <ul class="adv">
          <li><img src="/home/img/adv.png">正品保障</li>
            <li><img src="/home/img/adv1.png">免运费</li>
            <li><img src="/home/img/adv2.png">送货上门</li>
            <li style="border-right:none;"><img src="/home/img/adv3.png">实物拍摄</li>
        </ul>
        <p class="ad">地址山东省济南市历下区历山北路 &nbsp;&nbsp;&nbsp;邮箱：xgm@8and9.com.cn &nbsp;&nbsp;&nbsp;邮编:210008 &nbsp;&nbsp;&nbsp;电话:025-83218155</p>
        <p class="ad">Copyright © 2010 - 2013, 版权所有 SHUIGUO.COM &nbsp;&nbsp;&nbsp;苏ICP备10088888号-1</p>
    </div>
</div>

</body>
</html>  