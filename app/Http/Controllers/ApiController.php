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

	public function index($school){
		$this->api->school = $school;
		$data = $this->api->loadSchoolIntro(380);
		return view($this->theme.'.index')->with(compact('data','school'));
	}

	//列表页
	public function list(Request $request,$school,$cate){
		$this->api->school = $school;
		$page = $request->input('page',1);
		switch ($cate) {
			case 'intro':
				$data = $this->api->loadSchoolIntro();
				return view($this->theme.'.content',$data);
				break;
			case 'orgStruct':
				$data = $this->api->loadSchoolOrgStruct();
				return view($this->theme.'.content',$data);
				break;
			case 'recipe':
			    $data = $this->api->loadSchoolRecipes('10',$page);
				return view($this->theme.'.list',$data);
				break;
			case 'teacher':
				$data = $this->api->loadTeacherPagePhoto('9',$page);
				return view($this->theme.'.photo',$data);
				break;
			case 'photo':
				$type = $request->input('type');
				$data = $this->api->loadSchoolPagePicture($type,$page);
				return view($this->theme.'.photo',$data);
				break;
			case 'notice':
				$data = $this->api->loadRecentlyNotice(10);
				return view($this->theme.'.deslist',$data);
				break;
			case 'category':
				$type = $request->input('type');
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
	public function recipe($school,$id){
		$this->api->school = $school;
		$data = $this->api->recipeDetail($id);
		return view($this->theme.'.article',$data);
	}
	//教师简介
	public function profiles($school,$id){
		$this->api->school = $school;
		$data = $this->api->teacherIntro($id);
		return view($this->theme.'.intro',$data);
	}

}
