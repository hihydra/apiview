@extends('default.layouts')
@section('content')
	<div class="content-3">
   		<div id="div_display" class="content-right" style="min-height: 350px;width:962px;">
			<div class="bs-docs-example">
				<table class="table table-bordered table-striped" style="font-size: 18px;">
					<thead>
						<tr>
							<th style="text-align: center;width: 7%;padding:10px;">序号</th>
							<th style="text-align: center;width: 50%;padding:10px;">主题</th>
							<th style="text-align: left;width: 43%;padding:10px;">发布时间</th>
						</tr>
					</thead>
					 <tbody>
					 @foreach ($datas as $list)
						 <tr>
							 <td style="text-align: center;padding:10px;">{{$list['id']}}</td>
							 <td id="td_name_25" style="text-align: center;;padding:10px;">
							 	 <a id="user_name_25" href="{{$url}}?id={{$list['id']}}">{{$list['dataStr']}}食谱</a>
							 </td>
							 <td id="td_ut_25" style="padding:10px;">{{$list['utStr']}}</td>
						 </tr>
				     @endforeach
					 </tbody>
				</table>
   			 <div class="page_navi" style="text-align:right;text-align:right;width: 80%;float: right;">
				@include('vendor.pagination')
   			 </div>
   			 <div class="left" style="height:36px; line-height:36px; ">
   			 	<span>共{{$totalRecords}}条数据</span>
   			 </div>
   		</div>
	</div>
@stop