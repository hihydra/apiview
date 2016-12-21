<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\ApiService;

class ApiController extends Controller
{
	private $api;

	public function __construct(ApiService $api){
		$this->theme = env('THEME_STYLE');   //设置主题目录
		$this->api = $api;
	}
	//首页
	public function index(){
		$data = $this->api->loadSchoolIntro(380);
		return view($this->theme.'.index',$data);
	}

	//列表页
	public function category(Request $request){
		$page = $request->input('page',1);
		$type = $request->input('type');
		switch ($type) {
			case 'intro':
				$data = $this->api->loadSchoolIntro();
				return view($this->theme.'.content',$data);
				break;
			case 'orgStruct':
				$data = $this->api->loadSchoolOrgStruct();
				return view($this->theme.'.content',$data);
				break;
			case 'enrollment':
				$data = $this->api->loadSchoolEnrollment();
				return view($this->theme.'.content',$data);
				break;
			case 'recipe':
			    $data = $this->api->loadSchoolRecipes('',$page);
				return view($this->theme.'.list',$data);
				break;
			case 'teacher':
				$data = $this->api->loadTeacherPagePhoto('',$page);
				return view($this->theme.'.photo',$data);
				break;
			case 'TYPE_PHOTO': case 'TYPE_HONOUR':
				$data = $this->api->loadSchoolPagePicture($type,$page);
				return view($this->theme.'.photo',$data);
				break;
			case 'notice':
				$data = $this->api->loadRecentlyNotice();
				return view($this->theme.'.deslist',$data);
				break;
			default:
				$data = $this->api->loadInfo($type,$page);
				return view($this->theme.'.deslist',$data);
				break;
		}
	}
	//文章页
	public function article($id){
		$data = $this->api->article($id);
		return view($this->theme.'.article',$data);
	}
	//通知详情
	public function noticeDetail($id){
		$data = $this->api->noticeDetail($id);
		return view($this->theme.'.article',$data);
	}
	//食谱内容
	public function recipe($id){
		$data = $this->api->recipeDetail($id);
		return view($this->theme.'.article',$data);
	}
	//教师简介
	public function profiles($id){
		$data = $this->api->teacherIntro($id);
		return view($this->theme.'.intro',$data);
	}
	//空间
	public function space($id){
		$data = $this->api->personal($id);
		return view($this->theme.'.space',$data);
	}
	//空间动态
	public function teacherSpace(Request $request,$id){
		$anchor = $request->input('anchor','');
		$data = $this->api->teacherSpace($id,$anchor);
		/*
		$html = "";
		foreach ($data['datas'] as $key => $value) {
		$html .= <<<Eof
		<div class="control-inner" style="height:0px;"></div>
		    <div class="media newMessage">
				<div class="media-body">
				    <p class="messageCon">{$value['c']}</p>
				        <h4 class="media-heading">
				            <ul class="feedbacks pull-right list-inline">
				                <li><a>删除</a></li>
				                <li>|</li>
				                <li><a>赞</a> (<span>{$value['lc']}</span>)</li>
				                <li>|</li>
				                <li><a>评论</a>({$value['cc']})
				                </li>
				            </ul>
				            <ul class="feedbacks pull-left list-inline">
				                <li>{$value['timeStr']}</li>
				            </ul>
				        </h4>
				</div>
		    </div>
		</div>
Eof;
		}
		if($data['hasMore']){
			$html .= '<button id="hasMore" value="'.$data['anchor'].'">点击加载更多</button>';
		}
		$data['datas'] = $html;
		*/
		return $data;
	}
	//空间动态评论
	public function loadComments(Request $request,$id){
		$anchor = $request->input('anchor','');
		$data = $this->api->teacherSpace($id,$anchor);
		return $data;
	}
}