@inject('apiPresenter','App\Presenters\ApiPresenter')
@if ($info = $apiPresenter->info()) @endif
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>@yield('title'){{$info['name']}}</title>
  <link rel="stylesheet" type="text/css" href="/assets/green/css/css.css">
  @yield('css')
  <script type="text/javascript" src="/assets/green/js/jquery.min.js"></script>
  <script type="text/javascript">
    var ctx = "/open/apply/{{$info['id']}}";
  </script>
  @yield('headScript')
</head>

<body>
  <div class="all">
    <div class="top">
      <div class="logo">
        <ul>
          <li><a href="{{$info['webUrl']}}"><img src="{{$info['logoUrl']}}" /></a></li>
        </ul>
        <div class="des">
          <ul>
            <li>{{$info['cvalue']}}</li><br>
            <li>{{$info['tenet']}}</li>
          </ul>
        </div>
      </div>
      @if($apiPresenter->judgeCookie())
      <div class="login">
        <ul>
          <li><a href="{!!env('API_URL').'/login/tips'!!}">管理</a></li>
          <li>|</li>
          <li><a href="{{ url('/open/apply/'.$info['id'].'/loginOut') }}">退出</a></li>
        </ul>
      </div>
      @else
      <div class="login">
        <ul>
          <li><a href="{{ url('/open/apply/'.$info['id'].'/login') }}">登录</a></li>
        </ul>
      </div>
      @endif
      <div class="nav">
        <ul>{!!$apiPresenter->navList()!!}</ul>
      </div>
    </div>

    <div class="center">
      @yield('content')
      <div class="clear"></div>

      <div class="fl_5">
            <!--
            <div class="tittle_1"><img src="/assets/green/img/tittle_5.jpg" /></div>
            <div class="space">
              <h2>Q:全国各教育网站</h2>
              <ul>
                <li><a href="#">中华人民共和国教育部</a></li>
                <li><a href="#">国家教育资源公共服务平台</a></li>
                <li><a href="#">湖北省教育厅</a></li>
                <li><a href="#">武汉市教育局</a></li>
                <li><a href="#">武汉市教育科学研究院</a></li>
                <li><a href="#">武汉教育资源公共服务平台</a></li>
                <div class="clear"></div>
              </ul>
              <div class="clear"></div>
              </div>
            -->

            <div class="space">
              <div class="space-ul"><img src="{{$info['logoUrl']}}" /></div>
              <div class="space-ul">
                <p>客户服务热线：027-81610385</p>
                <p>技术运营支持：武汉天喻信息产业股份有限公司</p>
                <p>Copyright© 2016 wuhaneduyun.cn All rights reserved</p>
              </div>
              <div class="space-ul">
                <ul>
                  <li>名称：{{$info['name']}}</li>
                  <li>地址：{{$info['address']}}</li>
                  <li>联系方式：{{$info['phone']}}</li>
                  <li>许可证号: {{$info['number']}}</li>
                </ul>
              </div>
              <div class="clear"></div>
            </div>

          </div>

          <div class="clear"></div>
        </div>

        <div class="foot"></div>

      </div>
      <div class="foot-bg"></div>

      @yield('script')
    </body>
    </html>