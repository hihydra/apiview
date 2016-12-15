@extends('default.layouts')
@section('content')
	<div class="content-3">
   		<div id="div_display" class="content-right" style="min-height: 350px;width:962px;">
   			 <ul id="ul_news" class="xy_newslist-1 inner-page-list">
   			 	@foreach ($datas as $list)
	   			 	 <li>
	   			 	 	<span class="right">{{$list['timeStr']}}</span>
	   			 	 	<a target="_blank" href="{{$url}}?id={{$list['id']}}">
	   			 	 		<strong>{{$list['title']}}</strong>
	   			 	 	</a>
	   			 	 </li>
				 	 <p>{{$list['reduced']}}</p>
	   			 	 <div class="clear" style="height: 25px;"></div>
   			 	 @endforeach
   			 </ul>

   			 <div class="page_navi" style="text-align:right;text-align:right;width: 80%;float: right;">
				@include('vendor.pagination')
   			 </div>
   			 <div class="left" style="height:36px; line-height:36px; ">
   			 	<span>共{{$totalRecords}}条数据</span></div>
   			 <div class="clear"></div>
   		</div>
	</div>
@stop