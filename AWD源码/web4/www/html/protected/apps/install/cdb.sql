/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50051
Source Host           : localhost:3306
Source Database       : newyxcms

Target Server Type    : MYSQL
Target Server Version : 50051
File Encoding         : 65001

Date: 2013-07-15 10:14:56
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `yx_admin`
-- ----------------------------
DROP TABLE IF EXISTS `yx_admin`;
CREATE TABLE `yx_admin` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `groupid` tinyint(4) NOT NULL default '1',
  `username` char(10) NOT NULL,
  `realname` char(15) NOT NULL,
  `password` char(32) NOT NULL,
  `lastlogin_time` int(10) unsigned NOT NULL,
  `lastlogin_ip` char(15) NOT NULL,
  `iflock` tinyint(1) unsigned NOT NULL default '0',
  `sortpower` text NOT NULL,
  `extendpower` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `usename` (`username`),
  KEY `groupid` (`groupid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='管理员信息表';

-- ----------------------------
-- Records of yx_admin
-- ----------------------------
INSERT INTO `yx_admin` VALUES ('1', '1', 'admin', 'YX', '168a73655bfecefdb15b14984dd2ad60', '1373852201', '127.0.0.1', '0', '', '');

-- ----------------------------
-- Table structure for `yx_extend`
-- ----------------------------
DROP TABLE IF EXISTS `yx_extend`;
CREATE TABLE `yx_extend` (
  `id` int(10) NOT NULL auto_increment,
  `pid` int(10) default '0',
  `tableinfo` varchar(255) default NULL,
  `type` int(4) default '0',
  `defvalue` varchar(255) default NULL,
  `name` varchar(255) default NULL,
  `ifsearch` tinyint(1) NOT NULL default '0',
  `norder` int(5) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
-- ----------------------------
-- Records of yx_extend
-- ----------------------------
INSERT INTO `yx_extend` VALUES ('7', '0', 'extend_conment', '1', '', '内容评论', '0', '0');
INSERT INTO `yx_extend` VALUES ('8', '7', 'aid', '1', '0', '资讯id', '0', '2');
INSERT INTO `yx_extend` VALUES ('9', '7', 'comby', '1', '', '评论者', '0', '4');
INSERT INTO `yx_extend` VALUES ('10', '7', 'comcontent', '3', '', '评论内容', '0', '3');
INSERT INTO `yx_extend` VALUES ('11', '7', 'type', '1', '0', '类型', '0', '1');
INSERT INTO `yx_extend` VALUES ('12', '0', 'extend_guestbook', '1', '', '留言本', '0', '0');
INSERT INTO `yx_extend` VALUES ('13', '12', 'tname', '1', '', '姓名', '0', '0');
INSERT INTO `yx_extend` VALUES ('14', '12', 'tel', '1', '', '电话', '0', '0');
INSERT INTO `yx_extend` VALUES ('15', '12', 'qq', '1', '', 'QQ', '0', '0');
INSERT INTO `yx_extend` VALUES ('16', '12', 'content', '3', '', '留言内容', '0', '0');
INSERT INTO `yx_extend` VALUES ('17', '12', 'reply', '2', '', '回复内容', '0', '0');
INSERT INTO `yx_extend` VALUES ('18', '7', 'title', '2', '', '标题', '0', '5');
INSERT INTO `yx_extend` VALUES ('19', '7', 'sortname', '1', '', '栏目名称', '0', '6');
INSERT INTO `yx_extend` VALUES ('20', '7', 'backcontent', '2', '', '评论回复', '0', '0');
-- ----------------------------
-- Table structure for `yx_extend_conment`
-- ----------------------------
DROP TABLE IF EXISTS `yx_extend_conment`;
CREATE TABLE `yx_extend_conment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `addtime` int(11) NOT NULL,
  `ip` varchar(16) NOT NULL,
  `ispass` tinyint(1) NOT NULL,
  `aid` varchar(250) NOT NULL,
  `comby` varchar(250) NOT NULL,
  `comcontent` text NOT NULL,
  `type` varchar(250) NOT NULL,
  `title` varchar(250) NOT NULL,
  `sortname` varchar(250) NOT NULL,
  `backcontent` varchar(250) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yx_extend_conment
-- ----------------------------

-- ----------------------------
-- Table structure for `yx_extend_guestbook`
-- ----------------------------
DROP TABLE IF EXISTS `yx_extend_guestbook`;
CREATE TABLE `yx_extend_guestbook` (
  `id` int(11) NOT NULL auto_increment,
  `addtime` int(11) NOT NULL,
  `ip` varchar(16) NOT NULL,
  `ispass` tinyint(1) NOT NULL,
  `tname` varchar(250) NOT NULL,
  `tel` varchar(250) NOT NULL,
  `qq` varchar(250) NOT NULL,
  `content` text NOT NULL,
  `reply` varchar(250) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yx_extend_guestbook
-- ----------------------------

-- ----------------------------
-- Table structure for `yx_fragment`
-- ----------------------------
DROP TABLE IF EXISTS `yx_fragment`;
CREATE TABLE `yx_fragment` (
  `id` int(10) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `sign` varchar(255) NOT NULL COMMENT '前台调用标记',
  `content` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `yx_group`
-- ----------------------------
DROP TABLE IF EXISTS `yx_group`;
CREATE TABLE `yx_group` (
  `id` tinyint(3) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `power` varchar(1000) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yx_group
-- ----------------------------
INSERT INTO `yx_group` VALUES ('1', '超级管理员', '-1');
INSERT INTO `yx_group` VALUES ('2', '网站编辑', '283,1,228,10,11,12,13,14,15,16,157,158,174,268,288,317,22,23,24,25,26,27,150,151,152,153,154,155,156,159,160,269,289,290,291,318,188,189,190,191,192,229,238,239,240,241,243,244,308,309,310,311,312,313');

-- ----------------------------
-- Table structure for `yx_link`
-- ----------------------------
DROP TABLE IF EXISTS `yx_link`;
CREATE TABLE `yx_link` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `groupname` varchar(255) NOT NULL,
  `norder` int(5) NOT NULL COMMENT '排序',
  `name` varchar(30) NOT NULL COMMENT '站点名',
  `url` varchar(300) NOT NULL COMMENT '站点地址',
  `picture` varchar(30) NOT NULL COMMENT '本地logo',
  `logourl` varchar(50) NOT NULL COMMENT '远程logo',
  `info` varchar(300) NOT NULL COMMENT '介绍',
  `ispass` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


-- ----------------------------
-- Table structure for `yx_members`
-- ----------------------------
DROP TABLE IF EXISTS `yx_members`;
CREATE TABLE `yx_members` (
  `id` int(20) NOT NULL auto_increment,
  `groupid` int(3) NOT NULL,
  `account` varchar(30) NOT NULL,
  `openid` varchar(32) NOT NULL,
  `password` varchar(60) NOT NULL,
  `rmb` int(8) NOT NULL default '0',
  `crmb` int(8) NOT NULL default '0',
  `nickname` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `tel` varchar(15) NOT NULL,
  `qq` varchar(20) NOT NULL,
  `headpic` varchar(80) NOT NULL,
  `regtime` int(11) NOT NULL,
  `regip` varchar(16) NOT NULL,
  `lasttime` int(11) NOT NULL,
  `lastip` varchar(16) NOT NULL,
  `islock` tinyint(4) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `yx_member_group`
-- ----------------------------
DROP TABLE IF EXISTS `yx_member_group`;
CREATE TABLE `yx_member_group` (
  `id` int(3) NOT NULL auto_increment,
  `name` varchar(30) NOT NULL,
  `notallow` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yx_member_group
-- ----------------------------
INSERT INTO `yx_member_group` VALUES ('1', '未登录', 'member/infor|member/order|member/news|member/photo');
INSERT INTO `yx_member_group` VALUES ('2', '普通会员', '');

-- ----------------------------
-- Table structure for `yx_method`
-- ----------------------------
DROP TABLE IF EXISTS `yx_method`;
CREATE TABLE `yx_method` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `rootid` int(10) unsigned NOT NULL,
  `pid` float unsigned NOT NULL,
  `operate` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `ifmenu` tinyint(1) NOT NULL default '0' COMMENT '是否菜单显示',
  PRIMARY KEY  (`id`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM AUTO_INCREMENT=331 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yx_method
-- ----------------------------
INSERT INTO `yx_method` VALUES ('1', '1', '0', 'admin', '后台登陆管理', '1');
INSERT INTO `yx_method` VALUES ('2', '1', '1', 'index', '管理员管理', '1');
INSERT INTO `yx_method` VALUES ('4', '1', '1', 'admindel', '管理员删除', '0');
INSERT INTO `yx_method` VALUES ('5', '1', '1', 'adminedit', '管理员编辑', '0');
INSERT INTO `yx_method` VALUES ('6', '1', '1', 'adminlock', '管理员锁定', '0');
INSERT INTO `yx_method` VALUES ('7', '1', '1', 'group', '权限管理', '1');
INSERT INTO `yx_method` VALUES ('8', '1', '1', 'groupedit', '管理组编辑', '0');
INSERT INTO `yx_method` VALUES ('9', '1', '1', 'groupdel', '管理组删除', '0');
INSERT INTO `yx_method` VALUES ('10', '10', '0', 'news', '资讯管理', '1');
INSERT INTO `yx_method` VALUES ('11', '10', '10', 'index', '已有资讯', '1');
INSERT INTO `yx_method` VALUES ('12', '10', '10', 'add', '添加资讯', '1');
INSERT INTO `yx_method` VALUES ('13', '10', '10', 'edit', '资讯编辑', '0');
INSERT INTO `yx_method` VALUES ('14', '10', '10', 'del', '资讯删除', '0');
INSERT INTO `yx_method` VALUES ('15', '10', '10', 'lock', '资讯锁定', '0');
INSERT INTO `yx_method` VALUES ('16', '10', '10', 'recmd', '资讯推荐', '0');
INSERT INTO `yx_method` VALUES ('17', '17', '0', 'dbback', '数据库管理', '1');
INSERT INTO `yx_method` VALUES ('18', '17', '17', 'index', '数据库备份', '1');
INSERT INTO `yx_method` VALUES ('19', '17', '17', 'recover', '备份恢复', '0');
INSERT INTO `yx_method` VALUES ('20', '17', '17', 'detail', '备份详细', '0');
INSERT INTO `yx_method` VALUES ('21', '17', '17', 'del', '备份删除', '0');
INSERT INTO `yx_method` VALUES ('22', '22', '0', 'index', '后台面板', '0');
INSERT INTO `yx_method` VALUES ('23', '22', '22', 'index', '后台首页', '0');
INSERT INTO `yx_method` VALUES ('24', '22', '22', 'login', '登陆', '0');
INSERT INTO `yx_method` VALUES ('25', '22', '22', 'logout', '退出登陆', '0');
INSERT INTO `yx_method` VALUES ('26', '22', '22', 'verify', '验证码', '0');
INSERT INTO `yx_method` VALUES ('27', '22', '22', 'welcome', '服务器环境', '0');
INSERT INTO `yx_method` VALUES ('28', '28', '0', 'set', '全局设置', '1');
INSERT INTO `yx_method` VALUES ('29', '28', '28', 'index', '网站设置', '1');
INSERT INTO `yx_method` VALUES ('30', '30', '0', 'sort', '分类管理', '1');
INSERT INTO `yx_method` VALUES ('31', '30', '30', 'index', '栏目列表', '1');
INSERT INTO `yx_method` VALUES ('32', '30', '30', 'edit', '分类编辑', '0');
INSERT INTO `yx_method` VALUES ('33', '30', '30', 'del', '分类删除', '0');
INSERT INTO `yx_method` VALUES ('160', '150', '150', 'delpic', '图集单张图删除', '0');
INSERT INTO `yx_method` VALUES ('277', '0', '0', 'appmanage', '应用管理', '1');
INSERT INTO `yx_method` VALUES ('85', '28', '28', 'menuname', '后台功能', '1');
INSERT INTO `yx_method` VALUES ('159', '150', '150', 'images_upload', '图片批量上传', '0');
INSERT INTO `yx_method` VALUES ('158', '10', '10', 'FileManagerJson', '编辑器上传管理', '0');
INSERT INTO `yx_method` VALUES ('157', '10', '10', 'UploadJson', '编辑器上传', '0');
INSERT INTO `yx_method` VALUES ('150', '150', '0', 'photo', '图集管理', '1');
INSERT INTO `yx_method` VALUES ('151', '150', '150', 'index', '已有图集', '1');
INSERT INTO `yx_method` VALUES ('152', '150', '150', 'add', '添加图集', '1');
INSERT INTO `yx_method` VALUES ('153', '150', '150', 'edit', '图集编辑', '0');
INSERT INTO `yx_method` VALUES ('154', '150', '150', 'del', '图集删除', '0');
INSERT INTO `yx_method` VALUES ('155', '150', '150', 'lock', '图集锁定', '0');
INSERT INTO `yx_method` VALUES ('156', '150', '150', 'recmd', '图集推荐', '0');
INSERT INTO `yx_method` VALUES ('174', '10', '10', 'cutcover', '封面图剪切', '0');
INSERT INTO `yx_method` VALUES ('236', '30', '30', 'PageUploadJson', '单页上传', '0');
INSERT INTO `yx_method` VALUES ('235', '30', '30', 'pageedit', '单页编辑', '0');
INSERT INTO `yx_method` VALUES ('234', '30', '30', 'pageadd', '添加单页栏目', '0');
INSERT INTO `yx_method` VALUES ('233', '30', '30', 'photoedit', '图集栏目编辑', '0');
INSERT INTO `yx_method` VALUES ('232', '30', '30', 'photoadd', '添加图集栏目', '0');
INSERT INTO `yx_method` VALUES ('231', '30', '30', 'newsedit', '文章栏目编辑', '0');
INSERT INTO `yx_method` VALUES ('230', '30', '30', 'newsadd', '添加文章栏目', '0');
INSERT INTO `yx_method` VALUES ('182', '28', '28', 'clear', '网站缓存', '1');
INSERT INTO `yx_method` VALUES ('188', '188', '0', 'link', '友情链接', '1');
INSERT INTO `yx_method` VALUES ('189', '188', '188', 'index', '链接列表', '1');
INSERT INTO `yx_method` VALUES ('190', '188', '188', 'add', '添加链接', '1');
INSERT INTO `yx_method` VALUES ('191', '188', '188', 'edit', '链接编辑', '0');
INSERT INTO `yx_method` VALUES ('192', '188', '188', 'del', '链接删除', '0');
INSERT INTO `yx_method` VALUES ('228', '1', '1', 'adminnow', '账户管理', '1');
INSERT INTO `yx_method` VALUES ('229', '188', '188', 'lock', '锁定', '0');
INSERT INTO `yx_method` VALUES ('237', '30', '30', 'PageFileManagerJson', '单页上传管理', '0');
INSERT INTO `yx_method` VALUES ('238', '238', '0', 'fragment', '碎片管理', '1');
INSERT INTO `yx_method` VALUES ('239', '238', '238', 'index', '碎片列表', '1');
INSERT INTO `yx_method` VALUES ('240', '238', '238', 'add', '碎片添加', '1');
INSERT INTO `yx_method` VALUES ('241', '238', '238', 'edit', '碎片编辑', '0');
INSERT INTO `yx_method` VALUES ('242', '238', '238', 'del', '碎片删除', '0');
INSERT INTO `yx_method` VALUES ('243', '238', '238', 'UploadJson', '编辑器上传', '0');
INSERT INTO `yx_method` VALUES ('244', '238', '238', 'FileManagerJson', '编辑器上传管理', '0');
INSERT INTO `yx_method` VALUES ('245', '28', '28', 'tpchange', '前台模板', '1');
INSERT INTO `yx_method` VALUES ('251', '30', '30', 'pluginadd', '添加应用栏目', '0');
INSERT INTO `yx_method` VALUES ('252', '30', '30', 'pluginedit', '应用栏目编辑', '0');
INSERT INTO `yx_method` VALUES ('258', '258', '0', 'extendfield', '自定义表', '1');
INSERT INTO `yx_method` VALUES ('259', '258', '258', 'index', '自定义表列表', '1');
INSERT INTO `yx_method` VALUES ('260', '258', '258', 'tableadd', '添加自定义表', '1');
INSERT INTO `yx_method` VALUES ('261', '258', '258', 'tableedit', '拓展表编辑', '0');
INSERT INTO `yx_method` VALUES ('262', '258', '258', 'tabledel', '拓展表删除', '0');
INSERT INTO `yx_method` VALUES ('263', '258', '258', 'fieldlist', '字段列表', '0');
INSERT INTO `yx_method` VALUES ('264', '258', '258', 'fieldadd', '添加字段', '0');
INSERT INTO `yx_method` VALUES ('265', '258', '258', 'fieldedit', '编辑字段', '0');
INSERT INTO `yx_method` VALUES ('266', '258', '258', 'fielddel', '字段删除', '0');
INSERT INTO `yx_method` VALUES ('267', '258', '258', 'file', '文件上传', '0');
INSERT INTO `yx_method` VALUES ('268', '10', '10', 'ex_field', '字段拓展', '0');
INSERT INTO `yx_method` VALUES ('269', '150', '150', 'ex_field', '字段拓展', '0');
INSERT INTO `yx_method` VALUES ('270', '30', '30', 'linkadd', '添加自定义栏目', '0');
INSERT INTO `yx_method` VALUES ('271', '30', '30', 'linkedit', '自定义栏目编辑', '0');
INSERT INTO `yx_method` VALUES ('283', '0', '0', 'member', '会员管理(应用)', '1');
INSERT INTO `yx_method` VALUES ('288', '10', '10', 'colchange', '资讯转移栏目', '0');
INSERT INTO `yx_method` VALUES ('289', '150', '150', 'colchange', '图集转移栏目', '0');
INSERT INTO `yx_method` VALUES ('290', '150', '150', 'UploadJson', '图集编辑器上传', '0');
INSERT INTO `yx_method` VALUES ('291', '150', '150', 'FileManagerJson', '图集编辑器上传管理', '0');
INSERT INTO `yx_method` VALUES ('292', '28', '28', 'tplist', '模板文件列表', '0');
INSERT INTO `yx_method` VALUES ('293', '28', '28', 'tpadd', '模板文件添加', '0');
INSERT INTO `yx_method` VALUES ('294', '28', '28', 'tpedit', '模板文件编辑', '0');
INSERT INTO `yx_method` VALUES ('295', '28', '28', 'tpdel', '删除模板文件', '0');
INSERT INTO `yx_method` VALUES ('296', '28', '28', 'tpgetcode', '获取模板内容', '0');
INSERT INTO `yx_method` VALUES ('297', '258', '258', 'meslist', '自定义表信息', '0');
INSERT INTO `yx_method` VALUES ('298', '258', '258', 'mesedit', '自定义表信息添加', '0');
INSERT INTO `yx_method` VALUES ('299', '258', '258', 'mesedit', '自定义表信息编辑', '0');
INSERT INTO `yx_method` VALUES ('300', '258', '258', 'mesdel', '自定义表信息删除', '0');
INSERT INTO `yx_method` VALUES ('331', '258', '258', 'meslock', '自定义表信息审核', '0');
INSERT INTO `yx_method` VALUES ('301', '30', '30', 'add', '添加栏目', '1');
INSERT INTO `yx_method` VALUES ('302', '30', '30', 'extendadd', '添加表单栏目', '0');
INSERT INTO `yx_method` VALUES ('303', '30', '30', 'extendedit', '表单栏目编辑', '0');
INSERT INTO `yx_method` VALUES ('304', '30', '30', 'placelist', '内容定位列表', '1');
INSERT INTO `yx_method` VALUES ('305', '30', '30', 'placeadd', '添加内容定位', '1');
INSERT INTO `yx_method` VALUES ('306', '30', '30', 'placeedit', '定位编辑', '0');
INSERT INTO `yx_method` VALUES ('307', '30', '30', 'placedel', '定位删除', '0');
INSERT INTO `yx_method` VALUES ('308', '308', '0', 'tags', 'TAG标签', '1');
INSERT INTO `yx_method` VALUES ('309', '308', '308', 'index', '标签列表', '1');
INSERT INTO `yx_method` VALUES ('310', '308', '308', 'del', '删除标签', '0');
INSERT INTO `yx_method` VALUES ('311', '308', '308', 'hits', '编辑点击量', '0');
INSERT INTO `yx_method` VALUES ('312', '308', '308', 'add', '生成标签', '1');
INSERT INTO `yx_method` VALUES ('313', '308', '308', 'mesup', '文档数量更新', '0');
INSERT INTO `yx_method` VALUES ('314', '314', '0', 'files', '附件管理', '1');
INSERT INTO `yx_method` VALUES ('315', '314', '314', 'index', '上传文件管理', '1');
INSERT INTO `yx_method` VALUES ('316', '314', '314', 'del', '删除文件', '0');
INSERT INTO `yx_method` VALUES ('317', '10', '10', 'orderchange', '列表ajax排序', '0');
INSERT INTO `yx_method` VALUES ('318', '150', '150', 'orderchange', '列表ajax排序', '0');
INSERT INTO `yx_method` VALUES ('319', '30', '30', 'orderchange', '列表ajax排序', '0');
INSERT INTO `yx_method` VALUES ('320', '17', '17', 'sqlrun', 'SQL执行', '1');
INSERT INTO `yx_method` VALUES ('321', '30', '30', 'cutcover', '栏目封面剪切', '0');
INSERT INTO `yx_method` VALUES ('322', '238', '238', 'saveimage', '图片本地化', '0');
INSERT INTO `yx_method` VALUES ('323', '10', '10', 'saveimage', '图片本地化', '0');
INSERT INTO `yx_method` VALUES ('324', '10', '10', 'delcover', '删除封面图', '0');
INSERT INTO `yx_method` VALUES ('325', '30', '30', 'delcover', '删除封面图', '0');
INSERT INTO `yx_method` VALUES ('326', '30', '30', 'pagesaveimage', '图片本地化', '0');
INSERT INTO `yx_method` VALUES ('328', '30', '30', 'sortsmove', '栏目批量移动', '0');
INSERT INTO `yx_method` VALUES ('329', '30', '30', 'sortsedit', '栏目批量编辑', '0');
INSERT INTO `yx_method` VALUES ('330', '30', '30', 'ifmenu', '栏目设置隐藏', '0');
INSERT INTO `yx_method` VALUES ('332', '258', '258', 'mesadd', '自定义表添加信息', '0');
INSERT INTO `yx_method` VALUES ('333', '308', '308', 'hadd', '手动添加标签', '0');
INSERT INTO `yx_method` VALUES ('334', '308', '308', 'edit', '标签编辑', '0');

-- ----------------------------
-- Table structure for `yx_news`
-- ----------------------------
DROP TABLE IF EXISTS `yx_news`;
CREATE TABLE `yx_news` (
  `id` int(20) NOT NULL auto_increment,
  `sort` varchar(350) NOT NULL COMMENT '类别',
  `exsort` varchar(350) NOT NULL,
  `account` char(15) NOT NULL COMMENT '发布者账户',
  `title` varchar(60) NOT NULL COMMENT '标题',
  `places` varchar(100) NOT NULL,
  `color` varchar(7) NOT NULL COMMENT '标题颜色',
  `picture` varchar(80) NOT NULL,
  `keywords` varchar(300) NOT NULL COMMENT '关键字',
  `description` varchar(600) NOT NULL,
  `content` text NOT NULL COMMENT '内容',
  `method` varchar(100) NOT NULL COMMENT '方法',
  `tpcontent` varchar(100) NOT NULL COMMENT '模板',
  `norder` int(4) NOT NULL COMMENT '排序',
  `recmd` tinyint(1) NOT NULL COMMENT '推荐',
  `hits` int(10) NOT NULL COMMENT '点击量',
  `ispass` tinyint(1) NOT NULL,
  `origin` varchar(30) NOT NULL COMMENT '来源',
  `addtime` int(11) NOT NULL,
  `releids` varchar(255) NOT NULL,
  `extfield` int(10) NOT NULL default '0' COMMENT '拓展字段',
  PRIMARY KEY  (`id`),
  FULLTEXT KEY `sort` (`sort`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `yx_orders`
-- ----------------------------
DROP TABLE IF EXISTS `yx_orders`;
CREATE TABLE `yx_orders` (
  `id` int(15) NOT NULL auto_increment,
  `ordersubject` varchar(90) NOT NULL COMMENT '订单名称',
  `ordernum` varchar(20) NOT NULL COMMENT ' 订单号',
  `tradenum` varchar(32) NOT NULL COMMENT '支付平台订单号',
  `account` varchar(30) NOT NULL COMMENT '账户',
  `total` float NOT NULL COMMENT '总价',
  `freight` float NOT NULL COMMENT '运费',
  `freighttype` varchar(20) NOT NULL COMMENT '邮寄方式',
  `freightpayment` varchar(10) NOT NULL COMMENT '邮费支付方',
  `freightnum` varchar(32) NOT NULL COMMENT '物流订单号',
  `freightname` varchar(90) NOT NULL COMMENT '物流公司',
  `receivename` varchar(30) NOT NULL COMMENT '收货人',
  `receiveaddress` varchar(255) NOT NULL COMMENT '收货地址',
  `receivezip` varchar(20) NOT NULL COMMENT '邮编',
  `receivephone` varchar(30) NOT NULL COMMENT '电话',
  `receivemobile` varchar(30) NOT NULL COMMENT '手机',
  `ordertime` int(11) NOT NULL COMMENT '订单时间',
  `state` tinyint(1) NOT NULL COMMENT '订单状态',
  `mess` text NOT NULL COMMENT '订单信息',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yx_orders
-- ----------------------------

-- ----------------------------
-- Table structure for `yx_order_detail`
-- ----------------------------
DROP TABLE IF EXISTS `yx_order_detail`;
CREATE TABLE `yx_order_detail` (
  `id` int(20) NOT NULL auto_increment,
  `code` varchar(10) NOT NULL COMMENT '商品编号',
  `ordernum` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` float NOT NULL,
  `num` int(5) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yx_order_detail
-- ----------------------------

-- ----------------------------
-- Table structure for `yx_page`
-- ----------------------------
DROP TABLE IF EXISTS `yx_page`;
CREATE TABLE `yx_page` (
  `id` int(10) NOT NULL auto_increment,
  `sort` varchar(350) NOT NULL,
  `content` text NOT NULL,
  `edittime` varchar(20) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `yx_photo`
-- ----------------------------
DROP TABLE IF EXISTS `yx_photo`;
CREATE TABLE `yx_photo` (
  `id` int(20) NOT NULL auto_increment,
  `sort` varchar(350) NOT NULL COMMENT '类别',
  `exsort` varchar(350) NOT NULL,
  `account` char(15) NOT NULL COMMENT '发布者账户',
  `title` varchar(60) NOT NULL COMMENT '标题',
  `places` varchar(100) NOT NULL,
  `color` varchar(7) NOT NULL COMMENT '标题颜色',
  `picture` varchar(80) NOT NULL COMMENT '封面图',
  `keywords` varchar(300) NOT NULL COMMENT '关键字',
  `description` varchar(600) NOT NULL,
  `photolist` text NOT NULL COMMENT '图片集',
  `conlist` text NOT NULL COMMENT '图片说明',
  `content` text NOT NULL COMMENT '内容',
  `method` varchar(100) NOT NULL COMMENT '方法',
  `tpcontent` varchar(100) NOT NULL COMMENT '模板',
  `norder` int(4) NOT NULL COMMENT '排序',
  `recmd` tinyint(1) NOT NULL COMMENT '推荐',
  `hits` int(10) NOT NULL COMMENT '点击量',
  `ispass` tinyint(1) NOT NULL,
  `addtime` int(11) NOT NULL,
  `releids` varchar(255) NOT NULL,
  `extfield` int(10) NOT NULL default '0' COMMENT '拓展字段',
  PRIMARY KEY  (`id`),
  FULLTEXT KEY `sort` (`sort`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


-- ----------------------------
-- Table structure for `yx_place`
-- ----------------------------
DROP TABLE IF EXISTS `yx_place`;
CREATE TABLE `yx_place` (
  `id` int(10) NOT NULL auto_increment,
  `name` varchar(60) NOT NULL,
  `norder` int(5) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=101 DEFAULT CHARSET=utf8;


-- ----------------------------
-- Table structure for `yx_sort`
-- ----------------------------
DROP TABLE IF EXISTS `yx_sort`;
CREATE TABLE `yx_sort` (
  `id` int(6) unsigned NOT NULL auto_increment,
  `type` tinyint(2) unsigned NOT NULL default '0' COMMENT '模型类别',
  `path` varchar(255) default NULL,
  `name` varchar(255) default NULL,
  `ename` varchar(100) NOT NULL,
  `picwidth` int(5) NOT NULL,
  `picheight` int(5) NOT NULL,
  `picture` varchar(80) NOT NULL,
  `deep` int(5) unsigned NOT NULL default '1' COMMENT '深度',
  `norder` int(4) unsigned NOT NULL default '0' COMMENT '排序',
  `ifmenu` tinyint(1) NOT NULL COMMENT '是否前台显示',
  `method` varchar(100) NOT NULL COMMENT '模型方法',
  `tplist` varchar(100) NOT NULL COMMENT '列表模板',
  `keywords` varchar(255) NOT NULL COMMENT '描述',
  `description` varchar(300) NOT NULL COMMENT '描述',
  `url` varchar(255) NOT NULL COMMENT '外部链接',
  `extendid` int(10) NOT NULL COMMENT '拓展表id',
  PRIMARY KEY  (`id`),
  FULLTEXT KEY `path` (`path`)
) ENGINE=MyISAM AUTO_INCREMENT=100001 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `yx_tags`
-- ----------------------------
DROP TABLE IF EXISTS `yx_tags`;
CREATE TABLE `yx_tags` (
  `id` int(10) NOT NULL auto_increment,
  `name` varchar(60) NOT NULL,
  `url` varchar(255) NOT NULL,
  `hits` int(10) NOT NULL default '0',
  `mesnum` int(10) NOT NULL default '0',
  `addtime` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;