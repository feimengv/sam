/*
Navicat MySQL Data Transfer

Source Server         : 都市人
Source Server Version : 50542
Source Host           : 115.28.81.248:3306
Source Database       : sam

Target Server Type    : MYSQL
Target Server Version : 50542
File Encoding         : 65001

Date: 2015-11-24 17:36:48
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `weixin_article`
-- ----------------------------
DROP TABLE IF EXISTS `weixin_article`;
CREATE TABLE `weixin_article` (
  `articleid` int(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '文章ID',
  `cateid` mediumint(8) unsigned DEFAULT '0' COMMENT '分类ID',
  `author` varchar(100) DEFAULT NULL COMMENT '作者',
  `Oldweixinhao` varchar(100) DEFAULT NULL COMMENT '公众号id',
  `keyword` varchar(50) DEFAULT NULL COMMENT '关键词',
  `keymatch` smallint(2) unsigned DEFAULT '0' COMMENT '是否匹配',
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `introduction` varchar(100) DEFAULT NULL COMMENT '简介',
  `content` text COMMENT '内容',
  `manyarticle` varchar(1000) DEFAULT NULL COMMENT '多图文',
  `thumbfiles` varchar(255) DEFAULT NULL COMMENT '缩略图',
  `uploadfiles` varchar(255) DEFAULT NULL COMMENT '上传图片',
  `articlelist` varchar(100) DEFAULT NULL COMMENT '多图文列表',
  `viewtimes` int(10) unsigned DEFAULT '0' COMMENT '浏览数',
  `accesstype` smallint(2) unsigned DEFAULT '0' COMMENT '访问类型',
  `articleaddress` varchar(255) DEFAULT NULL COMMENT '站外地址',
  `flag` smallint(2) unsigned DEFAULT '1' COMMENT '审核0未审核1审核通过',
  `elite` smallint(2) unsigned DEFAULT '0' COMMENT '推荐0不推荐1推荐',
  `orders` int(10) unsigned DEFAULT '0' COMMENT '排序',
  `addtime` int(10) unsigned DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`articleid`),
  KEY `articleid` (`articleid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of weixin_article
-- ----------------------------

-- ----------------------------
-- Table structure for `weixin_articlecate`
-- ----------------------------
DROP TABLE IF EXISTS `weixin_articlecate`;
CREATE TABLE `weixin_articlecate` (
  `cateid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '分类ID',
  `author` varchar(100) DEFAULT NULL COMMENT '作者',
  `Oldweixinhao` varchar(100) DEFAULT NULL COMMENT '公众号',
  `catename` varchar(255) DEFAULT NULL COMMENT '分类名称',
  `addressweb` varchar(255) DEFAULT NULL COMMENT '外链地址',
  `uploadfiles` varchar(200) DEFAULT NULL COMMENT '上传图片',
  `parentid` mediumint(8) unsigned DEFAULT '0' COMMENT '父类ID',
  `depth` mediumint(8) unsigned DEFAULT '0' COMMENT '层级',
  `orders` mediumint(8) unsigned DEFAULT '0' COMMENT '排序',
  `flag` smallint(2) unsigned DEFAULT '1' COMMENT '审核0未审核1审核通过',
  `elite` smallint(2) unsigned DEFAULT '0' COMMENT '推荐0未推荐1推荐',
  `addtime` int(10) unsigned DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`cateid`),
  KEY `cateid` (`cateid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of weixin_articlecate
-- ----------------------------

-- ----------------------------
-- Table structure for `weixin_attentionreply`
-- ----------------------------
DROP TABLE IF EXISTS `weixin_attentionreply`;
CREATE TABLE `weixin_attentionreply` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `author` varchar(50) DEFAULT NULL COMMENT '作者',
  `Oldweixinhao` varchar(100) DEFAULT NULL COMMENT '原始公众号',
  `title` varchar(500) DEFAULT NULL COMMENT '标题',
  `message` text COMMENT '消息内容',
  `choose` smallint(2) unsigned DEFAULT '0' COMMENT '关注回复类型0文本1图文',
  `addtime` int(11) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `id` (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of weixin_attentionreply
-- ----------------------------
INSERT INTO `weixin_attentionreply` VALUES ('1', 'admin', 'gh_f703d1027e0c', '关注自动回复', '', '0', '1444990807');

-- ----------------------------
-- Table structure for `weixin_custommenu`
-- ----------------------------
DROP TABLE IF EXISTS `weixin_custommenu`;
CREATE TABLE `weixin_custommenu` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `author` varchar(50) DEFAULT NULL COMMENT '作者',
  `Oldweixinhao` varchar(100) DEFAULT NULL COMMENT '原始公众号',
  `menus` text COMMENT '自定义菜单',
  `addtime` int(11) unsigned DEFAULT '0' COMMENT '添加时间',
  `flag` smallint(2) unsigned DEFAULT '1' COMMENT '审核0审核未通过1审核通过',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=118 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of weixin_custommenu
-- ----------------------------
INSERT INTO `weixin_custommenu` VALUES ('117', 'admin', 'gh_f703d1027e0c', '[{\"orders\":\"0\",\"catename\":\"\\u5ba2\\u670d\\u7cfb\\u7edf\",\"metatitle\":\"\\u6d4b\\u8bd5\"}]', '1446199601', '1');

-- ----------------------------
-- Table structure for `weixin_location`
-- ----------------------------
DROP TABLE IF EXISTS `weixin_location`;
CREATE TABLE `weixin_location` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fromUsername` varchar(100) DEFAULT NULL COMMENT 'openid',
  `toUsername` varchar(100) DEFAULT NULL COMMENT '原始公众号',
  `Latitude` varchar(100) DEFAULT NULL COMMENT '纬度',
  `Longitude` varchar(100) DEFAULT NULL COMMENT '经度',
  `Precision` varchar(100) DEFAULT NULL COMMENT '位置',
  `flag` smallint(2) unsigned DEFAULT '1' COMMENT ' 审核0未审核1审核通过',
  `addtime` int(11) unsigned DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of weixin_location
-- ----------------------------

-- ----------------------------
-- Table structure for `weixin_member`
-- ----------------------------
DROP TABLE IF EXISTS `weixin_member`;
CREATE TABLE `weixin_member` (
  `userid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL COMMENT '用户名',
  `password` varchar(100) NOT NULL COMMENT '密码',
  `weixinnums` int(10) unsigned DEFAULT '1' COMMENT '微信数量',
  `nickname` varchar(255) DEFAULT NULL COMMENT '昵称',
  `email` varchar(250) NOT NULL COMMENT '邮箱',
  `tel` int(11) unsigned DEFAULT '0' COMMENT '电话',
  `addtime` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`userid`),
  KEY `username` (`username`) USING BTREE,
  KEY `addtime` (`addtime`)
) ENGINE=MyISAM AUTO_INCREMENT=186 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of weixin_member
-- ----------------------------
INSERT INTO `weixin_member` VALUES ('185', 'admin', '0192023a7bbd73250516f069df18b500', '1', null, '234234@qq.com', '0', '0');

-- ----------------------------
-- Table structure for `weixin_nodefinereply`
-- ----------------------------
DROP TABLE IF EXISTS `weixin_nodefinereply`;
CREATE TABLE `weixin_nodefinereply` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `author` varchar(50) DEFAULT NULL COMMENT '作者',
  `Oldweixinhao` varchar(100) DEFAULT NULL COMMENT '原始公众号',
  `title` longtext COMMENT '标题',
  `message` longtext COMMENT '消息内容',
  `choose` smallint(2) unsigned DEFAULT '0' COMMENT '选择回复类型',
  `addtime` int(11) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `ID` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of weixin_nodefinereply
-- ----------------------------
INSERT INTO `weixin_nodefinereply` VALUES ('1', 'admin', 'gh_f703d1027e0c', '未关注自动回复', '你好，现在暂时不在，稍后回来！', '0', '1444990812');

-- ----------------------------
-- Table structure for `weixin_publicname`
-- ----------------------------
DROP TABLE IF EXISTS `weixin_publicname`;
CREATE TABLE `weixin_publicname` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `author` varchar(50) DEFAULT NULL COMMENT '作者',
  `Public` varchar(50) DEFAULT NULL COMMENT '公众号名称',
  `Weixinhao` varchar(50) DEFAULT NULL COMMENT '微信号',
  `Oldweixinhao` varchar(50) DEFAULT NULL COMMENT '原始公众号',
  `AppId` varchar(200) DEFAULT NULL COMMENT 'AppId',
  `AppSecret` varchar(200) DEFAULT NULL COMMENT 'AppSecret',
  `Current` smallint(2) unsigned DEFAULT '1' COMMENT '当前使用的微信号',
  `Imgaddress` varchar(200) DEFAULT NULL COMMENT '头像地址',
  `description` varchar(255) DEFAULT NULL COMMENT '公众号描述',
  `addtime` int(11) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `ID` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=87 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of weixin_publicname
-- ----------------------------
INSERT INTO `weixin_publicname` VALUES ('86', 'admin', 'sam微信框架', 'sam微信框架', 'gh_f703d1027e0c', 'wxff816b926ba8ddb5', 'aa7af40383c7f0a65bcd9f1373f79367', '1', '', '', '1423033157');

-- ----------------------------
-- Table structure for `weixin_textreply`
-- ----------------------------
DROP TABLE IF EXISTS `weixin_textreply`;
CREATE TABLE `weixin_textreply` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `author` varchar(50) DEFAULT NULL COMMENT '作者',
  `Oldweixinhao` varchar(100) DEFAULT NULL COMMENT '原始公众号',
  `keywords` varchar(50) DEFAULT NULL COMMENT '关键词',
  `content` longtext COMMENT '内容',
  `keymatch` smallint(2) unsigned DEFAULT '0' COMMENT '匹配方式0完全匹配1包含匹配',
  `flag` smallint(2) unsigned DEFAULT '1' COMMENT '审核0未审核1已审核',
  `addtime` int(11) unsigned DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of weixin_textreply
-- ----------------------------
INSERT INTO `weixin_textreply` VALUES ('1', 'admin', 'gh_f703d1027e0c', '测试', '测试内容', '0', '1', '1446198764');

-- ----------------------------
-- Table structure for `weixin_titlepagereply`
-- ----------------------------
DROP TABLE IF EXISTS `weixin_titlepagereply`;
CREATE TABLE `weixin_titlepagereply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户ID',
  `oldweixinhao` varchar(50) NOT NULL COMMENT '原始公众号',
  `keyword` varchar(80) NOT NULL COMMENT '关键词',
  `title` varchar(255) NOT NULL COMMENT '标题',
  `introduction` varchar(100) NOT NULL COMMENT '介绍',
  `pic_link` varchar(255) NOT NULL COMMENT '图片链接',
  `web_pic_url` varchar(255) NOT NULL COMMENT '本地图片链接',
  `local_pic_path` varchar(255) NOT NULL COMMENT '图片链接',
  `source_url` varchar(255) NOT NULL COMMENT '原文地址',
  `article_list` text NOT NULL COMMENT '文章列表（json格式）',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=68 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of weixin_titlepagereply
-- ----------------------------

-- ----------------------------
-- Table structure for `weixin_user`
-- ----------------------------
DROP TABLE IF EXISTS `weixin_user`;
CREATE TABLE `weixin_user` (
  `userid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Oldweixinhao` varchar(100) DEFAULT NULL,
  `username` varchar(100) CHARACTER SET utf8mb4 NOT NULL COMMENT '用户名',
  `password` varchar(100) NOT NULL,
  `openid` varchar(100) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `integration` int(10) DEFAULT '0' COMMENT '用户积分',
  `vip` smallint(2) unsigned DEFAULT '0' COMMENT '默认0非会员1会员',
  `headimgurl` varchar(500) DEFAULT NULL,
  `truename` varchar(100) DEFAULT NULL,
  `tel` varchar(100) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `addtime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`userid`),
  KEY `username` (`username`) USING BTREE,
  KEY `userid` (`userid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of weixin_user
-- ----------------------------
INSERT INTO `weixin_user` VALUES ('4', 'gh_f703d1027e0c', '棒棒糖', 'ac25be2e9357a9106287a6b90913f1ae', 'ofby1uPgnL5GDSUH-hr1J7tlpN2s', '海淀', '0', '0', 'http://wx.qlogo.cn/mmopen/IQ9en51Yewqg8qIbH5YRl7hwuictcq07ibjtN99RBZwgKLNTMoFxCYG1lKVORMrAx2wxfKom4oUl43cPhmGn5ChcaiavNE2JMaG/0', null, null, null, '1445581144');
INSERT INTO `weixin_user` VALUES ('5', 'gh_f703d1027e0c', '金子', '643a3ca610cb228c155819ab30940927', 'ofby1uFzRq0YUVPpCN866RemA1pY', '海淀', '0', '0', 'http://wx.qlogo.cn/mmopen/aXUpZVUYfjwHCYnKzDJFAhUXVnibiajLM5ol3fIbJhUIjFYkawF9uQKdVTFtD8iaGqIick0iaeAnmkWOI8jGXZd8nJw/0', null, null, null, '1445581187');
INSERT INTO `weixin_user` VALUES ('6', 'gh_f703d1027e0c', '五粮液感恩酒成都千杯少酒业陈大铕', '6c889687a8b8095a4e26048df205647b', 'ofby1uG8mNKm6DQUPnKczozFJuTc', '成都', '0', '0', 'http://wx.qlogo.cn/mmopen/f8dlShPpkAfw51VrKoAbNRExU2r7oZDicmx6W3zBOy8J89hQZP6kbwx2f81IPuERzEQt2E0BWAvUan4Q4Xs7Zy85fzsdFHnES/0', null, null, null, '1445736636');
INSERT INTO `weixin_user` VALUES ('7', 'gh_f703d1027e0c', '疯狂D大叔@王永国', '8742f16f5055ba24c8461f59153b9c86', 'ofby1uBtkTff6XcZmj5YzZRvNUmQ', '', '0', '0', 'http://wx.qlogo.cn/mmopen/Ykx1ZnicibnSLmIa1kSqaF9H84E3uCGOacOM7KM6ErVap81wSUVaw2ibZrziaTsBgBwVavYB7nMib7jEQuBVsZCw7hUOE7FYHcJhY/0', null, null, null, '1445822721');
INSERT INTO `weixin_user` VALUES ('8', 'gh_f703d1027e0c', 'mppresstest_00006', '9602f5c01f872f323733eff3355d8b0e', 'ofby1uDX6mcCEw-PFvWd8nFtZi-8', '', '0', '0', '', null, null, null, '1445826618');
