<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* 基础信息管理模型
/* +----------------------------------------------------------------------+
/* | PHP version sam 1.0.0                                                 
/* +----------------------------------------------------------------------+
/* | Copyright (c) 2013-2015  SAM                           
/* +----------------------------------------------------------------------+
/* | Authors: King                                  
/* +----------------------------------------------------------------------+
*/

class Publicmember_model extends CI_Model{

	public function __construct()
	{

		parent::__construct();

	}

	 /**
     * 公众号管理
     * @param string $per_page 	分页数
     * @param  int 	 $offset  	偏移量
     * @author  King
     */
	public function publics($per_page,$offset)

	{

		$this->db->where('author',$this->userdata['username']);

		if(empty($per_page)) return $this->db->count_all_results('publicname');

		$this->db->limit($per_page,$offset);

		$data = $this->db->get('publicname');

		if($result  =$data->result_array())

		{

			return $result;

		}

	}

	/**
     * 添加公众号
     * @param array $data 	公众号属性
     * @author  King
     */
	public function addpublics($data)

	{

		//更新当前公众号状态

		$this->db->where('author',$data['author']);

		$this->db->update('publicname',array('Current'=>0));

		//先更新其他公众号管理状态

		$this->db->insert('publicname',$data);

		if($this->db->affected_rows())

		{

			//添加成功变更当前公众号名称和原始ID

			$userdata = array(

				'Public'=>$data['Public'],

				'Oldweixinhao'=>$data['Oldweixinhao'],

			);

			$this->session->set_userdata(array('userdata'=>$userdata));

			return $this->db->affected_rows();

		}

	}

	/**
     * 修改公众号
     * @param array $data 	公众号属性
     * @param int 	$id 	公众号id
     * @author  King
     */
	public function editpublics($data,$id)

	{

		if($data)

		{

			$result = $this->db->update('publicname',$data,array('id'=>$id));

			return $result;

		}else{

			$result = $this->db->get_where('publicname',array('id'=>$id));

			if($data = $result->row_array())

			{

				return $data;

			}			

		}



	}

	/**
     * 删除公众号
     * @param int 	$id 	公众号id
     * @author  King
     */
	public function delpublics($id)
	{
		$this->db->delete('publicname',array('id'=>$id));

		if($this->db->affected_rows())
		{

			/*清空数据重新登录*/
			$userdata = array();
			$this->session->set_userdata(array('userdata' => $userdata));
			return $this->db->affected_rows();

		}			

	}

	public function managepublics($id)

	{

		$result = $this->db->get_where('publicname',array('id'=>$id));

		if($data = $result->row_array())

		{

			//更新所以公众号当前状态

			$this->db->update('publicname',array("Current"=>0),array('author'=>$this->userdata['username']));

			$this->db->update('publicname',array('Current'=>1),array('id'=>$id));

			$num = $this->db->affected_rows();

			//更新公众号信息

			$userdata = array(

				'userid' => $this->userdata['userid'],

				'username' => $this->userdata['username'],

				'Public'=>$data['Public'],

				'Oldweixinhao'=>$data['Oldweixinhao'],

			);

			$this->session->set_userdata(array('userdata' => $userdata));

			return $num;

		}

	}

	
	/**
     * 修改密码
     * @param array $data 	密码数据
     * @author  King
     */
	public function editpwd($data)

	{

		$oldpassword = $data['oldpassword'];

		//判断原始密码是否正确，不正确返回FALSE

		$array = array(

			'username'=>$this->userdata['username'],

			'password'=>md5($oldpassword),

		);

		$result = $this->db->get_where('member',$array);

		if($result = $result->row_array())

		{

			$newpassword = $data['newpassword'];

			$this->db->where('username',$this->userdata['username']);

			$this->db->set('password',md5($newpassword));

			$result = $this->db->update('member');

			$this->db->last_query();

			return $result;

		}
		else
		{

			return FALSE;

		}

	}


	/**
     * 完善资料
     * @param array $data 	密码数据
     * @author  King
     */
	public function completedata($data="")
	{

		if($data)

		{

			$this->db->where('username',$this->userdata['username']);

			$result = $this->db->update('member',$data);

			if($result)

			{

				return TRUE;

			}

		}

		else

		{

			//获取会员基本资料

			$this->db->where('username',$this->userdata['username']);

			$result = $this->db->get('member');

			if($data = $result->row_array())

			{

				return $data;

			}

		}

	}

	/**
     * 公众号数量
     * @author  King
     */
    public function public_total()

    {

        $this->db->where('author',$this->userdata['username']);

        $result = $this->db->get('publicname');

        if($result = $result->num_rows())

        {

            return $result;

        }

    }


}