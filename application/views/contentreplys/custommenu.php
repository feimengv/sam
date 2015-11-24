<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?=$title?></title>
<meta name="keywords" content="">
<meta name="description" content="">

<link rel="stylesheet" type="text/css" href="<?=base_url()?>static/css/public.main.css">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>static/css/public.min.css">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>static/css/menu.css">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>static/css/public.css">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>static/css/copyright.css">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>static/css/thickbox.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>static/css/weixin.css"/>
<script type="text/javascript" src='<?=base_url()?>static/js/jquery-1.7.1.js'></script>
<script type='text/javascript' src='<?=base_url()?>static/js/command.js'></script>
<script type='text/javascript' src='<?=base_url()?>static/js/ZeroClipboard.js'></script>
<script type="text/javascript" src='<?=base_url()?>static/js/thickbox-compressed.js'></script>
<script language=JavaScript>
function logout(){
	if (confirm("您确定要退出控制面板吗？"))
	top.location = "<?=site_url('login/logout')?>";
	return false;
}
function closemsg(){
	$("#message").css("display","none");
}
</script>
</head>

<body screen_capture_injected="true">
<div id="header" class="header">
<?=$this->load->view('head')?>
<div id="main" class="container">
        <div class="containerBox">
			<div class="boxHeader">
                <h2>内容回复管理</h2>
            </div>
<?=$this->load->view('contentreplys/leftmenu')?>
<!--{if $action eq "custommenu"}-->			
<div id="content">
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="span12">
                    	<div class="widget-box">
							<div class="widget-title">
								<span class="icon">
									<i class="icon-th"></i>
								</span>
								<h5>自定义菜单管理<font color="red">（1.先添加一级菜单 2.再添加子菜单 触发关键词或url,url:要以http开头!）</font></h5>
							</div>
							<div class="topcss">
							<form id="form1" action="<?=site_url('contentreplys/updatecustommenu')?>" method="post">
									AppId:<input type="text" id="appid" name="data[appid]" value="<?=$key['Appid']?>">　　AppSecret:<input type="text" id="appsecret" name="data[appsecret]" style="width:270px;" value="<?=$key['AppSecret']?>">　<a href="javascript:;" onclick="form1.submit()" class="btn btn-primary">保存</a>
							</form>
							</div>
							<div class="topcss">
							<a href="javascript:;"  class="btn btn-primary addmenu">添加主菜单</a>
							</div>
							<div class="widget-content">
							<?=validation_errors()?>
							<table class="table table-bordered table-striped">
								<tbody id="custommenus"  style="display:none;">
									<tr class="main">
											<td><input type="text" class="orders" name="data[custommenu][0][orders]" value="0"></td>
											<td>
											主菜单：<input type="text" style="width:200px;"  class="catename" name="data[custommenu][0][catename]">
											</td>
											<td><input type="text" class="metatitle" name="data[custommenu][0][metatitle]"></td>
											<td>
											  <a href="javascript:;" class="btn btn-danger btn-mini myparentdel" onclick="parent_del(0)" title="删除">
												删除
											  </a>              
											</td>
									</tr>
									</tbody>
									<tbody id="childmenus" style="display:none;">
									<tr>
											<td></td>
											<td>
											子菜单：<input type="text" style="width:200px;" class="catename" name="data[custommenu][0][childs][][catename]">
											</td>
											<td><input type="text" class="metatitle" name="data[custommenu][0][childs][][metatitle]"></td>
											<td>
											  <a href="javascript:;" class="btn btn-danger btn-mini delmenu" title="删除">
												删除
											  </a>              
											</td>
									</tr>
									</tbody>
							</table>
							<form id="form2" action="<?=site_url('contentreplys/custommenu')?>" method="post">
								<table class="table table-bordered table-striped" id="mymenus">
									<thead>
										<tr>
											<th>排序</th>
											<th>主菜单名称</th>
											<th>触发关键词</th>
                                            <th>管理</th>
											
										</tr>
									</thead>
									<tbody>
									<?if($menus):?>
									<?foreach($menus as $k=>$v):?>
									<tr id="parentmenus<?=$k?>" class="parents main">
											<td><input type="text" class="orders" name="data[custommenu][<?=$k?>][orders]" value="<?=$v['orders']?>"></td>
											<td>
											主菜单：<input type="text" style="width:200px;" id="cate<?=$k?>" class="catename" name="data[custommenu][<?=$k?>][catename]" value="<?=$v['catename']?>"><input type="button" value="添加" onclick="addchildmenu(<?=$k?>)" class="btn btn-danger btn-mini">
											</td>
											<td><input type="text" class="metatitle" name="data[custommenu][<?=$k?>][metatitle]" value="<?=$v['metatitle']?>">
											</td>
											<td>
											  <a href="javascript:;" class="btn btn-danger btn-mini" onclick="parent_del(<?=$k?>)" title="删除">
												删除
											  </a>              
											</td>
									</tr>
									<tbody  class="cmenus<?=$k?> childs">
									<?if($v['childs']):?>
									<?foreach($v['childs'] as $a=>$b):?>
									<tr>
											<td></td>
											<td>
											子菜单：<input type="text" style="width:200px;" class="catename" name="data[custommenu][<?=$k?>][childs][<?=$a?>][catename]" value="<?=$b['catename']?>">
											</td>
											<td><input type="text" class="metatitle" name="data[custommenu][<?=$k?>][childs][<?=$a?>][metatitle]" value="<?=$b['metatitle']?>"></td>
											<td>
											  <a href="javascript:;" class="btn btn-danger btn-mini delmenu" title="删除">
												删除
											  </a>              
											</td>
									</tr>
									<?endforeach;?>
									<?endif;?>
									</tbody>
									<?endforeach;?>
									<?endif;?>
									</tbody>
								</table>
                        <a href="javascript:;" onclick="form2.submit()"  class="btn btn-primary">生成自定义菜单</a>       
                                <div class="pagination alternate" style=" float:right; margin-top:5px;">
                                        <ul>
                                        	                                            
                                        </ul>
                                    </div>
                                
							</div>
                              		
                            </form>
						</div>
                    
                    </div>
                </div>
             </div>
</div>
<SCRIPT type=text/javascript>
$(".addmenu").click(function(){
	var custommenus = $("#custommenus").html();
	var appid = $("#appid").val();
	var appsecret = $("#appsecret").val();
	if(appid==""){
		alert("AppId不能为空");
		return false;
	}
	if(appsecret==""){
		alert("appsecret不能为空");
		return false;
	}
	if($(".main").size()>3){
		alert("主菜单不能超过三个,子菜单不能超过五个");
		return false;
	}
	custommenus = "<tbody>"+custommenus+"</tbody>";
	$("#mymenus").append(custommenus);
	$("#mymenus tbody .main").each(function(i,v){
		// $(this).find("td .mychildmenu").bind("onclick","addchildmenu("+i+")");
		$(this).removeAttr("onclick");
		$(this).find("td .myparentdel").attr("onclick","parent_del("+(i+1)+")");
		$(this).find("td .orders").attr("name","data[custommenu]["+i+"][orders]");
		$(this).find("td .catename").attr("name","data[custommenu]["+i+"][catename]");
		$(this).find("td .metatitle").attr("name","data[custommenu]["+i+"][metatitle]");
	});
	
});
function addchildmenu(i)
{
		var catename = $("#cate"+i).val();
		if(catename=="")
		{
			alert('请先添加主菜单名称和值,并且保存,再添加二级菜单!');
			return false;
		}
		if($(".cmenus"+i+" tr").size()>=5)
		{
			alert('子菜单不允许超过五个');
			return false;
		}
		var childmenus = $("#childmenus").html();
		$(".cmenus"+i).append(childmenus);
		$(".cmenus"+i+" tr").each(function(m,v){
		// $(this).find("td .orders").attr("name","data[custommenu]["+i+"][childs]["+m+"][orders]");
		$(this).find("td .catename").attr("name","data[custommenu]["+i+"][childs]["+m+"][catename]");
		$(this).find("td .metatitle").attr("name","data[custommenu]["+i+"][childs]["+m+"][metatitle]");
		// $(this).find("td .childmenu").attr("name","data[custommenu]["+i+"][childs]["+m+"][childmenu]");
		});
}

function parent_del(n)
{
	if($(".cmenus"+n).children("tr").text()!="")
	{
			alert('请先删除子菜单');
			return false;
	}
	$("#parentmenus"+n).remove();
}

$(".delmenu").live("click",function(){
	$(this).parent().parent().remove();
})
function mycatename(n,m){
		params ={catename:n,cateid:m};
      	$.ajax({
      	url:'ajax_case.php', //后台处理程序        
		type: 'POST',
		data:params, 
		dataType: 'html', 
		timeout: 1000, 
		error: function(){}, 
		success: function(result){
		}
		});
}
function mymetatitle(n,m){
		params ={metatitle:n,cateid:m};
      	$.ajax({
      	url:'ajax_case.php', //后台处理程序        
		type: 'POST',
		data:params, 
		dataType: 'html', 
		timeout: 1000, 
		error: function(){}, 
		success: function(result){
		}
		});
}
function myorders(n,m){
		params ={orders:n,cateid:m};
      	$.ajax({
      	url:'ajax_case.php', //后台处理程序        
		type: 'POST',
		data:params, 
		dataType: 'html', 
		timeout: 1000, 
		error: function(){}, 
		success: function(result){
		}
		});
}
function fetch_ajax(imgid,id){
	var img_on  = "<!--{$skinpath}-->images/yes.gif";
	var img_off = "<!--{$skinpath}-->images/no.gif";
	var t = document.getElementById("elite"+id).src;
	if(t.indexOf('yes.gif')<0){
		imgid = 'open';
	}else{
		imgid = 'close';
	}
		params ={cateid:id,types:imgid};
      	$.ajax({
      	url:'ajax_menu.php', //后台处理程序        
		type: 'POST',
		data:params, 
		dataType: 'html', 
		timeout: 1000,
		error: function(){}, 
		success: function(result){
		if(imgid=='open'){
		$("#elite"+id).attr("src",img_on); 
		}else{
		$("#elite"+id).attr("src",img_off); 
		}
		}
		});
}
</SCRIPT>
<!--{/if}-->
    <div class="clr"></div>
     </div>
    </div>
<?=$this->load->view('bottom')?>
</div>
</body>
</html>