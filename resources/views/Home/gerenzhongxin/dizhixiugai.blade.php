<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>地址管理</title>
<link rel="stylesheet" type="text/css" href="/home/css/vipcenter.css">
<script src="/home/js/jquery-1.8.3.min.js"></script>
<link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
<script src="/bootstrap/js/jquery.min.js"></script>
<script src="/bootstrap/js/bootstrap.min.js"></script>
<script src="/bootstrap/js/holder.min.js"></script>
<script src="/home/js/city.js/cityJson.js"></script>
<script src="/home/js/city.js/citySet.js"></script>
</head>
<body>
<!--个人中心首页 -->
<div class="thetoubu">
	<!--头部-->
	<div class="thetoubu1">
    	<b>
        	<img src="/home/img/touxiang.png"/>
        </b>
        <em>czz1994612</em>
        <em>欢迎来到会员中心</em>
        <a href="/address">地址管理</a>
        <a href="/zhuce/{{Session::get('hid')}}/edit">修改资料</a>
        <h5>账户安全</h5>
        <strong>低</strong>
        <span>
        	<p style=" width:27%"></p>
        </span>
        <a href="#">安全等级提升</a>
        <em style=" padding-right:2px">手机</em>
        <a href="#" style=" padding-left:2px; float:left; display:block; color:#f00" title="点击绑定">未绑定</a>
    </div>
    <!--详细列表-->
    <div class="xiangxilbnm">
    	<!--left-->
        <div class="liefyu">
        	<h2>交易管理</h2>
                <div class="conb">
                <a href="#">我的购物车</a>
                <a href="#">实物交易订单</a>
                <a href="#">虚拟兑换订单</a>
                <a href="#">我的收藏</a>
                <a href="#">交易评价/晒单</a>
                <a href="#">账户余额</a>
                <a href="#">我的积分</a>
                <a href="#">我的代金卷</a>
                </div>
            <h2>客户服务</h2>
                <div class="conb">
                <a href="#">退款及退货</a>
                <a href="#">交易投诉</a>
                <a href="#">商品咨询</a>
                <a href="#">违规举报</a>
                <a href="#">平台客服</a>
                <a href="#">商家入驻</a>
                </div>
            <h2>资料管理</h2>
                <div class="conb">
                <a href="#">账户信息</a>
                <a href="#">账户安全</a>
                <a href="#">收货地址</a>
                <a href="#">我的消息</a>
                <a href="#">我的好友</a>
                <a href="#">我的足迹</a>
                <a href="#">第三方账号登录</a>
                <a href="#">分享绑定</a>
                </div>
        </div>
        <script type="text/javascript">
		$(function(){//第一步都得写这个
			$(".liefyu h2").click(function(){//获取title，并且让他执行下面的函数
			$(this)/*点哪个就是哪个*/.next(".conb")/*哪个标题下面的con*/.slideToggle()/*打开/折叠*/.siblings/*锁定同级元素*/(".con").slideUp()/*同级元素折叠起来*/
			})
		})
		</script>
        <!--right-->
        <div class="zuirifip">
        <!--地址列表和新增地址-->
          	<div class="dfdaspjtk" style=" margin-top:0">
            	<span style=" display:block; float:left; font-size:14px; font-weight:bold; line-height:34px; padding-left:20px; padding-right:20px; color:#666">地址修改</span>
            </div>
            <form action="/address/{{$data->id}}" method="post">
                <div class="form-group">
                    <label >收货人</label>
                    <input type="text" class="form-control" name="u_name" value="{{$data->u_name}}">
                </div>
                <div class="form-group">
                    <label >电话</label>
                    <input type="text" class="form-control" name="u_phone" value="{{$data->u_phone}}">
                 </div>
                <div class="form-group" style="margin-top:10px">
                    <label>地址</label>
                    <input style="border:1px solid #bbb; box-shadow:none;font-size:12px; text-indent:6px;" type="text" class="form-control shuru" id="readdress" value="{{$data->u_address}}" placeholder="请填写真实地址" name="u_address"/>
                    <span><i style="color:red">*</i>请按照格式填写!</span>
                </div>
                {{csrf_field()}}
                {{method_field('PUT')}}
                <input type="submit" value="提交" id="submit" class="btn btn-success">
            </form>
        </div>
        <!--right结束-->
    </div>
    <!--详细列表结束-->
</div>
<!--个人中心结束-->
<script>
</script>
</body>
</html>    
                
        

