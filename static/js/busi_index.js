$(document).ready(function(){
		$(".bar_bg").removeClass("bar_click");
	   $(".weixinkefu").addClass("bar_click");
		
		
		$(".OverviewLogo").find("img").hover(function(){
			$(this).css("border-radius","55px");
			
		},function(){
			$(this).css("border-radius","15px");
		});
		
		//遮罩
		
		var nextpage = geturl().params.nextpage||'';
		if(nextpage==1){
			$(".showmask1").show();
			$(".maskshownull").hide();
		}
		$("#page-1").click(function(){
			location.href="/mpkeyreply.action?nextpage=2";
		});
		
		$(".needmoney").click(function(){
			alert("余额不足！");
		});
		
		$(".mpbusiness").click(function(){
			var mpbusinessid = $(this).attr("mpbusinessid"); 
			var status = $(this).attr("status");
			
			if(status ==1){
				 if(confirm("是否要停止此服务！")){
					 location.href="/weixinbusi.action?op=updateMpBusiness&mpbusinessid="+mpbusinessid;
		    	 }
			}else if(status==2){
				if(confirm("是否要开启此服务！")){
					location.href="/weixinbusi.action?op=updateMpBusiness&mpbusinessid="+mpbusinessid;
		    	 }
			}
		});		
		
		$(".Overview1,.Overview1_over").hover(function(){
			$(".Overview1_over").css("display","block");
		},function(){
			$(".Overview1_over").css("display","none");
		});
		$(".Overview2,.Overview2_over").hover(function(){
			$(".Overview2_over").css("display","block");
		},function(){
			$(".Overview2_over").css("display","none");
		});
		$(".Overview3,.Overview3_over").hover(function(){
			$(".Overview3_over").css("display","block");
		},function(){
			$(".Overview3_over").css("display","none");
		});
		$(".Overview4,.Overview4_over").hover(function(){
			$(".Overview4_over").css("display","block");
		},function(){
			$(".Overview4_over").css("display","none");
		});
		
		$(".QuickBox dd a").hover(function(){
			$(this).css("background","#FFF");
		},function(){
			$(this).css("background","");
		});
		
	$(".Normal").click(function(){
		$(".Free").show();
		$(".Standard").hide();
		$(".Business").hide();
		$(".CriteriaBtn").show();
		$(".CommerBtn").hide();
		$(".UpgradePop").show();
		$(".VerifyControlText").empty();
		$("<h1>标准版权限</h1>").appendTo(".VerifyControlText");
	});
	$(".UpgradeClose").click(function(){
		$(".UpgradePop").hide();
	});
	$(".Commerce").click(function(){
		$(".Free").hide();
		$(".Standard").show();
		$(".Business").hide();
		$(".CriteriaBtn").hide();
		$(".CommerBtn").show();
		$(".UpgradePop").show();
		$(".VerifyControlText").empty();
		$("<h1>商务版权限</h1>").appendTo(".VerifyControlText");
	});
	$(".Commerce_from_free").click(function(){
		$(".Free").hide();
		$(".Standard").hide();
		$(".Business").show();
		$(".CriteriaBtn").hide();
		$(".CommerBtn").show();
		$(".UpgradePop").show();
		$(".VerifyControlText").empty();
		$("<h1>商务版权限</h1>").appendTo(".VerifyControlText");
	});
	$(".StandardVeriry").click(function(){
		$(".Free").show();
		$(".Standard").hide();
		$(".Business").hide();
		$(".CriteriaBtn").hide();
		$(".CommerBtn").hide();
		$(".UpgradePop").show();
		$(".VerifyControlText").empty();
		$("<h1>商务版权限</h1>").appendTo(".VerifyControlText");
	});
	$(".BusinessVerify").click(function(){
		$(".Free").hide();
		$(".Standard").hide();
		$(".Business").show();
		$(".CriteriaBtn").hide();
		$(".CommerBtn").hide();
		$(".UpgradePop").show();
		$(".VerifyControlText").empty();
		$("<h1>商务版权限</h1>").appendTo(".VerifyControlText");
	});
});
