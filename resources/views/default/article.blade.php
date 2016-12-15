@extends('default.layouts')
@section('content')
<div class="content-3">
   		<div id="div_display" class="content-right" style="min-height: 350px;width:962px;">
   			<div class="bs-docs-example Micro-classroom">
   				<div class="bs-docs-example Notice-details">
		   			<div class="breadcrumbs-list-wrap">
		   				<a href="/open/school/22/news" class="breadcrumbs-link">活动动态</a>
		   				<span class="spliter">&gt;</span>
		   				<span class="breadcrumbs-text">{{empty($title)?$dataStr.'食谱':$title}}</span>
		   		    </div>
		   		    @if(!empty($title))
	   				<h3>{{$title}}</h3>
	   				<h5>发布机构：{{$orgName}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;发布时间：{{$timeStr}}</h5>
	   				@endif
	   				<div id="div_info_content" class="ignore_global_css" style="display:inline-block;width: 99%;">
	   					{!!$content!!}
	   				</div>
   				</div>
   			</div>
   		</div>
 </div>
 @stop