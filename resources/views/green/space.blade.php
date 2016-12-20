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


      <div class="control-inner" style="height:0px;"></div>
      <div class="media newMessage">
        <div class="media-body">
            <p class="messageCon">在我们班上，有一部分家里大部分是由老人陪伴看护的孩子。比如韩梁锦妍，小名凉爽。听外婆说父母很少时间陪她，所以凉爽她特别的依赖外婆。也是由于父母陪伴的少，所以凉爽很怕老师会不喜欢她。让我觉得孩子很珍惜很想拥有老师的爱与关怀</p>
                <h4 class="media-heading">
                    <ul class="feedbacks pull-right list-inline">
                        <li><a>删除</a></li>
                        <li>|</li>
                        <li><a>赞</a> (<span>0</span>)</li>
                        <li>|</li>
                        <li><a>评论</a>(0)
                        </li>
                    </ul>
                    <ul class="feedbacks pull-left list-inline">
                        <li>3秒钟前</li>
                    </ul>
                </h4>
            <div class="media subMessage hd">
                <div class="media-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <form method="post" class="form-inline">
                                <div class="row">
                                    <div class="col-sm-12 msgBox">
                                        <textarea rows="30" cols="10" placeholder="评论:"></textarea>
                                    </div>
                                    <div class="action">
                                      <div class="col-sm-12 right">
                                        <input class="Btn" type="button" value="确定">
                                       </div>
                                      <div class="left">
                                        <a><i class="icon icon-Expression-1"></i></a>
                                      </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="media-review">



              <div class="media subMessage">
                  <div class="media-body">
                    <div class="row">
                        <p>
                            <img src="http://xq.wuhaneduyun.cn/attachment/userPhoto/715.jpg" class="imgXsmall media-object">
                        </p>
                        <div class="col-sm-12">
                          <p><a href=""><span class="name text-primary ellipsis">刘潮：</span></a>      当对方对忠贞产生质疑，其实是对未来的担忧。永远不要花精力和口舌去对忠贞做名词解释，只要轻轻地说，我离不开你，一辈子。于是安心了，一辈子了。(01-18 09:15)
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


    </div>
    <div class="control-inner" style="height:0px;"></div>
    </div>
  </div>
 </div>
 @stop
@section('script')
<script type="text/javascript" src="/assets/green/js/jquery.more.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $.ajax({url: "http://111.47.13.92:9004/teacherSpace/load",
        data:{pageNo:1,teacherId:1132},
        type: 'GET',
        dataType:'jsonp',
        error: function(){},
        success: function(json){
            if (json.retCode==100000){

            } else {

            }
        }
    });
});
</script>
@stop