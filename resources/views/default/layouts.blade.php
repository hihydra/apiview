@inject('apiPresenter','App\Presenters\ApiPresenter')
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>武汉市幼儿园入园登记服务平台</title>
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
  <meta http-equiv="Cache-Control" content="no-store"/>
  <meta http-equiv="Pragma" content="no-cache"/>
  <meta http-equiv="Expires" content="0"/>
  <meta http-equiv="X-UA-Compatible" content="IE=EDGE">
  <meta name="renderer" content="webkit"/>
  <link href="/assets/default/css/style.css?v=160405" rel="stylesheet" type="text/css" />
  <link href="/assets/default/css/add.css?v=160412" rel="stylesheet" type="text/css" />
  <script src="/assets/default/jquery-1.7.2.min.js" type="text/javascript"></script>
  <script type="text/javascript" src="/assets/default/js/utils.js?v=160119"></script>
  <script type="text/javascript" src="/assets/default/js/juicer-min.js"></script>
  <script type="text/javascript">
  <!--
  juicer.set({
      'tag::interpolateOpen': '$J{',
      'tag::noneencodeOpen': '$$J{'
  });
  //-->
  </script>
  <script src="/assets/default/js/lib/jquery.form.js" type="text/javascript"></script>
  <script src="/assets/default/js/lib/jquery-placeholder.js" type="text/javascript"></script>
  <script src="/assets/default/jzbm1604/js/left.js?v=160421" type="text/javascript"></script>
  <script src="/assets/default/jzbm1604/js/kxbdMarquee.js?v=160524" type="text/javascript"></script>
  <script type="text/javascript">
    var ctx = '';
    var schoolId = '22';
  </script>
  <script src="/assets/default/js/menu.js?v=160421" type="text/javascript"></script>
  <script src="/assets/default/js/index.js?v=160425" type="text/javascript"></script>
</head>

<body class="portal">
  <div style="display:none;">
    <input id="ipt_pageNo" type="hidden" value="1" />
  </div>
<!--导航 开始-->
<div class="top">
  <div class="head">
<!--logo 开始-->
    <div class="logo">
      <a target="_blank" href="/open/apply/22/index">
        <img src="/assets/default/img/logo.png" />

        <img style=" position:absolute; top:47px; left:320px;" src="/assets/default/img/line.png" />

        <img style="position:absolute; top:43px; left:330px;" src="/assets/default/img/logo.gif">
       </a>
      <ul class="logo-nav"><!--2016-5-20-->

        <input id="ipt_hasLogin" type="hidden" value="false" />
        <li id="jzbm_login" data-node="menu"><a href="/open/apply/22/login" id="ipt_submit">登录</a></li><li>|</li>
        <!-- <li><a href="javascript:void(0);">注册</a></li> -->
        <li id="jzbm_passGetBack" data-node="menu">
          <a target="_top" href="#">找回密码</a></li>

          <!-- <a target="_top" href="javascript:void(0);" onclick="javascript:selectMenu3('jzbm_passGetBack',showPasswordGetBack);">找回密码</a> -->
        </li>

        </ul>



    </div>
<!--logo 结束-->
    <div class="nav" style="width:1002px;">
      <ul id="ul_menu"  class="left" style="padding-left:160px;">
          {!!$apiPresenter->navList()!!}
      </ul>
    </div>
  </div>
</div>

<!-- 右边报名气球 开始-->
<a id="qiqiu_right" class="sign-up" href="/open/apply/22/admission" style="top:30%;">&nbsp;</a>
<a id="qiqiu_left" class="sign-up" href="/open/apply/22/admission" style="top:30%;left:10px;">&nbsp;</a>
<!-- 右边报名气球 结束-->

<input id="ipt_schoolId" type="hidden" value="22" />
<input id="ipt_schoolName" type="hidden" value="武汉市常青童梦幼儿园" />
<input id="ipt_showQiQiu" type="hidden" value="" />
<!--导航 结束-->

  @yield('content')

<div class="clear"></div>
   @yield('script')

<!--Footer Start-->
<div class="foot">
   <div align="center" class="copyright">
    <a href="#">帮助中心</a>|<a href="#">下载中心</a>|<a href="/admin/login/22">后台管理</a>|<a href="#">客服中心</a>|<a href="#">服务热线：027-81610385</a>
        <div class="clear"></div>
  </div>
    <div>技术运营支持：武汉天喻信息产业股份有限公司</div>
</div>
</body>





<!-- 左边浮动框 开始-->
<div class="devlm-floats">
    <a id="goTopId" title="回到顶部" class="dlf-top hidspan" href="javascript:;"><span>回到顶部</span></a>
    <a id="qcode" title="二维码" class="dlf-qcode hidspan" href="javascript:;"><span>二维码</span></a>
    <a title="问题反馈" id="suggustionFeedbackId" class="dlf-feedback hidspan" href="javascript:;"><span>问题反馈</span></a>
    <a title="联系我们" class="dlf-webtalk hidspan" href="#"><span>联系我们</span></a>
    <div id="wx_floatwin" class="wx-floatwin" style="">

        <img pagespeed_url_hash="3696526220" class="wxf-img" alt="官方微信 扫描关注"
          style=""
        src="/assets/default/img/xweixin.png">
    </div>
</div>
<!-- 左边浮动 结束-->
  <!-- 左边浮动 结束-->
</body>
</html>
