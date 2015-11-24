<div class="sideBar">
    <div class="catalogList">
        <ul id="materialList">
		  <li id="attentionreply" <?php if($smallmenu=='attentionreply' or $smallmenu=='index'):?>class="selected"<?php endif;?>><a href="<?=site_url('contentreplys/attentionreply')?>">被关注自动回复</a></li>
		  <li id="nodefinereply" <?php if($smallmenu=='nodefinereply'):?>class="selected"<?php endif;?> ><a href="<?=site_url('contentreplys/nodefinereply')?>">未定义消息回复</a></li>
		  <li id="textreply" <?php if($smallmenu=='textreply'):?>class="selected"<?php endif;?> ><a href="<?=site_url('contentreplys/textreply')?>">文本回复管理</a></li>
		  <li id="articlereply" <?php if($smallmenu=='articlereply'):?>class="selected"<?php endif;?> ><a href="<?=site_url('contentreplys/articlereply')?>">图文回复管理</a></li>
		  <li id="articleflreply" <?php if($smallmenu=='articleflreply'):?>class="selected"<?php endif;?> ><a href="<?=site_url('contentreplys/articleflreply')?>">文章分类管理</a></li>
		  <li id="custommenu" <?php if($smallmenu=='custommenu'):?>class="selected"<?php endif;?> ><a href="<?=site_url('contentreplys/custommenu')?>">自定义菜单</a></li>
        </ul>
    </div>
</div>