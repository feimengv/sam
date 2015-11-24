<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* 基础信息管理
/* +----------------------------------------------------------------------+
/* | PHP version sam 1.0.0                                                 
/* +----------------------------------------------------------------------+
/* | Copyright (c) 2013-2015  SAM                           
/* +----------------------------------------------------------------------+
/* | Authors: King                                  
/* +----------------------------------------------------------------------+
*/

class Publicmember extends MY_Controller{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('publicmember_model');
	}

	/*
	*功能：基础设置
	*author King
	*参数：无
	*/
	public function index()
	{
		$data['title'] = 'SAM微信框架';
		$data['bigmenu'] = $this->uri->segment(1);
		$data['smallmenu'] = $this->uri->segment(2);
		$data['server_name'] = "http://".$this->input->server('SERVER_NAME')."/";
		if(!$this->userdata['Public'])
		{
			echo "<script>alert('请先添加公众号，再操作！');window.location.href='".site_url('publicmember/addpublics')."'</script>";
			exit;
		}

		$this->load->view('publicmember/basesetting',$data);
	}

	/*
	*功能：公众号管理
	*author King
	*参数：无
	*/
	public function publics()
	{
		$data['title'] = 'SAM微信框架';
		$data['bigmenu'] = $this->uri->segment(1);
		if(strpos($this->uri->segment(2),"publics")!==FALSE)
		{
			$data['smallmenu'] ="publics";
		}

		//总记录数
		$offset = (int)$this->uri->segment(3);
		$data['count_all'] = $this->publicmember_model->publics(0,0);
		$this->load->library('pagination');
		$config['base_url'] = site_url('publicmember/publics');
		$config['total_rows']  = $data['count_all'];
		$config['per_page'] = 10;
		$config['first_link'] = '首页';
		$config['prev_link'] = '上一页';
		$config['next_link'] = '下一页';
		$config['last_link'] = '尾页';
		$this->pagination->initialize($config);
		$data['links'] =  $this->pagination->create_links();

		//获取公众号数据
		$data['result'] =$this->publicmember_model->publics($config['per_page'],$offset);

		$this->load->view('publicmember/publics',$data);
	}


	/*
	*功能：添加公众号
	*author King
	*参数：无
	*/
	public function addpublics()
	{
		$data['title'] = 'SAM微信框架';
		$data['bigmenu'] = $this->uri->segment(1);

		if(strpos($this->uri->segment(2),"publics")!==FALSE)
		{
			$data['smallmenu'] ="publics";
		}

		//表单验证
		$this->load->library('form_validation');
		$this->form_validation->set_rules("data[Public]","Public","required");
		$this->form_validation->set_rules("data[Weixinhao]","Weixinhao","required");
		$this->form_validation->set_rules("data[Oldweixinhao]","Oldweixinhao","required");
		if($this->form_validation->run()==FALSE)
		{
			$this->load->view('publicmember/addpublics',$data);
		}else{
			//判断公众号总数
			$public_total = $this->publicmember_model->public_total();
			if($public_total>=1)
			{
				//提示窗口设置
				$msg= array(
					'userid' => $this->userdata['userid'],
					'username' => $this->userdata['username'],
					'titlemsg'=>"您已经超过添加限制，只能添加一个公众号。", //窗口提示的文字
					'urlmsg'=>site_url('publicmember/publics'),  //返回的路径
				);
				$this->load->view('log',$msg);	
			}
			else
			{
				$data = $this->input->post('data');
				//保存数据
				$result = $this->publicmember_model->addpublics($data);
				if($result)
				{
					//提示窗口设置
					$msg= array(
						'userid' => $this->userdata['userid'],
						'username' => $this->userdata['username'],
						'titlemsg'=>"添加公众号成功", //窗口提示的文字
						'urlmsg'=>site_url('publicmember/publics'),  //返回的路径
					);
					$this->load->view('log',$msg);

				}
			}			
		}

	}


	/*
	*功能：修改公众号
	*author King
	*参数：无
	*/
	public function editpublics()
	{

		//根据修改还是保存获取ID
		if($this->input->get_post('id'))
		{
			$id = $this->input->get_post('id');
			$data = $this->input->post('data');
		}else{
			$id = $this->uri->segment(3);
		}
		//表单验证
		$this->load->library('form_validation');
		$this->form_validation->set_rules("data[Public]","Public","required");
		$this->form_validation->set_rules("data[Weixinhao]","Weixinhao","required");
		$this->form_validation->set_rules("data[Oldweixinhao]","Oldweixinhao","required");
		if($this->form_validation->run()==FALSE)
		{
			//获取ID的公众号数据
			$data = $this->publicmember_model->editpublics('',$id);

			$data['title'] = 'SAM微信框架';
			$data['bigmenu'] = $this->uri->segment(1);

			if(strpos($this->uri->segment(2),"publics")!==FALSE)
			{
				$data['smallmenu'] ="publics";
			}
			$this->load->view('publicmember/editpublics',$data);
		}else{
			//保存数据
			$result = $this->publicmember_model->editpublics($data,$id);
			if($result)
			{
				//提示窗口设置
				$msg= array(
					'titlemsg'=>"修改公众号成功", //窗口提示的文字
					'urlmsg'=>site_url('publicmember/publics'),  //返回的路径
				);
				$this->load->view('log',$msg);
			}			
		}

	}

	/*
	*功能：删除公众号
	*author King
	*参数：无
	*/
	public function delpublics()
	{
		if($data = $this->input->post('tid'))
		{
			foreach ($data as $key => $value) {
				$result = $this->publicmember_model->delpublics($value);
				if(!$result)
				{
					//提示窗口设置
					$msg= array(
						'titlemsg'=>"禁止删除当前管理公众号", //窗口提示的文字
						'urlmsg'=>site_url('publicmember/publics'),  //返回的路径
					);
					$this->load->view('log',$msg);

				}
			}
			if($result)
			{
					//提示窗口设置
					$msg= array(
						'titlemsg'=>"删除公众号成功", //窗口提示的文字
						'urlmsg'=>site_url('publicmember/publics'),  //返回的路径
					);
					$this->load->view('log',$msg);

			}

		}else{
			$id = $this->uri->segment(3);
			$result = $this->publicmember_model->delpublics($id);
			if($result)
			{
					//提示窗口设置
					$msg= array(
						'titlemsg'=>"删除公众号成功", //窗口提示的文字
						'urlmsg'=>site_url('publicmember/publics'),  //返回的路径
					);
					$this->load->view('log',$msg);
			}else{
					//提示窗口设置
					$msg= array(
						'titlemsg'=>"禁止删除当前管理公众号", //窗口提示的文字
						'urlmsg'=>site_url('publicmember/publics'),  //返回的路径
					);
					$this->load->view('log',$msg);
			}
		}
	}

	/*
	*功能：公众号管理
	*author King
	*参数：无
	*/
	public function managepublics($id)
	{
		if($id)
		{
			$result = $this->publicmember_model->managepublics($id);
			if($result)
			{
					//提示窗口设置
					$msg= array(
						'titlemsg'=>"切换公众号成功", //窗口提示的文字
						'urlmsg'=>site_url('publicmember/publics'),  //返回的路径
					);
					$this->load->view('log',$msg);
			}
		}
	}

	/*
	*功能：修改密码
	*author King
	*参数：无
	*/
	Public function editpwd()
	{

		//表单验证
		$this->load->library('form_validation');
		$this->form_validation->set_rules("data[oldpassword]","oldpassword","required");
		$this->form_validation->set_rules("data[newpassword]","newpassword","required");
		$this->form_validation->set_rules("data[surepassword]","surepassword","required");
		if($this->form_validation->run()==FALSE)
		{
			$data['title'] = 'SAM微信框架';
			$data['bigmenu'] = $this->uri->segment(1);
			if(strpos($this->uri->segment(2),"editpwd")!==FALSE)
			{
				$data['smallmenu'] ="editpwd";
			}
			$this->load->view('publicmember/editpwd',$data);
		}else
		{
			$data = array();
			$data = $this->input->post('data');
			$result = $this->publicmember_model->editpwd($data);
			if($result)
			{
					//提示窗口设置
					$msg= array(
						'titlemsg'=>"修改密码成功", //窗口提示的文字
						'urlmsg'=>site_url('publicmember/publics'),  //返回的路径
					);
					$this->load->view('log',$msg);
			}else{
				echo "<script>alert('原始密码不正确');window.history.back()</script>";
				exit;
			}
		}


	}

	/*
	*功能：资料完善
	*author King
	*参数：无
	*/
	public function completedata()
	{
		//表单验证
		$this->load->library('form_validation');
		$this->form_validation->set_rules("data[nickname]","nickname","required");
		$this->form_validation->set_rules("data[email]","email","required");
		$this->form_validation->set_rules("data[tel]","tel","required");
		if($this->form_validation->run()==FALSE)
		{
			//获取会员基本信息
			$data = $this->publicmember_model->completedata();
			$data['title'] = 'SAM微信框架';
			$data['bigmenu'] = $this->uri->segment(1);
			if(strpos($this->uri->segment(2),"completedata")!==FALSE)
			{
				$data['smallmenu'] ="completedata";
			}
			if($data)
			{
				$this->load->view('publicmember/completedata',$data);
			}
		}
		else
		{
			$data = $this->input->post('data');
			$result = $this->publicmember_model->completedata($data);
			if($result)
			{
					//提示窗口设置
					$msg= array(
						'titlemsg'=>"更新资料成功", //窗口提示的文字
						'urlmsg'=>site_url('publicmember/completedata'),  //返回的路径
					);
					$this->load->view('log',$msg);
			}
		}


	}

}