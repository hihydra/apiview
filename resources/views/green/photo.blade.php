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
    <div class="profile clearfix photo">
     <ul>
       @foreach ($datas as $photo)
       <li>
        <img src="{{$photo['img']}}" />
        <a href="{{$photo['url']}}">{{$photo['name']}}</a>
      </li>
      @endforeach
    </ul>
    <div class="clear"></div>
  </div>
  <div class="turnPage">
   @include('vendor.pagination')
 </div>
 @else
 暂时没有上传{{$typeCh}}哟
 @endif
</div>
</div>
@stop