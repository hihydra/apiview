<?php
namespace App\Presenters;
use App\Service\ApiService;

class ApiPresenter
{
    private $api;

	public function __construct(ApiService $api){
		$this->url = env('API_URL');
		$this->api = $api;
	}

	public function navList($school){
		return <<<Eof
		<ul>
			<li><a href="/open/apply/{$school}/index">园所首页</a></li>
			<li><a href="">园所概况</a>
              <ul>
                <li><a href="/open/apply/{$school}/intro">学校简介</a></li>
                <li><a href="/open/apply/{$school}/orgStruct">机构设置</a></li>
                <li><a href="/open/apply/{$school}/teacher">教师队伍</a></li>
                <li><a href="/open/apply/{$school}/photo?type=TYPE_HONOUR">学校荣誉</a></li>
                <li><a href="/open/apply/{$school}/photo?type=TYPE_PHOTO">校园写真</a></li>
              </ul>
          	</li>
	        <li><a href="">园务信息</a>
	          <ul>
	            <li><a href="/open/apply/{$school}/category?type=TYPE_NEWS">公示公告</a></li>
	            <li><a href="/open/apply/{$school}/category?type=TYPE_PHOTO_NEWS">动态新闻</a></li>
	            <li><a href="/open/apply/{$school}/category?type=TYPE_DEVELOPMENT_PLANNING">发展计划</a></li>
	            <li><a href="/open/apply/{$school}/category?type=TYPE_POLICY">政策法规</a></li>
	            <li><a href="/open/apply/{$school}/category?type=TYPE_HOT_TOPICS">热点专题</a></li>
	          </ul>
		    </li>
		    <li><a href="">教育教学</a>
		        <ul>
		            <li><a href="/open/apply/{$school}/category?type=TYPE_ACADEMIC_ARRANGEMENT">教务安排</a></li>
		            <li><a href="/open/apply/{$school}/category?type=TYPE_SPECIAL_PROGRAMS">特色课程</a></li>
		            <li><a href="/open/apply/{$school}/category?type=TYPE_TEACHING_RESULTS">教学成果</a></li>
		            <li><a href="/open/apply/{$school}/category?type=TYPE_SCIENTIFIC_RESEARCH">科研课题</a></li>
		            <li><a href="/open/apply/{$school}/category?type=">教学资源</a></li>
		        </ul>
		    </li>
			<li><a href="">家校互动</a>
	          <ul>
	            <li><a href="/open/apply/{$school}/notice">学校通知</a></li>
	            <li><a href="/open/apply/{$school}/category?type=TYPE_FAMILY_EDUCATION">家庭教育</a></li>
	            <li><a href="">家校论坛</a></li>
	            <li><a href="">园长信箱</a></li>
	          </ul>
		    </li>
		    <li><a href="">空间管理</a>
	          <ul>
	            <li><a href="">班级空间</a></li>
	            <li><a href="">教师空间</a></li>
	            <li><a href="">家长空间</a></li>
	          </ul>
		    </li>
		    <li><a href="/open/apply/{$school}/recipe">每周食谱</a></li>
	        <li><a href="#">入园报名登记</a></li>
	    </ul>
Eof;
	}

	public function photo($school,$type,$limit){
		$this->api->school = $school;
		$data = $this->api->loadSchoolPagePicture($type,'',$limit);
		return $data;
	}

	public function teacherPhoto($school,$limit){
		$this->api->school = $school;
		$data = $this->api->loadTeacherPagePhoto($limit);
		return $data;
	}

	public function notice($school,$limit,$word=120){
		$this->api->school = $school;
		$data = $this->api->loadRecentlyNotice($limit,$word);
		return $data;
	}

    public function intro($school,$type,$limit,$word=120){
		$this->api->school = $school;
		$data = $this->api->loadInfo($type,'',$limit,$word);
		return $data;
	}

	public function info($school){
		$this->api->school = $school;
		$data = $this->api->loadSchoolInfo();
		return $data;
	}
}