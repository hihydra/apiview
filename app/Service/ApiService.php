<?php
namespace App\Service;
use App\Service\BaseService;

class ApiService extends BaseService
{
	public $school;

	public function __construct(){
        $this->url = env('API_URL');
		$this->client = new \GuzzleHttp\Client(['base_uri' => env('API_URL'),'cookie'=>true]);  //api接口地址
        $this->school = app('request')->segment(3);
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
        $body['typeCh'] = config('category.survey.next.intro');
        $body['type'] = 'intro';
		return $body;
    }
    //机构设置
    public function loadSchoolOrgStruct($word=''){
        $path  = '/open/school/'.$this->school.'/loadSchoolOrgStruct';
        $query = array('word'=>$word);
        $body['content'] = $this->result($path,$query);
        $body['typeCh'] = config('category.survey.next.orgStruct');
        $body['type'] = 'orgStruct';
        return $body;
    }
    //招生信息
    public function loadSchoolEnrollment($word=''){
		$path  = '/open/school/'.$this->school.'/loadSchoolEnrollment';
		$query = array('word'=>$word);
		$body['content'] = $this->result($path,$query);
        $body['typeCh'] = config('category.survey.next.enrollment');
        $body['type'] = 'enrollment';
		return $body;
    }
    //教师队伍
    public function loadTeacherPagePhoto($limit=6,$pageNo=1){
    	$path = 'spaceList/load';
    	$query = array('anchor'=>$pageNo,'orgId'=>$this->school);
		$body = $this->result($path,$query);
        foreach ($body['datas'] as &$value) {
            $value['url'] = "/open/apply/".$this->school."/space?id={$value['id']}";
            $value['img'] = $this->url.'/'.$value['photoUrl'];
        }
        $body['typeCh'] = config('category.survey.next.teacher');
        $body['type'] = 'teacher';
		return $body;
    }
    /*
    //老师简介
    public function teacherIntro($id){
    	$path = '/open/school/'.$this->school.'/teacherIntro/ajax';
    	$query = array('id'=>$id);
		$body['content'] = $this->result($path,$query);
        $body['cateName'] = '教师简介';
		return $body;
    }*/
    /*
   	type： 学校写真(TYPE_PHOTO),学校荣誉(TYPE_HONOUR)
    */
    public function loadSchoolPagePicture($type,$pageNo=1,$limit=9){
    	$path = '/open/school/'.$this->school.'/loadSchoolPicturePage';
    	$query = array('type'=>$type,'pageNo'=>$pageNo,'limit'=>$limit);
		$body = $this->result($path,$query);
        foreach ($body['datas'] as &$value) {
            $value['img'] = $value['url'] = $this->url."/open/school/0/photo/{$value['hash']}/{$value['id']}.jpg";
        }
        $body['type'] = $type;
        $body['typeCh'] = config('category.survey.next.'.$type);
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
            $value['url'] = "/open/apply/".$this->school."/info/{$value['id']}";
        }
        $body['type'] = $type;
        switch ($type) {
            case 'TYPE_PHOTO_ACTIVITY':
                $body['typeCh'] = config('category.survey.next.'.$type);
                break;
            case 'TYPE_NEWS':case 'TYPE_PHOTO_NEWS':case 'TYPE_DEVELOPMENT_PLANNING':
            case 'TYPE_POLICY':case 'TYPE_HOT_TOPICS':
                $body['typeCh'] = config('category.information.next.'.$type);
                break;
            case 'TYPE_ACADEMIC_ARRANGEMENT':case 'TYPE_SPECIAL_PROGRAMS':case 'TYPE_TEACHING_RESULTS':
            case 'TYPE_SCIENTIFIC_RESEARCH':
                $body['typeCh'] = config('category.teaching.next.'.$type);
                break;
            case 'TYPE_PHOTO_ACTIVITY':case 'TYPE_FAMILY_EDUCATION':
                $body['typeCh'] = config('category.interaction.next.'.$type);
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
    public function loadRecentlyNotice($limit=10,$word=80){
        $path = '/open/school/'.$this->school.'/loadRecentlyNotice';
        $query = array('limit'=>$limit,'word'=>$word);
        $body = $this->result($path,$query);
        foreach ($body as &$value) {
            $value['url'] = "/open/apply/".$this->school."/noticeDetail/{$value['id']}";
        }
        $data['datas'] = $body;
        $data['typeCh'] = config('category.interaction.next.notice');
        $data['type'] = 'notice';
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
        $body['typeCh'] = config('category.interaction.next.notice');
        $body['type'] = 'notice';
        return $body;
    }

    //每周食谱
    public function loadSchoolRecipes($limit=6,$pageNo=1){
    	$path = '/open/school/'.$this->school.'/loadSchoolRecipe';
    	$query = array('pageNo'=>$pageNo,'limit'=>$limit);
		$body = $this->result($path,$query);
        foreach ($body['datas'] as &$value) {
            $value['url'] = "/open/apply/".$this->school."/recipe/{$value['id']}";
        }
        $body['typeCh'] = config('category.interaction.next.recipe');
        $body['type'] = 'recipe';
		return $body;
    }
    //食谱内容
    public function recipeDetail($id){
    	$path = '/open/school/'.$this->school.'/loadSchoolRecipeDetail';
    	$query = array('recipeId'=>$id);
    	$body = $this->result($path,$query);
        $body['typeCh'] = config('category.interaction.next.recipe');
        $body['type'] = 'recipe';
    	return $body;
    }
    //用户信息
    public function personal($id=""){
        $path = '/personal/info/ajax';
        $query = array('id'=>$id);
        $body = $this->result($path,$query);
        $body['img'] = $this->url.'/'.$body['largePhotoUrl'];
        return $body;
    }
    //登陆
    public function login_in($username,$password){
        $path = '/login_in';
        $query = array('username'=>$username,'password'=>$password);
        $body = $this->result($path,$query,'POST',true);
        return $body;
    }
    //教师动态
    public function teacherSpace($id="",$pageNo=""){
        $path = '/teacherSpace/load';
        $query = array('teacherId'=>$id,'pageNo'=>$pageNo);
        $body = $this->result($path,$query);
        return $body;
    }
    //动态评论
    public function loadComments($id,$anchor=""){
        $path = '/task/teacherSpace/loadComments';
        $query = array('spaceId'=>$id,'anchor'=>$anchor);
        $body = $this->result($path,$query);
        return $body;
    }
    //发布动态
    public function doAddteacherSpace($c,$fname='',$fid='',$ftype=''){
        $path = "/task/teacherSpace/add";
        $query = array('c'=>$c,'fname'=>$fname,'fid'=>$fid,'ftype'=>$ftype);
        $body = $this->result($path,$query,'POST');
        return $body;
    }
    //删除动态
    public function doDelTeacherSpace($id){
        $path = "/task/teacherSpace/del";
        $query = array('id'=>$id);
        $body = $this->result($path,$query,'POST');
        return $body;
    }
    //点赞
    public function doLike($id){
        $path = "/task/teacherSpace/addLike";
        $query = array('spaceId'=>$id);
        $body = $this->result($path,$query,'POST');
        return $body;
    }
    //取消赞
    public function doCancelLike($id){
        $path = "/task/teacherSpace/cancelLike";
        $query = array('spaceId'=>$id);
        $body = $this->result($path,$query,'POST');
        return $body;
    }
    //添加评论
    public function addComment($id,$c){
        $path = "/task/teacherSpace/addComment";
        $query = array('c'=>$c,'spaceId'=>$id);
        $body = $this->result($path,$query,'POST');
        return $body;
    }
    //删除评论
    public function delComment($id){
        $path = "/task/teacherSpace/delComment";
        $query = array('commentId'=>$id);
        $body = $this->result($path,$query,'POST');
        return $body;
    }
    //查看评论
    public function loadComment($id,$pageNo){
        $path = "/teacherSpace/comments";
        $query = array('dataId'=>$id,'pageNo'=>$pageNo);
        $body = $this->result($path,$query);
        return $body;
    }
    //查看动态详情
    public function comments($id){
        $path = "/teacherSpace/info";
        $query = array('id'=>$id);
        $body = $this->result($path,$query);
        return $body;
    }
    //上传图片
    public function uploadPhoto($filePath){
        $path = env('API_URL')."/attachment/uploadForTask";
        $query = array('file'=>new \CURLFile($filePath));
        $body = $this->result_curl($path,$query);
        unlink($filePath);
        $body['data']['img'] = $this->url."/attachment/photo/source/{$body['data']['hash']}/{$body['data']['id']}.jpg";
        return $body;
    }
    //修改用户图片
    public function saveUserPhoto($form){
        $path = "/userPhoto/save";
        $body = $this->result($path,$form);
        $body['img'] = $this->url.'/'.$body['photoUrl'];
        return $body;
    }

    //院长信箱
    public function loadChildStar($pageNo){
        $path = "/childStar/load";
        $query = array('schoolId'=>$this->school,'pageNo'=>$pageNo);
        $body = $this->result($path,$query);
        return $body;
    }

    public function detailChildStar($id){
        $path = "/childStar/detail";
        $query = array('schoolId'=>$this->school,'id'=>$id);
        $body = $this->result($path,$query);
        return $body;
    }

    public function saveChildStar($from){
        $path = "/childStar/save";
        $from['schoolId'] = $this->school;
        $body = $this->result($path,$from);
        return $body;
    }


    //验证登陆
    public function judgeCookie(){
       return !empty($_COOKIE['kindergarten_sid']);
    }

    protected function result($path,$query,$mothod="GET",$cookie=false){
        if (!empty($_COOKIE['kindergarten_sid'])) {
            $query['kindergarten_sid'] = $_COOKIE['kindergarten_sid'];
        }
    	$response = $this->client->request($mothod,$path,['query'=>$query]);
        if ($cookie) {
            $headers = $response->getHeaders();
            foreach ($headers['Set-Cookie'] as $key => &$value) {
                $value = preg_replace('/;.*/','',$value);
                $str = explode('=',$value);
                setcookie($str[0],$str[1]);
            }
        }
    	if ($response->getStatusCode() == 200) {
			$body = json_decode($response->getbody(),true);
			if ($body['retCode'] == 100000) {
				if(!empty($body['data'])){
                    return $body['data'];
                }else{
                    return $body;
                }
			}else{
			   return $body;
			}
		}else{
			abort(404);
		}
    }

    protected function result_curl($path,$query){
        if (!empty($_COOKIE['kindergarten_sid'])) {
            $cookieStr = 'kindergarten_sid='.$_COOKIE['kindergarten_sid'];
        }
        //初始化
        $ch = curl_init ();
        curl_setopt ( $ch, CURLOPT_URL,$path);
        curl_setopt ( $ch, CURLOPT_POST, 1 );//post方式
        curl_setopt ( $ch, CURLOPT_HEADER, 0 );
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt ( $ch, CURLOPT_COOKIE,$cookieStr);
        curl_setopt ( $ch, CURLOPT_POSTFIELDS,$query);
        $body = curl_exec ( $ch );

        curl_close ( $ch );

        return json_decode($body,true);
    }
}