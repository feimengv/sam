<?php
if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );

/* 微信接口文档
/* +----------------------------------------------------------------------+
/* | PHP version sam 1.0.0                                                 
/* +----------------------------------------------------------------------+
/* | Copyright (c) 2013-2015  SAM                           
/* +----------------------------------------------------------------------+
/* | Authors: King                                  
/* +----------------------------------------------------------------------+
/*  目前不执行微信加密接口,请使用明文模式
/* +----------------------------------------------------------------------+
*/

define ( "TOKEN", "weixin" );
$wechatObj = new Weixin ();
$wechatObj->valid ();

class Weixin extends CI_Controller {
	public function __construct() {
		parent::__construct ();

		//载入weixin_model模型
		$this->load->model ('weixin_model');
		
		//当前的域名
		$this->domain = "http://" . $_SERVER ['SERVER_NAME'] . "/" . "index.php/";
	}

	// 微信参数验证
	public function valid() {
		$echoStr = htmlspecialchars ( $_GET ["echostr"] );

		if ($this->checkSignature ()) {
			echo $echoStr;
			$this->responseMsg ();
			exit ();
		}else{
			echo 'please wechat open';exit;
		}
	}
	
	public function responseMsg() {
		//get post data, May be due to the different environments
		$postStr = $GLOBALS ["HTTP_RAW_POST_DATA"];

		//解析post数据
		if (! empty ( $postStr )) {
			
			$postObj = simplexml_load_string ( $postStr, 'SimpleXMLElement', LIBXML_NOCDATA );
			
			$fromUsername = $postObj->FromUserName;
			$toUsername = $postObj->ToUserName;
			$keyword = trim ( $postObj->Content );
			$MsgType = $postObj->MsgType;
			$time = time ();
			$textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";
			
			if ($MsgType == "event") {
				//获取事件类型
				$form_Event = $postObj->Event;
				//获取自定义菜单点击事件
				if ($form_Event == "CLICK") {
					//获取菜单key值
					$keyword = trim ( $postObj->EventKey );
					$MsgType = "text";
				}
			}
			//关注公众号方式返回数据
			if ($postObj->Event == "subscribe") {
				
				$result = $this->weixin_model->subscribe ( $toUsername );

				// 判断是否关注后发送图文首页
				if ($result ['choose'] == 1) {
					// 发送图文首页
					$this->postPicMsg ( $fromUsername, $toUsername );
				} else {
					// 发送文字
					$msgType = "text";
					// 查找关注提示数据
					$contentStr = $result ['message'];

					$resultStr = sprintf ( $textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr );
					echo $resultStr;
				}
				
				exit ();
				//获取地理位置
			} elseif ($postObj->Event == "LOCATION") {
				$post_array = ( array ) $postObj;
				//用户关注获取扫描二维码信息
				$fromUsername = $post_array ['FromUserName'];
				$toUsername = $post_array ['ToUserName'];
				$Latitude = $post_array ['Latitude'];
				$Longitude = $post_array ['Longitude'];
				$Precision = $post_array ['Precision'];
				$this->weixin_model->location ( $fromUsername, $toUsername, $Latitude, $Longitude, $Precision );
			} elseif (! empty ( $keyword )) {
				//多客户系统回复，触发在线客服以后客服关闭会话以前，所以消息都会别直接转发客服系统
				if (strstr ( $keyword, "您好" ) || strstr ( $keyword, "你好" ) || strstr ( $keyword, "在吗" ) || strstr ( $keyword, "有人吗" ) || strstr ( $keyword, "客服" )) {
					$resultStr = $this->transmitService ( $fromUsername, $toUsername );
					echo $resultStr;
					exit ();
				}
				
				 /**
			     * 文本回复
			     * @param string     $keyword 		关键词
			     * @param  string 	 $toUsername    原始公众号
			     * @author  King
			     */
				$result = $this->weixin_model->textreply( $keyword, $toUsername );
				if ($result ['content']){
					$msgType = "text";
					$contentStr = $result ['content'];
					$resultStr = sprintf ( $textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr );
					echo $resultStr;
					exit ();
				}
				

				/**
			     * 图文回复
			     * @param string     $keyword 		关键词
			     * @param  string 	 $toUsername    原始公众号
			     * @author  King
			     */
				$result = $this->weixin_model->articlereply ( $keyword, $toUsername );
				
				if ($result ['title']) {
					$textTplTop = "<xml>
                                        <ToUserName><![CDATA[%s]]></ToUserName>
                                        <FromUserName><![CDATA[%s]]></FromUserName>
                                        <CreateTime>%s</CreateTime>
                                        <MsgType><![CDATA[%s]]></MsgType>
                                        <ArticleCount>%s</ArticleCount>
                                        <Articles>";
					$textTplMiddle = "<item>
                                <Title><![CDATA[%s]]></Title> 
                                <Description><![CDATA[%s]]></Description>
                                <PicUrl><![CDATA[%s]]></PicUrl>
                                <Url><![CDATA[%s]]></Url>
                                </item>";
					$textTplBottom = "</Articles>
                                            </xml>";
					$msgType = "news";
					$Title = $result ['title'];
					$Description = $result ['introduction'];
					if (strstr ( $result ['uploadfiles'], "http" )) {
						$PicUrl = $result ['uploadfiles'];
					} else {
						$PicUrl = base_url ( $result ['uploadfiles'] );
					}
					if ($result ['accesstype'] == 1) {
						if (strstr ( $Url, '?' )) {
							$Url = $result ['articleaddress'] . "&fromUsername=" . $fromUsername;
						} else {
							$Url = $result ['articleaddress'] . "?fromUsername=" . $fromUsername;
						}
					} else {
						$Url = url_add_Oldweixinhao ( site_url ( 'micrositeshow/article/' . $result ['articleid'] ), $toUsername );
						if (strstr ( $Url, '?' )) {
							$Url = $Url . "&fromUsername=" . $fromUsername;
						} else {
							$Url = $Url . "?fromUsername=" . $fromUsername;
						}
					}
					//查找总共几篇文章
					if ($result ['manyarticle']) {
						$total = $this->weixin_model->totalmanyarticle ( $result ['manyarticle'] );
					} else {
						$total = 1;
					}
					$resultStr = sprintf ( $textTplTop, $fromUsername, $toUsername, $time, $msgType, $total );
					$resultStr .= sprintf ( $textTplMiddle, $Title, $Description, $PicUrl, $Url );
					if ($result ['manyarticle']) {
						$result ['editmanyarticle'] = $this->weixin_model->manyarticle ( $result ['manyarticle'] );
						foreach ( $result ['editmanyarticle'] as $key => $value ) {
							//网络图片和本地图片判断
							if (strstr ( $value ['uploadfiles'], "http" )) {
								$PicUrl = $value ['uploadfiles'];
							} else {
								$PicUrl = "http://" . $this->input->server ( 'SERVER_NAME' ) . $value ['uploadfiles'];
							}
							if ($value ['accesstype'] == 1) {
								if (strstr ($value ['articleaddress'], '?' )) {
									$Url = $value ['articleaddress'] . "&fromUsername=" . $fromUsername;
								} else {
									$Url = $value ['articleaddress'] . "?fromUsername=" . $fromUsername;
								}
							} else {
								$Url = url_add_Oldweixinhao ( site_url ( 'micrositeshow/article/' . $value ['articleid'] ), $toUsername );
								if (strstr ( $Url, '?' )) {
									$Url = $Url . "&fromUsername=" . $fromUsername;
								} else {
									$Url = $Url . "?fromUsername=" . $fromUsername;
								}
							}
							$resultStr .= sprintf ( $textTplMiddle, $value ['title'], $value ['introduction'], $PicUrl, $Url );
						}
					}
					$resultStr .= sprintf ( $textTplBottom );
					echo $resultStr;
					exit ();
				}

				/**
			     * 未定义自动回复
			     * @param string     $keyword 		关键词
			     * @param  string 	 $toUsername    原始公众号
			     * @author  King
			     */
				$result = $this->weixin_model->nodefinereply ( $toUsername );
				if ($result ['message']) {
					$msgType = "text";
					$contentStr = $result ['message'];
					$resultStr = sprintf ( $textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr );
					echo $resultStr;
					exit ();
				}
			} elseif ($postObj->MsgType == 'location') {
				$this->postStations ( $fromUsername, $toUsername, $postObj );
			} else {
				echo "Input something...";
			}
		
		} else {
			echo "";
			exit ();
		}
	}
	
	/**
     * 回复图文首页
     * @param string     $fromUsername 	openid
     * @param  string 	 $toUsername    原始公众号
     * @author  King
     */
	public function postPicMsg($fromUsername, $toUsername) {
		$msgType = 'news';
		
		$picTextHeader = "<xml>
                        <ToUserName><![CDATA[%s]]></ToUserName>
                        <FromUserName><![CDATA[%s]]></FromUserName>
                        <CreateTime>%s</CreateTime>
                        <MsgType><![CDATA[%s]]></MsgType>
                        <ArticleCount>%s</ArticleCount>
                        <Articles>";
		$picTextItem = "<item>
                <Title><![CDATA[%s]]></Title> 
                <Description><![CDATA[%s]]></Description>
                <PicUrl><![CDATA[%s]]></PicUrl>
                <Url><![CDATA[%s]]></Url>
                </item>";
		$picTextFooter = "</Articles>
                            </xml>";
		
		$titlepagereply = $this->weixin_model->get_detail_by_oldweixinhao ( $toUsername );
		if (! $titlepagereply ['local_pic_path'] && ! $titlepagereply ['web_pic_url']) {
			$titlepagereply ['pic_url'] = "";
		} else {
			$titlepagereply ['pic_url'] = $titlepagereply ['local_pic_path'] ? base_url ( $titlepagereply ['local_pic_path'] ) : $titlepagereply ['web_pic_url'];
		}
		$titlepagereply ['pic_link'] = url_add_Oldweixinhao ( $this->domain . 'micrositeshow/', $toUsername );
		if (strstr ( $titlepagereply ['pic_link'], '?' )) {
			$titlepagereply ['pic_link'] = $titlepagereply ['pic_link'] . "&fromUsername=" . $fromUsername;
		} else {
			$titlepagereply ['pic_link'] = $titlepagereply ['pic_link'] . "?fromUsername=" . $fromUsername;
		}
		$titlepagereply ['article_list'] = json_decode ( $titlepagereply ['article_list'], TRUE );
		$resultStr = sprintf ( $picTextHeader, $fromUsername, $toUsername, time (), $msgType, count ( $titlepagereply ['article_list'] ) + 1 );
		
		$resultStr .= sprintf ( $picTextItem, $titlepagereply ['title'], $titlepagereply ['introduction'], $titlepagereply ['pic_url'], $titlepagereply ['pic_link'] );
		
		foreach ( $titlepagereply ['article_list'] as $key => $val ) {
			if ($val ['pics']) {
				if (strstr ( $val ['pics'], 'http://' )) {
					$val ['pics'] = $val ['pics'];
				} else {
					$val ['pics'] = base_url ( $val ['pics'] );
				}
			}
			$val ['links'] = url_add_Oldweixinhao ( $val ['links'], $toUsername );
			if (strstr ( $val ['links'], '?' )) {
				$val ['links'] = $val ['links'] . "&fromUsername=" . $fromUsername;
			} else {
				$val ['links'] = $val ['links'] . "?fromUsername=" . $fromUsername;
			}
			$resultStr .= sprintf ( $picTextItem, $val ['title'], '', $val ['pics'], $val ['links'] );
		}
		
		$resultStr .= $picTextFooter;
		
		echo $resultStr;
		exit ();
	}
	

	 /**
     * 客服系统转换
     * @param string     $FromUserName 	openid
     * @param  string 	 $toUsername    原始公众号
     * @author  King
     */
	private function transmitService($FromUserName, $ToUserName) {
		$xmlTpl = "<xml>
            <ToUserName><![CDATA[%s]]></ToUserName>
            <FromUserName><![CDATA[%s]]></FromUserName>
            <CreateTime>%s</CreateTime>
            <MsgType><![CDATA[transfer_customer_service]]></MsgType>
            </xml>";
		$result = sprintf ( $xmlTpl, $FromUserName, $ToUserName, time () );
		return $result;
	}

	/**
     * 文本消息转换
     * @param string     $msg 		消息内容
     * @param string     $fromUsername 	openid
     * @param  string 	 $toUsername    原始公众号
     * @author  King
     */
	private function textreply_msg($msg = "", $fromUsername, $toUsername) {
		$textTpl = "<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[%s]]></MsgType>
                    <Content><![CDATA[%s]]></Content>
                    <FuncFlag>0</FuncFlag>
                    </xml>";
		// 发送文字
		$msgType = "text";
		// 查找关注提示数据
		$contentStr = $msg;
		$resultStr = sprintf ( $textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr );
		echo $resultStr;
	}
	
	/**
     * 微信验证
     * @author  King
     */
	private function checkSignature() {
		$signature = $_GET ["signature"];
		$timestamp = $_GET ["timestamp"];
		$nonce = $_GET ["nonce"];
		
		$token = TOKEN;
		$tmpArr = array ($token, $timestamp, $nonce );
		sort ( $tmpArr, SORT_STRING );
		$tmpStr = implode ( $tmpArr );
		$tmpStr = sha1 ( $tmpStr );
		
		if ($tmpStr == $signature) {
			return true;
		} else {
			return false;
		}
	}
}

?>