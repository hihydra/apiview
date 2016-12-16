<?php
namespace App\Presenters;
use App\Service\ApiService;

class ApiPresenter
{
    private $api;

	public function __construct(ApiService $api){
		$this->api = $api;
	}

	public function navList(){
		$url = '/open/apply/'.$this->api->school;
		$navList = config('category');
		$html = "<li><a href='{$url}/index'>首页</a></li>";
		foreach ($navList as $category) {
			$html .= "<li><a href=''>{$category['name']}</a><ul>";
			foreach ($category['next'] as $key => $value) {
				 $html .= "<li><a href='{$url}/category?type={$key}'>{$value}</a></li>";
			}

			$html .= "</ul></li>";
		}
		return  $html;
	}

	public function photo($type,$limit){
		$data = $this->api->loadSchoolPagePicture($type,'',$limit);
		return $data;
	}

	public function teacherPhoto($limit){
		$data = $this->api->loadTeacherPagePhoto($limit);
		return $data;
	}

	public function notice($limit,$word=120){
		$data = $this->api->loadRecentlyNotice($limit,$word);
		return $data;
	}

    public function intro($type,$limit,$word=120){
		$data = $this->api->loadInfo($type,'',$limit,$word);
		return $data;
	}

	public function info(){
		$data = $this->api->loadSchoolInfo();
		return $data;
	}
}