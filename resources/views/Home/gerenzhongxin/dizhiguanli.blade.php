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
        <a href="#">地址管理</a>
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
          	<div class="dfdaspjtk" style=" margin-top:20px">
            	<span style=" display:block; float:left; font-size:14px; font-weight:bold;margin-top:13px; line-height:34px; padding-left:20px; padding-right:20px; color:#666">地址列表</span>
                <button style=" line-height:36px; margin-top:10px; font-weight:bold; color:#fff; float:right" class="btn btn-success btn-xs zcznmdfc1" data-target="#mymodel" data-toggle="modal">添加收货地址</button>
                <s style=" font-size:12px; color:#111;margin-top:15px; line-height:34px; display:block">注：最多保存20个地址</s>
            </div>
            <!-- 错误信息显示 -->
                @if(Session::has('success'))
                    <script>alert("{{Session::get('success')}}")</script>
                @endif
                @if(Session::has('error'))
                    <script>alert("{{Session::get('error')}}")</script>
                @endif
            <!-- model 模态框主体 -->
            <div class="modal fade" id="mymodel">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <!-- 这是模态框头部 -->
                        <div class="modal-header">
                            <!-- data-dismiss="modal" 关闭模态框 -->
                            <button class="close" data-dismiss="modal">&times;</button>
                            <!-- 细节:判断只能添加20条数据 -->
                            <h3 class="modal-title"> 添加收货地址</h3>
                        </div>
                        <div class="modal-body">
                            <form action="/addres" method="post">
                                <div class="form-group">
                                    <label >所在地区</label>
                                    <script src="/home/js/city.js/cityJson.js"></script>
                                    <script src="/home/js/city.js/citySet.js"></script>
                                    <script src="/home/js/city.js/Popt.js"></script>
                                    <div class="choosecity">
                                        <!-- 细节处理:如果每次用户添加完之后,再次添加会有默认值,地区的默认值是空的 -->
                                        <input type="text" id="city" value=""/ style=" font-size:12px; margin-top:5px; border:1px solid #cacace; width:200px;" class="form-control" required placeholder="点击选择地区">
                                        <script type="text/javascript">
                                            $("#city").click(function (e) {
                                            SelCity(this,e);
                                            });
                                        </script>
                                    </div>
                                </div>
                                <div class="form-group" style="margin-top:10px">
                                    <label>详细的地址</label>
                                    <input style="border:1px solid #bbb; box-shadow:none;font-size:12px; text-indent:6px;" type="text" class="form-control shuru" id="readdress" placeholder="请填写真实地址，不需要重复填写所在地区" name="u_addres" required />
                                </div>
                                <div class="form-group">
                                    <label >收货人</label>
                                    <input type="text" class="form-control" name="u_name" required>
                                </div>
                                <div class="form-group">
                                    <label >电话</label>
                                    <input type="text" class="form-control" name="u_phone" required>
                                </div>
                                
                                {{csrf_field()}}
                                <input type="submit" value="提交" id="submit" class="btn btn-success">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-info" data-dismiss="modal">关闭</button>
                        </div>
                    </div>
                </div>
            </div>
            @if(count($data)!=0)
            @foreach($data as $value)
            <!--一条地址开始-->
            <div class="adressdeliebi">
                <div class="adressfive">
                    <div class="shrtm">
                        <span>收货人</span>
                        <p>{{$value->u_name}}</p>
                    </div>
                    <div class="shrjddz">
                        <span>收货地址</span>
                        <p>{{$value->u_address}}</p>
                    </div>
                    <div class="shrjbdh">
                        <span>联系方式</span>
                        <p>{{$value->u_phone}}</p>
                    </div>
                    <div class="shrtmdcz" style=" float:right">
                        <span>操作</span>
                        <a href="/address/{{$value->id}}/edit" class="btn btn-info" style="color:#fff">编辑</a>
                        <a href="/addrdel?id={{$value->id}}" class="btn btn-success" style="color:#fff">删除</a>
                    </div>
                    <div class="shrjbdh" style=" float:right;margin-top:35px;">
                        <p> @if($value->default == 1) 默认地址 @else <a href="/moren/{{$value->id}}">设为默认地址</a> @endif </p>
                    </div>
                </div>
            </div>
            <!--一条地址结束-->
            <!--地址结束-->
            @endforeach
            @else
            <h3>暂无地址,可以点击右上角<span style="color:red">添加收货地址</span>进行添加...</h3>
            @endif
        </div>
        <!--right结束-->
    </div>
    <!--详细列表结束-->
</div>
<!--个人中心结束-->
<script>
    // $('#submit').click(function(){
    //    var city = $('#city').val();
    //    // alert(city);
       
    // })
</script>
</body>
</html>    
                
        

