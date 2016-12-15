@extends('green.layouts')
@section('title'){{$cateName}}-@stop
@section('content')
@include('green.sidebar')
    <div class="three_l zixun_left">
    <div class="three_tit clearfix">
      <h3 class="title_name">{{$cateName}}</h3>
    </div>
    <div class="three_con clearfix">
      <div class="profile clearfix">
	   		<div class="content">
            	<p class="info">{!!$content!!}</p>
            </div>
	  </div>
    </div>
  </div>
 @stop