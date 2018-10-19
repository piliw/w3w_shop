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
<link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
<script src="/bootstrap/js/jquery.min.js"></script>
<script src="/bootstrap/js/bootstrap.min.js"></script>
<script src="/bootstrap/js/holder.min.js"></script>
<!--[if lt IE 9]>
<script type="text/javascript" src="/static/lib/html5shiv.js"></script>
<script type="text/javascript" src="/static/lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/static/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/static/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/static/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/static/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/static/static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="/static/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>管理员列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 管理员管理 <span class="c-gray en">&gt;</span> 管理员列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<form action="/adminuser" method="get">
	<div class="text-c"> 
		<!-- 日期范围： -->
		<!-- <input type="text" onfocus="WdatePicker({ maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}' })" id="datemin" class="input-text Wdate" style="width:120px;">
		-
		<input type="text" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d' })" id="datemax" class="input-text Wdate" style="width:120px;"> -->
		登录名:
		<input type="text" class="input-text" style="width:250px" placeholder="输入管理员名称" id="sname" name="sname" value="{{$request['sname'] or ''}}">
		<button type="submit" class="btn btn-success" id="ssubmit" name=""><i class="Hui-iconfont">&#xe665;</i> 搜用户</button>
	</div>
	</form>
	<div class="cl pd-5 bg-1 bk-gray mt-20">
	 <span class="l">
<!-- 	 	<a href="javascript:void(0)" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> -->
	 	 <a href="javascript:;" onclick="admin_add('添加管理员','adminuser/create','800','500')" class="btn btn-primary radius" data-target="#mymodel" data-toggle="modal"><i class="Hui-iconfont">&#xe600;</i> 添加管理员</a></span>
	 	  <span class="r">共有数据：<strong>{{$count}}</strong> 条</span> 
	 </div>
	<table class="table table-border table-bordered table-bg" id="table">
		<thead>
			<tr>
				<th scope="col" colspan="9">管理员列表</th>
			</tr>
			<tr class="text-c">
				<th>ID</th>
				<th>登录名</th>
				<th>密码</th>
				<th>等级</th>
				<th>状态</th>
				<th>加入时间</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
		@foreach($data as $v)
			<tr class="text-c">
				<td>{{$v->id}}</td>
				<td>{{$v->username}}</td>
				<td>{{$v->password}}</td>
				<td>{{$v->level}}</td>
				<td>{{$v->status}}</td>
				<td>{{$v->addtime}}</td>
				<td class="td-manage">

				<a title="修改管理员等级" href="javascript:;" onclick="admin_edit('修改管理员等级','/adminuser/{{$v->id}}','1','300','300')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe630;</i></a> 

				<a style="text-decoration:none" onClick="admin_stop(this,'10001')" href="javascript:;" title="改变状态"><i class="Hui-iconfont status">&#xe631;</i></a>

				 <a title="修改密码" href="javascript:;" onclick="admin_edit('修改密码','/adminuser/{{$v->id}}/edit','1','800','500')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> 
			
				<a title="删除" href="javascript:;" class="ml-5 del" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	<div class="dataTables_paginate paging_full_numbers" id="pages">
		{{$data->appends($request)->render()}}
	</div>
</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/static/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/static/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/static/static/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="/static/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/static/lib/My97DatePicker/4.8/WdatePicker.js"></script> 
<script type="text/javascript" src="/static/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="/static/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
/*
	参数解释：
	title	标题
	url		请求的url
	id		需要操作的数据id
	w		弹出层宽度（缺省调默认值）
	h		弹出层高度（缺省调默认值）
*/
/*管理员-增加*/
function admin_add(title,url,w,h){
	layer_show(title,url,w,h);
}
// 管理员-ajax删除
$('.del').click(function(){
	id = $(this).parents('tr').find('td').html();
	// alert(id);
	s = $(this).parents('tr');
	c = confirm('确定删除吗?');
	if(c){
		$.get('/del',{id:id},function(data){
			// alert(data);
			if(data==1){
				// alert('删除成功');
				s.remove();
			}else{
				alert('删除失败');
			}
		});
	}
});

/*管理员-编辑*/
function admin_edit(title,url,id,w,h){
	layer_show(title,url,w,h);
}
// /*管理员-停用*/
// function admin_stop(obj,id){
// 	layer.confirm('确认要停用吗？',function(index){
// 		//此处请求后台程序，下方是成功后的前台处理……
		
// 		$(obj).parents("tr").find(".td-manage").prepend('<a onClick="admin_start(this,id)" href="javascript:;" title="启用" style="text-decoration:none"><i class="Hui-iconfont">&#xe615;</i></a>');
// 		$(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">已禁用</span>');
// 		$(obj).remove();
// 		layer.msg('已停用!',{icon: 5,time:1000});
// 	});
// }

// 管理员-启用
// function admin_start(obj,id){
// 	layer.confirm('确认要启用吗？',function(index){
// 		//此处请求后台程序，下方是成功后的前台处理……
		
		
// 		$(obj).parents("tr").find(".td-manage").prepend('<a onClick="admin_stop(this,id)" href="javascript:;" title="停用" style="text-decoration:none"><i class="Hui-iconfont">&#xe631;</i></a>');
// 		$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
// 		$(obj).remove();
// 		layer.msg('已启用!', {icon: 6,time:1000});
// 	});
// }

// 改变管理员状态
$('.status').click(function(){
	id = $(this).parents('tr').find('td').html();
	// alert(id);
	$.get('/status',{id:id},function(data){
		// alert(data);
		if(data == 0){
			// 跳转
			location.href="/adminuser";
		}else{
			location.href="/adminuser";
		}
	});
});

</script>
</body>
</html>