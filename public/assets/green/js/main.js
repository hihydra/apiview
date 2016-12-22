/**
** @ jQuery Plug For :  FormFace Ver2.0
** @ Author :   Maco . Q : 9584290
** @ Mail :       Marcho@vip.qq.com
** @ Date :      2011.06.17
**/
var faceUrl = "/assets/public/face/";
function replaceHtml(html){
	return html.replace(/\[@(F_\d+)\@]/g,"<img src=" + faceUrl + "$1.gif />");
}
$.fn.ReplaceFace = function(){
	//替换符号为图片
	var _this = this;
	var Replace = function(){
		Code = $(_this).html();
		Code = replaceHtml(Code);
		//Code = Code.replace(/\[@/g, "<img src=" + faceUrl + "");
		//Code = Code.replace(/\@]/g, ".gif />");
		$(_this).html(Code);
	};
	Replace();
}
$.fn.FormFace = function(o){
		var d = { faceTitle : "", cid : "", left : "0" , top : "0" };
		var o = $.extend(d, o);
		var A = $(this);
		var Num = 39 ; //图片数量
		var Url = faceUrl;
		var T;
		var L;

		if(o.cid!=""&&$(o.cid).size()>0){
			$(o.cid).ReplaceFace(Url);
		};
		if($(o.faceTitle).size()<=0){
			alert("FormFace插件提醒：未找到 "+o.faceTitle);
			return false;
		};

		//窗口改变时自动调整位置
		$(window).resize(function(){
			Pos();
		});

		//点击图标按钮
		$(o.faceTitle).click(function(event){
			Con();
			Pos();
			event.stopPropagation();
			$("body").unbind("click",faceContent_hide);
			$(o.faceTitle).unbind("mouseout",temp);
			$(o.faceTitle).bind("mouseout",temp);
		});

		var temp = function(){
			$("body").bind("click",faceContent_hide);
		};
		var faceContent_hide = function(){
			$("body").unbind("click",faceContent_hide);
			$("#faceContent").hide();
		};

		//将容器、表情插入页面
		var Con = function(){
			if($("#faceContent").size()>0){Click();$("#faceContent").toggle(); return false; }; //阻止再次点击重复添加
			var cArr = [];
			var iArr = [];
			for (var i = 1; i <= Num; i++) {
				iArr[iArr.length] = "<a href='javascript:'><img src=" + Url + "F_"+i+".gif fn=[@F_" + i + "@] /></a>"
			};
			cArr[cArr.length] ="<style>#faceContent{width:364px; position:absolute;border:1px solid #aaa;border-top:none;z-index:9999; text-align:center;padding:3px;padding-bottom:6px;background:#fff;} #faceContent a img{float:left;cursor:pointer;margin:1px 1px; border:#cacaca 1px solid}  #faceContent a:hover img{border:1px solid #f51d69} </style>"
			cArr[cArr.length] = "<div id='faceContent'>"+iArr.join("")+"</div>";
			$("body").append(cArr.join(""));
			Click();
		};

		//控制弹出的表情容器位置
		var Pos = function(){
			T = $(o.faceTitle).offset().top+$(o.faceTitle).height();
			L = $(o.faceTitle).offset().left;
			$("#faceContent").css("top", parseInt(T)+parseInt(o.top) + "px");
			$("#faceContent").css("left", parseInt(L) +parseInt(o.left) + "px");
		};

		//表情点击
		var Click=function(){
			$("#faceContent img").unbind("click");
			$("#faceContent img").click(function(){
				var V=A.val();
				A.val(V+$(this).attr("fn"));
			});
		};
}

/*****************相关调用**************************/
function showFaceList(replyContent,faceTitle){
	$("#"+faceTitle).attr("onclick","");
	$("#"+replyContent).FormFace({ faceTitle : "#"+faceTitle, cid : "", left : "-5" , top : "5" });
	$("#"+faceTitle).click();
}