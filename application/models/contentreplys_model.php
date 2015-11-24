<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* 公众号管理
/* +----------------------------------------------------------------------+
/* | PHP version sam 1.0.0                                                 
/* +----------------------------------------------------------------------+
/* | Copyright (c) 2013-2015  SAM                           
/* +----------------------------------------------------------------------+
/* | Authors: King                                  
/* +----------------------------------------------------------------------+
*/

class Contentreplys_model extends CI_Model{

	public function __construct()
	{

		parent::__construct();

	}

	 /**
     * 记录数统计
     * @param  string  $sheet   表名称
     * @author  King
     */
	public function count_total($sheet)
	{

		$this->db->where('Oldweixinhao',$this->userdata['Oldweixinhao']);

		return $num = $this->db->count_all_results($sheet);

	}


	/**
     * 记录数统计
     * @param  string  $data   被关注回复的文本
     * @author  King
     */
	public function attentionreply($data='')
	{

		if($data)

		{

			//首先查找用户关注记录是否存在，1.存在就更新数据 2.没有就插入数据

			$result = $this->db->get_where('attentionreply',array('Oldweixinhao'=>$this->userdata['Oldweixinhao']));

			if($result = $result->row_array())

			{

				//更新

				return $this->db->update('attentionreply',$data,array('Oldweixinhao'=>$this->userdata['Oldweixinhao']));

			}

			else

			{

				//插入

				$data['author'] =$this->userdata['username'];

				$data['Oldweixinhao']  = $this->userdata['Oldweixinhao'];

				$data['title'] ='关注自动回复';

				$data['addtime'] = time();

				$this->db->insert('attentionreply',$data);

				return $this->db->affected_rows();

			}

		}

		else

		{

			$this->db->where('Oldweixinhao',$this->userdata['Oldweixinhao']);

			$result = $this->db->get('attentionreply');

			if($result = $result->row_array())

			{

				return $result;

			}

		}

	}


	/**
     * 未定义消息回复
     * @param  string  $data   未定义消息回复
     * @author  King
     */
	public function nodefinereply($data='')

	{

		if($data)

		{

			//首先查找用户关注记录是否存在，1.存在就更新数据 2.没有就插入数据

			$result = $this->db->get_where('nodefinereply',array('Oldweixinhao'=>$this->userdata['Oldweixinhao']));

			if($result = $result->row_array())

			{

				//更新

				return $this->db->update('nodefinereply',$data,array('Oldweixinhao'=>$this->userdata['Oldweixinhao']));

			}

			else

			{

				//插入

				$data['author'] =$this->userdata['username'];

				$data['Oldweixinhao']  = $this->userdata['Oldweixinhao'];

				$data['title'] ='未关注自动回复';

				$data['addtime'] = time();

				$this->db->insert('nodefinereply',$data);

				return $this->db->affected_rows();

			}

		}

		else

		{

			$this->db->where('Oldweixinhao',$this->userdata['Oldweixinhao']);

			$this->db->where('author',$this->userdata['username']);

			$result = $this->db->get('nodefinereply');

			if($result = $result->row_array())

			{

				return $result;

			}

		}

	}


	/**
     * 文本回复管理
     * @param  int  $page   分页数量
     * @param  int  $offset  偏移量
     * @author  King
     */
	public function textreply($page,$offset)

	{

		$this->db->where('Oldweixinhao',$this->userdata['Oldweixinhao']);

		$this->db->limit($page,$offset);

		$this->db->order_by('id',"desc");

		$result  = $this->db->get('textreply');

		if($result = $result->result_array())

		{

			return $result;

		}

	}

	/**
     * 添加文本回复
     * @param  array  $data   数组文本数据
     * @author  King
     */
	public function addtextreply($data)

	{

		$this->db->insert('textreply',$data);

		return $this->db->affected_rows();

	}


	/**
     * 修改文本回复
     * @param  array  $data   数组文本数据
     * @author  King
     */
	public function edittextreply($data,$id)

	{

		if($data)

		{

			$this->db->where('id',$id);

			$result = $this->db->update('textreply',$data);

			if($result)

			{

				return $result;

			}

		}

		else

		{

			$this->db->where('id',$id);

			$result = $this->db->get('textreply');

			if($result = $result->row_array())

			{

				return $result;

			}

		}

	}


	/**
     * 删除文本回复
     * @param  int  $id   数组ID
     * @author  King
     */
	public function deltextreply($id)

	{

		$this->db->where('id',$id);

		$this->db->delete('textreply');

		return $this->db->affected_rows();

	}


	/**
     * 更新自定义菜单
     * @param  array  $data   数组数据
     * @author  King
     */
	public function updatecustommenu($data='')

	{

		if($data)

		{

			$this->db->where('Oldweixinhao',$this->userdata['Oldweixinhao']);

			$result = $this->db->update('publicname',$data);

			if($result)

			{

				return $result;

			}

		}

		else

		{

		$this->db->select('Appid,AppSecret');

		$this->db->where('Oldweixinhao',$this->userdata['Oldweixinhao']);

		$result = $this->db->get('publicname');

		if($data = $result->row_array())

		{

			return $data;

		}			

		}



	}

	/**
     * 添加自定义菜单
     * @param  array  $data   数组数据
     * @author  King
     */
	public function addcustommenu($data)

	{

		$this->db->where('Oldweixinhao',$this->userdata['Oldweixinhao']);

		$result = $this->db->get('custommenu');

		if($result = $result->row_array())

		{

			$this->db->where('Oldweixinhao',$this->userdata['Oldweixinhao']);

			$this->db->set('menus',$data['menus']);

			$data = $this->db->update('custommenu');

			if($data)

			{

				return $data;

			}

		}

		else

		{	

			$this->db->insert('custommenu',$data);

			return $this->db->affected_rows();	

		}

	}



	/**
     * 定义菜单调用
     * @author  King
     */
	public function custommenu()

	{

		$this->db->where('Oldweixinhao',$this->userdata['Oldweixinhao']);

		$result = $this->db->get('custommenu');

		if($result = $result->row_array())

		{

			return $result;

		}

	}


	/**
     * 调用公众号Appid Appsecret
     * @param  string  $appid  		微信管理平台后台Appid
     * @param  string  $Appsecret   微信管理平台后台Appsecret
     * @author  King
     */
	public function menus()

	{

		$this->db->select('Appid,Appsecret');

		$this->db->where('Oldweixinhao',$this->userdata['Oldweixinhao']);

		$result = $this->db->get('publicname');

		if($result = $result->row_array())

		{

			return $result;

		}

	}


	/**
     * 公众号文章分类
     * @author  King
     */
	public function articleflreply()

	{

		$this->db->where('Oldweixinhao',$this->userdata['Oldweixinhao']);

		$this->db->where('parentid',0);

		$this->db->order_by('orders','desc');

		$this->db->order_by('cateid','desc');

		$result = $this->db->get('articlecate');

		$resultbig = $result->result_array();

		if($resultbig = $result->result_array())

		{

			$results = array();

			foreach ($resultbig as $bvalue) {

				$results[$bvalue['cateid']] =$bvalue;

				//查询子类

				$this->db->where('Oldweixinhao',$this->userdata['Oldweixinhao']);

				$this->db->where('depth',1);

				$this->db->order_by('cateid','desc');

				$resultsmall = $this->db->get('articlecate');

				foreach ($resultsmall=$resultsmall->result_array() as  $svalue) {

					if($svalue['parentid']==$bvalue['cateid'])

					{

						$svalue['catename'] = "├  ".$svalue['catename'];

						$results[$svalue['cateid']] =$svalue;

					}

				}

			}

			return $results;

		}

	}


	/**
     * 公众号文章分类查询
     * @author  King
     */
	public function cate_select()

	{

		$this->db->where('Oldweixinhao',$this->userdata['Oldweixinhao']);

		$this->db->where('parentid',0);

		$result = $this->db->get('articlecate');

		$result = $result->result_array();



		$results = "<select name='cateid' id='cateid'><option value=''>==选择==</option>";

		if($result)

		{

			foreach ($result as $k => $v) {

				$results.="<option value='".$v['cateid']."'>".$v['catename']."</option>";

			}

		}

		$results.="</select>";

		return $results;

	}


	/**
     * 所有分类查询
     * @param   int $cateid 分类的ID,如果带分类就当前分类选中，如果没有就不选中
     * @author  King
     */
	public function all_cate_select($cateid='')

	{

			$this->db->where('Oldweixinhao',$this->userdata['Oldweixinhao']);

			$this->db->where('parentid',0);

			$result = $this->db->get('articlecate');

			$resultbig = $result->result_array();

			$results = array();

			foreach ($resultbig as $bvalue) {

				$results[$bvalue['cateid']] =$bvalue;

				//查询子类

				$this->db->where('Oldweixinhao',$this->userdata['Oldweixinhao']);

				$this->db->where('depth',1);

				$this->db->order_by('cateid','desc');

				$resultsmall = $this->db->get('articlecate');

				foreach ($resultsmall=$resultsmall->result_array() as  $svalue) {

					if($svalue['parentid']==$bvalue['cateid'])

					{

						$svalue['catename'] = "├  ".$svalue['catename'];

						$results[$svalue['cateid']] =$svalue;

					}

				}

		}

		$result ="<select name='cateid' id='cateid'><option value=''>==选择==</option>";

		if($results)
		{

			foreach ($results as $k => $v) {

					if($cateid==$v['cateid'])

					{

						$result.="<option value='".$v['cateid']."' selected>".$v['catename']."</option>";

					}

					else

					{

						$result.="<option value='".$v['cateid']."'>".$v['catename']."</option>";						

					}

			}

		}

		$result.="</select>";

		return $result;



	}


	/**
     * 修改编辑分类
     * @param   int $cateid 分类的ID,如果带分类就当前分类选中，如果没有就不选中
     * @param 	int $parentid  父类的ID
     * @author  King
     */
	public function edit_cate_select($cateid,$parentid)
	{

		$this->db->where('Oldweixinhao',$this->userdata['Oldweixinhao']);

		$this->db->where('parentid',0);

		$result = $this->db->get('articlecate');

		$result = $result->result_array();

		//判断选择cateid
		if($parentid==0)

		{

			$cateid = $cateid;

		}

		else

		{

			$cateid = $parentid;

		}

		$results="<select name='cateid' id='cateid'><option value=''>==选择==</option>";

		if($result)
		{

			foreach ($result as $k => $v) {

				if($v['cateid']==$parentid)

				{

					$results.="<option value='".$v['cateid']."' selected>".$v['catename']."</option>";

				}else

				{

					$results.="<option value='".$v['cateid']."'>".$v['catename']."</option>";

				}

			}

		}

		$results.="</select>";

		return $results;

	}

	/**
     * 添加文章分类
     * @param 	array  $data   添加文章分类的数组
     * @author  King
     */
	public function addarticleflreply($data)
	{

		$this->db->insert('articlecate',$data);

		return $this->db->affected_rows();

	}


	/**
     * 修改文章分类
     * @param 	array  $data   添加文章分类的数组
     * @param 	int 	$id 	当前分类的ID
     * @author  King
     */
	public function editarticleflreply($data,$id)
	{

		if($data)
		{

			$this->db->where('cateid',$id);

			//更新文章分类内容
			$result = $this->db->update('articlecate',$data);

			if($result)

			{

				return $result;

			}

		}else

		{

			$this->db->where('cateid',$id);

			$result = $this->db->get('articlecate');

			if($result = $result->row_array())

			{

				return $result;

			}

		}

	}


	/**
     * 删除文章分类
     * @param 	int 	$id 	当前分类的ID
     * @author  King
     */
	public function delarticleflreply($id)
	{

		$this->db->where('cateid',$id);

		$this->db->delete('articlecate');

		return $this->db->affected_rows();

	}


	/**
     * 文章管理查询
     * @param 	int 	$page 		当前分页
     * @param 	int 	$offset 	当前偏移量
     * @param 	string 	$searchkey 	搜索的关键词
     * @param 	int 	$cateid 	当前分类的ID
     * @author  King
     */
	public function articlereply($page,$offset,$searchkey='',$cateid=0)
	{

		if($searchkey)$this->db->like('title',$searchkey);

		if($cateid)$this->db->where('cateid',$cateid);

		$this->db->where('Oldweixinhao',$this->userdata['Oldweixinhao']);

		$this->db->order_by('orders','desc');

		$this->db->order_by('articleid','desc');

		$this->db->limit($page,$offset);

		$result = $this->db->get('article');

		if($result = $result->result_array())
		{

			return $result;

		}

	}


	/**
     * 添加文章管理
     * @param 	array 	$data 		文章数据
     * @author  King
     */
	public function addarticlereply($data)

	{

		$this->db->where('Oldweixinhao',$this->userdata['Oldweixinhao']);

		$result = $this->db->insert('article',$data);

		return $this->db->affected_rows();

	}


	/**
     * 修改文章管理
     * @param 	array 	$data 		文章数据
     * @param 	int 	$id 		当前文章ID
     * @author  King
     */
	public function editarticlereply($data,$id)

	{

		if($data)

		{

			$this->db->where('articleid',$id);

			$result = $this->db->update('article',$data);

			if($result)

			{

				return TRUE;

			}

		}else

		{

			$this->db->where('articleid',$id);

			$result = $this->db->get('article');

			if($result =$result->row_array())

			{

				return $result;

			}

		}

	}


	/**
     * 删除文章管理
     * @param 	int 	$id 		当前文章ID
     * @author  King
     */
	public function delarticlereply($id)

	{

		$this->db->where('articleid',$id);

		$this->db->delete('article');

		return $this->db->affected_rows();

	}


	/**
     * 所有文章管理
     * @param 	int 	$page 		当前分页
     * @param 	int 	$offset 	分页偏移量
     * @author  King
     */
	public function all_article($page,$offset)

	{

		$this->db->where('Oldweixinhao',$this->userdata['Oldweixinhao']);

		$this->db->where('flag',1);

		$this->db->order_by('articleid','desc');

		$this->db->limit($page,$offset);

		$result = $this->db->get('article');

		if($result = $result->result_array())

		{

			return $result;

		}

	}

}