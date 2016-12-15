//100通用
var CODE_SUCCESS			= 100000;//成功
var CODE_NETWORK_ERROR		= 100001;//网络异常
var CODE_SERVER_INNER_ERROR	= 100002;//失败,内部错误
var CODE_NOT_LOGIN			= 100003;//未登录
var CODE_UNAUTHORIZED		= 100004;//权限不够
var CODE_PARAMETER_NULL     = 100005;//数据为空
//200用户相关
var CODE_USER_EXIST			= 200001;//用户已存在
var CODE_USER_NOT_EXIST		= 200002;//用户名不存在
var CODE_USER_PASS_ERROR	= 200003;//用户名或密码错误
var CODE_USER_CAPTCHA_ERROR	= 200004;//验证码错误
var CODE_USER_ACCOUNT_ERROR	= 200005;//账号异常
var CODE_USER_ACTIVA        = 200006;//用户已激活
var CODE_USER_MULTI			= 200008;//多用户
//300学校相关
var CODE_SCHOOL_EXIST		= 300001;//学校已存在
//400年级相关
var CODE_GRADE_EXIST		= 400001;//类别名已存在
//500文件相关
var CODE_FILE_EXIST			= 500001;//文件已存在
var CODE_FILE_CAPACITY_NOT_ENOUGH	= 500004;//容量不够
var CODE_FILE_LARGE 		= 500006;// 文件太大

var CODE_MSG_NOT_EXIST		= 600002;//消息不存在
var CODE_INFORMATION_EXIST	= 700001;//资讯已存在
var CODE_INFORMATION_NOT_EXIST	= 700002;//资讯不存在

//800活动相关
var CODE_ACTIVITY_EXIST			= 800001;//活动已存在
//900幼儿报名相关
var CODE_APPLY_NOT_START	= 900001;//报名未开始
var CODE_APPLY_END			= 900002;//报名已结束
var CODE_ENROLL_NOT_START	= 900003;//录取时间未开始
var CODE_ENROLL_END			= 900004;//录取时间已结束
var CODE_APPLY_NOT			= 900005;//还没有申请入园
var CODE_ENROLL_NOT			= 900006;//还没开始录取 
var CODE_APPLY_SUBMIT		= 900007;//已经提交了入园申请
var CODE_APPLY_NOT_SUBMIT	= 900008;//已经提交了入园申请
var CODE_ENROLL_SUCEESS		= 900009;//已经入园了
//1000幼儿报名与学校录取相关相关
var CODE_REGION_EXIST = 1000001;// 区域已存在

$(document).ready(function(){
	$(document).delegate("[class='Btn btn-group']","click",function(e){
		e.preventDefault();
		e.stopPropagation();
		if($(this).next().find("ul[class='dropdown-menu']").is(":visible")==true){
			$(this).next().find("ul[class='dropdown-menu']").hide();
			return ;
		}
		$("[class='btn_group']").find("ul[class='dropdown-menu']").hide();
		$(this).next().find("ul[class='dropdown-menu']").show();
	});
	$(document).bind("click",function(){
		$("[class='btn_group']").find("ul[class='dropdown-menu']").hide();
	});
});
var sync_div_display = {};
var syncId_default = "syncId_default";
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
		//async: true,
		dataType: "json",
		success: function(json){
			relateEleControl(params.disableEles,false);
			if(!params.mustCallBack&&_sync!=sync_div_display[params.syncId]){
				return ;
			}
			if(json.retCode==CODE_NOT_LOGIN){
				alert("请重新登录！");
				location.href = ctx+"/";
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
function useModel(modelId,contentId,json){
	var _html = createHtmlUseModel(modelId,json);
	$("#"+contentId).html(_html);
}
function useModelAppend(modelId,contentId,json){
	var _html = createHtmlUseModel(modelId,json);
	$("#"+contentId).append(_html);
}
function createHtmlUseModel(modelId,json){
	var _model = $("#"+modelId).html();
	var _html = juicer(_model, json);
	return _html;
}

/****************全选********************************/
function checkAll(obj,formId,eleName,countDisplay){
	$("#"+formId).find("input[name='"+eleName+"']").attr("checked",obj.checked);
	if(obj.checked){
		var count = $("#"+formId).find("input[name='"+eleName+"']").length;
		$("#"+countDisplay).html(count);
	}else{
		$("#"+countDisplay).html(0);
	}
}
function clickCheckItem(checkAllId,formId,eleName,countDisplay){
	var total = $("#"+formId).find("input[name='"+eleName+"']").length;
	var count = $("#"+formId).find("input[name='"+eleName+"']:checked").length;
	$("#"+checkAllId).attr("checked",count==total);
	$("#"+countDisplay).html(count);
}
/****************日期*********************************/
function getCurrentDate(){
	var endDate = new Date();
	var e_year = endDate.getFullYear();
	var e_month = endDate.getMonth()+1;
	var e_date = endDate.getDate();
	return e_year*10000+e_month*100+e_date;
}
function getCurrentYearAndMonth(){
	var endDate = new Date();
	var e_year = endDate.getFullYear();
	var e_month = endDate.getMonth()+1;
	return e_year*100+e_month;
}
/*********************ztree********************************/
var ztree_chk_treeId = "";
var ztree_chk_ulId = "";
var ztree_chk_eleModel = "";
var ztree_chk_liIdPrefix = "";
var ztree_chk_setting = {
		check: {
			enable: true,
			chkboxType: {"Y":"", "N":""}
		},
		view: {
			dblClickExpand: false
		},
		data: {
			simpleData: {
				enable: true
			}
		},
		callback: {
			beforeClick: beforeClick,
			onCheck: onCheck
		},
		async: {
			enable: false
		}
	};
function beforeClick(treeId, treeNode) {
	var zTree = $.fn.zTree.getZTreeObj(ztree_chk_treeId);
	zTree.checkNode(treeNode, !treeNode.checked, null, true);
	return false;
}

function onCheck(e, treeId, treeNode) {
	insertEle(treeNode);
}
function insertEle(treeNode){
	$("#"+ztree_chk_ulId).find("#"+ztree_chk_liIdPrefix+treeNode.id).remove();
	if(treeNode.checked){
		var _ele = juicer(ztree_chk_eleModel, treeNode);
		$("#"+ztree_chk_ulId).prepend(_ele);
//		$("#div_mems_empty").hide();
//		$("#div_mems_content").show();
	}else{
//		if($("#"+ztree_chk_elesId).find("li").length==0){
//			$("#div_mems_content").hide();
//			$("#div_mems_empty").show();
//		}
	}
}
function removeEle(id){
	var zTree = $.fn.zTree.getZTreeObj(ztree_chk_treeId);
	//var node = zTree.getNodeByTId(tId);
	var node =  zTree.getNodeByParam("id", id, null);
	if(node.checked){
		beforeClick(node.tId,node);
	}else{
		insertEle(node);
	}
}
function doForward(url,schoolId,initId){
	if (schoolId) {
		url += "?schoolId=" + schoolId;
		if (initId) {
			url += "&initId=" + initId;
		}
	}else if (initId) {
		url += "?initId=" + initId;
	}
	location.href = ctx + url;
}