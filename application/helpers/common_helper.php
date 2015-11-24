<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * URL拼接Oldweixinhao
 */
if ( ! function_exists('url_add_Oldweixinhao'))
{
    function url_add_Oldweixinhao($url = '', $Oldweixinhao = '')
    {
        $CI =& get_instance();
        $Oldweixinhao = $Oldweixinhao ? $Oldweixinhao : $CI->userdata['Oldweixinhao'];
        if (strstr($url, '?')) {
            $url .= '&Oldweixinhao='.$Oldweixinhao;
        } else {
            $url .= '?Oldweixinhao='.$Oldweixinhao;
        }
        return $url;
    }
}


/**
 * 跳回来源页面
 */
if (!function_exists('referrer_jump')) {

    function referrer_jump() {
        $CI = & get_instance();
        $CI->load->library('user_agent');
        $referrer_url = $CI->agent->referrer(); //获取用户来源url
        redirect($referrer_url);
    }

}

/**
 * CURL GET方式获取数据
 */
if (!function_exists('curl_get')) {

    function curl_get($url, $params = array(), $data_type = '') {
        $CI = & get_instance();
        $url = $url . ($params ? '?' . http_build_query($params, NULL, '&') : '');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.1 Safari/537.11');
        $res = curl_exec($ch);
        $rescode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($data_type == 'array') {
            $res = json_decode($res, TRUE);
        }
        return $res;
    }

}

/**
 * CURL POST方式获取数据
 */
if (!function_exists('curl_post')) {

    function curl_post($url, $params = array(), $data_type = '',$jsessionId="", $file_data = array()) {
        $CI = & get_instance();
        if($CI->session->userdata('jsessionId'))
        {
        	$jsessionId = $CI->session->userdata('jsessionId');
        }
        // $url = "http://192.168.3.114:8080/app/user_login.action";
        // $cookie_jar = "D:/eyueche/application"."/cookie/".md5($CI->userdata['phone']).".cookie";
        // $file = fopen("test.txt","w");
        // fwrite($file,$cookie_jar);
        // fclose($file);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Accept: */*',
            'User-Agent: Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)',
            'Cookie: JSESSIONID='.$jsessionId,
            'Connection: Keep-Alive'));
        // if ($file_data){
        //     curl_setopt($ch,CURLOPT_POSTFIELDS,$file_data);
        // }
        // curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.1 Safari/537.11');
        // curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_jar);
        // curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_jar);
        $res = curl_exec($ch);
        $rescode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if ($data_type == 'array') {
            $res = json_decode($res, TRUE);
        }
        return $res;
    }

}

/**
 * 格式化输出内容（用于调试）
 */
if (!function_exists('my_dump')) {

    function my_dump($data) {
        echo "<pre>";
        var_dump($data);
        echo "</pre>";
        exit();
    }

}

/* End of file common_helper.php */
/* Location: ./application/helpers/common_helper.php */