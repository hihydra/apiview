<?php
namespace App\Service;
use App\Service\BaseService;

class ApiService extends BaseService
{
	public $school;

	public function __construct(){
        $this->url = env('API_URL');
		$this->client = new \GuzzleHttp\Client(['base_uri' => env('API_URL')]);  //api接口地址
	}
    //基本信息
    public function loadSchoolInfo(){
        $path  = '/open/school/'.$this->school.'/loadSchoolInfo';
        $query = array();
        $body = $this->result($path,$query);
        $body['logoUrl'] = $this->url.'/'.$body['logoUrl'];
        return $body;
    }
	//学校简介
    public function loadSchoolIntro($word=''){
		$path  = '/open/school/'.$this->school.'/loadSchoolIntro';
		$query = array('word'=>$word);
        $body['content'] = $this->result($path,$query);
        $body['cateName'] = '学校简介';
		return $body;
    }
    //机构设置
    public function loadSchoolOrgStruct($word=''){
        $path  = '/open/school/'.$this->school.'/loadSchoolOrgStruct';
        $query = array('word'=>$word);
        $body['content'] = $this->result($path,$query);
        $body['cateName'] = '机构设置';
        return $body;
    }
    //招生信息
    public function loadSchoolEnrollment($word){
		$path  = '/open/school/'.$this->school.'/loadSchoolEnrollment';
		$query = array('word'=>$word);
		$body['content'] = $this->result($path,$query);
        $body['cateName'] = '招生信息';
		return $body;
    }
    //教师队伍
    public function loadTeacherPagePhoto($limit=9,$pageNo=1){
    	$path = 'spaceList/load';
    	$query = array('anchor'=>$pageNo,'orgId'=>$this->school);
		$body = $this->result($path,$query);
        foreach ($body['datas'] as &$value) {
            $value['url'] = "/open/apply/".$this->school."/teacherIntro/{$value['id']}";
            $value['img'] = $this->url.'/'.$value['photoUrl'];
        }
        $body['cateName'] = '教师队伍';
		return $body;
    }
    //老师简介
    public function teacherIntro($id){
    	$path = '/open/school/'.$this->school.'/teacherIntro/ajax';
    	$query = array('id'=>$id);
		$body['content'] = $this->result($path,$query);
        $body['cateName'] = '教师简介';
		return $body;
    }
    /*
   	type： 学校写真(TYPE_PHOTO),学校荣誉(TYPE_HONOUR)
    */
    public function loadSchoolPagePicture($type,$pageNo=1,$limit =9){
    	$path = '/open/school/'.$this->school.'/loadSchoolPicturePage';
    	$query = array('type'=>$type,'pageNo'=>$pageNo,'limit'=>$limit);
		$body = $this->result($path,$query);
        foreach ($body['datas'] as &$value) {
            $value['img'] = $value['url'] = $this->url."/open/school/0/photo/{$value['hash']}/{$value['id']}.jpg";
        }
        $body['type'] = $type;
        switch ($type) {
            case 'TYPE_PHOTO':
                $body['cateName'] = '校园写真';
                break;
            case 'TYPE_HONOUR':
                $body['cateName'] = '学校荣誉';
                break;
        }
		return $body;
    }
    /*列表页
     *type:
        TYPE_PHOTO_NEWS//图片新闻
        TYPE_PHOTO_ACTIVITY//活动图片

        TYPE_DEVELOPMENT_PLANNING//发展计划
        TYPE_HOT_TOPICS//热点专题
        TYPE_ACADEMIC_ARRANGEMENT//教务安排
        TYPE_SPECIAL_PROGRAMS//特色课程
        TYPE_TEACHING_RESULTS//教学成果
        TYPE_SCIENTIFIC_RESEARCH//科研课题
        TYPE_NEWS//活动动态
        TYPE_POLICY//政策文件
    */
    public function loadInfo($type,$pageNo=1,$limit=6,$word=80){
        $path = '/open/school/'.$this->school.'/loadInfo';
        $query = array('type'=>$type,'pageNo'=>$pageNo,'limit'=>$limit,'word'=>$word);
        $body = $this->result($path,$query);
        foreach ($body['datas'] as &$value) {
            if($type == 'TYPE_PHOTO_NEWS' || $type == 'TYPE_PHOTO_ACTIVITY'){
                $value['img'] = $this->url."/attachment/photo/source/{$value['faceHash']}/{$value['faceId']}.jpg";
            }
            $value['url'] = "/open/info/{$value['id']}";
        }
        $body['type'] = $type;
        switch ($type) {
            case 'TYPE_PHOTO_NEWS':
                $body['cateName'] = '动态新闻';
                break;
            case 'TYPE_PHOTO_ACTIVITY':
                $body['cateName'] = '活动图片';
                break;
            case 'TYPE_DEVELOPMENT_PLANNING':
                $body['cateName'] = '发展计划';
                break;
            case 'TYPE_HOT_TOPICS':
                $body['cateName'] = '热点专题';
                break;
            case 'TYPE_ACADEMIC_ARRANGEMENT':
                $body['cateName'] = '教务安排';
                break;
            case 'TYPE_SPECIAL_PROGRAMS':
                $body['cateName'] = '特色课程';
                break;
            case 'TYPE_TEACHING_RESULTS':
                $body['cateName'] = '教学成果';
                break;
            case 'TYPE_SCIENTIFIC_RESEARCH':
                $body['cateName'] = '科研课题';
                break;
            case 'TYPE_NEWS':
                $body['cateName'] = '公示公告';
                break;
            case 'TYPE_POLICY':
                $body['cateName'] = '政策法规';
                break;
            case 'TYPE_FAMILY_EDUCATION':
                $body['cateName'] = '家庭教育';
                break;
        }
        return $body;
   }
    //内容页
    public function article($id){
        $path = '/open/info/'.$id;
        $query = array();
        $body = $this->result($path,$query);
        return $body;
    }

    //通知公告
    public function loadRecentlyNotice($limit=6,$word=80){
        $path = '/open/school/'.$this->school.'/loadRecentlyNotice';
        $query = array('limit'=>$limit,'word'=>$word);
        $body = $this->result($path,$query);
        foreach ($body as &$value) {
            $value['url'] = "/open/noticeDetail/{$value['id']}";
        }
        $data['datas'] = $body;
        $data['cateName'] = '学校通知';
        return $data;
    }
    //通知详情
    public function noticeDetail($id){
        $path = '/open/notice/'.$id;
        $query = array();
        $body = $this->result($path,$query);
        if(!empty($body['atts'])){
            foreach ($body['atts'] as &$value) {
                $value['url'] = $this->url."/attachment/download/{$value['hash']}/{$value['id']}";
            }
        }
        return $body;
    }

    //每周食谱
    public function loadSchoolRecipes($limit=8,$pageNo=1){
    	$path = '/open/school/'.$this->school.'/loadSchoolRecipe';
    	$query = array('pageNo'=>$pageNo,'limit'=>$limit);
		$body = $this->result($path,$query);
        foreach ($body['datas'] as &$value) {
            $value['url'] = "/open/apply/".$this->school."/recipe/{$value['id']}";
        }
        $body['cateName'] = '每周食谱';
		return $body;
    }
    //食谱内容
    public function recipeDetail($id){
    	$path = '/open/school/'.$this->school.'/loadSchoolRecipeDetail';
    	$query = array('recipeId'=>$id);
    	$body = $this->result($path,$query);
    	return $body;
    }
    protected function result($path,$query){
    	$response = $this->client->request('GET',$path,['query'=>$query]);
    	if ($response->getStatusCode() == 200) {
			$body = json_decode($response->getbody(),true);
			if ($body['retCode'] == 100000) {
				if(!empty($body['data'])){
                    return $body['data'];
                }else{
                    return "";
                }
			}else{
			   abort(404,$body['message']);
			}
		}else{
			abort(404);
		}
    }
}