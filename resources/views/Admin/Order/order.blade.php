<!--_meta 作为公共模版分离出去-->
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="Bookmark" href="/favicon.ico" >
<link rel="Shortcut Icon" href="/favicon.ico" />
<!--[if lt IE 9]>
<script type="text/javascript" src="static/lib/html5shiv.js"></script>
<script type="text/javascript" src="static/lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="static/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="static/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="static/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="static/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="static/static/h-ui.admin/css/style.css" />
<!-- <link rel="stylesheet" href="css/addass.css"> -->
<!--[if IE 6]>
<script type="text/javascript" src="static/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<!--/meta 作为公共模版分离出去-->

<title>基本设置</title>
</head>
<body>
	<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页
		<span class="c-gray en">&gt;</span>
		订单管理
		<span class="c-gray en">&gt;</span>
		订单详情
		<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
	</nav>
	<div class="page-container">
		<form class="form form-horizontal" id="form-article-add">
			<div id="tab-system" class="HuiTab">
				<div class="tabBar cl">
					<span>全部订单</span>
					<span>等待买家付款</span>
					<span>等待发货</span>
					<span>已发货</span>
					<span>退款中</span>
					<span>成功的订单</span>
					<span>关闭的订单</span>
				</div>

				<!-- 全部订单开始 -->
				<div class="tabCon">
					<div class="page-container">
						<div class="text-c"> 日期范围：
							<input type="text" onfocus="WdatePicker({ maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}' })" id="datemin" class="input-text Wdate" style="width:120px;">
							-
							<input type="text" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d' })" id="datemax" class="input-text Wdate" style="width:120px;">
							<input type="text" class="input-text" style="width:250px" placeholder="" id="" name="">
							<button type="submit" class="btn btn-success" id="" name=""><i class="Hui-iconfont">&#xe665;</i>搜索订单</button>
						</div>
						<div class="mt-20">
							<table class="table table-border table-bordered table-hover table-bg table-sort art">
								<thead>
									<tr class="text-c">
										<th width="50">ID</th>
										<th width="50">用户ID</th>
										<th width="90">订单编号</th>
										<th width="70">收货人姓名</th>
										<th width="90">收货地址</th>
										<th width="70">订单金额</th>
										<th width="70">交易状态</th>
										<th width="90">下单时间</th>
										<th width="90">付款时间</th>
										<th width="60">操作</th>
									</tr>
								</thead>
								<tbody>
									@foreach($user as $row)
									<tr class="text-c">
										<td>{{$row->id}}</td>
										<td>{{$row->user_id}}</td>
										<td>{{$row->o_number}}</td>
										<td>{{$row->name}}</td>
										<td>{{$row->address}}</td>
										<td>{{$row->total}}</td>
										<td>
											@if($row->status==0)
												未付款
											@elseif($row->status == 1)
												已付款
												<a class="label label-danger cargo" attr="{{$row->id}}">去发货</a>
											@elseif($row->status == 2)
												待收货
												<a class="label label-primary send" dttr="{{$row->id}}">查看物流</a>
											@elseif($row->status == 3)
												已收货
											@else
											待评价
											@endif
										</td>
										<td>{{$row->addtime}}</td>
										<td>{{$row->paytime}}</td>
										<td class="f-14"><a class="btn btn-success test" attr="{{$row->id}}">详情</a></td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<!-- 全部订单结束 -->

				<!-- 等待买家付款开始 -->
				<div class="tabCon">
					<div class="page-container">
						<div class="text-c"> 日期范围：
							<input type="text" onfocus="WdatePicker({ maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}' })" id="datemin" class="input-text Wdate" style="width:120px;">
							-
							<input type="text" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d' })" id="datemax" class="input-text Wdate" style="width:120px;">
							<input type="text" class="input-text" style="width:250px" placeholder="" id="" name="">
							<button type="submit" class="btn btn-success" id="" name=""><i class="Hui-iconfont">&#xe665;</i>搜索订单</button>
						</div>
						<div class="mt-20">
							<table class="table table-border table-bordered table-hover table-bg table-sort art">
								<thead>
									<tr class="text-c">
										<th width="50">ID</th>
										<th width="50">用户ID</th>
										<th width="90">订单编号</th>
										<th width="70">收货人姓名</th>
										<th width="90">收货地址</th>
										<th width="70">订单金额</th>
										<th width="70">交易状态</th>
										<th width="90">下单时间</th>
										<th width="90">付款时间</th>
										<th width="60">操作</th>
									</tr>
								</thead>
								<tbody>
									@foreach($usera as $rowa)
									<tr class="text-c">
										<td>{{$rowa->id}}</td>
										<td>{{$rowa->user_id}}</td>
										<td>{{$rowa->o_number}}</td>
										<td>{{$rowa->name}}</td>
										<td>{{$rowa->address}}</td>
										<td>{{$rowa->total}}</td>
										<td>
											@if($rowa->status==0)
												未付款
											@endif
										</td>
										<td>{{$rowa->addtime}}</td>
										<td>{{$rowa->paytime}}</td>
										<td class="f-14"><a class="btn btn-success test" attr="{{$rowa->id}}">详情</a></td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<!-- 等待买家付款结束 -->

				<!-- 等待发货开始 -->
				<div class="tabCon">
					<div class="page-container">
						<div class="text-c"> 日期范围：
							<input type="text" onfocus="WdatePicker({ maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}' })" id="datemin" class="input-text Wdate" style="width:120px;">
							-
							<input type="text" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d' })" id="datemax" class="input-text Wdate" style="width:120px;">
							<input type="text" class="input-text" style="width:250px" placeholder="" id="" name="">
							<button type="submit" class="btn btn-success" id="" name=""><i class="Hui-iconfont">&#xe665;</i>搜索订单</button>
						</div>
						<div class="mt-20">
							<table class="table table-border table-bordered table-hover table-bg table-sort art">
								<thead>
									<tr class="text-c">
										<th width="50">ID</th>
										<th width="50">用户ID</th>
										<th width="90">订单编号</th>
										<th width="70">收货人姓名</th>
										<th width="90">收货地址</th>
										<th width="70">订单金额</th>
										<th width="70">交易状态</th>
										<th width="90">下单时间</th>
										<th width="90">付款时间</th>
										<th width="60">操作</th>
									</tr>
								</thead>
								<tbody>
									@foreach($userb as $rowb)
									<tr class="text-c">
										<td>{{$rowb->id}}</td>
										<td>{{$rowb->user_id}}</td>
										<td>{{$rowb->o_number}}</td>
										<td>{{$rowb->name}}</td>
										<td>{{$rowb->address}}</td>
										<td>{{$rowb->total}}</td>
										<td>
											@if($rowb->status == 1)
												已付款
												<a class="label label-danger cargo" attr="{{$rowb->id}}">去发货</a>
											@endif
										</td>
										<td>{{$rowb->addtime}}</td>
										<td>{{$rowb->paytime}}</td>
										<td class="f-14"><a class="btn btn-success test" attr="{{$rowb->id}}">详情</a></td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<!-- 等待发货结束 -->

				<!-- 已发货开始 -->
				<div class="tabCon">
					<div class="page-container">
						<div class="text-c"> 日期范围：
							<input type="text" onfocus="WdatePicker({ maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}' })" id="datemin" class="input-text Wdate" style="width:120px;">
							-
							<input type="text" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d' })" id="datemax" class="input-text Wdate" style="width:120px;">
							<input type="text" class="input-text" style="width:250px" placeholder="" id="" name="">
							<button type="submit" class="btn btn-success" id="" name=""><i class="Hui-iconfont">&#xe665;</i>搜索订单</button>
						</div>
						<div class="mt-20">
							<table class="table table-border table-bordered table-hover table-bg table-sort art">
								<thead>
									<tr class="text-c">
										<th width="50">ID</th>
										<th width="50">用户ID</th>
										<th width="90">订单编号</th>
										<th width="70">收货人姓名</th>
										<th width="90">收货地址</th>
										<th width="70">订单金额</th>
										<th width="70">交易状态</th>
										<th width="90">下单时间</th>
										<th width="90">付款时间</th>
										<th width="60">操作</th>
									</tr>
								</thead>
								<tbody>
									@foreach($userc as $rowc)
									<tr class="text-c">
										<td>{{$rowc->id}}</td>
										<td>{{$rowc->user_id}}</td>
										<td>{{$rowc->o_number}}</td>
										<td>{{$rowc->name}}</td>
										<td>{{$rowc->address}}</td>
										<td>{{$rowc->total}}</td>
										<td>
											@if($rowc->status==2)
												待收货
												<a class="label label-primary send" dttr="{{$rowc->id}}">查看物流</a>
											@endif
										</td>
										<td>{{$rowc->addtime}}</td>
										<td>{{$rowc->paytime}}</td>
										<td class="f-14"><a class="btn btn-success test" attr="{{$rowc->id}}">详情</a></td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<!-- 已发货结束 -->

				<!-- 退款中开始 -->
				<div class="tabCon">
					<div class="page-container">
						<div class="text-c"> 日期范围：
							<input type="text" onfocus="WdatePicker({ maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}' })" id="datemin" class="input-text Wdate" style="width:120px;">
							-
							<input type="text" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d' })" id="datemax" class="input-text Wdate" style="width:120px;">
							<input type="text" class="input-text" style="width:250px" placeholder="" id="" name="">
							<button type="submit" class="btn btn-success" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜记录</button>
						</div>
						<div class="mt-20">
							<table class="table table-border table-bordered table-hover table-bg table-sort">
								<thead>
									<tr class="text-c">
										<th width="80">ID</th>
										<th width="100">用户ID</th>
										<th width="90">订单编号</th>
										<th width="90">收货人姓名</th>
										<th width="90">收货地址</th>
										<th width="90">订单金额</th>
										<th width="90">交易状态</th>
										<th width="90">下单时间</th>
										<th width="90">付款时间</th>
										<th width="60">操作</th>
									</tr>
								</thead>
								<tbody>
									<tr class="text-c">
										<td>1</td>
										<td>23</td>
										<td>3sds5</td>
										<td>流行</td>
										<td>阿大似撒地方 所发生的懂非懂多数</td>
										<td>233</td>
										<td>已付款</td>
										<td>2018-10-10</td>
										<td>2018-10-10</td>
										<td class="f-14"><a title="详情" href="javascript:;">详情</a></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<!-- 退款中结束 -->

				<!-- 成功的订单开始 -->
				<div class="tabCon">
					<div class="page-container">
						<div class="text-c"> 日期范围：
							<input type="text" onfocus="WdatePicker({ maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}' })" id="datemin" class="input-text Wdate" style="width:120px;">
							-
							<input type="text" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d' })" id="datemax" class="input-text Wdate" style="width:120px;">
							<input type="text" class="input-text" style="width:250px" placeholder="" id="" name="">
							<button type="submit" class="btn btn-success" id="" name=""><i class="Hui-iconfont">&#xe665;</i>搜索订单</button>
						</div>
						<div class="mt-20">
							<table class="table table-border table-bordered table-hover table-bg table-sort art">
								<thead>
									<tr class="text-c">
										<th width="50">ID</th>
										<th width="50">用户ID</th>
										<th width="90">订单编号</th>
										<th width="70">收货人姓名</th>
										<th width="90">收货地址</th>
										<th width="70">订单金额</th>
										<th width="70">交易状态</th>
										<th width="90">下单时间</th>
										<th width="90">付款时间</th>
										<th width="60">操作</th>
									</tr>
								</thead>
								<tbody>
									@foreach($userd as $rowd)
									<tr class="text-c">
										<td>{{$rowd->id}}</td>
										<td>{{$rowd->user_id}}</td>
										<td>{{$rowd->o_number}}</td>
										<td>{{$rowd->name}}</td>
										<td>{{$rowd->address}}</td>
										<td>{{$rowd->total}}</td>
										<td>
											@if($rowd->status==3)
												待评价
											@endif
										</td>
										<td>{{$rowd->addtime}}</td>
										<td>{{$rowd->paytime}}</td>
										<td class="f-14"><a class="btn btn-success test" attr="{{$rowd->id}}">详情</a></td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<!-- 成功的订单结束 -->

				<!-- 关闭的订单开始 -->
				<div class="tabCon">
					<div class="page-container">
						<div class="text-c"> 日期范围：
							<input type="text" onfocus="WdatePicker({ maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}' })" id="datemin" class="input-text Wdate" style="width:120px;">
							-
							<input type="text" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d' })" id="datemax" class="input-text Wdate" style="width:120px;">
							<input type="text" class="input-text" style="width:250px" placeholder="" id="" name="">
							<button type="submit" class="btn btn-success" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜记录</button>
						</div>
						<div class="mt-20">
							<table class="table table-border table-bordered table-hover table-bg table-sort">
								<thead>
									<tr class="text-c">
										<th width="80">ID</th>
										<th width="100">用户ID</th>
										<th width="90">订单编号</th>
										<th width="90">收货人姓名</th>
										<th width="90">收货地址</th>
										<th width="90">订单金额</th>
										<th width="90">交易状态</th>
										<th width="90">下单时间</th>
										<th width="90">付款时间</th>
										<th width="60">操作</th>
									</tr>
								</thead>
								<tbody>
									<tr class="text-c">
										<td>1</td>
										<td>23</td>
										<td>3sds5</td>
										<td>流行</td>
										<td>阿大似撒地方 所发生的懂非懂多数</td>
										<td>233</td>
										<td>已付款</td>
										<td>2018-10-10</td>
										<td>2018-10-10</td>
										<td class="f-14"><a title="详情" href="javascript:;">详情</a></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<!-- 关闭的订单结束 -->

			</div>
		</form>
	</div>
	
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="static/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="static/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="static/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="static/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="static/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="static/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="static/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="static/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript" src="static/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>

<script type="text/javascript">
	$('.toubu li').click(function(){
		// alert(1);
		$(this).addClass('current').siblings().removeClass('current');
		$('.contents').children().eq($(this).index()).show().siblings().hide();
		// $(this).addClass('current').siblings().removeClass('current').parent().next().children().eq($(this).index()).show().siblings().hide();
	});
</script>

<script type="text/javascript">

$(function(){
	$('.table-sort').dataTable({
		"aaSorting": [[ 1, "desc" ]],//默认第几个排序
		"bStateSave": true,//状态保存
		"aoColumnDefs": [
		  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
		  {"orderable":false,"aTargets":[0,8,9]}// 制定列不参与排序
		]
	});	
});

$(function(){
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	$("#tab-system").Huitab({
		index:0
	});
});
</script>
<!--/请在上方写此页面业务相关的脚本-->
<script src="/layuiadmin/layui/layui.js"></script>
<script>
  layui.config({
    base: '/layuiadmin/' //静态资源所在路径
  }).extend({
    index: 'lib/index' //主入口模块
  }).use(['index'], function(){
    var $ = layui.$
    ,admin = layui.admin
    ,element = layui.element
    ,layer = layui.layer;

    element.render();
    
    /* 触发弹层 */
   // 订单详情
   $('.test').click(function(){
  	var id=$(this).attr('attr');
   	layer.open({
          type: 2
          ,content: '/order/'+id
          ,shadeClose: true
          , area: ['1000px', '500px']
          ,maxmin: true
        });
   });

   // 物流发货
   $('.cargo').click(function(){
   	// alert(1);
  	var id=$(this).attr('attr');
   	layer.open({
          type: 2
          ,content: '/order/create?id='+id
          ,shadeClose: true
          , area: ['1000px', '500px']
          ,maxmin: true
        });
   });

   // 查看物流
   $('.send').click(function(){
  	var id=$(this).attr('dttr');
  	// alert(id);
   	layer.open({
          type: 2
          ,content: 'http://www.baidu.com'
          ,shadeClose: true
          , area: ['1000px', '500px']
          ,maxmin: true
        });
   });
     
});

</script>  
</body>
</html>
