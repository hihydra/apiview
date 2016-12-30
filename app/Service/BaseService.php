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

    //上传图片
    public function uploadPhoto($filePath){
        $path = env('API_URL')."/attachment/uploadForTask";
        $query = array('file'=>new \CURLFile($filePath));
        $body = $this->result_curl($path,$query);
        unlink($filePath);
        $body['data']['img'] = $this->url."/attachment/photo/source/{$body['data']['hash']}/{$body['data']['id']}.jpg";
        return $body;
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
				if(isset($body['data'])){
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

    private function result_curl($path,$query){
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