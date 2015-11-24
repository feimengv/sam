            <div class="sideBar">
                <div class="catalogList">
                    <ul id="materialList">
						<li  id="index" <?php if($smallmenu=='index'):?>class="selected"<?php endif;?> ><a href="<?=site_url('publicmember/index')?>">基础设置</a></li>
                        <li  id="publics" <?php if($smallmenu=='publics'):?>class="selected"<?php endif;?> ><a href="<?=site_url('publicmember/publics')?>">公众号</a></li>
                        <li  id="editpwd" <?php if($smallmenu=='editpwd'):?>class="selected"<?php endif;?> ><a href="<?=site_url('publicmember/editpwd')?>">修改密码</a></li>
						<li  id="completedata" <?php if($smallmenu=='completedata'):?>class="selected"<?php endif;?> ><a href="<?=site_url('publicmember/completedata')?>">修改资料</a></li>
                    </ul>
                </div>
            </div>