@extends('Home.Public.public')
@section('main')
<style>
        .ddss{
            width:980px;
            text-align:center;
            font-size:13px;
        }
        .rddss{
            width:980px;
            height:40px;
            line-height:40px;
            background-color:#F1F1F1;
            float:left;
        }
        .reass{
            width:380px;
            height:40px;
            float:left;
        }
        .reass1{
            width:149px;
            height:40px;
            float:left;
        }
        .reass2{
            width:300px;
            height:40px;
            float:left;
        }
        .big{
            width:980px;
        }
        .left{
            width:620px;
            float: left;
        }
        .right{
            width:119px;
            border-right:1px solid #ECECEC;
            border-bottom:1px solid #ECECEC;
            float: left;
        }


        .center{
            width: 620px;
            height: 120px;
            font-size:12px;
            border-left:1px solid #ECECEC;
            border-right:1px solid #ECECEC;
            border-bottom:1px solid #ECECEC;
        }
        .reblas{
            width:120px;
            height:120px;
            float:left;
        }
        .reblas1{
            width:255px;
            height:120px;
            float:left;
        }
        .reblas2{
            width:80px;
            height:120px;
            float:left;
        }
        .reblas3{
            width:40px;
            height:120px;
            float:left;
        }
        .reblas4{
            width:110px;
            height:120px;
            float:left;
        }
        #boead{

            text-decoration:none;
            color:#333333;
            font-size:12px;
        }
        #boead:hover{
            color:#FF6700;
        }

        #pright p{
            font-size:15px;
        }

    </style>
<!--个人中心首页 -->
<div class="thetoubu">
	<!--头部-->
	<div class="thetoubu1">
    		<b>
    		@if(empty($datas))
    		<img src=""/>
    		@else
        	<img src="{{$datas->user_pic}}"/>
        @endif
        </b>
        @if(empty($data))
        <em></em>
        @else
        <em>{{$data->phone}}</em>
        @endif
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
        <!--lll-->
        	<div class="zuiriftp1">
            	<ul>
                	<li>
                        <span>账户余额</span>
                        <p>￥1000</p>
                    </li>
                    <li>
                    	<span>我的积分</span>
                        <p>1000</p>
                    </li>
                    <li>
                    	<span>我的优惠劵</span>
                        <p><s>2</s>张</p>
                    </li>
                    <li>
                    	<span>我的帝云币</span>
                        <p>0</p>
                    </li>
                </ul>
            </div>
        <!--lll-->
        	<div class="dfdaspjtk">
            	<span style=" display:block; float:left; font-size:14px; font-weight:bold; line-height:34px; padding-left:20px; padding-right:20px; color:#666">交易提醒</span>
                <a href="javascript:void(0)" dd="5" style="color:#09f">全部订单&nbsp;(<s>{{$sall}}</s>)</a>
            	<a href="javascript:void(0)" dd="0">待付款&nbsp;(<s>{{$szero}}</s>)</a>
                <a href="javascript:void(0)" dd="1">待发货&nbsp;(<s>{{$sone}}</s>)</a>
                <a href="javascript:void(0)" dd="2">待收货&nbsp;(<s>{{$stwo}}</s>)</a>
                <a href="javascript:void(0)" dd="3">待评价&nbsp;(<s>{{$sthree}}</s>)</a>
            </div>
            <script>
			$(function(){
				$(".dfdaspjtk a").click(function(){
					$(this).css({color:"#09f"}).siblings().css({color:"#333"});
                    var id=$(this).attr('dd');
                    // alert(id);
                    $('#removes').empty();
                    $.get("/status",{id:id},function(data){
                        // alert(data);
                        // 遍历
                        for(var i=0;i<data.length;i++){
                            // alert(data[i].dev);
                            var ddss=$('<div class="ddss"></div>');
                            var rddss=$('<div class="rddss"><div class="reass">'+data[i].addtime+'&nbsp;&nbsp; 订单编号 : '+data[i].o_number+'</div><div class="reass1"></div><div class="reass1"></div><div class="reass2"></div></div>');
                            if(data[i].status==0){
                                var rights=$('<div class="right"><p style="margin-top:20px">￥'+data[i].total+'.00</p><p>(含运费：0.00)</p><p style="margin-top:15px" ><a href="/status/'+data[i].id+'" id="reads" class="btn btn-success">去付款</a></p></div><div class="right" id="pright"><p style="margin-top:20px">交易状态</p><p style="margin-top:20px;color:#ff6700">未付款</p></div><div class="right"><p style="margin-top:20px">评价商品</p></div>');
                            }else if(data[i].status==1){
                                var rights=$('<div class="right"><p style="margin-top:20px">￥'+data[i].total+'.00</p><p>(含运费：0.00)</p></div><div class="right" id="pright"><p style="margin-top:20px">交易状态</p><p style="margin-top:20px;color:#ff6700">待发货</p></div><div class="right"><p style="margin-top:20px">评价商品</p></div>');
                            }else if(data[i].status==2){
                                var rights=$('<div class="right"><p style="margin-top:20px">￥'+data[i].total+'.00</p><p>(含运费：0.00)</p><p style="margin-top:15px"><a href="/affirm/'+data[i].id+'" id="readss" class="btn btn-danger" onclick="return confirm('+"'确认收货吗'"+')">确认收货</a></p></div><div class="right" id="pright"><p style="margin-top:20px">交易状态</p><p style="margin-top:20px;color:#ff6700">待收货</p></div><div class="right"><p style="margin-top:20px">评价商品</p></div>');
                            }else if(data[i].status==3){
                                var rights=$('<div class="right"><p style="margin-top:20px">￥'+data[i].total+'.00</p><p>(含运费：0.00)</p></div><div class="right" id="pright"><p style="margin-top:20px">交易状态</p><p style="margin-top:20px;color:#ff6700">已收货</p></div><div class="right"><p style="margin-top:20px">评价商品</p><p style="margin-top:15px"><a href="/status/'+data[i].id+'" id="readss" class="btn btn-primary">去评价</a></p></div>');
                            }else if(data[i].status==4){
                                var rights=$('<div class="right"><p style="margin-top:20px">￥'+data[i].total+'.00</p><p>(含运费：0.00)</p></div><div class="right" id="pright"><p style="margin-top:20px">交易状态</p><p style="margin-top:20px;color:#ff6700">完成交易</p></div><div class="right"><p style="margin-top:20px">评价商品</p></div>');
                            }
                            
                            var bigs=$('<div class="big"></div>');
                            var lefts=$('<div class="left"></div>');
                            for(var j=0;j<(data[i].dev).length;j++){
                                // alert((data[i].dev)[j].g_total);
                                var centers=$('<div class="center"><div class="reblas"><img src="'+(data[i].dev)[j].p_url+'" height="80px" style="margin-top:15px"></div><div class="reblas1"><p style="text-align:left;margin-top:15px"><a href="/homegoods/'+(data[i].dev)[j].id+'" id="boead">'+(data[i].dev)[j].name+'</a></p></div><div class="reblas2"><p style="margin-top:15px">￥'+(data[i].dev)[j].g_price+'</p></div><div class="reblas3"><p style="margin-top:15px">x'+(data[i].dev)[j].g_number+'</p></div><div class="reblas4"><p style="margin-top:15px"><a href="#" id="boead">申请售后</a></p></div></div>');
                                
                                lefts.append(centers);
                            }
                            bigs.append(lefts);
                            bigs.append(rights);
                            ddss.append(rddss);
                            ddss.append(bigs);
                            $('#removes').append(ddss);

                             $('.right').each(function(){
                                dd=$(this).parent().find('div').eq(0).css('height');
                                $(this).css('height',dd);
                            });

                        }
                    },'json');

                   
				});
			});
            </script>
        <!--所有列表-->
            <div class="sydlbdzz" id="removes">
                <!--一个列表开始-->
                @foreach($result as $key=>$v)
                <div class="ddss">
                    <div class="rddss">
                        <div class="reass">{{$v->addtime}} &nbsp;&nbsp;订单编号 : {{$v->o_number}}</div>
                        <div class="reass1"></div>
                        <div class="reass1"></div>
                        <div class="reass2"></div>
                    </div>
                    <div class="big">
                        <div class="left" id="div">
                            @foreach($v->dev as $k=>$vv)
                            <div class="center">
                                <div class="reblas"><img src="{{$vv->p_url}}" height="80px" style="margin-top:15px"></div>
                                <div class="reblas1"><p style="text-align:left;margin-top:15px">
                                    <a href="/homegoods/{{$vv->id}}" id="boead">{{$vv->name}}</a></p>
                                </div>
                                <div class="reblas2"><p style="margin-top:15px">￥{{$vv->g_price}}</p></div>
                                <div class="reblas3"><p style="margin-top:15px">x{{$vv->g_number}}</p></div>
                                <div class="reblas4">
                                    <p style="margin-top:15px"><a href="#" id="boead">申请售后</a></p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="right">
                            <p style="margin-top:20px">￥{{$v->total}}.00</p>
                            <p>(含运费：0.00)</p>
                            @if($v->status==0)
                                <p style="margin-top:15px" ><a href="/status/{{$v->id}}" id="reads" class="btn btn-success">去付款</a></p>
                            @elseif($v->status==2)
                                <p style="margin-top:15px"><a href="/affirm/{{$v->id}}" id="readss" class="btn btn-danger" onclick="return confirm('确认收货吗')">确认收货</a></p>
                            @endif
                        </div>
                        <div class="right" id="pright">
                            <p style="margin-top:20px">交易状态</p>
                            @if($v->status==0)
                            <p style="margin-top:20px;color:#ff6700">未付款</p>
                            @elseif($v->status==1)
                            <p style="margin-top:20px;color:#ff6700">待发货</p>
                            @elseif($v->status==2)
                            <p style="margin-top:20px;color:#ff6700">待收货</p>
                            @elseif($v->status==3)
                            <p style="margin-top:20px;color:#ff6700">已收货</p>
                            @elseif($v->status==4)
                            <p style="margin-top:20px;color:#ff6700">完成交易</p>
                            @endif
                        </div>
                        <div class="right">
                        <p style="margin-top:20px">评价商品</p>
                        @if($v->status==3)
                        <p style="margin-top:15px"><a href="/status/{{$v->id}}" id="readss" class="btn btn-primary">去评价</a></p>
                        @endif
                        </div>
                    </div>
                </div>
                @endforeach
                <!--一个列表结束-->
                <script>
                    $('.right').each(function(){
                        dd=$(this).parent().find('div').eq(0).css('height');
                        $(this).css('height',dd);
                    });

                </script>
            </div> 
        <!--所有列表结束-->
        <!--我的购物车-->
        	<div class="dfdaspjtk">
            	<span style=" display:block; float:left; font-size:14px; font-weight:bold; line-height:34px; padding-left:20px; padding-right:20px; color:#666">我的购物车</span>
                <a href="#" style=" display:block; float:right; font-size:14px; font-weight:bold; line-height:34px; padding-left:20px; padding-right:20px; color:#f90">清空购物车</a>
                <a href="#" style=" display:block; float:right; font-size:14px; font-weight:bold; line-height:34px; padding-left:20px; padding-right:20px; color:#09f">查看购物车内所有商品</a>
            </div>
            <div class="wofrgwcjb">
            	<ul>
                	<li>
                    	<a href="#">
                        	<b>
                            	<img src="/home/img/gaoqingxianshiqi.jpg"/>
                            </b>
                            <h5>海尔润眼显示器</h5>
                            <span>3000元</span>
                        </a>
                        <a href="#" style=" width:184px; line-height:20px; font-size:12px; color:#666; display:block; text-align:center" class="qsbqmzb">帝云官方旗舰店</a>
                    </li>
                    <li>
                    	<a href="#">
                        	<b>
                            	<img src="/home/img/gaoqingxianshiqi.jpg"/>
                            </b>
                            <h5>海尔润眼显示器</h5>
                            <span>3000元</span>
                        </a>
                        <a href="#" style=" width:184px; line-height:20px; font-size:12px; color:#666; display:block; text-align:center" class="qsbqmzb">帝云官方旗舰店</a>
                    </li>
                    <li>
                    	<a href="#">
                        	<b>
                            	<img src="/home/img/gaoqingxianshiqi.jpg"/>
                            </b>
                            <h5>海尔润眼显示器</h5>
                            <span>3000元</span>
                        </a>
                        <a href="#" style=" width:184px; line-height:20px; font-size:12px; color:#666; display:block; text-align:center" class="qsbqmzb">帝云官方旗舰店</a>
                    </li>
                    <li>
                    	<a href="#">
                        	<b>
                            	<img src="/home/img/gaoqingxianshiqi.jpg"/>
                            </b>
                            <h5>海尔润眼显示器</h5>
                            <span>3000元</span>
                        </a>
                        <a href="#" style=" width:184px; line-height:20px; font-size:12px; color:#666; display:block; text-align:center" class="qsbqmzb">帝云官方旗舰店</a>
                    </li>
                    <li>
                    	<a href="#">
                        	<b>
                            	<img src="/home/img/gaoqingxianshiqi.jpg"/>
                            </b>
                            <h5>海尔润眼显示器</h5>
                            <span>3000元</span>
                        </a>
                        <a href="#" style=" width:184px; line-height:20px; font-size:12px; color:#666; display:block; text-align:center" class="qsbqmzb">帝云官方旗舰店</a>
                    </li>
                </ul>
            </div>
        <!--购物车结束--> 
        <!--我的商品收藏-->
        	<div class="dfdaspjtk">
            	<span style=" display:block; float:left; font-size:14px; font-weight:bold; line-height:34px; padding-left:20px; padding-right:20px; color:#666">商品收藏</span>
                <a href="#" style=" display:block; float:right; font-size:14px; font-weight:bold; line-height:34px; padding-left:20px; padding-right:20px; color:#f90">清空收藏</a>
                <a href="#" style=" display:block; float:right; font-size:14px; font-weight:bold; line-height:34px; padding-left:20px; padding-right:20px; color:#09f">查看收藏的所有商品</a>
            </div>
            <div class="wofrgwcjb">
            	<ul>
                	<li>
                    	<a href="#">
                        	<b>
                            	<img src="/home/img/gaoqingxianshiqi.jpg"/>
                            </b>
                            <h5>海尔润眼显示器</h5>
                            <span>3000元</span>
                        </a>
                        <a href="#" style=" width:184px; line-height:20px; font-size:12px; color:#666; display:block; text-align:center" class="qsbqmzb">帝云官方旗舰店</a>
                    </li>
                    <li>
                    	<a href="#">
                        	<b>
                            	<img src="/home/img/gaoqingxianshiqi.jpg"/>
                            </b>
                            <h5>海尔润眼显示器</h5>
                            <span>3000元</span>
                        </a>
                        <a href="#" style=" width:184px; line-height:20px; font-size:12px; color:#666; display:block; text-align:center" class="qsbqmzb">帝云官方旗舰店</a>
                    </li>
                    <li>
                    	<a href="#">
                        	<b>
                            	<img src="/home/img/gaoqingxianshiqi.jpg"/>
                            </b>
                            <h5>海尔润眼显示器</h5>
                            <span>3000元</span>
                        </a>
                        <a href="#" style=" width:184px; line-height:20px; font-size:12px; color:#666; display:block; text-align:center" class="qsbqmzb">帝云官方旗舰店</a>
                    </li>
                    <li>
                    	<a href="#">
                        	<b>
                            	<img src="/home/img/gaoqingxianshiqi.jpg"/>
                            </b>
                            <h5>海尔润眼显示器</h5>
                            <span>3000元</span>
                        </a>
                        <a href="#" style=" width:184px; line-height:20px; font-size:12px; color:#666; display:block; text-align:center" class="qsbqmzb">帝云官方旗舰店</a>
                    </li>
                    <li>
                    	<a href="#">
                        	<b>
                            	<img src="/home/img/gaoqingxianshiqi.jpg"/>
                            </b>
                            <h5>海尔润眼显示器</h5>
                            <span>3000元</span>
                        </a>
                        <a href="#" style=" width:184px; line-height:20px; font-size:12px; color:#666; display:block; text-align:center" class="qsbqmzb">帝云官方旗舰店</a>
                    </li>
                </ul>
            </div>
        <!--商品收藏结束-->
        <!--我收藏的店铺-->
        	<div class="dfdaspjtk" style=" background:rgba(0,66,255,0.1)">
            	<span style=" display:block; float:left; font-size:14px; font-weight:bold; line-height:34px; padding-left:20px; padding-right:20px; color:#666">店铺收藏</span>
                <a href="#" style=" display:block; float:right; font-size:14px; font-weight:bold; line-height:34px; padding-left:20px; padding-right:20px; color:#f90">清空店铺</a>
                <a href="#" style=" display:block; float:right; font-size:14px; font-weight:bold; line-height:34px; padding-left:20px; padding-right:20px; color:#09f">查看收藏的所有店铺</a>
            </div>
            <div class="wotrfrgwcjb">
            	<ul>
                	<li>
                    	<a href="#"><img src="/home/img/57457e3bN79fa0a40.jpg"/>
                        <h5>天天开心的店铺</h5>
                        </a>	
                    </li>
                    <li>
                    	<a href="#"><img src="/home/img/57457e3bN79fa0a40.jpg"/>
                        <h5>天天开心的店铺</h5>
                        </a>	
                    </li>
                    <li>
                    	<a href="#"><img src="/home/img/57457e3bN79fa0a40.jpg"/>
                        <h5>天天开心的店铺</h5>
                        </a>	
                    </li>
                    <li>
                    	<a href="#"><img src="/home/img/57457e3bN79fa0a40.jpg"/>
                        <h5>天天开心的店铺</h5>
                        </a>	
                    </li>
                    <li>
                    	<a href="#"><img src="/home/img/57457e3bN79fa0a40.jpg"/>
                        <h5>天天开心的店铺</h5>
                        </a>	
                    </li>
                    <li>
                    	<a href="#"><img src="/home/img/57457e3bN79fa0a40.jpg"/>
                        <h5>天天开心的店铺</h5>
                        </a>	
                    </li>
                    <li>
                    	<a href="#"><img src="/home/img/57457e3bN79fa0a40.jpg"/>
                        <h5>天天开心的店铺</h5>
                        </a>	
                    </li>
                    <li>
                    	<a href="#"><img src="/home/img/57457e3bN79fa0a40.jpg"/>
                        <h5>天天开心的店铺</h5>
                        </a>	
                    </li>
                </ul>
            </div>
        <!--店铺收藏结束-->
         <!--我的足迹-->
        	<div class="dfdaspjtk" style=" background:rgba(0,66,255,0.1)">
            	<span style=" display:block; float:left; font-size:14px; font-weight:bold; line-height:34px; padding-left:20px; padding-right:20px; color:#666">我的足迹</span>
                <a href="#" style=" display:block; float:right; font-size:14px; font-weight:bold; line-height:34px; padding-left:20px; padding-right:20px; color:#f90">清空历史</a>
                <a href="#" style=" display:block; float:right; font-size:14px; font-weight:bold; line-height:34px; padding-left:20px; padding-right:20px; color:#09f">查看我的足迹</a>
            </div>
            <div class="wofrgwcjb">
            	<ul>
                	<li>
                    	<a href="#">
                        	<b>
                            	<img src="/home/img/gaoqingxianshiqi.jpg"/>
                            </b>
                            <h5>海尔润眼显示器</h5>
                            <span>3000元</span>
                        </a>
                        <a href="#" style=" width:184px; line-height:20px; font-size:12px; color:#666; display:block; text-align:center" class="qsbqmzb">帝云官方旗舰店</a>
                    </li>
                    <li>
                    	<a href="#">
                        	<b>
                            	<img src="/home/img/gaoqingxianshiqi.jpg"/>
                            </b>
                            <h5>海尔润眼显示器</h5>
                            <span>3000元</span>
                        </a>
                        <a href="#" style=" width:184px; line-height:20px; font-size:12px; color:#666; display:block; text-align:center" class="qsbqmzb">帝云官方旗舰店</a>
                    </li>
                    <li>
                    	<a href="#">
                        	<b>
                            	<img src="/home/img/gaoqingxianshiqi.jpg"/>
                            </b>
                            <h5>海尔润眼显示器</h5>
                            <span>3000元</span>
                        </a>
                        <a href="#" style=" width:184px; line-height:20px; font-size:12px; color:#666; display:block; text-align:center" class="qsbqmzb">帝云官方旗舰店</a>
                    </li>
                    <li>
                    	<a href="#">
                        	<b>
                            	<img src="/home/img/gaoqingxianshiqi.jpg"/>
                            </b>
                            <h5>海尔润眼显示器</h5>
                            <span>3000元</span>
                        </a>
                        <a href="#" style=" width:184px; line-height:20px; font-size:12px; color:#666; display:block; text-align:center" class="qsbqmzb">帝云官方旗舰店</a>
                    </li>
                    <li>
                    	<a href="#">
                        	<b>
                            	<img src="/home/img/gaoqingxianshiqi.jpg"/>
                            </b>
                            <h5>海尔润眼显示器</h5>
                            <span>3000元</span>
                        </a>
                        <a href="#" style=" width:184px; line-height:20px; font-size:12px; color:#666; display:block; text-align:center" class="qsbqmzb">帝云官方旗舰店</a>
                    </li>
                </ul>
            </div>
        <!--足迹结束-->    
        </div>
        <!--right结束-->
    </div>
    <!--详细列表结束-->
</div>
<!--个人中心结束-->
@endsection
@section('title','个人中心')