<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>小米账号--注册</title>
	<link href="/home/css/registestyle.css" rel="stylesheet">
</head>
<body>
	<div class="main-container">
		<!-- 设置顶部logo -->
		<div class="title_big30">选择物流公司</div>
		<div class="input-container">
			<div class="tit-normal"></div>
			<form method="post" action="/order">
				<div class="tits-box">
				<select name="send_area" id="tits-select">
					<option>顺丰快递</option>
					<option>中通快递</option>
					<option>韵达快递</option>
					<option>圆通快递</option>
					<option>ENS快运</option>
					<option>菜鸟快递</option>
				</select>
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
						<input type="text" name="send_number" class="num-input">
					</div>
				</div>
				
				<input type="hidden" name="id" value="{{$info->id}}">
				{{csrf_field()}}
				<div class="submit-btn">
					<input type="submit" value="确认发货" id="submitButton">
				</div>
			</form>
		</div>
	</div>
</body>
</html>