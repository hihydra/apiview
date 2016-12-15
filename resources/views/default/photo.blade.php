@extends('default.layouts')
@section('content')
<div class="content-3" style="width:1002px;">
		<div class="content-right" style="min-height: 350px;width:962px;padding:40px 20px;">
			 <div id="div_display" class="bs-docs-example Notice-details">
			 	<div class="rboxt-tb">
			 		<ul>
			 		@foreach ($datas as $photo)
   			 		<li>
   			 			@if(!empty($photo['photo']))
   			 				<a href="{{$url}}?id={{$photo['id']}}" class="blk-img">
								<img src="http://111.47.13.92:16800/{{$photo['teacherPhotoUrl']}}" height="200" width="200">
								<span class="tit">{{$photo['name']}}</span>
							</a>
   			 			@else
   			 			    <a href="http://111.47.13.92:16800{{$url}}{{$photo['hash']}}/{{$photo['id']}}.jpg" class="blk-img">
								<img src="http://111.47.13.92:16800{{$url}}{{$photo['hash']}}/{{$photo['id']}}.jpg" height="200" width="200">
								<span class="tit">{{$photo['name']}}</span>
							</a>
   			 			@endif
   			 		</li>
   			 		@endforeach
			 	    </ul>
			 	</div>
				 <div class="page_navi" style="text-align:right;text-align:right;width: 80%;float: right;">
					@include('vendor.pagination')
	   			 </div>
	   			 <div class="left" style="height:36px; line-height:36px; ">
	   			 	<span>共{{$totalRecords}}条数据</span>
	   			 </div>
			 </div>
		</div>
 </div>
 @stop