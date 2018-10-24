<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="lib/html5shiv.js"></script>
<script type="text/javascript" src="lib/respond.min.js"></script>

<![endif]-->
<link rel="stylesheet" type="text/css" href="/static/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/static/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/static/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/static/static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>分类管理</title>
</head>
<body>
	<div class="col-8 col-offset-2" id="xuanze">
	</div>
	<div>
		<div class="page-container">
			<form action="/cateupdate" method="post" class="form form-horizontal" id="cateupdate" enctype="multipart/form-data">
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">
						<span class="c-red">*</span>
						新的名称：</label>
					<div class="formControls col-xs-6 col-sm-5">
						<input type="text" class="input-text" value="{{$cate->name}}" placeholder="" id="newname" name="name">
					</div>
					<font style="color:red"></font>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">是否展示：</label>
					<div class="formControls col-xs-6 col-sm-5">
						<span class="select-box" style="width:300px">
							<select class="select" name="display" size="1">
								<option value="1" id="sta" selected>启用</option>
								<option value="0">禁用</option>
							</select>
					</span>
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">原分类名：</label>
					<div class="formControls col-xs-6 col-sm-5">
						<span class="select-box" style="width:300px">
							<select class="select cateall" name="id" size="1" id="upselect" disabled>
								<option selected value="">{{$cate->name}}</option>
							</select>
							<input type="hidden" value="{{$cate->id}}" name="id">
						</span>
					</div>
					<font style="color:red"></font>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">
						<span class="c-red">*</span>
						上传图片：</label>
					<div class="formControls col-xs-6 col-sm-5">
						<input type="file" class="" value="" placeholder="" id="rpic" name="pic" enctype="multipart/data-form">
					</div>
					<font style="color:red"></font>
				</div>
				<div class="row cl">
					<div class="col-9 col-offset-2">
						<input class="btn btn-warning radius" type="submit" style="width:300px" value="&nbsp;&nbsp;修改&nbsp;&nbsp;">
					</div>
				</div>
				{{csrf_field()}}
			</form>
		</div>
	</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/static/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/static/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/static/static/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="/static/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/static/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="/static/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="/static/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript">

// 添加分类表单验证
$('#form-cate').submit(function(e){
	if($('#brandclass').val() != 0){
		if($('#cate_name').val()==''){
		$('#cate_name').parent().next().html('分类名不能为空');
		e.preventDefault()
		}
		if($('#cpic').val()==''){
		$('#cpic').parent().next().html('请上传图片');
		e.preventDefault()
		}

		if($('#cate-parnet').val()=='--请选择--'){
			$('#cate-parnet').parent().parent().next().html('请选择父级分类');
			e.preventDefault()
		}
	}else{
		if($('#cate_name').val()==''){
		$('#cate_name').parent().next().html('分类名不能为空');
		e.preventDefault()
		}
		if($('#cpic').val()==''){
		$('#cpic').parent().next().html('请上传图片');
		e.preventDefault()
		}
	}
});

$('#cateupdate').submit(function(e){
		if($('#newname').val()==''){
		$('#newname').parent().next().html('分类名不能为空');
		e.preventDefault()
		}

		if($('#upselect').val()=='--请选择要修改的分类--'){
			$('#upselect').parent().parent().next().html('请选择要修改的分类');
			e.preventDefault()
		}
});
</script>
</body>
</html>