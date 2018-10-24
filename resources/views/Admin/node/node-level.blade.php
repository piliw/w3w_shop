<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
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
<title>分配角色</title>
<meta name="keywords" content="H-ui.admin v3.1,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
<meta name="description" content="H-ui.admin v3.1，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
</head>
<body>
					<!-- 错误信息显示 -->
          @if(Session::has('success'))
						<script>alert("{{Session::get('success')}}");</script>
          @endif
          <!-- 成功信息提示 -->
          @if(Session::has('error'))
						<script>alert("{{Session::get('error')}}");</script>
          @endif

<article class="page-container">
		<div class="row cl" style="margin-top:40px">
		<label class="form-label col-xs-4 col-sm-3"><span style="font-size:20px">当前管理员：</span></label>
		<div class="formControls col-xs-8 col-sm-9"> <span class="select-box" style="width:150px;">{{$adminuser->username}}</span></div>
		</div>
	<div class="row cl" style="margin-top:40px">
		<label class="form-label col-xs-4 col-sm-3"><span style="font-size:20px">当前角色：</span></label>
		<div class="formControls col-xs-8 col-sm-9"> <span class="select-box" style="width:150px;">
		@if(empty($data)) 未分配角色 @else {{$data->rid}} @endif
		</span></div>
		</div>
	<form action="/saverole" method="post" class="form form-horizontal" id="form-admin-add">
	<div class="row cl" style="margin-top:40px">
		<label class="form-label col-xs-4 col-sm-3"><span style="font-size:20px">角色：</span></label>
		<div class="formControls col-xs-8 col-sm-9"> <span class="select-box" style="width:150px;">
			<select class="select" name="rid" size="1">
			@if(empty($data))
				<option value="1">超级管理员</option>
				<option value="2">一级管理员</option>
				<option value="3">二级管理员</option>
				<option value="4">三级管理员</option>
			@else	
				<option value="1"
				@if($data->rid=='超级管理员')
				selected
				@endif
				>超级管理员</option>
				<option value="2"
				@if($data->rid=='一级管理员')
				selected
				@endif
				>一级管理员</option>
				<option value="3"
				@if($data->rid=='二级管理员')
				selected
				@endif
				>二级管理员</option>
				<option value="4" 
				@if($data->rid=='三级管理员')
				selected
				@endif
				>三级管理员</option>
			@endif
			</select>
		</span></div>
		</div>
		<input type="hidden" name='uid' value="{{$adminuser->id}}">
	{{csrf_field()}}
	<div class="row cl" style="margin-top:60px">
		<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
			<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;分配角色&nbsp;&nbsp;" id="submit">
		</div>
	</div>
	</form>
</article>

<!--_footer 作为公共模版分离出去--> 
<script type="text/javascript" src="/static/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/static/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/static/static/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="/static/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!-- 请在下方写此页面业务相关的脚本 -->
<script type="text/javascript" src="/static/lib/jquery.validation/1.14.0/jquery.validate.js"></script> 
<script type="text/javascript" src="/static/lib/jquery.validation/1.14.0/validate-methods.js"></script> 
<script type="text/javascript" src="/static/lib/jquery.validation/1.14.0/messages_zh.js"></script> 
<script type="text/javascript">
</script> 
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>