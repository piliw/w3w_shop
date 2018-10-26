<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>我的购物车</title>
    <link rel="stylesheet" href="/home/css/mi.css">
    <link rel="stylesheet" href="/home/css/cart.css">
</head>
<body>
    <div class="cart-head">
        <a href="./index.php"><div class="cart-mi-logo"></div></a>
        <h2 class="my-cart">我的购物车</h2>
        <div class="cart-login fr" >
            @if(empty($uname))
            <span class="fr"><a href="/zhuce/create">注册</a></span>
            <span class="fr">|</span>
            <span class="fr cart-reg"><a href="/homelogin">登陆</a></span>
            @else
            <span class="fr"><a href="/zhuce/{{Session::get('hid')}}">我的订单</a></span>
            <span class="fr">|</span>
            <span class="fr cart-reg"><a href="">{{$uname}}</a></span>
            @endif
        </div>

    </div>

    <!-- 购物车商品板块 -->
    <div class="cart-body">
        <div class="cart-nono" ></div>
            <div class="cart-table">
                <center></center>
                    <table width="1226" align="center" bgcolor="#FFFFFF">
                        <tr height="30">
                            <th>商品预览</th>
                            <th width="200">商品名称</th>
                            <th>单价</th>
                            <th>数量</th>
                            <th>小计</th>
                            <th>操作</th>
                        </tr>
                        <tr><td style="border:1px solid #BABABA;" colspan="7";></td></tr>
                        @foreach($data as $row)
                        <tr height="80" align="center">
                            <!-- <td><input type="checkbox" checked></td> -->
                            <td><img src="{{$row['p_url']}}" height="120"></td>
                            <td style="font-size:13px;">{{$row['name']}}
                            <div>...</div>
                            <div style="color:#ff6700; font-size:12px; text-align:right;">尺码:{{$row['size']}}</div>
                            </td>
                            <td>{{$row['price']}}</td>

                            <td>
                                <a href="/updatee/{{$row['id']}}"><button>－</button></a>
                                    &nbsp;&nbsp;
                                    {{$row['num']}}
                                    &nbsp;&nbsp;
                                <a href="/updates/{{$row['id']}}"><button>＋</button></a>
                            </td>

                            <td border="1" style="color:#ff6700">{{$row['price']*$row['num']}} 元</td>
                            <td><a href="/cartdel/{{$row['id']}}" style="color:red;">Ⅹ</a></td>
                        </tr>
                        <tr><td style="border:1px solid #C3E288;" colspan="7";></td></tr>
                        @endforeach
                    </table>
                </center>

                <div class="goumai">
                    <span class="shoping">
                        <a href="/">继续购物</a>
                    </span>
                    <span class="shoping">共 <span class="duoduo">{{$tot}}</span>件商品</span>
                    <span class="shoping heji fl">
                    合计:
                        <span class="jiage">
                            {{$total}}元
                        </span>
                    </span>
                    <span>
                        <a href="/orders">
                             <input class="lijigoumai fr" style="cursor:pointer" type="submit" value="立即购买">
                        </a>
                    </span>
                </div>
            </div>
    </div>



    <!-- 设置网页脚部信息 -->
        <div class="side-footer">
            <div class="footer-server">
                <ul>
                    <li>
                        <a href="">
                            <div class="server-logo1 fl"></div>
                            <div class="server-text fl">
                                预约维修服务
                            </div>
                        </a>
                    </li>
                    <li class="fengexian">
                        <a href="">
                            <div class="server-logo2 fl"></div>
                            <div class="server-text fl">
                                7天无理由退货
                            </div>
                        </a>
                    </li>
                    <li class="fengexian">
                        <a href="">
                            <div class="server-logo3 fl"></div>
                            <div class="server-text fl">
                                15天免费换货
                            </div>
                        </a>
                    </li>
                    <li class="fengexian">
                        <a href="">
                            <div class="server-logo4 fl"></div>
                            <div class="server-text fl">
                                满150元包邮
                            </div>
                        </a>
                    </li>
                    <li class="fengexian">
                        <a href="">
                            <div class="server-logo5 fl"></div>
                            <div class="server-text fl">
                                520余家售后网点
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="footer-link">
                <div class="footer-link-first fl">
                    <dl>
                        <dt>帮助中心</dt>
                        <dd><a href="">账户管理</a></dd>
                        <dd><a href="">购物指南</a></dd>
                        <dd><a href="">订单操作</a></dd>
                    </dl>
                </div>
                <div class="footer-link-first fl">
                    <dl>
                        <dt>服务支持</dt>
                        <dd><a href="">售后政策</a></dd>
                        <dd><a href="">自助服务</a></dd>
                        <dd><a href="">相关下载</a></dd>
                    </dl>
                </div>
                <div class="footer-link-first fl">
                    <dl>
                        <dt>线下门店</dt>
                        <dd><a href="">小米之家</a></dd>
                        <dd><a href="">服务网点</a></dd>
                        <dd><a href="">授权门店</a></dd>
                    </dl>
                </div>
                <div class="footer-link-first fl">
                    <dl>
                        <dt>关于小米</dt>
                        <dd><a href="">了解小米</a></dd>
                        <dd><a href="">加入小米</a></dd>
                        <dd><a href="">投资者关系</a></dd>
                    </dl>
                </div>
                <div class="footer-link-first fl">
                    <dl>
                        <dt>关注我们</dt>
                        <dd><a href="">新浪微博</a></dd>
                        <dd><a href="">官方微信</a></dd>
                        <dd><a href="">联系我们</a></dd>
                    </dl>
                </div>
                <div class="footer-link-first fl">
                    <dl>
                        <dt>特色服务</dt>
                        <dd><a href="">F 码通道</a></dd>
                        <dd><a href="">礼物码</a></dd>
                        <dd><a href="">防伪查询</a></dd>
                    </dl>
                </div>
                <div class="footer-link-second fl">
                    <span>400-100-5678</span><br>
                    <p>周一至周日 8:00-18:00<br>
                    （           仅收市话费）</p>
                    <a href="">
                        <div class="link-second-second">
                            <div class="kefulogo fl"></div>
                            <div class=" lianxikefu fl">
                            联系客服
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <!-- 底部 -->
        <div class="side-info">
            <div class="side-container">
                <div class="side-logo"></div>
                <div class="text-box">
                    <p class="box-one">
                        <a href="">小米商城</a>
                        <span>|</span>
                        <a href="">MIUI</a>
                        <span>|</span>
                        <a href="">米家</a>
                        <span>|</span>
                        <a href="">米聊</a>
                        <span>|</span>
                        <a href="">多看</a>
                        <span>|</span>
                        <a href="">游戏</a>
                        <span>|</span>
                        <a href="">路由器</a>
                        <span>|</span>
                        <a href="">米粉卡</a>
                        <span>|</span>
                        <a href="">政企服务</a>
                        <span>|</span>
                        <a href="">小米天猫店</a>
                        <span>|</span>
                        <a href="">隐私政策</a>
                        <span>|</span>
                        <a href="">问题反馈</a>
                        <span>|</span>
                        <a href="">廉正举报</a>
                        <span>|</span>
                        <a href="">Select Region</a>
                    </p>
                    <p class="box-two">
                        ©<a href="">mi.com</a> 
                        京ICP证110507号
                        <a href="">京ICP备10046444号 </a>
                        <a href="">京公网安备11010802020134号</a>
                        <a href="">京网文[2017]1530-131号</a><br> 
                        违法和不良信息举报电话：185-0130-1238，本网站所列数据，除特殊说明，所有数据均出自我司实验室测试
                    </p>
                </div>
                <div class="side-img">
                    <a href="">
                        <img src="/home/img/truste.png" alt="" height="28">
                    </a>
                    <a href="">
                        <img src="/home/img/v-logo-2.png" alt="" height="28">
                    </a>
                    <a href="">
                        <img src="/home/img/v-logo-1.png" alt="" height="28">
                    </a>
                    <a href="">
                        <img src="/home/img/v-logo-3.png" alt="" height="28">
                    </a>
                    <a href="">
                        <img src="/home/img/ba10428a4f9495ac310.png" alt="" height="28">
                    </a>
                </div>
            </div>
            <div class="slogan"></div>
        </div>
    
</body>
</html>