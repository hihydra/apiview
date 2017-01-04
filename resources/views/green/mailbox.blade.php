@extends('green.layouts')
@section('title'){{$typeCh}}-@stop
@section('headScript')
<script type="text/javascript" src="/assets/green/js/utils.js"></script>
@stop
@section('content')
@section('content')
@include('green.sidebar')
<div class="three_l zixun_left">
  <div class="three_tit clearfix">
    <h3 class="title_name">{{$typeCh}}</h3>
  </div>
  <div class="three_con clearfix">
    <div class="poster">
      <div class="spaceCate">
        <h3>院长信箱</h3>
      </div>
      <div class="poster-from">
        <form class="saveMaibox">
          <div class="title item">
            <input type="title" name="title" placeholder="请输入标题...">
          </div>
          <div class="content item">
            <textarea type="content" name="content" placeholder="请输入内容..."></textarea>
          </div>
          <div class="tel item">
            <input type="tel" name="mobile" placeholder="请输入手机号..." required="required">
          </div>
          <div class="captcha item">
            <input type="text" name="captcha" style="width:100px;" placeholder="请输入验证码...">
            <a onclick="javascript:re_captcha();" ><img src="{{ URL('captcha/1') }}"  alt="验证码" title="刷新图片" width="100" height="30" id="captcha" border="0"></a>
            <button class="Btn" type="button" onclick="javascript:saveMaibox();">提交</button>
          </div>
        </form>
      </div>
    </div>
    @if(!empty($datas))
    <div class="profile-1 clearfix">
     <ul>
       @foreach ($datas as $list)
       <li>
         <span>{{$list['ftStr']}}</span>
         <a>{{$list['title']}}</a>
         <span class="mailbox-content"><p>{{$list['content']}}</p></span>
         @if($list['isProcessed']||$list['isOwner'])
         <div class="mailbox-reply">
          <span class="mailbox-content-left">
            【回复】
          </span>
          <span class="mailbox-content-right">
            @if(!$list['isProcessed'] && $list['isOwner'])
            <div class="media subMessage hd">
              <div class="media-body">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="row">
                      <div class="col-sm-12 msgBox">
                        <form class="answerMaibox_{{$list['id']}}">
                          <input type="hidden" name="id" value="{{$list['id']}}">
                          <textarea style="width: 96%;" name="note" placeholder="请输入回复内容:"></textarea>
                          <div class="action">
                            <div class="col-sm-12 right">
                             <input onclick="javascript:answerMaibox({{$list['id']}});" class="Btn" type="button" value="确定">
                           </div>
                         </div>
                       </form>
                     </div>
                   </div>
                 </div>
               </div>
             </div>
           </div>
           @endif
           @if($list['isProcessed'])
           <p>{{{ $list['note'] or '' }}}<br></p>
         </span>
         <span class="li-content-time">{{$list['htStr']}}</span>
         @endif
       </div>
       @else
       <span style="color: red;">待处理</span>
       @endif
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
@section('script')
<script type="text/javascript">
  function re_captcha() {
    $url = "{{ URL('/captcha') }}";
    $url = $url + "/" + Math.random();
    $('#captcha').attr('src',$url);
  }
  function saveMaibox(){
    var title = $('input[name^="title"]').val();
    if(title.length<4){
      alert("标题必须大于2个字符！");
      return ;
    }
    var content = $('textarea[name^="content"]').val();
    if(content.length<6){
      alert("内容必须大于4个字符！");
      return ;
    }
    var tel = $('input[name^="mobile"]').val();
    var reg = /^0?1[3|4|5|8][0-9]\d{8}$/;
    if (!reg.test(tel)) {
     alert("手机号码格式错误！");
     return ;
   }
   var captcha = $('input[name^="captcha"]').val();
    if(captcha.length==0){
      alert("验证码不能为空！");
      return ;
    }
   var params = {};
   params.url = ctx+'/saveMaibox';
   params.postData = $('.saveMaibox').serialize();
   params.postType = "post";
   params.error = "操作失败，请确认您的网络是否正常！";
      params.mustCallBack = true;//是否必须回调
      params.callBack = function (json){
        if(json.retCode==CODE_SUCCESS){
          window.location.reload();
        }else if(json.retCode==CODE_NOT_LOGIN){
          alert("登录超时，请重新登录！");
        }else if(json.retCode==CODE_USER_CAPTCHA_ERROR){
          alert("验证码错误！");
        }else{
          alert("操作失败！");
        }
      };
      ajaxJSON(params);
  }
  function answerMaibox(id){
    var content = $("textarea[name='note']").val();;
    if(content.length<6){
      alert("内容必须大于4个字符！");
      return ;
    }
    var params = {};
    params.url = ctx+'/saveMaibox';
    params.postData = $('.answerMaibox_'+id).serialize();
    params.postType = "post";
    params.error = "操作失败，请确认您的网络是否正常！";
    params.mustCallBack = true;//是否必须回调
    params.callBack = function (json){
      if(json.retCode==CODE_SUCCESS){
        window.location.reload();
      }else if(json.retCode==CODE_NOT_LOGIN){
        alert("登录超时，请重新登录！");
      }else{
        alert("操作失败！");
      }
    };
    ajaxJSON(params);
  }
  </script>
  @stop