<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* 会员登录模型
/* +----------------------------------------------------------------------+
/* | PHP version sam 1.0.0                                                 
/* +----------------------------------------------------------------------+
/* | Copyright (c) 2013-2015  SAM                           
/* +----------------------------------------------------------------------+
/* | Authors: King                                  
/* +----------------------------------------------------------------------+
*/

class Login_model extends CI_Model{

	public function __construct()

	{

		parent::__construct();

	}

	/**
     * 登录审核判断
     * @param  array $data 		数组数据
     * @author  King
     */
	public function check($data)
	{

		$username = $data['username'];

		$password = md5($data['password']);

		$this->db->where('username',$username);

		$this->db->where('password',$password);

		$result = $this->db->get('member');

		if($member = $result->row_array())
		{

			//获取原始当前微信号
			$array = array(

				'author'=>$member['username'],

				'Current'=>1,

			);

			$this->db->select('Public,Oldweixinhao');

			$publicname = $this->db->get_where('publicname',$array);

			$name = $publicname->row_array();

			$userdata = array(

				'userid' => $member['userid'],

				'username' => $member['username'],

				'Oldweixinhao' => $name['Oldweixinhao'],

				'Public' => $name['Public']

			);

			$this->session->set_userdata(array('userdata' => $userdata));

			return TRUE;

		}

	}

}