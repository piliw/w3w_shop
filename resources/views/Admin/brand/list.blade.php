<html>
 <head> 
  <meta charset="utf-8" /> 
  <meta name="renderer" content="webkit|ie-comp|ie-stand" /> 
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /> 
  <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" /> 
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
  <!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]--> 
  <title>品牌管理</title> 
  <link rel="stylesheet" href="http://localhost/H-ui.admin/lib/layer/2.4/skin/layer.css" id="layui_layer_skinlayercss" style="" />
  <link href="static/lib/My97DatePicker/4.8/skin/WdatePicker.css" rel="stylesheet" type="text/css" />
 </head> 
 <body> 

  <div class="page-container"> 
   
   <div class="cl pd-5 bg-1 bk-gray mt-20"> 
    <span class="l"><a href="javascript:;" onclick="member_add('添加一个品牌','/brand/create','','510')" class="btn btn-primary radius"><i class="Hui-iconfont"></i> 添加一个品牌</a></span> 
   </div> 
   <div class="mt-20"> 
    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
     <table class="table table-border table-bordered table-hover table-bg table-sort dataTable no-footer" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info"> 
      <thead> 
       <tr class="text-c" role="row">
        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 40px;" aria-label="ID: 升序排列" width="40">ID</th>
        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 60px;" aria-label="图片名: 升序排列" width="100">品牌名</th>
        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 100px;" aria-label="图片名: 升序排列" width="100">品牌LOGO</th>
        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 140px;" aria-label="图片路径: 升序排列" width="140">品牌介绍</th>
        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 80px;" aria-label="添加时间: 升序排列" width="80">添加时间</th>
       
       <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 80px;" aria-label="下架时间: 升序排列" width="80">下架时间</th>  
        <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 40px;" aria-label="状态" width="40">状态</th>
        <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 40px;" aria-label="操作" width="40">操作</th>
       </tr> 
      </thead> 
      <tbody> 
      @foreach($data as $row)
       <tr class="text-c odd" role="row"> 
        <td>{{$row->id}}</td> 
        <td>{{$row->name}}</td> 
        <td><img src="{{$row->logo}}" alt="" width="80"></td> 
        <td>{{$row->content}}</td> 
        <td>{{$row->add_time}}</td> 
        <td>{{$row->ntime}}</td> 
        @if($row->status=='上架')
        <td class="td-status"><span class="label label-success radius">{{$row->status}}</span></td>
        @else
        <td class="td-status"><span class="label label-danger radius">{{$row->status}}</span></td>
        @endif
        <td class="td-manage">
         <!--  <a style="text-decoration:none" onclick="member_stop(this,'10001')" href="javascript:;" title="停用"><i class="Hui-iconfont"></i></a>  -->
          <a title="编辑" href="javascript:;" onclick="member_edit('编辑','/brand/{{$row->id}}/edit','4','','510')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont"></i></a> 
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
  <script type="text/javascript">
$(function(){
  $('.table-sort').dataTable({
    "aaSorting": [[ 1, "desc" ]],//默认第几个排序
    "bStateSave": true,//状态保存
    "aoColumnDefs": [
      //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
      {"orderable":false,"aTargets":[0,7]}// 制定列不参与排序
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
    $.get('/branddel',{id:id},function(data){
      // alert(data);
      if(data==1){
        tr.remove();
      }
    });
  }
});

</script> 
 </body>
</html>