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
<!--{if $action eq "attentionreply"}-->
<div id="content">
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="span12">
                        <div class="widget-box">
							<div class="widget-title">
								<span class="icon">
									<i class="icon-align-justify"></i>									
								</span>
								<h5>被关注自定义回复</h5>
							</div>
							<div class="widget-content nopadding">
								<form action="<?=site_url('contentreplys/attentionreply')?>" method="post"   class="form-horizontal">
									<div class="control-group">
										<label class="control-label">被关注自动回复</label>
										<div class="controls">
											<textarea name="data[message]" id="textarea" cols="80" rows="7"><?=$message?></textarea>
										</div>
									</div>
									
									<div class="form-actions">
										 <button type="submit" class="btn btn-primary">确认提交</button>
									</div>
								</form>
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