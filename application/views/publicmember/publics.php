<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?=$title?></title>
<meta name="keywords" content="">
<meta name="description" content="">

<link rel="stylesheet" type="text/css" href="<?=base_url()?>static/css/public.main.css">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>static/css/public.min.css">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>static/css/public.css">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>static/css/copyright.css">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>static/css/menu.css">

<script type="text/javascript" src='<?=base_url()?>static/js/jquery-1.4.4.min.js'></script>
<script type='text/javascript' src='<?=base_url()?>static/js/command.js'></script>
<script>
(function() {
	var _skin, _jQuery;
	var _search = window.location.search;
	if (_search) {
		_skin = _search.split('demoSkin=')[1];
		_jQuery = _search.indexOf('jQuery=true') !== -1;
		if (_jQuery) document.write('<scr'+'ipt src="<?=base_url()?>static/artDialog/jquery-1.6.2.min.js"></sc'+'ript>');
	};
	
	document.write('<scr'+'ipt src="<?=base_url()?>static/artDialog/artDialog.source.js?skin=' + (_skin || 'green') +'"></sc'+'ript>');
	window._isDemoSkin = !!_skin;
})();
</script>
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
<style>
#tags {
	MARGIN: 15px 0 0 0; WIDTH: 800px; PADDING-TOP: 0px; HEIGHT: 40px
}
#tags LI {
	BACKGROUND:url(../images/tagleft.gif) no-repeat left bottom; FLOAT: left; MARGIN-RIGHT: 3px; LIST-STYLE-TYPE: none; HEIGHT: 40px
}
#tags LI A {
	PADDING:0 20px; BACKGROUND:url(../images/tagleft.gif) no-repeat left bottom; FLOAT: left; COLOR: #999; LINE-HEIGHT: 40px; HEIGHT: 40px; TEXT-DECORATION: none; font-size:14px;
}
#tags LI.emptyTag {
	BACKGROUND: none transparent scroll repeat 0% 0%; WIDTH: 4px
}
#tags LI.selectTag {
	BACKGROUND-POSITION: left top; MARGIN-BOTTOM: -2px; POSITION: relative; HEIGHT: 40px
}
#tags LI.selectTag A {
	BACKGROUND-POSITION: right top; COLOR: #000; LINE-HEIGHT: 40px; HEIGHT: 40px
}
#tagContent {
	display:block
}
.tagContent {
	DISPLAY: none;
}
#tagContent DIV.selectTag {
	DISPLAY: block
}
</style>
<style>
.green {
    color: #009900;
}
.cLineB {
    border-bottom: 1px solid #EEEEEE;
    overflow: hidden;
    padding: 8px 0;
}


.cLineB h4 {
    font-size: 16px;
}

.red {
    color: #FF0000;
}


.FAQ {
    color: #AAAAAA;
    font-size: 12px;
    padding: 0 3px;
}

ul, li {
    list-style-type: none;
    margin: 0;
    padding: 0;
}
.changeapp {
    margin: 20px 0;
}
.content p, .content table, .content tr, .content td, .content th, .content dl, .content dt, .content dd, .content ol, .content ul, .content li, .content input, .content button, .content select, .content stextarea {
    font-size: 14px;
    line-height: 1.5;
}

.changeapp li {
    background-color: #F6F5F3;
    border: 1px solid #EEEEEE;
    display: block;
    float: left;
    height: 20px;
    margin: 0 5px 5px 0;
    padding: 5px 5px;
    position: relative;
    width: 155px;
}
.changeapp li:hover {
    background-color: #F0FFDC;
    border: 1px solid #64C269;
}
.changeapp li label {
    cursor: pointer;
    display: block;
}
input, textarea {
    background: none repeat scroll 0 0 #FFFFFF;
}
.changeapp {
    margin: 20px 0;
}
.changeapp li {
    background-color: #F6F5F3;
    border: 1px solid #EEEEEE;
    display: block;
    float: left;
    height: 25px;
    margin: 0 5px 5px 0;
    padding: 5px 5px;
    position: relative;
    width: 210px;
}
.changeapp li:hover {
    background-color: #F0FFDC;
    border: 1px solid #64C269;
}
.changeapp li div {
    -moz-border-bottom-colors: none;
    -moz-border-left-colors: none;	
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    background-color: #F0FFDC;
    border-color: -moz-use-text-color #64C269 #64C269;
    border-image: none;
    border: 1px solid #64C269;
    border-style: none solid solid;
    border-width: 0 1px 1px;
    display: none;
    left: -1px;
    padding: 5px 5px;
    position: absolute;
    top: 35px;
    width: 210px;
    z-index: 999;
}
.changeapp li:hover div {
    display: block;
}
.changeapp li label {
    cursor: pointer;
    display: block;
}

element.style {
}
.btnGreens {
	background-color: #5BA607;
	background-image: -moz-linear-gradient(center bottom , #4D910C 3%, #69B310 97%, #FFFFFF 100%);
	border: 1px solid #3D810C;
	border-radius: 3px 3px 3px 3px;
	box-shadow: 0 1px 1px #AAAAAA;
	color: #FFFFFF;
	cursor: pointer;
	display: inline-block;
	font-size: 14px;
	line-height: 1.5;
	overflow: visible;
	padding: 2px 8px;
	text-align: center;
	vertical-align: bottom;
}
</style>

<style>
fieldset{
	border:1px solid #E3E2E0;
	padding:5px;
	margin-bottom:20px;
}
</style>
</head>

<body screen_capture_injected="true">
<div id="header" class="header">
<?=$this->load->view('head')?>
<div id="main" class="container">
        <div class="containerBox">
            <div class="boxHeader">
                <h2>公众账号管理</h2>
            </div>
            <?=$this->load->view('publicmember/leftmenu')?>
<!--{if $action eq "publics"}-->
<div id="content">
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="span12">
                    	<div class="widget-box">
							<div class="widget-title">
								<span class="icon">
									<i class="icon-th"></i>
								</span>
								<h5>公众号列表</h5>
								
							</div>
							<?
							if($count_all<1):
							?>
							<div class="topcss">
							<a href="<?=site_url('publicmember/addpublics')?>" class="btn btn-primary">添加公众号</a>
							</div>
							<?
							endif;
							?>
							<div class="widget-content">
							<form action="<?=site_url('publicmember/delpublics')?>" method="post">
								<table class="table table-bordered table-striped with-check">
									<thead>
										<tr>
											<th><input name="chkAll" type="checkbox" id="chkAll" onClick="checkAll(this, 'tid[]')" value="checkbox"></th>
											<th>公众号名称</th>
											<th>微信号</th>
											<th>原始ID号</th>
											<th>管理状态</th>
                                            <th>时间</th>
                                            <th>状态</th>
                                            <th>管理</th>
											
										</tr>
									</thead>
									<tbody>
									<?php if($result):?>
									<?php foreach($result as $k=>$v):?>
									<tr>
											<td><input type="checkbox" name="tid[]" id="checkbox" value="<?=$v['id']?>" onClick="checkItem(this, 'chkAll')"></td>
											<td><?=$v['Public']?></td>
											<td><?=$v['Weixinhao']?></td>
											<td><?=$v['Oldweixinhao']?></td>
											<td>
											  <?php if($v['Current']):?>
											  <font color="red">是</font>
											  <?php else:?>
											  否
											  <?php endif?>
											</td>
                                            <td>
												<?=date("Y-m-d",$v['addtime'])?>
                                            </td>
											<td>
											正常
											</td>
											<td>
                  <a href="<?=site_url('publicmember/editpublics/'.$v['id'])?>" class="btn btn-primary btn-mini" title="修改">
                  	修改
                  </a>
                  <a href="<?=site_url('publicmember/delpublics/'.$v['id'])?>" class="btn btn-danger btn-mini" title="删除" onClick="{if(confirm('确定要删除该信息?')){return true;} return false;}" >
                  	删除
                  </a>
                                            
                                            
                                            </td>
									</tr>
									<?php endforeach;?>
									<?php endif;?>
                                    </tbody>
								</table>
                                
                       </label>
							<?
							if($count_all<1):
							?>
						<a href="<?=site_url('publicmember/addpublics')?>" class="btn btn-primary">添加公众号</a>
							<?
							endif;
							?>
					共[<?=$count_all?>]条记录 <?=$links?>
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
</body></html>