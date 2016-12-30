@extends('green.layouts')
@section('css')
<link rel="stylesheet" href="/assets/green/css/jquery.Jcrop.css" type="text/css" />
@stop
@section('content')
<div class="pf_head">
    <div class="pf_head_pic">
      <li><img id="img_userPhoto" src="{{$img}}"></li>
      @if($isOwner)
      <div id="div_photoEdit" class="change_btn_div">
          <a class="W_btn_c" href="javascript:showPhotoEdit();">
            <span>更换头像</span>
          </a>
      </div>
      @endif
    </div>
  <span class="title-text">{{$name}}
  【@if($typeStr == 'SCHOOL_RECTOR')园长@elseif($typeStr == 'SCHOOL_TEACHER')教师@elseif($typeStr == 'SCHOOL_STUDENT')家长@endif】</span>
  <div class="sitedesc">
  @if(!empty($classs))
    @foreach($classs as $class)
      {{$class['name']}}
    @endforeach
  @endif
  </div>
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
    <li><a href="/open/apply/{{$orgId}}/space">空间动态</a></li>
    <li><a href="/open/apply/{{$orgId}}/rePassword">修改密码</a></li>
  </ul>
</div>
@yield('spaceContent')
@stop
@section('script')
<script type="text/javascript" src="/assets/green/js/jquery.Jcrop.js"></script>
<script type="text/javascript" src="/assets/green/js/photoPreview.js"></script>
<script type="text/javascript" src="/assets/green/js/utils.js"></script>
<script type="text/javascript" src="/assets/green/js/global.js"></script>
<script type="text/javascript">
var url = window.location.pathname;
  $(".nav").find("a[class='hover']").removeClass();
  var nav = $(".nav").find("a[href='" + url + "']");
  nav.addClass("hover");
  $(".three_2").find("a[href='" + url + "']").addClass("hover");
</script>
@stop