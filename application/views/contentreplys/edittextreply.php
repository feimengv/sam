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
<!--{if $action eq "addtextreply"}-->
<div id="content">
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="span12">
                        <div class="widget-box">
							<div class="widget-title">
								<span class="icon">
									<i class="icon-align-justify"></i>									
								</span>
								<h5>文本自定义回复</h5>
							</div>
							<div class="widget-content nopadding">
							<?=validation_errors()?>
								<form action="<?php echo site_url('contentreplys/edittextreply/'.$id)?>" method="post"   class="form-horizontal">
								    <div class="control-group">
										<label class="control-label">关键词设置<font class="keyred">*</font></label>
										<div class="controls">
											<input name="data[keywords]" type="text" size="91" maxlength="60" value="<?=$keywords?>">
											<span class="help-block">微信用户输入关键词返回相应内容</span>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">关键词类型<font class="keyred">*</font></label>
										<div class="controls">
											<input type="radio" name="data[keymatch]" value=0 <?if($keymatch==0):?>checked<?endif;?>>
											<span class="radiocon">完全匹配</span>
											<input type="radio" name="data[keymatch]" value=1 <?if($keymatch==1):?>checked<?endif;?>>
											<span class="radiocon">包含匹配</span>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">回复内容<font class="keyred">*</font></label>
										<div class="controls">
											<textarea name="data[content]" id="textarea" cols="80" rows="7"><?=$content?></textarea>
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