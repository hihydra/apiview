@inject('apiPresenter','App\Presenters\ApiPresenter')
@extends('green.layouts')
@section('title')论坛测试-@stop
@section('content')
@section('headScript')
<script type="text/javascript" src="/assets/green/js/jquery.rotate.1-1.js"></script>
<script type="text/javascript" src="/assets/green/js/utils.js"></script>
<script type="text/javascript" src="/assets/green/js/space.js"></script>
@stop
@include('green.sidebar')
<div class="three_l zixun_left">
  <div class="three_con clearfix">
    <div class="clearfix">
      <div class="spaceCate">
        <h3>论坛</h3>
      </div>

      <div id="vlist">
        <div class="busbox">
          @foreach($datas as $value)
          <div id="div_data_{{$value['id']}}">
            <div class="control-inner" style="height:0px;"></div>
            <div class="media newMessage">
              <a title="肖洁" href="javascript:void(0);" class="pull-left">
                <img class="imgSmall media-object" src="http://111.47.13.92:9004/resource/front/images/default_l.jpg" title="肖洁">
              </a>
              <div class="media-body">
                <div class="media-content left">
                  <a href="javascript:void(0);"><span class="name text-primary ellipsis">肖洁</span></a>
                  <p class="messageCon">{{$value['c']}}</p>
                </div>
              </div>
              <div class="clear"></div>
              <h4 class="media-heading">
                <ul class="feedbacks pull-right list-inline">
                  @if($value['isOwner'])
                  <li id="delspace"><a href="javascript:doDelTeacherSpaceData('{{$value['id']}}');">删除</a></li><li>|</li>
                  @endif
                  <li><a id="a_dynamic_comments_{{$value['id']}}" href="javascript:comment_click('{{$value['id']}}');">回复</a>({{$value['cc']}})</li>
                </ul>
                <ul class="feedbacks pull-left list-inline">
                  <li>{{$value['timeStr']}}</li>
                </ul>
              </h4>

              <div class="media-comment">
                @if($apiPresenter->judgeCookie())
                <div class="media subMessage hd">
                  <div class="media-body">
                    <div class="row">
                      <div class="col-sm-12">
                        <form method="post" class="form-inline" id="form_comment_{{$value['id']}}">
                          <div class="row">
                            <div class="col-sm-12 msgBox">
                              <textarea rows="30" cols="10" name="c" id="ipt_coment_c_{{$value['id']}}" placeholder="回复:" onclick="javascript:commentForm_show('{{$value['id']}}');"></textarea>
                            </div>
                            <div class="action" id="div_dynamic_comments_commentForm_{{$value['id']}}" style="display: none;">
                              <div class="col-sm-12 right">
                                <input type="hidden" name="id" value="{{$value['id']}}">
                                <input onclick="javascript:doAddComment('{{$value['id']}}');" class="Btn" type="button" value="确定">
                              </div>
                              <div class="left">
                                <a id="a_comment_face_{{$value['id']}}" href="javascript:showFaceList('ipt_coment_c_{{$value['id']}}','a_comment_face_{{$value['id']}}');"><i class="icon icon-Expression-1"></i></a>
                              </div>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <div class="clear"></div>
                </div>
                @endif
                <div id="div_dynamic_comments_{{$value['id']}}">
                  @foreach($value['comments'] as $val)
                  <div class="media-review" id="div_dynamic_comments_{{$val['id']}}">
                    <div class="media subMessage">
                      <div class="media-body">
                        <div class="row">
                          <p>
                            <img src="{{$url}}/{{$val['user']['photoUrl']}}" class="imgXsmall media-object">
                          </p>
                          <div class="col-sm-12">
                            <p><a href=""><span class="name text-primary ellipsis">{{$val['user']['name']}}：</span></a>
                             {{$val['c']}}({{$val['timeStr']}})
                           </p>
                         </div>
                         <ul class="feedbacks pull-right list-inline">
                          @if($val['isOwner'])
                          <li><a href="javascript:doDelComment('{{$val['id']}}');">删除</a></li>
                          @endif
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach

                @if ($value['cc']>count($value['comments']))
                <p class="media-review more_{{$value['id']}}">后面还有{{$value['cc']-count($value['comments'])}}条回复，<a href="javascript:loadComment('{{$value['id']}}');">点击查看<span>&gt;&gt;</span></a></p>
                @endif

              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>

    <div class="turnPage">
     @include('vendor.pagination')
   </div>

   <div class="poster">
    <div class="spaceCate">
      <h3>回复</h3>
    </div>
    <div class="poster-from">
      <form class="saveMaibox">
        <div class="content item">
         @if(!$apiPresenter->judgeCookie())
         <div class="area">
          <div class="pt hm">
            您需要登录后才可以回帖 <a href="" class="login_xt">登录</a>
          </div>
        </div>
        @endif
        <script id="container" name="content" type="text/plain">
        </script>
      </div>
      <div class="item">
        <input type="text" name="captcha" style="width:100px;" placeholder="请输入验证码...">
        <a onclick="javascript:re_captcha();" ><img src="{{ URL('captcha/1') }}"  alt="验证码" title="刷新图片" width="100" height="30" id="captcha" border="0"></a>
        <button class="Btn" type="button" onclick="javascript:saveMaibox();">回复</button>
      </div>
    </form>
  </div>
</div>

</div>
</div>
</div>
@stop
@section('script')
<script type="text/javascript" src="/assets/public/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="/assets/public/ueditor/ueditor.all.min.js"></script>
<script type="text/javascript">
  var ue = UE.getEditor('container',{
    initialFrameHeight: 300,
    @if(!$apiPresenter->judgeCookie())
    readonly : true,
    @endif
  });
  $('.login_xt').attr('href',ctx+'/login');
  function re_captcha() {
    $url = "{{ URL('/captcha') }}";
    $url = $url + "/" + Math.random();
    $('#captcha').attr('src',$url);
  }
</script>
@stop