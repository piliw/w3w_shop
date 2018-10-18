<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>唯尚衣族--密码重置</title>
	<link href="/home/zhuce/registestyle.css" rel="stylesheet">
	<script src="/home/zhuce/jquery-1.8.3.min.js"></script>
</head>
<body>
	<div class="main-container" style="height:500px;">
		<!-- 设置顶部logo -->
		<div class="logo-container">
			<div class="milogo"></div>
		</div>
		<div class="title_big30" style="margin-top:-30px">重置唯尚衣族密码</div>
		<div class="input-container">
			<!-- 错误信息显示 -->
			@if(Session::has('zhuce'))
				 <!-- <div class="alert alert-info" style="color:red;font-size:15px;margin-left:90px;margin-top:30px" script>{{Session::get('zhuce')}}</div> -->
				 <script>alert("{{Session::get('zhuce')}}")</script>
			@endif
			<form action="doreset" method="post" id="form">
				<div style="margin-left:227px;margin-top:25px">
				<div>新密码:</div>
				<input type="password" name="password" id="password" class="pass" placeholder="请输入密码"><p id="err_pass" style="font-size:12px"></p>
				</div>
				<div style="margin-left:227px;margin-top:25px">
				<div>确认密码:</div>
				<input type="password" name="repassword" id="repassword"  class="pass" placeholder="请再次确认密码"><p style="font-size:12px"></p>	
				</div>
				</div>
				<input type="hidden" name="id" value="{{$id}}">
				{{csrf_field()}}
				<div class="submit-btn" style="margin-top:-150px;">
					<input type="submit" value="立即重置" id="submitButton">
				</div>
			</form>
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
<script>
// alert($);
	flag=false;
					// 验证密码
					$('#password').blur(function(){
						s=$(this);
						// 获取里面的值
						pwd=$(this).val();
						// alert(pwd);
						var regPwd = /^\w{6,12}$/;
						if(pwd==''){
							$('#err_pass').css("color",'#f66').html("密码不能为空");
							flag=false;
						}else if(!regPwd.test(pwd)){
							$('#err_pass').css("color",'#f66').html("由英文字母和数字组成的6-12位字符");
							flag=false;
						}else{
							$('#err_pass').html("");
							// 验证确认密码
							$('#repassword').blur(function(){
								re=$(this);
								// 获取里面的值
								pwd2=$(this).val();
								// alert(pwd);
								var regPwd2 = pwd;
								// alert(regPwd2);
								if(pwd2!=(regPwd2)){
									re.next("p").css("color",'#f66').html("两次输入密码不一致");
									flag=false;
								}else{
									re.next("p").html("");
									flag=true;
								}
							});
						}
					});
				
	// 提交点击按钮检测
	// 密码框
	$('#submitButton').click(function(){
		pwd = $("input[name='password']").val();
		if(pwd==''){
			$('#err_pass').css("color",'#f66').html("请输入密码");
		}
	});
	
	//表单提交事件
	$("#form").submit(function(){
		return flag;
	});

</script>
</html>