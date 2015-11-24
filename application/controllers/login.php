<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* 用户登录
/* +----------------------------------------------------------------------+
/* | PHP version sam 1.0.0                                                 
/* +----------------------------------------------------------------------+
/* | Copyright (c) 2013-2015  SAM                           
/* +----------------------------------------------------------------------+
/* | Authors: King                                  
/* +----------------------------------------------------------------------+
*/

class Login extends MY_Controller{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
	}

	/*
	*功能：用户登录模板
	*author King
	*参数：无
	*/
	public function index()
	{
		$data['title'] = 'SAM微信框架';
		//模板文件
		$this->load->view('login',$data);
	}


	/*
	*功能：审核用户登录信息
	*author King
	*参数：无
	*/
	public function check()
	{

		$data = $this->input->post('data');
		//调用登陆model检验
		$result = $this->login_model->check($data);
		if($result)
		{
			echo "<script>window.location.href='".site_url('publicmember/index')."'</script>";
		}
		else
		{
			echo "<script>alert('账号或密码错误，请重新输入！');window.history.back();</script>";
		}
	}

	/*
	*功能：用户退出
	*author King
	*参数：无
	*/
	public function logout()
	{
		$data['title'] = 'SAM微信框架';
		//清除登陆的SESSION字段
		$this->session->unset_userdata('userdata');
		unset($_SESSION);
		$this->load->view('login',$data);
	}
}