<?php
namespace App\Presenters;
use Illuminate\Http\Request;
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
		$html = "<li><a href='{$url}/index' class='hover'>首页</a></li>";
		foreach ($navList as $key => $category) {
			$html .= "<li><a href=''>{$category['name']}</a><ul>";
			foreach ($category['next'] as $k => $val) {
				 $html .= "<li><a href='{$url}/category?type={$k}'>{$val}</a></li>";
			}

			$html .= "</ul></li>";
		}
		if($this->api->judgeCookie()){
			$html .= "<li><a href='{$url}/space'>我的空间</a></li>";
		}
		return  $html;
	}
	public function nav($type,$typeCh){
		$url = '/open/apply/'.$this->api->school;
		$html =  '<li>当前位置 : <a class="no" href="{$url}/index">首页</a></li>';
		$html .= "<li><a href='{$url}/category?type={$type}'>{$typeCh}</a></li>";
		return $html;
	}
	public function sidebar($type){
		$url = '/open/apply/'.$this->api->school;
		$navList = config('category');
		$html = "";
		foreach ($navList as $key => $category) {
			if(array_key_exists($type,$category['next'])){
				$html .= "<h2>{$category['name']}</h2><ul>";
				foreach ($category['next'] as $key => $value) {
				 	$html .= "<li><a href='{$url}/category?type={$key}'>{$value}</a></li>";
				}
				$html .= "</ul>";
			}
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

	public function judgeCookie(){
		return $this->api->judgeCookie();
	}
}