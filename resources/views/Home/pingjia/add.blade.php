@extends('Home.Public.public')
@section('main') 
  <link rel="stylesheet" type="text/css" href="/home/js/statics/grade.css" /> 
  <link rel="stylesheet" type="text/css" href="/home/css/appraise.css" /> 
  <script src="/home/js/statics/jquery-latest.pack.js"></script> 
  <script src="/home/js/statics/grade.js"></script> 
  <!--个人中心首页 --> 
  <div class="thetoubu"> 
   <!--头部--> 
   <div class="thetoubu1"> 
    <b> <img src="{{$datas->user_pic}}" /> </b> 
    <em>{{$data->phone}}</em> 
    <em>欢迎来到会员中心</em> 
    <a href="#">地址管理</a> 
    <a href="/zhuce/{{$data->id}}/edit">修改资料</a> 
    <h5>账户安全</h5> 
    <strong>低</strong> 
    <span> <p style=" width:27%"></p> </span> 
    <a href="#">安全等级提升</a> 
    <em style=" padding-right:2px">手机</em> 
    <a href="#" style=" padding-left:2px; float:left; display:block; color:#f00" title="点击绑定">未绑定</a> 
   </div> 
   <!--详细列表--> 
   <div class="xiangxilbnm"> 
    <!--left--> 
    <div class="liefyu"> 
     <h2>交易管理</h2> 
     <div class="conb"> 
      <a href="#">我的购物车</a> 
      <a href="#">虚拟兑换订单</a> 
      <a href="#">我的收藏</a> 
      <a href="#">交易评价/晒单</a> 
      <a href="#">账户余额</a> 
      <a href="#">我的积分</a> 
      <a href="#">我的代金卷</a> 
     </div> 
     <h2>客户服务</h2> 
     <div class="conb"> 
      <a href="#">退款及退货</a> 
      <a href="#">交易投诉</a> 
      <a href="#">商品咨询</a> 
      <a href="#">违规举报</a> 
      <a href="#">平台客服</a> 
      <a href="#">商家入驻</a> 
     </div> 
     <h2>资料管理</h2> 
     <div class="conb"> 
      <a href="#">账户信息</a> 
      <a href="#">账户安全</a> 
      <a href="#">收货地址</a> 
      <a href="#">我的消息</a> 
      <a href="#">我的好友</a> 
      <a href="#">我的足迹</a> 
      <a href="#">第三方账号登录</a> 
      <a href="#">分享绑定</a> 
     </div> 
    </div> 
    @if(Session::has('success'))
        <script>
        alert("{{Session::get('success')}}");
        </script>
    @endif
    <script type="text/javascript">
    $(function(){//第一步都得写这个
      $(".liefyu h2").click(function(){//获取title，并且让他执行下面的函数
      $(this)/*点哪个就是哪个*/.next(".conb")/*哪个标题下面的con*/.slideToggle()/*打开/折叠*/.siblings/*锁定同级元素*/(".con").slideUp()/*同级元素折叠起来*/
      })
    })
    </script> 
    <!--right--> 
    <div class="zuirifip"> 
     <!--lll--> 
     <div class="zuiriftp1"> 
      <ul> 
       <li> <span>账户余额</span> <p>￥1000</p> </li> 
       <li> <span>我的积分</span> <p>1000</p> </li> 
       <li> <span>我的优惠劵</span> <p>
         <s>
          2
         </s>张</p> </li> 
       <li> <span>我的帝云币</span> <p>0</p> </li> 
      </ul> 
     </div> 
     <!--lll--> 
     <!--所有列表--> 
     <!--操作提示--> 
     <div class="sydlbdzz"> 
      <span style=" display:block; width:100%; height:auto; overflow:hidden; background:#FFF"> <em style=" display:block; padding-left:20px; line-height:40px; font-size:14px; color:#666; font-weight:bold">操作提示</em> </span> 
     </div> 
     <div class="sydlbdzz" style=" background:#FFF; border:1px solid #bbb"> 
      <p style=" display:block; width:90%; height:auto; overflow:hidden; margin:0 auto; font-size:12px; color:#666; line-height:20px; background:#FBEED5; padding:10px;margin-top:6px; margin-bottom:6px; color:#C09853">评价信息最多填写250字，请您根据本次交易，给予真实、客观地评价；您的评价将是其他会员的参考。 您可以根据本次交易情况给予商家评分， 一旦提交后不能修改。</p> 
     </div> 
    <form action="/appraise" method="post">
     <!--对商品进行评分--> 
     <div class="dfdaspjtk"> 
      <span style=" display:block; font-size:14px; font-weight:bold; line-height:34px; padding-left:20px; padding-right:20px; color:#666">对该商品进行评价
       <s style="color:#09f"></s></span>
      <s style="color:#09f"> 
       <div class="jhjadxcu" style=" width:100%; height:100px; overflow:hidden;line-height:100px;"> 
       <a href="#"> <img src="{{$pic->p_url}}" width="100px";height="100px"> </a>
         
        <a href="#"><em>{{$goods->name}}</em></a> 
        <em>
         <s>
          {{$goods->price}}
         </s>元*
         <s>
          {{$order->g_number}}
         </s>件</em>  
       </div> 
        <div class="shop-rating" style="margin:0 100px"> 
          <span class="title">宝贝质量：</span> 
         <ul class="rating-level" id="stars1"> 
          <li><a class="one-star" star:value="1" style="padding-left:0px">1</a></li> 
          <li><a class="two-stars" star:value="2" style="padding-left:25px">2</a></li> 
          <li><a class="three-stars" star:value="3" >3</a></li> 
          <li><a class="four-stars" star:value="4" >4</a></li> 
          <li><a class="five-stars" star:value="5" >5</a></li> 
         </ul> 
         <span class="result" id="stars1-tips"></span> 
         <input type="hidden" id="stars1-input" name="gscore" value="4" size="1" /> 
         <em style="line-height: 26px;">(请点击小星星进行评分,默认4星哦)</em> 
        </div> 
       <!--对商品进行评价--> 
       <div class="dfdaspjtk"> 
        <textarea name="content" style=" min-height:140px; display:block; min-width:666px; max-height:141px; max-width:667px; border:1px solid #cacace; margin:5px auto; font-size:15px; line-height:20px; color:#111; text-indent:10px; box-shadow:none" placeholder="评价信息最多填写250字，请您根据本次交易，给予真实、客观地评价； 您的评价将是其他会员的参考。

您可以根据本次交易情况给予商家评分， 一旦提交后不能修改。"required oninvalid="setCustomValidity('请写下你的评价吧')"></textarea> 
       </div> 

        <!--订单号 -->
        <input type="hidden" name="order_id" value="{{$order->order_id}}">
        <!-- 商品id -->
        <input type="hidden" name="goods_id" value="{{$order->goods_id}}">
        <!-- 用户id -->
        <input type="hidden" name="user_id" value="{{$datas->user_id}}">
       <!--评价结束-->  
        <!--一条综合评分结束--> 
       </div> 
       <!--对该店评价结束--> 
      </s>
     </div>
      {{csrf_field()}}
     <s style="color:#09f"> 
      <!--所有列表结束--> 
      <input id="btn_submit" type="submit" class="submit" value="提交" style=" width:100px; height:30px; font-size:14px; background:#09f; color:#fff; margin-left:440px; margin-top:20px" /> 
     </s>
    </div>
    <s style="color:#09f"> 
     <!--right结束--> 
     </form>
    </s>
   </div>
   <s style="color:#09f"> 
    <!--详细列表结束--> 
   </s>
  </div>
  <s style="color:#09f"> 
   <!--个人中心结束-->   
  </s>
 </body>
 <script>
  var Class = { create: function() { return function() { this.initialize.apply(this, arguments); } }}
  var Extend = function(destination, source) { for (var property in source) { destination[property] = source[property]; }}
  function stopDefault( e ) { if ( e && e.preventDefault ){ e.preventDefault(); }else{ window.event.returnValue = false; } return false;} /** * 星星打分组件 * * @author Yunsd * @date 2010-7-5 */
  var Stars = Class.create();Stars.prototype = { initialize: function(star,options) { this.SetOptions(options); 
  //默认属性 
  var flag = 999; //定义全局指针 
  var isIE = (document.all) ? true : false; //IE? 
  var starlist = document.getElementById(star).getElementsByTagName('a'); //星星列表 
  var input = document.getElementById(this.options.Input) || document.getElementById(star+"-input"); // 输出结果 
  var tips = document.getElementById(this.options.Tips) || document.getElementById(star+"-tips"); // 打印提示 
  var nowClass = " " + this.options.nowClass; // 定义选中星星样式名
  var tipsTxt = this.options.tipsTxt; // 定义提示文案 
  var len = starlist.length; //星星数量 
  for(i=0;i<len;i++){ 
  // 绑定事件 点击 鼠标滑过 
  starlist[i].value = i; 
  starlist[i].onclick = function(e){ 
      stopDefault(e); 
      this.className = this.className + nowClass; 
      flag = this.value; 
      input.value = this.getAttribute("star:value"); 
      tips.innerHTML = tipsTxt[this.value] 
      } 
      starlist[i].onmouseover = function(){ 
          if (flag< 999){
              var reg = RegExp(nowClass,"g");
              starlist[flag].className = starlist[flag].className.replace(reg,"") 
              } 
      } 
      starlist[i].onmouseout = function(){ 
          if (flag< 999){ 
              starlist[flag].className = starlist[flag].className + nowClass; 
              } 
          } 
      }; 
      if (isIE){
          //FIX IE下样式错误 
          var li = document.getElementById(star).getElementsByTagName('li'); 
          for (var i = 0, len = li.length; i < len; i++) { 
              var c = li[i]; 
              if (c) 
              {
                  c.className = c.getElementsByTagName('a')[0].className; 
                  } 
              } 
          } 
      }, 
          //设置默认属性 
          SetOptions: function(options) { this.options = {
          //默认值
          Input: "3",
          //设置触保存分数的
          Tips: "1",//设置提示文案容器 
          nowClass: "current-rating",
          //选中的样式名 
          tipsTxt: ["1星-严重差评","2星-差评","3星-中评","4星-比较好","5星-好评"]
          //提示文案 
      };
  Extend(this.options, options || {}); }}/* For TEST */
  function teststars(){
      alert(document.getElementById("stars1-input").value + "|" + document.getElementById("stars2-input").value)
  }
      var Stars1 = new Stars("stars1",{nowClass:"current-rating",tipsTxt:["1星-严重差评","2星-差评","3星-中评","4星-比较好","5星-好评"]});
 </script>
@endsection
@section('title','我要评价')