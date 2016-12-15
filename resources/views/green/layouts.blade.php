@inject('apiPresenter','App\Presenters\ApiPresenter')
@if ($info = $apiPresenter->info(32)) @endif
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>@yield('title')-{{$info['name']}}</title>
<link rel="stylesheet" type="text/css" href="/assets/green/css/css.css">
</head>

<body>
<div class="all">
  <div class="top">
    <div class="logo">
      <ul>
        <li><a href="#"><img src="{{$info['logoUrl']}}" /></a></li>
        <li><a href="#"><img src="/assets/green/img/logo-z.png" /></a></li>
      </ul>
    </div>
    <div class="login">
      <ul>
        <li><a href="#">登录</a></li>
        <li>|</li>
        <li><a href="#">找回密码</a></li>
      </ul>
    </div>
    <div class="nav">
        {!!$apiPresenter->navList(32)!!}
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
<script type="text/javascript" src="/assets/green/js/jquery.min.js"></script>
<script type="text/javascript">
  //导航高亮
  var urlstr = window.location.pathname;
  $(".nav").find("a[href='" + urlstr+ "']").addClass("hover");
</script>
@yield('script')
</body>
</html>