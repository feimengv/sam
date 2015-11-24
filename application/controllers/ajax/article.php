<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* 文章操作控制器
/* +----------------------------------------------------------------------+
/* | PHP version sam 1.0.0                                                 
/* +----------------------------------------------------------------------+
/* | Copyright (c) 2013-2015  SAM                           
/* +----------------------------------------------------------------------+
/* | Authors: King                                  
/* +----------------------------------------------------------------------+
*/


class Article extends MY_Controller{

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
		$this->db->where('articleid',$data['articleid']);
		$this->db->set('orders',$data['orders']);
		$this->db->update('article');
	}

	/*
	*功能：推荐功能
	*author King
	*参数：无
	*/
	public function elite()
	{
		$data = $this->input->post();
		$this->db->where('articleid',$data['articleid']);
		if($data['elite']=='open')
		{
		$this->db->set('elite',1);
		}
		else
		{
		$this->db->set('elite',0);			
		}
		$this->db->update('article');
		$result = array(
			'imgid'=>$data['elite'],
			'id'=>$data['articleid'],
		);
		echo json_encode($result);
	}
}