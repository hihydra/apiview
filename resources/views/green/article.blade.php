@extends('green.layouts')
@section('content')
@include('green.sidebar')
    <div class="three_l zixun_left">
    <div class="three_tit clearfix">
      <h3 class="title_name"></h3>
    </div>
    <div class="three_con clearfix">
      <div class="profile clearfix">
      		<div class="title">
      		   @if(!empty($title))
   				<h3>{{$title}}</h3>
   				<p class="info">发布机构：{{$orgName}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;发布时间：{{$timeStr}}</p>
	   		   @endif
	   		</div>
	   		<div class="content">
            	<p class="info">{!!$content!!}</p>
            </div>
	  </div>
    </div>
  </div>
 @stop