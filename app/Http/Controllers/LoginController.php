<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\ApiService;

class LoginController extends Controller
{
	private $api;

	public function __construct(ApiService $api){
		$this->theme = env('THEME_STYLE');   //设置主题目录
		$this->api = $api;
	}
	//登陆
	public function login(Request $request){
		$school = $this->api->school;
		if($request->isMethod('post')){
			$username = $request->input('username');
			$password = $request->input('password');
			$data = $this->api->login_in($username,$password);
			if (empty($data['retCode'])) {
				$_SESSION['userId']=$data[0]['id'];
				return redirect('/open/apply/'.$this->api->school.'/index');
			}else{
				return view($this->theme.'.login',compact('school','data'));
			}
		}
		return view($this->theme.'.login',compact('school'));
	}
    //退出
	public function loginOut(){
		session_destroy();
		return redirect('/open/apply/'.$this->api->school.'/index');
	}
}
