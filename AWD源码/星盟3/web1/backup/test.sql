# Host: localhost  (Version: 5.5.53)
# Date: 2019-08-12 21:36:55
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "jy_action"
#
drop database if exists `jy`;
create database `jy`;
use jy;
DROP TABLE IF EXISTS `jy_action`;
CREATE TABLE `jy_action` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` char(30) NOT NULL DEFAULT '' COMMENT '行为唯一标识',
  `title` char(80) NOT NULL DEFAULT '' COMMENT '行为说明',
  `remark` char(140) NOT NULL DEFAULT '' COMMENT '行为描述',
  `rule` text NOT NULL COMMENT '行为规则',
  `log` text NOT NULL COMMENT '日志规则',
  `type` tinyint(2) unsigned NOT NULL DEFAULT '1' COMMENT '类型',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='系统行为表';

#
# Data for table "jy_action"
#

/*!40000 ALTER TABLE `jy_action` DISABLE KEYS */;
/*!40000 ALTER TABLE `jy_action` ENABLE KEYS */;

#
# Structure for table "jy_action_log"
#

DROP TABLE IF EXISTS `jy_action_log`;
CREATE TABLE `jy_action_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `action_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '行为id',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '执行用户id',
  `action_ip` bigint(20) NOT NULL COMMENT '执行行为者ip',
  `model` varchar(50) NOT NULL DEFAULT '' COMMENT '触发行为的表',
  `record_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '触发行为的数据id',
  `remark` varchar(255) NOT NULL DEFAULT '' COMMENT '日志备注',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '执行行为的时间',
  PRIMARY KEY (`id`),
  KEY `action_ip_ix` (`action_ip`),
  KEY `action_id_ix` (`action_id`),
  KEY `user_id_ix` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED COMMENT='行为日志表';

#
# Data for table "jy_action_log"
#

/*!40000 ALTER TABLE `jy_action_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `jy_action_log` ENABLE KEYS */;

#
# Structure for table "jy_addons"
#

DROP TABLE IF EXISTS `jy_addons`;
CREATE TABLE `jy_addons` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(40) NOT NULL COMMENT '插件名或标识',
  `title` varchar(20) NOT NULL DEFAULT '' COMMENT '中文名',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `config` text COMMENT '配置',
  `author` varchar(40) DEFAULT '' COMMENT '作者',
  `version` varchar(20) DEFAULT '' COMMENT '版本号',
  `description` text COMMENT '插件描述',
  `has_adminlist` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否有后台列表',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '安装时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='插件表';

#
# Data for table "jy_addons"
#

/*!40000 ALTER TABLE `jy_addons` DISABLE KEYS */;
INSERT INTO `jy_addons` VALUES (1,'Upload','上传插件',1,'{\"admin_drive\":\"local\",\"home_drive\":\"local\",\"local_audio_listen_path\":\"/uploads/listen/\",\"local_audio_down_path\":\"/uploads/down/\",\"local_audio_max_size\":\"300\",\"local_image_path\":\"/uploads/images/\",\"local_image_max_size\":\"30\",\"local_avatar_path\":\"/uploads/avatar/\",\"local_avatar_max_size\":\"10\",\"ftp_host\":\"192.168.0.103\",\"ftp_bind_server\":\"0\",\"ftp_user\":\"jymusic\",\"ftp_pwd\":\"jymusic\",\"ftp_port\":\"21\",\"ftp_timeout\":\"90\",\"ftp_passive\":\"1\",\"ftp_audio_listen_path\":\"/listen/\",\"ftp_audio_down_path\":\"/down/\",\"ftp_audio_max_size\":\"300\",\"ftp_image_path\":\"/images/\",\"ftp_image_max_size\":\"30\",\"qiniu_ak\":\"\",\"qiniu_sk\":\"\",\"qiniu_bucket\":\"\",\"qiniu_domain\":\"\",\"qiniu_file_max_size\":\"30\",\"qiniu_listen_dir\":\"listen\",\"qiniu_down_dir\":\"down\",\"qiniu_image_dir\":\"images\",\"qiniu_timeout\":\"3600\",\"alioss_id\":\"\",\"alioss_key\":\"\",\"alioss_host\":\"\",\"alioss_bucket\":\"\",\"alioss_file_max_size\":\"30\",\"alioss_listen_dir\":\"listen\",\"alioss_down_dir\":\"down\",\"alioss_image_dir\":\"images\"}','JYmusic','0.1','JYmusic2.0 上传插件',0,1497150463),(2,'Slider','幻灯片',1,'{\"height\":\"300px\",\"width\":\"100%\",\"Speed\":\"3000\",\"animationTime\":\"3000\",\"animation\":\"slide\",\"slideshow\":\"true\",\"show_model\":\"1\"}','JYmusic','0.3','幻灯片插件',1,1497899121),(3,'Editor','网页在线编辑器',1,'{\"editor_wysiwyg\":\"1\"}','JYmusic','0.1','JYmusic2.0 新增一款超简洁高效的编辑器',0,1497172987),(4,'Links','友情链接',1,'{\"link_type\":\"1\"}','JYmusic','0.3','JYmusic2.0 友情链接插件',1,1501531355),(5,'Comment','评论插件',1,'{\"type\":\"1\",\"local_gap_time\":\"60\",\"local_list_limit\":\"10\",\"local_audit\":\"1\",\"local_list_sort\":\"1\",\"changyan_appid\":\"\",\"changyan_appkey\":\"\",\"changyan_css\":\"\",\"youyan_uid\":\"\",\"youyan_key\":\"\",\"youyan_css\":\"\"}','JYmusic','0.3','本地评论插件和社交化评论插件，支持网站同步登录用户。',1,1501885192),(6,'Pay','支付插件',1,'{\"type\":\"aplipay\",\"pay_ratio\":\"1\",\"alipay_partner\":\"\",\"alipay_key\":\"\",\"alipay_seller_email\":\"\"}','JYmusic','0.2','目前只有支付一个支付类型',0,1502370427);
/*!40000 ALTER TABLE `jy_addons` ENABLE KEYS */;

#
# Structure for table "jy_album"
#

DROP TABLE IF EXISTS `jy_album`;
CREATE TABLE `jy_album` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(80) NOT NULL,
  `type_id` smallint(6) unsigned NOT NULL DEFAULT '0',
  `type_name` char(20) NOT NULL DEFAULT '0',
  `artist_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属歌手id',
  `artist_name` varchar(40) DEFAULT NULL COMMENT '所属歌手名称',
  `add_uid` int(10) NOT NULL DEFAULT '0' COMMENT '创建者的ID',
  `add_uname` varchar(20) DEFAULT NULL COMMENT '创建者名称',
  `cover_id` int(11) NOT NULL DEFAULT '0',
  `cover_url` varchar(255) DEFAULT NULL COMMENT '封面地址',
  `hits` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '点击数',
  `favtimes` int(11) NOT NULL DEFAULT '0' COMMENT '收藏次数',
  `digg` int(11) NOT NULL DEFAULT '0' COMMENT '点赞',
  `pub_time` char(20) NOT NULL DEFAULT '未知' COMMENT '发布时间',
  `company` char(40) DEFAULT NULL COMMENT '唱片公司',
  `position` smallint(6) NOT NULL DEFAULT '0' COMMENT '推荐位',
  `introduce` text COMMENT '专辑简介',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '专辑状态',
  PRIMARY KEY (`id`),
  KEY `hits` (`hits`),
  KEY `favtimes` (`favtimes`),
  KEY `position` (`position`),
  KEY `artist_id` (`artist_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "jy_album"
#

/*!40000 ALTER TABLE `jy_album` DISABLE KEYS */;
/*!40000 ALTER TABLE `jy_album` ENABLE KEYS */;

#
# Structure for table "jy_album_fav"
#

DROP TABLE IF EXISTS `jy_album_fav`;
CREATE TABLE `jy_album_fav` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `album_id` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `music_id` (`album_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "jy_album_fav"
#

/*!40000 ALTER TABLE `jy_album_fav` DISABLE KEYS */;
/*!40000 ALTER TABLE `jy_album_fav` ENABLE KEYS */;

#
# Structure for table "jy_album_type"
#

DROP TABLE IF EXISTS `jy_album_type`;
CREATE TABLE `jy_album_type` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `name` char(20) NOT NULL,
  `alias` char(30) DEFAULT NULL,
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(2) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `alias` (`alias`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

#
# Data for table "jy_album_type"
#

/*!40000 ALTER TABLE `jy_album_type` DISABLE KEYS */;
INSERT INTO `jy_album_type` VALUES (1,'国语专辑','guoyuzhuanji',1469653769,1497386160,1),(2,'欧美专辑','oumeizhuanji',1469653769,1497386156,1),(3,'日韩专辑','rihanzhuanji',1469653769,1497386141,1),(4,'DJ舞曲','djwuqu',1469653769,1500644059,1),(5,'JY精选','jingxuan1',1469653769,1497386131,1);
/*!40000 ALTER TABLE `jy_album_type` ENABLE KEYS */;

#
# Structure for table "jy_article"
#

DROP TABLE IF EXISTS `jy_article`;
CREATE TABLE `jy_article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '文档ID',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `name` char(40) DEFAULT '' COMMENT '标识',
  `title` char(80) NOT NULL DEFAULT '' COMMENT '标题',
  `category_id` int(10) unsigned NOT NULL COMMENT '所属分类',
  `description` char(140) NOT NULL DEFAULT '' COMMENT '描述',
  `root` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属根分类',
  `position` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '推荐位',
  `cover_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '封面',
  `cover_url` varchar(255) DEFAULT NULL,
  `display` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '可见性',
  `deadline` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '截至时间',
  `hits` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '浏览量',
  `comment` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '评论数',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '数据状态',
  PRIMARY KEY (`id`),
  KEY `idx_category_status` (`category_id`,`status`),
  KEY `idx_status_type_pid` (`status`,`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='文档基础表';

#
# Data for table "jy_article"
#

/*!40000 ALTER TABLE `jy_article` DISABLE KEYS */;
/*!40000 ALTER TABLE `jy_article` ENABLE KEYS */;

#
# Structure for table "jy_article_category"
#

DROP TABLE IF EXISTS `jy_article_category`;
CREATE TABLE `jy_article_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '分类ID',
  `title` varchar(80) NOT NULL COMMENT '标题',
  `alias` char(20) NOT NULL COMMENT '标志',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类ID',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序（同级有效）',
  `list_row` tinyint(3) unsigned NOT NULL DEFAULT '10' COMMENT '列表每页行数',
  `type` varchar(100) NOT NULL DEFAULT '' COMMENT '允许发布的内容类型',
  `display` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '可见性',
  `reply` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否允许回复',
  `check` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '发布的文章是否需要审核',
  `icon` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '分类图标',
  `cover_url` int(255) unsigned NOT NULL DEFAULT '0',
  `template_index` varchar(100) DEFAULT NULL COMMENT '频道页模板',
  `template_lists` varchar(100) DEFAULT NULL COMMENT '列表页模板',
  `template_detail` varchar(100) DEFAULT NULL COMMENT '详情页模板',
  `template_edit` varchar(100) DEFAULT NULL COMMENT '编辑页模板',
  `meta_title` varchar(60) NOT NULL DEFAULT '' COMMENT 'SEO的网页标题',
  `keywords` varchar(200) NOT NULL DEFAULT '' COMMENT '关键字',
  `description` varchar(200) NOT NULL DEFAULT '' COMMENT '描述',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '数据状态',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_name` (`alias`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='文章分类表';

#
# Data for table "jy_article_category"
#

/*!40000 ALTER TABLE `jy_article_category` DISABLE KEYS */;
INSERT INTO `jy_article_category` VALUES (1,'娱乐','yule',0,1,10,'2,1,3',1,1,0,0,0,'0','0','0',NULL,'娱乐','娱乐','娱乐',1467152327,1497755429,1),(2,'内地','neidi',1,1,10,'2,1,3',1,1,0,0,0,'0','0','0',NULL,'内地','内地','内地',1467152378,1497750684,1),(3,'港台','gangtai',1,2,10,'2,1,3',1,1,0,0,0,'0','0','0',NULL,'港台','港台','港台',1467152402,1497750676,1),(4,'海外','haiwai',1,3,10,'2,1,3',1,1,0,0,0,'0','0','0',NULL,'','','',1467152422,1497750612,1),(5,'头条','toutiao',0,2,10,'2,1,3',1,1,0,0,0,'0','0','0',NULL,'头条','头条','头条',1467152598,1497749975,1),(6,'八卦','bagua',0,3,10,'2,1,3',1,1,0,0,0,'0','0','0',NULL,'','','',1467152632,1497750645,1),(7,'爆料','baoliao',0,4,10,'2,1,3',1,1,0,0,0,'0','0','0',NULL,'','','',1467152661,1497750644,1);
/*!40000 ALTER TABLE `jy_article_category` ENABLE KEYS */;

#
# Structure for table "jy_article_content"
#

DROP TABLE IF EXISTS `jy_article_content`;
CREATE TABLE `jy_article_content` (
  `article_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文档ID',
  `content` text NOT NULL COMMENT '文章内容',
  `template` varchar(100) NOT NULL DEFAULT '' COMMENT '详情页显示模板',
  PRIMARY KEY (`article_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='文章内容表';

#
# Data for table "jy_article_content"
#

/*!40000 ALTER TABLE `jy_article_content` DISABLE KEYS */;
/*!40000 ALTER TABLE `jy_article_content` ENABLE KEYS */;

#
# Structure for table "jy_artist"
#

DROP TABLE IF EXISTS `jy_artist`;
CREATE TABLE `jy_artist` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned NOT NULL DEFAULT '0',
  `name` char(40) NOT NULL,
  `alias` char(60) DEFAULT NULL,
  `index` char(1) DEFAULT '0',
  `type_name` char(20) DEFAULT NULL,
  `type_id` smallint(6) unsigned NOT NULL DEFAULT '0',
  `cover_id` int(11) NOT NULL DEFAULT '0',
  `cover_url` varchar(255) DEFAULT NULL COMMENT '封面地址',
  `rater` tinyint(2) NOT NULL DEFAULT '0' COMMENT '评分',
  `hits` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '点击数',
  `favtimes` int(11) NOT NULL DEFAULT '0' COMMENT '收藏次数',
  `digg` int(11) NOT NULL DEFAULT '0' COMMENT '点赞',
  `position` smallint(6) NOT NULL DEFAULT '0' COMMENT '推荐位',
  `region` varchar(100) DEFAULT NULL COMMENT '所在地区',
  `recommend` tinyint(2) NOT NULL DEFAULT '0' COMMENT '推荐',
  `introduce` text COMMENT '描述',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建日期',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更显日期',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态',
  PRIMARY KEY (`id`),
  KEY `type_id` (`type_id`),
  KEY `position` (`position`),
  KEY `favtimes` (`favtimes`),
  KEY `hits` (`hits`),
  KEY `index` (`index`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "jy_artist"
#

/*!40000 ALTER TABLE `jy_artist` DISABLE KEYS */;
/*!40000 ALTER TABLE `jy_artist` ENABLE KEYS */;

#
# Structure for table "jy_artist_fav"
#

DROP TABLE IF EXISTS `jy_artist_fav`;
CREATE TABLE `jy_artist_fav` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '应用ID',
  `uid` int(10) NOT NULL COMMENT '用户id',
  `artist_id` int(10) NOT NULL COMMENT '艺人id',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `artist_id` (`artist_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='应用表';

#
# Data for table "jy_artist_fav"
#

/*!40000 ALTER TABLE `jy_artist_fav` DISABLE KEYS */;
/*!40000 ALTER TABLE `jy_artist_fav` ENABLE KEYS */;

#
# Structure for table "jy_artist_type"
#

DROP TABLE IF EXISTS `jy_artist_type`;
CREATE TABLE `jy_artist_type` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `name` char(20) NOT NULL,
  `alias` char(30) DEFAULT NULL,
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `alias` (`alias`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

#
# Data for table "jy_artist_type"
#

/*!40000 ALTER TABLE `jy_artist_type` DISABLE KEYS */;
INSERT INTO `jy_artist_type` VALUES (1,'华语男','huayunan',1442360846,1497385665,1),(2,'华语女','huayunv',1442360846,1497385660,1),(3,'华语组合/乐队','huayuzu',1442360846,1497385655,1),(4,'日本男','ribennan',1442360846,1497385650,1),(5,'日本女','ribennv',1442360846,1497385645,1),(6,'日本组合/乐队','ribenzu',1442360846,1497385640,1),(7,'韩国男','hanguonan',1442360846,1497385635,1),(8,'韩国女','hanguonv',1442360846,1497385630,1),(9,'韩国组合/乐队','hanguozu',1442360846,1497385626,1),(15,'欧美男','oumeinan',1442360846,1497385622,1),(16,'欧美女','oumeinv',1442360846,1497385618,1),(17,'欧美组合/乐队','oumeizu',1442360846,1497385613,1),(18,'其他男歌手','qitanan',1442360846,1497385558,1),(19,'其他女歌手','qitanv',1442360846,1497385554,1),(20,'其他组合/乐队','qitazu',1442360846,1497385548,1);
/*!40000 ALTER TABLE `jy_artist_type` ENABLE KEYS */;

#
# Structure for table "jy_auth_extend"
#

DROP TABLE IF EXISTS `jy_auth_extend`;
CREATE TABLE `jy_auth_extend` (
  `group_id` mediumint(10) unsigned NOT NULL COMMENT '用户id',
  `extend_id` mediumint(8) unsigned NOT NULL COMMENT '扩展表中数据的id',
  `type` tinyint(1) unsigned NOT NULL COMMENT '扩展类型标识 1:栏目分类权限;2:模型权限',
  UNIQUE KEY `group_extend_type` (`group_id`,`extend_id`,`type`),
  KEY `uid` (`group_id`),
  KEY `group_id` (`extend_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户组与分类的对应关系表';

#
# Data for table "jy_auth_extend"
#

/*!40000 ALTER TABLE `jy_auth_extend` DISABLE KEYS */;
INSERT INTO `jy_auth_extend` VALUES (1,1,1),(1,1,2),(1,2,1),(1,2,2),(1,3,1),(1,3,2),(1,4,1),(1,37,1);
/*!40000 ALTER TABLE `jy_auth_extend` ENABLE KEYS */;

#
# Structure for table "jy_auth_group"
#

DROP TABLE IF EXISTS `jy_auth_group`;
CREATE TABLE `jy_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户组id,自增主键',
  `module` varchar(20) NOT NULL COMMENT '用户组所属模块',
  `type` tinyint(4) NOT NULL COMMENT '组类型',
  `title` char(20) NOT NULL DEFAULT '' COMMENT '用户组中文名称',
  `description` varchar(80) NOT NULL DEFAULT '' COMMENT '描述信息',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '用户组状态：为1正常，为0禁用,-1为删除',
  `rules` varchar(500) NOT NULL DEFAULT '' COMMENT '用户组拥有的规则id，多个规则 , 隔开',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

#
# Data for table "jy_auth_group"
#

/*!40000 ALTER TABLE `jy_auth_group` DISABLE KEYS */;
INSERT INTO `jy_auth_group` VALUES (1,'admin',1,'音乐管理组','负责管理音乐',1,'1,2,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,73,74,79,80,81,82,83,84,86,87,88,89,90,91,92,93,94,95,96,97,100,102,103,105,106'),(2,'admin',1,'资讯管理组','负责管理资讯',1,'1'),(3,'admin',1,'普通会员','注册的普通会员',1,''),(4,'admin',1,'用户管理组','负责管理用户',1,''),(5,'admin',1,'音乐人管理组','负责管理管理组',1,'');
/*!40000 ALTER TABLE `jy_auth_group` ENABLE KEYS */;

#
# Structure for table "jy_auth_group_access"
#

DROP TABLE IF EXISTS `jy_auth_group_access`;
CREATE TABLE `jy_auth_group_access` (
  `uid` int(10) unsigned NOT NULL COMMENT '用户id',
  `group_id` mediumint(8) unsigned NOT NULL COMMENT '用户组id',
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "jy_auth_group_access"
#

/*!40000 ALTER TABLE `jy_auth_group_access` DISABLE KEYS */;
/*!40000 ALTER TABLE `jy_auth_group_access` ENABLE KEYS */;

#
# Structure for table "jy_auth_musician"
#

DROP TABLE IF EXISTS `jy_auth_musician`;
CREATE TABLE `jy_auth_musician` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `uid` int(11) unsigned NOT NULL COMMENT '户用UID',
  `artist_name` char(60) NOT NULL COMMENT '艺人名称',
  `type` smallint(4) unsigned DEFAULT '1' COMMENT '音乐人类型',
  `realname` char(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '真实姓名',
  `phone` char(12) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '联系方式',
  `idcard` char(20) NOT NULL COMMENT '证件号码',
  `idcard_img1` varchar(255) NOT NULL COMMENT '身份证正面',
  `idcard_img2` varchar(255) DEFAULT NULL COMMENT '身份证反面',
  `attach_id` varchar(200) DEFAULT NULL COMMENT '认证资料，存储用户上传的ID',
  `reason` varchar(255) DEFAULT NULL COMMENT '证认理由',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '认证状态，0：否；1：是',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uid` (`uid`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "jy_auth_musician"
#

/*!40000 ALTER TABLE `jy_auth_musician` DISABLE KEYS */;
/*!40000 ALTER TABLE `jy_auth_musician` ENABLE KEYS */;

#
# Structure for table "jy_auth_rule"
#

DROP TABLE IF EXISTS `jy_auth_rule`;
CREATE TABLE `jy_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '规则id,自增主键',
  `module` varchar(20) NOT NULL COMMENT '规则所属module',
  `type` tinyint(2) NOT NULL DEFAULT '1' COMMENT '1-url;2-主菜单',
  `name` char(80) NOT NULL DEFAULT '' COMMENT '规则唯一英文标识',
  `title` char(20) NOT NULL DEFAULT '' COMMENT '规则中文描述',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否有效(0:无效,1:有效)',
  `condition` varchar(300) NOT NULL DEFAULT '' COMMENT '规则附加条件',
  PRIMARY KEY (`id`),
  KEY `module` (`module`,`status`,`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "jy_auth_rule"
#

/*!40000 ALTER TABLE `jy_auth_rule` DISABLE KEYS */;
/*!40000 ALTER TABLE `jy_auth_rule` ENABLE KEYS */;

#
# Structure for table "jy_channel"
#

DROP TABLE IF EXISTS `jy_channel`;
CREATE TABLE `jy_channel` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '频道ID',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级频道ID',
  `title` char(30) NOT NULL COMMENT '频道标题',
  `url` char(100) NOT NULL COMMENT '频道连接',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '导航排序',
  `target` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '新窗口打开',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

#
# Data for table "jy_channel"
#

/*!40000 ALTER TABLE `jy_channel` DISABLE KEYS */;
INSERT INTO `jy_channel` VALUES (1,0,'首页','/',1,0,1430851833,1496865400,1),(2,0,'专辑','/album',2,0,1430851833,1500263772,1),(4,0,'歌曲分类','/genre',4,0,1430851833,1467505873,1),(5,0,'风格标签','/tag',5,0,1430851833,1467362913,1),(6,0,'音乐人','/artist',3,0,1453186436,1500527829,1),(7,0,'歌曲排行','/ranks',6,0,1430851833,1467362921,1),(8,0,'音乐资讯','/article',7,0,1453186554,1500527745,1);
/*!40000 ALTER TABLE `jy_channel` ENABLE KEYS */;

#
# Structure for table "jy_comment"
#

DROP TABLE IF EXISTS `jy_comment`;
CREATE TABLE `jy_comment` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '评论ID',
  `uid` mediumint(7) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '分类ID,1音乐,2歌手，3，专辑，4，文章，5用户',
  `reply_id` int(11) NOT NULL DEFAULT '0' COMMENT '回复的ID',
  `page_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '内容ID',
  `content` varchar(255) NOT NULL COMMENT '评论内容',
  `root_id` bigint(20) NOT NULL DEFAULT '0' COMMENT '回复跟id',
  `layer` smallint(4) NOT NULL DEFAULT '1' COMMENT '楼层',
  `digg` int(11) NOT NULL DEFAULT '0' COMMENT '顶次数',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态',
  PRIMARY KEY (`id`),
  KEY `music_id` (`page_id`),
  KEY `type_id` (`type`),
  KEY `uid` (`uid`),
  KEY `digg` (`digg`),
  KEY `root_id` (`root_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='评论表';

#
# Data for table "jy_comment"
#

/*!40000 ALTER TABLE `jy_comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `jy_comment` ENABLE KEYS */;

#
# Structure for table "jy_config"
#

DROP TABLE IF EXISTS `jy_config`;
CREATE TABLE `jy_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '配置ID',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '配置名称',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '配置类型',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '配置说明',
  `group` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '配置分组',
  `extra` varchar(255) NOT NULL DEFAULT '' COMMENT '配置值',
  `remark` varchar(100) DEFAULT NULL COMMENT '配置说明',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  `value` text NOT NULL COMMENT '配置值',
  `sort` smallint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_name` (`name`),
  KEY `type` (`type`),
  KEY `group` (`group`)
) ENGINE=MyISAM AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;

#
# Data for table "jy_config"
#

/*!40000 ALTER TABLE `jy_config` DISABLE KEYS */;
INSERT INTO `jy_config` VALUES (1,'web_site_title',1,'网站标题',1,'','网站标题前台显示标题',1378898976,1379235274,1,'JYmusic音乐管理系统-DJ音乐系统',1),(2,'web_site_description',2,'网站描述',1,'','网站搜索引擎描述',1378898976,1379235841,1,'JYmusic是Php+Mysql开发的一款开源的跨平台音乐管理系统,采用国内最优秀php框架thinkphp。程序完全免费，稳定，易于扩展且具有超强大负载能力，完全可以满足音乐、DJ、音乐分享、音乐资讯站等使用。',3),(3,'web_site_keyword',2,'网站关键字',1,'','网站搜索引擎关键字',1378898976,1381390100,1,'JYmusic,JYmusic音乐管理程序,php音乐程序,原创音乐程序,音乐程序,dj舞曲程序,音乐程序，音乐管理程序，舞曲程序',4),(4,'web_site_close',5,'关闭站点',1,'0:否,1:是','站点关闭后其他用户不能访问，管理员可以正常访问',1378898976,1418743475,1,'0',7),(5,'config_type_list',3,'配置类型列表',0,'','主要用于数据解析和页面表单的生成',1378898976,1467495116,1,'0:数字\r\n1:字符\r\n2:文本\r\n3:数组\r\n4:枚举\r\n5:开关\r\n6:推荐位',2),(6,'web_site_icp',1,'网站备案号',1,'','设置在网站底部显示的备案号',1378900335,1428301591,1,'音乐因你而精彩',11),(7,'article_position',6,'文档推荐位',2,'','文档推荐位，推荐到多个位置KEY值相加即可',1379053380,1379235329,1,'1:首页推荐\r\n2:频道推荐',5),(8,'article_display',3,'文档可见性',2,'','文章可见性仅影响前台显示',1379056370,1450878123,1,'0:所有人可见\r\n1:仅注册会员可见\r\n2:仅管理员可见',6),(9,'color_style',4,'后台色系',1,'default_color:默认\r\nblue_color:紫罗兰','后台颜色风格',1379122533,1379235904,0,'default_color',13),(10,'config_group_list',3,'配置分组',0,'','配置分组',1379228036,1467495128,1,'1:基本\r\n2:内容\r\n3:用户\r\n4:系统\r\n5:音乐',12),(11,'hooks_type',3,'钩子的类型',4,'','类型 1-用于扩展显示内容，2-用于扩展业务处理',1379313397,1379313407,0,'1:视图\r\n2:控制器',5),(12,'auth_config',3,'Auth配置',4,'','自定义Auth.class.php类配置',1379409310,1379409564,0,'AUTH_ON:1\r\nAUTH_TYPE:2',7),(13,'open_draftbox',5,'是否开启草稿功能',2,'0:关闭草稿功能\r\n1:开启草稿功能\r\n','新增文章时的草稿功能配置',1379484332,1379484591,1,'1',3),(14,'draft_aotosave_interval',0,'自动保存草稿时间',2,'','自动保存草稿的时间间隔，单位：秒',1379484574,1386143323,1,'120',4),(15,'admin_list_rows',0,'后台每页记录数',4,'','后台数据每页显示记录数',1379503896,1380427745,1,'20',11),(16,'user_allow_register',5,'是否允许用户注册',3,'0:关闭注册\r\n1:允许注册','是否开放用户注册',1379504487,1466721970,1,'1',1),(17,'url_model',5,'url运行模式',4,'4:普通模式\r\n3:PATHINFO\r\n2:伪静态','如果使用伪静态，请确保服务器支持',1379814385,1384740813,1,'4',3),(18,'data_backup_path',1,'数据库备份根路径',4,'','路径必须以 / 结尾',1381482411,1381482411,1,'./storage/backup/',4),(19,'data_backup_part_size',0,'数据库备份卷大小',4,'','该值用于限制压缩后的分卷最大长度。单位：字节；建议设置20M',1381482488,1420738555,1,'20971520',6),(20,'data_backup_compress',4,'数据库备份文件是否启用压缩',4,'0:不压缩\r\n1:启用压缩','压缩备份文件需要PHP环境支持gzopen,gzwrite函数',1381713345,1381729544,1,'1',8),(21,'data_backup_compress_level',4,'数据库备份文件压缩级别',4,'1:普通\r\n4:一般\r\n9:最高','数据库备份文件的压缩级别，该配置在开启压缩时生效',1381713408,1381713408,1,'9',9),(22,'oauth_meta',1,'接口验证代码',0,'0:关闭\r\n1:开启','是否开启开发者模式',1383105995,1383291877,1,'',10),(23,'allow_visit',3,'不受限控制器方法',0,'','',1386644047,1386644741,1,'0:article/draftbox\r\n1:article/mydocument\r\n2:Category/tree\r\n3:Index/verify\r\n4:file/upload\r\n5:file/download\r\n6:user/updatePassword\r\n7:user/updateNickname\r\n8:user/submitPassword\r\n9:user/submitNickname\r\n10:file/uploadpicture',0),(24,'deny_visit',3,'超管专限控制器方法',0,'','仅超级管理员可访问的控制器方法',1386644141,1386644659,1,'0:Addons/addhook\r\n1:Addons/edithook\r\n2:Addons/delhook\r\n3:Addons/updateHook\r\n4:Admin/getMenus\r\n5:Admin/recordList\r\n6:AuthManager/updateRules\r\n7:AuthManager/tree',0),(25,'reply_list_rows',0,'回复列表每页条数',2,'','',1386645376,1387178083,1,'10',8),(26,'admin_allow_ip',2,'后台允许访问IP',4,'','多个用逗号分隔，如果不配置表示不限制IP访问',1387165454,1387165553,1,'',11),(27,'user_send_limit',0,'用户资料修改限制',3,'','用户资料修改每月上限，修改资料，密码，头像',1387165685,1387165685,1,'5',12),(28,'auth_musician_types',3,'音乐人认证类型',3,'','音乐人认证类型',1410508923,1410511597,1,'1:音乐人\r\n2:乐队/组合',7),(29,'music_position',6,'音乐推荐位',5,'','',1410702159,1410702298,1,'1:网站推荐\r\n2:精品推荐\r\n4:独家发布\r\n8:火热舞曲\r\n16:开场音乐\r\n',2),(30,'album_position',6,'专辑推荐位',5,'15','',1410702212,1410702312,1,'1:首页推荐\r\n2:列表推荐\r\n',2),(31,'artist_position',6,'艺术家推荐位',5,'','',1410702268,1410702268,1,'1:首页推荐\r\n2:列表推荐\r\n',3),(32,'web_off_msg',2,'站点关闭提示',1,'','关闭站点后的提示信息',1410702742,1410702742,1,'系统维护，请稍后访问~~~',9),(33,'jymusic_update_time',0,'JYmusic更新时间',0,'','',1410732630,1451253543,1,'20180126',4),(34,'web_site_stat',2,'统计代码',1,'','网站统计代码',1410732716,1467152172,1,'',9),(35,'jymusic_version',1,'JYmusic版本号',0,'','',1410732822,1451253430,0,'JYmusic_2.0.0_rc2',6),(36,'music_position_font_icon',6,'音乐推荐位字体图标',0,'','音乐推荐位字体图标',1410759851,1417227068,1,'1:glyphicon glyphicon-thumbs-up\r\n2:glyphicon glyphicon-star\r\n4:glyphicon glyphicon-tree-conifer\r\n8:glyphicon glyphicon-fire\r\n16:glyphicon glyphicon-hd-video\r\n',11),(37,'verify_off',5,'前台登录验证码',3,'0:关闭,1:开启','前台验证码开关，默认关闭',1411482781,1416921958,1,'0',11),(38,'web_domain',1,'网站域名',1,'','填写你的网站域名',1411743978,1411743978,1,'www.jyuu.cn',4),(39,'web_phone',0,'联系电话',1,'','',1413986755,1413986755,1,'18888888889',5),(40,'web_qq',0,'站长QQ',1,'','',1413986787,1417229439,1,'378020023',4),(41,'web_email',1,'站长邮箱',1,'','',1413986920,1413986998,1,'378020023@qq.com',5),(42,'oauth_conf',1,'同步登录配置',0,'','',1417226410,1466722004,1,'{\"open\":[\"weibo\",\"qq\"],\"weibo\":{\"client_id\":\"\",\"client_secret\":\"\"},\"qq\":{\"client_id\":\"\",\"client_secret\":\"\"},\"wechat_open\":{\"client_id\":\"\",\"client_secret\":\"\"}}',2),(43,'reg_greet_content',2,'欢迎信息内容',3,'','',1417227323,1466722029,1,'您已经注册成为{$webname}的会员，请您自己遵守注册协议和法律法规。\r\n如果您有什么疑问可以联系管理员，Email:{$webmail}。\r\n',5),(44,'site_ban_char',2,'用户禁止字符',3,'','包括 用户名和昵称，多个英文逗号分隔',1417229836,1466722048,1,'jymusic,创始人,管理员,jycms，admin',3),(45,'reg_ip_time',0,'同IP时间限制',3,'','同一IP注册限制时间-单位小时',1417230139,1466722062,1,'48',6),(46,'web_site_name',1,'站点名称',1,'','网站名称',1418641632,1418641718,1,'JYmusic音乐管理系统',2),(47,'only_musician_upload',5,'强制认证上传',5,'0:否\r\n1:是','认证为音乐人后才可以上传歌曲',1418989996,1418989996,1,'1',1),(48,'tag_group',3,'标签分组',5,'','注意配置格式  1:心情   然后回车键 ',1421597822,1446929902,1,'1:语种\r\n2:风格\r\n3:场景\r\n4:情感\r\n5:主题\r\n6:年代\r\n\r\n',4),(49,'send_activate_mail',5,'激活邮件',3,'0:关闭\r\n1:开启','用户邮件验证，激活验证',1423802500,1466722719,1,'0',4),(50,'follow_limit',0,'最多关注限制',3,'','最多关注用户数量',1426606718,1426606718,1,'500',13),(51,'mail_conf',1,'邮件配置',0,'','系统邮件配置信息',1428393358,1466751749,1,'{\"send_type\":\"smtp\",\"host\":\"\",\"ssl\":\"1\",\"port\":\"\",\"account\":\"\",\"password\":\"\",\"sender_name\":\"\",\"sender_email\":\"\"}',13),(52,'artist_position_font_icon',6,'艺人推荐位字体图标',0,'','',1466751749,1466751749,1,'1:glyphicon glyphicon-thumbs-up\r\n2:glyphicon glyphicon-sort\r\n',11),(53,'album_position_font_icon',6,'专辑推荐位字体图标',0,'','',1466751749,1466751749,1,'1:glyphicon glyphicon-thumbs-up\r\n2:glyphicon glyphicon-sort\r\n',11),(54,'article_position_font_icon',6,'专辑推荐位字体图标',0,'','',1466751749,1466751749,1,'1:glyphicon glyphicon-thumbs-up\r\n2:glyphicon glyphicon-sort\r\n',11),(56,'fav_max_limit',0,'最多收藏限制',3,'','用户最多收藏数量',1466751749,1466751749,1,'500',13);
/*!40000 ALTER TABLE `jy_config` ENABLE KEYS */;

#
# Structure for table "jy_file"
#

DROP TABLE IF EXISTS `jy_file`;
CREATE TABLE `jy_file` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '文件ID',
  `name` char(60) NOT NULL DEFAULT '' COMMENT '原始文件名',
  `filepath` varchar(255) DEFAULT NULL COMMENT '保存名称',
  `url` varchar(255) DEFAULT NULL,
  `ext` char(5) DEFAULT NULL COMMENT '文件后缀',
  `mime` char(40) NOT NULL DEFAULT '' COMMENT '文件mime类型',
  `size` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文件大小',
  `md5` char(32) NOT NULL DEFAULT '' COMMENT '文件md5',
  `sha1` char(40) NOT NULL DEFAULT '' COMMENT '文件 sha1编码',
  `location` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '文件保存位置',
  `create_time` int(10) unsigned NOT NULL COMMENT '上传时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_md5` (`md5`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='文件表';

#
# Data for table "jy_file"
#

/*!40000 ALTER TABLE `jy_file` DISABLE KEYS */;
/*!40000 ALTER TABLE `jy_file` ENABLE KEYS */;

#
# Structure for table "jy_genre"
#

DROP TABLE IF EXISTS `jy_genre`;
CREATE TABLE `jy_genre` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '歌曲分类ID',
  `pid` int(10) NOT NULL DEFAULT '0' COMMENT '父id',
  `name` char(40) NOT NULL COMMENT '分类名称',
  `alias` char(50) NOT NULL COMMENT 'url标示',
  `icon` char(20) DEFAULT NULL COMMENT '分类图标',
  `cover_url` varchar(255) DEFAULT NULL COMMENT '封面地址',
  `hits` int(11) NOT NULL DEFAULT '0' COMMENT '点击次数',
  `sort` smallint(6) NOT NULL DEFAULT '0' COMMENT '排序',
  `recommend` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否推荐',
  `introduce` text COMMENT '分类简介',
  `meta_title` char(60) DEFAULT NULL,
  `keywords` varchar(200) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加分类时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `alias` (`alias`),
  KEY `pid` (`pid`),
  KEY `hits` (`hits`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

#
# Data for table "jy_genre"
#

/*!40000 ALTER TABLE `jy_genre` DISABLE KEYS */;
INSERT INTO `jy_genre` VALUES (1,0,'原创','yc','','',1,1,0,'','','','',1435148554,1500686134,1),(2,0,'伴奏','bz','','',0,2,0,'','','','',1441578608,1498134598,1),(3,0,'翻唱','fc','','',11,3,0,'','','','',1441578660,1498134614,1),(4,0,'中文舞曲','zwwq','','',4,4,0,'','','','',1441578681,1498134622,1),(5,0,'外语舞曲','ywwq','','',4,5,0,'','','','',1441578710,1500694384,1),(6,0,'串烧舞曲','cswq','','',22,6,0,'','','','',1441578735,1498134639,1);
/*!40000 ALTER TABLE `jy_genre` ENABLE KEYS */;

#
# Structure for table "jy_hooks"
#

DROP TABLE IF EXISTS `jy_hooks`;
CREATE TABLE `jy_hooks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(40) NOT NULL DEFAULT '' COMMENT '钩子名称',
  `description` text NOT NULL COMMENT '描述',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '类型',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `addons` varchar(255) NOT NULL DEFAULT '' COMMENT '钩子挂载的插件 ''，''分割',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

#
# Data for table "jy_hooks"
#

/*!40000 ALTER TABLE `jy_hooks` DISABLE KEYS */;
INSERT INTO `jy_hooks` VALUES (1,'pageHeader','页面header钩子，一般用于加载插件CSS文件和代码',1,1467456868,'',1),(2,'pageFooter','页面footer钩子，一般用于加载插件JS文件和JS代码',1,1467456868,'Links',1),(3,'pageBody','页面内容前显示用钩子',1,1467456868,'Baidushare',1),(4,'contentAfter','内容末尾显示',1,1467456868,'Comment',1),(5,'topicComment','评论提交方式扩展钩子。',1,1467456868,'Editor',1),(6,'app_begin','应用开始',2,1467456868,'',1),(7,'documentEditForm','添加编辑表单的内容显示钩子',1,1467456868,'Editor',1),(8,'articleEdit','内容编辑页编辑器',1,1467456868,'Editor',1),(9,'adminIndex','首页小格子个性化显示',1,1467456868,'SyncLogin,Ads',1),(10,'indexSlider','首页幻灯片',1,1467456868,'Slider',1),(11,'file','文件钩子',1,1496908375,'Upload',1),(12,'template','模版管理插件钩子',1,1467456868,'Template',1),(13,'syncLogin','第三方账号同步登陆',1,1467456868,'SyncLogin',0),(14,'pageMeta','页面头部meta接口',1,1467456868,'',1),(15,'pay','支付钩子',1,1467456868,'indexPay,Pay',1);
/*!40000 ALTER TABLE `jy_hooks` ENABLE KEYS */;

#
# Structure for table "jy_links"
#

DROP TABLE IF EXISTS `jy_links`;
CREATE TABLE `jy_links` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `type` int(1) NOT NULL DEFAULT '1' COMMENT '类别（1：图片，2：普通）',
  `title` char(80) NOT NULL DEFAULT '' COMMENT '站点名称',
  `cover_url` varchar(255) DEFAULT NULL COMMENT '图片外链地址',
  `link` char(140) NOT NULL DEFAULT '' COMMENT '链接地址',
  `level` int(3) unsigned NOT NULL DEFAULT '0' COMMENT '优先级',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态（0：禁用，1：正常）',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='友情连接表';

#
# Data for table "jy_links"
#

/*!40000 ALTER TABLE `jy_links` DISABLE KEYS */;
/*!40000 ALTER TABLE `jy_links` ENABLE KEYS */;

#
# Structure for table "jy_member"
#

DROP TABLE IF EXISTS `jy_member`;
CREATE TABLE `jy_member` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `nickname` char(16) NOT NULL DEFAULT '' COMMENT '昵称',
  `avatar` varchar(255) DEFAULT NULL COMMENT '用户头像',
  `songs` int(10) NOT NULL DEFAULT '0' COMMENT '添加音乐数量',
  `albums` int(10) NOT NULL DEFAULT '0' COMMENT '创建专辑数量',
  `listens` int(10) NOT NULL DEFAULT '0' COMMENT '歌曲播放次数',
  `follows` int(10) NOT NULL DEFAULT '0' COMMENT '关注数量',
  `fans` int(10) DEFAULT '0' COMMENT '粉丝数量',
  `sex` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '性别',
  `hits` int(11) NOT NULL DEFAULT '1' COMMENT '点击数',
  `birthday` int(10) DEFAULT '0' COMMENT '生日',
  `qq` char(10) DEFAULT NULL COMMENT 'qq号',
  `score` mediumint(8) NOT NULL DEFAULT '0' COMMENT '用户积分',
  `coin` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '金币数',
  `is_musician` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否音乐人',
  `signature` varchar(255) CHARACTER SET utf8 COLLATE utf8_estonian_ci DEFAULT NULL COMMENT '个性签名',
  `location` varchar(100) DEFAULT NULL COMMENT '所在地字符串',
  `province` char(30) DEFAULT NULL COMMENT '所在省',
  `city` char(20) DEFAULT NULL COMMENT '所在市',
  `district` char(20) DEFAULT NULL COMMENT '所在区',
  `experience` int(11) NOT NULL DEFAULT '0' COMMENT '用户经验值',
  `login` int(10) unsigned DEFAULT '1' COMMENT '登录次数',
  `reg_ip` bigint(20) NOT NULL DEFAULT '0' COMMENT '注册IP',
  `reg_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '注册时间',
  `last_login_ip` bigint(20) NOT NULL DEFAULT '0' COMMENT '最后登录IP',
  `last_login_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '会员状态',
  `cdkey` varchar(60) DEFAULT NULL COMMENT '激活码',
  PRIMARY KEY (`uid`),
  KEY `status` (`status`),
  KEY `nickname` (`nickname`),
  KEY `hits` (`hits`),
  KEY `coin` (`coin`),
  KEY `follows` (`follows`),
  KEY `fans` (`fans`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='会员表';

#
# Data for table "jy_member"
#

/*!40000 ALTER TABLE `jy_member` DISABLE KEYS */;
INSERT INTO `jy_member` VALUES (1,'admin','881fdafcd78c43a390a2651704059a86',0,0,0,0,0,0,1,0,NULL,0,0,0,NULL,NULL,NULL,NULL,NULL,0,2,2130706433,1563961105,2130706433,1563961122,1,NULL);
/*!40000 ALTER TABLE `jy_member` ENABLE KEYS */;

#
# Structure for table "jy_member_group"
#

DROP TABLE IF EXISTS `jy_member_group`;
CREATE TABLE `jy_member_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `name` char(20) NOT NULL COMMENT '用户组名称',
  `alias` char(30) NOT NULL DEFAULT '0',
  `icon_url` varchar(255) NOT NULL COMMENT '用户组图标名称',
  `icon_font` char(20) NOT NULL COMMENT '用户组字体图标',
  `rule` varchar(255) DEFAULT NULL COMMENT '用户组规则',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(11) DEFAULT NULL COMMENT '更新时间',
  `status` tinyint(2) DEFAULT NULL COMMENT '用户组状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

#
# Data for table "jy_member_group"
#

/*!40000 ALTER TABLE `jy_member_group` DISABLE KEYS */;
INSERT INTO `jy_member_group` VALUES (1,'普通会员','putong','/public/static/images/user.png','','{\"year_coin\":\"0\",\"month_coin\":\"0\",\"day_coin\":\"0\",\"is_upload_song\":\"0\",\"is_create_album\":\"0\",\"is_upload_avatar\":\"1\",\"is_send_letter\":\"0\"}',1497623022,1497623022,1),(2,'VIP会员','vip','/public/static/images/vip.png','','{\"year_coin\":\"100\",\"half_year_coin\":\"60\",\"month_coin\":\"10\",\"is_upload_song\":\"1\",\"is_create_album\":\"1\",\"is_upload_avatar\":\"1\",\"is_send_letter\":\"1\"}',1497623022,1500882838,1),(3,'高级VIP会员','svip','/public/static/images/svip.png','','{\"year_coin\":\"200\",\"half_year_coin\":\"110\",\"month_coin\":\"20\",\"is_upload_song\":\"1\",\"is_create_album\":\"1\",\"is_upload_avatar\":\"1\",\"is_send_letter\":\"1\"}',1497623022,1500882890,1);
/*!40000 ALTER TABLE `jy_member_group` ENABLE KEYS */;

#
# Structure for table "jy_member_group_link"
#

DROP TABLE IF EXISTS `jy_member_group_link`;
CREATE TABLE `jy_member_group_link` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `uid` int(10) NOT NULL COMMENT '户用UID',
  `group_id` int(10) NOT NULL COMMENT '户用组ID',
  `end_time` int(11) NOT NULL COMMENT '所在组到期时间',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`) USING BTREE,
  KEY `group_id` (`group_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "jy_member_group_link"
#

/*!40000 ALTER TABLE `jy_member_group_link` DISABLE KEYS */;
/*!40000 ALTER TABLE `jy_member_group_link` ENABLE KEYS */;

#
# Structure for table "jy_menu"
#

DROP TABLE IF EXISTS `jy_menu`;
CREATE TABLE `jy_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '文档ID',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '标题',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类ID',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序（同级有效）',
  `url` char(255) NOT NULL DEFAULT '' COMMENT '链接地址',
  `hide` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否隐藏',
  `tip` varchar(255) NOT NULL DEFAULT '' COMMENT '提示',
  `group` varchar(50) DEFAULT '' COMMENT '分组',
  `is_dev` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否仅开发者模式可见',
  `icon` varchar(20) DEFAULT NULL COMMENT 'class样式',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=223 DEFAULT CHARSET=utf8;

#
# Data for table "jy_menu"
#

/*!40000 ALTER TABLE `jy_menu` DISABLE KEYS */;
INSERT INTO `jy_menu` VALUES (1,'首页',0,1,'index/index',0,'','',0,'dashboard',1),(2,'资讯',0,3,'article/index',0,'','',0,'archive',1),(3,'资讯列表',2,1,'article/index',0,'','文档管理',0,'',1),(4,'创建文档',3,0,'article/create',0,'','',0,'',1),(5,'编辑文档',3,0,'article/edit',0,'','',0,'',1),(6,'改变状态',3,0,'article/setStatus',0,'','',0,'',1),(7,'更新文档',3,0,'article/update',0,'','',0,'',1),(8,'保存草稿',3,0,'article/autoSave',0,'','',0,'',1),(9,'移动文档',3,0,'article/move',0,'','',0,'',1),(10,'复制文档',3,0,'article/copy',0,'','',0,'',1),(11,'粘贴文档',3,0,'article/paste',0,'','',0,'',1),(12,'导入文档',3,0,'article/batchOperate',0,'','',0,'',1),(13,'回收站',2,4,'article/recycle',0,'','文档管理',0,'',1),(14,'还原',13,0,'article/permit',0,'','',0,'',1),(15,'清空',13,0,'article/clear',0,'','',0,'',1),(16,'用户',0,4,'user/index',0,'','',0,'user',1),(17,'用户列表',16,0,'user/index',0,'','用户管理',0,'',1),(18,'创建用户',17,0,'user/create',1,'添加新用户','',0,'',1),(19,'编辑用户',17,0,'user/edit',1,'','',0,'',1),(20,'删除用户',17,0,'user/delete',1,'','',0,'',1),(21,'修改资料',17,0,'user/profile',0,'后台登录用户资料修改','',0,'',1),(22,'添加到用户组',17,0,'user/togroup',1,'','',0,'',1),(23,'变更行为状态',19,0,'user/setStatus',0,'','',0,'',1),(24,'禁用会员',19,0,'User/changeStatus?method=forbidUser',0,'\"用户->用户信息\"中的禁用','',0,'',1),(25,'启用会员',19,0,'User/changeStatus?method=resumeUser',0,'\"用户->用户信息\"中的启用','',0,'',1),(26,'删除会员',19,0,'User/changeStatus?method=deleteUser',0,'\"用户->用户信息\"中的删除','',0,'',1),(27,'权限管理',16,0,'authManager/index',1,'','后台权限',0,'unlock-alt',1),(28,'删除',27,0,'authManager/changeStatus?method=deleteGroup',0,'删除用户组','',0,'',1),(29,'禁用',27,0,'authManager/changeStatus?method=forbidGroup',0,'禁用用户组','',0,'',1),(30,'恢复',27,0,'authManager/changeStatus?method=resumeGroup',0,'恢复已禁用的用户组','',0,'',1),(31,'新增',27,0,'authManager/createGroup',0,'创建新的用户组','',0,'',1),(32,'编辑',27,0,'authManager/editGroup',0,'编辑用户组名称和描述','',0,'',1),(33,'保存用户组',27,0,'authManager/writeGroup',0,'新增和编辑用户组的\"保存\"按钮','',0,'',1),(34,'授权',27,0,'authManager/group',0,'\"后台 \\ 用户 \\ 用户信息\"列表页的\"授权\"操作按钮,用于设置用户所属用户组','',0,'',1),(35,'访问授权',27,0,'authManager/access',0,'\"后台 \\ 用户 \\ 权限管理\"列表页的\"访问授权\"操作按钮','',0,'',1),(36,'成员授权',27,0,'authManager/user',0,'\"后台 \\ 用户 \\ 权限管理\"列表页的\"成员授权\"操作按钮','',0,'',1),(37,'解除授权',27,0,'authManager/removeFromGroup',0,'\"成员授权\"列表页内的解除授权操作按钮','',0,'',1),(38,'保存成员授权',27,0,'authManager/addToGroup',0,'\"用户信息\"列表页\"授权\"时的\"保存\"按钮和\"成员授权\"里右上角的\"添加\"按钮)','',0,'',1),(39,'分类授权',27,0,'authManager/category',0,'\"后台 \\ 用户 \\ 权限管理\"列表页的\"分类授权\"操作按钮','',0,'',1),(40,'保存分类授权',27,0,'authManager/addToCategory',0,'\"分类授权\"页面的\"保存\"按钮','',0,'',1),(41,'模型授权',27,0,'authManager/modelauth',0,'\"后台 \\ 用户 \\ 权限管理\"列表页的\"模型授权\"操作按钮','',0,'',1),(42,'保存模型授权',27,0,'authManager/addToModel',0,'\"分类授权\"页面的\"保存\"按钮','',0,'',1),(43,'应用',0,7,'addons/index',0,'','',0,'puzzle-piece',1),(44,'插件管理',43,1,'addons/index',0,'','应用列表',0,'',1),(45,'创建',44,0,'addons/create',0,'服务器上创建插件结构向导','',0,'',1),(46,'检测创建',44,0,'addons/checkForm',0,'检测插件是否可以创建','',0,'',1),(47,'预览',44,0,'addons/preview',0,'预览插件定义类文件','',0,'',1),(48,'快速生成插件',44,0,'addons/build',1,'开始生成插件结构','',0,'',1),(49,'设置',44,0,'addons/config',0,'设置插件配置','',0,'',1),(50,'禁用',44,0,'addons/disable',0,'禁用插件','',0,'',1),(51,'启用',44,0,'addons/enable',0,'启用插件','',0,'',1),(52,'安装',44,0,'addons/install',0,'安装插件','',0,'',1),(53,'卸载',44,0,'addons/uninstall',0,'卸载插件','',0,'',1),(54,'更新配置',44,0,'addons/saveconfig',0,'更新插件配置处理','',0,'',1),(55,'应用后台列表',44,0,'addons/adminList',0,'','',0,'',1),(56,'主题管理',43,2,'them/index',0,'','应用列表',0,'',1),(57,'安装主题',56,2,'them/install',1,'','',0,'',1),(58,'卸载主题',56,3,'them/uninstall',1,'','',0,'',1),(59,'草稿箱',2,3,'article/draftbox',0,'','文档管理',0,'',1),(60,'编辑主题',56,0,'them/edit',0,'','',0,'',1),(61,'启用主题',56,0,'them/enable',0,'','',0,'',1),(62,'主题配置',56,0,'them/config',0,'','',0,'',1),(63,'关于网站',68,10,'site/index',0,'关于网站。','系统设置',0,'',1),(64,'新增',63,0,'site/create',1,'','',0,'',1),(65,'编辑',63,0,'site/edit',1,'','',0,'',1),(66,'删除',63,0,'site/delete',1,'','',0,'',1),(67,'更改状态',63,0,'site/setStatus',1,'','',0,'',1),(68,'系统',0,4,'setting/index',0,'','',0,'cogs',1),(69,'网站设置',68,1,'setting/index',0,'','系统设置',0,'cogs',1),(70,'配置管理',68,4,'config/index',1,'','系统设置',0,'',1),(71,'编辑配置',70,0,'config/edit',0,'新增编辑和保存配置','',0,'',1),(72,'删除配置',70,0,'config/delete',0,'删除配置','',0,'',1),(73,'创建配置',70,0,'config/crate',0,'新增配置','',0,'',1),(74,'保存配置',70,0,'config/save',0,'保存配置','',0,'',1),(75,'菜单管理',68,5,'menu/index',1,'','系统设置',0,'align-justify',1),(76,'导航管理',68,6,'channel/index',0,'','系统设置',0,'sitemap',1),(77,'新增',76,0,'channel/create',0,'','',0,'',1),(78,'编辑',76,0,'channel/edit',0,'','',0,'',1),(79,'删除',76,0,'channel/delete',0,'','',0,'',1),(80,'分类管理',2,2,'articleCate/index',0,'','文档管理',0,'',1),(81,'编辑分类',80,0,'articleCate/edit',0,'编辑和保存栏目分类','内容',0,'',1),(82,'创建分类',80,0,'articleCate/create',0,'新增栏目分类','',0,'',1),(83,'删除分类',80,0,'articleCate/dete',0,'删除栏目分类','',0,'',1),(84,'移动分类',80,0,'articleCate/operate/type/move',0,'移动栏目分类','',0,'',1),(85,'合并分类',80,0,'articleCate/operate/type/merge',1,'合并栏目分类','',0,'',1),(86,'备份数据库',68,0,'database/index?type=export',0,'','数据备份',0,'database',1),(87,'备份',86,0,'database/export',0,'备份数据库','',0,'',1),(88,'优化表',86,0,'database/optimize',0,'优化数据表','',0,'',1),(89,'修复表',86,0,'database/repair',0,'修复数据表','',0,'',1),(90,'还原数据库',68,0,'database/index?type=import',0,'','数据备份',0,'reply',1),(91,'恢复数据',90,0,'database/import',0,'数据库恢复','',0,'',1),(92,'删除数据',90,0,'database/del',0,'删除备份文件','',0,'',1),(96,'创建菜单',75,0,'menu/create',0,'','',0,'',1),(98,'编辑菜单',75,0,'menu/edit',0,'','',0,'',1),(106,'行为日志',16,0,'action/actionlog',1,'','行为管理',0,'bar-chart',1),(108,'修改管理密码',17,0,'user/updatePassword',0,'','',0,'',1),(109,'修改管理昵称',17,0,'user/updateNickname',0,'','',0,'',1),(110,'查看行为日志',106,0,'action/edit',1,'','',0,'',1),(112,'新增数据',58,0,'think/add',1,'','',0,'',1),(113,'编辑数据',58,0,'think/edit',1,'','',0,'',1),(114,'导入菜单',75,0,'menu/import',0,'','',0,'',1),(115,'生成',58,0,'model/generate',0,'','',0,'',1),(116,'新增钩子',57,0,'Addons/addHook',0,'','',0,'',1),(117,'编辑钩子',57,0,'Addons/edithook',0,'','',1,'',1),(118,'文档排序',3,0,'article/sort',1,'','',0,'',1),(119,'配置排序',70,0,'config/sort',1,'','',0,'',1),(120,'菜单排序',75,0,'menu/sort',1,'','',0,'',1),(121,'导航排序',76,0,'channel/sort',1,'','',0,'',1),(122,'数据列表',58,0,'think/lists',1,'','',0,'',1),(123,'音乐',0,2,'songs/index',0,'','',0,'music',1),(124,'歌曲管理',123,0,'songs/index',0,'','音乐管理',0,'music',1),(125,'创建歌曲',124,0,'songs/create',0,'创建歌曲','音乐管理',0,'',1),(126,'编辑歌曲',124,1,'songs/edit',1,'编辑歌曲','音乐管理',0,'',1),(127,'删除歌曲',124,2,'songs/delete',1,'删除歌曲','音乐管理',0,'',1),(128,'清空歌曲',158,4,'songs/clear',0,'清空回收站歌曲','辅助功能',0,'',1),(129,'专辑管理',123,1,'album/index',0,'专辑管理','音乐管理',0,'th-large',1),(130,'创建专辑',129,0,'album/create',1,'创建专辑','音乐管理',0,'',1),(131,'编辑专辑',129,2,'album/edit',1,'编辑专辑','音乐管理',0,'',1),(132,'删除专辑',129,3,'album/delete',1,'删除将无法恢复','音乐管理',0,'',1),(133,'艺人管理',123,2,'artist/index',0,'歌手管理页面','音乐管理',0,'microphone',1),(134,'创建艺人',133,0,'artist/create',0,'添加新歌手','音乐管理',0,'',1),(135,'修改艺人',133,1,'artist/edit',0,'修改歌手','音乐管理',0,'',1),(136,'删除艺人',133,2,'artist/delete',0,'删除将无法恢复','音乐管理',0,'',1),(137,'音乐分类',123,3,'genre/index',0,'设置音乐分类','音乐管理',0,'list-ul',1),(138,'创建音乐分类',137,0,'genre/create',1,'添加新音乐分类','音乐管理',0,'',1),(139,'编辑音乐分类',137,1,'genre/edit',1,'修改音乐分类','音乐管理',0,'',1),(140,'删除音乐分类',137,2,'genre/delete',1,'删除将无法恢复','音乐管理',0,'',1),(141,'专辑类型',123,6,'albumType/index',0,'专辑类型管理页面','音乐管理',0,'list-alt',1),(142,'创建专辑类型',141,1,'albumType/create',1,'添加专辑类型','音乐管理',0,'',1),(143,'编辑专辑类型',141,2,'albumType/edit',1,'修改专辑类型','音乐管理',0,'',1),(144,'删除专辑类型',141,3,'albumType/delete',1,'删除将无法恢复','音乐管理',0,'',1),(145,'艺人类型',123,7,'artistType/index',0,'歌手类型管理页面','音乐管理',0,'list-alt',1),(146,'创建艺人类型',145,1,'artistType/create',0,'添加歌手类型','音乐管理',0,'',1),(147,'编辑艺人类型',145,2,'artistType/edit',0,'修改歌手类型','音乐管理',0,'',1),(148,'删除艺人类型',145,3,'artistType/delete',0,'删除将无法恢复','音乐管理',0,'',1),(149,'读取艺人',133,0,'artist/read',1,'读取艺人列表','网站设置',0,'',1),(151,'读取专辑',124,5,'album/read',1,'读取专辑列表','音乐管理',0,'',1),(152,'信息管理',16,0,'message/index',0,'','用户管理',0,'comment-o',1),(153,'添加信息',152,0,'message/add',1,'','用户管理',0,'',1),(154,'服务器管理',68,8,'server/index',0,'','系统设置',0,'tasks',1),(155,'创建服务器',154,0,'server/create',1,'','音乐管理',0,'',1),(156,'编辑服务器',154,0,'server/edit',1,'','音乐管理',0,'',1),(157,'音乐榜单',123,4,'ranks/index',0,'音乐榜单','音乐管理',0,'signal',1),(158,'创建音乐榜单',157,11,'ranks/create',1,'创建音乐榜单','音乐管理',0,'trash-o',1),(159,'标签管理',123,5,'tags/index',0,'','音乐管理',0,'tags',1),(160,'创建标签',159,0,'tags/create',1,'','音乐管理',0,'',1),(161,'编辑标签',159,0,'tags/edit',1,'','音乐管理',0,'',1),(162,'删除标签',159,0,'tags/delete',1,'','音乐管理',0,'',1),(163,'读取标签',159,0,'tags/read',1,'读取标签数据','系统设置',0,'',1),(164,'编辑音乐榜单',157,0,'ranks/edit',1,'修改音乐榜','系统设置',0,'',1),(166,'删除音乐榜单',157,0,'ranks/delete',1,'删除音乐榜单','用户管理',0,'',1),(167,'歌曲批量修改',124,0,'songs/bulk',0,'批量操作歌曲','用户管理',0,'',1),(168,'音乐人管理',16,0,'musician/index',0,'','用户管理',0,'',1),(169,'审核音乐人',168,0,'musician/audit',0,'','用户管理',0,'',1),(170,'新增音乐人',168,0,'musician/create',0,'','用户管理',0,'',1),(171,'编辑音乐人',168,0,'musician/edit',0,'','用户管理',0,'',1),(172,'邮件配置',68,7,'Email/index',0,'','系统设置',0,'envelope-o',1),(173,'SEO管理',68,6,'seo/index',0,'','系统设置',0,'crosshairs',1),(174,'新增SEO规则',173,0,'seo/create',0,'','系统设置',0,'',1),(175,'修改Seo规则',173,0,'seo/edit',0,'','系统设置',0,'',1),(176,'删除SEO规则',173,0,'seo/delete',0,'','系统设置',0,'',1),(185,'修改管理用户名',17,0,'user/updateUsername',0,'','',0,'',1),(186,'删除音乐人',124,0,'musician/delete',0,'','音乐管理',0,'',1),(189,'用户组管理',16,0,'userGroup/index',0,'','用户管理',0,'group',1),(190,'添加用户组',189,0,'userGroup/create',0,'','',0,'',1),(191,'修改用户组',189,0,'userGroup/edit',1,'','',0,'',1),(193,'认证管理',16,0,'auth/index',1,'','用户管理',0,'ioxhos',1),(194,'添加认证',193,0,'Auth/add',1,'','',0,'',1),(195,'修改认证',193,0,'Auth/mod',1,'','',0,'',1),(196,'删除认证',193,0,'Auth/del',1,'','',0,'',1),(197,'获取标签',159,0,'tags/read',1,'','音乐管理',0,'',1);
/*!40000 ALTER TABLE `jy_menu` ENABLE KEYS */;

#
# Structure for table "jy_message"
#

DROP TABLE IF EXISTS `jy_message`;
CREATE TABLE `jy_message` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '消息id',
  `content` text NOT NULL COMMENT '信息内容',
  `post_uid` int(11) NOT NULL COMMENT '提交用户id',
  `post_uname` char(20) NOT NULL,
  `to_uid` int(11) NOT NULL DEFAULT '0' COMMENT '接收用户id',
  `to_uname` char(20) NOT NULL,
  `reply_id` int(11) NOT NULL COMMENT '回复ID',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '提交时间',
  `is_tip` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否提示过',
  `is_read` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否读取',
  `status` tinyint(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `post_uid` (`post_uid`),
  KEY `to_uid` (`to_uid`),
  KEY `is_tip` (`is_tip`),
  KEY `is_read` (`is_read`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "jy_message"
#

/*!40000 ALTER TABLE `jy_message` DISABLE KEYS */;
/*!40000 ALTER TABLE `jy_message` ENABLE KEYS */;

#
# Structure for table "jy_notice"
#

DROP TABLE IF EXISTS `jy_notice`;
CREATE TABLE `jy_notice` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '接收者',
  `appname` char(20) NOT NULL DEFAULT 'public',
  `title` varchar(100) NOT NULL COMMENT '标题',
  `content` varchar(500) NOT NULL COMMENT '内容',
  `is_read` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否已读',
  `create_time` int(11) NOT NULL COMMENT '添加时间',
  `status` tinyint(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `uid_read` (`uid`,`is_read`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "jy_notice"
#

/*!40000 ALTER TABLE `jy_notice` DISABLE KEYS */;
/*!40000 ALTER TABLE `jy_notice` ENABLE KEYS */;

#
# Structure for table "jy_pay_history"
#

DROP TABLE IF EXISTS `jy_pay_history`;
CREATE TABLE `jy_pay_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '支付会员',
  `type` char(20) NOT NULL COMMENT '支付类型',
  `out_trade_no` char(40) NOT NULL COMMENT '用户订单号',
  `price` decimal(5,2) unsigned NOT NULL COMMENT '提交金额',
  `body` varchar(255) DEFAULT NULL COMMENT '商品描述',
  `total_fee` decimal(5,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '交易金额',
  `trade_no` char(40) DEFAULT NULL COMMENT '支付返回交易号',
  `user_ip` bigint(20) NOT NULL COMMENT '支付者ip',
  `create_time` int(11) NOT NULL COMMENT '交易创建时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '支付状态 0：失败，1：成功',
  PRIMARY KEY (`id`),
  KEY `out_trade_no` (`out_trade_no`),
  KEY `type` (`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "jy_pay_history"
#

/*!40000 ALTER TABLE `jy_pay_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `jy_pay_history` ENABLE KEYS */;

#
# Structure for table "jy_picture"
#

DROP TABLE IF EXISTS `jy_picture`;
CREATE TABLE `jy_picture` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id自增',
  `name` varchar(60) NOT NULL COMMENT '所属id',
  `filepath` varchar(255) NOT NULL DEFAULT '' COMMENT '路径',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '图片链接',
  `mime` char(40) NOT NULL DEFAULT '0' COMMENT '类型',
  `ext` char(5) NOT NULL DEFAULT '0',
  `md5` char(32) NOT NULL DEFAULT '' COMMENT '文件md5',
  `sha1` char(40) NOT NULL DEFAULT '' COMMENT '文件 sha1编码',
  `size` int(10) NOT NULL DEFAULT '0' COMMENT '大小',
  `location` tinyint(2) NOT NULL DEFAULT '0' COMMENT '位置',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "jy_picture"
#

/*!40000 ALTER TABLE `jy_picture` DISABLE KEYS */;
/*!40000 ALTER TABLE `jy_picture` ENABLE KEYS */;

#
# Structure for table "jy_ranks"
#

DROP TABLE IF EXISTS `jy_ranks`;
CREATE TABLE `jy_ranks` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` char(20) NOT NULL COMMENT '榜单名称',
  `alias` char(30) NOT NULL COMMENT '榜单别名',
  `sort` smallint(6) NOT NULL DEFAULT '0' COMMENT '榜单排序',
  `hits` int(11) NOT NULL DEFAULT '0',
  `introduce` text NOT NULL COMMENT '榜单描述',
  `rule` varchar(200) DEFAULT NULL COMMENT '榜单规则',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `is_sys` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否是系统榜单',
  `status` tinyint(2) unsigned NOT NULL DEFAULT '1' COMMENT '状态（0：禁用，1：正常）',
  PRIMARY KEY (`id`),
  UNIQUE KEY `alias` (`alias`),
  KEY `hits` (`hits`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='歌曲榜单';

#
# Data for table "jy_ranks"
#

/*!40000 ALTER TABLE `jy_ranks` DISABLE KEYS */;
INSERT INTO `jy_ranks` VALUES (1,'人气排行','fire',1,2,'','{\"order\":\"listens desc\"}',1497447652,1499533682,1,1),(2,'最新推荐','hot',2,2,'','{\"order\":\"create_time desc\",\"position\":{\"neq\", \"0\"}}',1497447652,1499533690,1,1),(3,'下载排行','down',3,0,'','{\"order\":\"download desc\"}',1497447652,1499533585,1,1),(4,'收藏排行','fav',4,0,'','{\"order\":\"favtimes desc\"}',1497447652,1499533643,1,1),(5,'最新上传','latest',5,0,'                                                            ','{\"order\":\"create_time desc\"}',1497447652,1499533634,1,1);
/*!40000 ALTER TABLE `jy_ranks` ENABLE KEYS */;

#
# Structure for table "jy_seo_rule"
#

DROP TABLE IF EXISTS `jy_seo_rule`;
CREATE TABLE `jy_seo_rule` (
  `id` smallint(8) NOT NULL AUTO_INCREMENT,
  `title` char(40) NOT NULL,
  `module` char(20) NOT NULL,
  `controller` char(20) NOT NULL,
  `action` char(20) NOT NULL,
  `title_rule` varchar(120) NOT NULL,
  `keywords_rule` varchar(150) NOT NULL,
  `description_rule` varchar(260) NOT NULL,
  `sort` int(11) NOT NULL DEFAULT '0',
  `is_sys` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

#
# Data for table "jy_seo_rule"
#

/*!40000 ALTER TABLE `jy_seo_rule` DISABLE KEYS */;
INSERT INTO `jy_seo_rule` VALUES (1,'音乐单曲页面','home','music','read','{$name}在线试听 - {$web_site_title}','{$name}在线试听，{$name}免费试听，{$name}高音质试听，{$user_name}上传的歌曲','{$name}在线试听、{$name}免费试听、{$name}高音质试听、{$user_name}上传的歌曲',0,1,1),(2,'艺人详细页面','home','artist','read','{$name} - {$web_site_title}','{$name}，{$name}的歌曲，{$name} 的专辑','{$name}、{$name}的歌曲、{$name} 的专辑',0,1,1),(3,'艺人页面','home','artist','index','{$name}全部歌手 - {$web_site_title}','音乐人，音乐社区，{$web_site_title}，最新艺人，热门歌手','音乐人，音乐社区，{$web_site_title}，最新艺人，热门歌手',0,1,1),(4,'专辑页面','home','album','index','2017年发行专辑-{$web_site_title}','最新专辑,热门专辑,{$web_site_title}','2017年发行专辑列表-{$web_site_title}',0,1,1),(5,'专辑详情页面','home','album','read','{$name} - {$web_site_title}','{$name}，好听的{$name}，最新EP，{$user_name}分享的专辑','{$name}专辑、{$name}最新、{$name}、{$user_name}分享的专辑',0,1,1),(6,'音乐分类页面','home','genre','index','音乐分类 - {$web_site_title}','音乐分类，{$web_site_title}','音乐分类、风格分类、{$web_site_title}',0,1,1),(7,'音乐分类详细页面','home','genre','read','{$name} - {$web_site_title}','{$name}、{$web_site_keyword}','{$web_site_description}',0,1,1),(8,'音乐风格页面','home','tags','index','音乐风格-{$web_site_title}','音乐风格，音乐主题，{$web_site_title}}','音乐风格、音乐主题、{$web_site_title}}',0,1,1),(9,'音乐风格详情页','home','tags','read',' {$name}- {$web_site_title}','{$name}，音乐风格，音乐标签，音乐主题','音乐风格、音乐标签、{$web_site_title}',0,1,1),(10,'搜索页面','home','search','index','音乐搜索 - {$web_site_title}','{$web_site_keyword}','{$web_site_description}',0,1,1),(11,'音乐下载页面','home','music','down','{$name}下载  - {$web_site_title}','{$name}免费下载，好听的{$name}，舞曲{$name}免费下载，mp3免费下载','{$name}免费下载、好听的{$name}、舞曲{$name}免费下载、mp3免费下载',0,1,1),(12,'用户个人页','user','index','read','{$name} - 的个人主页 - {$web_site_title}','{$name} ， 的音乐空间 ， {$web_site_title}','{$name} 、 的音乐空间 、 {$web_site_title}',0,1,1),(13,'排行榜','home','ranks','index','音乐排行榜单 - {$web_site_title}','音乐排行榜单 ，{$web_site_keyword}','音乐排行榜单 、 {$web_site_keyword}',0,1,1),(14,'排行榜详情页','home','ranks','read','{$name} - 音乐排行 - {$web_site_title}','{$name} ，音乐排行， {$web_site_keyword}','{$name}、音乐排行 、{$web_site_keyword}',0,1,1),(15,'艺人歌曲页面','home','artist','songs','{$name}的歌曲 - {$web_site_title}','{$name}的歌曲，{$name}的全部歌曲，{$name} 最新歌曲','{$name}的歌曲、{$name}的全部歌曲、{$name}热门歌曲',0,1,1),(16,'艺人专辑页面','home','artist','albums','{$name} 的{$album_name} - {$web_site_title}','{$name}，{$name}的专辑，{$name} 的最新专辑','{$name}、{$name}专辑、{$name}最新专辑、{$web_site_title}',0,1,1);
/*!40000 ALTER TABLE `jy_seo_rule` ENABLE KEYS */;

#
# Structure for table "jy_server"
#

DROP TABLE IF EXISTS `jy_server`;
CREATE TABLE `jy_server` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` char(50) NOT NULL,
  `listen_url` varchar(255) NOT NULL,
  `down_url` varchar(255) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `create_time` int(10) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '服务器状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "jy_server"
#

/*!40000 ALTER TABLE `jy_server` DISABLE KEYS */;
/*!40000 ALTER TABLE `jy_server` ENABLE KEYS */;

#
# Structure for table "jy_site"
#

DROP TABLE IF EXISTS `jy_site`;
CREATE TABLE `jy_site` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '文档ID',
  `name` char(16) DEFAULT NULL,
  `pid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `appname` varchar(40) NOT NULL DEFAULT 'about',
  `content` text NOT NULL COMMENT '文档内容',
  `template` varchar(100) DEFAULT '' COMMENT '详情页显示模板',
  `update_time` int(11) NOT NULL,
  `create_time` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='文档模型下载表';

#
# Data for table "jy_site"
#

/*!40000 ALTER TABLE `jy_site` DISABLE KEYS */;
INSERT INTO `jy_site` VALUES (1,'about',0,'关于JYmusic','about','JYmusic是Php+Mysql开发的一款开源的跨平台音乐管理系统,采用国内最优秀php框架thinkphp。程序完全免费，稳定，易于扩展且具有超强大负载能力，完全可以满足音乐、DJ、音乐分享、音乐资讯站等使用。','',0,1466929310,1),(2,'copy',0,'版权声明','about','<p>\r\n\t<b>版权声明：</b>\r\n</p>\r\n<p>\r\n\t&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; JYmusic是一款 开源免费的音乐程序，我们致力解决广大音乐人，dj作者分享音乐，推广音乐的问题，免费不代表放纵\r\n</p>\r\n<p>\r\n\t&nbsp;&nbsp;&nbsp; &nbsp; 在没有我们许可的情况下你无权去除网页，以及源码内部版权信息，否者我将追击其法律责任\r\n</p>\r\n<p>\r\n\t&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 我们不希望你能回报我们。但是应该得到最起码的尊重，所以版权部分必须保留。\r\n</p>\r\n<br />\r\n<p>\r\n\t<b>联系方式:</b>\r\n</p>\r\n<p>\r\n\t联系<b>QQ:378020023</b>\r\n</p>','',0,1467107173,1),(3,'contact',0,'联系我们','about','<p>\r\n\t<b>歌曲收录</b><br />\r\n唱片公司或网络歌手发布最新歌曲，联系<b>QQ: 378020023</b>\r\n</p>\r\n<br />\r\n<p>\r\n\t<b>歌曲推广</b><br />\r\n歌曲、专辑首页图片或榜单推荐，联系<b>QQ: <b>378020023</b></b>\r\n</p>\r\n<br />\r\n<p>\r\n\t<b>友情连接</b><br />\r\n网站友情连接交换，联系<b>QQ: 37802023</b>\r\n</p>\r\n<br />\r\n<b>商务合作</b><br />\r\n品牌广告投放、版权合作，联系<b>QQ: <b>378020023</b></b>','',0,1467107359,1),(4,'link',0,'友情连接','about','<p>\r\n\t<b>友情连接要求：</b> \r\n</p>\r\n<p>\r\n\t1、LOGO大小：90*30\r\n</p>\r\n<p>\r\n\t2、违反我国现行法律的或含有令人不愉快内容的网站勿扰；\r\n</p>\r\n<p>\r\n\t3、网站Alexa排名不低于10000名；\r\n</p>\r\n<p>\r\n\t4、网站Google pagerank不少于3；\r\n</p>\r\n<p>\r\n\t5、友情链接网站之间有义务向对方报告链接失效，文字、图片更新等问题，在解除友情链接之前亦应该通知对方；\r\n</p>\r\n<br />\r\n<p>\r\n\t<b>友情连接联系QQ:378020023</b> \r\n</p>','',0,1467107430,1),(5,'reg',0,'如何注册','help','点击上方注册按钮','',0,1467110133,1),(6,'questions',0,'常见问题','help','常见问题','',0,1467113553,1),(7,'feedback',0,'反馈建议','help','反馈建议','',0,1467113865,1),(8,'ver',0,'认证音乐人','help','认证音乐人','',0,1467114053,1);
/*!40000 ALTER TABLE `jy_site` ENABLE KEYS */;

#
# Structure for table "jy_slider"
#

DROP TABLE IF EXISTS `jy_slider`;
CREATE TABLE `jy_slider` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` varchar(80) NOT NULL DEFAULT '' COMMENT '标题',
  `type` tinyint(2) NOT NULL DEFAULT '1' COMMENT '幻灯片类型',
  `cover_url` varchar(255) NOT NULL DEFAULT '' COMMENT '图片链接地址',
  `link_title` varchar(80) NOT NULL DEFAULT '' COMMENT '链接标题',
  `link` char(140) NOT NULL DEFAULT '' COMMENT '链接地址',
  `level` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '优先级',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态（0：禁用，1：正常）',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='幻灯片表';

#
# Data for table "jy_slider"
#

/*!40000 ALTER TABLE `jy_slider` DISABLE KEYS */;
INSERT INTO `jy_slider` VALUES (1,'黑胶制造',1,'http://ugc.cdn.qianqian.com/yinyueren/pic/cf602a2aeed378b781d6.jpg@w_1220,d_progressive','','http://www.jyuu.cn',0,'黑胶制造',1,1466654916,1497952936),(2,'测试幻灯片2',1,'http://ugc.cdn.qianqian.com/yinyueren/pic/cf602a2aeed378b781d6.jpg@w_1220,d_progressive','黑胶','http://v2.dev/',0,'测试幻灯片2',1,0,0),(3,'资讯页面幻灯片',2,'http://p9.pstatp.com/origin/2c6e0014544597a0cdf8','','http://jyuu.cn',0,'',1,1500825872,1500825872),(4,'资讯幻灯片2',2,'http://p3.pstatp.com/origin/2c610014509c89fdeb02','','http://jyuu.cn',0,'',1,1500826063,1500826071);
/*!40000 ALTER TABLE `jy_slider` ENABLE KEYS */;

#
# Structure for table "jy_songs"
#

DROP TABLE IF EXISTS `jy_songs`;
CREATE TABLE `jy_songs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '歌曲ID',
  `name` char(120) NOT NULL COMMENT '歌曲名字',
  `genre_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '所属分类ID',
  `album_id` int(11) NOT NULL DEFAULT '0' COMMENT '所属专辑ID',
  `album_name` varchar(80) DEFAULT '未知' COMMENT '所属专辑',
  `order_id` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '专辑里的顺序',
  `artist_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属歌手ID',
  `artist_name` varchar(80) NOT NULL DEFAULT '未知' COMMENT '所属歌手',
  `tags` varchar(255) DEFAULT NULL COMMENT '所属标签',
  `cover_url` varchar(255) DEFAULT NULL COMMENT '封面地址',
  `cover_id` int(11) DEFAULT '0',
  `up_uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上传者ID',
  `up_uname` varchar(20) DEFAULT NULL COMMENT '上传者名字',
  `rank_id` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `digg` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '顶',
  `bury` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '踩',
  `download` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '下载次数',
  `rater` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '评分',
  `listens` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '总试听次数',
  `position` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '推荐位',
  `favtimes` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '收藏次数',
  `likes` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '喜欢',
  `score` int(10) unsigned DEFAULT '0' COMMENT '下载积分',
  `coin` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '下载金币',
  `comment` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '评论次数',
  `sing` char(40) DEFAULT NULL COMMENT '原唱',
  `lyrics` char(40) DEFAULT NULL COMMENT '作词',
  `composer` char(40) DEFAULT NULL COMMENT '作曲',
  `midi` char(40) DEFAULT NULL COMMENT '编曲',
  `mix` char(40) DEFAULT NULL COMMENT '混编',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(10) unsigned NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '2' COMMENT '状态',
  PRIMARY KEY (`id`),
  KEY `genre_id` (`genre_id`),
  KEY `album_id` (`album_id`),
  KEY `artist_id` (`artist_id`),
  KEY `listens` (`listens`),
  KEY `position` (`position`),
  KEY `favtimes` (`favtimes`),
  KEY `likes` (`likes`),
  KEY `rank_id` (`rank_id`),
  KEY `status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "jy_songs"
#

/*!40000 ALTER TABLE `jy_songs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jy_songs` ENABLE KEYS */;

#
# Structure for table "jy_songs_extend"
#

DROP TABLE IF EXISTS `jy_songs_extend`;
CREATE TABLE `jy_songs_extend` (
  `mid` int(11) unsigned NOT NULL COMMENT '歌曲id',
  `server_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '服务器网址',
  `listen_url` varchar(255) NOT NULL COMMENT '试听地址',
  `down_url` varchar(255) DEFAULT NULL COMMENT '下载地址',
  `listen_file_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '试听文件id',
  `down_file_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '下载文件id',
  `listen_file_size` char(16) NOT NULL DEFAULT '0' COMMENT '文件大小',
  `down_file_size` char(16) NOT NULL DEFAULT '0',
  `play_time` char(10) DEFAULT NULL COMMENT '播放时长',
  `listen_bitrate` char(10) NOT NULL DEFAULT '0' COMMENT '比特率',
  `down_bitrate` char(10) NOT NULL DEFAULT '0',
  `disk_url` varchar(255) DEFAULT NULL COMMENT '网盘下载吗',
  `disk_pass` char(10) DEFAULT NULL COMMENT '网盘密码',
  `down_rule` varchar(255) DEFAULT NULL,
  `lrc` text COMMENT '歌词',
  `introduce` text COMMENT '灵感',
  PRIMARY KEY (`mid`),
  UNIQUE KEY `mid` (`mid`),
  KEY `bitrate` (`listen_bitrate`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "jy_songs_extend"
#

/*!40000 ALTER TABLE `jy_songs_extend` DISABLE KEYS */;
/*!40000 ALTER TABLE `jy_songs_extend` ENABLE KEYS */;

#
# Structure for table "jy_songs_fav"
#

DROP TABLE IF EXISTS `jy_songs_fav`;
CREATE TABLE `jy_songs_fav` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `songs_id` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `music_id` (`songs_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "jy_songs_fav"
#

/*!40000 ALTER TABLE `jy_songs_fav` DISABLE KEYS */;
/*!40000 ALTER TABLE `jy_songs_fav` ENABLE KEYS */;

#
# Structure for table "jy_songs_tags"
#

DROP TABLE IF EXISTS `jy_songs_tags`;
CREATE TABLE `jy_songs_tags` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `songs_id` int(11) NOT NULL,
  `tags_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `music_id` (`songs_id`),
  KEY `tag_id` (`tags_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "jy_songs_tags"
#

/*!40000 ALTER TABLE `jy_songs_tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `jy_songs_tags` ENABLE KEYS */;

#
# Structure for table "jy_sync_login"
#

DROP TABLE IF EXISTS `jy_sync_login`;
CREATE TABLE `jy_sync_login` (
  `login_id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户id',
  `type` char(16) NOT NULL COMMENT '第三方类型',
  `openid` char(150) NOT NULL COMMENT '授权用户唯一标识',
  `unionid` varchar(150) DEFAULT NULL COMMENT '微信专用',
  `access_token` varchar(150) NOT NULL COMMENT '授权凭证',
  `refresh_token` varchar(150) DEFAULT NULL COMMENT '用户刷新access_token',
  `expires_time` varchar(150) NOT NULL COMMENT '凭证到期时间',
  `is_sync` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否同步',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '授权状态',
  PRIMARY KEY (`login_id`),
  KEY `access_token` (`access_token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "jy_sync_login"
#

/*!40000 ALTER TABLE `jy_sync_login` DISABLE KEYS */;
/*!40000 ALTER TABLE `jy_sync_login` ENABLE KEYS */;

#
# Structure for table "jy_tags"
#

DROP TABLE IF EXISTS `jy_tags`;
CREATE TABLE `jy_tags` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '标签id',
  `name` char(20) NOT NULL COMMENT '标签名称',
  `alias` char(30) DEFAULT NULL COMMENT '别名',
  `sort` smallint(6) NOT NULL DEFAULT '0' COMMENT '排序',
  `group` tinyint(4) NOT NULL DEFAULT '0' COMMENT '所属标签组',
  `hits` int(11) NOT NULL DEFAULT '0' COMMENT '标签点击量',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态',
  PRIMARY KEY (`id`),
  UNIQUE KEY `alias` (`alias`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

#
# Data for table "jy_tags"
#

/*!40000 ALTER TABLE `jy_tags` DISABLE KEYS */;
INSERT INTO `jy_tags` VALUES (1,'华语','huayu',0,1,0,1421937602,1497268514,1),(2,'欧美','oumei',0,1,0,1421937602,1497268534,1),(3,'日语','riyu',0,1,0,1421937602,1497268552,1),(4,'韩语','hanyu',0,1,0,1421937602,1497268574,1),(5,'方言','fangyan',0,1,0,1421937602,1497268597,1),(6,'小语种','xiaoyuzhong',0,1,0,1421937602,1497268612,1),(7,'流行','liuxing',0,2,0,1422421305,1497268640,1),(8,'摇滚','yaogun',0,2,0,1465882231,1497268670,1),(9,'民谣','minyao',0,2,100,1465882279,1497268694,1),(10,'电子','dianzi',0,2,0,1465882315,1497268709,1),(11,'舞曲','wuqu',0,2,0,1465882328,1497268725,1),(12,'说唱','shuochang',0,2,10,1465882385,1497268744,1),(13,'轻音乐','qingyinle',0,2,0,1465882393,1497268759,1),(14,'爵士','jueshi',0,2,0,1465882408,1497268782,1),(15,'乡村','xiangcun',0,2,0,1465882431,1497268800,1),(16,'R&B','rb',0,2,0,1465882439,1497268839,1),(17,'古典','gudian',0,2,0,1465882451,1497268856,1),(18,'民族','minzu',0,2,0,1465882458,1497268889,1),(19,'英伦','yinglun',0,2,0,1465882468,1497268909,1),(20,'古风','gufeng',0,2,0,1465882479,1497268960,1),(21,'独立','duli',0,2,0,1465882490,1497268972,1),(22,'想哭','xiangku',0,4,1000,1465882507,1497269001,1),(23,'寂寞','jimo',0,4,0,1465882516,1497269008,1),(24,'忧伤','youshang',0,4,0,1465882526,1497269014,1),(25,'浪漫','langman',0,4,0,1465882533,1497269020,1),(26,'甜蜜','tianmi',0,4,0,1465882563,1497269028,1),(27,'思念','sinian',0,4,0,1465882571,1497269036,1),(28,'感动','gandong',0,4,0,1465882585,1497269046,1),(29,'清晨','qingchen',0,3,0,1497269127,1497269127,1),(30,'夜晚','yewan',0,3,0,1497269153,1497269153,1),(31,'驾车','jiache',0,3,0,1497269202,1497269202,1),(32,'运动','yundong',0,3,0,1497269223,1497269223,1),(33,'旅行','lvxing',0,3,0,1497269239,1497269239,1),(34,'散步','sanbu',0,3,0,1497269263,1497269263,1),(35,'酒吧','jiuba',0,3,0,1497269273,1497269273,1),(36,'原生音乐','yuanshengyinle',0,5,300,1497269299,1497269299,1),(37,'ACG','acg',0,5,0,1497269321,1497269628,1),(38,'校园','xiaoyuan',0,5,0,1497269666,1497269666,1),(39,'游戏','youxi',0,5,0,1497269680,1497269680,1),(40,'经典','jingdian',0,5,0,1497269702,1497269702,1),(41,'网络','wangluo',0,5,0,1497269767,1497269767,1),(42,'70后','70hou',0,6,0,1497269791,1497269791,1),(43,'80后','80hou',0,6,0,1497269802,1497269802,1),(44,'90后','90hou',0,1,0,1497269820,1497269820,1),(45,'00后','00hou',0,6,0,1497269831,1497269831,1),(46,'10后','10hou',0,6,0,1497269848,1497269848,1);
/*!40000 ALTER TABLE `jy_tags` ENABLE KEYS */;

#
# Structure for table "jy_ucenter_member"
#

DROP TABLE IF EXISTS `jy_ucenter_member`;
CREATE TABLE `jy_ucenter_member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `username` char(16) NOT NULL COMMENT '用户名',
  `password` char(32) NOT NULL COMMENT '密码',
  `email` char(32) DEFAULT NULL COMMENT '用户邮箱',
  `mobile` char(15) DEFAULT NULL COMMENT '用户手机',
  `reg_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '注册时间',
  `reg_ip` bigint(20) NOT NULL DEFAULT '0' COMMENT '注册IP',
  `last_login_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `last_login_ip` bigint(20) NOT NULL DEFAULT '0' COMMENT '最后登录IP',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) DEFAULT '0' COMMENT '用户状态',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='用户表';

#
# Data for table "jy_ucenter_member"
#

/*!40000 ALTER TABLE `jy_ucenter_member` DISABLE KEYS */;
INSERT INTO `jy_ucenter_member` VALUES (1,'admin','','admin@admin.com',NULL,1563961105,2130706433,1563961122,2130706433,0,1);
/*!40000 ALTER TABLE `jy_ucenter_member` ENABLE KEYS */;

#
# Structure for table "jy_user_down"
#

DROP TABLE IF EXISTS `jy_user_down`;
CREATE TABLE `jy_user_down` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `songs_id` int(11) NOT NULL,
  `user_ip` bigint(20) NOT NULL,
  `count` int(10) NOT NULL DEFAULT '1' COMMENT '下载次数',
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `music_id` (`songs_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "jy_user_down"
#

/*!40000 ALTER TABLE `jy_user_down` DISABLE KEYS */;
/*!40000 ALTER TABLE `jy_user_down` ENABLE KEYS */;

#
# Structure for table "jy_user_follow"
#

DROP TABLE IF EXISTS `jy_user_follow`;
CREATE TABLE `jy_user_follow` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '粉丝表ID',
  `uid` int(11) unsigned NOT NULL COMMENT '被关注者',
  `follow_uid` int(11) NOT NULL COMMENT '被关注者昵称',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `follow_uid` (`follow_uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "jy_user_follow"
#

/*!40000 ALTER TABLE `jy_user_follow` DISABLE KEYS */;
/*!40000 ALTER TABLE `jy_user_follow` ENABLE KEYS */;
