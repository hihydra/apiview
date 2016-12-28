@extends('green.layouts')
@section('title')空间-@stop
@section('css')
<link rel="stylesheet" href="/assets/green/css/jquery.Jcrop.css" type="text/css" />
@stop
@section('headScript')
<script type="text/javascript">
      var userId = {{$id}};
</script>
<script type="text/javascript" src="/assets/green/js/global"></script>
<script type="text/javascript" src="/assets/green/js/space.js"></script>
<script type="text/javascript" src="/assets/green/js/photoPreview.js"></script>
<script type="text/javascript" src="/assets/green/js/main.js"></script>
<script type="text/javascript" src="/assets/green/js/jquery.Jcrop.js"></script>
<script type="text/javascript" src="/assets/green/js/jquery.rotate.1-1.js"></script>
@stop
@section('content')
<div class="pf_head">
    <div class="pf_head_pic">
      <li><img id="img_userPhoto" src="{{$img}}"></li>
      <div id="div_photoEdit" class="change_btn_div">
          <a class="W_btn_c" href="javascript:showPhotoEdit();">
            <span>更换头像</span>
          </a>
      </div>
    </div>
  <span class="title-text">{{$name}} 【{{$typeStr == 'SCHOOL_RECTOR'?'园长':'教师'}}】</span>
</div>
<div id="dialog_photoEdit" class="popup dis_none jumpBox1" style="display:none;width:485px;">
  <div class="content">
    <div style="cursor: move;" class="title">
      <span>更换头像</span>
    </div>
    <span class="close" name="close">X</span>
    <div class="detail layer_forward">
      <div class="hidden">
        <!--弹出框 内容 开始-->
        <div style="padding:10px 0;">
        <form id="form_photoEdit_1" method="post" target="face_formFrame" enctype="multipart/form-data">
          <div class="item" style="position:relative;">
            <input id="ipt_userPhoto" type="file" style="left:0; top:0; width:65px; height:27px;" accept="image/*" name="file" onchange="javascript:userPhotoTempUpload();" class="photo-input" />
            <a class="Btn btn_blue">上传</a>
          </div>
        </form>
        <form id="form_photoEdit_2" method="post">
          <div id="crop-area">
            <div class="item right preview_fake" style="width:250px;">
              <p>预览</p>
              <p>仅支持IPG、GIF、PNG格式，文件小于5M（使用高质量图片，可生成高清头像）</p>
              <div id="preview_fake" style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale);width:120px;height:120px;overflow:hidden;">
                <img id="preview" style="padding:5px; border:1px solid #f1f1f1;" />
              </div>
            </div>
            <div id="cropbox_fake" class="item left preview_fake_1" style="padding:5px; border:1px solid #f1f1f1;">
              <img id="cropbox" />
            </div>
            <div class="clear"></div>
          </div>
          <input type="hidden" id="userPhoto_ipt_fid" name="fid" />
          <input type="hidden" size="4" name="x1" id="x1" value="0" />
          <input type="hidden" size="4" name="y1" id="y1" value="0" />
          <input type="hidden" size="4" name="x2" id="x2" value="0" />
          <input type="hidden" size="4" name="y2" id="y2" value="0" />
          <input type="hidden" size="4" name="w" id="w" value="0" />
          <input type="hidden" size="4" name="h" id="h" value="0" />
          <input type="hidden" size="4" name="limitSize" value="pic_view" />
        </form>
        </div>
        <!--弹出框 内容 结束-->
      </div>
    </div>
    <div class="item-1">
      <input id="dialog_photoEdit_save" style="display:none;" onclick="javascript:userPhotoUpload();" type="button" class="Btn" value="保存" />
      <input name="close" type="button" class="Btn-1" value="取消" onclick="javascript:hideEdit();"/>
    </div>
  </div>
</div>

<div class="clear"></div>
<div class="three_2">
<h2>空间管理</h2>
  <ul>
    <li><a href="">空间动态</a></li>
  </ul>
</div>
<div class="three_l zixun_left">
  <div class="three_con clearfix">
    <div class="clearfix">
      <div class="qz-poster" @if(empty($_COOKIE['kindergarten_sid']))style="display: none;"@endif>
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
        <div class="spaceCate">
          <h3>空间动态</h3>
            <ul>
              <li><a href="">全部</a></li>
              <li><a href="">班级</a></li>
              <li><a href="">与我相关</a></li>
            </ul>
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
<script type="text/javascript">
$(document).ready(function(){
    methods.get_data();
    $('#get_more').on('click',function(){
          methods.get_data();
    })
    $("#textarea_content").FormFace({ faceTitle : "#a_weibo_face", cid : "", left : "-5" , top : "5" });
});

</script>

@stop