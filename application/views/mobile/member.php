<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>会员中心</title>
<link href="<?=base_url()?>static/user/css/app.css" rel="stylesheet" type="text/css" />
</head>
<body>

<div class="uc-header">
  <div class="head-img">
      <img src="<?=$this->m_user_member['headimgurl']?>">
    </div>
    <div class="head-dsb">
      <p class="dsb-name">金子</p>
        <p class="dsb-id">NO:1</p>
    </div>
</div>


<div class="uc-nav">
  <ul>
    <li class="tiao"><a href="/wechat/order.html">我的订单</a></li>
    <li class="tiao"><a href="">我的收藏</a></li>
    <li class="hr"></li>
    <li class="tiao"><a href="/wechat/apply.html">我的试吃</a></li>
    <li class="tiao"><a href="">我的讨论</a></li>
    <li class="tiao"><a href="">个人信息修改</a></li>
    <li class="hr"></li>
    <li class="tiao"><a href="">联系我们</a></li>
    <li class="tiao"><a href="">帮助中心</a></li>
    </ul>
</div>


</body>
</html>