<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* 文章操作控制器
/* +----------------------------------------------------------------------+
/* | PHP version sam 1.0.0                                                      |
/* +----------------------------------------------------------------------+
/* | Copyright (c) 2013-2015  SAM                           
/* +----------------------------------------------------------------------+
/* | Authors: King                                  
/* +----------------------------------------------------------------------+
*/

class Articlecate extends MY_Controller{

	public function __construct()
	{
		parent::__construct();
	}

	/*
	*功能：排序功能
	*author King
	*参数：无
	*/
	public function orders()
	{
		$data = $this->input->post();
		$this->db->where('cateid',$data['cateid']);
		$this->db->set('orders',$data['orders']);
		$this->db->update('articlecate');
	}

	/*
	*功能：审核功能
	*author King
	*参数：无
	*/
	public function flag()
	{
		$data = $this->input->post();
		$this->db->where('cateid',$data['cateid']);
		if($data['flag']=='open')
		{
		$this->db->set('flag',1);
		}
		else
		{
		$this->db->set('flag',0);			
		}
		$this->db->update('articlecate');
		$result = array(
			'imgid'=>$data['flag'],
			'id'=>$data['cateid'],
		);
		echo json_encode($result);
	}
}