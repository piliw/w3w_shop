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
<link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
<script src="/bootstrap/js/jquery.min.js"></script>
<script src="/bootstrap/js/bootstrap.min.js"></script>
<script src="/bootstrap/js/holder.min.js"></script>

<!--[if IE 6]>
<script type="text/javascript" src="/static/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>用户详情</title>
<meta name="keywords" content="H-ui.admin v3.1,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
<meta name="description" content="H-ui.admin v3.1，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
</head>
<body>
@if(empty($data))
暂无数据...
@else
<article class="page-container">
  <table class="table table-striped">
  <tr><td>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3">ID:</label>
		<div class="formControls col-xs-8 col-sm-9">
			{{$data->id}}
		</div>
	</div>
  </td></tr>
  <tr><td>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3">用户id:</label>
		<div class="formControls col-xs-8 col-sm-9">
			{{$data->user_id}}
		</div>
	</div>
  </td></tr>
  <tr><td>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3">用户名:</label>
		<div class="formControls col-xs-8 col-sm-9">
			{{$data->nickname}}
		</div>
	</div>
  </td></tr>
  <tr><td>
  <div class="row cl">
    <label class="form-label col-xs-4 col-sm-3">头像:</label>
    <div class="formControls col-xs-8 col-sm-9">
      <img src="{{$data->user_pic}}" alt="" width="200" height="100" class="img-rounded">
    </div>
  </div>
  </td></tr>
  <tr><td>
	<div class="row cl">
    <label class="form-label col-xs-4 col-sm-3">性别:</label>
    <div class="formControls col-xs-8 col-sm-9">
      {{$data->sex}}
    </div>
  </div>
  </td></tr>
  <tr><td>
  <div class="row cl">
    <label class="form-label col-xs-4 col-sm-3">生日日期:</label>
    <div class="formControls col-xs-8 col-sm-9">
      {{$data->birthday}}
    </div>
  </div>
  </td></tr>
  <tr><td>
  <div class="row cl">
    <label class="form-label col-xs-4 col-sm-3">邮箱:</label>
    <div class="formControls col-xs-8 col-sm-9">
      {{$data->email}}
    </div>
  </div>
  </td></tr>
  <tr><td>
  <div class="row cl">
    <label class="form-label col-xs-4 col-sm-3">电话:</label>
    <div class="formControls col-xs-8 col-sm-9">
      {{$data->phones}}
    </div>
  </div>
  </td></tr>
  <tr><td>
  <div class="row cl">
    <label class="form-label col-xs-4 col-sm-3">学历:</label>
    <div class="formControls col-xs-8 col-sm-9">
      {{$data->edu}}
    </div>
  </div>
  </td></tr>
  <tr><td>
  <div class="row cl">
    <label class="form-label col-xs-4 col-sm-3">居住地:</label>
    <div class="formControls col-xs-8 col-sm-9">
      {{$data->u_addr}}
    </div>
  </div>
  </td>
  </tr>
  </table>
</article>
@endif
</body>
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
</html>