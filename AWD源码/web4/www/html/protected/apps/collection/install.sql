DROP TABLE IF EXISTS `yx_collectrules`;
CREATE TABLE `yx_collectrules` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `pname` varchar(100) NOT NULL COMMENT '采集项目名',
  `url` varchar(255) NOT NULL COMMENT '列表url',
  `replaces` text NOT NULL COMMENT '内容替换',
  `sort` varchar(350) NOT NULL COMMENT '栏目id',
  `exsort` varchar(350) NOT NULL,
  `pages` text NOT NULL COMMENT '分页设置',
  `listsrcrule` varchar(100) NOT NULL COMMENT '内容src规则',
  `account` varchar(25) NOT NULL COMMENT '发布账户',
  `titlerule` varchar(100) NOT NULL COMMENT '标题规则',
  `places` varchar(100) NOT NULL COMMENT '内容定位',
  `picturerule` varchar(100) NOT NULL COMMENT '封面图规则',
  `keywordsrule` varchar(100) NOT NULL COMMENT '关键字规则',
  `descriptionrule` varchar(100) NOT NULL COMMENT '描述规则',
  `contentrule` varchar(100) NOT NULL COMMENT '内容规则',
  `method` varchar(100) NOT NULL,
  `tpcontent` varchar(100) NOT NULL,
  `norder` int(4) NOT NULL,
  `recmd` tinyint(1) NOT NULL,
  `hitsrule` varchar(100) NOT NULL,
  `ispass` tinyint(1) NOT NULL,
  `origin` varchar(30) NOT NULL,
  `addtimerule` varchar(100) NOT NULL,
  `releids` varchar(255) NOT NULL,
  `photolistrule` varchar(100) NOT NULL COMMENT '图集src规则',
  `conlistrule` varchar(100) NOT NULL COMMENT '图片描述规则',
  `exrule` text NOT NULL COMMENT '拓展字段规则',
  `lasttime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yx_collectrules
-- ----------------------------
INSERT INTO `yx_collectrules` VALUES ('2', '搜狐新闻', 'http://news.sohu.com/dianjijinri/index_*.shtml', '', ',000000,100003,100004', '', '37,38', '.article h3 a', 'admin', '.left_con h1', '', 'img.pic', '', '.introduction', '.con', 'default/column/content', 'news_content', '0', '0', '1,100', '1', '原创', '2013-11-15 11:10:10,2014-11-15 11:10:10', '', '', '', '', '1408589371');
INSERT INTO `yx_collectrules` VALUES ('3', 'QQ新闻', 'http://finance.qq.com/hgjj.htm', '', ',000000,100003,100005', '', '', 'em.f20 a', 'admin', '.hd h1', '', '', '', '', '#Cnt-Main-Article-QQ', 'default/column/content', 'news_content', '0', '0', '1,100', '1', '原创', '', '', '', '', '', '1437550296');
