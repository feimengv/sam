<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><!--{$config['sitename']}--></title>
<meta name="keywords" content="">
<meta name="description" content="">

<link rel="stylesheet" type="text/css" href="<!--{$skinpath}-->css/public.main.css">
<link rel="stylesheet" type="text/css" href="<!--{$skinpath}-->css/public.min.css">
<link rel="stylesheet" type="text/css" href="<!--{$skinpath}-->css/menu.css">
<link rel="stylesheet" type="text/css" href="<!--{$skinpath}-->css/public.css">
<link rel="stylesheet" type="text/css" href="<!--{$skinpath}-->css/copyright.css">
<link rel="stylesheet" type="text/css" href="<!--{$skinpath}-->css/thickbox.css"/>
<link rel="stylesheet" type="text/css" href="<!--{$skinpath}-->css/weixin.css"/>

<script type="text/javascript" src='<!--{$skinpath}-->js/jquery-1.4.4.min.js'></script>
<script type='text/javascript' src='<!--{$skinpath}-->js/command.js'></script>
<script type='text/javascript' src='<!--{$skinpath}-->js/ZeroClipboard.js'></script>
<script type="text/javascript" src='<!--{$skinpath}-->js/thickbox-compressed.js'></script>
<script type="text/javascript">
    $(document).ready(function () {
		var url= window.location.href;
		url = url.split("?");
		url = url[1].split("&");
		url = url[0].split("=");
        $('#'+url[1]).addClass("selected");
    });
</script>
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
<!--{include file="<!--{$tplpath}-->head.html"}-->
<div id="main" class="container">
        <div class="containerBox">
			<div class="boxHeader">
                <h2>内容回复管理</h2>
            </div>
            <div class="sideBar">
                <div class="catalogList">
                    <ul id="materialList">
					  <li id="attentionreply"><a href="contentreplys.php?action=attentionreply&mod=right&publictid=<!--{$publictid}-->">被关注自动回复</a></li>
					  <li id="nodefinereply"><a href="contentreplys.php?action=nodefinereply&mod=right&publictid=<!--{$publictid}-->">未定义消息回复</a></li> 
					  <li id="voicereply"><a href="contentreplys.php?action=voicereply&mod=right&publictid=<!--{$publictid}-->">语音回复管理</a></li>
					  <li id="textreply"><a href="contentreplys.php?action=textreply&mod=right&publictid=<!--{$publictid}-->">文本回复管理</a></li>
					  <li id="articlereply"><a href="contentreplys.php?action=articlereply&mod=right&publictid=<!--{$publictid}-->">图文回复管理</a></li>
					  <li id="articleflreply"><a href="contentreplys.php?action=articleflreply&mod=right&publictid=<!--{$publictid}-->">文章分类管理</a></li>
					  <li id="custommenu"><a href="contentreplys.php?action=custommenu&mod=right&publictid=<!--{$publictid}-->">自定义菜单</a></li>
                    </ul>
                </div>
            </div>
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
								<form action="contentreplys.php" method="post"   class="form-horizontal">
								<input type="hidden" name="action" value="editattention">
								<input type="hidden" name="username" value="<!--{$username}-->">
								<input type="hidden" name="Oldweixinhao" value="<!--{$Oldweixinhao}-->">
									<div class="control-group">
										<label class="control-label">被关注自动回复</label>
										<div class="controls">
											<textarea name="keycontent" id="textarea" cols="80" rows="7"><!--{$attentionreplyval.WM_Message}--></textarea>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">被关注自动回复</label>
										<div class="controls">
											<input type="checkbox" name="WM_Choose" <!--{if $attentionreplyval.WM_Choose==1}-->checked<!--{/if}-->>开启图文首页
											<span class="help-block">选择中，则默认关注时自动回复图文首页，关闭则回复文字格式提示!</span>
										</div>
									</div>
									<div class="form-actions">
										<input type="button" name="HelloMyweb" value="切换到图文首页" onClick="window.location.href='microsite.php?action=titlepagereply&mod=microsite&publictid=<!--{$publictid}-->'" class="btn btn-primary"> <button type="submit" class="btn btn-primary">确认提交</button>
									</div>
								</form>
							</div>
						</div>			
                    
                    </div>
                </div>
             </div>
</div>
<!--{/if}-->
<!--{if $action eq "nodefinereply"}-->
<div id="content">
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="span12">
                        <div class="widget-box">
							<div class="widget-title">
								<span class="icon">
									<i class="icon-align-justify"></i>									
								</span>
								<h5>未定义消息回复<span class="keyred">(如果为空，则不回复内容!)</span></h5>
							</div>
							<div class="widget-content nopadding">
								<form action="contentreplys.php" method="post"   class="form-horizontal">
									<input type="hidden" name="action" value="editnodefinereply">
									<input type="hidden" name="username" value="<!--{$username}-->">
									<input type="hidden" name="Oldweixinhao" value="<!--{$Oldweixinhao}-->">
									<div class="control-group">
										<label class="control-label">回复内容设置</label>
										<div class="controls">
											<textarea name="keycontent" id="textarea" cols="80" rows="7"><!--{$nodefinereply}--></textarea>
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
							<a href="contentreplys.php?mod=textreply&action=addtextreply" class="btn btn-primary">添加文本</a>
							目前共[<!--{$total}-->]条记录
							</div>
							<div class="widget-content">
							<form action="contentreplys.php" method="post">
							<input type="hidden" name="action" id="action" value="deltextreply" />
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
									<!--{foreach $textreply as $volist}-->
									<tr>
											<td><input type="checkbox" name="tid[]" id="checkbox" value="<!--{$volist.WM_ID}-->" onClick="checkItem(this, 'chkAll')"></td>
											<td><!--{$volist.WM_Title|truncate:12:0:'utf-8'}--></td>
											<td>
											<!--{strip_tags($volist.WM_Message)|truncate:18:0:'utf-8'}-->
											</td>
                                            <td>
												<!--{$volist.WM_Time|date_format:"%Y/%m/%d"}-->
                                            </td>
											<td>
                  <a href="contentreplys.php?mod=textreply&action=edittextreply&tid=<!--{$volist.WM_ID}-->&view=edit" class="btn btn-primary btn-mini" title="修改">
                  	修改
                  </a>
				  <a href="contentreplys.php?mod=textreply&action=deltextreply&tid[]=<!--{$volist.WM_ID}-->" class="btn btn-danger btn-mini" title="删除" onClick="{if(confirm('确定要删除该信息?')){return true;} return false;}" >
                  	删除
                  </a>
                                            
                                            
                                            </td>
									</tr>
									<!--{/foreach}-->
                                    </tbody>
								</table>
                                
                        <input type="submit" name="button" id="button" class="btn btn-danger" title="删除" value="删除操作"  onClick="{if(confirm('确定要删除该信息?')){return true;} return false;}"></label>
						<a href="contentreplys.php?mod=textreply&action=addtextreply" class="btn btn-primary">添加文本</a>
					共[<!--{$total}-->]条记录 <!--{$page}-->/<!--{$pagecount}-->页
					<!--{if $pagecount>1}-->
					<a href="contentreplys.php?action=textreply&mod=right&page=1">首页</a> 
                  <a href="contentreplys.php?action=textreply&mod=right&page=<!--{$beforepage}-->">上一条</a> <a href="contentreplys.php?action=textreply&mod=right&page=<!--{$afterpage}-->">下一条</a> <a href="contentreplys.php?action=textreply&mod=right&page=<!--{$pagecount}-->">尾页</a>
					<!--{/if}-->
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
								<form action="contentreplys.php" method="post"   class="form-horizontal">
								<input type="hidden" name="action" value="addtext">
								<input type="hidden" name="username" value="<!--{$username}-->">
								<input type="hidden" name="Oldweixinhao" value="<!--{$Oldweixinhao}-->">
								    <div class="control-group">
										<label class="control-label">关键词设置<font class="keyred">*</font></label>
										<div class="controls">
											<input name="keywords" type="text" size="91" maxlength="60" >
											<span class="help-block">多个关键词请用空格分割：例如:喜帖 婚庆</span>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">关键词类型<font class="keyred">*</font></label>
										<div class="controls">
											<input type="radio" name="keymatch" value=0 checked>
											<span class="radiocon">完全匹配</span>
											<input type="radio" name="keymatch" value=1>
											<span class="radiocon">包含匹配</span>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">回复内容<font class="keyred">*</font></label>
										<div class="controls">
											<textarea name="keycontent" id="textarea" cols="80" rows="7"></textarea>
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
<!--{if $action eq "edittextreply"}-->
<div id="content">
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="span12">
                        <div class="widget-box">
							<div class="widget-title">
								<span class="icon">
									<i class="icon-align-justify"></i>									
								</span>
								<h5>修改文本自定义回复</h5>
							</div>
							<div class="widget-content nopadding">
								<form action="contentreplys.php" method="post"   class="form-horizontal">
								<input type="hidden" name="action" value="edittextreply">
								<input type="hidden" name="tid" value="<!--{$textreply.WM_ID}-->">
								    <div class="control-group">
										<label class="control-label">关键词<font class="keyred">*</font></label>
										<div class="controls">
											<input name="keywords" type="text" size="91" maxlength="60" value="<!--{$textreply.WM_Title}-->">
											<span class="help-block">多个关键词请用空格分割：例如:喜帖 婚庆</span>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">关键词类型<font class="keyred">*</font></label>
										<div class="controls">
											<input type="radio" name="keymatch" value=0 <!--{if $textreply.keymatch==0}-->checked<!--{/if}-->>
											<span class="radiocon">完全匹配</span>
											<input type="radio" name="keymatch" value=1 <!--{if $textreply.keymatch==1}-->checked<!--{/if}-->>
											<span class="radiocon">包含匹配</span>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">内容<font class="keyred">*</font></label>
										<div class="controls">
											<textarea name="keycontent" id="textarea" cols="80" rows="7"><!--{$textreply.WM_Message}--></textarea>
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
<!--{if $action eq "voicereply"}-->
<div id="content">
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="span12">
                    	<div class="widget-box">
							<div class="widget-title">
								<span class="icon">
									<i class="icon-th"></i>
								</span>
								<h5>语音自定义回复管理</h5>
							</div>
							<div class="topcss">
							<a href="contentreplys.php?mod=voicereply&action=addvoicereply" class="btn btn-primary">添加语音</a>
							目前共[<!--{$total}-->]条记录
							</div>
							<div class="widget-content">
							<form action="contentreplys.php" method="post">
							<input type="hidden" name="action" id="action" value="delvoicereply" />
								<table class="table table-bordered table-striped with-check">
									<thead>
										<tr>
											<th><input name="chkAll" type="checkbox" id="chkAll" onClick="checkAll(this, 'tid[]')" value="checkbox"></th>
											<th>关键词</th>
											<th>标题</th>
                                            <th>日期</th>
                                            <th>管理</th>
											
										</tr>
									</thead>
									<tbody>
									<!--{foreach $voicereply as $volist}-->
									<tr>
											<td><input type="checkbox" name="tid[]" id="checkbox" value="<!--{$volist.WM_ID}-->" onClick="checkItem(this, 'chkAll')"></td>
											<td><!--{$volist.WM_Keyword|truncate:12:0:'utf-8'}--></td>
											<td><!--{$volist.WM_Title|truncate:12:0:'utf-8'}--></td>
                                            <td>
												<!--{$volist.WM_Time|date_format:"%Y/%m/%d"}-->
                                            </td>
											<td>
                  <a href="contentreplys.php?mod=voicereply&action=editvoicereply&tid=<!--{$volist.WM_ID}-->&view=edit" class="btn btn-primary btn-mini" title="修改">
                  	修改
                  </a> 
				  <a href="contentreplys.php?action=delvoicereply&mod=right&tid[]=<!--{$volist.WM_ID}-->" class="btn btn-danger btn-mini" title="删除" onClick="{if(confirm('确定要删除该信息?')){return true;} return false;}" >
                  	删除
                  </a>
                                            
                                            
                                            </td>
									</tr>
									<!--{/foreach}-->
                                    </tbody>
								</table>
                                
                        <input type="submit" name="button" id="button" class="btn btn-danger" title="删除" value="删除操作"  onClick="{if(confirm('确定要删除该信息?')){return true;} return false;}"></label>
						<a href="contentreplys.php?mod=voicereply&action=addvoicereply" class="btn btn-primary">添加语音</a>
					共[<!--{$total}-->]条记录 <!--{$page}-->/<!--{$pagecount}-->页
					<!--{if $pagecount>1}-->
					<a href="contentreplys.php?action=voicereply&mod=right&page=1">首页</a> 
                  <a href="contentreplys.php?action=voicereply&mod=right&page=<!--{$beforepage}-->">上一条</a> <a href="contentreplys.php?action=voicereply&mod=right&page=<!--{$afterpage}-->">下一条</a> <a href="contentreplys.php?action=voicereply&mod=right&page=<!--{$pagecount}-->">尾页</a>
					<!--{/if}-->
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
<!--{if $action eq "addvoicereply"}-->
<div id="content">
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="span12">
                        <div class="widget-box">
							<div class="widget-title">
								<span class="icon">
									<i class="icon-align-justify"></i>									
								</span>
								<h5>语音自定义回复<span class="keyred">(添加音乐的方法http://mp3.sogou.com/搜索你喜欢的歌曲下载,然后复制下载链接!)</span></h5>
							</div>
							<div class="widget-content nopadding">
								<form action="contentreplys.php" method="post"   class="form-horizontal">
								<input type="hidden" name="action" value="addvoice">
								<input type="hidden" name="username" value="<!--{$username}-->">
								<input type="hidden" name="Oldweixinhao" value="<!--{$Oldweixinhao}-->">
								    <div class="control-group">
										<label class="control-label">关键词<font class="keyred">*</font></label>
										<div class="controls">
											<input name="WM_Keyword" type="text" size="91" maxlength="30" >
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">音乐标题<font class="keyred">*</font></label>
										<div class="controls">
											<input name="WM_Title" type="text" size="91" maxlength="200" >
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">音乐链接<font class="keyred">*</font></label>
										<div class="controls">
											<input name="musiclink" type="text" size="91" maxlength="2000" >
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">高音质链接<font class="keyred">*</font></label>
										<div class="controls">
											<input name="hqmusic" type="text" size="91" maxlength="2000" >
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">音乐描述<font class="keyred">*</font></label>
										<div class="controls">
											<textarea name="WM_Description" id="textarea" cols="80" rows="5"></textarea>
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
<!--{if $action eq "editvoicereply"}-->
<div id="content">
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="span12">
                        <div class="widget-box">
							<div class="widget-title">
								<span class="icon">
									<i class="icon-align-justify"></i>									
								</span>
								<h5>修改语音自定义回复<font color="red">（*代表必填写）</font></h5>
							</div>
							<div class="widget-content nopadding">
								<form action="contentreplys.php" method="post"   class="form-horizontal">
								<input type="hidden" name="action" value="editvoicereply">
								<input type="hidden" name="tid" value="<!--{$voicereply.WM_ID}-->">
								    <div class="control-group">
										<label class="control-label">关键词<font class="keyred">*</font></label>
										<div class="controls">
											<input name="WM_Keyword" type="text" size="91" maxlength="30" value="<!--{$voicereply.WM_Keyword}-->">
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">音乐标题<font class="keyred">*</font></label>
										<div class="controls">
											<input name="WM_Title" type="text" size="91" maxlength="200" value="<!--{$voicereply.WM_Title}-->">										</div>
									</div>
									<div class="control-group">
										<label class="control-label">音乐链接<font class="keyred">*</font></label>
										<div class="controls">
											<input name="musiclink" type="text" size="91" maxlength="2000" value="<!--{$voicereply.musiclink}-->">
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">高音质链接<font class="keyred">*</font></label>
										<div class="controls">
											<input name="hqmusic" type="text" size="91" maxlength="2000" value="<!--{$voicereply.hqmusic}-->">
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">音乐描述<font class="keyred">*</font></label>
										<div class="controls">
											<textarea name="WM_Description" id="textarea" cols="80" rows="5"><!--{$voicereply.WM_Description}--></textarea>
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
							<a href="contentreplys.php?mod=articlereply&action=addarticlereply" class="btn btn-primary">添加文章</a>
							目前共[<!--{$total}-->]条记录
							</div>
							<div class="widget-content">
							<form action="contentreplys.php" method="post">
							<input type="hidden" name="action" id="action" value="delarticlereply" />
								<table class="table table-bordered table-striped with-check">
									<thead>
										<tr>
											<th><input name="chkAll" type="checkbox" id="chkAll" onClick="checkAll(this, 'tid[]')" value="checkbox"></th>
											<th width="150">关键词</th>
											<th>标题</th>
											<th>排序</th>
											<th>浏览次数</th>
											<th>文章地址</th>
											<th>推荐</th>
                                            <th>日期</th>
                                            <th>管理</th>
											
										</tr>
									</thead>
									<tbody>
									<!--{foreach $article as $volist}-->
									<tr>
											<td><input type="checkbox" name="tid[]" id="checkbox" value="<!--{$volist.articleid}-->" onClick="checkItem(this, 'chkAll')"></td>
											<td><!--{$volist.Keyword|truncate:12:0:'utf-8'}--></td>
											<td><!--{$volist.title|truncate:12:0:'utf-8'}--></td>
											<td><input type="text" class="orders" name="orders" value="<!--{$volist.orders}-->" onblur="myorders(this.value,<!--{$volist.articleid}-->)"></td>
											<td class='keyred'><!--{$volist.viewtimes}--></td>
											<td>
											<a href="javascript:;" id="url_button<!--{$volist.articleid}-->" onmouseover="setbut(<!--{$volist.articleid}-->)" class="btn btn-primary btn-mini">复制</a>
											<input id="urlval<!--{$volist.articleid}-->" type="button" value="<!--{$articleurl}--><!--{$volist.articleid}-->" style="display:none;">
											</td>
											<td style="text-align:center">
											<!--{if $volist.elite==0}-->
												<img id="elite<!--{$volist.articleid}-->"  src="<!--{$skinpath}-->images/no.gif" onClick="fetch_ajax('open',<!--{$volist.articleid}-->)" style="cursor:pointer;">
											<!--{else}-->
												<img id="elite<!--{$volist.articleid}-->"  src="<!--{$skinpath}-->images/yes.gif" onClick="fetch_ajax('close',<!--{$volist.articleid}-->)" style="cursor:pointer;">	
											<!--{/if}-->
											</td>
                                            <td>
												<!--{$volist.WM_Time|date_format:"%Y/%m/%d"}-->
                                            </td>
											<td>
                  <a href="contentreplys.php?mod=articlereply&action=editarticlereply&tid=<!--{$volist.articleid}-->&view=edit" class="btn btn-primary btn-mini" title="修改">
                  	修改
                  </a> 
				  <a href="contentreplys.php?action=delarticlereply&mod=right&tid[]=<!--{$volist.articleid}-->" class="btn btn-danger btn-mini" title="删除" onClick="{if(confirm('确定要删除该信息?')){return true;} return false;}" >
                  	删除
                  </a>
                                            
                                            
                                            </td>
									</tr>
									<!--{/foreach}-->
                                    </tbody>
								</table>
                                
                        <input type="submit" name="button" id="button" class="btn btn-danger" title="删除" value="删除选中文章"  onClick="{if(confirm('确定要删除该信息?')){return true;} return false;}"></label>
						<a href="contentreplys.php?mod=articlereply&action=addarticlereply" class="btn btn-primary">添加文章</a>
					共[<!--{$total}-->]条记录 <!--{$page}-->/<!--{$pagecount}-->页
					<!--{if $pagecount>1}-->
					<a href="contentreplys.php?action=articlereply&mod=right&page=1">首页</a> 
                  <a href="contentreplys.php?action=articlereply&mod=right&page=<!--{$beforepage}-->">上一条</a> <a href="contentreplys.php?action=articlereply&mod=right&page=<!--{$afterpage}-->">下一条</a> <a href="contentreplys.php?action=articlereply&mod=right&page=<!--{$pagecount}-->">尾页</a>
					<!--{/if}-->
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
	var img_on  = "<!--{$skinpath}-->images/yes.gif";
	var img_off = "<!--{$skinpath}-->images/no.gif";
	var t = document.getElementById("elite"+id).src;
	if(t.indexOf('yes.gif')<0){
		imgid = 'open';
	}else{
		imgid = 'close';
	}
		params ={articleid:id,types:imgid};
      	$.ajax({
      	url:'ajax_elitearticle.php', //后台处理程序        
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
function myorders(n,m){
		params ={orders:n,articleid:m};
      	$.ajax({
      	url:'ajax_updatearticle.php', //后台处理程序        
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
								<form action="contentreplys.php" method="post"   class="form-horizontal">
								<input type="hidden" name="action" value="addarticle">
								<input type="hidden" name="username" value="<!--{$username}-->">
								<input type="hidden" name="Oldweixinhao" value="<!--{$Oldweixinhao}-->">
								    <div class="control-group">
										<label class="control-label">关键词<font class="keyred">*</font></label>
										<div class="controls">
											<input name="Keyword" type="text" size="91" maxlength="30" <!--{if $HelloMyweb=='HelloMyweb'}-->value="<!--{$HelloMyweb}-->" readonly<!--{/if}-->>
											<span class="help-block">微信用户输入关键词返回相应内容</span>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">关键词类型<font class="keyred">*</font></label>
										<div class="controls">
											<input type="radio" name="keymatch" value=0 checked>
											<span class="radiocon">完全匹配</span>
											<input type="radio" name="keymatch" value=1>
											<span class="radiocon">包含匹配</span>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">标题<font class="keyred">*</font></label>
										<div class="controls">
											<input name="title" type="text" size="91" maxlength="60" >
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">简介<font class="keyred">*</font></label>
										<div class="controls">
											<textarea name="introduction" id="textarea" cols="80" rows="5"></textarea>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">图片类型<font class="keyred">*</font></label>
										<div class="controls">
											<input type="radio" name="pictype" value=2 checked  onClick="pictype2()">
											<span class="radiocon">上传图片</span>
											<input type="radio" name="pictype" value=1 onClick="pictype1()">
											<span class="radiocon">网络图片</span>
										</div>
									</div>
									<div class="control-group"  id="firstpic">
										<label class="control-label">上传图片<font class="keyred">*</font></label>
										<div class="controls">
											<input class="ke-input-text" type="text" id="uploadfiles" name="picaddress" readonly="readonly" /> <input type="button" id="uploadButton" value="上传" />
											<span class="help-block">微信端显示图文的封面图片</span>
											<script>
												KindEditor.ready(function(K) {
													var uploadbutton = K.uploadbutton({
														button : K('#uploadButton')[0],
														fieldName : 'imgFile',
														url : './data/editor/php/upload_json.php?dir=image',
														afterUpload : function(data) {
															if (data.error === 0) {
																var url = K.formatUrl(data.url, 'absolute');
																var objLength = $.trim(url).length;
																var url = url.substring(1,objLength);
																K('#uploadfiles').val(url);
															} else {
																alert(data.message);
															}
														},
														afterError : function(str) {
															alert('自定义错误信息: ' + str);
														}
													});
													uploadbutton.fileBox.change(function(e) {
														uploadbutton.submit();
													});
												});
											</script>
										</div>
									</div>
									<div  class="control-group hidden" id="picaddressweb">
										<label class="control-label">网络图片<font class="keyred">*</font></label>
										<div class="controls">
											<input name="picaddressweb"  type="text" size="91" maxlength="200" >
											<span class="help-block">微信端显示图文的封面图片</span>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">排序</label>
										<div class="controls">
											<input name="orders" type="text" size="30" maxlength="60" >
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">文章分类</label>
										<div class="controls">
											<!--{$cate_select}-->
											<span class="help-block">请选择文章所属分类</span>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">访问分类<font class="keyred">*</font></label>
										<div class="controls">
										  <input type="radio" name="articletype" value=1 checked onClick="article1()">
										  <span class="radiocon">站内文章</span>
										  <input type="radio" name="articletype" value=2 onClick="article2()">
										  <span class="radiocon">站外文章</span>
										</div>
									</div>
									<div class="control-group hidden" id="articleaddress">
										<label class="control-label">站外地址<font class="keyred">*</font></label>
										<div class="controls">
											<input name="articleaddress"  type="text" size="91" maxlength="200" >
											<span class="help-block">输入此地址，微信端用户点击图文即跳转到此网址</span>
										</div>
									</div>
									<div class="control-group" id="contentcss">
										<label class="control-label">正文内容<font class="keyred">*</font></label>
										<div class="controls">
										<textarea id="editor_id" name="content" style="width:600px;height:400px;visibility:hidden;"></textarea>
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
<!-- 									<div class="control-group" id="oldaddress">
										<label class="control-label">原文地址</label>
										<div class="controls">
											<input name="oldaddress"  type="text" size="91" maxlength="200" >
											<span class="help-block">站内地址打开文章,最下面显示'阅读原文'的地址</span>
										</div>
									</div> -->
									<div class="control-group">
										<label class="control-label">多图文添加</label>
										<div class="controls">
											<a href="#TB_inline?height=300&width=400&inlineId=myOnPageContent" title="多图文展示" class="thickbox btn btn-primary btn-mini" type="button">多图文</a>
										</div>
									</div>
									<div class="key1" id="myshowarticle">
									<div  style="width:100%;" id="showarticle">
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
												<!--{foreach $article as $volist}-->
												<tr class="tablecontent" bgcolor="#FFFFFF" onMouseOver="this.bgColor='#e8e8e8'" onMouseOut="this.bgColor='#FFFFFF'">
												  <td height="40"><label>
												   <input type="checkbox" class="articlecheckbox<!--{$volist.articleid}-->" name="arrid[]" id="checkbox" value="<!--{$volist.articleid}-->" onClick="checkItem(this, 'chkAll')" onChange="winchange(this,<!--{$volist.articleid}-->,'<!--{$volist.title|truncate:12:0:'utf-8'}-->')">
												   <input class="csshidden" type="text" name="pagetitle[]" value="<!--{$volist.title|truncate:12:0:'utf-8'}-->">
												  </label></td>
												  <td><!--{$volist.title|truncate:16:0:'utf-8'}--></td>
												  <td><!--{$volist.WM_Time|date_format:"%Y/%m/%d"}--></td>
												</tr>
												<!--{/foreach}-->
												<tr class="tablecontent" bgcolor="#FFFFFF" onMouseOver="this.bgColor='#e8e8e8'" onMouseOut="this.bgColor='#FFFFFF'">
												  <td height="40"><input name="chkAll" type="checkbox" id="chkAll" onClick="checkAll(this, 'arrid[]')" onChange="winchangeall(this,'arrid[]','pagetitle[]')" value="checkbox">
													全选</td>
												  <td colspan="5">
													共[<!--{$total}-->]条记录    <input type="button" value="提交" onClick="tb_remove()">
													<!--{if $pagecount>1}-->
													<a href="javascript:;" onclick="commonpage(1,'<!--{$Oldweixinhao}-->')">首页</a>
												  <a href="javascript:;" onclick="commonpage(<!--{$beforepage}-->,'<!--{$Oldweixinhao}-->')">上一条</a> <a href="javascript:;" onclick="commonpage(<!--{$afterpage}-->,'<!--{$Oldweixinhao}-->')">下一条</a> <a href="javascript:;" onclick="commonpage(<!--{$pagecount}-->,'<!--{$Oldweixinhao}-->')">尾页</a><span id="error_text"></span>
													<!--{/if}-->					
													</td>
												  </tr>
											  </table>
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
	$("#showarticle").append("<div class='keyarticle' id='article"+t+"'>"+itemName+"<input name='articletitleid[]' class='keyarticle csshidden'   value="+t+"><img src='/tpl/wxpublictpl/images/pic22.gif' onclick='delarticleinput("+t+")'></div>");
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
   $("#showarticle").append("<div class='keyarticle' id='article"+aa[i].value+"'>"+tt[i].value+"<input name='articletitleid[]' class='keyarticle csshidden'   value="+aa[i].value+"><img src='/tpl/wxpublictpl/images/pic22.gif' onclick='delarticleinput("+aa[i].value+")'></div>");
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
<!--{if $action eq "editarticlereply"}-->
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
								<form action="contentreplys.php" method="post"   class="form-horizontal">
								<input type="hidden" name="action" value="editarticlereply">
								<input type="hidden" name="tid" value="<!--{$article.articleid}-->">
								    <div class="control-group">
										<label class="control-label">关键词<font class="keyred">*</font></label>
										<div class="controls">
											<input name="Keyword" type="text" size="91" maxlength="30" value="<!--{$article.Keyword}-->">
											<span class="help-block">微信用户输入关键词返回相应内容</span>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">关键词类型<font class="keyred">*</font></label>
										<div class="controls">
											<input type="radio" name="keymatch" value=0 <!--{if $article.keymatch==0}-->checked<!--{/if}-->>
											<span class="radiocon">完全匹配</span>
											<input type="radio" name="keymatch" value=1 <!--{if $article.keymatch==1}-->checked<!--{/if}-->>
											<span class="radiocon">包含匹配</span>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">标题<font class="keyred">*</font></label>
										<div class="controls">
											<input name="title" type="text" size="91" maxlength="60" value="<!--{$article.title}-->">
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">简介<font class="keyred">*</font></label>
										<div class="controls">
											<textarea name="introduction" id="textarea" cols="80" rows="5"><!--{$article.introduction}--></textarea>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">图片类型<font class="keyred">*</font></label>
										<div class="controls">
											<!--{if $article.pictype==2}-->
											<input type="radio" name="pictype" value=2 checked  onClick="pictype2()">
											<span class="radiocon">上传图片</span>
											<!--{else}-->
											<input type="radio" name="pictype" value=1 checked onClick="pictype1()">
											<span class="radiocon">网络图片</span>
											<!--{/if}-->
										</div>
									</div>
									<!--{if $article.pictype==2}-->
									<div class="control-group"  id="firstpic">
										<label class="control-label">上传图片<font class="keyred">*</font></label>
										<div class="controls">
											<input class="ke-input-text" type="text" id="uploadfiles" name="picaddress" readonly="readonly" value="<!--{$article.uploadfiles}-->"/> <input type="button" id="uploadButton" value="上传" />
											<span class="help-block">微信端显示图文的封面图片</span>
											<script>
												KindEditor.ready(function(K) {
													var uploadbutton = K.uploadbutton({
														button : K('#uploadButton')[0],
														fieldName : 'imgFile',
														url : './data/editor/php/upload_json.php?dir=image',
														afterUpload : function(data) {
															if (data.error === 0) {
																var url = K.formatUrl(data.url, 'absolute');
																var objLength = $.trim(url).length;
																var url = url.substring(1,objLength);
																K('#uploadfiles').val(url);
															} else {
																alert(data.message);
															}
														},
														afterError : function(str) {
															alert('自定义错误信息: ' + str);
														}
													});
													uploadbutton.fileBox.change(function(e) {
														uploadbutton.submit();
													});
												});
											</script>
										</div>
									</div>
									<!--{else}-->
									<div  class="control-group" id="picaddressweb">
										<label class="control-label">网络图片<font class="keyred">*</font></label>
										<div class="controls">
											<input name="picaddressweb"  type="text" size="91" maxlength="200" value="<!--{$article.picaddressweb}-->">
											<span class="help-block">微信端显示图文的封面图片</span>
										</div>
									</div>
									<!--{/if}-->
									<div class="control-group">
										<label class="control-label">排序</label>
										<div class="controls">
											<input name="orders" type="text" size="30" maxlength="60" value="<!--{$article.orders}-->">
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">文章分类</label>
										<div class="controls">
											<!--{$cate_select}-->
											<span class="help-block">请选择文章所属分类</span>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">访问分类<font class="keyred">*</font></label>
										<div class="controls">
										  <!--{if $article.type==1}-->
										  <input type="radio" name="articletype" value=1 checked onClick="article1()">
										  <span class="radiocon">站内文章</span>
										  <!--{else}-->
										  <input type="radio" name="articletype" value=2 checked onClick="article2()">
										  <span class="radiocon">站外文章</span>
										  <!--{/if}-->
										</div>
									</div>
									<!--{if $article.type==2}-->
									<div class="control-group" id="articleaddress">
										<label class="control-label">站外地址<font class="keyred">*</font></label>
										<div class="controls">
											<input name="articleaddress"  type="text" size="91" maxlength="200" value="<!--{$article.articleaddress}-->">
											<span class="help-block">输入此地址，微信端用户点击图文即跳转到此网址</span>
										</div>
									</div>
									<!--{/if}-->
									<!--{if $article.type==1}-->
									<div class="control-group" id="contentcss">
										<label class="control-label">正文内容<font class="keyred">*</font></label>
										<div class="controls">
										<textarea id="editor_id" name="content" style="width:600px;height:400px;visibility:hidden;"><!--{$article.content}--></textarea>
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
<!-- 									<div class="control-group" id="oldaddress">
										<label class="control-label">原文地址</label>
										<div class="controls">
											<input name="oldaddress"  type="text" size="91" maxlength="200" value="">
											<span class="help-block">站内地址打开文章,最下面显示'阅读原文'的地址</span>
										</div>
									</div> -->
									<!--{/if}-->
									<div class="control-group">
										<label class="control-label">多图文添加</label>
										<div class="controls">
											<a href="#TB_inline?height=300&width=400&inlineId=myOnPageContent" title="多图文展示" class="thickbox btn btn-primary btn-mini" type="button">多图文</a>
										</div>
									</div>
									<div class="key1" id="myshowarticle">
									<div  style="width:100%;" id="showarticle">
									<!--{if $artcons!=""}-->
									<!--{foreach $artcons as $volist}-->
									<div class='keyarticle' id='article<!--{$volist.0}-->'><!--{$volist.1}--><input name='articletitleid[]' class='keyarticle csshidden'   value="<!--{$volist.0}-->"><img src='/tpl/wxpublictpl/images/pic22.gif' onclick='delarticleinput(<!--{$volist.0}-->)'></div>
									<!--{/foreach}-->
									<!--{/if}-->
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
												<!--{foreach $articles as $volist}-->
												<tr class="tablecontent" bgcolor="#FFFFFF" onMouseOver="this.bgColor='#e8e8e8'" onMouseOut="this.bgColor='#FFFFFF'">
												  <td height="40"><label>
												   <input type="checkbox" class="articlecheckbox<!--{$volist.articleid}-->" name="arrid[]" id="checkbox" value="<!--{$volist.articleid}-->" onClick="checkItem(this, 'chkAll')" onChange="winchange(this,<!--{$volist.articleid}-->,'<!--{$volist.title|truncate:12:0:'utf-8'}-->')">
												   <input class="csshidden" type="text" name="pagetitle[]" value="<!--{$volist.title|truncate:12:0:'utf-8'}-->">
												  </label></td>
												  <td><!--{$volist.title|truncate:16:0:'utf-8'}--></td>
												  <td><!--{$volist.WM_Time|date_format:"%Y/%m/%d"}--></td>
												</tr>
												<!--{/foreach}-->
												<tr class="tablecontent" bgcolor="#FFFFFF" onMouseOver="this.bgColor='#e8e8e8'" onMouseOut="this.bgColor='#FFFFFF'">
												  <td height="40"><input name="chkAll" type="checkbox" id="chkAll" onClick="checkAll(this, 'arrid[]')" onChange="winchangeall(this,'arrid[]','pagetitle[]')" value="checkbox">
													全选</td>
												  <td colspan="5">
													共[<!--{$total}-->]条记录    <input type="button" value="提交" onClick="tb_remove()">
													<!--{if $pagecount>1}-->
													<a href="javascript:;" onclick="commonpage(1,'<!--{$Oldweixinhao}-->')">首页</a>
												  <a href="javascript:;" onclick="commonpage(<!--{$beforepage}-->,'<!--{$Oldweixinhao}-->')">上一条</a> <a href="javascript:;" onclick="commonpage(<!--{$afterpage}-->,'<!--{$Oldweixinhao}-->')">下一条</a> <a href="javascript:;" onclick="commonpage(<!--{$pagecount}-->,'<!--{$Oldweixinhao}-->')">尾页</a><span id="error_text"></span>
													<!--{/if}-->					
													</td>
												  </tr>
											  </table>
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
	$("#showarticle").append("<div class='keyarticle' id='article"+t+"'>"+itemName+"<input name='articletitleid[]' class='keyarticle csshidden'   value="+t+"><img src='/tpl/wxpublictpl/images/pic22.gif' onclick='delarticleinput("+t+")'></div>");
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
   $("#showarticle").append("<div class='keyarticle' id='article"+aa[i].value+"'>"+tt[i].value+"<input name='articletitleid[]' class='keyarticle csshidden'   value="+aa[i].value+"><img src='/tpl/wxpublictpl/images/pic22.gif' onclick='delarticleinput("+aa[i].value+")'></div>");
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
								<h5>文章分类管理<font color="red">（系统支持分类描述、排序即时修改即时生效,无需刷新页面,微信端即时生效修改内容）</font></h5>
							</div>
							<div class="topcss">
							<a href="contentreplys.php?mod=articleflreply&action=addarticleflreply" class="btn btn-primary">添加分类</a>
							目前共[<!--{$total}-->]条记录
							</div>
							<div class="widget-content">
							<form action="contentreplys.php" method="post">
							<input type="hidden" name="action" id="action" value="delarticleflreply" />
								<table class="table table-bordered table-striped with-check">
									<thead>
										<tr>
											<th><input name="chkAll" type="checkbox" id="chkAll" onClick="checkAll(this, 'tid[]')" value="checkbox"></th>
											<th>名称</th>
											<th>分类描述</th>
											<th>排序</th>
											<th>分类网址</th>
											<th>显示</th>
                                            <th>日期</th>
                                            <th>管理</th>
											
										</tr>
									</thead>
									<tbody>
									<!--{foreach $articlecate as $volist}-->
									<tr>
											<td><input type="checkbox" name="tid[]" id="checkbox" value="<!--{$volist.cateid}-->" onClick="checkItem(this, 'chkAll')"></td>
											<td style="text-align:left;"><!--{$volist.tree_catename}--></td>
											<td><input type="text" class="metatitle" name="metatitle" value="<!--{$volist.metatitle|truncate:12:0:'utf-8'}-->" onchange="mymetatitle(this.value,<!--{$volist.cateid}-->)"></td>
											<td><input type="text" class="orders" name="orders" value="<!--{$volist.orders}-->" onchange="myorders(this.value,<!--{$volist.cateid}-->)"></td>
											<td>
											<a href="javascript:;" id="url_button<!--{$volist.cateid}-->" onmouseover="setbut(<!--{$volist.cateid}-->)" class="btn btn-primary btn-mini">复制</a>
											<input id="urlval<!--{$volist.cateid}-->" type="button" value="<!--{$articlecatewebs}--><!--{$volist.cateid}-->" style="display:none;">
											</td>
											<td style="text-align:center">
											<!--{if $volist.eshow==0}-->
												<img id="elite<!--{$volist.cateid}-->"  src="<!--{$skinpath}-->images/no.gif" onClick="fetch_ajax('open',<!--{$volist.cateid}-->)" style="cursor:pointer;">
											<!--{else}-->
												<img id="elite<!--{$volist.cateid}-->"  src="<!--{$skinpath}-->images/yes.gif" onClick="fetch_ajax('close',<!--{$volist.cateid}-->)" style="cursor:pointer;">	
											<!--{/if}-->
											</td>
                                            <td>
												<!--{$volist.timeline|date_format:"%Y/%m/%d"}-->
                                            </td>
											<td>
                  <a href="contentreplys.php?mod=articleflreply&action=editarticleflreply&tid=<!--{$volist.cateid}-->&view=edit" class="btn btn-primary btn-mini" title="修改">
                  	修改
                  </a>
				  <a href="contentreplys.php?action=delarticleflreply&mod=right&tid[]=<!--{$volist.cateid}-->" class="btn btn-danger btn-mini" title="删除" onClick="{if(confirm('确定要删除该信息?')){return true;} return false;}" >
                  	删除
                  </a>
                                            
                                            
                                            </td>
									</tr>
									<!--{/foreach}-->
                                    </tbody>
								</table>
                                
                        <input type="submit" name="button" id="button" class="btn btn-danger" title="删除" value="删除操作"  onClick="{if(confirm('确定要删除该信息?')){return true;} return false;}"></label>
						<a href="contentreplys.php?mod=articleflreply&action=addarticleflreply" class="btn btn-primary">添加分类</a>
					共[<!--{$total}-->]条记录 <!--{$page}-->/<!--{$pagecount}-->页
					<!--{if $pagecount>1}-->
					<a href="contentreplys.php?action=articleflreply&mod=right&page=1">首页</a> 
                  <a href="contentreplys.php?action=articleflreply&mod=right&page=<!--{$beforepage}-->">上一条</a> <a href="contentreplys.php?action=articleflreply&mod=right&page=<!--{$afterpage}-->">下一条</a> <a href="contentreplys.php?action=articleflreply&mod=right&page=<!--{$pagecount}-->">尾页</a>
					<!--{/if}-->
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
      	url:'ajax_eshow.php', //后台处理程序        
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
								<form action="contentreplys.php" method="post" class="form-horizontal">
									<input type="hidden" name="action" value="addflreply">
									<input type="hidden" name="username" value="<!--{$username}-->">
									<input type="hidden" name="Oldweixinhao" value="<!--{$Oldweixinhao}-->">
									<div class="control-group">
										<label class="control-label">所属分类<font class="keyred">*</font></label>
										<div class="controls">
											<!--{$cate_select}-->
											<span class="help-block">（不选择表示作为一级分类，最多支持二级分类）</span>
										</div>
									</div>
								    <div class="control-group">
										<label class="control-label">名称<font class="keyred">*</font></label>
										<div class="controls">
											<input name="catename" type="text" size="91" maxlength="30">
											<span class="help-block">微信用户端显示相应分类名称</span>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">图片类型<font class="keyred">*</font></label>
										<div class="controls">
											<input type="radio" name="pictype" value=2 checked  onClick="pictype2()">
											<span class="radiocon">上传图片</span>
											<input type="radio" name="pictype" value=1 onClick="pictype1()">
											<span class="radiocon">网络图片</span>
										</div>
									</div>
									<div class="control-group"  id="firstpic">
										<label class="control-label">上传图片<font class="keyred">*</font></label>
										<div class="controls">
											<input class="ke-input-text" type="text" id="uploadfiles" name="picaddress" readonly="readonly"/> <input type="button" id="uploadButton" value="上传" />
											<span class="help-block">微信端显示图文的封面图片</span>
											<script>
												KindEditor.ready(function(K) {
													var uploadbutton = K.uploadbutton({
														button : K('#uploadButton')[0],
														fieldName : 'imgFile',
														url : './data/editor/php/upload_json.php?dir=image',
														afterUpload : function(data) {
															if (data.error === 0) {
																var url = K.formatUrl(data.url, 'absolute');
																var objLength = $.trim(url).length;
																var url = url.substring(1,objLength);
																K('#uploadfiles').val(url);
															} else {
																alert(data.message);
															}
														},
														afterError : function(str) {
															alert('自定义错误信息: ' + str);
														}
													});
													uploadbutton.fileBox.change(function(e) {
														uploadbutton.submit();
													});
												});
											</script>
										</div>
									</div>
									<div  class="control-group hidden" id="picaddressweb">
										<label class="control-label">网络图片<font class="keyred">*</font></label>
										<div class="controls">
											<input name="picaddressweb"  type="text" size="91" maxlength="200" >
											<span class="help-block">微信端显示图文的封面图片</span>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">外链</label>
										<div class="controls">
											<input name="addressweb" type="text" size="91" maxlength="300">
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">排序</label>
										<div class="controls">
											<input name="orders" type="text" size="91" maxlength="200">
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">分类描述</label>
										<div class="controls">
											<textarea name="metatitle" id="textarea" cols="80" rows="5"></textarea>
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
<script type="text/javascript">
function pictype1(){
	document.getElementById("firstpic").style.display="none";
	document.getElementById("picaddressweb").style.display="block";
}
function pictype2(){
	document.getElementById("firstpic").style.display="block";
	document.getElementById("picaddressweb").style.display="none";
}
</script>
<!--{/if}-->
<!--{if $action eq "editarticleflreply"}-->
<div id="content">
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="span12">
                        <div class="widget-box">
							<div class="widget-title">
								<span class="icon">
									<i class="icon-align-justify"></i>									
								</span>
								<h5>修改文章分类<font color="red">(*代表必填写)</font></h5>
							</div>
							<div class="widget-content nopadding">
								<form action="contentreplys.php" method="post" class="form-horizontal">
								<input type="hidden" name="action" value="editarticleflreply">
								<input type="hidden" name="username" value="<!--{$username}-->">
								<input type="hidden" name="Oldweixinhao" value="<!--{$Oldweixinhao}-->">
								<input type="hidden" name="tid" value="<!--{$articlecate.cateid}-->">
									<div class="control-group">
										<label class="control-label">所属分类<font class="keyred">*</font></label>
										<div class="controls">
											<!--{$cate_select}-->
											<span class="help-block">（不选择表示作为一级分类，最多支持二级分类）</span>
										</div>
									</div>
								    <div class="control-group">
										<label class="control-label">名称<font class="keyred">*</font></label>
										<div class="controls">
											<input name="catename" type="text" size="91" maxlength="30" value="<!--{$articlecate.catename}-->">
											<span class="help-block">微信用户端显示相应分类名称</span>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">图片类型<font class="keyred">*</font></label>
										<div class="controls">
											<!--{if $articlecate.pictype==2}-->
											<input type="radio" name="pictype" value=2 checked  onClick="pictype2()">
											<span class="radiocon">上传图片</span>
											<!--{else}-->
											<input type="radio" name="pictype" value=1 checked onClick="pictype1()">
											<span class="radiocon">网络图片</span>
											<!--{/if}-->
										</div>
									</div>
									<!--{if $articlecate.pictype==2}-->
									<div class="control-group"  id="firstpic">
										<label class="control-label">上传图片<font class="keyred">*</font></label>
										<div class="controls">
											<input class="ke-input-text" type="text" id="uploadfiles" name="picaddress" readonly="readonly" value="<!--{$articlecate.uploadfiles}-->"/> <input type="button" id="uploadButton" value="上传" />
											<span class="help-block">微信端显示图文的封面图片</span>
											<script>
												KindEditor.ready(function(K) {
													var uploadbutton = K.uploadbutton({
														button : K('#uploadButton')[0],
														fieldName : 'imgFile',
														url : './data/editor/php/upload_json.php?dir=image',
														afterUpload : function(data) {
															if (data.error === 0) {
																var url = K.formatUrl(data.url, 'absolute');
																var objLength = $.trim(url).length;
																var url = url.substring(1,objLength);
																K('#uploadfiles').val(url);
															} else {
																alert(data.message);
															}
														},
														afterError : function(str) {
															alert('自定义错误信息: ' + str);
														}
													});
													uploadbutton.fileBox.change(function(e) {
														uploadbutton.submit();
													});
												});
											</script>
										</div>
									</div>
									<!--{else}-->
									<div  class="control-group" id="picaddressweb">
										<label class="control-label">网络图片<font class="keyred">*</font></label>
										<div class="controls">
											<input name="picaddressweb"  type="text" size="91" maxlength="200" value="<!--{$articlecate.cateface}-->">
											<span class="help-block">微信端显示图文的封面图片</span>
										</div>
									</div>
									<!--{/if}-->
									<div class="control-group">
										<label class="control-label">外链</label>
										<div class="controls">
											<input name="addressweb" type="text" size="91" maxlength="300" value="<!--{$articlecate.addressweb}-->">
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">排序</label>
										<div class="controls">
											<input name="orders" type="text" size="91" maxlength="200" value="<!--{$articlecate.orders}-->">
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">分类描述</label>
										<div class="controls">
											<textarea name="metatitle" id="textarea" cols="80" rows="5"><!--{$articlecate.metatitle}--></textarea>
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
<script type="text/javascript">
function pictype1(){
	document.getElementById("firstpic").style.display="none";
	document.getElementById("picaddressweb").style.display="block";
}
function pictype2(){
	document.getElementById("firstpic").style.display="block";
	document.getElementById("picaddressweb").style.display="none";
}
</script>
<!--{/if}-->
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
								<h5>自定义菜单管理<font color="red">（触发关键词或url,关键词可以是你定义过的文章或文本的关键词,url:要以http开头!）</font></h5>
							</div>
							<div class="topcss">
							<form action="contentreplys.php" method="post">
							<input type="hidden" name="action" id="action" value="updatecustommenu" />
							<input type="hidden" name="Oldweixinhao" value="<!--{$Oldweixinhao}-->">
									AppId:<input type="text" id="appid" name="appid" value="<!--{$publicnames.WM_AppId}-->">　　AppSecret:<input type="text" id="appsecret" name="appsecret" style="width:270px;" value="<!--{$publicnames.WM_AppSecret}-->">　<a href="javascript:;" onclick="submit()" class="btn btn-primary">保存</a>
							</form>
							</div>
							<div class="topcss">
							<a href="javascript:;"  class="btn btn-primary addmenu">添加主菜单</a>
							</div>
							<div class="widget-content">
							<form action="contentreplys.php" method="post">
							<input type="hidden" name="action" id="action" value="editcustommenu" />
							<input type="hidden" name="Oldweixinhao" value="<!--{$Oldweixinhao}-->">
								<table class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>排序</th>
											<th>主菜单名称</th>
											<th>触发关键词</th>
											<th>显示</th>
                                            <th>管理</th>
											
										</tr>
									</thead>
									<tbody id="custommenus" style="display:none;">
									<tr>
											<td><input type="text" class="orders" name="orders[]" value="0"></td>
											<td>
											主菜单：<input type="text" style="width:200px;" class="catename" name="catename[]"><br>
											子菜单：<textarea name="childmenu[]" class="childmenu" cols="80" rows="5">名称|关键词(回车换行)</textarea>
											</td>
											<td><input type="text" class="metatitle" name="metatitle[]"></td>
											<td style="text-align:center">
												<img id="elite<!--{$volist.cateid}-->"  src="<!--{$skinpath}-->images/yes.gif"  style="cursor:pointer;">	
											</td>
											<td>
											  <a href="javascript:;" class="btn btn-danger btn-mini delmenu" title="删除">
												删除
											  </a>              
											</td>
									</tr>
									</tbody>
								
									<tbody id="mymenus">
									<!--{foreach $menus as $k=>$volist}-->
									<tr id="menuclass<!--{$k}-->">
											<td><input type="text" class="orders" name="orders<!--{$k}-->[]" value="<!--{$volist.orders}-->"></td>
											<td>
											主菜单：<input type="text" style="width:200px;" class="catename" name="catename<!--{$k}-->[]" value="<!--{$volist.catename}-->"><br>
											子菜单：<textarea name="childmenu<!--{$k}-->[]" class="childmenu" cols="80" rows="5"><!--{$volist.childmenu}--></textarea>
											</td>
											<td><input type="text" class="metatitle" name="metatitle<!--{$k}-->[]" value="<!--{$volist.metatitle}-->"></td>
											<td style="text-align:center">
												<img id="elite<!--{$volist.cateid}-->" onclick="fetch_ajax('',<!--{$volist.cateid}-->)"  src="<!--{$skinpath}-->images/yes.gif"  style="cursor:pointer;">	
											</td>
											<td>
											  <a href="javascript:;" class="btn btn-danger btn-mini delmenu" title="删除">
												删除
											  </a>              
											</td>
									</tr>
									<!--{/foreach}-->
									</tbody>
								</table>
                        <a href="javascript:;" onclick="submit()"  class="btn btn-primary">保存数据</a>       
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
	if($("#mymenus tr").size()>=3){
		alert("主菜单不能超过三个,子菜单不能超过五个");
		return false;
	}
	$("#mymenus").append(custommenus);
	$("#mymenus tr").each(function(i,v){
		$(this).attr("id","menuclass"+i);
		$(this).find("td .orders").attr("name","orders"+i+"[]");
		$(this).find("td .catename").attr("name","catename"+i+"[]");
		$(this).find("td .metatitle").attr("name","metatitle"+i+"[]");
		$(this).find("td .childmenu").attr("name","childmenu"+i+"[]");
	});
	
});
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
</body></html>