@extends('Home.Public.public')
@section('main')
<div style="width:1190px;height:30px;background-color:#fcfcfc;margin:10px auto;border:1px solid #d9d9d9;margin-bottom: 10px;padding-left: 10px;color:#666;font-size:14px;line-height:30px">官方公告</div>
	<center>
		@foreach($data as $v)
		<p style="font-size:40px;color:red;">{{$v->name}}</p>
		<table id="cpcm" cellpadding="0" border="0" align="center">
			<tbody>
				<tr>
					<td>{!!$v->content!!}</td>
				</tr>
			</tbody>
		</table>
		@endforeach
</center>
@endsection
@section('title','官方公告')