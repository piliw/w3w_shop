

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>商品管理</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="/layuiadmin/layui/css/layui.css" media="all">
  <link rel="stylesheet" href="/layuiadmin/style/admin.css" media="all">
</head>
<body>

  <div class="layui-card layadmin-header">
    <div class="layui-breadcrumb" lay-filter="breadcrumb">
      <a lay-href="">主页</a>
      <a><cite>组件</cite></a>
      <a><cite>数据表格</cite></a>
      <a><cite>数据操作</cite></a>
    </div>
  </div>
  
  <div class="layui-fluid">
    <div class="layui-row layui-col-space15">
      <div class="layui-col-md12">
        <div class="layui-card">
          <div class="layui-card-body">
            <div class="layui-btn-group test-table-operate-btn" style="margin-bottom: 10px;">
              <button class="layui-btn" data-type="getCheckUp">批量上架</button>
              <button class="layui-btn" data-type="getCheckDown">批量下架</button>
              <!-- <button class="layui-btn" data-type="getCheckLength">获取选中数目</button> -->
              <!-- <button class="layui-btn" data-type="isAll">验证是否全选</button> -->
            </div>
              搜索商品：
              <div class="layui-inline" style="margin-bottom:10px">
                <input class="layui-input" name="id" id="test-table-demoReload" autocomplete="off">
              </div>
              <button class="layui-btn search" data-type="reload" style="margin-bottom:10px">搜索</button>
            <table class="layui-hide" id="test-table-operate" lay-filter="test-table-operate"></table>
            
            <script type="text/html" id="test-table-operate-barDemo">
              <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">查看</a>
              <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
              <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
            </script>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="show_img" style="position:absolute;left:100px;top:100px">
  </div>
   
  <script src="/layuiadmin/layui/layui.js"></script>
  <script>
  layui.config({
    base: '/layuiadmin/', //静态资源所在路径
  }).extend({
    index: 'lib/index' //主入口模块
  }).use(['index', 'table'], function(){
    var table = layui.table
    ,admin = layui.admin;
  
    table.render({
      elem: '#test-table-operate'
      ,url: "/getgoods"
    
      ,height: 'full-90'
      ,cols: [[
        {type:'checkbox', fixed: 'left'}
        ,{field:'gid', width:80, title: 'ID', sort: true, fixed: 'left'}
        ,{field:'status', width:80, title: '状态', sort: true}
        ,{field:'p_url', width:150, title: '预览图',templet:function(d){
                 return '<img src="'+d.p_url+'" alt="点击查看大图" class="show_img" >';
        }}
        ,{field:'name', width:300, title: '商品名称'}
        ,{field:'cname', width:120, title: '所属分类'}
        ,{field:'number', width:120, title: '商品货号'}
        ,{field:'price', width:80, title: '单价'}
        ,{field:'store', width: 80, title: '库存',sort: true}
        ,{field:'sales', width:80, title: '销量', sort: true}
        ,{field:'bname', width:100, title: '品牌'}
        ,{field:'size', width:100, title: '尺码'}
        ,{field:'summ', width:300, title: '简介'}
        ,{width:178, align:'center', fixed: 'right', toolbar: '#test-table-operate-barDemo'}
      ]]
      ,page: true
    });

    //监听表格复选框选择
    table.on('checkbox(test-table-operate)', function(obj){
      console.log(obj)
    });
    //监听工具条
    table.on('tool(test-table-operate)', function(obj){
      var data = obj.data;
      if(obj.event === 'detail'){
        window.open('/homegoods/'+data.gid);
        // layer.msg('ID：'+ data.id + ' 的查看操作');
           /* layer.open({
              // title: '在线调试',  content: '可以填写任意的layer代码'
              title:'商品详情',
              type: 2, 
              content: '/homegoods/'+data.id
              });   */
      } else if(obj.event === 'del'){
        layer.confirm('真的删除行么', function(index){
            // 传送数据
          $.get('/goodsdel',{id:data.gid},function(data){
                if(data==1){
                   obj.del();
                    layer.close(index);
                }else{
                    layer.close(index);
                    layer.alert('删除失败');
                } 
          });
         
        });
      } else if(obj.event === 'edit'){
        // layer.alert('编辑行：<br>'+ JSON.stringify(data))
         window.location.href='/goodsinfo/'+data.gid+'/edit';
         // top.layui.index.openTabsPage('goodsinfo/'+data.gid+'/edit');
      }
    });
    
    var $ = layui.$, active = {
      getCheckUp: function(){ //获取选中数据
          var checkStatus = table.checkStatus('test-table-operate')
          ,data = checkStatus.data;
         
         // 当前页
         var page=$(".layui-laypage-skip").find("input").val();
         // 分页数目
         // var limit=$(".layui-laypage-limits").find("option:selected").val();
          if(data.length!=0){
              var str='';
              for(var i=0;i<data.length;i++){
                   str += data[i].gid+',';
              }
              $.post('/goodsup/1',{id:str},function(data){
                     if(data==1){
                           table.reload('test-table-operate', {
                                page: {
                                    curr: page //重新从当前页开始
                                }     
                           });
                    }
               });
          }else{
             layer.msg('请选择商品');
          }
      }
      , getCheckDown: function(){ //获取选中数据
        var checkStatus = table.checkStatus('test-table-operate')
        ,data = checkStatus.data;
        
        var page=$(".layui-laypage-skip").find("input").val();
          if(data.length!=0){
              var str='';
              for(var i=0;i<data.length;i++){
                   str += data[i].gid+',';
              }
              $.post('/goodsup/0',{id:str},function(data){
                     if(data==0){
                           table.reload('test-table-operate', {
                                page: {
                                    curr: page //重新从当前页开始
                                }     
                           });
                    }
               });
          }else{
             layer.msg('请选择商品');
          }

      }
      ,getCheckLength: function(){ //获取选中数目
        var checkStatus = table.checkStatus('test-table-operate')
        ,data = checkStatus.data;
        layer.msg('选中了：'+ data.length + ' 个');
      }
      ,isAll: function(){ //验证是否全选
        var checkStatus = table.checkStatus('test-table-operate');
        layer.msg(checkStatus.isAll ? '全选': '未全选')
      }
    };
    
    $('.test-table-operate-btn .layui-btn').on('click', function(){
      var type = $(this).data('type');
      active[type] ? active[type].call(this) : '';
    });

      $('.search').click(function(){
            var demoReload = $('#test-table-demoReload');
          //执行重载
          table.reload('test-table-operate', {
            page: {
              curr: 1 //重新从第 1 页开始
            }
            ,where: {
              key:demoReload.val()
            }
          });
      });

  });

  layui.use(['jquery'], function(){
      var $ = jQuery = layui.$;
      // 你可以在下面的 js 代码中使用你熟悉的 $, jQuery
       // 展示商品预览图
      $('body').on('mouseenter','.show_img',function(e){
              var x=e.clientX+50+'px';
              var y=e.clientY-50+'px';
              var img=$('<img src="'+$(this).attr('src')+'" alt="" width="200px"/>');
              $('#show_img').css({'left':x,'top':y}).show().append(img);
      });
    //关闭预览图
          $('body').on('mouseleave','.show_img',function(){
           $('#show_img').empty().hide();
      });
          //添加保护
          $.ajaxSetup({
           headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
          });
});
 
  </script>

</body>
</html>