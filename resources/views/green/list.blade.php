@extends('green.layouts')
@section('title'){{$cateName}}-@stop
@section('content')
@include('green.sidebar')
<div class="three_l zixun_left">
	<div class="three_tit clearfix">
		<h3 class="title_name">{{$cateName}}</h3>
	</div>
	<div class="three_con clearfix">
		@if(!empty($datas))
		<div class="profile-1 clearfix">
			<table>
				<thead>
					<tr>
						<th>序号</th>
						<th>主题</th>
						<th>发布时间</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($datas as $list)
					<tr>
						<td>{{$list['id']}}</td>
						<td><a href="{{$list['url']}}">{{$list['startStr']}}--{{$list['endStr']}}食谱</a></td>
						<td>{{$list['utStr']}}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			<div class="clear"></div>
		</div>

		<div class="turnPage">
			@include('vendor.pagination')
		</div>
		@else
		暂时没有{{$cateName}}哟
		@endif
	</div>
</div>
@stop