@extends('green.layouts')
@section('title')登陆-@stop
@section('content')
<div class="logins">
    @if(!empty($data['retCode']))
    <div id="errorAlert" style="top:233px;">
        <div class="cue-hd"></div>
        <div class="cue-mid">
            <div class="cue-tt">
                <p id="errorTitle">帐号或密码错误</p>
            </div>
            <div style="display: block;" class="cue-detail" id="errorDetail">
                <p>提示：</p>
                <p class="cue-info" id="cueInfo">
                    1. 请检查帐和密码是否输入有误<br>
                    2. 若您帐号已被锁定，请咨询相关管理人员<br>
            </div>
        </div>
        <div class="cue-ft"></div>
        <div class="cue-arrow" id="errorArr" style="top:50%;"></div>
    </div>
    @endif

    <div class="login1 tab-1">
      <div class="loginFunc">
      <span>登录</span>
      </div>
      <div class="loginForm">
        <form action="{{ url('open/apply/'.$school.'/login') }}" method="post">
          <div class="loginFormIpt showPlaceholder">
            <b class="ico ico-uid"></b>
            <input type="text" name="username" placeholder="请输入您的账号">
          </div>
          <div class="loginFormIpt showPlaceholder">
            <b class="ico ico-pwd"></b>
            <input type="password" name="password" placeholder="您的密码">
          </div>
          <div class="loginFormCheck">
            <label><input type="checkbox" name="rememberMe" value="true">记住我</label>
            <div class="clearfix"></div>
          </div>
          <div class="loginFormBtn">
            <button type="submit" tabindex="6" class="btn1 btn-login" style=" float:left; border:0 none;">&nbsp;</button>
          </div>
        </form>
      </div>
    </div>
 </div>
 @stop

@section('script')
<script type="text/javascript">
</script>
@stop