<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\SpaceService;
use App\Service\ApiService;

class SpaceController extends Controller
{
	private $space;
	private $api;

	public function __construct(SpaceService $space,ApiService $api){
		$this->space = $space;
		$this->api = $api;
	}

	//空间
	public function space(Request $request){
		$id = $request->input('id','');
		if(!$this->space->judgeCookie() && !$id){
           return redirect('/open/apply/'.$this->space->school.'/login');
        }
		$data = $this->space->personal($id);
		$data['notices'] = $this->api->loadRecentlyNotice(3);
		return view($this->space->theme.'.space.dynamic',$data);
	}

	//修改密码
	public function rePassword(Request $request){
		if($request->isMethod('post')){
			$oldPwd = $request->input('oldPwd');
			$newPwd = $request->input('newPwd');
			$data = $this->space->rePassword($oldPwd,$newPwd);
			if($data['retCode'] == 100000){
            	setcookie('kindergarten_sid','');
            	return $data;
       		}
		}else{
			if(!$this->space->judgeCookie()){
           		return redirect('/open/apply/'.$this->space->school.'/login');
        	}
			$data = $this->space->personal();
			return view($this->space->theme.'.space.rePassword',$data);
		}
	}

	//确认密码
	public function checkPassword(Request $request){
		$oldPwd = $request->input('oldPwd','');
		$data = $this->space->checkPassword($oldPwd);
		return $data;
	}

	//空间动态
	public function loadSpace(Request $request){
		$id = $request->input('id','');
		$pageNo = $request->input('pageNo','');
		$data = $this->space->teacherSpace($id,$pageNo);
		$data['url'] = $this->space->url;
		$data['isLogin'] = $this->space->judgeCookie();
		$data['datas'] = (string)(view($this->space->theme.'.space.spaceData',$data));
		return $data;
	}
	//发布动态
	public function doAddteacherSpace(Request $request){
		$c = $request->input('c');
		$fname = $request->input('fname');
		$fid = $request->input('fid');
		$ftype = $request->input('ftype');
		$data = $this->space->doAddteacherSpace($c,$fname,$fid,$ftype);
		return $data;
	}
	//删除动态
	public function doDelTeacherSpace(Request $request){
		$id = $request->input('id');
		$data = $this->space->doDelTeacherSpace($id);
		return $data;
	}
	//点赞
	public function doLike(Request $request){
		$id = $request->input('id');
		$data = $this->space->doLike($id);
		return $data;
	}
	//取消赞
	public function doCancelLike(Request $request){
		$id = $request->input('id');
		$data = $this->space->doCancelLike($id);
		return $data;
	}
	//添加评论
	public function addcomment(Request $request){
		$id = $request->input('id');
		$c = $request->input('c');
		$data[] = $this->space->addComment($id,$c);
		$html['datas'] = (string)($this->commenthtml($data));
		$html['retCode'] = 100000;
		return $html;
	}
	//删除评论
	public function delComment(Request $request){
		$id = $request->input('id');
		$data = $this->space->delComment($id);
		return $data;
	}
	//查看评论
	public function loadComment(Request $request){
		$id = $request->input('id');
		$pageNo = $request->input('pageNo');
		$data = $this->space->loadComment($id,$pageNo);
		$data['datas'] = $this->commenthtml($data['datas']);
		$data['type'] = 'comment';
		$data['id'] = $id;
		//$html = $this->pagination($id,$data['totalPages'],$data['currentPage']);
		$html = view('vendor.JSpagination',$data);
		$data['datas'] .= $html;
		$data['retCode'] = 100000;
		return $data;
	}
	//修改用户图片
    public function saveUserPhoto(Request $request){
        $form = $request->all();
        $data = $this->space->saveUserPhoto($form);
        $data['retCode'] = 100000;
        return $data;
    }
	//评论
	private function commenthtml($comments){
		$url = $this->space->url;
	    return view($this->space->theme.'.space.comment',compact('comments','url'));
	}

}
