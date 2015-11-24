<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
<title>提示信息</title>
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
</head>
<body screen_capture_injected="true">
<script type="text/javascript">
$(document).ready(function() {
var dialog = art.dialog({
    title: '提示',
    content: "<?php echo $titlemsg?><br> <a href='<?php echo $urlmsg?>' style='font-size:10px;'>3秒后 如果你的浏览器没有自动跳转，请点击此链接</a>",
    icon: '<?php echo empty($typemsg)?'succeed':$typemsg?>',
    height: 110,
});

    setTimeout("window.location.href='<?php echo $urlmsg?>'",2000);
});
</script>
</body>
</html>