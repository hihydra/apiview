@inject('apiPresenter','App\Presenters\ApiPresenter')
@if ($photos = $apiPresenter->photo($school,'TYPE_PHOTO',6)) @endif
@if ($notices = $apiPresenter->notice($school,6,80)) @endif
@if ($teacherPhotos = $apiPresenter->teacherPhoto($school,6)) @endif
@if ($news = $apiPresenter->new($school,3,50)) @endif
@if ($kindsPhotos = $apiPresenter->picture($school,'TYPE_KINDS',6)) @endif
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
      @foreach ($notices['datas'] as $notice)
        <li>
          <div class="ul-l">
            <div class="holder">
              <div class="month green">
                <p>五月</p>
              </div>
              <div class="day">
                <p>9</p>
              </div>
            </div>
          </div>
          <div class="ul-l notice">
            <h2>{{$notice['title']}}</h2>
            <p>{{$notice['reduced']}}</p>
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
      <div class="bannar-2"><a href="#"><img src="/assets/green/img/img-2.jpg" /></a></div>
      <ul class="fl_ul">
      @foreach ($news['datas'] as $key => $new)
        <li>
          <div class="ul-l ul-l-{{$key+1}}">&nbsp;</div>
          <div class="ul-l notice">
            <h2><span>{{$new['timeStr']}}</span>{{$new['title']}}</h2>
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
              <a href="{{$kindsPhoto['url']}}"><img src="{{$kindsPhoto['img']}}"/></a>
              @if($key == 0)
              <div class="z-1"><h2></h2><p>{{$kindsPhoto['name']}}</p></div>
              @endif
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