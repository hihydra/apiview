@extends('green.layouts')
@section('title'){{$typeCh}}-@stop
@section('content')
@include('green.sidebar')
<div class="three_l zixun_left">
	<div class="three_tit clearfix">
		<h3 class="title_name">{{$typeCh}}</h3>
	</div>
	<div class="three_con clearfix">
		@if(!empty($datas))
		<div class="profile-1 clearfix">
			<div class="forum">
				<table>
					<thead>
						<tr>
							<th>
							<span>筛选</span>
							<select class="screen">
						          <option value="全部时间">全部时间</option>
						          <option value="一天">一天</option>
						          <option value="两天">两天</option>
						          <option value="一周">一周</option>
						          <option value="一个月">一个月</option>
						          <option value="三个月">三个月</option>
						    </select>
						    <span>排序</span>
						    <select class="sort">
						          <option value="全部时间">全部时间</option>
						          <option value="一天">一天</option>
						          <option value="两天">两天</option>
						          <option value="一周">一周</option>
						          <option value="一个月">一个月</option>
						          <option value="三个月">三个月</option>
						    </select>
						    </th>
							<th>作者</th>
							<th>回复|查看</th>
							<th>发布时间</th>
							<th>最后发表</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($datas as $list)
						<tr>
							<td><a href="{{$list['url']}}">{{$list['startStr']}}--{{$list['endStr']}}食谱</a></td>
							<td>小明</td>
							<td>10|20</td>
							<td>{{$list['utStr']}}</td>
							<td>小w</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<div class="clear"></div>
		</div>

		<div class="turnPage">
			@include('vendor.pagination')
		</div>
		@else
		暂时没有{{$typeCh}}哟
		@endif
	</div>
</div>
@stop