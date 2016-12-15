//var index_loadTopSchoolUrl = ctx+"/open/apply/loadTopSchool";
//var index_loadRecentlyPolicyUrl = ctx+"/open/apply/loadRecentlyPolicy";
//var index_loadRecentlyOpenNoticeUrl = ctx+"/open/apply/loadRecentlyOpenNotice";
//var index_loadRecentlySchoolNewsUrl = ctx+"/open/apply/loadRecentlySchoolNews";
//var index_schoolUrl = ctx+"/open/school/";
//var index_noticeUrl = ctx+"/open/apply/notice";
//var index_newsUrl = ctx+"/open/apply/news";
//var index_policyUrl = ctx+"/open/apply/policy";
//var index_openNoticeUrl = ctx+"/open/openNotice";
var notice_loadRecentlyNoticeUrl = ctx + "/open/school/" + schoolId + "/loadRecentlyNotice";
var notice_noticeDetailUrl = ctx + "/open/apply/noticeInfo/";
var news_detailUrl = ctx + "/open/apply/info/";
var news_loadUrl = ctx + "/open/school/" + schoolId + "/loadInfo";
var news_loadRecentlyNewsUrl = ctx + "/open/school/" + schoolId + "/loadRecentlyNews";
var schoolInfo_loadSchoolIntroUrl = ctx + "/open/school/" + schoolId + "/loadSchoolIntro";
var schoolInfo_loadSchoolEnrollmentUrl = ctx + "/open/school/" + schoolId + "/loadSchoolEnrollment";
var schoolInfo_loadSchoolPictureUrl = ctx + "/open/school/" + schoolId + "/loadSchoolPicture";
var schoolInfo_loadSchoolRecipeUrl = ctx + "/open/school/" + schoolId + "/loadSchoolRecipe";
var schoolInfo_loadSchoolRecipeDetailUrl = ctx + "/open/school/" + schoolId + "/loadSchoolRecipeDetail";
var index_openNoticeUrl = ctx + "/open/school/" + schoolId + "/notice";
var index_openNewsUrl = ctx + "/open/school/" + schoolId + "/news";
var index_openTeacherPothoUrl = ctx + "/open/school/" + schoolId + "/loadTeacherPhoto";
var index_openKindsPhotoUrl = ctx + "/open/school/" + schoolId + "/loadKindsPhoto";

var index_schoolPhotoUrl = ctx + "/open/school/0/photo/index_school_picture/";
var index_kindsPhotoUrl = ctx + "/open/school/0/photo/index_kinds_picture/";//hash/id.jpg";
var index_teacherPhotoUrl = ctx + "/attachment/userPhoto/";//id.jpg";"/attachment/photo/
var index_photoTeacherUrl = ctx + "/attachment/photo/pic_view/";//+id+"/"+id+".jpg"

$(document).ready(function(){
	loadRecentlySchoolPhoto();
	doLoadSchoolIntro();
	loadRecentlySchoolNews();
	//loadRecentlySchoolNotice();
	loadRecentlyPhotoTeacher();
	loadRecentlyPhotoKinds();
});
//学校简介
function doLoadSchoolIntro(){//简介
	$("#li_schoolEnrollment").removeClass("hover");
	$("#li_schoolIntro").addClass("hover");
	$("#a_schoolInfo").attr("href",ctx+"/open/school/"+schoolId+"/index");
	var params = {};
	params.url = schoolInfo_loadSchoolIntroUrl+"?_t="+new Date().getTime();
	params.postData = {isReduced:true};
	params.postType = "get";
	params.error = "加载失败";
	params.mustCallBack = false;//是否必须回调
//	params.syncId = syncId_default;
	params.callBack = function (json){
		if(json.retCode==CODE_SUCCESS){
			//$("#div_topSchoolInfo").html(json);
			useModel("model_schoolIntro","div_topSchoolInfo",json);
		}else{
			if(json.errorMsg!=null){
				alert("加载失败："+json.errorMsg);
			}else{
				alert("加载失败！");
			}
		}
	};
	ajaxJSON(params);
}
//招生信息
function doLoadSchoolEnrollment(){//招生信息
	$("#li_schoolIntro").removeClass("hover");
	//$("#li_schoolEnrollment").removeClass("no");
	$("#li_schoolEnrollment").addClass("hover");
	//$("#li_schoolIntro").addClass("no");
	$("#a_schoolInfo").attr("href",ctx+"/open/school/"+schoolId+"/enrollment");
	var params = {};
	params.url = schoolInfo_loadSchoolEnrollmentUrl+"?_t="+new Date().getTime();
	params.postData = {isReduced:true};
	params.postType = "get";
	params.error = "加载失败";
	params.mustCallBack = false;//是否必须回调
//	params.syncId = syncId_default;
	params.callBack = function (json){
		if(json.retCode==CODE_SUCCESS){
			useModel("model_schoolIntro","div_topSchoolInfo",json);
		}else{
			if(json.errorMsg!=null){
				alert("加载失败："+json.errorMsg);
			}else{
				alert("加载失败！");
			}
		}
	};
	ajaxJSON(params);
}


//通知公告
function loadRecentlySchoolNotice(){
	var params = {};
	params.url = notice_loadRecentlyNoticeUrl+"?_t="+new Date().getTime();
	params.postData = {limit:5};
	params.postType = "get";
	params.error = "获取通知公告失败";
	params.mustCallBack = true;//是否必须回调
	params.callBack = function (json){
		if(json.retCode==CODE_SUCCESS){
			json.infoUrl = index_openNoticeUrl;//div_topNotice
			useModel("model_recentlySchoolNotice","div_topTeacher",json);
		}
	};
	ajaxJSON(params);
}
//活动动态
function loadRecentlySchoolNews(){
	var params = {};
	params.url = news_loadRecentlyNewsUrl+"?_t="+new Date().getTime();
	params.postData = {limit:6,word:60};
	params.postType = "get";
	params.error = "获取活动动态失败";
	params.mustCallBack = true;//是否必须回调
	params.callBack = function (json){
		if(json.retCode==CODE_SUCCESS){
			json.infoUrl = index_openNewsUrl;
			useModel("model_recentlySchoolNews","div_topNews",json);
			 $('#schoolNews').kxbdMarquee({
				direction : 'up',
				eventA : 'mouseenter',
				eventB : 'mouseleave',
				scrollAmount : 1,// 步长
				scrollDelay : 40,// 时长
		    });
		}
	};
	ajaxJSON(params);
}

///学校图片
function loadRecentlySchoolPhoto(){
	var params = {};
	params.url = schoolInfo_loadSchoolPictureUrl+"?_t="+new Date().getTime();
	params.postData = {type:"TYPE_PHOTO",limit:8};
	params.postType = "get";
	params.error = "获取学校图片失败";
	params.mustCallBack = true;//是否必须回调
	params.callBack = function (json){
		if(json.retCode==CODE_SUCCESS){
			if(json.data.length>0){
				json.infoUrl = index_schoolPhotoUrl;
				useModel("model_schoolPhoto","div_schoolPhoto",json);
				timer_schoolPhoto_params = {curIndex:0,total:json.data.length};
				startSchoolPhotoTimer();
			}
		}else{
			if(json.errorMsg!=null){
				alert("加载失败："+json.errorMsg);
			}else{
				alert("加载失败！");
			}
		}
	};
	ajaxJSON(params);
}
//老师图片
function loadRecentlyPhotoTeacher(){
	var params = {};
	params.url = index_openTeacherPothoUrl+"?_t="+new Date().getTime();
	params.postData = {limit:12};
	params.postType = "get";
	params.error = "获取老师图片失败";
	params.mustCallBack = true;//是否必须回调
	params.callBack = function (json){
		if(json.retCode==CODE_SUCCESS){
			if(json.data.length>0){
				//json.infoUrl = index_teacherPhotoUrl;
				useModel("model_photoTeacher","div_topTeacher",json);
				//$("#photoTeacher2").html($("#photoTeacher1").html());
				//startPhotoTeacherTimer();
				timer_topTeacher_params = {curIndex:0,total:json.data.length};
				startTopTeacherTimer();
			}
		}else{
			if(json.errorMsg!=null){
				alert("加载失败："+json.errorMsg);
			}else{
				alert("加载失败！");
			}
		}
	};
	ajaxJSON(params);
}
//幼儿图片
function loadRecentlyPhotoKinds(){
	var params = {};
	params.url = index_openKindsPhotoUrl+"?_t="+new Date().getTime();
	params.postData = {type:"TYPE_KINDS",limit:8};
	params.postType = "get";
	params.error = "获取幼儿图片失败";
	params.mustCallBack = true;//是否必须回调
	params.callBack = function (json){
		if(json.retCode==CODE_SUCCESS){
			if(json.data.length>0){
				json.infoUrl = index_kindsPhotoUrl;
				useModel("model_photoKinds","div_topKinds",json);
				//$("#photoKinds2").html($("#photoKinds1").html());
				//startPhotoKindsTimer();
				 $('#photoKinds').kxbdMarquee({
			            direction:'left',
			            eventA:'mouseenter',
			            eventB:'mouseleave'
			    });
			}
		}else{
			if(json.errorMsg!=null){
				alert("加载失败："+json.errorMsg);
			}else{
				alert("加载失败！");
			}
		}
	};
	ajaxJSON(params);
}
var timer_schoolPhoto;
var timer_schoolPhoto_params = {curIndex:0,total:0};
//var timer_photoTeacher;
//var timer_photoKinds;
function startSchoolPhotoTimer(){
	schoolPhotoTimerImpl();
	var speed = 2500;
	var timer_schoolPhoto = setInterval(schoolPhotoTimerImpl, speed); //设置定时器
	$("#div_schoolPhoto_photo").bind("mouseover",function (){
		clearInterval(timer_schoolPhoto);
	});
	$("#div_schoolPhoto_photo").bind("mouseout",function (){
		timer_schoolPhoto = setInterval(schoolPhotoTimerImpl, speed); //设置定时器
	});
}
function schoolPhotoTimerImpl(){
	$("#div_schoolPhoto_photo").find("li").hide();
	$("#div_schoolPhoto_photo").find("#schoolPhoto_"+timer_schoolPhoto_params.curIndex).show();
	timer_schoolPhoto_params.curIndex = (timer_schoolPhoto_params.curIndex+1)%timer_schoolPhoto_params.total;
}
//function startPhotoTeacherTimer(){
//	var speed = 20;
//	var timer_photoTeacher = setInterval(photoTeacherTimerImpl, speed); //设置定时器
//	$("#div_topTeacher").bind("mouseover",function (){
//		clearInterval(timer_photoTeacher);
//	});
//	$("#div_topTeacher").bind("mouseout",function (){
//		timer_photoTeacher = setInterval(photoTeacherTimerImpl, speed); //设置定时器
//	});
//}
//function photoTeacherTimerImpl(){
//	var photoTeacher = $("#photoTeacher")[0];
//	var photoTeacher1 = $("#photoTeacher1")[0];
//	var photoTeacher2 = $("#photoTeacher2")[0];
//	if (photoTeacher2.offsetWidth - photoTeacher.scrollLeft <= 0)
//		photoTeacher.scrollLeft -= photoTeacher1.offsetWidth;
//	else {
//		photoTeacher.scrollLeft++;
//	}
//}

//幼儿图片展示
//function startPhotoKindsTimer(){
//	var speed = 20;
//	var timer_photoKinds = setInterval(photoKindsTimerImpl, speed); //设置定时器
//	$("#div_topKinds").bind("mouseover",function (){
//		clearInterval(timer_photoKinds);
//	});
//	$("#div_topKinds").bind("mouseout",function (){
//		timer_photoKinds = setInterval(photoKindsTimerImpl, speed); //设置定时器
//	});
//}
//function photoKindsTimerImpl(){
//	var photoKinds = $("#photoKinds")[0];
//	var photoKinds1 = $("#photoKinds1")[0];
//	var photoKinds2 = $("#photoKinds2")[0];
//	if (photoKinds2.offsetWidth - photoKinds.scrollLeft <= 0)
//		photoKinds.scrollLeft -= photoKinds1.offsetWidth;
//	else {
//		photoKinds.scrollLeft = photoKinds.scrollLeft + 1;
//	}
//}
var timer_topTeacher;
var timer_topTeacher_params = {curIndex:0,total:12};
function startTopTeacherTimer(){
	topTeacherTimerImpl();
	var speed = 5000;
	var timer_topTeacher = setInterval(topTeacherTimerImpl, speed); //设置定时器
	$("#ul_teacher").bind("mouseover",function (){
		clearInterval(timer_topTeacher);
	});
	$("#ul_teacher").bind("mouseout",function (){
		timer_topTeacher = setInterval(topTeacherTimerImpl, speed); //设置定时器
	});
}
function topTeacherTimerImpl(){
	$("#ul_teacher").find("li").hide();
	for (var i = 0; i < 6; i++) {
		$("#ul_teacher").find("#topteacher_" + (timer_topTeacher_params.curIndex + i)).show();
	}
	timer_topTeacher_params.curIndex = (timer_topTeacher_params.curIndex + 6) % timer_topTeacher_params.total;
	
}