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
<script type="text/javascript" src='<?=base_url()?>static/js/jquery-1.4.4.min.js'></script>
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
<!--{if $action eq "articleflreply"}-->
<script type="text/javascript">
function setbut(n){
  var clip = new ZeroClipboard.Client();
  clip.setHandCursor( true );
  clip.setCSSEffects( true );
  clip.addEventListener( 'mouseOver', function(client){
    clip.setText( $('#urlval'+n).val() );
  });
  clip.addEventListener( 'complete', function(){alert('复制成功');});
  clip.glue( 'url_button'+n );
}
</script>				
<div id="content">
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="span12">
                    	<div class="widget-box">
							<div class="widget-title">
								<span class="icon">
									<i class="icon-th"></i>
								</span>
								<h5>文章分类管理<font color="red">（系统支持排序即时修改即时生效,无需刷新页面,微信端即时生效修改内容）</font></h5>
							</div>
							<div class="topcss">
							<a href="<?=site_url('contentreplys/addarticleflreply')?>" class="btn btn-primary">添加分类</a>
							目前共[<?=$total?>]条记录
							</div>
							<div class="widget-content">
							<form action="<?=site_url('contentreplys/delarticleflreply')?>" method="post">
								<table class="table table-bordered table-striped with-check">
									<thead>
										<tr>
											<th><input name="chkAll" type="checkbox" id="chkAll" onClick="checkAll(this, 'tid[]')" value="checkbox"></th>
											<th>名称</th>
											<th>排序</th>
											<th>分类网址</th>
											<th>显示</th>
                                            <th>日期</th>
                                            <th>管理</th>
											
										</tr>
									</thead>
									<tbody>
									<?if($result):?>
									<?foreach($result as $v):?>
									<tr>
											<td><input type="checkbox" name="tid[]" id="checkbox" value="<?=$v['cateid']?>" onClick="checkItem(this, 'chkAll')"></td>
											<td style="text-align:left;"><?=$v['catename']?></td>
											<td><input type="text" class="orders" name="orders" value="<?=$v['orders']?>" onchange="myorders(this.value,<?=$v['cateid']?>)"></td>
											<td>
											<a href="javascript:;" id="url_button<?=$v['cateid']?>" onmouseover="setbut(<?=$v['cateid']?>)" class="btn btn-primary btn-mini">复制</a>
											<input id="urlval<?=$v['cateid']?>" type="button" value="<?=site_url('micrositeshow/article_list/'.$v['cateid'])?>" style="display:none;">
											</td>
											<td style="text-align:center">
											<?if($v['flag']==0):?>
												<img id="flag<?=$v['cateid']?>"  src="<?=base_url()?>static/images/no.gif" onClick="fetch_ajax('open',<?=$v['cateid']?>)" style="cursor:pointer;">
											<?else:?>
												<img id="flag<?=$v['cateid']?>"  src="<?=base_url()?>static/images/yes.gif" onClick="fetch_ajax('close',<?=$v['cateid']?>)" style="cursor:pointer;">	
												<?endif;?>
											</td>
                                            <td>
												<?=date("Y-m-d",$v['addtime'])?>
                                            </td>
											<td>
                  <a href="<?=site_url('contentreplys/editarticleflreply/'.$v['cateid'])?>" class="btn btn-primary btn-mini" title="修改">
                  	修改
                  </a>
				  <a href="<?=site_url('contentreplys/delarticleflreply/'.$v['cateid'])?>" class="btn btn-danger btn-mini" title="删除" onClick="{if(confirm('确定要删除该信息?')){return true;} return false;}" >
                  	删除
                  </a>
                                            
                                            </td>
									</tr>
									<?endforeach;?>
									<?endif;?>
                                    </tbody>
								</table>
                                
                        <input type="submit" name="button" id="button" class="btn btn-danger" title="删除" value="删除操作"  onClick="{if(confirm('确定要删除该信息?')){return true;} return false;}"></label>
						<a href="<?=site_url('contentreplys/addarticleflreply')?>" class="btn btn-primary">添加分类</a>
					共[<?=$total?>]条记录
                                <div class="pagination alternate" style=" float:right; margin-top:5px;">
                                        <ul>
                                        	                                            
                                        </ul>
                                    </div>
                                
							</div>
                            
                          
                                    
                              		
                            
						</div>
                    
                    </div>
                </div>
             </div>
</div>
<SCRIPT type=text/javascript>
function myorders(n,m){
		params ={orders:n,cateid:m};
      	$.ajax({
      	url:"<?=site_url('ajax/articlecate/orders')?>", //后台处理程序        
		type: 'POST',
		data:params, 
		dataType: 'text', 
		timeout: 1000, 
		error: function(){}, 
		success: function(result){
		}
		});
}
function fetch_ajax(imgid,id){
	var img_on  = "<?=base_url()?>static/images/yes.gif";
	var img_off = "<?=base_url()?>static/images/no.gif";
	var t = document.getElementById("flag"+id).src;
	if(t.indexOf('yes.gif')<0){
		imgid = 'open';
	}else{
		imgid = 'close';
	}
		params ={cateid:id,flag:imgid};
      	$.ajax({
      	url:"<?=site_url('ajax/articlecate/flag')?>", //后台处理程序        
		type: 'POST',
		data:params, 
		dataType: 'json', 
		timeout: 1000, 
		error: function(){}, 
		success: function(result){
		if(imgid=='open'){
		$("#flag"+id).attr("src",img_on); 
		}else{
		$("#flag"+id).attr("src",img_off); 
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