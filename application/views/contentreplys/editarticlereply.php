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
<link rel="stylesheet" href="<?=base_url()?>static/js/kindeditor-org/themes/default/default.css" />
<script type='text/javascript' src='<?=base_url()?>static/js/kindeditor-org/kindeditor-all.js'></script>
<script type='text/javascript' src='<?=base_url()?>static/js/kindeditor-org/zh_CN.js'></script>
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
<!--{if $action eq "addarticlereply"}-->
<div id="content">
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="span12">
                        <div class="widget-box">
							<div class="widget-title">
								<span class="icon">
									<i class="icon-align-justify"></i>									
								</span>
								<h5>多图文章自定义回复<font color="red">（*多个关键词用空格分隔）</font></h5>
							</div>
							<div class="widget-content nopadding">
							<div class="alert alert-success" id="message" style="display:none">
                                <button class="close" data-dismiss="alert" onclick="closemsg()">×</button>
								<strong id="tishimsg"></strong>
                            </div>
							<?echo validation_errors()?>
								<form action="<?=site_url('contentreplys/editarticlereply/'.$articleid)?>" method="post"   class="form-horizontal">
								    <div class="control-group">
										<label class="control-label">关键词<font class="keyred">*</font></label>
										<div class="controls">
											<input id="keyword" name="data[keyword]" value="<?=$keyword?>" type="text" size="91" maxlength="30">
											<span class="help-block">微信用户输入关键词返回相应内容</span>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">关键词类型<font class="keyred">*</font></label>
										<div class="controls">
											<input type="radio" name="data[keymatch]" value=0 <?if($keymatch==0):?>checked<?endif;?>>
											<span class="radiocon">完全匹配</span>
											<input type="radio" name="data[keymatch]" value=1 <?if($keymatch==1):?>checked<?endif;?> >
											<span class="radiocon">包含匹配</span>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">标题<font class="keyred">*</font></label>
										<div class="controls">
											<input id="title" name="data[title]" value="<?=$title?>" type="text" size="91" maxlength="60" >
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">简介<font class="keyred">*</font></label>
										<div class="controls">
											<textarea name="data[introduction]" id="textarea" cols="80" rows="5"><?=$introduction?></textarea>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">封面图片<font class="keyred">*</font></label>
										<div class="controls ke-upload-area">
											<input type="text" id="uploadfiles" name="data[uploadfiles]" value="<?=$uploadfiles?>"/> <input id="upload_button" class="btn btn-primary" type="button" value="选择图片" />
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
										<label class="control-label">排序</label>
										<div class="controls">
											<input name="data[orders]" value="<?=$orders?>" type="text" size="30" maxlength="60" >
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">文章分类</label>
										<div class="controls">
											<?=$all_cate_select;?>
											<span class="help-block">请选择文章所属分类</span>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">访问分类<font class="keyred">*</font></label>
										<div class="controls">
										  <input type="radio" name="data[accesstype]" value=0 <?if($accesstype==0):?>checked<?endif;?> onClick="article1()">
										  <span class="radiocon">站内文章</span>
										  <input type="radio" name="data[accesstype]" value=1 <?if($accesstype==1):?>checked<?endif;?> onClick="article2()">
										  <span class="radiocon">站外文章</span>
										</div>
									</div>
									<div class="control-group <?if($accesstype==0)echo 'hidden'?>" id="articleaddress">
										<label class="control-label">站外地址<font class="keyred">*</font></label>
										<div class="controls">
											<input name="data[articleaddress]" value="<?=$articleaddress?>"  type="text" size="91" maxlength="200" >
											<span class="help-block">输入此地址，微信端用户点击图文即跳转到此网址</span>
										</div>
									</div>
									<div class="control-group <?if($accesstype==1)echo 'hidden'?>" id="contentcss">
										<label class="control-label">正文内容<font class="keyred">*</font></label>
										<div class="controls">
										<textarea id="editor_id" name="data[content]" style="width:600px;height:400px;visibility:hidden;"><?=$content?></textarea>
										<script>
										//flash插入用flash,如果插入视频用flv,如果插入音频用media
										var editor;
										KindEditor.ready(function(K) {
											editor = K.create('#editor_id', {
												allowFileManager : true,
												width:'600px',
												minWidth:600,
												items :[
															'source', '|', 'undo', 'redo', '|', 'preview', 'print', 'template','copy', 'paste',
															'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright',
															'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
															'superscript', 'clearhtml', 'quickformat', 'selectall', '|', 'fullscreen',
															'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',
															'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image','multiimage',
															'table', 'hr', 'emoticons', 'baidumap','flash','media',
															 'link', 'unlink', '|'
														],
											});
										});
										</script>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">多图文添加</label>
										<div class="controls">
											<a href="#TB_inline?height=auto&width=400&inlineId=myOnPageContent" title="多图文展示" class="thickbox btn btn-primary btn-mini" type="button">多图文</a>
										</div>
									</div>
									<div class="key1" id="myshowarticle">
									<div  style="width:100%;" id="showarticle">
									<?if($editmanyarticle):?>
									<?foreach($editmanyarticle as $v):?>
									<div class='keyarticle' id='article<?=$v['articleid']?>'><?=$v['title']?><input name='data[manyarticle][]' class='keyarticle csshidden'   value="<?=$v['articleid']?>"><img src='<?=base_url()?>static/images/pic22.gif' onclick='delarticleinput(<?=$v['articleid']?>)'></div>
									<?endforeach;?>
									<?endif;?>
									</div>
									</div>
									<div style="clear:both"></div>
									<div id="myOnPageContent" style="display:none;">
											<div class="formcss font2" class="inputweizhi" id="artcon">
											  <table width="390" border="0" cellspacing="1" bgcolor="#BACDDC">
												<tr class="tabletop">
												  <td width="60" height="40" bgcolor="#e8e8e8">选择</td>
												  <td width="240" bgcolor="#e8e8e8">标题</td>
												  <td width="90" bgcolor="#e8e8e8">日期</td>
												</tr>
												<?if($all_article):?>
												<?foreach($all_article as $k=>$v):?>
												<tr class="tablecontent" bgcolor="#FFFFFF" onMouseOver="this.bgColor='#e8e8e8'" onMouseOut="this.bgColor='#FFFFFF'">
												  <td height="40"><label>
												   <input type="checkbox" class="articlecheckbox<?=$v['articleid']?>" name="arrid[]" id="checkbox" value="<?=$v['articleid']?>" onClick="checkItem(this, 'chkAll')" onChange="winchange(this,<?=$v['articleid']?>,'<?=$v['title']?>')">
												   <input class="csshidden" type="text" name="pagetitle[]" value="<?=$v['articleid']?>">
												  </label></td>
												  <td><?=$v['title']?></td>
												  <td><?=date('Y-m-d',$v['addtime'])?></td>
												</tr>
												<?endforeach;?>
												<?endif;?>
												<tr class="tablecontent" bgcolor="#FFFFFF" onMouseOver="this.bgColor='#e8e8e8'" onMouseOut="this.bgColor='#FFFFFF'">
												  <td height="40"><input name="chkAll" type="checkbox" id="chkAll" onClick="checkAll(this, 'arrid[]')" onChange="winchangeall(this,'arrid[]','pagetitle[]')" value="checkbox">
													全选</td>
												  <td colspan="5">
													<input type="button" value="确认选择" onClick="tb_remove()">				
													</td>
												  </tr>
											  </table>
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
<script type="text/javascript" src='<!--{$skinpath}-->js/commonpage.js'></script>
<script type="text/javascript">
function pictype1(){
	$("#firstpic").css("display","none");
	$("#picaddressweb").css("display","block");
}
function pictype2(){
	$("#firstpic").css("display","block");
	$("#picaddressweb").css("display","none");
}
function article1(){
	document.getElementById("articleaddress").style.display="none";
	document.getElementById("contentcss").style.display="block";
	document.getElementById("oldaddress").style.display="block";
}
function article2(){
	document.getElementById("articleaddress").style.display="block";
	document.getElementById("contentcss").style.display="none";
	document.getElementById("oldaddress").style.display="none";
}
function closewin(){
	document.getElementById("myOnPageContent").style.display="none";
}
function winchange(e,t,itemName){
	if(e.checked){
	if($("#article"+t).length<=0){
	$("#showarticle").append("<div class='keyarticle' id='article"+t+"'>"+itemName+"<input name='data[manyarticle][]' class='keyarticle csshidden'   value="+t+"><img src='<?=base_url()?>static/images/pic22.gif' onclick='delarticleinput("+t+")'></div>");
	}
	}else{
	$("#article"+t).remove();
	}
	//if(e.checked)document.getElementById("article"+t).style.display="block";
	//if(!e.checked)document.getElementById("article"+t).style.display="none";
}
function winchangeall(e, itemName,n){
  var aa = document.getElementsByName(itemName);
  var tt = document.getElementsByName(n);
  for (var i=0; i<aa.length; i++)
	if(e.checked){
   //document.getElementById("article"+aa[i].value).style.display="block";
   $("#showarticle").append("<div class='keyarticle' id='article"+aa[i].value+"'>"+tt[i].value+"<input name='data[manyarticle][]' class='keyarticle csshidden'   value="+aa[i].value+"><img src='<?=base_url()?>static/images/pic22.gif' onclick='delarticleinput("+aa[i].value+")'></div>");
   }else{
   $("#article"+aa[i].value).remove();
   }
}
function delarticleinput(n){
	$("#article"+n).remove();
	$(".articlecheckbox"+n).attr("checked",false);
}
</script>
<script>
function dourlweb(url){
location.href= url;
}
</script>
<!--{/if}-->
<div class="clr"></div>
     </div>
    </div>
<?=$this->load->view('bottom')?>
</div>
<script type="text/javascript">
function check_submit()
{
	var keyword = $("#keyword").val();
	var title = $("#title").val();
	var uploadfiles = $("#uploadfiles").val();
	if(keyword=="")
	{

			$("#message").css("display","block")
            $('#tishimsg').html('关键词不允许为空');
            $("#oldpassword").focus();
			return false;
	}
	if(title=="")
	{
			$("#message").css("display","block")
            $('#tishimsg').html('标题不允许为空');
            $("#newpassword").focus();
			return false;
	}
	if(uploadfiles=="")
	{
			$("#message").css("display","block")
            $('#tishimsg').html('图片不允许为空');
            $("#newpassword").focus();
			return false;
	}
	return true;
}
</script>
</body>
</html>