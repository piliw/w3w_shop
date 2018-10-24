<html>
 <head> 
  <meta charset="utf-8" /> 
  <meta name="renderer" content="webkit|ie-comp|ie-stand" /> 
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /> 
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <meta http-equiv="Cache-Control" content="no-siteapp" /> 
  <!--[if lt IE 9]>
<script type="text/javascript" src="lib/html5shiv.js"></script>
<script type="text/javascript" src="lib/respond.min.js"></script>
<![endif]--> 
  <link rel="stylesheet" type="text/css" href="static/static/h-ui/css/H-ui.min.css" /> 
  <link rel="stylesheet" type="text/css" href="static/static/h-ui.admin/css/H-ui.admin.css" /> 
  <link rel="stylesheet" type="text/css" href="static/lib/Hui-iconfont/1.0.8/iconfont.css" /> 
  <link rel="stylesheet" type="text/css" href="static/static/h-ui.admin/skin/default/skin.css" id="skin" /> 
  <link rel="stylesheet" type="text/css" href="static/static/h-ui.admin/css/style.css" /> 
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="/layuiadmin/layui/css/layui.css" media="all">
  <link rel="stylesheet" href="/layuiadmin/style/admin.css" media="all">
  <!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]--> 
  <title>友情链接管理</title> 
  <link rel="stylesheet" href="http://localhost/H-ui.admin/lib/layer/2.4/skin/layer.css" id="layui_layer_skinlayercss" style="" />
  <link href="static/lib/My97DatePicker/4.8/skin/WdatePicker.css" rel="stylesheet" type="text/css" />
 </head> 
 <body> 

  <div class="page-container"> 
   
   <div class="mt-20"> 
    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
     <table class="table table-border table-bordered table-hover table-bg table-sort dataTable no-footer" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info"> 
      <thead> 
       <tr class="text-c" role="row">
        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 20px;" aria-label="ID: 升序排列" width="20">ID</th>
        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 60px;" aria-label="图片名: 升序排列" width="100">网站名字</th>
        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 100px;" aria-label="图片名: 升序排列" width="100">网址</th>
        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 80px;" aria-label="添加时间: 升序排列" width="80">电子邮箱</th>
        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 80px;" aria-label="添加时间: 升序排列" width="80">网址介绍</th>
        <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 40px;" aria-label="状态" width="40">状态(点击更改)</th>
        <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 40px;" aria-label="操作" width="40">操作</th>
       </tr> 
      </thead> 
      <tbody> 
      @foreach($data as $r)
       <tr class="text-c odd" role="row"> 
        <td>{{$r->id}}</td> 
        <td>{{$r->name}}</td> 
        <td>{{$r->url}}</td>
        <td>{{$r->email}}</td>
        <td>{{$r->decr}}</td>
         @if($r->status=='审核通过')
        <td class="td-status">
          <a style="text-decoration:none" class="status" href="javascript:;" title="改变状态">
          <span class="label label-success radius">{{$r->status}}</span><a>
          </td>
        @else
        <td class="td-status">
          <a style="text-decoration:none" class="status" href="javascript:;" title="改变状态">
          <span class="label label-danger radius">{{$r->status}}</span></a>
          </td>
        @endif
        <td class="td-manage">
          <a title="删除" href="javascript:void(0);" class="ml-5 del" style="text-decoration:none"><i class="Hui-iconfont"></i></a>
        </td> 
       </tr>
      @endforeach
      </tbody> 
     </table>
     
    </div> 
   </div> 
  </div> 
  <!--_footer 作为公共模版分离出去--> 
  <script type="text/javascript" src="static/lib/jquery/1.9.1/jquery.min.js"></script> 
  <script type="text/javascript" src="static/lib/layer/2.4/layer.js"></script> 
  <script type="text/javascript" src="static/static/h-ui/js/H-ui.min.js"></script> 
  <script type="text/javascript" src="static/static/h-ui.admin/js/H-ui.admin.js"></script> 
  <!--/_footer 作为公共模版分离出去--> 
  <!--请在下方写此页面业务相关的脚本--> 
  <script type="text/javascript" src="static/lib/My97DatePicker/4.8/WdatePicker.js"></script> 
  <script type="text/javascript" src="static/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
  <script type="text/javascript" src="static/lib/laypage/1.2/laypage.js"></script> 
  <script src="/layuiadmin/layui/layui.js"></script> 
  <script type="text/javascript">
$(function(){
  $('.table-sort').dataTable({
    "aaSorting": [[ 1, "desc" ]],//默认第几个排序
    "bStateSave": true,//状态保存
    "aoColumnDefs": [
      //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
      {"orderable":false,"aTargets":[0,6]}// 制定列不参与排序
    ]
  });
  
});
/*用户-添加*/
function member_add(title,url,w,h){
  layer_show(title,url,w,h);
}
/*用户-查看*/
function member_show(title,url,id,w,h){
  layer_show(title,url,w,h);
}

/*用户-编辑*/
function member_edit(title,url,id,w,h){
  layer_show(title,url,w,h);
}
/*密码-修改*/
function change_password(title,url,id,w,h){
  layer_show(title,url,w,h);  
}
/*用户-删除*/
$('.del').click(function(){
  // alert(11);
  // 获取id
  id = $(this).parents('tr').find('td:first').html();
  // alert(id);
  tr = $(this).parents('tr');
  // alert(tr);
  tips = confirm('确定删除吗');
  if(tips){
    $.get('/linkdel',{id:id},function(data){
      // alert(data);
      if(data==1){
        tr.remove();
      }
    });
  }
});

// 改变管理员状态
$('.status').click(function(){
  id = $(this).parents('tr').find('td').html();
  // alert(id);
  $.get('/link_status',{id:id},function(data){
    // alert(data);
    if(data == 0){
      // 跳转
      location.href="/link";
    }else{
      location.href="/link";
    }
  });
});
</script> 
 </body>
</html>