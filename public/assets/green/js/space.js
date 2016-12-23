//100通用
var CODE_SUCCESS			= 100000;//成功
var CODE_NETWORK_ERROR		= 100001;//网络异常
var CODE_SERVER_INNER_ERROR	= 100002;//失败,内部错误
var CODE_NOT_LOGIN			= 100003;//未登录
var CODE_UNAUTHORIZED		= 100004;//权限不够
var CODE_PARAMETER_NULL     = 100005;//数据为空

var teacherSpace_loadUrl = ctx+"/loadSpace";
var teacherSpace_addUrl = ctx+"/addSpace";
var teacherSpace_delUrl = ctx+"/delSpace";

var dynamic_likeUrl = ctx+"/doLike";
var dynamic_cancelLikeUrl = ctx+"/doCancelLike";
var dynamic_saveCommentUrl = ctx+"/addComment";
var dynamic_delCommentUrl = ctx+"/delComment";
var dynamic_loadComment = ctx+"/loadComment";

var paramName_commentId = "commentId";

var sync_div_display = {};
var syncId_default = "syncId_default";

var pageNo = '';
var methods = {
    get_data: function() {
        $("#vlist").append('<div class="loading ft12" id="waitbox"><img src="/assets/green/img/loader.gif" width="19" height="19" />载入中..</div>');
        $.ajax({url:teacherSpace_loadUrl,
          data:{id:userId,pageNo:pageNo},
          type: 'GET',
          async: false,
          error: function(){},
          success: function(data){
          	 html = $(".busbox").html();
             $(".busbox").html(html+data.datas);
             $("#waitbox").remove();
             $('.busbox').ReplaceFace();
             if (data.hasMore) {
                pageNo = data.anchor;
                $('#get_more').css('display', 'block');
             }else{
                $('#get_more').css('display', 'none');
             }
          }
        });
      },
  };

function ajaxJSON(params){
	if(params.syncId==null){
		params.syncId = syncId_default;
	}
	if(sync_div_display[params.syncId]==null){
		sync_div_display[params.syncId] = 0;
	}
	var _sync = params.mustCallBack?0:++sync_div_display[params.syncId];
	relateEleControl(params.disableEles,true);
	$.ajax({
		url: params.url,
		data: params.postData,
		type: params.postType,
		async: false,
		//dataType: "json",
		success: function(json){
			relateEleControl(params.disableEles,false);
			if(!params.mustCallBack&&_sync!=sync_div_display[params.syncId]){
				return ;
			}
			if(json.retCode==CODE_NOT_LOGIN){
				alert("请重新登录！");
			}else if(json.retCode==CODE_UNAUTHORIZED){
				alert("权限不足！");
				if(params.failedCallBack!=null){
					params.failedCallBack();
				}
			}else{
				params.callBack(json);
			}
		},
		error:function(){
			relateEleControl(params.disableEles,false);
			if(params.failedCallBack!=null){
				params.failedCallBack();
			}
			if(!params.mustCallBack&&_sync!=sync_div_display[params.syncId]){
				return ;
			}else if(params.error!=null){
				//alert(params.error);
			}
		}
	});
}

function relateEleControl(eles,val){
	if(eles==null||eles.length==0){
		return ;
	}
	for(var i=0;i<eles.length;i++){
		$("#"+eles[i]).attr("disabled",val);
	}
}
function doAddTeacherSpaceData(){
	if($("#textarea_content").attr("disabled")!=null){
		return ;
	}

	if($.trim($("#textarea_content").val())==""){
		alert("发布内容不能为空！");
		return ;
	}
	var postData = $("#form_teacherSpace").serialize();

	var params = {};
	params.url = teacherSpace_addUrl;
	params.postData = postData;
	params.postType = "post";
	params.error = "发布失败，请确认您的网络是否正常！"
	params.mustCallBack = true;//是否必须回调
	params.callBack = function (json){
		if(json.retCode==CODE_SUCCESS){
			pageNo = "";
			$(".busbox").html('');
			methods.get_data();
			$("#textarea_content").val("");
			//delAttachment();
		}else{
			alert("发布失败！");
		}
	};
	params.disableEles = ["textarea_content"];
	ajaxJSON(params);
}
function doDelTeacherSpaceData(id){
    var _eleId = id;
    var isDo = confirm("确定要删除吗？");
    if(!isDo){
      return;
    }

    var params = {};
    params.url = teacherSpace_delUrl;
    params.postData = {id:id};
    params.postType = "post";
    params.error = "删除失败，请确认您的网络是否正常！";
    params.mustCallBack = true;//是否必须回调
    params.callBack = function (json){
      if(json.retCode==CODE_SUCCESS){
        $("#div_data_"+_eleId).remove();
      }else if(json.retCode==CODE_NOT_LOGIN){
        alert("登录超时，请重新登录！");
      }else{
        alert("删除失败！");
      }
    };
    ajaxJSON(params);
}

function doLike(id){
	var postData = {};

	var params = {};
	params.url = dynamic_likeUrl;
	params.postData = {id:id};
	params.postType = "post";
	params.error = "操作失败，请确认您的网络是否正常！";
	params.mustCallBack = true;//是否必须回调
	params.callBack = function (json){
		if(json.retCode==CODE_SUCCESS){
			$("#like_"+id).attr("href","javascript:doCancelLike('"+id+"');");
			$("#like_"+id).attr("title","取消赞");
			$("#like_"+id).html("已赞");
			$("#like_count_"+id).html($("#like_count_"+id).html()-1+2);
		}else if(json.retCode==CODE_NOT_LOGIN){
			alert("登录超时，请重新登录！");
		}else{
			alert("操作失败！");
		}
	};
	ajaxJSON(params);
}
function doCancelLike(id){
	var postData = {};

	var params = {};
	params.url = dynamic_cancelLikeUrl;
	params.postData = {id:id};
	params.postType = "post";
	params.error = "操作失败，请确认您的网络是否正常！";
	params.mustCallBack = true;//是否必须回调
	params.callBack = function (json){
		if(json.retCode==CODE_SUCCESS){
			$("#like_"+id).attr("href","javascript:doLike('"+id+"');");
			$("#like_"+id).attr("title","点赞");
			$("#like_"+id).html("赞");
			$("#like_count_"+id).html($("#like_count_"+id).html()-1);
		}else if(json.retCode==CODE_NOT_LOGIN){
			alert("登录超时，请重新登录！");
		}else{
			alert("操作失败！");
		}
	};
	ajaxJSON(params);
}
/**********************评论相关*******************************/
function doAddComment(id){
	var _eleId = id;
	if($("#ipt_coment_c_"+_eleId).attr("disabled")!=null){
		return ;
	}
	if($("#ipt_coment_c_"+_eleId).val()==""){
		return false;
	}
	var postData = $("#form_comment_"+_eleId).serialize();

	var params = {};
	params.url = dynamic_saveCommentUrl;
	params.postData = postData;
	params.postType = "post";
	params.error = "评论失败，请确认您的网络是否正常！"
	params.mustCallBack = true;//是否必须回调
	params.callBack = function (json){
		if(json.retCode==CODE_SUCCESS){
			//json.comment = json.data;
			$("#div_dynamic_comments_"+_eleId).prepend(json.datas);
			$("#ipt_coment_c_"+_eleId).val("");
			//reply_hide(id);
		}else if(json.retCode==CODE_NOT_LOGIN){
			alert("登录超时，请重新登录！");
		}else{
			alert("评论失败！");
		}
	};
	params.disableEles = ["ipt_coment_c_"+_eleId];
	ajaxJSON(params);
}
function reply_show(blogId,rid,toId,toName){
	var _eleId = blogId;
	$("#ipt_toId_"+_eleId).val(toId);
	$("#span_reply_"+_eleId).remove();
	var span = '';
	span += '<span id="span_reply_'+_eleId+'">';
	span += 	'回复&nbsp'+toName+':';
	span += 	'<a href="javascript:reply_hide(\''+blogId+'\');">取消</a>';
	span += 	'<input type="hidden" name="rid" value="'+rid+'" />';
	span += '</span>';
	$("#form_comment_div_"+_eleId).prepend(span);
	$("#form_comment_div_"+_eleId).show();
	$("#ipt_coment_c_"+_eleId).focus();
	commentForm_show(_eleId);
}
function reply_hide(blogId){
	var _eleId = blogId;
	$("#ipt_toId_"+_eleId).val($("#ipt_blogUid_"+_eleId).val());
	$("#span_reply_"+_eleId).remove();
	$("#form_comment_div_"+_eleId).hide();
}
function loadComment(id){
	var params = {};
	params.url = dynamic_loadComment;
	params.postData = {id:id};
	params.postType = "get";
	//params.error = "获取动态失败";
	params.mustCallBack = true;//是否必须回调
	params.callBack = function (json){
		if(json.retCode==CODE_SUCCESS){
			/*
			var userType = $("#ipt_userType").val();
			if(userType=="SCHOOL_RECTOR"
					||userType=="SCHOOL_TEACHER"
					||userType=="SCHOOL_STUDENT"){
				json.isSchoolUser = true;
			}else{
				json.isSchoolUser = false;
			}
			$("#div_display").prepend(replaceHtml(createHtmlUseModel("model_dataDetail",json)));
			$("#ipt_userId").val(json.data.uid);
			loadPersonalInfo(false);
			*/
			alert(json.datas);
			$('.more_'+id).after(json.datas);
		}
	};
	//$("#div_display").html($("#div_comments_loading").html());
	ajaxJSON(params);
}
function doDelComment(id){
	var _eleId = id;
	var isDo = confirm("确定要删除吗？");
	if(!isDo){
		return;
	}

	var postData = {};

	var params = {};
	params.url = dynamic_delCommentUrl;
	params.postData = {id:id};
	params.postType = "post";
	params.error = "删除失败，请确认您的网络是否正常！";
	params.mustCallBack = true;//是否必须回调
	params.callBack = function (json){
		$("#div_dynamic_loading").hide();
		if(json.retCode==CODE_SUCCESS){
			$("#div_dynamic_comments_"+_eleId).remove();
		}else if(json.retCode==CODE_NOT_LOGIN){
			alert("登录超时，请重新登录！");
		}else{
			alert("删除失败！");
		}
	};
	ajaxJSON(params);
}
var timer_hideCommentForm = {};
function commentForm_show(_eleId){
	clearTimeout(timer_hideCommentForm._eleId);
	if($("#div_dynamic_comments_commentForm_"+_eleId).is(":visible")==false){
		$("#div_dynamic_comments_commentForm_"+_eleId+"_hint").hide();
		$("#div_dynamic_comments_commentForm_"+_eleId).show();
	}
	$("#ipt_coment_c_"+_eleId).focus();
}
function commentForm_hide(_eleId){
	if($.trim($("#ipt_coment_c_"+_eleId).val())==""){
		clearTimeout(timer_hideCommentForm._eleId);
		timer_hideCommentForm._eleId = setTimeout("doCommentForm_hide('"+_eleId+"')",500);
	}
}
function doCommentForm_hide(_eleId){
	if($.trim($("#ipt_coment_c_"+_eleId).val())==""&&$("#faceContent").is(":visible")==false){
		$("#div_dynamic_comments_commentForm_"+_eleId+"_hint").show();
		$("#div_dynamic_comments_commentForm_"+_eleId).hide();
	}
}
function comment_click(id){
	var _eleId = id;
	$("#div_dynamic_comments_"+_eleId).toggle();
	//$("#ipt_coment_c_"+_eleId).focus();
	return;
}
function showFaceList(replyContent,faceTitle){
	$("#"+faceTitle).attr("onclick","");
	$("#"+replyContent).FormFace({ faceTitle : "#"+faceTitle, cid : "", left : "-5" , top : "5" });
	$("#"+faceTitle).click();
}



/**********************空间图片*******************************/
function delAttachment(){
	$("#ipt_form_ftype").val("NONE");
	$("#ipt_form_fid").val("");
	$("#ipt_form_fname").val("");
	$("#weibo_div_uploadResult").hide();
	$("#weibo_img").attr("src",ctp+"/resource/front/img/loading.gif");
	$("#div_ipt_photo").html('<input type="file" class="photo-input" accept="image/*" name="file" onchange="javascript:weiboAttachmentUpload(this,\'weibo_form_upload\',\'PHOTO\')" />');
}
function weiboAttachmentUpload(sender,uploadForm,type){
	if(sender.value==""){
		return false;
	}
	if (type=="PHOTO"&&!sender.value.match(/.jpg|.jpeg|.gif|.png|.bmp/i)) {
		alert("\u56fe\u7247\u683c\u5f0f\u65e0\u6548\uff01");
		return false;
	}
	$("#weibo_ipt_upload_type").val(type);
	$("#"+uploadForm).submit();
}
function weiboAttachmentUpload_callBack(retCode,fileName,size,id,type){
	if(CODE_SUCCESS==retCode){
		$("#ipt_form_ftype").val(type);
		$("#ipt_form_fid").val(id);
		$("#ipt_form_fname").val(fileName);
		$("#weibo_img").attr("src",ctp+"/attachment/photo/weibo_l/"+id+"/"+id+".jpg");
		$("#weibo_span_fname").html(fileName);
		$("#weibo_div_uploadResult").show();
	}else if(CODE_NOT_LOGIN==retCode){
		alert("登录超时，请重新登录！");
	}else{
		alert("图片上传失败！");
	}
}
function doShowLong(id){
	$("#p_short_"+id).hide();
	$("#p_long_"+id).show();
}
function doShowShort(id){
	$("#p_short_"+id).show();
	$("#p_long_"+id).hide();
}