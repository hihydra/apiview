@extends('green.layouts')
@section('title')空间-@stop
@section('content')
<div class="pf_head">
  <div class="pf_head_pic">
    <li><img src="{{$img}}" width="120px" height="120px"></li>
  </div>
  <span class="title-text">{{$name}} 【{{$typeStr == 'SCHOOL_RECTOR'?'园长':'教师'}}】</span>
</div>
<div class="clear"></div>
<div class="three_2">
  <ul>
    <li><a href='/open/apply/32/category?type=intro'>空间动态</a></li>
    <li><a href='/open/apply/32/category?type=orgStruct'>机构设置</a></li>
    <li><a href='/open/apply/32/category?type=enrollment'>招生信息</a></li>
    <li><a href='/open/apply/32/category?type=teacher'>教师队伍</a></li>
  </ul>
</div>
<div class="three_l zixun_left">
  <div class="three_con clearfix">
    <div class="clearfix">
      <div class="qz-poster">
        <form method="post">
        <input type="hidden" id="ipt_form_ftype" name="ftype" value="NONE">
        <input type="hidden" id="ipt_form_fid" name="fid">
        <input type="hidden" id="ipt_form_fname" name="fname">
        <textarea  placeholder="我想说的是..." tabindex="1" name="c"></textarea>
        <input class="Btn" type="button" value="发表">
        </form>
      </div>


      <div id="vlist">
        <div class="busbox">
          <div class="control-inner" style="height:0px;"></div>
          <div class="media newMessage">
            <div class="media-body">
                <p class="messageCon c"></p>
                    <h4 class="media-heading">
                        <ul class="feedbacks pull-right list-inline">
                            <li><a class="isOwner">删除|</a></li>
                            <li>|</li>
                            <li><a>赞</a> (<span class="lc"></span>)</li>
                            <li>|</li>
                            <li><a>评论</a>(<span class="cc"></span>)</li>
                        </ul>
                        <ul class="feedbacks pull-left list-inline">
                            <li class="timeStr"></li>
                        </ul>
                    </h4>
              </div>
            <div class="media-review">

                <div class="media subMessage comment">
                    <div class="media-body">
                      <div class="row">
                          <p>
                              <img src="http://xq.wuhaneduyun.cn/attachment/userPhoto/715.jpg" class="imgXsmall media-object">
                          </p>
                          <div class="col-sm-12">
                            <p>
                              <a href=""><span class="name text-primary ellipsis">刘潮：</span></a>
                              <ll class="c"> </ll>
                            </p>
                          </div>
                          <ul class="feedbacks pull-right list-inline">
                              <li><a href="">删除</a></li>
                          </ul>
                      </div>
                    </div>
                </div>

              </div>
            </div>
          </div>
          <div id="get_more" class="txtcent button ft12">点击加载更多</div>
      </div>


    </div>
 </div>
 @stop
@section('script')

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
<!--
<script type="text/javascript">
$(document).ready(function(){
  var methods = {
    get_data: function() {
        $.ajax({url: "/open/apply/32/teacherSpace/1132",
          data:{anchor:anchor},
          type: 'GET',
          error: function(){},
          success: function(data){

          }
        });
      },
    add_elements:function(data){
        $(data).each(function() {
            var t = $(.busbox).html();
            $.each(this, function(key, value) {
                if (t.find('.' + key))
                    t.find('.' + key).html(value);
            });
       });
    }
  };
}
</script>
-->
@stop