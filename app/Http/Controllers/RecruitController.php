<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\ApiService;

class RecruitController extends Controller
{
	private $api;

	public function __construct(ApiService $api){
		$this->api = $api;
	}
	//招生
	public function recruit(){
		$data = $this->api->recruitCheck();
		return view($this->api->theme.'.recruit',$data);
	}
	public function recruitCheck(){
		$data = $this->api->recruitCheck();
		return $data;

	}
	public function recruitLoad(Request $request){
		$regionId = $request->input('regionId');
		$data = $this->api->recruitLoad($regionId);
		return $data;
	}
	public function recruitSave(Request $request){
		$data = $this->api->recruitSave($request->all());
		return $data;
	}

}
