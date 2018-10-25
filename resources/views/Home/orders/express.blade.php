<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>物流信息</title>
<link rel="stylesheet" type="text/css" href="/home/css/vipcenter.css">
<script src="/home/js/jquery-1.8.3.min.js"></script>
<script src="/home/js/public.js"></script>
</head>

<body>
<!--个人中心首页 -->
<div class="thetoubu">
                <!--订单信息-->
    <div class="dfdaspjtk">
            <div class="dfdaspjtk">
            	   <div class="fuwlxtk" style=" border-top:1px dashed #cacace; border-bottom:1px dashed #cacace">
            			<span>{{$sarea}}&nbsp;&nbsp;&nbsp;单号:{{$req}}</span>
            		</div>
                    
                    <!--一条开始-->
                @if($info != null)
                @foreach($info as $row)
                <div class="qieken">
                	<em>{{$row['datetime']}}：</em>
                    <span><s>{{$row['remark']}}</s></span>
                </div>
                @endforeach
                @else
                <div class="qieken">
                    <p style="text-align:center">没有物流信息</p>
                </div>
                @endif
                	<!--一条结束-->
            </div>    
          
    </div>
</div>
</body>
</html>
