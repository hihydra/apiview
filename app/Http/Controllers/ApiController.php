<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\ApiService;

class ApiController extends Controller
{
	private $api;

	public function __construct(ApiService $api){
		$this->api = $api;
	}

	//首页
	public function index(){
		$data = $this->api->loadSchoolIntro(380);
		return view($this->api->theme.'.index',$data);
	}

	//列表页
	public function category(Request $request){
		$page = $request->input('page',1);
		$type = $request->input('type');
		switch ($type) {
			case 'intro':
				$data = $this->api->loadSchoolIntro();
				return view($this->api->theme.'.content',$data);
				break;
			case 'orgStruct':
				$data = $this->api->loadSchoolOrgStruct();
				return view($this->api->theme.'.content',$data);
				break;
			case 'enrollment':
				$data = $this->api->loadSchoolEnrollment();
				return view($this->api->theme.'.content',$data);
				break;
			case 'recipe':
			    $data = $this->api->loadSchoolRecipes('',$page);
				return view($this->api->theme.'.recipe',$data);
				break;
			case 'teacher':
				$data = $this->api->loadTeacherPagePhoto('',$page);
				return view($this->api->theme.'.photo',$data);
				break;
			case 'TYPE_PHOTO': case 'TYPE_HONOUR':
				$data = $this->api->loadSchoolPagePicture($type,$page);
				return view($this->api->theme.'.photo',$data);
				break;
			case 'notice':
				$data = $this->api->loadRecentlyNotice();
				return view($this->api->theme.'.deslist',$data);
				break;
			case 'mailbox':
				$data = $this->api->loadChildStar($page);
				return view($this->api->theme.'.mailbox',$data);
				break;
			case 'forum':
			    $data = $this->api->loadSchoolRecipes('',$page);
				return view($this->api->theme.'.forum.list',$data);
				break;
			default:
				$data = $this->api->loadInfo($type,$page);
				return view($this->api->theme.'.deslist',$data);
				break;
		}
	}
	//文章页
	public function article($id){
		$data = $this->api->article($id);
		return view($this->api->theme.'.article',$data);
	}
	//通知详情
	public function noticeDetail($id){
		$data = $this->api->noticeDetail($id);
		return view($this->api->theme.'.article',$data);
	}
	//食谱内容
	public function recipe($id){
		$data = $this->api->recipeDetail($id);
		return view($this->api->theme.'.article',$data);
	}
	//教师简介
	public function profiles($id){
		$data = $this->api->teacherIntro($id);
		return view($this->api->theme.'.intro',$data);
	}
	//院长信箱
	public function saveMaibox(Request $request){
		/*
		$this->validate($request, [
	        'title'   => 'required|min:3|max:40',
	        'content' => 'required|min:3|max:500'
	    ]);
	    */
		$captcha = $request->get('captcha');

		if($this->check($captcha)) {
			$form = $request->all();
			$data = $this->api->saveChildStar($form);
			return $data;
		} else {
			return response()->json(array( 'retCode' => 200004));
		}
	}

	//上传图片
	public function uploadPhoto(Request $request){
		$file = $request->file('file');
		if ($file->isValid()) {
			$filedir="upload/images/";
			$imagesName=$file->getClientOriginalName();
			$fileMove = $file->move($filedir,$imagesName);
			$filePath = base_path().'\public\\'.str_replace('/','\\',$filedir.$imagesName);
			$data = $this->api->uploadPhoto($filePath);
			return $data;
		}
	}

}