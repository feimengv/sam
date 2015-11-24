<div class="logoArea">
    <a class="logo left block" href="<?=site_url('publicmember/index')?>">
        <img src="<?=base_url()?>static/images/logo.png" style="width:138px;height:53px;margin-top:15px;margin-left: -50px;" onclick="javascript:location.href='/'" alt="微信公众平台logo">
    </a>
    <div class="accountOp right">
            <span>
                <?php if ($this->userdata['Public']): ?>当前微信号:<b style="color:#FF6900;font-size:14px;">[<?php echo $this->userdata['Public']; ?>]</b><?php endif;?>
            </span>
			<span>
                <?=$this->userdata['username']?>,
            </span>
            <span>
                <a href="javascript:logout();">退出</a>
            </span>
    </div>
    <div class="clr"></div>
</div>
<div class="navigator">
    <ul class="textLarge">
        <li><a id="publicmember" href="<?=site_url('publicmember/index')?>" <?php if($bigmenu=='publicmember'): ?>class="selected"<?php endif;?>>基础设置</a></li>
        <li><a id="contentreplys" href="<?=site_url('contentreplys/attentionreply')?>" <?php if($bigmenu=='contentreplys'):?>class="selected"<?php endif;?>>公众号管理</a></li>
    </ul>
</div>