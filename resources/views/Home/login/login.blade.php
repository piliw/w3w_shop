<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<!-- <meta name="csrf-token" content="{{csrf_token()}}"> -->
	<script src="/home/jquery-1.7.2.min.js"></script>
	<link rel="stylesheet" href="/home/login/loginstyle.css">
	<title>小米账号登陆</title>
</head>
<body>
	<div class="header-box">
		<div class="mi-logo"></div>
	</div>
	<div class="body-box">
		<div class="mi-link">
			<div class="login-container">
			<!-- 设置登录界面 -->
				<div class="login-box">
					<div class="nav-tabs">
						<div class="navtabs-link">账号登陆</div>
						<div class="navtabs-link leftline">扫码登陆</div>
					</div>
					<!-- 账号输入框 -->
					<div class="login-input">
						<form action="/dologin1" method="post" id="submit">
						{{csrf_field()}}
							<div class="user-name">
								<input type="text" name="username" value="" placeholder="邮箱/手机号码/小米ID" id="name">
								<p style="margin-left:10px;padding-top:5px;"></p>
							</div>
							<div class="user-name ps-name" style="margin-top:30px">
								<input type="password" name="password" value="" placeholder="密码" id="pass">
								<p style="margin-left:10px;padding-top:5px;"></p>
							</div>

							<!-- 错误信息显示 -->
		          @if(Session::has('error'))
		            <div class="alert alert-info" style="color:red;font-size:15px;margin-left:90px;margin-top:30px" script>{{Session::get('error')}}</div> 
		          @endif

							<input class="login-submit" type="submit" value="登陆" style="margin-top:30px">
						</form>
						<!-- 其它登陆方式/注册 -->
						<div class="phone-paner">
							<span class="phone-paner-one"><a href="">手机短信登录/注册</a></span>
							<span class="other-registe"><a href="">立即注册</a></span>
							<span class="forget-pass">|</span>
							<span class="forget-pass"><a href="">忘记密码？</a></span>
							<!-- 其它登录方式 -->
						</div>
					</div>
					<div class="other-paner">
						<fieldset class="other-paner-set">
							<legend align="center">其他方式登录</legend>
						</fieldset>
					</div>
					<!-- 设置其它方式登陆图标 -->
					<div class="pic-box">
						<a class="qqpic" href=""></a>
						<a class="weibopic" href=""></a>
						<a class="alipaypic" href=""></a>
						<a class="weixinpic" href=""></a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- 设置底部 -->
	<div class="lang-select-list">
		<ul>
			<li><a href="">简体</a></li>
			<li class="left-xian">	<a href="">繁体</a></li>
			<li class="left-xian"><a href="">English</a></li>
			<li class="left-xian"><a href="">常见问题</a></li>
		</ul>
	</div>
	<div class="intro-bottom">小米公司版权所有-京ICP备10046444-<img src="/home/login/images/ghs.png" alt="">京公网安备11010802020134号-京ICP证110507号</div>

</body>
<script>
	// alert($);
	bool = false;
	// 用户名验证
	$('#name').blur(function(){
		// 获取表单信息
		var name = $('#name').val();
		if(name == ''){
			// alert('用户名不能为空');
			$(this).next('p').css('color','red').css('fontSize','14px').html('用户名不能为空');
			bool = false;
		}else{
			$(this).next('p').css('color','green').css('fontSize','14px').html('用户名格式符合要求');
			bool = true;
		}

		$.get('/ajax',{name:name},function(data){
			alert(data);
		});
	});

	// 密码验证
	$('#pass').blur(function(){
		var pass = $('#pass').val();
		if(pass == ''){
			$(this).next('p').css('color','red').css('fontSize','14px').html('密码不能为空');
			bool = false;
		}else{
			$(this).next('p').css('color','green').css('fontSize','14px').html('密码格式符合要求');
			bool = true;
		}
	});

	// 登录键单击事件
	$('#submit').click(function(){
			return bool;
	});
</script>
</html>