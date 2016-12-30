@extends('green.space.layouts')
@section('title')空间动态-@stop
@section('spaceContent')
<div class="three_l zixun_left">
    <div class="dynamic_notice">
        <div class="profile-1 clearfix">
           <div class="notice_title">
             <h2>通知</h2>
             <span><a href="{{$notices['more']}}">>>更多</a></span>
           </div>
           <ul>
            @foreach($notices['datas'] as $notice)
             <li>
               <span>{{$notice['timeStr']}}</span>
               <a href="{{$notice['url']}}">{{$notice['title']}}</a>
             </li>
             @endforeach
           </ul>
           <div class="clear"></div>
      </div>
  </div>
  <div class="three_con clearfix">
    <div class="clearfix">
    @if($isOwner)
      <div class="qz-poster">
        <div class="qz-poster-bd">
          <form id="form_teacherSpace" method="post">
            <input type="hidden" id="ipt_form_ftype" name="ftype" value="NONE">
            <input type="hidden" id="ipt_form_fid" name="fid">
            <input type="hidden" id="ipt_form_fname" name="fname">
            <div class="item Special">
                <label class="radioTb">
                    <input type="radio" name="isAll">
                        <span>全园</span>
                    <input type="radio" name="isAll" checked="checked">
                        <span>班级</span>
                    <input type="radio" name="isAll">
                        <span>自己</span>
                </label>
            </div>
            <textarea id="textarea_content" placeholder="我想说的是..." tabindex="1" name="c"></textarea>
            <input class="Btn" type="button" value="发表" onclick="javascript:doAddTeacherSpaceData();">
          </form>
        </div>
        <div class="qz-poster-ft">
            <div class="left">
              <form id="weibo_form_upload" class="left-form" method="post"  enctype="multipart/form-data">
                <input type="hidden" id="weibo_ipt_upload_type"  name="type" />
                <a id="a_weibo_face" href="javascript:void(0);"><i class="icon icon-Expression-1"></i>表情</a>
                <a id="a_photo"><i class="icon icon-pic-1"></i>图片</a>
                <div id="div_ipt_photo"><input type="file" class="photo-input" accept="image/*" name="file" onchange="javascript:weiboAttachmentUpload(this,'weibo_form_upload','PHOTO')" /></div>
              </form>
            </div>
        </div>
        <script type="text/javascript">
          $("#textarea_content").FormFace({ faceTitle : "#a_weibo_face", cid : "", left : "-5" , top : "5" });
        </script>
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
      </div>
      @endif
      <div class="spaceCate">
          <h3>空间动态</h3>
          @if($isOwner)
            <ul>
              <li><a href="">全部</a></li>
              <li><a href="">班级</a></li>
              <li><a href="">与我相关</a></li>
            </ul>
          @endif
      </div>


      <div id="vlist">
        <div class="busbox">

          </div>
          <div id="get_more" class="txtcent button ft12" style="display: none;">点击加载更多</div>
      </div>


    </div>
 </div>
 </div>
 @stop
@section('script')
<script type="text/javascript">
$(document).ready(function(){
    methods.get_data();
    $('#get_more').on('click',function(){
          methods.get_data();
    })
});
</script>
@stop