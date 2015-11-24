<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class member_model extends MY_Model {

    function __construct() {
        parent::__construct();

        $this->table = 'user';
    }

    public function find_user($userid)
    {
        $this->db->where('userid',$userid);
        return $this->db->get($this->table)->row_array();
    }


    public function person($userid,$data)
    {
    	if($data)
    	{
    		$this->db->where('userid',$userid);
    		$this->db->update($this->table,$data);
    		return $this->db->affected_rows();
    	}else
    	{
    		$this->db->where('userid',$userid);
    		return $this->db->get($this->table)->row_array();
    	}
    }

    public function weixin($Oldweixinhao)
    {
        $this->db->select('AppId,AppSecret');
        $this->db->where('Oldweixinhao',$Oldweixinhao);
        return $this->db->get('publicname')->row_array();
    }

    public function find($openid)
    {
        $this->db->where('openid',$openid);
        return $this->db->get($this->table)->row_array();
    }

    public function insert_member($data)
    {
        $array = array(
            'username'=>$data['nickname'],
            'password'=>md5($data['openid'].'weixin'),
            'openid'=>$data['openid'],
            'Oldweixinhao'=>$data['Oldweixinhao'],
            'headimgurl'=>$data['headimgurl'],
            'city'=>$data['city'],
            'addtime'=>time(),
        );
        $this->db->insert($this->table,$array);
        return $this->db->insert_id();
    }

    
}
