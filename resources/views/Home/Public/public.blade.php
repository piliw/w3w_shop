 <!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>@yield('title')</title>
<link rel="stylesheet" type="text/css" href="/home/css/top.css"/>
<link rel="stylesheet" type="text/css" href="/home/css/lunbo.css">
<link rel="stylesheet" type="text/css" href="/home/css/zhanshi.css">
<link rel="stylesheet" type="text/css" href="/home/css/footer.css">
<script src="/home/js/jquery-1.8.3.min.js"></script>
<script src="/home/js/public.js"></script>
</head>

<body>
<!--顶部菜单有改动与首页的不一样，请单独调用-->
<div class="dy1">
	<div class="dy2">
        <ul class="dy3">
            <li><a href="/">唯尚衣族官网<br/>唯尚衣族官网</a></li>
            <li><a href="#" id="diyunapp">商城APP<br/>商城APP</a></li>
        </ul>
        <a href="#" class="dy5">购物车</a>
        @if(session('hname'))
        <ul class="dy4">
            <li><a href="/zhuce/{{Session::get('hid')}}">{{session('hname')}}<br/>{{session('hname')}}</a></li>
            <li><a href="/homelogin/create">退出<br/>退出</a></li>
        </ul>
        @else
          <ul class="dy4">
            <li><a href="/homelogin">登陆<br/>登陆</a></li>
            <li><a href="/zhuce">注册<br/>注册</a></li>
        </ul>	
        @endif
        <div class="dy6">
            <ul>
               	<li>
                   	<b><img src="/home/img/wxrzhuji.jpg"/></b>
                    <a href="#" class="dy7">外星人主机</a>
                    <a href="#" class="dy8">删除</a>
                </li>
                <li>
                   	<b><img src="/home/img/gaoqingxianshiqi.jpg"/></b>
                    <a href="#" class="dy7">4k高清显示器</a>
                    <a href="#" class="dy8">删除</a>
                </li>
             </ul>
         </div>
         <div class="dy9">
         	<img src="/home/img/phone.png"/>
         </div>
    </div>
</div>
<!--logo加时间加搜索框-->
<div class="dy10">
	<div class="dy11">
    	<img src="/home/img/logo.png"/>
    </div>
    <div class="dy13">
    	<embed src="/home/img/honehone_clock_wh.swf" style=" height:45px; width:120px"></embed>
    </div>
    <form action="/keywords" method="post">
    <div class="dy12">
        <input type="text" value="" name="keywords" style="width:500px; height:36px; text-indent:12px; font-size:12px; color:#666; float:left">
        <input type="submit" value="搜索" style=" cursor:pointer; width:70px; height:36px; float:right; text-align:center; background:#333;" class="shousuo">
    </div>
    {{csrf_field()}}
    </form>
</div>
<!--全部商品分类-->
<div class="qbspfl">
	<div class="djfl">
    	全部商品分类
    </div>
    <div class="morelist">
        <a href="/">首页</a>
    @foreach($homecate as $key=>$hom)
    @if($key<7)
    	<a href="/list?id={{$hom->id}}">{{$hom->name}}</a>
    @endif
    @endforeach
    </div>
</div>
<script>
$(function(){
	$("#banner_menu_wrap").mouseleave(function(){
		$(this).hide()
		$("#big_banner_wrap").hide()
		});
	$(".djfl").mouseenter(function(){
		$("#big_banner_wrap").show()
		$("#banner_menu_wrap").show()
		});	
	})
	
</script>
<!--banner轮播引入lunbo.css和daohang.js-->
<div id="big_banner_wrap" style=" position:absolute; top:177px; left:50%; margin-left:-613px">
	 <ul id="banner_menu_wrap">
		<?php $cel=20;?>	
		@foreach($homecate as $cates)
		 <li class="active"img>
			 <a href="/list?id={{$cates->id}}">{{$cates->name}}</a>
			 <a class="banner_menu_i" href="/list?id={{$cates->id}}">&gt;</a>
			 <div class="banner_menu_content" style="width: 600px; top: -{{$cel}}px;">
			 	@foreach($cates->dev as $dev)
				 <ul class="banner_menu_content_ul">
				 	@foreach($dev->dev as $san)
					 <li>
						 <a href="/list?id={{$san->id}}"><img src="{{$san->curl}}" height="40px"></a><a href="/list?id={{$san->id}}">{{$san->name}}<span>选购</span></a></li>
					@endforeach			 
				 </ul>
				 @endforeach
			 </div>
		 </li>
		 <?php $cel += 42;?>
		@endforeach
	 </ul>
 </div>
 <script src="/home/js/daohang.js"></script>
<!--主体 -->
@section('main')
@show
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
                <a href="#">友情链接</a>
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
        <p class="ad">地址：山东省济南市天桥区历山北路黄台电子商务产业园1020室 &nbsp;&nbsp;&nbsp;邮箱：xgm@8and9.com.cn &nbsp;&nbsp;&nbsp;邮编:210008 &nbsp;&nbsp;&nbsp;电话:025-83218155</p>
        <p class="ad">Copyright © 2010 - 2013, 版权所有 SHUIGUO.COM &nbsp;&nbsp;&nbsp;苏ICP备10088888号-1</p>
    </div>
</div>

</body>
</html>	    
    
			
			
    
                    
			
    
					
				
				

                    	
                        
                            
                
						
        