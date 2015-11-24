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
<!-- 引入编辑器 -->
<link rel="stylesheet" href="<?=base_url()?>static/js/kindeditor/themes/default/default.css" />
<script type='text/javascript' src='<?=base_url()?>static/js/kindeditor/kindeditor-all.js'></script>
<script type='text/javascript' src='<?=base_url()?>static/js/kindeditor/zh_CN.js'></script>
<!-- /引入编辑器 -->
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
<!--{if $action eq "addarticleflreply"}-->
<div id="content">
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="span12">
                        <div class="widget-box">
							<div class="widget-title">
								<span class="icon">
									<i class="icon-align-justify"></i>									
								</span>
								<h5>文章分类回复<font color="red">(*代表必填写)</font></h5>
							</div>
							<div class="widget-content nopadding">
							<div class="alert alert-success" id="message" style="display:none">
                                <button class="close" data-dismiss="alert" onclick="closemsg()">×</button>
								<strong id="tishimsg"></strong>
                            </div>
							<?echo validation_errors()?>
								<form action="<?=site_url('contentreplys/addarticleflreply')?>" method="post" class="form-horizontal">
									<input type="hidden" name="data[addtime]" value="<?=time()?>">
									<input type="hidden" name="data[author]" value="<?=$this->userdata['username']?>">
									<input type="hidden" name="data[Oldweixinhao]" value="<?=$this->userdata['Oldweixinhao']?>">
									<div class="control-group">
										<label class="control-label">所属分类<font class="keyred">*</font></label>
										<div class="controls">
											<?=$cate_select?>
											<span class="help-block">（不选择表示作为一级分类，最多支持二级分类）</span>
										</div>
									</div>
								    <div class="control-group">
										<label class="control-label">名称<font class="keyred">*</font></label>
										<div class="controls">
											<input id="catename" name="data[catename]" type="text" size="91" maxlength="30">
											<span class="help-block">微信用户端显示相应分类名称</span>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">封面图片<font class="keyred">*</font></label>
										<div class="controls ke-upload-area">
											<input type="text" id="uploadfiles" name="data[uploadfiles]"/> <input id="upload_button" class="btn btn-primary" type="button" value="选择图片" />
											<span class="help-block">微信端显示图文的封面图片,建议尺寸600*300像素</span>
											<script>
											KindEditor.ready(function(K) {
												var editor = K.editor({
													allowFileManager : false
												});
												K('#upload_button').click(function() {
													editor.loadPlugin('image', function() {
														editor.plugin.imageDialog({
															imageUrl : K('#uploadfiles').val(),
															clickFn : function(url, title, width, height, border, align) {
																K('#uploadfiles').val(url);
																editor.hideDialog();
															}
														});
													});
												});
											});
											</script>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">外链</label>
										<div class="controls">
											<input id="addressweb" name="data[addressweb]" type="text" size="91" maxlength="300">
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">排序<font class="keyred">*</font></label>
										<div class="controls">
											<input id="orders" name="data[orders]" type="text" value="0" size="91" maxlength="200">
										</div>
									</div>
									<div class="form-actions">
										<button type="submit" onclick="return check_submit()" class="btn btn-primary">确认提交</button>
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
<script type="text/javascript">
function check_submit()
{
	var catename = $("#catename").val();
	var orders = $("#orders").val();
	if(catename=="")
	{

			$("#message").css("display","block")
            $('#tishimsg').html('分类名称不允许为空');
            $("#oldpassword").focus();
			return false;
	}
	if(orders=="")
	{
			$("#message").css("display","block")
            $('#tishimsg').html('排序不允许为空');
            $("#newpassword").focus();
			return false;
	}
	return true;
}
</script>
</body>
</html>