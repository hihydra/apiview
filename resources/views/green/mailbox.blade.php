@extends('green.layouts')
@section('title'){{$typeCh}}-@stop
@section('headScript')
<script type="text/javascript" src="/assets/green/js/space.js"></script>
@stop
@section('content')
@include('green.sidebar')
<div class="three_l zixun_left">
  <div class="three_tit clearfix">
    <h3 class="title_name">{{$typeCh}}</h3>
  </div>
  <div class="three_con clearfix">
    <div class="mailbox">
      <div class="mailbox-from">
      <form method="post">
        <div class="title item">
            <input type="title" name="" placeholder="请输入标题...">
        </div>
        <div class="content item">
            <textarea type="content" name="" placeholder="请输入内容..."></textarea>
        </div>
        <div class="qz-poster-ft left">
          <div class="left">
            <form id="weibo_form_upload" class="left-form" method="post"  enctype="multipart/form-data">
                <input type="hidden" id="weibo_ipt_upload_type"  name="type" />
                <a id="a_photo"><i class="icon icon-pic-1"></i>图片</a>
                <div id="div_ipt_photo"><input type="file" class="photo-input" accept="image/*" name="file" onchange="javascript:weiboAttachmentUpload(this,'weibo_form_upload','PHOTO')" /></div>
            </form>
          </div>
        </div>
        <div class="tel item">
          手机号:  <input type="tel" name="">
          <input class="Btn" type="submit" value="发布">
        </div>
      </form>
      </div>
    </div>
    <div id="weibo_div_uploadResult" class="post" style="display: none;">
        <div class="right">
          <a href="javascript:delAttachment();">
            <i class="icon icon-remove"></i></a>
        </div>
        <div class="left">图片：<span id="weibo_span_fname"></span></div>
        <div class="clear"></div>
        <div><img id="weibo_img" src=""></div>
        <div class="clear"></div>
    </div>
    <div class="control-inner" style="height:0px;"></div>
    @if(!empty($datas))
    <div class="profile-1 clearfix">
     <ul>
       @foreach ($datas as $list)
       <li>
          <div class="mailbox-title">
            <span>{{$list['timeStr']}}</span>
            <a href="{{$list['url']}}">{{$list['title']}}</a>
          </div>
         <span class="mailbox-content-left">
                <img src="http://111.47.13.92:9004/attachment/userPhoto/944.jpg"><br>【管理员】
         </span>
         <span class="mailbox-content-right"><p>{{$list['reduced']}}</p></span>
            <div class="mailbox-reply">
                <span class="mailbox-content-left">
                  <img src="http://111.47.13.92:9004/attachment/userPhoto/944.jpg"><br>【管理员】
                </span>
                <span class="mailbox-content-right">
                  <p>家长您好！校服厂商下周四—周六三天时间来附小补售校服，学校也会通知班主任提醒家长，请您关注学校通知，按时来买。如果还有疑问请联系人魏老师 办公电话87540332<br></p>
                </span>
                <span class="li-content-time">2014-02-24 16:38:28</span>
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
   暂时没有{{$typeCh}}哟
   @endif
 </div>
 </div>
 @stop