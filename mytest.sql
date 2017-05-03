# Host: localhost  (Version: 5.5.40)
# Date: 2017-05-03 19:37:32
# Generator: MySQL-Front 5.3  (Build 4.120)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "think_admin_base"
#

DROP TABLE IF EXISTS `think_admin_base`;
CREATE TABLE `think_admin_base` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '用户名',
  `pwd` varchar(255) NOT NULL DEFAULT '' COMMENT '密码',
  `nickname` varchar(255) DEFAULT '' COMMENT '昵称',
  `email` varchar(255) DEFAULT NULL COMMENT '邮箱',
  `create_time` int(11) DEFAULT '0' COMMENT '创建时间',
  `create_ip` varchar(255) DEFAULT NULL COMMENT '创建IP',
  `order` int(11) DEFAULT '999999' COMMENT '序号',
  `group` int(11) NOT NULL DEFAULT '0',
  `state` tinyint(3) DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`Id`),
  UNIQUE KEY `name` (`name`),
  KEY `time` (`create_time`),
  KEY `email` (`email`),
  KEY `nickname` (`nickname`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

#
# Data for table "think_admin_base"
#

INSERT INTO `think_admin_base` VALUES (5,'admin','129e73e3c0aa0057','test','2756145382@qq.com',1493723272,'127.0.0.1',999999,3,0);

#
# Structure for table "think_auth_group"
#

DROP TABLE IF EXISTS `think_auth_group`;
CREATE TABLE `think_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` char(80) NOT NULL DEFAULT '',
  `order` int(11) DEFAULT '999999',
  `remark` mediumtext COMMENT '备注',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

#
# Data for table "think_auth_group"
#

/*!40000 ALTER TABLE `think_auth_group` DISABLE KEYS */;
INSERT INTO `think_auth_group` VALUES (3,'管理员',1,'3,4,5,6',999999,'test3');
/*!40000 ALTER TABLE `think_auth_group` ENABLE KEYS */;

#
# Structure for table "think_auth_group_access"
#

DROP TABLE IF EXISTS `think_auth_group_access`;
CREATE TABLE `think_auth_group_access` (
  `uid` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "think_auth_group_access"
#

/*!40000 ALTER TABLE `think_auth_group_access` DISABLE KEYS */;
INSERT INTO `think_auth_group_access` VALUES (5,3);
/*!40000 ALTER TABLE `think_auth_group_access` ENABLE KEYS */;

#
# Structure for table "think_auth_rule"
#

DROP TABLE IF EXISTS `think_auth_rule`;
CREATE TABLE `think_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `condition` char(100) NOT NULL DEFAULT '',
  `parentid` mediumint(9) unsigned DEFAULT '0',
  `order` int(11) DEFAULT '999999',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "think_auth_rule"
#

/*!40000 ALTER TABLE `think_auth_rule` DISABLE KEYS */;
INSERT INTO `think_auth_rule` VALUES (2,'Topic','内容管理',1,1,'',0,999999),(3,'Topic/Index','内容列表',1,1,'',2,999999),(4,'Topic/Add','添加内容',1,1,'',2,999999),(5,'Topic/Edit','编辑内容',1,1,'',2,999999),(6,'Topic/Del','删除内容',1,1,'',2,999999),(7,'Frame','栏目管理',1,1,'',0,999999),(8,'Frame/Index','栏目列表',1,1,'',7,999999),(9,'Frame/Add','添加栏目',1,1,'',7,999999),(10,'test','test',1,0,'',9,999999);
/*!40000 ALTER TABLE `think_auth_rule` ENABLE KEYS */;

#
# Structure for table "think_frame_base"
#

DROP TABLE IF EXISTS `think_frame_base`;
CREATE TABLE `think_frame_base` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '栏目标题',
  `title_sub` varchar(255) DEFAULT NULL COMMENT '栏目副标题',
  `img` varchar(255) DEFAULT NULL COMMENT '栏目图标',
  `is_nav` tinyint(3) DEFAULT '1' COMMENT '是否导航',
  `parent_id` int(11) DEFAULT '0' COMMENT '父id',
  `pagesize` int(11) DEFAULT '10' COMMENT '每页显示行数',
  `order` int(11) DEFAULT '999999' COMMENT '排序',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `create_ip` varchar(255) NOT NULL DEFAULT '' COMMENT '创建ip',
  `remark` mediumtext COMMENT '备注',
  `state` tinyint(4) DEFAULT '1' COMMENT '状态：1为正常：0为隐藏',
  PRIMARY KEY (`Id`),
  KEY `title` (`title`),
  KEY `time` (`create_time`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

#
# Data for table "think_frame_base"
#

INSERT INTO `think_frame_base` VALUES (1,'test1','222ssa','/Public/attached/20170503/5909497d65d2b.jpg',1,0,20,9999999,1493780948,'127.0.0.1','test',1),(4,'test2','','',1,1,20,9999999,1493786989,'127.0.0.1','test',1),(5,'test','','/Public/attached/20170503/5909497d65d2b.jpg',1,0,20,999999,1493811109,'127.0.0.1','',1);

#
# Structure for table "think_topic_base"
#

DROP TABLE IF EXISTS `think_topic_base`;
CREATE TABLE `think_topic_base` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `title_sub` varchar(255) DEFAULT NULL COMMENT '子标题',
  `image` varchar(255) DEFAULT NULL COMMENT '缩略图',
  `content` mediumtext COMMENT '内容',
  `frame` int(11) DEFAULT '0' COMMENT '所属栏目',
  `count_read` int(11) DEFAULT '0' COMMENT '点击量',
  `is_top` tinyint(4) DEFAULT '0' COMMENT '是否置顶',
  `order` int(11) DEFAULT '999999' COMMENT '排序',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `create_ip` varchar(255) NOT NULL DEFAULT '' COMMENT '创建IP',
  `create_user` varchar(255) NOT NULL DEFAULT '' COMMENT '创建者',
  `edit_time` int(11) DEFAULT NULL COMMENT '编辑时间',
  `edit_ip` varchar(255) DEFAULT NULL COMMENT '编辑IP',
  `edit_user` varchar(255) DEFAULT NULL COMMENT '编辑者',
  `state` tinyint(4) DEFAULT '0' COMMENT '状态:1为显示，0为隐藏',
  PRIMARY KEY (`Id`),
  KEY `title` (`title`),
  KEY `frame` (`frame`),
  KEY `time` (`create_time`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

#
# Data for table "think_topic_base"
#

INSERT INTO `think_topic_base` VALUES (1,'test2test2','test2','/Public/attached/20170503/5909497d65d2b.jpg','test2test2',4,0,0,999999,1493790661,'127.0.0.1','5',NULL,NULL,NULL,0);
