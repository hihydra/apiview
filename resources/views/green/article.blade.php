@extends('green.layouts')
@section('title'){{{ $title or $startStr.'-'.$startStr.'食谱' }}} - {{$typeCh}} - @stop
@section('content')
@include('green.sidebar')
    <div class="three_l zixun_left">
    <div class="three_tit clearfix">
      <h3 class="title_name">{{$typeCh}}</h3>
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
          @if(!empty($atts))
            @foreach($atts as $key => $att)
             <p class="download"><i class="icon icon-attachment"></i><span>附件：{{$key+1}} {{$att['name']}}<a href="{{$att['url']}}">下载</a></span></p>
            @endforeach
          @endif
          <p class="info">{!!$content!!}</p>
        </div>
	  </div>
    </div>
  </div>
 @stop