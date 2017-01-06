@if(!empty($datas))
	@foreach($datas as $data)
	<div id="div_data_{{$data['id']}}">
		<div class="control-inner" style="height:0px;"></div>
		<div class="media newMessage">
		    <!--
	    		<a title="肖洁" href="javascript:void(0);" class="pull-left">
					<img class="imgSmall media-object" src="http://111.47.13.92:9004/resource/front/images/default_l.jpg" title="肖洁">
				</a>
			-->
			<div class="media-body">
				<div class="media-content left">
					<!--
						<a href="javascript:void(0);"><span class="name text-primary ellipsis">肖洁</span></a>
						<span class="forGroup"><i class="icon icon-group"></i><a href="javascript:void(0);">小一班</a></span>
					-->
					<p class="messageCon">{{$data['c']}}</p>
				</div>
			</div>
			<div class="clear"></div>
			<h4 class="media-heading">
				<ul class="feedbacks pull-right list-inline">
					@if($isLogin)
						<li id="delspace"><a href="javascript:doDelTeacherSpaceData('{{$data['id']}}');">删除</a></li><li>|</li>
						@if($data['hasLike'])
							<li><a id="like_{{$data['id']}}" href="javascript:doCancelLike('{{$data['id']}}');">已赞</a>
						@else
							<li><a id="like_{{$data['id']}}" href="javascript:doLike('{{$data['id']}}');">赞</a>
						@endif
					@else
						<li><a id="like_{{$data['id']}}" href="javascript:(0);">赞</a>
					@endif
					(<span id="like_count_{{$data['id']}}">{{$data['lc']}}</span>)</li><li>|</li>
					<li><a id="a_dynamic_comments_{{$data['id']}}" href="javascript:comment_click('{{$data['id']}}');">评论</a>({{$data['cc']}})</li>
				</ul>
				<ul class="feedbacks pull-left list-inline">
					<li>{{$data['timeStr']}}</li>
				</ul>
			</h4>
			<div class="media-comment">
				@if((!empty($data['att'])))
				<div id="div_img_{{$data['id']}}_s" class="subMessage-img-min">
					<img onclick="javascript:zoomIn('div_img_{{$data['id']}}_s','div_img_{{$data['id']}}_l','{{$url}}/attachment/photo/weibo_l/{{$data['att']['hash']}}/{{$data['att']['id']}}.jpg')" src="{{$url}}/attachment/photo/weibo_s/{{$data['att']['hash']}}/{{$data['att']['id']}}.jpg">
				</div>
				<div id="div_img_{{$data['id']}}_l" style="display: none;" class="media subMessage">
					<ul class="feedbacks list-inline">
						<li><a href="javascript:zoomOut('div_img_{{$data['id']}}_s','div_img_{{$data['id']}}_l');">
							<i class="icon icon-Put-away "></i> 收起</a></li>
						<li><a target="_blank" href="{{$url}}/attachment/photo/source/{{$data['att']['hash']}}/{{$data['att']['id']}}.jpg"><i class="icon icon-Amplification"></i> 查看大图</a></li>
						<li><a href="javascript:$('#div_img_{{$data['id']}}_l_img').rotateLeft(90);"><i class="icon icon-Towards-left"></i> 向左转</a></li>
						<li><a href="javascript:$('#div_img_{{$data['id']}}_l_img').rotateRight(90);"><i class="icon icon-Towards-right"></i> 向右转</a></li>
					</ul>
					<div class="clear"></div>
					<div class="subMessage-img">
						<img id="div_img_{{$data['id']}}_l_img">
					</div>
				</div>
				@endif

				@if($isLogin)
				<div class="media subMessage hd">
					<div class="media-body">
						<div class="row">
							<div class="col-sm-12">
								<form method="post" class="form-inline" id="form_comment_{{$data['id']}}">
									<div class="row">
										<div class="col-sm-12 msgBox">
											<textarea rows="30" cols="10" name="c" id="ipt_coment_c_{{$data['id']}}" placeholder="评论:" onclick="javascript:commentForm_show('{{$data['id']}}');"></textarea>
										</div>
										<div class="action" id="div_dynamic_comments_commentForm_{{$data['id']}}" style="display: none;">
											<div class="col-sm-12 right">
												<input type="hidden" name="id" value="{{$data['id']}}">
												<input onclick="javascript:doAddComment('{{$data['id']}}');" class="Btn" type="button" value="确定">
											</div>
											<div class="left">
												<a id="a_comment_face_{{$data['id']}}" href="javascript:showFaceList('ipt_coment_c_{{$data['id']}}','a_comment_face_{{$data['id']}}');"><i class="icon icon-Expression-1"></i></a>
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

				@if (!empty($data['comments']))
					<div id="div_dynamic_comments_{{$data['id']}}">
					@include('green.space.comment',['comments' => $data['comments']])
					@if ($data['cc']>count($data['comments']))
							<p class="media-review more_{{$data['id']}}">后面还有{{$data['cc']-count($data['comments'])}}条评论，
							<a href="javascript:loadComment('{{$data['id']}}');">点击查看<span>&gt;&gt;</span></a></p>";
						</div>
					@endif
				@else
					<div id="div_dynamic_comments_{{$data['id']}}"></div>
				@endif

			</div>
		</div>
	</div>
	@endforeach
@else
	<center>还没有发布动态</center>
@endif