<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends H5_Controller{

	public function __construct()
	{
		parent::__construct();

	}
	public function index()
	{
		$this->load->view('mobile/member',$this->data);
	}
	
}
