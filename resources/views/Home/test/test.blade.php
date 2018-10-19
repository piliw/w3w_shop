<html>
<head>
  <meta charset="utf-8">
  <title>前台详情页</title>
</head>
<body>
<form action="/homecart" method="post">

  <div style="width:800px;height:400px;background-color:pink;float:left;margin-left:300px;text-align:center">
    <h4>名字:{{$info->name}}</h4>
    <h4>价格:{{$info->price}}</h4>
    <h4>数量:<input type="text" name="num" value="1"></h4>
    {{csrf_field()}}
    <input type="hidden" name="id" value="{{$info->id}}">
    <h4><input type="submit" class="btn btn-success" value="加入购物车"></h4>
  </div>
   </form> 
</body>
</html>