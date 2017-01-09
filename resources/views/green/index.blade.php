@inject('apiPresenter','App\Presenters\ApiPresenter')
@if ($photos = $apiPresenter->photo('TYPE_PHOTO',6)) @endif
@if ($photoNews = $apiPresenter->intro('TYPE_PHOTO_NEWS',6,50)) @endif
@if ($news = $apiPresenter->intro('TYPE_SCIENTIFIC_RESEARCH',3,50)) @endif
@if ($teacherPhotos = $apiPresenter->teacherPhoto(6)) @endif
@if ($kindsPhotos = $apiPresenter->intro('TYPE_PHOTO_ACTIVITY',6,80)) @endif
@extends('green.layouts')
@section('content')
<div class="fl_1">
  <div id="wrapper">
    <div class="callbacks_container">
      <ul class="rslides" id="slider">
        @foreach ($photos['datas'] as $photo)
        <li> <img src="{{$photo['url']}}">
          <p class="caption">{{$photo['name']}}</p>
        </li>
        @endforeach
      </ul>
    </div>
  </div>
</div>
<div class="fl_1 overview">
  <h2>园所简介&nbsp; | &nbsp;SCHOOL OVERVIEW</h2>
  <p>{{$content}}</p>
</div>
<div class="clear"></div>
<div class="fl_2">
  <div class="tittle_1"><img src="/assets/green/img/tittle_1.jpg" /></div>
  <ul class="fl_ul">
    @foreach ($photoNews['datas'] as $photoNew)
    <li>
      <div class="ul-l"><img src="{{$photoNew['img']}}" width="137px" height="137px"/></div>
      <div class="ul-l notice">
        <h2><a href="{{$photoNew['url']}}">{!!mb_substr($photoNew['title'],0,20)!!}</a></h2>
        <p>{{$photoNew['reduced']}}</p>
      </div>
    </li>
    @endforeach
  </ul>
</div>
<div class="clear"></div>
<div class="fl_3 Style">
  <div class="tittle_1"><img src="/assets/green/img/tittle_2.jpg" /></div>
  <ul>
    @foreach ($teacherPhotos['datas'] as $teacherPhoto)
    <li><img src="{{$teacherPhoto['img']}}" width="127px" height="159px" /><a href="{{$teacherPhoto['url']}}">{{$teacherPhoto['name']}}</a></li>
    @endforeach
  </ul>
</div>
<div class="fl_3 Teach">
  <div class="tittle_1"><img src="/assets/green/img/tittle_3.jpg" /></div>
  <div class="bannar-2"><a href="http://yuer.eduyun.cn/ys/"><img src="/assets/green/img/img-2.jpg" /></a></div>
  <ul class="fl_ul">
    @foreach ($news['datas'] as $key => $new)
    <li>
      <div class="ul-l ul-l-{{$key+1}}">&nbsp;</div>
      <div class="ul-l notice">
        <h2><span>{{$new['timeStr']}}</span><a href="{{$new['url']}}">{{$new['title']}}</a></h2>
        <p>{{$new['reduced']}}</p>
      </div>
    </li>
    @endforeach
  </ul>
</div>
<div class="clear"></div>
<div class="fl_4">
  <div class="tittle_1"><img src="/assets/green/img/tittle_4.jpg" /></div>
  <ul>
    @foreach ($kindsPhotos['datas'] as $key => $kindsPhoto)
    <li>
      <a href="{{$kindsPhoto['url']}}"><img src="{{$kindsPhoto['img']}}" width="327px" height="327px" /></a>
      <div class="z-1"><h2>{{$kindsPhoto['timeStr']}}</h2><p><a href="{{$kindsPhoto['url']}}">{!!mb_substr($kindsPhoto['title'],0,30)!!}</a></p></div>
    </li>
    @endforeach
  </ul>
</div>
@stop

@section('script')
<script type="text/javascript" src="/assets/green/js/responsiveslides.min.js"></script>
<script>
  $(function () {
    $("#slider").responsiveSlides({
      nav: true,
      maxwidth: 406,
      namespace: "callbacks",
    });
  });
</script>
@stop