var recruit_loadAreaListUrl = ctx + "/regions/load";

var CITY_DEFAULT = 407684;//默认为武汉市
var REGION_NEWPAGE = 101;//后台
var REGION_ADMISSION = 102;//招生


function selRegion(preId,no,type){
	var regionId = $("#region_"+preId+"_"+no).val();
	var userType = $("#ipt_userType").val();
	var params = {};
	params.url = recruit_loadAreaListUrl + "?_t=" + new Date().getTime();
	if (regionId != null) {
		params.postData = {regionId : regionId};
	}
	params.postType = "post";
	params.error = "加载失败";
	params.mustCallBack = true;// 是否必须回调
	params.callBack = function(json) {
		if (json.retCode == CODE_SUCCESS) {
			if(json.data.length > 0){
				//nextRegion(preId,regionId,json.data,no,type);
				$("#div_region_"+preId+"_"+no).append(optHtml(regionId,no,type,json.data));
				$('select').comboSelect();
			}else{
				if (type == REGION_NEWPAGE) {
					var flg = checkRegionIds("div_regionIds", regionId);
					!flg ? $("#ipt_addRegion").show() : $("#ipt_addRegion").hide();
					$("#div_region_" + preId+"_"+no).children('div').remove();
				}else if(type == REGION_ADMISSION){
					var region = getRegion("div_region_"+no);
					var dataJson = JSON.stringify(region);
					$("#ipt_region_"+no).val(dataJson);
				}
			}
		} else {
			alert("加载失败！");
		}
	};
	ajaxJSON(params);
}

function optHtml(preId,no,type,json){
	temp_html = '<div id="div_region_'+preId+'_'+no+'">';
	temp_html += '<select id="region_'+preId+'_'+no+'" class="seleCss" onchange="javascript:selRegion('+preId+','+no+','+type+');" cmenu="true">';
	temp_html += '<option value="">--请选择--</option>';
	$.each(json, function(){
		temp_html += '<option value="'+this.id+'">'+this.name+'</option>';
	});
	temp_html += '</select></div>';
	return temp_html;
}

function showInitialRegions(regions){
	for (var i = 0; i < regions.length; i++) {
		var region = regions[i];
		var dataJson = JSON.stringify(region);
		var lastDataId = region.data[region.data.length-1].id;
		addRegionInfo(i,dataJson,region.names,lastDataId);
	}
}
function getRegionDetail(regions){
	var msg = "";
	for (var i = 0; i < regions.length; i++) {
		var region = regions[i];
		msg += regions[i].names;
		if(i < regions.length-1){
			msg += "、";
		}
	}
	return msg;
}

function addRegionDefultDiv(regionsssDivId,no,type){
	useModelAppend("model_region_defult", regionsssDivId+"_"+no, {no:no,type:type});
	$("#region_0_"+no).seleFn();
	selRegion(0,no,type);
	return ;
}
function nextRegion(preId,currId,regions,no,type){
	$("#div_region_" + preId+"_"+no).children('div').remove();
	useModelAppend("model_addRegionDiv", "div_region_" + preId+"_"+no, {id:currId,no:no});

	useModel("model_region", "div_region_" + currId+"_"+no, {preId:currId,no:no,type:type});
	useModel("model_selList", "region_" + currId+"_"+no, {data:regions});
	$("#region_" + currId+"_"+no).seleFn();
}


function addRegion(regionsssDivId,no) {
	$("#ipt_addRegion").hide();
	var count = parseInt($("#ipt_count_region").val());
	$("#div_regionInfo").show();
	var region = getRegion(regionsssDivId+"_"+no);
	var dataJson = JSON.stringify(region);
	var lastDataId = region.data[region.data.length-1].id;
	addRegionInfo(count,dataJson,region.names,lastDataId);
}
function addRegionInfo(count,dataJson,names,lastDataId){
	useModelAppend("model_addRegion", "div_regionInfo", {count:count,dataJson:dataJson,names:names});
	useModelAppend("model_addRegionIds", "div_regionIds", {count:count,lastDataId:lastDataId});
	count++;
	$("#ipt_count_region").val(count);
}
function delRegion(count) {
	$("#regionIds_" + count).remove();
	$("#ipt_regionIds_" + count).remove();
}
function getRegion(regionsssDivId) {
	var region = {};
	var data = [];
	var names = "";
	var count = 0;
	$("#"+regionsssDivId+" select").each(function() {
		var ele = {};
		ele.id = $(this).val();
		ele.name = $(this).find("[value="+ele.id+"]").text();
		data[count] = ele;
		names += ele.name;
		count++;
	});
	region.data = data;
	region.names = names;
	return region;
}
function getAllRegionJsonStr(){
	var regions = [];
	var count = 0;
	$("#div_regionInfo div input").each(function() {
		regions[count++] = jQuery.parseJSON($(this).val());
	});
	if(count==0)return null;
	return JSON.stringify(regions);
}
function checkRegionIds(regionIdsDiv, regionId) {
	var flg = false;
	$("#div_regionIds input").each(function() {
		var id = $(this).val();
		if (id == regionId) {//地址已存在
			flg = true;
			return false;
		}
	});
	return flg;
}
