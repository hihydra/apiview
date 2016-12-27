@extends('green.layouts')
@section('title'){{$typeCh}}-@stop
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
            <form id="weibo_form_upload" class="left-form" action="/attachment/upload" method="post" target="formFrame" enctype="multipart/form-data">
               <a id="a_photo" href="javascript:showAttachmentUpload('请选择一个图片格式的文件',2);"><i class="icon icon-pic"></i>图片 </a>
               <div id="div_ipt_photo"><input type="file" class="photo-input" accept="image/*" name="file" onchange="javascript:weiboAttachmentUpload(this,'weibo_form_upload','PHOTO')">
               </div>
            </form>
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
    @if(!empty($datas))
    <div class="profile-1 clearfix">
     <ul>
       @foreach ($datas as $list)
       <li>
         <span>{{$list['timeStr']}}</span>
         <a href="{{$list['url']}}">{{$list['title']}}</a>
         <p>{{$list['reduced']}}</p>
          <span>浏览量:</span><span>已处理|</span>
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