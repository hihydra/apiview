<?php
namespace App\Service;
use App\Service\BaseService;
/**
* 基类service
*/
class BaseService
{
	public $school;

	public function __construct(){
        $this->url = env('API_URL');
		$this->client = new \GuzzleHttp\Client(['base_uri' => env('API_URL'),'cookie'=>true]);  //api接口地址
        $this->school = app('request')->segment(3);
        $this->theme = env('THEME_STYLE');   //设置主题目录
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
    	if ($response->getStatusCode() == 200) {
			$body = json_decode($response->getbody(),true);
			if ($body['retCode'] == 100000) {
                if ($cookie) {
                    $headers = $response->getHeaders();
                    foreach ($headers['Set-Cookie'] as $key => &$value) {
                        $value = preg_replace('/;.*/','',$value);
                        $str = explode('=',$value);
                        setcookie($str[0],$str[1]);
                    }
                }
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
}