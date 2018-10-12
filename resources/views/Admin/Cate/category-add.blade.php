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
<link rel="stylesheet" type="text/css" href="static/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="static/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="static/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="static/static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>分类管理</title>
</head>
<body>
	<div class="col-8 col-offset-2" id="xuanze">
		<button class="btn btn-primary radius">&nbsp;&nbsp;添加分类&nbsp;&nbsp;</button>
		<button class="btn radius">&nbsp;&nbsp;修改分类&nbsp;&nbsp;</button>
		<button class="btn radius">&nbsp;&nbsp;删除分类&nbsp;&nbsp;</button>
	</div>
	<div>
		<div class="page-container">
			<form action="/category" method="post" class="form form-horizontal" id="form-cate">
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">
						<span class="c-red">*</span>
						分类名称：</label>
					<div class="formControls col-xs-6 col-sm-5">
						<input type="text" class="input-text" value="" placeholder="请输入分类名称" id="cate_name" name="name">
					</div>
					<font style="color:red"></font>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">是否展示：</label>
					<div class="formControls col-xs-6 col-sm-5">
						<span class="select-box" style="width:346px">
							<select class="select" name="display" size="1">
								<option value="1" selected>启用</option>
								<option value="0">禁用</option>
							</select>
					</span>
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">分类级别：</label>
					<div class="formControls col-xs-6 col-sm-5">
						<span class="select-box" style="width:346px">
							<select class="select" name="type" size="1" id="brandclass">
								<option value="0" selected >一级分类</option>
								<option value="1">二级分类</option>
								<option value="2">三级级分类</option>
							</select>
						</span>
					</div>
				</div>
				<div class="row cl" style="display:none">
					<label class="form-label col-xs-4 col-sm-2">父级分类：</label>
					<div class="formControls col-xs-6 col-sm-5">
						<span class="select-box" style="width:346px">
							<select class="select" name="pid" size="1" id="cate-parnet">
								<option selected>--请选择--</option>
							</select>
					</span>
					</div>
					<font style="color:red"></font>
				</div>
				<div class="row cl">
					<div class="col-9 col-offset-2">
						<input class="btn btn-success radius" type="submit" style="width:346px" value="&nbsp;&nbsp;添加&nbsp;&nbsp;">
					</div>
				</div>
				{{csrf_field()}}
			</form>
		</div>
		<div class="page-container" style="display:none">
			<form action="/cateupdate" method="post" class="form form-horizontal" id="cateupdate">
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">
						<span class="c-red">*</span>
						新的名称：</label>
					<div class="formControls col-xs-6 col-sm-5">
						<input type="text" class="input-text" value="" placeholder="" id="newname" name="name">
					</div>
					<font style="color:red"></font>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">是否展示：</label>
					<div class="formControls col-xs-6 col-sm-5">
						<span class="select-box" style="width:346px">
							<select class="select" name="display" size="1">
								<option value="1" id="sta" selected>启用</option>
								<option value="0">禁用</option>
							</select>
					</span>
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">选择分类：</label>
					<div class="formControls col-xs-6 col-sm-5">
						<span class="select-box" style="width:356px">
							<select class="select cateall" name="id" size="1" id="upselect">
								<option selected>--请选择要修改的分类--</option>
							</select>
						</span>
					</div>
					<font style="color:red"></font>
				</div>
				<div class="row cl">
					<div class="col-9 col-offset-2">
						<input class="btn btn-warning radius" type="submit" style="width:356px" value="&nbsp;&nbsp;修改&nbsp;&nbsp;">
					</div>
				</div>
				{{csrf_field()}}
			</form>
		</div>
		<div class="page-container" style="display:none">
			<form action="catedelete" method="get" class="form form-horizontal" id="">
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">
						<span class="c-red">*</span>
						分类名称：</label>
					<div class="formControls col-xs-6 col-sm-5">
						<input type="text" disabled class="input-text" value="" placeholder="" id="" name="product-category-name">
					</div>
				</div>
				<div></div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">选择分类：</label>
					<div class="formControls col-xs-6 col-sm-5">
						<span class="select-box" style="width:356px">
							<select class="select cateall" name="id" size="1">
								<option>--请选择要删除的分类--</option>
							</select>
					</span>
					</div>
				</div>
				<div class="row cl">
					<div class="col-9 col-offset-2">
						<input class="btn btn-danger radius" type="submit" style="width:356px" value="&nbsp;&nbsp;删除&nbsp;&nbsp;">
					</div>
				</div>
			</form>
		</div>
	</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="static/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="static/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="static/static/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="static/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="static/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="static/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="static/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript">
$(function(){
	
});

// 选项卡
$('#xuanze button').click(function(){
	$(this).addClass('btn-primary').siblings().removeClass('btn-primary').parent().next().children().eq($(this).index()).show().siblings().hide();
	if($(this).index != 0){
		$.get('/getcateall',function(data){
			$('.cateall').find('option:first').nextAll().remove();
			for(var i=0;i<data.length;i++){
				var op=$('<option value="'+data[i].id+'">'+data[i].name+'</option>');
				$('.cateall').append(op);
			}
			
		},'json')
	}
});

$('.cateall').change(function(){
	var ob=$(this);
	var id=$(this).val();
	$.get('/cateone',{id:id},function(data){
		if(data.display==1){
			$('#sta').prop('selected',true).next().prop('selected',false);
			// alert(ob.parents('.row').prev().find('option:first').attr('selected'));
		}else{
			$('#sta').prop('selected',false).next().prop('selected',true);
		}
		ob.parents('.row').prev().prev().find('input').val(data.name);
	},'json');
});

// 选择事件
$('#brandclass').change(function(){
	var o=$(this);
	o.parents('.row').next().find('option:first').nextAll().remove();
	if($(this).val()!=0){
		$(this).parents('.row').next().show();
		// 获取分类信息
		$.get('/getcate',{cate:$(this).val()},function(data){
			for(var i=0;i<data.length;i++){
				var op=$('<option value="'+data[i].id+'">'+data[i].name+'</option>');
				o.parents('.row').next().find('select').append(op);
			}
		},'json')
	}else{
		$(this).parents('.row').next().hide();
	}
});

// 添加分类表单验证
$('#form-cate').submit(function(e){
	if($('#brandclass').val() != 0){
		if($('#cate_name').val()==''){
		$('#cate_name').parent().next().html('分类名不能为空');
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