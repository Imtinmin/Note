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
DROP TABLE IF EXISTS `yx_member_group`;
CREATE TABLE `yx_member_group` (
  `id` int(3) NOT NULL auto_increment,
  `name` varchar(30) NOT NULL,
  `notallow` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
INSERT INTO `yx_member_group`(`id`,`name`,`notallow`) VALUES ('1','未登录','member/infor|member/order|member/news|member/photo');
INSERT INTO `yx_member_group`(`id`,`name`,`notallow`) VALUES ('2','普通会员','');
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