@inject('apiPresenter','App\Presenters\ApiPresenter')
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
							<td><a href="{{$list['url']}}">{{$list['title']}}</a></td>
							<td>小明</td>
							<td>10|20</td>
							<td>{{$list['timeStr']}}</td>
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
		<div class="poster">
			<div class="spaceCate">
				<h3>发帖</h3>
			</div>
			<div class="poster-from">
				<form class="saveMaibox">
					<div class="title item">
						<input type="title" name="title" placeholder=" 请输入标题...">
					</div>
					<div class="content item">
						@if(!$apiPresenter->judgeCookie())
						<div class="area">
							<div class="pt hm">
								您需要登录后才可以发帖 <a href="" class="login_xt">登录</a>
							</div>
						</div>
						@endif
						<script id="container" name="content" type="text/plain">
						</script>
					</div>
					<div class="item">
						<input type="text" name="captcha" style="width:100px;" placeholder="请输入验证码...">
						<a onclick="javascript:re_captcha();" ><img src="{{ URL('captcha/1') }}"  alt="验证码" title="刷新图片" width="100" height="30" id="captcha" border="0"></a>
						<button class="Btn" type="button" onclick="javascript:saveMaibox();">发帖</button>
					</div>
				</form>
			</div>
		</div>
	</div>

</div>
@stop
@section('script')
<script type="text/javascript" src="/assets/public/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="/assets/public/ueditor/ueditor.all.min.js"></script>
<script type="text/javascript">
	var ue = UE.getEditor('container',{
		initialFrameHeight: 300,
		@if(!$apiPresenter->judgeCookie())
		readonly : true,
		@endif
	});
	$('.login_xt').attr('href',ctx+'/login');
	function re_captcha() {
		$url = "{{ URL('/captcha') }}";
		$url = $url + "/" + Math.random();
		$('#captcha').attr('src',$url);
	}
</script>
@stop