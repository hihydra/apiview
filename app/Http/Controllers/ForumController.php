<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\SpaceService;
use App\Service\ApiService;

class ForumController extends Controller
{
	private $space;
	private $api;

	public function __construct(SpaceService $space,ApiService $api){
		$this->space = $space;
		$this->api = $api;
	}
	public function content(Request $request,$id=1132){
		$pageNo = $request->input('page','');
		$data = $this->space->teacherSpace($id,$pageNo);
		$data['url'] = $this->api->url;
		$data['type'] ='forum';
		$data['typeCh'] ='论坛';
		return view($this->api->theme.'.Forum.content',$data);
	}

}
