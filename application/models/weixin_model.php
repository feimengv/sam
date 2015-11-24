<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Weixin_model extends CI_Model{



	public function __construct()

	{

		parent::__construct();

	}

	public function subscribe($data="")

	{

		$this->db->select('message, choose');

		$this->db->where('Oldweixinhao',"$data");

		$result = $this->db->get('attentionreply');

		if($result = $result->row_array())

		{

			return $result;

		}

	}

	public function nodefinereply($data)

	{

		$this->db->select('message');

		$this->db->where('Oldweixinhao',"$data");

		$result = $this->db->get('nodefinereply');

		if($result = $result->row_array())

		{

			return $result;

		}

	}

	public function textreply($keyword='',$toUsername='')

	{

		//完全匹配

		$this->db->select('keywords,content');

		$this->db->where('keymatch',0);

		$this->db->where('Oldweixinhao',"$toUsername");

		$result = $this->db->get('textreply');

		if($rows = $result->result_array())

		{

			foreach ($rows as $value) {
				$key_more = explode(" ", $value['keywords']);
				foreach ($key_more as $k => $v) {
					if($v==$keyword)
					{
						return $value;
						exit;
					}
				}
			}


		}

		//不完全匹配

		$this->db->select('keywords,content');

		$this->db->where('keymatch',1);

		$this->db->where('Oldweixinhao',"$toUsername");

		$result = $this->db->get('textreply');

		if($rows = $result->result_array())

		{

			foreach ($rows as $value) {
				$key_more = explode(" ", $value['keywords']);
				foreach ($key_more as $k => $v) {
					if(strstr($keyword,$v))
					{
					return $value;
					exit;
					}
				}

			}

		}

	}

	public function articlereply($keyword='',$toUsername='')

	{

		//完全匹配

		$this->db->where('keymatch',0);

		$this->db->where('Oldweixinhao',"$toUsername");

		$result = $this->db->get('article');

		if($rows = $result->result_array())

		{

			foreach ($rows as $value) {
				$key_more = explode(" ", $value['keyword']);
				foreach ($key_more as $k => $v) {
					if($v==$keyword)
					{
						return $value;
						exit;
					}
				}
			}


		}

		//不完全匹配关键词
		$this->db->where('keymatch',1);

		$this->db->where('Oldweixinhao',"$toUsername");

		$result = $this->db->get('article');

		if($rows = $result->result_array())
		{

			foreach ($rows as $value) {
				$key_more = explode(" ", $value['keyword']);
				foreach ($key_more as $k => $v) {
					if(strstr($keyword,$v))
					{
					return $value;
					exit;
					}
				}

			}

		}

	}

	public function totalmanyarticle($data)
	{

		$data = json_decode($data);

		return count($data)+1;

	}

	public function article($id)
	{

		$this->db->where('articleid',$id);

		$result = $this->db->get('article');

		if($result = $result->row_array())

		{

			return $result;

		}

	}

	public function manyarticle($data)
	{

		$data = json_decode($data);

		foreach ($data as $key => $value) {

			$result['editmanyarticle'][$key] = $this->article($value);

		}

		return $result['editmanyarticle'];

	}

	public function eventkey($keywords,$fromUsername,$toUsername)
	{

		$data = array(

			'keywords'=>$keywords,

			'fromUsername' => $fromUsername,

			'toUsername' => $toUsername,

			'year'=>date('Y',time()),

			'month'=>date('m',time()),

			'day'=>date('d',time()),

		);

		return $this->db->insert('twocodesn',$data);

	}
	public function location($fromUsername,$toUsername,$Latitude,$Longitude,$Precision)
	{

		//查找记录是否存在

		$this->db->where('fromUsername',$fromUsername);

		$result = $this->db->get('location');

		if(!$result = $result->row_array())

		{

			$data = array(

				'fromUsername' => $fromUsername,

				'toUsername' => $toUsername,

				'Latitude'=>$Latitude,

				'Longitude'=>$Longitude,

				'Precision'=>$Precision,

				'addtime'=>time(),

			);

			return $this->db->insert('location',$data);

		}else

		{

				$data = array(

				'Latitude'=>$Latitude,

				'Longitude'=>$Longitude,

				'Precision'=>$Precision,

				'addtime'=>time(),

			);

			$this->db->where('fromUsername',$fromUsername);

			$result =  $this->db->update('location',$data);

			return $result;

		}

	}
	public function wx_result($Oldweixinhao)
	{
		$this->db->select('AppId,AppSecret');
		$this->db->where('Oldweixinhao',$Oldweixinhao);
		$result = $this->db->get('publicname');
		if($result = $result->row_array())
		{
			return $result;

		}
	}

}