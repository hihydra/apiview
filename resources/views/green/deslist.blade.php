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
     <ul>
       @foreach ($datas as $list)
       <li>
         <span>{{$list['timeStr']}}</span>
         <a href="{{$list['url']}}">{{$list['title']}}</a>
         <p>{{$list['reduced']}}</p>
       </li>
       @endforeach
     </ul>
     <div class="clear"></div>
   </div>

   <div class="turnPage">
     @include('vendor.pagination')
   </div>
   @else
   暂时没有{{$typeCh}}哟
   @endif
 </div>
 </div>
 @stop