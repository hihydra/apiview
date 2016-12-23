<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\ApiService;

class SpaceController extends Controller
{
	private $api;

	public function __construct(ApiService $api){
		$this->theme = env('THEME_STYLE');   //设置主题目录
		$this->api = $api;
	}

	//空间
	public function space(Request $request){
		$id = $request->input('id','');
		$data = $this->api->personal($id);
		return view($this->theme.'.space',$data);
	}
	//空间动态
	public function loadSpace(Request $request){
		$id = $request->input('id','');
		$pageNo = $request->input('pageNo','');
		$data = $this->api->teacherSpace($id,$pageNo);
		$html = "";
		foreach ($data['datas'] as $value) {
			$str = $this->ishtml($value);
			$html .= <<<Eof
			<div id="div_data_{$value['id']}">
				<div class="control-inner" style="height:0px;"></div>
				    <div class="media newMessage">
						<div class="media-body">
						    <p class="messageCon">{$value['c']}</p>
						        <h4 class="media-heading">
						            <ul class="feedbacks pull-right list-inline">
										{$str['delspace']}
						                <li>{$str['hasLike']} (<span id="like_count_{$value['id']}">{$value['lc']}</span>)</li>
						                <li>|</li>
						                <li><a id="a_dynamic_comments_178" href="javascript:comment_click('{$value['id']}');">评论</a>({$value['cc']})
						                </li>
						            </ul>
						            <ul class="feedbacks pull-left list-inline">
						                <li>{$value['timeStr']}</li>
						            </ul>
						        </h4>

									{$str['atthtml']}

									{$str['spacefrom']}

									<div id="div_dynamic_comments_{$value['id']}" class="media-review">
										{$str['commenthtml']}
										{$str['commentmore']}
									</div>
						</div>
				    </div>
				</div>
			</div>
Eof;
		$delhtml = "";
		$commenthtml = "";
		}
		$data['datas'] = $html;

		return $data;
	}
	//发布动态
	public function doAddteacherSpace(Request $request){
		$c = $request->input('c');
		$fname = $request->input('fname');
		$fid = $request->input('fid');
		$ftype = $request->input('ftype');
		$data = $this->api->doAddteacherSpace($c,$fname,$fid,$ftype);
		return $data;
	}
	//删除动态
	public function doDelTeacherSpace(Request $request){
		$id = $request->input('id');
		$data = $this->api->doDelTeacherSpace($id);
		return $data;
	}
	//点赞
	public function doLike(Request $request){
		$id = $request->input('id');
		$data = $this->api->doLike($id);
		return $data;
	}
	//取消赞
	public function doCancelLike(Request $request){
		$id = $request->input('id');
		$data = $this->api->doCancelLike($id);
		return $data;
	}
	//添加评论
	public function addcomment(Request $request){
		$id = $request->input('id');
		$c = $request->input('c');
		$data[] = $this->api->addComment($id,$c);
		$html['datas'] = $this->commenthtml($data);
		$html['retCode'] = 100000;
		return $html;
	}
	//删除评论
	public function delComment(Request $request){
		$id = $request->input('id');
		$data = $this->api->delComment($id);
		return $data;
	}
	//查看评论
	public function loadComment(Request $request){
		$id = $request->input('id');
		$anchor = $request->input('anchor');
		$data = $this->api->loadComment($id,$anchor);
		$data['datas'] = $this->commenthtml($data['datas']);
		return $data;
	}

	//是否有权限操作
	private function ishtml($space){
		if (!empty($space['comments'])) {
			$commenthtml = $this->commenthtml($space['comments']);
		}else{
			$commenthtml = "";
		}
		if(!empty($space['att'])){
			$atthtml = $this->atthtml($space['att'],$space['id']);
		}else{
			$atthtml = "";
		}
		if($space['isOwner']){
	    	$delspace = "<li id=\"delspace\"><a href=\"javascript:doDelTeacherSpaceData('{$space['id']}');\">删除</a></li><li>|</li>";
	    }else{
	    	$delspace = "";
		}

		if(!empty($space['comments'])&&$space['cc']>count($space['comments'])){
			$cmmentCount = $space['cc']-count($space['comments']);
			$commentmore = "<p class=\"more_{$space['id']}\">后面还有{$cmmentCount}条评论，<a href=\"javascript:loadComment('{$space['id']}');\">点击查看<span>&gt;&gt;</span></a></p>";
		}else{
			$commentmore = "";
		}

		if($this->api->judgeCookie()){
			if ($space['hasLike']) {
				$hasLike = "<a id=\"like_{$space['id']}\" href=\"javascript:doCancelLike('{$space['id']}');\">已赞</a>";
			}else{
				$hasLike = "<a id=\"like_{$space['id']}\" href=\"javascript:doLike('{$space['id']}');\">赞</a>";
			}
			$spacefrom = <<<Eof
				<div class="media subMessage hd">
	                <div class="media-body">
	                    <div class="row">
	                        <div class="col-sm-12">
	                            <form method="post" class="form-inline" id="form_comment_{$space['id']}">
	                                <div class="row">
	                                    <div class="col-sm-12 msgBox">
	                                        <textarea rows="30" cols="10" name="c" id="ipt_coment_c_{$space['id']}" placeholder="评论:" onclick="javascript:commentForm_show('{$space['id']}');"></textarea>
	                                    </div>
	                                    <div class="action" id="div_dynamic_comments_commentForm_{$space['id']}" style="display: none;">
	                                      <div class="col-sm-12 right">
	                                      	<input type="hidden" name="id" value="{$space['id']}">
	                                        <input onclick="javascript:doAddComment('{$space['id']}');" class="Btn" type="button" value="确定">
	                                       </div>
	                                      <div class="left">
	                                        <a id="a_comment_face_{$space['id']}" href="javascript:showFaceList('ipt_coment_c_{$space['id']}','a_comment_face_{$space['id']}');"><i class="icon icon-Expression-1"></i></a>
	                                      </div>
	                                    </div>
	                                </div>
	                            </form>
	                        </div>
	                    </div>
	                </div>
	                <div class="clear"></div>
	            </div>
Eof;
		}else{
			$hasLike = "<a id=\"like_{$space['id']}\" href=\"javascript:(0));\">赞</a>";
			$spacefrom = "";
		}
		return array(
			'commenthtml' => $commenthtml,
			'atthtml'     => $atthtml,
			'delspace'    => $delspace,
			'hasLike'     => $hasLike,
			'spacefrom'   => $spacefrom,
			'commentmore' => $commentmore
			);
	}

	//评论
	private function commenthtml($comments){
		$url = $this->api->url;
    	$commenthtml = '';
    	foreach ($comments as $val) {
    		if($val['isOwner']){
	    		$delComment = "<li><a href=\"javascript:doDelComment('{$val['id']}');\">删除</a></li>";
	    	}else{
	    		$delComment = "";
	    	}
    		$commenthtml .= <<<Eof
    		<div class="media-review" id="div_dynamic_comments_{$val['id']}">
              <div class="media subMessage">
                  <div class="media-body">
                    <div class="row">
                        <p>
                            <img src="{$url}/{$val['user']['photoUrl']}" class="imgXsmall media-object">
                        </p>
                        <div class="col-sm-12">
                          <p><a href=""><span class="name text-primary ellipsis">{$val['user']['name']}：</span></a>
                          {$val['c']}({$val['timeStr']})
                          </p>
                        </div>
                        <ul class="feedbacks pull-right list-inline">
							{$delComment}
                        </ul>
                    </div>
                  </div>
             </div>
             </div>
Eof;
    	}
    	//$commenthtml .= "</div>";
	    return  $commenthtml;
	}
	//上传图片
	private function atthtml($att,$id){
		$url = $this->api->url;
		$rotateLeft = '{'."$('#div_img_{$id}_l_img').rotateLeft(90);".'}';
		$rotateRight = '{'."$('#div_img_{$id}_l_img').rotateRight(90);".'}';
		$atthtml = <<<Eof
		<div id="div_img_{$id}_s" class="subMessage-img-min">
			<img onclick="javascript:zoomIn('div_img_{$id}_s','div_img_{$id}_l','{$url}/attachment/photo/weibo_l/{$att['hash']}/{$att['id']}.jpg')" src="{$url}/attachment/photo/weibo_s/{$att['hash']}/{$att['id']}.jpg">
		</div>

		<div id="div_img_{$id}_l" style="display: none;" class="media subMessage">
			<ul class="feedbacks list-inline">
				<li><a href="javascript:zoomOut('div_img_{$id}_s','div_img_{$id}_l');">
					<i class="icon icon-Put-away "></i> 收起</a></li>
				<li><a target="_blank" href="{$url}/attachment/photo/source/{$att['hash']}/{$att['id']}.jpg"><i class="icon icon-Amplification"></i> 查看大图</a></li>
				<li><a href="javascript:{$rotateLeft}"><i class="icon icon-Towards-left"></i> 向左转</a></li>
				<li><a href="javascript:{$rotateRight}"><i class="icon icon-Towards-right"></i> 向右转</a></li>
			</ul>
			<div class="clear"></div>
			<div class="subMessage-img">
			<img id="div_img_{$id}_l_img">
			</div>
		</div>
Eof;
		return $atthtml;
	}

}
