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
<!--{if $action eq "textreply"}-->
<div id="content">
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="span12">
                    	<div class="widget-box">
							<div class="widget-title">
								<span class="icon">
									<i class="icon-th"></i>
								</span>
								<h5>文本自定义回复管理</h5>
							</div>
							<div class="topcss">
							<a href="<?php echo site_url('contentreplys/addtextreply')?>" class="btn btn-primary">添加文本</a>
							目前共[<?php echo $total;?>]条记录
							</div>
							<div class="widget-content">
							<form action="<?php echo site_url('contentreplys/deltextreply')?>" method="post">
								<table class="table table-bordered table-striped with-check">
									<thead>
										<tr style="text-align:center">
											<th><input name="chkAll" type="checkbox" id="chkAll" onClick="checkAll(this, 'tid[]')" value="checkbox"></th>
											<th>关键词</th>
											<th width="50%">内容</th>
                                            <th>日期</th>
                                            <th>管理</th>
											
										</tr>
									</thead>
									<tbody>
									<?php if($result):?>
									<?php foreach($result as $k=>$v):?>
									<tr>
											<td><input type="checkbox" name="tid[]" id="checkbox" value="<?=$v['id']?>" onClick="checkItem(this, 'chkAll')"></td>
											<td><?=$v['keywords'];?></td>
											<td>
											<?=$v['content']?>
											</td>
                                            <td>
												<?=date("Y-m-d",$v['addtime'])?>
                                            </td>
											<td>
                  <a href="<?=site_url('contentreplys/edittextreply/'.$v['id'])?>" class="btn btn-primary btn-mini" title="修改">
                  	修改
                  </a>
				  <a href="<?=site_url('contentreplys/deltextreply/'.$v['id'])?>" class="btn btn-danger btn-mini" title="删除" onClick="{if(confirm('确定要删除该信息?')){return true;} return false;}" >
                  	删除
                  </a>
                                            
                                            
                                            </td>
									</tr>
									<?php endforeach;?>
									<?php endif;?>
                                    </tbody>
								</table>
                                
                        <input type="submit" name="button" id="button" class="btn btn-danger" title="删除" value="删除操作"  onClick="{if(confirm('确定要删除该信息?')){return true;} return false;}"></label>
						<a href="<?php echo site_url('contentreplys/addtextreply')?>" class="btn btn-primary">添加文本</a>
					共[<?php echo $total;?>]条记录 <?php echo $links;?>
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
<!--{/if}-->
    <div class="clr"></div>
     </div>
    </div>
<?=$this->load->view('bottom')?>
</div>
</body>
</html>