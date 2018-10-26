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
<title>添加管理员 - 管理员管理</title>
<meta name="keywords" content="H-ui.admin v3.1,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
<meta name="description" content="H-ui.admin v3.1，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
</head>
<body>
<article class="page-container">
	<form action="/adminuser" method="post" class="form form-horizontal" id="form-admin-add">
	<!-- member -->
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>管理员：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" value="" placeholder="" id="adminName" name="username">
			<p></p>
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>初始密码：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="password" class="input-text" autocomplete="off" value="" placeholder="密码" id="password" name="password">
			<p></p>
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>确认密码：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="password" class="input-text" autocomplete="off"  placeholder="确认新密码" id="password2" name="password2">
			<p></p>
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>是否激活：</label>
		<div class="formControls col-xs-8 col-sm-9 skin-minimal">
			<div class="radio-box">
				<input name="status" type="radio" id="sex-1" checked value="0">
				<label for="sex-1">激活</label>
			</div>
			<div class="radio-box">
				<input type="radio" id="sex-2" name="status" value="1">
				<label for="sex-2">不激活</label>
			</div>
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3">等级：</label>
		<div class="formControls col-xs-8 col-sm-9"> <span class="select-box" style="width:150px;">
			<select class="select" name="level" size="1">
				<option value="0">一级管理员</option>
				<option value="1">二级管理员</option>
				<option value="2">三级管理员</option>
				<option value="3">超级管理员</option>
			</select>
			</span> </div>
	</div>
	{{csrf_field()}}
	<div class="row cl">
		<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
			<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;" id="submit">
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
// alert($);

var bool = false;
// name框失去焦点事件
$('#adminName').blur(function(){
	// alert('2');
	// 获取账号信息
	var name = $(this).val();
	// alert(name);
	
	// ajax用户名验证
	$.get('/name',{name:name},function(data){
		// alert(data);
		if(data==1){
			$('#adminName').next('p').css('color','red').css('fontSize','14px').html('用户名已存在');
			// 阻止默认行为
			bool = false;
		}else{
			$('#adminName').next("p").html("");
		}
	});

	// 正则
	var regPwd = /^\w{3,12}$/;
	if(name == ''){
			// 给下一个元素赋值
			$(this).next('p').css('color','red').css('fontSize','14px').html('账号不能为空');
			// 阻止默认行为
			bool = false;
			// 匹配正则
		}else if(!regPwd.test(name)){
			$(this).next('p').css('color','red').css('fontSize','14px').html("由英文字母和数字组成的3-12位字符");
				bool=false;
		}else{
			// 给下一个元素赋值为空
			$(this).next('p').html('');
			// 密码框事件焦点事件
			$('#password').blur(function(){
				var pass = $(this).val();
				var regPwd = /^\w{6,16}$/;
				if(pass == ''){
					$(this).next('p').css('color','red').css('fontSize','14px').html('密码不能为空');
					bool = false;
					// 正则匹配
				}else if(!regPwd.test(pass)){
					$(this).next('p').css('color','red').css('fontSize','14px').html("由英文字母和数字组成的6-16位字符");
					bool=false;
				}else{
					$(this).next('p').html('');
					// 重复密码框失去焦点事件
					$('#password2').blur(function(){
						var passs = $(this).val();
						// 将第一个密码框的值赋值
						var regPwd2 = pass;
						// 判断是否相等
						if(passs!=(regPwd2)){
									$(this).next('p').css("color",'red').css('fontSize','14px').html("两次输入密码不一致");
									bool=false;
								}else{
									$(this).next("p").html("");
									// 允许默认事件
									bool=true;
								}
					});
				}
			});
		}
});

// 提交点击按钮检测
	// 用户名
	$('#submit').click(function(){
		p = $("input[name='username']").val();
		// alert(p);
		if(p==''){
			// alert('用户名');
			$('#adminName').next('p').css("color",'red').css('fontSize','14px').html("请输入账号");
		}
	});
	// 密码框
	$('#submit').click(function(){
		pwd = $("input[name='password']").val();
		if(pwd==''){
			$('#password').next('p').css("color",'red').css('fontSize','14px').html("请输入密码");
		}
	});
	// 重复密码框
	$('#submit').click(function(){
		pwd = $("input[name='password2']").val();
		if(pwd==''){
			$('#password2').next('p').css("color",'red').css('fontSize','14px').html("请再次输入密码");
		}
	});
	

$('#form-admin-add').click(function(){
	return bool;
});

</script> 
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>