@extends('Home.Public.public')
@section('main')
	<link rel="stylesheet" href="/home/css/youqingcss.css">
	<link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
	<script src="/home/zhuce/jquery-1.8.3.min.js"></script>

	<div class="w">
		<div class="link_box">
			<div class="link_top"><div class="top_right"></div><div class="top_left"></div></div>	
			<div class="link_content">
				<h3 class="link_tit">友情链接</h3>
				<ul class="link_list">
						@foreach($data as $row)
						<li><a href="{{$row->url}}" target="_blank">{{$row->name}}</a></li>
						@endforeach
				</ul>
				<div class="Pagination">
							
				</div>
			</div>
				@if(Session::has('success'))
				<script>
				alert("{{Session::get('success')}}");
				</script>
				@endif
				@if(Session::has('error'))
				<script>
				alert("{{Session::get('error')}}");
				</script>
				@endif
			<div class="link_bottom"><div class="bottom_right"></div><div class="bottom_left"></div></div>
		</div>
		<div class="link_box_a">
			<div class="link_top">
				<div class="top_right"></div>
				<div class="top_left"></div>
			</div>
			<div class="link_content">
				<h3 class="link_tit">申请友情链接</h3>
				<ul class="link_step">
					<li class="link_step_tit">申请步骤：</li>
					<li>
						<div class="float_Left">
							1.</div>
						<div class="margin_l_12">
							请先在贵网站做好维尚衣族的文字友情链接：
							<br> 链接文字：维尚衣族链接地址：
							<a href="//www.w3w_shop.com" target="_blank">www.w3w_shop.com</a></div>
					</li>
					<li>2.做好链接后，请在右侧填写申请信息。维尚衣族只接受申请文字友情链接。</li>
					<li>
						<div class="float_Left"> 3.</div>
						<div class="margin_l_12">
							已经开通我站友情链接且内容健康，符合本站友情链接要求的网站，经维尚衣族管理员审核后，可以显示在此友情链接页面。</div>
					</li>
					<li>
						<div class="float_Left"> 4.</div>
						<div class="margin_l_12">
							请通过右侧提交申请，注明：友情链接申请。</div>
					</li>
				</ul>
				<form action="/link" method="post" id="frm_submit">
				<table class="link_table" width="309" cellspacing="0" cellpadding="0">
					<tbody><tr>
						<td colspan="2" class="link_step_tit" valign="top" height="29">
							申请信息</td>
					</tr>
					<tr>
						<td height="29">
							网站名称：
						</td>
						<td height="29">
							<input id="name" name="name" class="w247 required" type="text"> <span id="err_name" style="font-size:12px"></span>
						</td>
					</tr>
					<tr>
						<td height="29">
							网&nbsp;&nbsp;&nbsp;&nbsp;址：
						</td>
						<td height="29">
							<input id="url" name="url" class="w247 required" value="http://www." type="text"> <span id="err_url" style="font-size:14px"></span>
						</td>
					</tr>
					<tr>
						<td height="35">
							邮&nbsp;&nbsp;&nbsp;&nbsp;箱：
						</td>
						<td height="29">
							<input id="email" name="email" class="w247 required" type="text"> <span id="err_email" style="font-size:14px"></span>
						</td>
					</tr>
					<tr>
						<td width="81" valign="top" height="29">
							网站介绍：
						</td>
						<td width="348" valign="top">
							<textarea id="intro" name="decr" cols="" rows="" class="w247h60" style="width: 319px; height: 150px;"></textarea>
						</td>
					</tr>
					<tr>
					{{csrf_field()}}
						<td colspan="2" valign="middle" height="45" align="center">
							<button type="sumbit" id="btnSubmit" class="btn btn-info">提交申请</button>
						</td>
					</tr>
				</tbody></table>
				</form>
		
			</div>
			<div class="link_bottom">
				<div class="bottom_right"></div>
				<div class="bottom_left"></div>
			</div>
		</div>
	</div>
</body>
<script>
	function name_check(){
		n=$("input[name='name']").val();
		// alert(n);
		if(n==''){
			$('#err_name').css('color','#f00').html('请填写网站名称，长度在1-20位字符之间');
		return false;
		}else{
			$('#err_name').html('');
			return true;
		}
		return true;
	}
	function url_check(){
		url=$("#url").val();
		var urlReg = /^http:\/\/www\..+?(\.\w+){1,2}$/g;
 if(url.search(urlReg)==-1){
 		$('#err_url').css('color','#f00').html('网址格式不正确');
	 	return false;
	 }else{
	 	$('#err_url').css('color','#666').html('网址可用');
	 	return true;
	 }
	 	return true;
	}

	function email_check(){
	 	email=$("#email").val();
		var emailReg = /^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*\.[a-zA-Z0-9]{2,6}$/;
	if(email.search(emailReg)==-1){
	 	$('#err_email').css('color','#f00').html('邮箱格式不正确');
	 	return false;
	 }else{
	 	$('#err_email').css('color','#666').html('邮箱可用');
	 	 return true
	 }
	 	 return true
	}
	$("#name").blur(name_check);
 	$("#url").blur(url_check);
 	$("#email").blur(email_check);
 	function tijiao(){
 		if($('#name').val()=='' || $("#url").val()==''|| $("#email").val()=='' || $("#intro").val()==''){
 			alert('信息不能为空');
 			return false;
 		}

 		if(!url_check()){
 			$('#url_email').css('color','#f00').html('url格式不正确');
 			return false;
 		}else if(!email_check()){
			$('#err_email').css('color','#f00').html('邮箱格式不正确');
 			return false;
 		}else{
 			return true;
 		}
 		 return true;
 	}
  $('#frm_submit').submit(function(){
  	return tijiao();
  });
 //  
 //  
</script>
@endsection
@section('title','友情链接')