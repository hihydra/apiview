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
            <p class="info">@if(empty($content))暂无记录@else{!!$content!!}@endif</p>
	  </div>
    </div>
  </div>
@stop