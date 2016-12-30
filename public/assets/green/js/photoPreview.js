var sWidth;
var sHeight;
//var limitWidth;//设置默认宽度
//var limitHeight;//设置默认高度
var hasload = false;//jQuery('#cropbox').Jcrop时好象是不是也是要reload一次img
var hasbind = false;

function showPhotoEdit(){
	$("#dialog_photoEdit").jumpBox2(true);
}
function userPhotoDisplayInit(){
	var _html = "";
	_html += '<div class="item right preview_fake" style="width:250px;">';
	_html += '	<p>预览</p>';
	_html += '	<p>仅支持IPG、GIF、PNG格式，文件小于5M（使用高质量图片，可生成高清头像）</p>';
	_html += '	<div id="preview_fake" style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale);width:120px;height:120px;overflow:hidden;">';
	_html += '		<img id="preview" style="padding:5px; border:1px solid #f1f1f1;" />';
	_html += '	</div>';
	_html += '</div>';
	_html += '<div id="cropbox_fake" class="item left preview_fake_1">';
	_html += '	<img id="cropbox" onload="tt(this);" />';
	_html += '</div>';
	_html += '<div class="clear"></div>';
	$("#crop-area").html(_html);
}
function userPhotoTempUpload() {
	userPhotoDisplayInit();

	var formData = new FormData($( "#form_photoEdit_1" )[0]);
	$.ajax({
		url  : dynamic_Upload,
		type : "post",
		data : formData,
		dataType: "json",
		contentType : false,
		processData : false,
		success : function(json) {
			var data = json.data;
			if(json.retCode==CODE_SUCCESS){
				hasload=false;
				hasbind = false;
				$("#cropbox").attr("src",data.img);
				$("#preview").attr("src",data.img);
				$("#userPhoto_ipt_fid").val(data.id);
				$("#dialog_photoEdit_save").show();
			}else if(json.retCode==CODE_NOT_LOGIN){
				alert("登录超时，请重新登录！");
			}else{
				alert("图片上传失败！");
			}
		},
	});

//	limitWidth = 250;
//	limitHeight = 200;
	//$("#form_photoEdit_1").attr("action",ctx+"/attachment/tempUploadUserPhoto");
	//$("#form_photoEdit_1").submit();
}
function userPhotoTempUpload_callBack(retCode,id){
	if(CODE_SUCCESS==retCode){
		hasload=false;
		hasbind = false;
		$("#cropbox").attr("src",ctx+"/attachment/photo/pic_view/"+id+"/"+id+".jpg");
		$("#preview").attr("src",ctx+"/attachment/photo/source/"+id+"/"+id+".jpg");
		$("#userPhoto_ipt_fid").val(id);
		$("#dialog_photoEdit_save").show();
	}else if(CODE_NOT_LOGIN==retCode){
		alert("登录超时，请重新登录！");
	}else{
		alert("图片上传失败！");
	}
}

/**
 * 保存裁剪图片
 * @param param
 * @return
 */
function userPhotoUpload() {
	var param = document.getElementById("ipt_userPhoto");
	if(param.value != ""){
		if (!param.value.match(/.jpg|.gif|.png|.bmp/i)) {
			alert("\u56fe\u7247\u683c\u5f0f\u65e0\u6548\uff01");
			return false;
		}
	}
	if($("#x1").val()==0 && $("#y1").val()==0 && $("#x2").val()==75 &&
			$("#y2").val()==75 && $("#w").val()==75 && $("#h").val()==75){
		alert("请移动选中框,调整裁剪区域");
		return false;
	}

	var postData = $("#form_photoEdit_2").serialize();
	var params = {};
	params.url = ctx+"/userPhoto/save";
	params.postData = postData;
	params.postType = "post";
	params.error = "头像设置失败";
	params.mustCallBack = true;//是否必须回调
	params.callBack = function (json){
		if(json.retCode!=CODE_SUCCESS){
			alert("头像设置失败！");
		}else{
			$("#img_userPhoto").attr("src",json.img);
			alert("头像设置成功！");
			$("#dialog_photoEdit").hide();
		}
	};
	ajaxJSON(params);
}


//设置图片的src属性
function setPicture(objPreview){
	var cropboxWidth = sWidth;
	var cropboxHeight = sHeight;

	//初始裁剪区
	var api = $.Jcrop("#cropbox",{
		setSelect: [0,0,75,75]
	});

	if(!hasbind){
		hasbind = true;
		jQuery('#cropbox').Jcrop({
			onChange: showPreview,
			onSelect: showPreview,
			aspectRatio: 1
		});
	}
}


function showPreview(coords)
{
	if (parseInt(coords.w) > 0)
	{
		var rx = 120 / coords.w;
		var ry = 120 / coords.h;

		jQuery('#preview').css({
			width: Math.round(rx * sWidth) + 'px',
			height: Math.round(ry * sHeight) + 'px',
			marginLeft: '-' + Math.round(rx *coords.x) + 'px',
			marginTop: '-' + Math.round(ry *coords.y) + 'px'
		});
	}

	$('#x1').val(coords.x);
	$('#y1').val(coords.y);
	$('#x2').val(coords.x2);
	$('#y2').val(coords.y2);
	$('#w').val(coords.w);
	$('#h').val(coords.h);

}

function tt(Img){
	if(!hasload){
		hasload=true;
		sWidth=Img.width;
		sHeight=Img.height;
		setPicture(Img);
	}else{
		return;
	}
}