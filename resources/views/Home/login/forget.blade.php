<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>唯尚衣族--找回密码</title>
	<link href="/home/zhuce/registestyle.css" rel="stylesheet">
</head>
<body>
	<div class="main-container">
		<!-- 设置顶部logo -->
		<div class="logo-container">
			<div class="milogo"></div>
		</div>
		<div class="title_big30">找回唯尚衣族密码</div>
		<div class="input-container" style="margin-top:20px;">
			<form action="/doforget" method="post">
				<div class="tit-normal">邮箱</div>
				<div style="margin-left:227px">
					<input type="text" name="email" class="num-input" placeholder="请输入邮箱">
					<p style="font-size:15px;margin-top:5px"><i style="color:red">*</i>注册时使用的邮箱</p>
				</div>
				{{csrf_field()}}
				<div class="submit-btn" style="margin-top:30px">
					<input type="submit" value="找回密码" id="submitButton">
				</div>
				</div>
			</form>
			<!-- 错误信息提示 -->
			@if(Session::has('error'))
		    <script>alert("{{Session::get('error')}}")</script>
		  @endif
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
	<div class="intro-bottom">小米公司版权所有-京ICP备10046444-<img src="/home/zhuce/images/ghs.png" alt="">京公网安备11010802020134号-京ICP证110507号</div>
</body>
</html>