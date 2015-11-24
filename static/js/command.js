/*
  $Id    : jquery for ajax更改状态值
  @params: url   发送URL
  @params: imgid 标签ID
  @params: id    ID
*/

function dc() {
  var elements = new Array();
  for (var i = 0; i < arguments.length; i++) {
    var element = arguments[i];
    if (typeof element == 'string') element = document.getElementById(element);
    if (arguments.length == 1) return element;
    elements.push(element);
  }
  return elements;
}

//随机数
function getrndnum(n) {
	var chars = ['0','1','2','3','4','5','6','7','8','9','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
	var res = "";
	for(var i = 0; i < n ; i ++) {
		var id = Math.ceil(Math.random()*35);
		res += chars[id];
	}
	return res;
}

//menu
function Menuon(ID) {
	try{dc('Tab'+ID).className='tab_on';}catch(e){}
}

//close msg
function closemsg() {
	try{dc('msgbox').innerHTML = '';dc('msgbox').style.display = 'none';}catch(e){}
}

//dmsg
function dmsg(str, id, s, t) {
	var t = t ? t : 5000;
	var s = s ? true : false;
	try{if(s){window.scrollTo(0,0);}dc('d'+id).innerHTML = '<img src="oecms/images/check_error.gif" width="12" height="12" align="absmiddle"/> '+str+sound('tip');$(id).focus();}catch(e){}
	window.setTimeout(function(){dc('d'+id).innerHTML = '';}, t);
}

//sound
function sound(file) {
	return '<div style="float:left;"><embed src="oecms/images/'+file+'.swf" quality="high" type="application/x-shockwave-flash" height="0" width="0" hidden="true"/></div>';
}

//信息全选控制
function checkAll(e, itemName){
  var aa = document.getElementsByName(itemName);
  for (var i=0; i<aa.length; i++)
   aa[i].checked = e.checked;
}

function checkItem(e, allName){
  var all = document.getElementsByName(allName)[0];
  if(!e.checked) all.checked = false;
  else{
    var aa = document.getElementsByName(e.name);
    for (var i=0; i<aa.length; i++)
     if(!aa[i].checked) return;
    all.checked = true;
  }
}

//CSS背景控制 //鼠标经过效果
function overColor(Obj) {
	var elements=Obj.childNodes;
	for(var i=0;i<elements.length;i++){
		elements[i].className="hback_o"
		Obj.bgColor="";//颜色要改
	}
	
}

//鼠标离开效果
function outColor(Obj){
	var elements=Obj.childNodes;
	for(var i=0;i<elements.length;i++){
		elements[i].className="hback";
		Obj.bgColor="";
	}
}

function IsDigit(){
    return ((event.keyCode >= 48) && (event.keyCode <= 57));
}
function IsDigit2(){
    return ((event.keyCode >= 48) && (event.keyCode <= 57) || (event.keyCode = 46));
}

//树型结构样式(列表展开,合并效果)
function collapse(img, objName){
	var obj;
	obj = document.getElementById(objName);
	if (img.src.indexOf('open') != -1){
		img.src = img.src.replace('open', 'close');
		obj.style.display = 'none';
	}else{
		img.src = img.src.replace('close', 'open');
		obj.style.display = '';
	}
}

//只能由汉字，字母，数字组合
function checkuserstr(str){  
    var re1 = new RegExp("^([\u4E00-\uFA29]|[\uE7C7-\uE7F3]|_|[a-zA-Z0-9])*$");
	if(!re1.test(str)){
		return false;
	}else{
		return true;
	}
}

//判断字符长度，一个汉字为2个字符
function strlen(s){
	var l = 0;
	var a = s.split("");
	for (var i=0;i<a.length;i++){
		if (a[i].charCodeAt(0)<299){
			l++;
		}else{
			l+=2;
		}
	}
	return l;
}

//判断所选择数量
function check_count(id, my , num){
	var oEvent = document.getElementById('em_' + id + '_edit');
	var chks = oEvent.getElementsByTagName("INPUT");
	var count = 0;
	for(var i=0; i<chks.length; i++){
		if(chks[i].type=="checkbox"){
			if(chks[i].checked == true){
				count ++;
			}
			if(count > num){
				my.checked = false;
				alert('最多只能选择' + num + '项');
				return false;
			}
		}
	}
}