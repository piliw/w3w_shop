<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>小米账号--注册</title>
	<link href="/home/css/registestyle.css" rel="stylesheet">
	<script type="text/javascript" src="/home/jquery-1.7.2.min.js"></script> 
</head>
<body>
	<div class="main-container">
		<!-- 设置顶部logo -->
		<div class="title_big30">选择物流公司</div>
		<div class="input-container">
			<div class="tit-normal"></div>
			<form method="post" action="/order">
				<div class="tits-box">
				<select name="send_code" id="tits-select" class="sare">
					<option value=''>--请选择--</option>
					<option value="sf">顺丰快递</option>
					<option value="sto">申通快递</option>
					<option value="yd">韵达快递</option>
					<option value="yt">圆通快递</option>
					<option value="tt">天天快递</option>
				</select>
				<font style="font-size:12px;color:red"></font>
				<script>
					$('.sare').on('change',function(){
						var area=$(this).find(':selected').html();
						$('.sare').next().html('');
						$('#send_area').val(area);
					});
				</script>
				<input type="hidden" name="send_area" value="" id="send_area">
				</div>
				<div class="tits-notice"></div>

				<div class="tit-normal">确认订单编号:</div>
				<div class="phone-box">
				<div class="phone-number fl">
					<input type="text" name="o_number" class="num-input" value="{{$info->o_number}}" disabled>
				</div>
				</div>

				<div class="tit-normal">
					填写物流单号:
				</div>
				<div class="phone-box">
					<div class="phone-number fl">
						<input type="text" name="send_number" class="num-input" id="ecode">
					</div>
					<font style="font-size:12px;color:red"></font>
				</div>
				
				<input type="hidden" name="id" value="{{$info->id}}">
				{{csrf_field()}}
				<div class="submit-btn">
					<input type="submit" value="确认发货" id="submitButton" onclick="return exp()">
				</div>
			</form>
		</div>
	</div>
</body>

<script>
 	function exp(){
 		if($('.sare').val()==''){
 			$('.sare').next().html('请选择物流公司');
 			return false;
 		}else if($('#ecode').val()==''){
 			$('#ecode').parent().next().html('请输入物流单号');
 			return false;
 		}else{
 			return true;
 		}
 	}
</script>
</html>