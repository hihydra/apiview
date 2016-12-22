@extends('green.layouts')
@section('title')空间-@stop
@section('content')
<script type="text/javascript" src="/assets/green/js/space.js"></script>
<script type="text/javascript" src="/assets/green/js/main.js"></script>
<div class="pf_head">
  <div class="pf_head_pic">
    <li><img src="{{$img}}" width="120px" height="120px"></li>
  </div>
  <span class="title-text">{{$name}} 【{{$typeStr == 'SCHOOL_RECTOR'?'园长':'教师'}}】</span>
</div>
<div class="clear"></div>
<div class="three_2">
<h2>空间管理</h2>
  <ul>
    <li><a href="">教师空间</a></li>
    <li><a href='/open/apply/32/category?type=orgStruct'>家长空间</a></li>
  </ul>
</div>
<div class="three_l zixun_left">
  <div class="three_con clearfix">
    <div class="clearfix">
      <div class="qz-poster">
        <div class="qz-poster-bd">
          <form id="form_teacherSpace" method="post">
            <input type="hidden" id="ipt_form_ftype" name="ftype" value="NONE">
            <input type="hidden" id="ipt_form_fid" name="fid">
            <input type="hidden" id="ipt_form_fname" name="fname">
            <textarea id="textarea_content" placeholder="我想说的是..." tabindex="1" name="c"></textarea>
            <input class="Btn" type="button" value="发表" onclick="javascript:doAddTeacherSpaceData();">
          </form>
        </div>
        <div class="qz-poster-ft">
            <div class="left">
              <form id="weibo_form_upload" class="left-form" action="/attachment/upload" method="post" target="formFrame" enctype="multipart/form-data">
                <input type="hidden" id="weibo_ipt_upload_type"  name="type" />
                <a id="a_weibo_face" href="javascript:void(0);"><i class="icon icon-Expression-1"></i>表情</a>
                <a id="a_photo" href="javascript:showAttachmentUpload('请选择一个图片格式的文件',2);"><i class="icon icon-pic-1"></i>图片 </a>
                <div id="div_ipt_photo"><input type="file" class="photo-input" accept="image/*" name="file" onchange="javascript:weiboAttachmentUpload(this,'weibo_form_upload','PHOTO')" /></div>
              </form>
            </div>
        </div>

      </div>


      <div id="vlist">
        <div class="busbox">

          </div>
          <div id="get_more" class="txtcent button ft12" style="display: none;">点击加载更多</div>
      </div>


    </div>
 </div>
 @stop
@section('script')
<!--
<script type="text/javascript" src="/assets/green/js/jquery.more.js"></script>
<script type="text/javascript">
    jQuery(function() {
        jQuery('#vlist').more({
            "url": '/open/apply/{{$orgId}}/teacherSpace/{{$id}}',
            "template": ".busbox",
            "trigger": "#get_more"
        });
    });
</script>
-->
<script type="text/javascript">
$(document).ready(function(){
  methods.get_data();
    $('#get_more').on('click',function(){
          methods.get_data();
    })
  });
$("#textarea_content").FormFace({ faceTitle : "#a_weibo_face", cid : "", left : "-5" , top : "5" });
</script>

@stop