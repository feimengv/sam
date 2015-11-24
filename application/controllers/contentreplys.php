<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* 内容操作控制器
/* +----------------------------------------------------------------------+
/* | PHP version sam 1.0.0                                                 
/* +----------------------------------------------------------------------+
/* | Copyright (c) 2013-2015  SAM                           
/* +----------------------------------------------------------------------+
/* | Authors: King                                  
/* +----------------------------------------------------------------------+
*/

class Contentreplys extends MY_Controller{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('contentreplys_model');
		if(!$this->userdata['Public'])
		{
			echo "<script>alert('请先添加公众号，再操作！');window.location.href='".site_url('publicmember/addpublics')."'</script>";
			exit;
		}
	}

	/*
	*功能：被关注回复
	*author King
	*参数：无
	*/
	public function attentionreply()
	{
		//表单验证
		if($data = $this->input->post('data'))
		{	
			$result = $this->contentreplys_model->attentionreply($data);
			if($result)
			{

			//提示窗口设置
			$msg= array(
				'titlemsg'=>"被关注自动回复设置成功！", //窗口提示的文字
				'urlmsg'=>site_url('contentreplys/attentionreply'),  //返回的路径
				'typemsg'=>'succeed'	//succeed成功提示error错误提示
			);
			$this->load->view('log',$msg);
			}
		}
		else
		{
			$data = $this->contentreplys_model->attentionreply();	
			$data['title'] = 'SAM微信框架';
			$data['bigmenu'] = $this->uri->segment(1);
			$data['smallmenu'] = $this->uri->segment(2);
			//模板文件
			$this->load->view('contentreplys/attentionreply',$data);
		}

	}

	/*
	*功能：未定义消息回复
	*author King
	*参数：无
	*/
	public function nodefinereply()
	{
		//表单验证
		if($data = $this->input->post('data'))
		{	
			$result = $this->contentreplys_model->nodefinereply($data);
			if($result)
			{
			//提示窗口设置
			$msg= array(
				'titlemsg'=>"未定义消息设置成功！", //窗口提示的文字
				'urlmsg'=>site_url('contentreplys/nodefinereply'),  //返回的路径
				'typemsg'=>'succeed'	//succeed成功提示error错误提示
			);
			$this->load->view('log',$msg);


			}
		}
		else
		{
			$data = $this->contentreplys_model->nodefinereply();		
			$data['title'] = 'SAM微信框架';
			$data['bigmenu'] = $this->uri->segment(1);
			$data['smallmenu'] = $this->uri->segment(2);
			//模板文件
			$this->load->view('contentreplys/nodefinereply',$data);
		}

	}

	/*
	*功能：文本回复
	*author King
	*参数：无
	*/
	public function textreply()
	{
		$data['title'] = 'SAM微信框架';
		$data['bigmenu'] = $this->uri->segment(1);
		if(strpos($this->uri->segment(2),"textreply")!==FALSE)
		{
			$data['smallmenu'] ="textreply";
		}
		//调用文本回复数据
		$data['total'] = $this->contentreplys_model->count_total('textreply');
		$offset = (int)$this->uri->segment(3);
		$this->load->library("pagination");
		$config['base_url'] =site_url('contentreplys/textreply');
		$config['total_rows'] = $data['total'];
		$config['per_page'] = 10;
		$config['first_link'] = '首页';
		$config['prev_link'] = '上一页';
		$config['next_link'] = '下一页';
		$config['last_link'] = '尾页';
		$this->pagination->initialize($config);
		$data['links'] = $this->pagination->create_links();

		//分页查询
		$data['result']= $this->contentreplys_model->textreply($config['per_page'],$offset);
		$this->load->view('contentreplys/textreply',$data);
	}

	/*
	*功能：添加文本回复
	*author King
	*参数：无
	*/
	public function addtextreply()
	{
		//表单验证
		$this->form_validation->set_rules('data[keywords]','Keywords','required');
		$this->form_validation->set_rules('data[content]','content','required');
		if($this->form_validation->run()==TRUE)
		{
			$data = $this->input->post('data');
			//添加文本数据
			$result = $this->contentreplys_model->addtextreply($data);
			if($result)
			{
				//提示窗口设置
				$msg= array(
					'titlemsg'=>"添加文本回复成功", //窗口提示的文字
					'urlmsg'=>site_url('contentreplys/textreply'),  //返回的路径
					'typemsg'=>'succeed'	//succeed成功提示error错误提示
				);
				$this->load->view('log',$msg);
			}

		}
		else
		{	
			$data['title'] = 'SAM微信框架';
			$data['bigmenu'] = $this->uri->segment(1);
			if(strpos($this->uri->segment(2),"textreply")!==FALSE)
			{
				$data['smallmenu'] ="textreply";
			}
			$this->load->view('contentreplys/addtextreply',$data);	
		}
	}


	/*
	*功能：修改文本回复
	*author King
	*参数：无
	*/
	public function edittextreply()
	{

		$id = $this->uri->segment(3);
		$this->form_validation->set_rules('data[keywords]','keywords','required');
		$this->form_validation->set_rules('data[content]','content','required');
		if($this->form_validation->run()==TRUE)
		{
			$data  = $this->input->post('data');
			$result = $this->contentreplys_model->edittextreply($data,$id);
			if($result)
			{
				//提示窗口设置
				$msg= array(
					'titlemsg'=>"修改文本回复成功", //窗口提示的文字
					'urlmsg'=>site_url('contentreplys/textreply'),  //返回的路径
					'typemsg'=>'succeed'	//succeed成功提示error错误提示
				);
				$this->load->view('log',$msg);
			}
		}
		else
		{
			$data = $this->contentreplys_model->edittextreply('',$id);
			$data['title'] = 'SAM微信框架';
			$data['bigmenu'] = $this->uri->segment(1);
			if(strpos($this->uri->segment(2),"textreply")!==FALSE)
			{
				$data['smallmenu'] ="textreply";
			}
			$this->load->view('contentreplys/edittextreply',$data);
		}
	}

	/*
	*功能：删除文本回复
	*author King
	*参数：tid要删除的数据
	*/
	public function deltextreply()
	{
		//是数组形式的内容循环删除
		if($data = $this->input->post('tid'))
		{
			foreach ($data as $key => $value) {
				$result = $this->contentreplys_model->deltextreply($value);
			}
			if($result)
			{
						//提示窗口设置
						$msg= array(
							'titlemsg'=>"删除文本回复成功", //窗口提示的文字
							'urlmsg'=>site_url('contentreplys/textreply'),  //返回的路径
							'typemsg'=>'succeed'	//succeed成功提示error错误提示
						);
						$this->load->view('log',$msg);
			}
		}
		else
		{
				$id = $this->uri->segment(3);
				if($id)
				{
					$result = $this->contentreplys_model->deltextreply($id);
					if($result)
					{
						//提示窗口设置
						$msg= array(
							'titlemsg'=>"删除文本回复成功", //窗口提示的文字
							'urlmsg'=>site_url('contentreplys/textreply'),  //返回的路径
							'typemsg'=>'succeed'	//succeed成功提示error错误提示
						);
						$this->load->view('log',$msg);
					}
				}			
		}

	}

	/*
	*功能：创建自定义菜单
	*author King
	*参数：无
	*/
	public function custommenu()
	{
		if($this->input->post('data'))
		{
			$data = $this->input->post('data');

			if($data['custommenu'])
			{
				foreach ($data['custommenu'] as $key => $value) {
					if($value['orders']==0)
					{
						$data['custommenus'][] =$value;
					}else
					{
						$data['custommenus'][$value['orders']] =$value;						
					}
				}
				ksort($data['custommenus']);
				$data['custommenu'] =$data['custommenus'];
			}
			$array = array(
				'author'=>$this->userdata['username'],
				'Oldweixinhao'=>$this->userdata['Oldweixinhao'],
				'menus'=>json_encode($data['custommenu']),
				'addtime'=>time(),
			);
			$result = $this->contentreplys_model->addcustommenu($array);

			if($result)
			{
			// 调用接口创建微信自定义菜单
			$custommenus = $data['custommenu'];
			if($custommenus)
			{
			//定义接口参数
			$menus = $this->contentreplys_model->menus();
			define(APPID,$menus['Appid']);
			define(APPSECRET,$menus['Appsecret']);

			foreach($custommenus as $k=>$v){
			if($v['childs']){
		    $temp_sub_menu=array();
			if(count($v['childs'])>5){
			echo "<script>alert('子菜单不允许超过五个！');window.location.href='".site_url('contentreplys/custommenu')."'</script>";
			exit;
			}
			$sub_menu = $v['childs'];

			foreach($sub_menu as $m=>$value)
                {                    
					if(substr_count($value['metatitle'],'http')>=1){
					    $temp_sub_menu[]=array(
                             "type"=>"view",
                             "name"=>urlencode($value['catename']),
                             "url"=>urlencode(url_add_Oldweixinhao($value['metatitle']))
                        );
					}else{
					    $temp_sub_menu[]=array(
                             "type"=>"click",
                             "name"=>urlencode($value['catename']),
                             "key"=>urlencode($value['metatitle'])
                        );
					}

                }
				$temp_menu=array(
	         		 "name"=>urlencode($v['catename']),
	         		 "sub_button"=>$temp_sub_menu
	                );
				}else{
					if(substr_count($v['metatitle'],'http')>=1){
					$temp_menu=array(
						'type'=>'view',
						'name'=>urlencode($v['catename']),
						'url'=>urlencode(url_add_Oldweixinhao($v['metatitle']))
					);
					}else{
					$temp_menu=array(
						'type'=>'click',
						'name'=>urlencode($v['catename']),
						'key'=>urlencode($v['metatitle'])
					);
					}
				}
				$menu['button'][]=$temp_menu;
				}
				$this->load->library('make_menu');
				$this->make_menu->del_menu();
				$this->make_menu->create_new_menu(urldecode(json_encode($menu)));
				}

						//提示窗口设置
						$msg= array(
							'titlemsg'=>"自定义菜单设置成功", //窗口提示的文字
							'urlmsg'=>site_url('contentreplys/custommenu'),  //返回的路径
							'typemsg'=>'succeed'	//succeed成功提示error错误提示
						);
						$this->load->view('log',$msg);
			}
		}
		else
		{
			//调用菜单数据
			$result = $this->contentreplys_model->custommenu();
			$result['menus'] = json_decode($result['menus'],TRUE);
			$result['key'] = $this->contentreplys_model->updatecustommenu();
			$result['title'] = 'SAM微信框架';
			$result['bigmenu'] = $this->uri->segment(1);

			if(strpos($this->uri->segment(2),"custommenu")!==FALSE)
			{
				$result['smallmenu'] ="custommenu";
			}

			$this->load->view('contentreplys/custommenu',$result);
		}

	}

	/*
	*功能：更新自定义菜单
	*author King
	*参数：无
	*/
	public function updatecustommenu()
	{

		$this->form_validation->set_rules('data[appid]','appid','required');
		$this->form_validation->set_rules('data[appsecret]','appsecret','required');
		if($this->form_validation->run()==TURE)
		{
			$data = $this->input->post('data');
			$result = $this->contentreplys_model->updatecustommenu($data);
			if($result)
			{
						//提示窗口设置
						$msg= array(
							'titlemsg'=>"设置成功", //窗口提示的文字
							'urlmsg'=>site_url('contentreplys/custommenu'),  //返回的路径
							'typemsg'=>'succeed'	//succeed成功提示error错误提示
						);
						$this->load->view('log',$msg);
			}
		}
	}

	/*
	*功能：文章分类
	*author King
	*参数：无
	*/
	public function articleflreply()
	{
		$data['title'] = 'SAM微信框架';
		$data['bigmenu'] = $this->uri->segment(1);
		if(strpos($this->uri->segment(2),"articleflreply")!==FALSE)
		{
			$data['smallmenu'] ="articleflreply";
		}
		$data['total'] = $this->contentreplys_model->count_total('articlecate');

		//调用分类数据
		$data['result'] = $this->contentreplys_model->articleflreply();
		$this->load->view('contentreplys/articleflreply',$data);
	}

	/*
	*功能：添加文章分类
	*author King
	*参数：无
	*/
	public function addarticleflreply()
	{
		$this->form_validation->set_rules('data[catename]','catename','required');
		$this->form_validation->set_rules('data[orders]','orders','required');
		if($this->form_validation->run()==TRUE)
		{
			$data = $this->input->post('data');
			//获取父类ID
			if($parent = $this->input->post('cateid'))
			{
				$data['parentid'] = (int)$parent;
				$data['depth'] = 1;
			}
			else
			{
				$data['parentid']  = 0;
			}
			$result = $this->contentreplys_model->addarticleflreply($data);
			if($result)
			{
				//提示窗口设置
				$msg= array(
					'titlemsg'=>"添加分类成功", //窗口提示的文字
					'urlmsg'=>site_url('contentreplys/articleflreply'),  //返回的路径
					'typemsg'=>'succeed'	//succeed成功提示error错误提示
				);
				$this->load->view('log',$msg);
			}
		}
		else
		{
			$data['title'] = 'SAM微信框架';
			$data['bigmenu'] = $this->uri->segment(1);
			if(strpos($this->uri->segment(2),"articleflreply")!==FALSE)
			{
				$data['smallmenu'] ="articleflreply";
			}
			$data['cate_select'] = $this->contentreplys_model->cate_select();
			$this->load->view('contentreplys/addarticleflreply',$data);			
		}
	}


	/*
	*功能：修改文章分类
	*author King
	*参数：无
	*/
	public function editarticleflreply()
	{
		$this->form_validation->set_rules('data[catename]','catename','required');
		$this->form_validation->set_rules('data[orders]','orders','required');
		if($this->form_validation->run()==TRUE)
		{
			$id = $this->uri->segment(3);
			$data = $this->input->post('data');
			//获取parentid
			if($parent = $this->input->post('cateid'))
			{
				$data['parentid'] = (int)$parent;
				$data['depth'] = 1;
			}
			else
			{
				$data['parentid']  = 0;
			}
			$result =$this->contentreplys_model->editarticleflreply($data,$id);
			if($result)
			{
				//提示窗口设置
				$msg= array(
					'titlemsg'=>"修改分类成功", //窗口提示的文字
					'urlmsg'=>site_url('contentreplys/articleflreply'),  //返回的路径
					'typemsg'=>'succeed'	//succeed成功提示error错误提示
				);
				$this->load->view('log',$msg);
			}

		}
		else
		{
			$id = $this->uri->segment(3);
			//获取数据
			$data  = $this->contentreplys_model->editarticleflreply($data,$id);
			//标题选择状态
			$data['title'] = 'SAM微信框架';
			$data['bigmenu'] = $this->uri->segment(1);
			if(strpos($this->uri->segment(2),"articleflreply")!==FALSE)
			{
				$data['smallmenu'] ="articleflreply";
			}
			//获取分类
			$data['cate_select']  = $this->contentreplys_model->edit_cate_select($data['cateid'],$data['parentid']);
			$this->load->view('contentreplys/editarticleflreply',$data);
		}	
	}


	/*
	*功能：删除文章分类
	*author King
	*参数：tid删除的ID
	*/
	public function delarticleflreply()
	{
		if($data = $this->input->post('tid'))
		{
			foreach ($data as $key => $val) {
				$result  = $this->contentreplys_model->delarticleflreply($val);
			}
			if($result)
			{
					//提示窗口设置
					$msg= array(
						'titlemsg'=>"删除文章分类成功", //窗口提示的文字
						'urlmsg'=>site_url('contentreplys/articleflreply'),  //返回的路径
						'typemsg'=>'succeed'	//succeed成功提示error错误提示
					);
					$this->load->view('log',$msg);
			}
		}
		else
		{
			$id = $this->uri->segment(3);
			$result  = $this->contentreplys_model->delarticleflreply($id);
			if($result)
			{
					//提示窗口设置
					$msg= array(
						'titlemsg'=>"删除文章分类成功", //窗口提示的文字
						'urlmsg'=>site_url('contentreplys/articleflreply'),  //返回的路径
						'typemsg'=>'succeed'	//succeed成功提示error错误提示
					);
					$this->load->view('log',$msg);
			}
		}
	}

	/*
	*功能：文章管理
	*author King
	*参数：无
	*/
	public function articlereply()
	{
		$data['title'] = 'SAM微信框架';
		$data['bigmenu'] = $this->uri->segment(1);
		if(strpos($this->uri->segment(2),"articlereply")!==FALSE)
		{
			$data['smallmenu'] ="articlereply";
		}
		$data['total'] = $this->contentreplys_model->count_total('article');
		$offset = (int)$this->uri->segment(3);
		$this->load->library('pagination');
		$config['base_url'] =site_url('contentreplys/articlereply');
		$config['total_rows'] = $data['total'];
		$config['per_page'] = 15;
		$config['first_link'] = '首页';
		$config['prev_link'] = '上一页';
		$config['next_link'] = '下一页';
		$config['last_link'] = '尾页';
		$this->pagination->initialize($config);
		$data['links'] = $this->pagination->create_links($config);
		//调用分页
		$data['all_cate_select'] =$this->contentreplys_model->all_cate_select();
		//调用分类数据
		$searchkey = $this->input->post('searchkey');
		$cateid = $this->input->post('cateid');

		$data['result'] = $this->contentreplys_model->articlereply($config['per_page'],$offset,$searchkey,$cateid);

		$this->load->view('contentreplys/articlereply',$data);
	}

	/*
	*功能：添加文章管理
	*author King
	*参数：无
	*/
	public function addarticlereply()
	{
		$this->form_validation->set_rules('data[keyword]','keyword','required');
		$this->form_validation->set_rules('data[title]','title','required');
		$this->form_validation->set_rules('data[uploadfiles]','uploadfiles','required');
		if($this->form_validation->run()==TRUE)
		{
			$data = $this->input->post('data');
			$cateid = $this->input->post('cateid');
			//多图文
			if($data['manyarticle'])
			{
				$data['manyarticle'] = json_encode($data['manyarticle']);
			}
			if($cateid)
			{
				$data['cateid'] = $cateid;
			}
			$result = $this->contentreplys_model->addarticlereply($data);
			if($result)
			{
								//提示窗口设置
				$msg= array(
					'titlemsg'=>"添加文章成功", //窗口提示的文字
					'urlmsg'=>site_url('contentreplys/articlereply'),  //返回的路径
					'typemsg'=>'succeed'	//succeed成功提示error错误提示
				);
				$this->load->view('log',$msg);
			}
		}
		else
		{
			$data['title'] = 'SAM微信框架';
			$data['bigmenu'] = $this->uri->segment(1);
			if(strpos($this->uri->segment(2),"articlereply")!==FALSE)
			{
				$data['smallmenu'] ="articlereply";
			}

			//所有分类
			$data['all_cate_select'] =$this->contentreplys_model->all_cate_select();

			//所有文章
			$data['total'] = $this->contentreplys_model->count_total('article');
			$offset = (int)$this->uri->segment(3);
			$this->load->library('pagination');
			$config['base_url'] =site_url('contentreplys/addarticlereply');
			$config['total_rows'] = $data['total'];
			$config['per_page'] = 15;
			$config['first_link'] = '首页';
			$config['prev_link'] = '上一页';
			$config['next_link'] = '下一页';
			$config['last_link'] = '尾页';

			$this->pagination->initialize($config);
			$data['links'] = $this->pagination->create_links($config);

			$data['all_article'] = $this->contentreplys_model->all_article($config['per_page'],$offset);
			$this->load->view('contentreplys/addarticlereply',$data);
		}
	}

	/*
	*功能：修改文章管理
	*author King
	*参数：无
	*/
	public function editarticlereply()
	{
		$this->form_validation->set_rules('data[keyword]','keyword','required');
		$this->form_validation->set_rules('data[title]','title','required');
		$this->form_validation->set_rules('data[uploadfiles]','uploadfiles','required');
		if($this->form_validation->run()==TRUE)
		{
			$id= $this->uri->segment(3);
			$data = $this->input->post('data');
			//多图文
			if($data['manyarticle'])
			{
				$data['manyarticle'] = json_encode($data['manyarticle']);
			}else
			{
				$data['manyarticle'] = '';
			}
			$cateid = $this->input->post('cateid');
			if($cateid)
			{
				$data['cateid'] = $cateid;
			}
			$result = $this->contentreplys_model->editarticlereply($data,$id);
			if($result)
			{
				//提示窗口设置
				$msg= array(
					'titlemsg'=>"修改文章成功", //窗口提示的文字
					'urlmsg'=>site_url('contentreplys/articlereply'),  //返回的路径
					'typemsg'=>'succeed'	//succeed成功提示error错误提示
				);
				$this->load->view('log',$msg);
			}
		}
		else
		{
			$id= $this->uri->segment(3);
			$data = $this->contentreplys_model->editarticlereply($data,$id);
			$data['bigmenu'] = $this->uri->segment(1);
			if(strpos($this->uri->segment(2),"articlereply")!==FALSE)
			{
				$data['smallmenu'] ="articlereply";
			}
			//所有文章，提供多图文选择
			$data['total'] = $this->contentreplys_model->count_total('article');
			$this->load->library('pagination');
			$config['base_url'] =site_url('contentreplys/editarticlereply');
			$config['total_rows'] = $data['total'];
			$config['per_page'] = 15;
			$config['first_link'] = '首页';
			$config['prev_link'] = '上一页';
			$config['next_link'] = '下一页';
			$config['last_link'] = '尾页';

			$this->pagination->initialize($config);
			$data['links'] = $this->pagination->create_links($config);

			$data['all_article'] = $this->contentreplys_model->all_article($config['per_page'],$offset);

			$data['all_cate_select'] =$this->contentreplys_model->all_cate_select($data['cateid']);

			//查找所有被选择过的多图文
			$data['manyarticle'] = json_decode($data['manyarticle']);
			if($data['manyarticle'])
			{
				foreach ($data['manyarticle'] as $key => $value) {
					$data['editmanyarticle'][$key] = $this->contentreplys_model->editarticlereply('',$value);
				}
			}

			$this->load->view('contentreplys/editarticlereply',$data);
		}
	}

	/*
	*功能：删除文章管理
	*author King
	*参数：tid删除文章ID
	*/
	public function delarticlereply()
	{
		if($data = $this->input->post('tid'))
		{
			foreach ($data as $key => $value) {
				$result = $this->contentreplys_model->delarticlereply($value);				
			}
			if($result)
			{
					//提示窗口设置
					$msg= array(
						'titlemsg'=>"删除文章成功", //窗口提示的文字
						'urlmsg'=>site_url('contentreplys/articlereply'),  //返回的路径
						'typemsg'=>'succeed'	//succeed成功提示error错误提示
					);
					$this->load->view('log',$msg);
			}
		}
		else
		{
			$id= $this->uri->segment(3);
			$result = $this->contentreplys_model->delarticlereply($id);
			if($result)
			{
					//提示窗口设置
					$msg= array(
						'titlemsg'=>"删除文章成功", //窗口提示的文字
						'urlmsg'=>site_url('contentreplys/articlereply'),  //返回的路径
						'typemsg'=>'succeed'	//succeed成功提示error错误提示
					);
					$this->load->view('log',$msg);
			}
		}
	}

}
