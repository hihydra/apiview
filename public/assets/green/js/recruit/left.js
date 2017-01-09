
function refreshMenu(item){
	$("#ul_menu").find("li[data-node='menu']").removeClass("hover");
	$("#ul_menu2").find("li[data-node='menu']").removeClass("hover");
	$("#recruit_"+item).addClass("hover");
}
function toPage(pn) {
	if (pn > 0) {
		$("#ipt_pageNo").val(pn);
	}
	$("#ipt_pageNo").click();
}
function refreshLeftMenu(item){
	//$("#div_display").html("加载中...");
	$("#ul_menu3").find("li a").removeClass("hover");
	$("#li_"+item).find("a").addClass("hover");
}