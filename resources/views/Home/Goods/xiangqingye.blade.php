@extends('Home.Public.public')
@section('title',$data->name)
@section('main')
 <!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>详情页</title>
<link rel="stylesheet" type="text/css" href="/home/css/top.css"/>
<link rel="stylesheet" type="text/css" href="/home/css/lunbo.css">
<link rel="stylesheet" type="text/css" href="/home/css/zhanshi.css">
<link rel="stylesheet" type="text/css" href="/home/css/footer.css">
<script src="/home/js/jquery-1.8.3.min.js"></script>
<script src="/home/js/public.js"></script>
</head>

<body>

<!--你当前位置 -->
<div class="nowweizhi">
	<span>你当前的位置</span>
    <b>></b>
    <a href="/list?id={{$data->cate_id}}">{{$data->summ}}</a>
    <b>></b>
    <a href="/homegoods/{{$data->id}}">{{mb_substr($data->name,0,15,'utf-8').'...'}}</a>
</div>
<!--商品展示区域-->
<div class="theshopshow">
	<!--left-->
        <!-- 唯尚衣族商品展示 -->
		<script src="/home/js/163css.js"></script>
        <script src="/home/js/lib.js"></script>
			<div id="preview">
				@foreach($photo as $img)
				@if($img->main==1)
				<div class=jqzoom id="spec-n1" onClick="window.open('/')"><IMG height="380px" src="{{$img->p_url}}" jqimg="{{$img->p_url}}" width="320px">
					</div>
				@endif
				@endforeach
					<div id="spec-n5">
						<div class=control id="spec-left">
							<img src="/home/img/left.gif" />
						</div>
						<div id="spec-list">
							<ul class="list-h">
								@foreach($photo as $pic)
								<li><img src="{{$pic->p_url}}"> </li>
								@endforeach
							</ul>
						</div>
						<div class=control id="spec-right">
							<img src="/home/img/right.gif" />
						</div>
					</div>
				</div>
				<SCRIPT type=text/javascript>
					$(function(){			
						   $(".jqzoom").jqueryzoom({
								xzoom:400,
								yzoom:400,
								offset:10,
								position:"right",
								preload:1,
								lens:1
							});
							$("#spec-list").jdMarquee({
								deriction:"left",
								width:350,
								height:56,
								step:2,
								speed:4,
								delay:10,
								control:true,
								_front:"#spec-right",
								_back:"#spec-left"
							});
							$("#spec-list img").bind("mouseover",function(){
								var src=$(this).attr("src");
								$("#spec-n1 img").eq(0).attr({
									src:src.replace("\/n5\/","\/n1\/"),
									jqimg:src.replace("\/n5\/","\/n0\/")
								});
								$(this).css({
									"border":"2px solid #ff6600",
									"padding":"1px"
								});
							}).bind("mouseout",function(){
								$(this).css({
									"border":"1px solid #ccc",
									"padding":"2px"
								});
							});				
						})
				</SCRIPT>
			<!-- 唯尚衣族商品展示 End -->                                    
	<!--right-->
    <div class="shoppnum">
    	<!--n1-->
        <div class="shanpmai">
        	<h1 class="spdname">{{$data->name}} </h1>
            <div class="hotspeak">
            	{{$data->summ}}
            </div>
            <div class="shoujiap">
            	<span>商城价格</span>
                <i>￥</i><em>{{$data->price}}</em>
            </div>
            <div class="chuxinxi">
            	<span>促销信息</span><i>满200.00减20.00，满400.00减40.00</i>
            </div>
            <div class="shoujigm">
            	<span>APP独享打折</span>
                <div class="sjapp">用手机购买
                	<b><img src="/home/img/20181026085209.jpg"/></b>
                </div>
            </div>
            <div class="peisongzhi">
            	<span>配送</span>
                <script src="/home/js/city.js/cityJson.js"></script>
                <script src="/home/js/city.js/citySet.js"></script>
                <script src="/home/js/city.js/Popt.js"></script>
                <div class="choosecity">
                	<input type="text" id="city" value="点击选择地区"/ style=" height:20px; font-size:12px; margin-top:5px; border:1px solid #cacace">
                    <script type="text/javascript">
						$("#city").click(function (e) {
						SelCity(this,e);
						});
					</script>
                </div>
               
                
            </div>
            <div class="xuanzcolor">
             <span style=" font-weight:bold; color:#333">有货</span><a href="#" style="font-size: 14px;line-height: 30px;margin-left:10px;">支持货到付款</a>
            <!-- 	<span>选择颜色</span>
                            <div class="morecolor">
                            	<ul>
                                	<li><a href="#"><img src="/home/img/56aec892N2f09760e.jpg!cc_60x76.jpg"/></a></li>
                                    <li><a href="#"><img src="/home/img/56aec892N2f09760e.jpg!cc_60x76.jpg"/></a></li>
                                    <li><a href="#"><img src="/home/img/56aec892N2f09760e.jpg!cc_60x76.jpg"/></a></li>
                                    <li><a href="#"><img src="/home/img/56aec892N2f09760e.jpg!cc_60x76.jpg"/></a></li>
                                    <li><a href="#"><img src="/home/img/56aec892N2f09760e.jpg!cc_60x76.jpg"/></a></li>
                                    <li><a href="#"><img src="/home/img/56aec892N2f09760e.jpg!cc_60x76.jpg"/></a></li>
                                    <li><a href="#"><img src="/home/img/56aec892N2f09760e.jpg!cc_60x76.jpg"/></a></li>
                                </ul>
                                <script>
            						$(function(){
            							$(".morecolor ul li").click(function(){
            								$(this).css({border:"1px solid #f00"}).siblings().css({border:"none"})
            								})
            							$(".morecm ul li").click(function(){
            								$(this).css({border:"1px solid #f00"}).siblings().css({border:"1px solid #cacace"})
            								})	
            							})
                                </script>
                            </div> -->
                <div class="choosecm">
                	<span>尺码</span>
                    <div class="morecm">
                    	<ul>
                            <li><a href="#">{{$data->size}}</a></li>
                        </ul>
                    </div>
                </div>
                 <!--购买数量-->

                <form action="/homecart" method="post">

                <!-- 获取尺码数据 -->
                <input type="hidden" name="size" value="{{$data->size}}">
                <!-- 商品的价格 -->
                <input type="hidden" name="price" value="{{$data->price}}">

                <div class="goumaijiajian">
                    <span>数量</span>
                    <input id="min" name="" type="button" value="-" / style=" width:30px; height:30px; font-size:12px; line-height:30px; color:#333; float:left; cursor:pointer">  
    <input id="text_box" name="num" type="text" value="1" style="width:60px;height:30px; font-size:12px; text-align:center; float:left;border:1px solid #cacace;"/>  
    <input id="add" name="" type="button" value="+" / style=" width:30px; height:30px; font-size:12px; line-height:30px; color:#333; float:left; cursor:pointer">
                </div>
                <script>
                    $(document).ready(function(){
                    //获得文本框对象
                       var t = $("#text_box");
                    //初始化数量为1,并失效减
                    $('#min').attr('disabled',true);
                        //数量增加操作
                        $("#add").click(function(){    
                            t.val(parseInt(t.val())+1)
                            if (parseInt(t.val())!=1){
                                $('#min').attr('disabled',false);
                            }
                          
                        }) 
                        //数量减少操作
                        $("#min").click(function(){
                            t.val(parseInt(t.val())-1);
                            if (parseInt(t.val())==1){
                                $('#min').attr('disabled',true);
                            }
                          
                        })
                       
                    });
                    </script>
                      <!--商品编号-->
                <div class="shopbh">
                    <span style="width:60px">商品编号</span>
                    <em>{{$data->number}}</em>
                </div>   
                <!--加入购物车与收藏商品-->
                <input type="hidden" name="id" value="{{$data->id}}">
                 <div class="joinspadsp">
                    @if(session('hid'))
                    <a href="javascript:void(0)" style=" margin-left:67px"><input type="submit" style="background-color:#DF3033;color:white" value="立即购买"></a>
                    @else
                    <a href="/homelogin" style=" margin-left:3px" onclick="return confirm('你还没登录,请登录')">立即购买</a>
                    @endif
                    <a href="javascript:void(0)" style=" margin-left:6px" id="shops">加入购物车</a>
                    <a href="javascript:void(0)" style=" margin-left:6px">收藏该商品</a>
                 </div>
                 {{csrf_field()}}
                </form>  
            </div>
        </div>
        <!-- 加入购物车 -->
        <script>
            $('#shops').click(function(){
                // alert(1);
                var size=$('input[name=size]').val();
                var num=$('input[name=num]').val();
                var id=$('input[name=id]').val();
                var price=$('input[name=price]').val();
                // alert(id);
                $.get("/homecart/create",{size:size,num:num,id:id,price:price},function(data){
                    if(data==1){
                        alert('成功添加购物车');
                    }else{
                        alert('商品已在购物车');
                    }
                })
            });
        </script>
    	<!--n2-->
        <div class="daitianc">
        	<span class="lkadlk">瞧了又瞧</span>
            <div class="lklksp">
            	<ul>
            		@foreach($sales as $sale)
                	<li>
                    	<a href="/homegoods/{{$sale->id}}">
                        	<b>
                            	<img src="{{$sale->p_url}}" title="{{$sale->name}}"/>
                            </b>
                            <h5>{{mb_substr($sale->name,0,12,'utf-8')}}...</h5>
                            <p>{{mb_substr($sale->summ,0,10,'utf-8')}}</p>
                            <span>{{$sale->price}}元</span>
                        </a>
                        <a href="/" style=" width:163px; height:20px;font-size:11px; color:#666; line-height:20px; text-align:center" class="theqjd">唯尚衣族官方旗舰店</a>
                    </li>
                    @endforeach
                </ul>
            </div>
            <!--上去下来的按钮-->
            <div class="ananniu shangfan" style=" background: url(/home/img/__sprite.png) no-repeat 0 0; margin-left:70px"></div>
            <div class="ananniu xiafan" style=" background:url(/home/img/__sprite.png) no-repeat -28px 0; margin-left:50px"></div>
        </div>
        <script>
		$(function(){
			var i=0
			var size=$(".lklksp ul li").size()
			$(".shangfan").click(function(){
				i++
				if(i==size-1){
					i=0;
					}
				$(".lklksp ul").animate({top:-i*218})
				})
			$(".xiafan").click(function(){
				i--
				if(i==-1){
					i=size-2
					}
				$(".lklksp ul").animate({top:-i*218})
				})
			})
        </script>
    </div>
</div>
<!--店长推荐-->
<div class="bosstuijian">
	<div class="bosstj">
    	<span>店长推荐</span>
    </div>
    <div class="bosstjsp">
    	<ul>
    		@foreach($categoods as $goods)
        	<li>
            	<a href="/homegoods/{{$goods->id}}">
                	<b><img src="{{$goods->p_url}}" title="{{$goods->name}}"/></b>
                    <h5>{{mb_substr($goods->name,0,7,'utf-8')}}</h5>
                    <p>{{mb_substr($goods->summ,0,15,'utf-8')}}</p>
                    <span>{{$goods->price}}元</span>
            	</a>
                <a href="/" style=" display:block; width:100%; height:20px; font-size:12px; color:#666; line-height:20px; text-align:center" class="dyzydo">唯尚衣族自营店</a>
            </li>
            @endforeach
        </ul>
    </div>
</div>
<!--商品介绍东西有点多-->
<div class="spjsmore">
	<!--左-->
    <div class="theleftkz">
    	<div class="dpnames">
        	<a href="/">唯尚衣族官方旗舰店</a>
        </div>
        <div class="intolkads">
        	<a href="/">进店看看</a>
            <a href="#">收藏店铺</a>
        </div>
        <div class="nknzaizhao">
        	你可能再找
        </div>
        <div class="zaizdnr">
        	<ul>
       	@foreach($others as $oth)
                <li><a href="/list?id={{$oth->id}}">{{$oth->name}}</a></li>
             @endforeach
            </ul>
        </div>
        <div class="xianguanfls">
        	相关分类
        </div>
        <div class="aboutflsnr">
        	<ul>
        	@foreach($cates as $row)
                <li><a href="/list?id={{$row->id}}">{{mb_substr($row->name,0,11,'utf-8')}}</a></li>
             @endforeach
            </ul>
        </div>
        <div class="xianguanfls">
        	其他相关分类
        </div>
        <div class="aboutflsnr">
        	<ul>
         	   @foreach($others as $other)	
                <li><a href="/list?id={{$other->id}}">{{$other->name}}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="drxgs">
        	达人选购
        </div>
        <div class="drxgsp">
        	<ul>
        	@foreach($rows as $row )
            	<li>
                	<a href="/homegoods/{{$row->id}}">
                    	<b>
                        	<img src="{{$row->p_url}}" title="{{$row->name}}"/>
                        </b>
                        <h5>{{mb_substr($row->name,0,23,'utf-8')}}...</h5>
                        <p>{{$row->price}}元</p>
                    </a>
                    <a href="/" style=" display:block; width:100%; height:20px; text-align:center; color:#666; font-size:12px; line-height:12px">唯尚衣族官方自营店</a>
                </li>
             @endforeach
            </ul>
        </div>
    </div>
    <!--右-->
    <div class="therightnrs">
    	<div class="threespa">
            <ul>
                <li class="oncolors" mt-floors="1" mt-cts="1" id="spencals1">商品介绍</li>
                <li mt-floors="2" mt-cts="1" id="spencals2">商品评价<s>({{$total}})</s></li>
                <li mt-floors="3" mt-cts="1" id="spencals3">售后保障</li>
                
            </ul>
        </div>
        <script>
		$(function(){
			/*控制商品详情、商品评价、售后保障的出现或消失*/
			$(".threespa ul li").mouseenter(function(){
				$(this).addClass("oncolors").siblings().removeClass("oncolors")
				})
			/*控制商品评价里面导航块的添加颜色或减去颜色*/	
			$(".quanbupinglun a").click(function(){
						$(this).addClass("nocolors").siblings().removeClass("nocolors")
						})	
			})
    	</script>
        <!--大容器里面放若干内容-->
        <div class="drqlmfrgnr">
       	<!--商品自诩-->
        	<div class="bigcakes c-1-1">
           	{!!$data->descr!!}
            </div>
        <!--售后保障-->
            <div class="bigcakes c-3-1">
            	<div class="maijiacnqs">
                	<span>卖家承诺</span>
                    <p>唯尚衣族平台卖家销售并发货的商品，由平台卖家提供发票和相应的售后服务。请您放心购买！
注：因厂家会在没有任何提前通知的情况下更改产品包装、产地或者一些附件，本司不能确保客户收到的货物与商城图片、产地、附件说明完全一致。只能确保为原厂正货！并且保证与当时市场上同样主流新品一致。若本商城没有及时更新，请大家谅解！</p>
                </div>
                <div class="maijiacnqs">
                	<span>唯尚衣族承诺</span>
                    <p>唯尚衣族商城向您保证所售商品均为正品行货，唯尚衣族自营商品开具机打发票或电子发票。</p>
                </div>
                <div class="maijiacnqs">
                	<span>全国联保</span>
                    <p>凭质保证书及唯尚衣族商城发票，可享受全国联保服务（奢侈品、钟表除外；奢侈品、钟表由唯尚衣族联系保修，享受法定三包售后服务），与您亲临商场选购的商品享受相同的质量保证。唯尚衣族商城还为您提供具有竞争力的商品价格和运费政策，请您放心购买！ 

注：因厂家会在没有任何提前通知的情况下更改产品包装、产地或者一些附件，本司不能确保客户收到的货物与商城图片、产地、附件说明完全一致。只能确保为原厂正货！并且保证与当时市场上同样主流新品一致。若本商城没有及时更新，请大家谅解！</p>
                </div>
                <div class="maijiacnqs">
                	<span>无忧退换货</span>
                    <p>客户购买唯尚衣族自营商品7日内（含7日，自客户收到商品之日起计算），在保证商品完好的前提下，可无理由退货。（部分商品除外，详情请见各商品细则）</p>
                </div>
                <div class="maijiacnqs">
                	<span>权利声明</span>
                    <p>唯尚衣族商城上的所有商品信息、客户评价、商品咨询、网友讨论等内容，是唯尚重要的经营资源，未经许可，禁止非法转载使用。<br>

注：本站商品信息均来自于合作方，其真实性、准确性和合法性由信息拥有者（合作方）负责。本站不提供任何保证，并不承担任何法律责任。</p>
                </div>
                <div class="maijiacnqs">
                	<span>价格说明</span>
                    <p><strong>唯尚价：</strong>唯尚价为商品的销售价，是您最终决定是否购买商品的依据。<br>

<strong>划线价：</strong>商品展示的划横线价格为参考价，该价格可能是品牌专柜标价、商品吊牌价或由品牌供应商提供的正品零售价（如厂商指导价、建议零售价等）或该商品在唯尚平台上曾经展示过的销售价；由于地区、时间的差异性和市场行情波动，品牌专柜标价、商品吊牌价等可能会与您购物时展示的不一致，该价格仅供您参考。
折扣：如无特殊说明，折扣指销售商在原价、或划线价（如品牌专柜标价、商品吊牌价、厂商指导价、厂商建议零售价）等某一价格基础上计算出的优惠比例或优惠金额；如有疑问，您可在购买前联系销售商进行咨询。<br>

<strong>异常问题：</strong>商品促销信息以商品详情页“促销”栏中的信息为准；商品的具体售价以订单结算页价格为准；如您发现活动商品售价或促销信息有异常，建议购买前先联系销售商咨询。</p>
                </div>
            </div>
        <!--商品评价-->
            <div class="bigcakes c-2-1">
            	<!--对该商品的综合评分-->
                <div class="duigaispdzhpfs">
                	<!--left-->
                    <div class="goodhpd">
                    	<span><i>{{$per}}</i>%</span>
                        <p>好评度</p>
                    </div>
                    <!--right-->
                    <div class="haopingjdts">
                    	<!--好评-->
                        <div class="gdpjbf">
                        	<em>好评<i>{{$per}}%</i></em>
                            <span>
                            	<p style=" width:{{$per}}%"></p>
                            </span>
                        </div>
                        <!--中评-->
                        <div class="gdpjbf">
                        	<em>中评<i>{{$zper}}%</i></em>
                            <span>
                            	<p style=" width:{{$zper}}%"></p>
                            </span>
                        </div>
                        <!--差评-->
                        <div class="gdpjbf">
                        	<em>差评<i>{{$cper}}%</i></em>
                            <span>
                            	<p style=" width:{{$cper}}%"></p>
                            </span>
                        </div>
                        <!--差评结束-->
                    </div>
                    <!--right结束-->	
                </div>
                <!--评分结束-->
            	<div class="quanbupinglun">
                	<a href="javascript:void(0)" class="nocolors" mt-floord="1" mt-ctd="1">全部评论<em>({{$total}})</em></a>
                    <a href="javascript:void(0)" mt-floord="2" mt-ctd="1">好评<em>({{$hping}})</em></a>
                    <a href="javascript:void(0)" mt-floord="3" mt-ctd="1">中评<em>({{$zhong}})</em></a>
                    <a href="javascript:void(0)" mt-floord="4" mt-ctd="1">差评<em>({{$cha}})</em></a>
                </div>
                <!--这个容器里面放了全部评论、好评、中评、差评、-->
                <div class="qbpltyf123">
                <!--全部评论-->
                	<div class="smallcake d-1-1" style="display:block">
                    <!--一条评论开始-->
                	@foreach($appraise as $quanbu)
                    	<div class="thepcpls">
                        <!--左-->
                        	<div class="zuileftop">
                            	<!--改变星级只需要改" no-repeat X 0"里面的X即可，一次是17像素-->
                            	<div class="thstar" style=" background:url(/home/img/commentsListIcons1.png) no-repeat 
                            	@if($quanbu->gscore==5)
                            	0
                            	@elseif($quanbu->gscore==4)
                            	-17px
                            	@elseif($quanbu->gscore==3)
                            	-34px
                            	@elseif($quanbu->gscore==2)
                            	-51px
                            	@else if($quanbu->gscore==1)
                            	-68px
                            	@endif
                            	 0"></div>
                                <div class="shdltpl">收货1天后评论</div>
                                <div class="shdplsj">{{$quanbu->addtime}}</div>
                            </div>
                        <!--中-->
                        	<div class="zuicenterop">
                            	{{$quanbu->content}}
                            </div>
                        <!--右-->
                        	<div class="zuirightop">
                            	<div class="touxadmz">
                                	<b>
                                    	<img src="/home/img/touxiang.png"/>
                                    </b>
                                    <em>{{mb_substr($quanbu->phone,0,2,'utf-8')}}******{{mb_substr($quanbu->phone,-2,2,'utf-8')}}</em>
                                </div>
                                <div class="zgrsndra">山东</div>
                            </div>
                            <!--购买的商品信息-->
                            <div class="gmdspxinxisz">
                                <a href="/homegoods/{{$quanbu->goods_id}}">{{mb_substr($quanbu->gname,0,30,'utf-8')}}...</a>
                                <em>{{$quanbu->price}}元</em>
                            </div>
                        </div>
                 @endforeach
                    <!-- 一条评论结束-->    
            
                    
                    </div>
                <!--好评-->
                	<div class="smallcake d-2-1">
                    <!--一条评论开始-->
                    @foreach($appraise as $haoping)
                    @if($haoping->gscore>=4)
                    	<div class="thepcpls">
                        <!--左-->
                        	<div class="zuileftop">
                            	<!--改变星级只需要改" no-repeat X 0"里面的X即可，一次是17像素-->
                            	<div class="thstar" style=" background:url(/home/img/commentsListIcons1.png) no-repeat 
                            	@if($haoping->gscore==5)
                            	0
                            	@elseif($haoping->gscore==4)
                            	-17px
					@endif	
                            	 0"></div>
                                <div class="shdltpl">收货1天后评论</div>
                                <div class="shdplsj">{{$haoping->addtime}}</div>
                            </div>
                        <!--中-->
                        	<div class="zuicenterop">
                            	{{$haoping->content}}
                            </div>
                        <!--右-->
                        	<div class="zuirightop">
                            	<div class="touxadmz">
                                	<b>
                                    	<img src="/home/img/touxiang.png"/>
                                    </b>
                                    <em>{{mb_substr($haoping->phone,0,2,'utf-8')}}******{{mb_substr($haoping->phone,-2,2,'utf-8')}}</em>
                                </div>
                                <div class="zgrsndra">山东</div>
                            </div>
                            <!--购买的商品信息-->
                            <div class="gmdspxinxisz">
                                <a href="/homegoods/{{$haoping->goods_id}}">{{mb_substr($haoping->gname,0,30,'utf-8')}}...</a>
                                <em>{{$haoping->price}}元</em>
                            </div>
                        </div>
                    @endif   
                    @endforeach    
                    <!-- 一条评论结束-->
                   
                    </div>
                <!--中评-->
                	<div class="smallcake d-3-1">
                    <!--一条评论开始-->
                    @foreach($appraise as $zhongping)
                    @if($zhongping->gscore==3)
                    	<div class="thepcpls">
                        <!--左-->
                        	<div class="zuileftop">
                            	<!--改变星级只需要改" no-repeat X 0"里面的X即可，一次是17像素-->
                            	<div class="thstar" style=" background:url(/home/img/commentsListIcons1.png) no-repeat -34px 0"></div>
                                <div class="shdltpl">收货1天后评论</div>
                                <div class="shdplsj">{{$zhongping->addtime}}</div>
                            </div>
                        <!--中-->
                        	<div class="zuicenterop">
                            	{{$zhongping->content}}
                            </div>
                        <!--右-->
                        	<div class="zuirightop">
                            	<div class="touxadmz">
                                	<b>
                                    	<img src="/home/img/touxiang.png"/>
                                    </b>
                                    <em>{{mb_substr($zhongping->phone,0,2,'utf-8')}}******{{mb_substr($zhongping->phone,-2,2,'utf-8')}}</em>
                                </div>
                                <div class="zgrsndra">山东</div>
                            </div>
                            <!--购买的商品信息-->
                            <div class="gmdspxinxisz">
                                <a href="/homegoods/{{$zhongping->goods_id}}">{{mb_substr($zhongping->gname,0,30,'utf-8')}}...</a>
                                <em>{{$zhongping->price}}元</em>
                            </div>
                        </div>
                   @endif    
                   @endforeach
                    <!-- 一条评论结束-->
                  
                    </div>
                <!--差评-->
                	<div class="smallcake d-4-1">
                    <!--一条评论开始-->
                    @foreach($appraise as $chaping)
                     @if($chaping->gscore<3)
                    	<div class="thepcpls">
                        <!--左-->
                        	<div class="zuileftop">
                            	<!--改变星级只需要改" no-repeat X 0"里面的X即可，一次是17像素-->
                            	<div class="thstar" style=" background:url(/home/img/commentsListIcons1.png) no-repeat 
                            	@if($chaping->gscore==2)
                            	-51px
                            	@elseif($chaping->gscore==1)
                            	-68px
					@endif	
                            	 0"></div>
                                <div class="shdltpl">收货1天后评论</div>
                                <div class="shdplsj">{{$chaping->addtime}}</div>
                            </div>
                        <!--中-->
                        	<div class="zuicenterop">
                            	{{$chaping->content}}
                            </div>
                        <!--右-->
                        	<div class="zuirightop">
                            	<div class="touxadmz">
                                	<b>
                                    	<img src="/home/img/touxiang.png"/>
                                    </b>
                                    <em>{{mb_substr($chaping->phone,0,2,'utf-8')}}******{{mb_substr($chaping->phone,-2,2,'utf-8')}}</em>
                                </div>
                                <div class="zgrsndra">山东</div>
                            </div>
                            <!--购买的商品信息-->
                            <div class="gmdspxinxisz">
                                <a href="/homegoods/{{$chaping->goods_id}}">{{mb_substr($chaping->gname,0,30,'utf-8')}}...</a>
                                <em>{{$chaping->price}}元</em>
                            </div>
                        </div>
                      @endif
                      @endforeach  
                    <!-- 一条评论结束-->
                   
                    </div>
                <!--差评结束-->
                </div>
            </div>    
        </div> 
        <script>
		/*控制商品详情、商品评价、售后保障的出现或消失*/
			$(function(){
					$(".threespa ul li").mouseenter(function(){
					var frs=$(this).attr("mt-floors");
					var cats=$(this).attr("mt-cts");
					$(".c-"+frs+"-"+cats+"").show().siblings().hide();
					})
					/*这个有点特殊*/
					$("#spencals1").mouseenter(function(){
						$(".c-1-1").show();
						$(".c-2-1").show();
						$(".c-3-1").show();
						})
					/*$("#spencals2").mouseenter(function(){
						$(".c-2-1").show();
						$(".c-3-1").show();
						})*/
					$("#spencals3").mouseenter(function(){
						$(".c-3-1").show();
						$(".c-2-1").show();
						})		
						
		/*控制全部评论、好评、中评、差评的块的出现或消失*/
					$(".quanbupinglun a").click(function(){
					var frd=$(this).attr("mt-floord");
					var catd=$(this).attr("mt-ctd");
					$(".d-"+frd+"-"+catd+"").show().siblings().hide();
					})
				})
        </script>
        <!--这里一切测试正常，现在我去掉容器里面各个div的颜色-->
    </div>   
</div>
</body>
</html>	
@endsection       