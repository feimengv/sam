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
<!--{if $action eq "articlereply"}-->
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
								<h5>文章自定义回复管理</h5>
							</div>
							<div class="topcss">
							<form  action="<?=site_url('contentreplys/articlereply')?>" method="post">
							<input type="text" style="width:200px;height:23px;" class="searchkey" name="searchkey" placeholder="请输入文章标题" style="margin-top:7px;">
							<?=$all_cate_select?>
							<a href="javascript:;" onclick="submit()" class="btn btn-primary" style="margin-top:-10px;">查找文章</a>
							</form>
							</div>
							<div class="topcss">
							<a href="<?=site_url('contentreplys/addarticlereply')?>" class="btn btn-primary">添加文章</a>
							目前共[<?=$total?>]条记录
							</div>
							<div class="widget-content">
							<form action="<?=site_url('contentreplys/delarticlereply')?>" method="post">
								<table class="table table-bordered table-striped with-check">
									<thead>
										<tr>
											<th><input name="chkAll" type="checkbox" id="chkAll" onClick="checkAll(this, 'tid[]')" value="checkbox"></th>
											<th width="100">关键词</th>
											<th width="150">标题</th>
											<th>排序</th>
											<th>浏览次数</th>
											<th>文章地址</th>
											<th>推荐</th>
                                            <th>日期</th>
                                            <th>管理</th>
											
										</tr>
									</thead>
									<tbody>
									<?if($result):?>
									<?foreach($result as $k=>$v):?>
									<tr>
											<td><input type="checkbox" name="tid[]" id="checkbox" value="<?=$v['articleid']?>" onClick="checkItem(this, 'chkAll')"></td>
											<td><?=$v['keyword']?></td>
											<td><?=$v['title']?></td>
											<td><input type="text" class="orders" name="orders" value="<?=$v['orders']?>" onblur="myorders(this.value,<?=$v['articleid']?>)"></td>
											<td class='keyred'><?=$v['viewtimes']?></td>
											<td>
											<a href="javascript:;" id="url_button<?=$v['articleid']?>" onmouseover="setbut(<?=$v['articleid']?>)" class="btn btn-primary btn-mini">复制</a>
											<input id="urlval<?=$v['articleid']?>" type="button" value="<?=site_url('micrositeshow/article/'.$v['articleid'])?>" style="display:none;">
											</td>
											<td style="text-align:center">
											<?if($v['elite']==0):?>
												<img id="elite<?=$v['articleid']?>"  src="<?=base_url()?>static/images/no.gif" onClick="fetch_ajax('open',<?=$v['articleid']?>)" style="cursor:pointer;">
											<?else:?>
												<img id="elite<?=$v['articleid']?>"  src="<?=base_url()?>static/images/yes.gif" onClick="fetch_ajax('close',<?=$v['articleid']?>)" style="cursor:pointer;">	
											<?endif;?>
											</td>
                                            <td>
                                            <?=date("Y-m-d",$v['addtime'])?>
                                            </td>
											<td>
                  <a href="<?=site_url('contentreplys/editarticlereply/'.$v['articleid'])?>" class="btn btn-primary btn-mini" title="修改">
                  	修改
                  </a> 
				  <a href="<?=site_url('contentreplys/delarticlereply/'.$v['articleid'])?>" class="btn btn-danger btn-mini" title="删除" onClick="{if(confirm('确定要删除该信息?')){return true;} return false;}" >
                  	删除
                  </a>
                                            
                                            
                                            </td>
									</tr>
									<?endforeach;?>
									<?endif;?>
                                    </tbody>
								</table>
                                
                        <input type="submit" name="button" id="button" class="btn btn-danger" title="删除" value="删除选中文章"  onClick="{if(confirm('确定要删除该信息?')){return true;} return false;}"></label>
						<a href="<?=site_url('contentreplys/addarticlereply')?>" class="btn btn-primary">添加文章</a>
					共[<?=$total?>]条记录 <?=$links?>
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
function fetch_ajax(imgid,id){
	var img_on  = "<?=base_url()?>static/images/yes.gif";
	var img_off = "<?=base_url()?>static/images/no.gif";
	var t = document.getElementById("elite"+id).src;
	if(t.indexOf('yes.gif')<0){
		imgid = 'open';
	}else{
		imgid = 'close';
	}
		params ={articleid:id,elite:imgid};
      	$.ajax({
      	url:"<?=site_url('ajax/article/elite')?>", //后台处理程序
		type: 'POST',
		data:params, 
		dataType: 'json', 
		timeout: 1000, 
		error: function(){}, 
		success: function(result){
		if(result.imgid=='open'){
		$("#elite"+result.id).attr("src",img_on); 
		}else{
		$("#elite"+result.id).attr("src",img_off); 
		}
		}
		});
}
function myorders(n,m){
		params ={orders:n,articleid:m};
      	$.ajax({
      	url:"<?=site_url('ajax/article/orders')?>", //后台处理程序        
		type: 'POST',
		data:params, 
		dataType: 'html', 
		timeout: 1000, 
		error: function(){}, 
		success: function(result){
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