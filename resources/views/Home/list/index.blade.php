@extends('Home.Public.public')
@section('main')
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>@yield('title')</title>
<link rel="stylesheet" type="text/css" href="/home/css/top.css"/>
<link rel="stylesheet" type="text/css" href="/home/css/lunbo.css">
<link rel="stylesheet" type="text/css" href="/home/css/liebiao.css"/>
<link rel="stylesheet" type="text/css" href="/home/css/footer.css"/>
<script src="/home/js/jquery-1.8.3.min.js"></script>
<script src="/home/js/public.js"></script>
</head>

<body>
<!--顶部菜单有改动与首页的不一样，请单独调用-->
<!--属性栏筛选 -->
<div class="shaixuan">
	<!--品牌分类开始-->
    <div class="sxfenlei">
    	<div class="sxname">品牌</div>
        <div class="sxleibie">
        	<ul class="liebiaoyi_w">
        			@foreach($brand as $key=>$value)
        			@if($key<22)
            	<li class="ol"><a href=""><img src="{{$value->logo}}"/ width="88" height="35"><em>{{$value->name}}</em></a></li>  
            	@endif
            	@endforeach
            </ul>
            <span class="zdguanbi">更多/关闭</span>
            <ul class="liebiaoer_w">
            @foreach($brand as $value)
                <li><a href=""><img src="{{$value->logo}}"/ width="88" height="35"><em>{{$value->name}}</em></a></li>
            @endforeach          
            </ul>
        </div>
    </div>
    <!--品牌分类结束-->
	<div class="sxfenlei">
    	<div class="sxname">分类</div>
        <div class="sxleibie">
        	<ul class="liebiaoyi">
					@foreach($cate as $key=>$d)
						@if($key<30)
		        <li class="ll" name="{{$d->id}}"><a href="#">{{$d->name}}</a></li>
		        @endif
		      @endforeach
           </ul>
            <span class="zdguanbi">更多/关闭</span>
            <ul class="liebiaoer">
            	@foreach($cate as $d)
		        		<li class="ll" name="{{$d->id}}"><a href="#">{{$d->name}}</a></li>
		      		@endforeach
            </ul>
        </div>
    </div>
    
    <script>
		$(function(){//第一步都得写这个
	$(".zdguanbi").click(function(){//获取title，并且让他执行下面的函数
		$(this)/*点哪个就是哪个*/.next(".liebiaoer_w")/*哪个标题下面的con*/.slideToggle()
		
		})
	$(".zdguanbi").click(function(){//获取title，并且让他执行下面的函数
		$(this)/*点哪个就是哪个*/.next(".liebiaoer")/*哪个标题下面的con*/.slideToggle()
		
		})	
		
	
	})
    </script>
</div>
<!--分类搜索-->
<div class="zhxlxp">
	<span style=" background:#000; color:#fff; margin-left:0;">排序方式</span>
	<a href="#">综合</a>
    <a href="#" title="7天销量降序排列">销量</a>
    <a href="#" title="上架时间降序排列">新品</a>
    <a href="#" title="销售价格降序排列">价格</a>
</div>
<!--商品列表-->
<div class="shopliebiao">
	<ul class="goodslist">
        <!-- 判断是否为空 -->
         @if(count($goods)!=0)
				 @foreach($goods as $g)
    		<li>
           <a href="/homegoods/{{$g->gid}}" class="wocici">
               <b class="uid">
               <img src="{{$g->p_url}}"/>
               </b>
               <!-- overflow属性:超过会用...省略 -->
               <h2 style="overflow: hidden;text-overflow: ellipsis;white-space: nowrap;">{{$g->name}}</h2>
               <p style="overflow: hidden;text-overflow: ellipsis;white-space: nowrap;">{{$g->summ}}</p>
               <span>{{$g->price}}</span>
           </a>
           <em class="wocaca">
           	<a href="#">唯尚衣族自营店</a>
            <a href="#" style=" border-right:hidden">联系卖家</a>
           </em>
        </li>
        	@endforeach 
          @else
          <span style="color:blue;font-size:20px;">暂无商品,请查看其他商品...</span>
          @endif     
    </ul>
</div>
<!--猜你喜欢-->
<div class="zhxlxp"><span style=" background:#111; color:#fff; margin-left:0; padding-left:10px">猜你喜欢</span></div>
<div class="tuijiansp">
    <div class="shopliebiao">
        <ul>
        @foreach($goodss as $key=>$g)
        <!-- 限制条数 -->
        @if($key<5)
            <li>
           <a href="/homegoods/{{$g->gid}}" class="wocici">
               <b>
               <img src="{{$g->p_url}}"/>
               </b>
               <h2 style="overflow: hidden;text-overflow: ellipsis;white-space: nowrap;">{{$g->name}}</h2>
               <p style="overflow: hidden;text-overflow: ellipsis;white-space: nowrap;">{{$g->summ}}</p>
               <span>{{$g->price}}</span>
           </a>
           <em class="wocaca">
           	<a href="#">唯尚衣族自营店</a>
            <a href="#" style=" border-right:hidden">联系卖家</a>
           </em>
        </li>
        @endif
         @endforeach
        </ul>
    </div>
</div>    
<!--页脚-->
</body>
<script>
	// alert($);
	// 分类单击事件
	$('.ll').click(function(){
		id = $(this).attr('name');
		// alert(id);
		$.get('/list',{id:id},function(data){
			// console.log(data);
			var str = '';
			// 遍历  将代码整个插入div里
			for(var i=0;i<data.length;i++){
				str += '<li><a href="/homegoods/'+data[i]['gid']+'" class="wocici"><b><img src="'+data[i]['pp']+'"></b><h2 style="overflow: hidden;text-overflow: ellipsis;white-space: nowrap;">'+data[i]['gname']+'</h2><p style="overflow: hidden;text-overflow: ellipsis;white-space: nowrap;">'+data[i]['summ']+'</p><span>'+data[i]['price']+'</span></a><em class="wocaca"><a href="#">唯尚衣族自营店</a><a href="#" style="border-right:hidden">联系卖家</a></em></li>';
			}
      // 判断是否为空
      if(str != ''){
        // 不为空直接将字符串插入
			 $('.goodslist').html(str);
      }else{
        // 为空插入下面的字符串
        $('.goodslist').html('<span style="color:blue;font-size:20px;">暂无商品,请查看其他商品...</span>');
      }
		},'json');
	});
</script>
</html>
@endsection
@section("title",'列表页')
 
           
    
               
            
        
             
                
            
                    
        
            	
            
                  
          
 

    
    		
        