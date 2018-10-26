@extends('Home.Public.public')
@section('main') 
  <link rel="stylesheet" type="text/css" href="/home/js/statics/grade.css" /> 
  <link rel="stylesheet" type="text/css" href="/home/css/appraise.css" /> 
  <link rel="stylesheet" href="/layuiadmin/layui/css/layui.css" media="all">
  <link rel="stylesheet" href="/layuiadmin/style/admin.css" media="all">
  <script src="/home/js/statics/jquery-latest.pack.js"></script> 
  <script src="/home/js/statics/grade.js"></script> 
  <script src="/jquery-1.7.2.min.js"></script> 

  <!--个人中心首页 --> 
  <div class="thetoubu"> 
   <!--头部--> 
   <div class="thetoubu1"> 
   @if(!empty($hname))
    <b> <img src="{{$hname->user_pic}}" /></b> 
    <em>{{$hname->nickname}}</em>
    @else
      <b> <img src="/home/img/touxiang.png"/></b>
        <em>czz1994612</em>
    @endif
    <em>欢迎来到会员中心</em> 
    <a href="#">地址管理</a> 
    <a href="/zhuce/1/edit">修改资料</a> 
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
    <form action="/status" method="post">
     <!--对商品进行评分--> 
     <div class="dfdaspjtk"> 
      <span style=" display:block; font-size:14px; font-weight:bold; line-height:34px; padding-left:20px; padding-right:20px; color:#666">对该商品进行评价
       <s style="color:#09f"></s></span>
      <s style="color:#09f"> 
      @foreach($goodsinfo as $key=>$row)
       <div class="jhjadxcu" style=" width:100%; height:100px; overflow:hidden;line-height:100px; margin-top:20px"> 
       <a href="#"> <img src="{{$row->p_url}}" width="100px";height="100px"> </a>
         
        <a href="#"><em>{{$row->name}}</em></a> 
        <em>
         <s>
          {{$row->g_price}}
         </s>元*
         <s>
          {{$row->g_number}}
         </s>件</em>  
       </div> 
        <div class="shop-rating" style="margin:0 100px;margin-bottom:50px"> 
          <span class="title">宝贝质量：</span> 

          <div class="test1"></div> 
         <input type="text" name="gscore" value="4" size="1" /> 

         <span class="result" id="stars1-tips"></span> 
         <em style="line-height: 26px;">(请点击小星星进行评分,默认4星哦)</em> 
        </div> 
       <!--对商品进行评价--> 
       <div class="dfdaspjtk"> 
        <textarea name="content" style=" min-height:140px; display:block; min-width:666px; max-height:141px; max-width:667px; border:1px solid #cacace; margin:5px auto; font-size:15px; line-height:20px; color:#111; text-indent:10px; box-shadow:none" placeholder="评价信息最多填写250字，请您根据本次交易，给予真实、客观地评价； 您的评价将是其他会员的参考" oninvalid="setCustomValidity('请写下你的评价吧')"></textarea> 
        @endforeach
       </div> 
        @foreach($goodsinfo as $k=>$v)
        <!--订单号 -->
        <input type="hidden" name="order_id" value="{{$v->order_id}}">
        <!-- 商品id -->
        <input type="hidden" name="goods_id" value="{{$v->goods_id}}">
        <!-- 用户id -->
        <input type="hidden" name="user_id" value="{{$v->user_id}}">
       <!--评价结束--> 
       @endforeach
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

   <script src="/layuiadmin/layui/layui.js"></script>
  <script>
  layui.use('rate', function(){
    var rate = layui.rate;
    var $=layui.jquery;
    layui.each($('.test1'),function(index,elem){
      rate.render({
      elem: elem
      ,value: 4 //初始值
      ,text: true //开启文本
        ,choose: function(value){
         // if(value > 4) alert( '么么哒' )
         console.log($(this));
         }

    });
    }); 
  });
  </script>
 
@endsection
@section('title','我要评价')