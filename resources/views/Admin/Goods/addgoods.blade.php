

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>表单组合</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="/layuiadmin/layui/css/layui.css" media="all">
  <link rel="stylesheet" href="/layuiadmin/style/admin.css" media="all">
  <script type="text/javascript" charset="utf-8" src="/static/ueditor/ueditor.config.js"></script>
  <script type="text/javascript" charset="utf-8" src="/static/ueditor/ueditor.all.min.js"> </script>
  <script type="text/javascript" charset="utf-8" src="/static/ueditor/lang/zh-cn/zh-cn.js"></script>
  <script src="/jquery-1.7.2.min.js"></script>
</head>
<body>

  <div class="layui-fluid">
    <div class="layui-card">
      <div class="layui-card-body" style="padding: 15px;">
        <form class="layui-form" action="/goodsinfo" lay-filter="component-form-group" method="post">
          <div class="layui-form-item">
            <label class="layui-form-label">商品标题</label>
            <div class="layui-input-block">
              <input type="text" name="name" lay-verify="title|required" autocomplete="off" placeholder="请输入标题" class="layui-input" value="">
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">简介</label>
            <div class="layui-input-block">
              <input type="text" name="summ" placeholder="选填" autocomplete="off" class="layui-input">
            </div>
          </div>
          
          <div class="layui-form-item">
            <div class="layui-inline">
              <label class="layui-form-label">货号</label>
              <div class="layui-input-inline">
                <input type="tel" name="number" lay-verify="required|number" autocomplete="off" class="layui-input">
              </div>
            </div>
            <div class="layui-inline">
              <label class="layui-form-label">产地</label>
              <div class="layui-input-inline">
                <input type="text" name="origin" lay-verify="required" autocomplete="off" class="layui-input">
              </div> 
              <label class="layui-form-label">品牌</label>
               <div class="layui-input-inline">
                <select name="bid">
                  <option value="">--请选择--</option>
                  <optgroup label="选择品牌">
                  @foreach($brand as $v)
                    <option value="{{$v->id}}">{{$v->name}}</option>
                  @endforeach
                  </optgroup>
                </select>
              </div>
            </div>
          </div>
          
          <div class="layui-form-item">
            <div class="layui-inline">
              <label class="layui-form-label">单价</label>
              <div class="layui-input-inline">
                <input type="tel" name="price" lay-verify="required|number" autocomplete="off" class="layui-input">
              </div>
            </div>
            <div class="layui-inline">
              <label class="layui-form-label">尺寸</label>
              <div class="layui-input-inline">
                <input type="text" name="size" lay-verify="required" autocomplete="off" class="layui-input">
              </div> 
              <label class="layui-form-label">库存</label>
              <div class="layui-input-inline">
                <input type="text" name="store" lay-verify="required|number" autocomplete="off" class="layui-input">
              </div>
            </div>
          </div>

          <div class="layui-form-item">
            <label class="layui-form-label">选择分类</label>
            <div class="layui-input-block">
              <select name="cate_id" lay-filter="aihao">
                <option value=""></option>
                @foreach($cate as $val)
                <option value="{{$val->id}}">{{$val->name}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">商品状态</label>
            <div class="layui-input-block">
              <input type="checkbox" checked="" value="1" name="status" lay-skin="switch" lay-filter="component-form-switchTest" lay-text="上架|下架">
            </div>
            <!-- <input type="hidden" name="status" value="1" id="status"> -->
          </div>

            <!-- 图片上传 -->
             <div class="layui-col-md12">
        <div class="layui-card">
          <div class="layui-card-header">上传商品图片(默认第一张为主图)</div>
          <div class="layui-card-body">
            <div class="layui-upload">
              <button type="button" class="layui-btn" id="test-upload-more">上传图片</button> 
              <blockquote class="layui-elem-quote layui-quote-nm" style="margin-top: 10px;">
                预览图：
                <div class="layui-upload-list" id="test-upload-more-list"></div>
             </blockquote>
            </div>
          </div>
        </div>
      </div>

            <div id="img">
                <input type="hidden" name="pic[]" value="" lay-verify="img">
            </div>

          <!-- 详情编辑器 -->
           <div class="layui-form-item">
            <label class="layui-form-label">商品描述</label>
          </div>
           <script id="edit" name="descr" type="text/plain">
          </script>       
          <div class="layui-form-item layui-layout-admin">
            <div class="layui-input-block">
              <div class="layui-footer" style="left: 0;">
                <button class="layui-btn" lay-submit="" lay-filter="component-form-demo1">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
              </div>
            </div>
          </div>
          {{csrf_field()}}
        </form>
      </div>
    </div>
  </div>
  <script type="text/javascript">
  //实例化编辑器
  //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接
  // 调用UE.getEditor('editor')就能拿到相关的实例
  var ue = UE.getEditor('edit');
  </script>
    
  <script src="/layuiadmin/layui/layui.js"></script> 

  <script>
      $.ajaxSetup({
     headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     }
    });

  layui.config({
    base: '/layuiadmin/' //静态资源所在路径
  }).extend({
    index: 'lib/index' //主入口模块
  }).use(['index', 'form', 'laydate','upload'], function(){
    var $ = layui.$
    ,admin = layui.admin
    ,upload = layui.upload
    ,element = layui.element
    ,layer = layui.layer
    ,laydate = layui.laydate
    ,form = layui.form;
    
    form.render(null, 'component-form-group');

    laydate.render({
      elem: '#LAY-component-form-group-date'
    });
    
    /* 自定义验证规则 */
    form.verify({
      title: function(value){
        if(value.length < 5){
          return '标题至少得5个字符啊';
        }
      }
        ,img: function(value){
        if(value==""){
          return '请先上传商品图片';
        }
      }
      ,pass: [/(.+){6,12}$/, '密码必须6到12位']
      ,content: function(value){
        layedit.sync(editIndex);
      }
    });
  
    /* 监听提交 */
   /* form.on('submit(component-form-demo1)', function(data){
      parent.layer.alert(JSON.stringify(data.field), {
        title: '最终的提交信息'
      })
      return false;
    });*/

         // 商品图片
        upload.render({
          elem: '#test-upload-more'
          ,url: '/goodsupload'
          ,field:'pic'
          ,multiple: true
          ,before: function(obj){
            //预读本地文件示例，不支持ie8
            obj.preview(function(index, file, result){
              $('#test-upload-more-list').append('<img src="'+ result +'" alt="'+ file.name +'" class="layui-upload-img" height="100px">')
            });
          }
          ,done: function(res){
            //上传完毕
            if(res.code == 0){ //上传成功
              if($('#img').find('input:first').val()==""){
                   $('#img').find('input:first').val(res.ResultData);
              }else{
                  var img=$('<input type="hidden" name="pic[]" value='+res.ResultData+' />');
                  $('#img').append(img);
              }
            }
          }
        });

  });
  </script>
</body>
</html>
