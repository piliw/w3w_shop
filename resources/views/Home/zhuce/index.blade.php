<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>小米账号--注册</title>
	<link href="/home/zhuce/registestyle.css" rel="stylesheet">
	<script src="/home/zhuce/jquery-1.8.3.min.js"></script>
</head>
<body>
	<div class="main-container" style="height:700px;">
		<!-- 设置顶部logo -->
		<div class="logo-container">
			<div class="milogo"></div>
		</div>
		<div class="title_big30" style="margin-top:-30px">注册唯尚衣族帐号</div>
		<div class="input-container">
			<!-- 错误信息显示 -->
			@if(Session::has('zhuce'))
				 <div class="alert alert-info" style="color:red;font-size:15px;margin-left:90px;margin-top:30px" script>{{Session::get('zhuce')}}</div>
			@endif
			<div class="tit-normal">国家地区</div>
			<form action="/zhuce" method="post" id="form">
				<div class="tits-box">
				<select name="area" id="tits-select">
					<option value="中国" selected>中国</option>
					<option value="中国台湾">中国台湾</option>
					<option value="中国香港">中国香港</option>
					<option value="India">India</option>
					<option value="Malaysia">Malaysia</option>
					<option value="Japan">Japan</option>
				</select>
				</div>
				<div class="tits-notice">成功注册帐号后，国家/地区将不能被修改</div>
				
				<div class="phone-box">
				<!-- <div class="phone-select fl">
					<select name="nv" id="guojibianma">
						<option value="+86">+86</option>
						<option value="+886">+886</option>
						<option value="+852">+852</option>
						<option value="+55">+55</option>
						<option value="+91">+91</option>
					</select>
				</div> -->
				<div class="phone-number fl">
					<input type="text" name="phone" class="num-input" placeholder="请输入手机号码" id="phone"><p id="err_phone" style="font-size:12px"></p>
				</div>
				<div class="fr"style="margin-top:15px">
				<div class="tit-normal">输入验证码</div>
				<input type="text" name="code" id="code" placeholder="请输入验证码"><button class="fr" id="send">获取验证码</button><p id="err_code" style="font-size:12px"></p>		
				</div>
				<div class="fr">
				<input type="password" name="password" id="password" class="pass" placeholder="请输入密码"><p id="err_pass" style="font-size:12px"></p>
				</div>
				<div class="fr">
				<input type="password" name="repassword" id="repassword"  class="pass" placeholder="请输入确认密码"><p style="font-size:12px"></p>	
				</div>
				</div>
				<div class="fl" style="margin-left:227px">
					<input type="text" name="email" class="num-input" placeholder="请输入邮箱" id="email">
					<div class="tits-notice">我们将会对该邮箱发送邮件以便激活用户!</div>
				</div>
				{{csrf_field()}}
				<div class="submit-btn">
					<input type="submit" value="立即注册" id="submitButton">
				</div>
			</form>
			<div style="margin-top:270px;margin-left:175px">
				<input type="checkbox" checked="1">注册帐号即表示您同意并愿意遵守小米 <a href=""><b>用户协议</b></a>和 <a href=""><b>隐私政策</b></a>
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
	<div class="intro-bottom">小米公司版权所有-京ICP备10046444-<img src="/home/zhuce/images/ghs.png" alt="">京公网安备11010802020134号-京ICP证110507号</div>
</body>
<script>
// alert($);
	flag=false;
	// 验证手机号码
	$('#phone').blur(function(){
		// alert('1');
		p=$(this);
		// 获取里面的值
		phone=$(this).val();
		// alert(phone);
		// ajax账户验证
		$.get('/phone',{phone:phone},function(data){
			// alert(data);
			if(data == 1){
				$('#err_phone').css("color",'#f66').html("该账户已被注册!");
				flag=false;
			}else{
				$('#err_phone').html('');
			}
		});

		var regPhone = /^1[34578]\d{9}$/;
		if(phone==''||phone.trim()==''){
			$('#err_phone').css("color",'#f66').html("手机号不能为空");
			flag=false;
		}else if(!regPhone.test(phone)){
			$('#err_phone').css("color",'#f66').html("手机格式不正确,手机号由11位数字组成");
			flag=false;
		}else{
			// 手机号码正确
			$('#err_phone').css("color",'green').html("手机号可用");
			// 获取校验码点击按钮
			$('#send').click(function(){
				o=$(this);
				// alert(2);
				// 获取手机号
				p = $("input[name='phone']").val();
				// alert(p);
				$.get('/demo',{p:p},function(data){
					// alert(data.code);
					// 获取验证码之后
					//判断
					if(data.code==000000){
						//使按钮倒计时
						m=180;
						mytime=setInterval(function(){
							m--;
							//把m值赋值给按钮
							o.css('color','#888').html(m+"秒后可重新发送");
							//禁用按钮
							o.attr('disabled',true);
							if(m==0){
								//清除定时器
								clearInterval(mytime);
								//重新给按钮赋值
								o.html("重新发送");
								//激活按钮
								o.attr('disabled',false);
							}
						},1000);
					}
				},'json');
			});

		//校验码检测
		$("input[name='code']").blur(function(){
			//获取输入的校验码
			code=$(this).val();
			oo=$(this);

			// alert(code);
			//Ajax
			$.get("/code",{code:code},function(data){
				// alert(data);
				if(data==1){
					$("#err_code").css("color",'green').html("校验码正确");
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
				}else if(data==2){
					$("#err_code").css("color",'#f66').html("校验码有误");
					flag=false;
				}else if(data==3){
					$("#err_code").css("color",'#f66').html("校验码不能为空");
					flag=false;
				}else if(data==4){
					$("#err_code").css("color",'#f66').html("校验码已经过期,请重新发送");
					flag=false;
					}	
				});
			});
		}
	});
	// 提交点击按钮检测
	// 手机号码
	$('#submitButton').click(function(){
		p = $("input[name='phone']").val();
		// alert(p);
		if(p==''){
			// alert('请输入手机号');
			$('#err_phone').css("color",'#f66').html("请输入手机号码");
		}
	});
	// 密码框
	$('#submitButton').click(function(){
		pwd = $("input[name='password']").val();
		if(pwd==''){
			$('#err_pass').css("color",'#f66').html("请输入密码");
		}
	});
	// 验证码
	$('#submitButton').click(function(){
		code = $("input[name='code']").val();
		if(code==''){
			$('#err_code').css("color",'#f66').html("输入验证码");
		}
	});
	
	//表单提交事件
	$("#form").submit(function(){
		return flag;
	});

</script>
</html>