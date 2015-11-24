<?php
//创建菜单类
class Make_menu
{
    
    private $mc=null;
    
	private $ch=null;
    
    private $AppId=APPID;//你的Appid
    
    private $AppSecret=APPSECRET;//你的AppSecret
    
    //初始化缓存、抓取类

    function __construct(){
		global $rowapi;
        $this->ch = curl_init();

	}
    
    //获取token
    function get_access_token()
    {
        //监测token缓存是否有效
        if($this->AppId!=""){
            //获取token，页面地址为https://api.weixin.qq.com/cgi-bin/token
            curl_setopt($this->ch,CURLOPT_URL,"https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$this->AppId."&secret=".$this->AppSecret);
            curl_setopt($this->ch,CURLOPT_RETURNTRANSFER,true);
            curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, FALSE); 
            curl_setopt($this->ch, CURLOPT_BINARYTRANSFER, true);
            $rst=curl_exec($this->ch);
            if(curl_errno($this->ch)) 
            {
                echo curl_error($this->ch);
                exit;
            }
             else 
            {
               //抓取页面成功，先将抓取的数据转换成数组；
                $rst=json_decode($rst,true);
                 
                 //如果授权失败打印错误代码
                if($rst["errcode"]!=0)
                {
                    echo "获取token失败，错误提示为：".$rst["errmsg"]."，错误代码编号为：".$rst["errcode"];
                    echo "<br><a href='http://mp.weixin.qq.com/wiki/index.php?title=%E8%BF%94%E5%9B%9E%E7%A0%81%E8%AF%B4%E6%98%8E' target='_blank'>错误代码对照表</a>";
                    exit;	
                }
                 //授权成功则将token和过期时间缓存
                else
                {
                    $access_token=$rst["access_token"];
                    $expires_in=$rst["expires_in"];
                    
                    //将获得的token保存到缓存里,过期时间设定为获取的过期时间-60秒
                    
                    // $this->mc->set("mp_access_token", $access_token, 0, $expires_in-60);
                }
                     
             }
            
        }
        //返回token
        return $access_token;
 
    }
    //创建菜单
    function create_new_menu($menu)
    {
    	
          curl_setopt_array(
            $this->ch,
            array(
              CURLOPT_URL=>'https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.$this->get_access_token(),
              CURLOPT_RETURNTRANSFER=>true,
              CURLOPT_POST=>true,
              CURLOPT_POSTFIELDS=>$menu
            )
          );
        	$rst=curl_exec($this->ch);
            if(curl_errno($this->ch)) 
            {
                echo curl_error($this->ch);
                exit;
            }
             else 
            {
               //抓取页面成功，先将抓取的数据转换成数组；
                $rst=json_decode($rst,true);
                 
                 //如果创建失败打印错误代码
                if($rst["errcode"]!=0)
                {
                    echo "创建菜单失败，错误提示为：".$rst["errmsg"]."，错误代码编号为：".$rst["errcode"];
                    echo "<br><a href='http://mp.weixin.qq.com/wiki/index.php?title=%E8%BF%94%E5%9B%9E%E7%A0%81%E8%AF%B4%E6%98%8E' target='_blank'>错误代码对照表</a>";
                    exit;	
                }
                     
             }
    
    }
    
    //查询菜单
    function get_menu()
    {
    
            //获取token，页面地址为https://api.weixin.qq.com/cgi-bin/token
            curl_setopt($this->ch,CURLOPT_URL,"https://api.weixin.qq.com/cgi-bin/menu/get?access_token=".$this->get_access_token());
            curl_setopt($this->ch,CURLOPT_RETURNTRANSFER,true);
            $rst=curl_exec($this->ch);
            if(curl_errno($this->ch)) 
            {
                echo curl_error($this->ch);
                exit;
            }
             else 
            {
               //抓取页面成功，先将抓取的数据转换成数组；
                $rst=json_decode($rst,true);
            }
        	return $rst;
    
    
    }
    //删除菜单
    function del_menu()
    {
    
            //获取token，页面地址为https://api.weixin.qq.com/cgi-bin/token
            curl_setopt($this->ch,CURLOPT_URL,"https://api.weixin.qq.com/cgi-bin/menu/delete?access_token=".$this->get_access_token());
            curl_setopt($this->ch,CURLOPT_RETURNTRANSFER,true);
            $rst=curl_exec($this->ch);
            if(curl_errno($this->ch)) 
            {
                echo curl_error($this->ch);
                exit;
            }
             else 
            {
               //抓取返回数据；
                $rst=json_decode($rst, true);
                 
                 //如果删除失败打印错误代码
                if($rst["errcode"]!=0)
                {
                    echo "删除菜单失败，错误提示为：".$rst["errmsg"]."，错误代码编号为：".$rst["errcode"];
                    echo "<br><a href='http://mp.weixin.qq.com/wiki/index.php?title=%E8%BF%94%E5%9B%9E%E7%A0%81%E8%AF%B4%E6%98%8E' target='_blank'>错误代码对照表</a>";
                    exit;	
                }
                     
             }
    
    }

}
?>