function selectMenu3(menu,method){
	$("#ipt_pageNo").unbind("click");
	$("#ipt_pageNo").bind("click",method);
	toPage(1);
	/*$("#table_info td").each(function(){
		alert($(this).text("1"));
	})*/
	$("#ul_menu").find("li[data-node='menu']").removeClass("hover");
	$("#ul_menu2").find("li[data-node='menu']").removeClass("hover");
	$("#"+menu).addClass("hover");
}
function toPage(pn){
	$("div[divtype='jumpdialog']").hide();
	$("#dialog_380").hide();
	$("#dialog_view_380").hide();
	if(pn>0){
		$("#ipt_pageNo").val(pn);
	}
	$("#ipt_pageNo").click();
}
function toPageOnlyRefresh(pn){//界面刷新，不关闭弹出框
	if(pn>0){
		$("#ipt_pageNo").val(pn);
	}
	$("#ipt_pageNo").click();
}
/**
 * @param params
 * 			{
 * 				submitMethod:提交方法,
 * 				submitData:提交方法的参数,
 * 				modelId:模板Id,
 * 				modelData:模板数据,
 * 				title:标题
 * 			}
 * @return
 */
function showDialog380(params){
	showDialogWithWidth(params,380);
}
function showDialogAuto(params,width){
	showDialogWithWidth(params,width);
}
function showDialogWithWidth(params,width){
	$("div[divtype='jumpdialog']").hide();
	$("#dialog_view_380").hide();
	$("#dialog_view_380_display").empty();
	if(params.submitData==null){
		params.submitData = {};
	}
	if(params.modelData==null){
		params.modelData = {};
	}
	$("#dialog_380_submit").unbind("click");
	$("#dialog_380_submit").bind("click",params.submitData,params.submitMethod);
	
	useModel(params.modelId,"dialog_380_display",params.modelData);
	$("#dialog_380_header").html(params.title);
	$("#dialog_380_submit").show();
	$("#dialog_380").width(width);
	$("#dialog_380").jumpBox2(true);
}
function showViewDialogAuto(params,width){
	$("div[divtype='jumpdialog']").hide();
	$("#dialog_380").hide();
	$("#dialog_380_display").empty();
	if(params.submitData==null){
		params.submitData = {};
	}
	if(params.modelData==null){
		params.modelData = {};
	}
	useModel(params.modelId,"dialog_view_380_display",params.modelData);
	$("#dialog_view_380_header").html(params.title);
	$("#dialog_view_380").width(width);
	$("#dialog_view_380").jumpBox2(true);
}
function showDialog380_new(params) {
	if (params.submitData == null) {
		params.submitData = {};
	}
	if (params.modelData == null) {
		params.modelData = {};
	}
	$("#dialog_380_new_submit").unbind("click");
	$("#dialog_380_new_submit").bind("click", params.submitData, params.submitMethod);

	useModel(params.modelId, "dialog_380_new_display", params.modelData);
	$("#dialog_380_new_header").html(params.title);
	$("#dialog_380_new_submit_temp").hide();
	$("#dialog_380_new_submit").show();
	$("#dialog_380_new").jumpBox2(true);
}
function showDialogView380_new(params) {
	if (params.submitData == null) {
		params.submitData = {};
	}
	if (params.modelData == null) {
		params.modelData = {};
	}

	useModel(params.modelId, "dialog_view_380_new_display", params.modelData);
	$("#dialog_view_380_new_header").html(params.title);
	$("#dialog_view_380_new").jumpBox2(true);
}