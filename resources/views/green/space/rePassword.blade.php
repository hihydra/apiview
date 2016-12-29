@extends('green.space.layouts')
@section('title')修改密码-@stop
@section('spaceContent')
    <div class="three_l zixun_left">
        <div class="three_con clearfix">
            <div id="settings_display_password" class="unfold_content clearfix">
              <form id="form_pwdModify" class="unfold_left">
                <ul class="account_title clearfix">
                  <li class="title W_fb"><i class="icon icon-Change-password"></i>修改密码</li><br>
                </ul>
                <div class="item">
                  <label class="sele-label label-nick">当前密码：</label>
                  <input id="ipt_oldPwd" name="oldPwd" style="width: 174px;" type="password" placeholder="请输入您的原有密码" class="inp">
                  <div id="div_oldPwd_hint" class="u-tips" style="display:none;">
                    <em></em><span id="div_oldPwd_hint_text"></span>
                  </div>   </div>
                  <div class="item">
                  <label class="sele-label label-nick">新密码：</label>
                  <input id="ipt_newPwd" name="newPwd" style="width: 174px;" type="password" placeholder="请输入您的新密码" class="inp">
                  <div id="div_newPwd_hint" class="u-tips u-tips-default">
                    <em></em><span id="div_newPwd_hint_text"></span>
                  </div>
                </div>
                <div class="item">
                  <label class="sele-label label-nick">&nbsp;</label>
                  <span>密码由6——16位字符（字母、数字、符号）组成，区分大小写，且必须至少包含两种字符（如：字母和数字）</span>
                </div>
                <div class="item">
                  <label class="sele-label label-nick">确认新密码：</label>
                  <input id="ipt_newPwd_c" style="width: 174px;" type="password" placeholder="请再次输入新密码" class="inp">
                  <div id="div_newPwd_c_hint" class="u-tips u-tips-default">
                    <em></em><span id="div_newPwd_c_hint_text"></span>
                  </div>
                </div>
                <div class="item">
                  <label class="sele-label label-nick">&nbsp;</label>
                     <input id="ipt_submit" type="button" value="保存" class="Btn">
                </div>
              </form>
        </div>
    </div>
    </div>
@stop
@section('script')
<script type="text/javascript" src="/assets/green/js/password.js"></script>
<script type="text/javascript" src="/assets/green/js/passwordCheck.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    doLoadPwd();
    loadPersonalInfo(true);
});
</script>
@stop