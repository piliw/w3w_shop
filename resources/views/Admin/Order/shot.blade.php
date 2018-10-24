<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="stylesheet" type="text/css" href="/static/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/static/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/static/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/static/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/static/static/h-ui.admin/css/style.css" />
<title>用户管理</title>
</head>
<body>
<nav class="breadcrumb"> 订单详情 <span class="c-gray en">&gt;</span> 订单商品 :</nav>
<div class="pd-20">
  <table class="table table-border table-bordered table-hover table-bg table-sort">
    <thead>
      <tr class="text-c">
        
        <th width="50">ID</th>
        <th width="200">商品</th>
        <th width="200">商品名</th>
        <th width="50">尺码</th>
        <th width="50">数量</th>
        <th width="100">单价</th>
        <th width="100">合计</th>
        <th width="70">状态</th>
      </tr>
    </thead>
    <tbody>
		@foreach($data as $key=>$row)
		 <tr class="text-c">
		    <td>{{$row->gid}}</td>
		    <td><img src="{{$row->p_url}}" height="100px"></td>
		    <td>{{$row->name}}</td>
		    <td>{{$row->size}}</td>
		    <td>x{{$row->g_number}}</td>
		    <td>{{$row->price}}</td>
		    <td>{{$row->g_total}}</td>
		    @if($row->status==1)
		    <td class="user-status"><span class="label label-success">已上架</span></td>
		    @elseif($row->status==0)
		    <td class="user-status"><span class="label label-danger">已下架</span></td>
		    @endif
		 </tr>
		@endforeach
    </tbody>
  </table>
</div>
</body>
</html>
