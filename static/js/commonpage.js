var web_domain= 'http://'+location.hostname;

//首页
function commonpage(t,n){
	if(t===''){
		//alert("请填写完整的回复信息！");
		$("#error_text").html("参数错误!");
	}else{
		$.post(web_domain+'/ajax_page.php',{ajcode:1001,page:t,Oldweixinhao:n}, function(msg){	
			if(msg!=""){
			//alert(msg);
			$("#artcon").html(msg);
			//$("#comment_"+t).remove();
			//alert("评论加精成功!");
			//window.location.reload();
			}
		});
	}

}