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
<link rel="stylesheet" type="text/css" href="/static/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/static/static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>分类信息表</title>
</head>
<body>
<div class="page-container">
			<a href="/categoryadd">
			<button type="button" class="btn btn-success" id="" name="" onClick="picture_colume_add(this);"><i class="Hui-iconfont">&#xe600;</i> 添加分类</button>
			</a>
		
	</div>
	<div class="mt-20">
		<table class="table table-border table-bordered table-bg table-sort">
			<thead>
				<tr class="text-c">
					<th width="70">ID</th>
					<th width="80">分类名称</th>
					<th width="200">LOGO</th>
					<th width="120">pid</th>
					<th width="120">状态</th>
					<th width="100">操作</th>
				</tr>
			</thead>
			<tbody>
				<tr class="text-c">
					<td>{{$cate->id}}</td>
					<td>{{$cate->name}}</td>
					<td><img src="{{$cate->curl}}" height="100px"></td>
					<td>{{$cate->pid}}</td>
					<td><button @if($cate->display=='启用')class="btn btn-success display"@else class="btn btn-danger display" @endif attr="{{$cate->id}}">{{$cate->display}}</button></td>
					<td class="f-14 product-brand-manage"><a style="text-decoration:none" class="edit" attr="{{$cate->id}}"href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a> <a style="text-decoration:none" class="ml-5" href="/catedelete?id={{$cate->id}}" onclick="return confirm('你确定要删除吗?');" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/static/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/static/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/static/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/static/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/static/lib/My97DatePicker/4.8/WdatePicker.js"></script> 
<script type="text/javascript" src="/static/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="/static/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
</script>

  <script src="/layuiadmin/layui/layui.js"></script>  
  <script>
  layui.config({
    base: '/layuiadmin/' //静态资源所在路径
  }).extend({
    index: 'lib/index' //主入口模块
  }).use(['index'], function(){
    var $ = layui.$
    ,admin = layui.admin
    ,element = layui.element
    ,layer = layui.layer;

    element.render();
    
    /* 触发弹层 */
    $('.edit').click(function(){
    	var id=$(this).attr('attr');
      	   layer.open({
          type: 2
          ,content: '/category/'+id+'/edit'
          ,shadeClose: true
          ,area:['800px', '350px']
          ,maxmin: true
          ,end: function(index, layero){ 
 		 location.reload();
  		// return false; 
		}    
        });
    });
 
 });
    </script>
    <script>
    $('.display').click(function(){
    	var id=$(this).attr('attr');
    	if($(this).html()=="启用"){
    		display=1;
    	}else{
    		display=0;
    	}
    	$.get('/catedisplay',{id:id,display:display},function(data){
    		if(data==1){
    			 $('.display').removeClass('btn-danger').addClass('btn-success').html('启用');
    		}else{
    			 $('.display').removeClass('btn-success').addClass('btn-danger').html('禁用');
    		}
    	});
    });

    </script>
</body>
</html>