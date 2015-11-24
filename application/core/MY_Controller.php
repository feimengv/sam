<?php

/**
 * 功能：PC端继承主类
 * author King
 */
class MY_Controller extends CI_Controller {
	
	public function __construct() {
		parent::__construct ();
		// 赋值用户session
		$all_userdata = $this->session->all_userdata (); //获取全部session信息
		$userdata = isset ( $all_userdata ['userdata'] ) ? $all_userdata ['userdata'] : array ();
		empty($userdata)?$this->userdata['username']='':$this->userdata = $userdata;
		
		// 判断是否登录
		$this->login_check ();
		
		// 初始化_viewData
		$this->data = array ('title' => 'SAM框架', 'bigmenu' => $this->uri->segment ( 1 ), 'smallmenu' => $this->uri->segment ( 2 ) );
	}
	
	 /**
	 * 功能：判断是否已登录
	 * @author King
	 * @param 
	 */
	public function login_check() {
		$RTR = & load_class ( 'Router', 'core' );
		
		if (! $this->userdata ['username'] && ! ($RTR->class == 'login' && ($RTR->method == 'index' || $RTR->method == 'check'))) {
			echo "<script>alert('请先登录，再操作！');window.location.href='" . site_url ( 'login/index' ) . "'</script>";
			exit ();
		}
		return TRUE;
	}
}

/**
 * 功能：手机端基础H5类
 * @author King
 * @param 微信抓取用户登录
 */
class H5_Controller extends CI_Controller {

	public function __construct() {
		parent::__construct ();
		$this->load->model('mobile/member_model');

		/*开启测试数据,请上线的时候关闭测试数据*/
		  $member = array(
		  	'username'=>'金子',
		  	'userid'=>434,
		 	'headimgurl'=>'http://wx.qlogo.cn/mmopen/g3MonUZtNHkdmzicIlibx6iaFqAc56vxLSUfpb6n5WKSYVY0ChQKkiaJSgQ1dZuTOgvLLrhJbERQQ4eMsv84eavHiaiceqxibJxCfHe/0',
		 	'openid'=>'ofby1uFzRq0YUVPpCN866RemA1pY',
		  );
		  $this->session->set_userdata(array('m_user_member' => $member));

		//测试模式清除session
		if($_GET['debug'])
		{
			$this->session->unset_userdata('m_user_member');
			echo 'success';
			exit;
		}
		
		/*给定当前公众号属性*/
		$this->db->select('Oldweixinhao,AppId,AppSecret');
		$this->db->where('Current',1);
		$find =$this->db->get('publicname')->row_array();
		$Oldweixinhao = $find['Oldweixinhao'];
		$AppId = $find['AppId'];
		$AppSecret = $find['AppSecret'];
		/*给定当前公众号属性*/

		$userdata = array(
				'Oldweixinhao'=>$Oldweixinhao,
		);
		$this->m_userdata = $userdata;
		$this->session->set_userdata ( array('m_userdata'=>$userdata) );

		/*微信自动会员登录*/
		$code =  $this->input->get('code');
		$state =  $this->input->get('state');
		
		if($code && $state)
		{

			/*获取token和openid*/
			$rst = $this->http_send("https://api.weixin.qq.com/sns/oauth2/access_token?appid=$AppId&secret=$AppSecret&code=$code&grant_type=authorization_code");

			$access_token = $rst['access_token'];
			$openid = $rst['openid'];
			if(!$openid && !$access_token)
			{
				redirect('mobile/errors/tishi');
				exit;
			}else{

				/*判断用户是否已经存在*/
				if(!$result = $this->member_model->find($openid))
				{
					$result = $this->insert_member($openid,$access_token);
				}

				//绑定用户信息保存session
				if($result['username'] and $result['openid'])
				{
					$member = array(
						'username'=>$result['username'],
						'userid'=>$result['userid'],
						'headimgurl'=>$result['headimgurl'],
						'city'=>$result['city'],
						'openid'=>$result['openid'],
					);
					$this->session->set_userdata(array('m_user_member' => $member));
					$this->m_user_member = $this->session->userdata('m_user_member');
					$state = base64_decode($state);
					redirect($state);
					exit;
				}
			}
			
		}
		//自动会员登录
		if($this->session->userdata('m_user_member'))
		{
			$this->m_user_member = $this->session->userdata('m_user_member');
		}else{
			//构建转向URL
			$arr=array(
			'appid'=> $AppId,
			'redirect_uri'=>'http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"],
			'response_type'=>'code',
			'scope'=>'snsapi_userinfo',
			'state'=>base64_encode('http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"]),
			);
			//开始转向了。
			$url='https://open.weixin.qq.com/connect/oauth2/authorize?'.http_build_query($arr).'#wechat_redirect';
    		redirect($url);
		}

		$this->data = array ('title' => '','copyright'=>'版权所有©腾信通', 'bigmenu' => $this->uri->segment ( 1 ), 'smallmenu' => $this->uri->segment ( 2 ) );

	}

	/**
	 * 功能：写入用户信息到数据库
	 * @author King
	 * @param  string $openid 用户openid
	 * @param  string $access_token 用于抓取用户信息
	 */
	public function insert_member($openid,$access_token)
	{
		/*获取用户基本信息*/
		$rst = $this->http_send("https://api.weixin.qq.com/sns/userinfo?access_token=$access_token&openid=$openid&lang=zh_CN");
		//公众号
		$rst['Oldweixinhao'] = $this->m_userdata['Oldweixinhao'];

		if(!$rst['openid'] and !$rst['nickname'])
		{
			echo '获取数据失败';
			return false;
		}

		$result = $this->member_model->insert_member($rst);
		 
		if($result)
		{
			$result =$this->member_model->find($openid);
			return $result;
		}
	}

	/**
	*功能：常用于抓取网页json或者xml数据
	*@author King
	*@param string $url  网址路径
	*@param string $data 传输的数据
	*/
	public function http_send($url,$data=''){
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		if($data)
		{
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		}
		$rst = curl_exec($ch);
		$rst = json_decode($rst,true);
		curl_close($ch);
		return $rst;
	}

}