var admission_loadAreaUrl = ctx + "/regions/load";
var admission_registerUrl = ctx + "/recruit/save";
var admission_registerInfoUrl = ctx + "/recruitApply/info/ajax";
var admission_ckeckApplyUrl = ctx + "/recruit/check";
/*
$(document).ready(function(){
	refreshMenu("admission");
	//selectMenu3("recruit_admission",showAdmission);
	doPage_admission();
});
function doPage_admission() {
	var params = {};
	params.url = admission_ckeckApplyUrl + "?_t=" + new Date().getTime();
	params.postData = {schoolId:schoolId};
	params.postType = "get";
	params.error = "加载失败";
	params.mustCallBack = false;// 是否必须回调
	params.callBack = function(json) {
		if (json.retCode == CODE_SUCCESS) {
			showAdmission();
			//useModel("model_apply", "div_display", {msg : json.errorMsg});
			$("#student_ipt_sex").seleFn();
			$("#student_ipt_nation").seleFn();
			$("#student_ipt_health").seleFn();
			$("#guardian_ipt_relation1").seleFn();
			$("#guardian_ipt_relation2").seleFn();
			showAdmissionStartInfo();
			addRegionDefultDiv("div_region",0,REGION_ADMISSION);
			addRegionDefultDiv("div_region",1,REGION_ADMISSION);
			if(json.data.regionInfos){
				var msg = "<p>幼儿园的招生范围是：</p><p style='padding-left: 28px;'>"
					+ getRegionDetail(json.data.regionInfos) + "</p>";
				$("#p_fw_msg").html(msg);
			}
		} else if (json.retCode == CODE_APPLY_NOT_START//没到申请入园时间
				|| json.retCode == CODE_APPLY_END) {//申请入园时间已结束
			useModel("model_admissionError", "div_display", {msg : json.errorMsg});
		}else if (json.retCode == CODE_APPLY_SUBMIT) {//已提交入园申请
			useModel("model_admissionError", "div_display", {msg : json.errorMsg});
		}else if (json.errorMsg != null) {
				alert(json.errorMsg);
				location.href = ctx + "/open/school/"+schoolId+"/index";
		}else{
			alert("请求错误！");
			location.href = ctx + "/open/school/"+schoolId+"/index";
		}
	};
	ajaxJSON(params);
}
*/
function showAdmission(){
	$("#div_setting_cover").show();
}
function showAdmissionStartInfo(){
	var name = $("#ipt_schoolName").val();
	var year = new Date().getFullYear();
	var params = {};
	params.modelId = "model_startInfo";
	params.submitMethod = hideAdmissionStartInfo;
	params.modelData = {name:name,year:year};
	params.title = "家长须知";
	showDialogAuto(params,500);
}
function hideAdmissionStartInfo(){
	$("div[divtype='jumpdialog']").hide();
	$("#dialog_380").hide();
	$("#div_setting_cover").hide();
}
function loadRegionSelList(menu, menuNext) {
	var regionId = $("#area_" + menu).val();
		if (regionId == "") {
		$("#div_area_" + menuNext).html("");
		return;
	}
	$("#student_ipt_region").val(regionId);
	useModel("model_" + menuNext, "div_area_" + menuNext, null);
	var params = {};
	params.url = admission_loadAreaUrl + "?_t=" + new Date().getTime();
	if (regionId != null) {
		params.postData = { regionId : regionId };
	}
	params.postType = "post";
	params.error = "加载失败";
	params.mustCallBack = false;// 是否必须回调
	params.callBack = function(json) {
		if (json.retCode == CODE_SUCCESS) {
				if (json.data.length > 0) {
					$("#ipt_count_" + menuNext).val(json.data.length);
					$("#div_area_" + menuNext).show();
					useModel("model_selAdressList", "area_" + menuNext, json);
					$("#area_" + menuNext).seleFn();
				} else {
					$("#div_area_" + menuNext).hide();
					$("#ipt_count_" + menuNext).val(0);
//					$("#div_area_" + menuNext).html("");
//					if(menuNext=="street"){
//						useModel("model_committee", "div_area_street", null);
//					}
//					else if(menuNext=="hstreet"){
//						useModel("model_hcommittee", "div_area_hstreet", null);
//					}
				}

		} else {
			alert("加载失败！");
		}
	};
	ajaxJSON(params);
}
function loadRegionExtSelList(menu, menuNext) {
	var regionId = $("#area_" + menu).val();
	useModel("model_"+menuNext, "div_area_"+menuNext, null);
	var params = {};
	params.url = admission_loadAreaUrl + "?_t=" + new Date().getTime();
	if (regionId != null) {
		params.postData = { regionId : regionId };
	}
	params.postType = "post";
	params.error = "加载失败";
	params.mustCallBack = false;// 是否必须回调
	params.callBack = function(json) {
		if (json.retCode == CODE_SUCCESS) {
			if (json.data.length > 0) {
				$("#ipt_count_" + menuNext).val(json.data.length);
				$("#div_area_" + menuNext).show();
				useModel("model_selAdressList", "area_" + menuNext, json);
				$("#area_" + menuNext).seleFn();
			} else {
				$("#ipt_count_" + menuNext).val(0);
				$("#div_area_" + menuNext).hide();
			}
		}
	};
	ajaxJSON(params);
}
function submitStudent() {
	var name = $.trim($("#student_ipt_name").val());
	var sex = $.trim($("#student_ipt_sex").val());
	var dateOfBirth = $.trim($("#student_ipt_dateOfBirth").val());
	var nation = $.trim($("#student_ipt_nation").val());
	var health = $.trim($("#student_ipt_health").val());
	var mobile = $.trim($("#student_ipt_mobile").val());
	var committee = $.trim($("#area_committee").val());
	var addressDetails = $.trim($("#ipt_addressDetails").val());
	var datePurchase = $.trim($("#student_ipt_datePurchase").val());
	// 监护人1信息验证
	var relation1 = $.trim($("#guardian_ipt_relation1").val());
	var name1 = $.trim($("#guardian_ipt_name1").val());
	var mobile1 = $.trim($("#guardian_ipt_mobile1").val());
	var workUnit1 = $.trim($("#guardian_ipt_workUnit1").val());
	// 监护人2信息验证
	var relation2 = $.trim($("#guardian_ipt_relation2").val());
	var name2 = $.trim($("#guardian_ipt_name2").val());
	var mobile2 = $.trim($("#guardian_ipt_mobile2").val());
	var workUnit2 = $.trim($("#guardian_ipt_workUnit2").val());
/**********幼儿基本信息检查*******************/
	if (name == "") {
		alert("姓名不能为空！");
		return;
	}
	if (sex == "") {
		alert("性别不能为空！");
		return;
	}
	if (dateOfBirth == "") {
		alert("出生年月不能为空！");
		return;
	}
	if (nation == "") {
		alert("民族不能为空！");
		return;
	}
	if (health == "") {
		alert("健康状况不能为空！");
		return;
	}
	if (mobile == "") {
		alert("住宅电话不能为空！");
		return;
	}

	if (addressDetails == "") {
		alert("街道级以下详细家庭住址为必填项");
		return;
	}


	if (!checkIdNo()) {
		return;
	}
	if (datePurchase == "") {
		alert("购房日期不能为空！");
		return;
	}
/**********监护人1信息检查*******************/
	if (relation1 == "" ) {
		alert("监护人1关系不能为空！");
		return;
	}
	if(name1 == ""){
		alert("监护人1姓名不能为空！");
		return;
	}
	if(mobile1 == ""){
		alert("护人1联系电话不能为空！");
		return;
	}else {//
		var regex_mobile = /^1[0-9]{10}$/;// 手机号
		if (!regex_mobile.test(mobile1)) {
			alert("监护人1联系电话只能为11位的手机号！");
			return;
		}
	}
	if (workUnit1 == "") {
		alert("监护人1工作单位不能为空！");
		return;
	}
/**********监护人2信息检查*******************/
	if (relation2 == "" ) {
		alert("监护人2关系不能为空！");
		return;
	}
	if(name2 == ""){
		alert("监护人2姓名不能为空！");
		return;
	}
	if(mobile2 == ""){
		alert("护人2联系电话不能为空！");
		return;
	}else {//
		var regex_mobile = /^1[0-9]{10}$/;// 手机号
		if (!regex_mobile.test(mobile2)) {
			alert("监护人2联系电话只能为11位的手机号！");
			return;
		}
	}
	if (workUnit2 == "") {
		alert("监护人2工作单位不能为空！");
		return;
	}
/**********两个监护人相似信息检查*******************/
	if (relation1 == relation2 ) {
		alert("两个监护人关系不能相同！");
		return;
	}
	if(name1 == name2){
		alert("两个监护人姓名不能相同！");
		return;
	}
	if(mobile1 == mobile2){
		alert("两个监护人电话不能相同！");
		return;
	}
/**********信息检查完毕*******************/
	var params = {};
	params.url = admission_registerUrl + "?_t=" + new Date().getTime();
	params.postData = $("#form_student").serialize();
	params.postType = "post";
	params.error = "保存失败";
	params.mustCallBack = false;// 是否必须回调
	params.callBack = function(json) {
		if (json.retCode == CODE_SUCCESS) {
			showAdmissionRegistSuccess();
		} else if (json.retCode == CODE_USER_EXIST) {
			if (json.errorMsg != null) {
				alert(json.errorMsg);
			} else {
				var idNo = $.trim($("#student_ipt_idNo").val());
				alert("幼儿【" + name + "】身份证【" + idNo + "】已注册！");
			}
		} else {
			if (json.errorMsg != null) {
				alert(json.errorMsg);
			} else {
				alert("保存失败！");
			}
		}
	};
	ajaxJSON(params);
}
function showAdmissionRegistSuccess(){
	var idNo = $.trim($("#student_ipt_idNo").val());
	var params = {};
	params.modelId = "model_registSuccess";
	params.modelData={idNo:idNo};
	params.submitMethod = doForwardLogin;
	params.title = "温馨提示";
	//showViewDialogAuto(params);
	showDialogAuto(params);
}
function doForwardLogin(){
	location.href = ctx + "/open/apply/"+schoolId+"/login";
}
function checkIdNo(){
	var sexStr = $.trim($("#student_ipt_sex").val());
	var dateOfBirth = $.trim($("#student_ipt_dateOfBirth").val());
	var idNo = $.trim($("#student_ipt_idNo").val());
	if(sexStr==""){
		alert("请先选择性别！");
		return false;
	}
	if(dateOfBirth==""){
		alert("请先选择出生日期！");
		return false;
	}
	if (idNo=="") {
		alert("身份证号不能为空！");
		return false;
	}
	/*
	if (idNo != "") {
		var checkCardNoRes = IdentifyCodeValid_2(idNo, false);
		if (!checkCardNoRes.pass) {
			alert(checkCardNoRes.msg);
			return false;
		}else {
			if(!checkIdNoAndBirthday(idNo,dateOfBirth)){
				alert("出生日期与身份证不匹配,将自动修改！");
				$("#student_ipt_dateOfBirth").val(idNo.substring(6,14));
			}
			if(!checkIdNoAndSex(idNo,sexStr=="FALSE"?1:0)){
				alert("性别与身份证不匹配,将自动修改！");
				$("#student_ipt_sex").val(sexStr="FALSE"?"TRUE":"FALSE");
			}
		}
	}
	*/
	return true;
}