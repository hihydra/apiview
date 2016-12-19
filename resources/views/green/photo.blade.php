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
        <div class="profile clearfix">
           <ul>
           @foreach ($datas as $photo)
             <li>
               <a href="{{$photo['url']}}"><img src="{{$photo['img']}}" width="248px" height="132px" /></a>
               <div class="li-a-div">
                 <div class="right"><span>{{$photo['name']}}</span></div>
                 <div class="left">{{$typeCh}}</div>
               </div>
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