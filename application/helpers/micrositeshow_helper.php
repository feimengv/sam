<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if ( ! function_exists('m_site_url'))
{
	function m_site_url($uri = '')
	{
		$CI =& get_instance();

		$uri .= '?Oldweixinhao='.$CI->userdata['Oldweixinhao'];
		return $CI->config->site_url($uri);
	}
}