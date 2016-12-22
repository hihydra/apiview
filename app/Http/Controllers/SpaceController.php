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
	public function space($id){
		$data = $this->api->personal($id);
		return view($this->theme.'.space',$data);
	}
	//空间动态
	public function load(Request $request){
		$id = $request->input('id');
		$pageNo = $request->input('pageNo','');
		$data = $this->api->teacherSpace($id,$pageNo);

		$html = "";
		foreach ($data['datas'] as $value) {
			if (!empty($value['comments'])) {
				$commenthtml = $this->commenthtml($value['comments']);
			}else{
				$commenthtml = "";
			}
			if ($value['hasLike']) {
				$hasLike = "<a id=\"like_{$value['id']}\" href=\"javascript:doCancelLike('{$value['id']}');\">已赞</a>";
			}else{
				$hasLike = "<a id=\"like_{$value['id']}\" href=\"javascript:doLike('{$value['id']}');\">赞</a>";
			}
			$html .= <<<Eof
			<div id="div_data_{$value['id']}">
				<div class="control-inner" style="height:0px;"></div>
				    <div class="media newMessage">
						<div class="media-body">
						    <p class="messageCon">{$value['c']}</p>
						        <h4 class="media-heading">
						            <ul class="feedbacks pull-right list-inline">
										<li><a href="javascript:doDelTeacherSpaceData('{$value['id']}')">删除</a></li><li>|</li>
						                <li>{$hasLike} (<span id="like_count_{$value['id']}">{$value['lc']}</span>)</li>
						                <li>|</li>
						                <li><a>评论</a>({$value['cc']})
						                </li>
						            </ul>
						            <ul class="feedbacks pull-left list-inline">
						                <li>{$value['timeStr']}</li>
						            </ul>
						        </h4>

						            <div class="media subMessage hd">
						                <div class="media-body">
						                    <div class="row">
						                        <div class="col-sm-12">
						                            <form method="post" class="form-inline" id="form_comment_{$value['id']}">
						                                <div class="row">
						                                    <div class="col-sm-12 msgBox">
						                                        <textarea rows="30" cols="10" name="c" id="ipt_coment_c_{$value['id']}" placeholder="评论:"></textarea>
						                                    </div>
						                                    <div class="action">
						                                      <div class="col-sm-12 right">
						                                      	<input type="hidden" name="id" value="{$value['id']}">
						                                        <input onclick="javascript:doAddComment('{$value['id']}');" class="Btn" type="button" value="确定">
						                                       </div>
						                                      <div class="left">
						                                        <a id="a_comment_face_{$value['id']}" href="javascript:showFaceList('ipt_coment_c_{$value['id']}','a_comment_face_{$value['id']}');"><i class="icon icon-Expression-1"></i></a>
						                                      </div>
						                                    </div>
						                                </div>
						                            </form>
						                        </div>
						                    </div>
						                </div>
						                <div class="clear"></div>
						            </div>
									<div id="div_dynamic_comments_{$value['id']}"></div>
									{$commenthtml}
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
	private function commenthtml($comments){
    	$commenthtml = '';
    	foreach ($comments as $val) {
    		$commenthtml .= <<<Eof
    		<div class="media-review" id="div_dynamic_comments_{$val['id']}">
              <div class="media subMessage">
                  <div class="media-body">
                    <div class="row">
                        <p>
                            <img src="http://xq.wuhaneduyun.cn/attachment/userPhoto/715.jpg" class="imgXsmall media-object">
                        </p>
                        <div class="col-sm-12">
                          <p><a href=""><span class="name text-primary ellipsis">{$val['user']['name']}：</span></a>
                          {$val['c']}({$val['timeStr']})
                          </p>
                        </div>
                        <ul class="feedbacks pull-right list-inline">
                            <li><a href="javascript:doDelComment('{$val['id']}');">删除</a></li>
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
	//空间动态评论
	public function loadComments(Request $request,$id){
		$anchor = $request->input('anchor','');
		$data = $this->api->teacherSpace($id,$anchor);
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

}
