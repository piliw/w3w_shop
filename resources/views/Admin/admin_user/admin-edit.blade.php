<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="http://libs.useso.com/js/html5shiv/3.7/html5shiv.min.js"></script>
<script type="text/javascript" src="http://libs.useso.com/js/respond.js/1.4.2/respond.min.js"></script>
<script type="text/javascript" src="http://cdn.bootcss.com/css3pie/2.0beta1/PIE_IE678.js"></script>
<![endif]-->
<link type="text/css" rel="stylesheet" href="/static/static/h-ui/css/H-ui.css"/>
<link type="text/css" rel="stylesheet" href="/static/static/h-ui.admin/css/H-ui.admin.css"/>
<link type="text/css" rel="stylesheet" href="font/font-awesome.min.css"/>
<link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
<script src="/bootstrap/js/jquery.min.js"></script>
<script src="/bootstrap/js/bootstrap.min.js"></script>
<script src="/bootstrap/js/holder.min.js"></script>
<!--[if IE 7]>
<link href="http://www.bootcss.com/p/font-awesome/assets/css/font-awesome-ie7.min.css" rel="stylesheet" type="text/css" />
<![endif]-->
<title>修改密码</title>
</head>
<body>
<div class="pd-20">
  <form class="Huiform" id="loginform" action="/adminuser/{{$pass->id}}" method="post">
    <table class="table table-border table-bordered table-bg">
      <thead>
        <tr>
          <th colspan="2">修改密码</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th class="text-r" width="30%">旧密码：</th>
          <td><input name="oldpassword" id="oldpassword" class="input-text" type="password" autocomplete="off" placeholder="密码" tabindex="1" required>
          <p></p> 
          </td>
        </tr>
        <tr>
          <th class="text-r">新密码：</th>
          <td><input name="password" id="newpassword" class="input-text" type="password" autocomplete="off" placeholder="设置密码" tabindex="2" required> 
          <p></p>
          </td>
        </tr>
        <tr>
          <th class="text-r">再次输入新密码：</th>
          <td><input name="newpassword2" id="newpassword2" class="input-text" type="password" autocomplete="off" placeholder="确认新密码" tabindex="3" datatype="*" recheck="newpassword" required> 
          <p></p>
          </td>
        </tr>
        <input type="hidden" name="id" value="{{$pass->id}}" id="id">
        <tr>
          <th></th>
          <td>
            <button type="submit" class="btn btn-success radius" id="admin-password-save" name="admin-password-save"><i class="icon-ok"></i> 确定</button>
          </td>
        </tr>
        {{csrf_field()}}
        {{method_field('PUT')}}
      </tbody>
    </table>
  </form>
</div>
<script type="text/javascript" src="http://cdn.bootcss.com/jquery/2.1.3/jquery.min.js"></script> 
<script type="text/javascript" src="js/Validform_v5.3.2_min.js"></script> 
<script type="text/javascript" src="layer/layer.min.js"></script> 
<script type="text/javascript" src="/static/static/h-ui/js/H-ui.js"></script> 
<script type="text/javascript" src="/static/static/h-ui.admin/js/H-ui.admin.js"></script> 
<script type="text/javascript">
$(".Huiform").Validform(); 
</script>
<script>
// var _hmt = _hmt || [];
// (function() {
//   var hm = document.createElement("script");
//   hm.src = "//hm.baidu.com/hm.js?080836300300be57b7f34f4b3e97d911";
//   var s = document.getElementsByTagName("script")[0]; 
//   s.parentNode.insertBefore(hm, s);
// })();
// var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
// document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F080836300300be57b7f34f4b3e97d911' type='text/javascript'%3E%3C/script%3E"));

// alert($);
var bool = false;

// 旧密码失去焦点验证事件  
$('#oldpassword').blur(function(){
  // 获取表单值隐藏域id值
  oldpassword = $(this).val();
  id = $('#id').val();
  $.get('/pass',{oldpassword:oldpassword,id:id},function(data){
    // alert(data);
      if(data == 2){
        $('#oldpassword').next('p').css("color",'red').css('fontSize','14px').html('输入的旧密码不正确');
        bool = false;
      }else{
        $('#oldpassword').next('p').html('');
        // 新密码失去焦点验证事件  
        $('#newpassword').blur(function(){
          var pass = $(this).val();
          var regPwd = /^\w{6,16}$/;
          if(pass == ''){
            $(this).next('p').css('color','red').css('fontSize','14px').html('密码不能为空');
            bool = false;
            // 正则匹配
          }else if(!regPwd.test(pass)){
            $(this).next('p').css('color','red').css('fontSize','14px').html("由英文字母和数字组成的6-16位字符");
            bool=false;
          }else{
            $(this).next('p').html('');
            // 重复密码框失去焦点事件
            $('#newpassword2').blur(function(){
              var passs = $(this).val();
              // 将第一个密码框的值赋值
              var regPwd2 = pass;
              // 判断是否相等
              if(passs!=(regPwd2)){
                    $(this).next('p').css("color",'red').css('fontSize','14px').html("两次输入密码不一致");
                    bool=false;
                  }else{
                    $(this).next("p").html("");
                    // 允许默认事件
                    bool=true;
                  }
            });
          }
        });
    }
  });
});

// 旧密码
// 提交按钮单击事件
$('#admin-password-save').click(function(){
  oldpassword = $('#oldpassword').val();
  if(oldpassword == ''){
    $('#oldpassword').next("p").css("color",'red').css('fontSize','14px').html("请输入旧密码");
  }
});


// 密码框
  $('#admin-password-save').click(function(){
    pwd = $("input[name='password']").val();
    if(pwd==''){
      $('#newpassword').next('p').css("color",'red').css('fontSize','14px').html("请输入密码");
    }
  });
  // 重复密码框
  $('#admin-password-save').click(function(){
    pwd = $("input[name='newpassword2']").val();
    if(pwd==''){
      $('#newpassword2').next('p').css("color",'red').css('fontSize','14px').html("请再次输入密码");
    }
  });

// 表单提交单击事件
$('#loginform').click(function(){
  return bool;
});


</script>
</body>
</html>