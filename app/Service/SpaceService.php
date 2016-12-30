<?php
namespace App\Service;

class SpaceService extends BaseService
{
    //用户信息
    public function personal($id=""){
        $path = '/personal/info';
        $query = array('id'=>$id);
        $body = $this->result($path,$query);
        $body['classs'] = $this->myClass();
        $body['img'] = $this->url.'/'.$body['largePhotoUrl'];
        if($this->judgeCookie() && !$id){
            $body['isOwner'] = true;
        }else{
            $body['isOwner'] = false;
        }
        return $body;
    }
    //用户动态
    public function teacherSpace($id="",$pageNo=""){
        $path = '/teacherSpace/load';
        $query = array('teacherId'=>$id,'pageNo'=>$pageNo);
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
    //修改用户图片
    public function saveUserPhoto($form){
        $path = "/userPhoto/save";
        $body = $this->result($path,$form,'post');
        $body['img'] = $this->url.'/'.$body['photoUrl'];
        return $body;
    }

    //修改密码
    public function rePassword($oldPwd,$newPwd){
        $path = '/password/modify';
        $query = array('oldPwd'=>$oldPwd,'newPwd'=>$newPwd);
        $body = $this->result($path,$query,'POST');
        return $body;
    }

    //获取班级
    public function myClass(){
        $path = '/personal/myClass';
        $query = array();
        $body = $this->result($path,$query);
        return $body;
    }

    //确认密码
    public function checkPassword($oldPwd){
        $path = '/password/check';
        $query = array('oldPwd'=>$oldPwd);
        $body = $this->result($path,$query,'POST');
        return $body;
    }
}