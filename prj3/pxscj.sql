/*
Navicat MySQL Data Transfer

Source Server         : 阿萨大
Source Server Version : 50715
Source Host           : localhost:33060
Source Database       : pxscj

Target Server Type    : MYSQL
Target Server Version : 50715
File Encoding         : 65001

Date: 2018-12-28 14:48:09
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `cjb`
-- ----------------------------
DROP TABLE IF EXISTS `cjb`;
CREATE TABLE `cjb` (
  `学号` char(6) NOT NULL,
  `课程号` char(3) NOT NULL,
  `成绩` int(4) DEFAULT NULL,
  `教师号` char(4) NOT NULL,
  PRIMARY KEY (`学号`,`课程号`,`教师号`),
  KEY `FK_cjb2` (`课程号`),
  KEY `教师号` (`教师号`),
  CONSTRAINT `FK_cjb` FOREIGN KEY (`学号`) REFERENCES `xsb` (`学号`),
  CONSTRAINT `FK_cjb2` FOREIGN KEY (`课程号`) REFERENCES `kcb` (`课程号`),
  CONSTRAINT `cjb_ibfk_1` FOREIGN KEY (`教师号`) REFERENCES `jsb` (`教师号`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of cjb
-- ----------------------------
INSERT INTO `cjb` VALUES ('081101', '101', '99', '011');
INSERT INTO `cjb` VALUES ('081101', '102', '34', '011');
INSERT INTO `cjb` VALUES ('081102', '101', '1', '011');
INSERT INTO `cjb` VALUES ('081102', '103', '11', '013');
INSERT INTO `cjb` VALUES ('081103', '101', '12', '011');
INSERT INTO `cjb` VALUES ('081103', '102', '89', '011');
INSERT INTO `cjb` VALUES ('081188', '101', '12', '013');

-- ----------------------------
-- Table structure for `jsb`
-- ----------------------------
DROP TABLE IF EXISTS `jsb`;
CREATE TABLE `jsb` (
  `教师` char(6) NOT NULL,
  `教师号` char(4) NOT NULL,
  `课程号` char(4) DEFAULT NULL,
  PRIMARY KEY (`教师号`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jsb
-- ----------------------------
INSERT INTO `jsb` VALUES ('王二', '011', '101');
INSERT INTO `jsb` VALUES ('林恒', '012', '101');
INSERT INTO `jsb` VALUES ('吴始时', '013', '206');

-- ----------------------------
-- Table structure for `jwb`
-- ----------------------------
DROP TABLE IF EXISTS `jwb`;
CREATE TABLE `jwb` (
  `姓名` varchar(12) NOT NULL,
  `职位` varchar(12) NOT NULL,
  `工号` varchar(12) NOT NULL,
  PRIMARY KEY (`工号`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jwb
-- ----------------------------
INSERT INTO `jwb` VALUES ('李蝶', '主任', '1001');

-- ----------------------------
-- Table structure for `kcb`
-- ----------------------------
DROP TABLE IF EXISTS `kcb`;
CREATE TABLE `kcb` (
  `课程号` char(3) NOT NULL,
  `课程名` char(16) NOT NULL,
  `开课学期` tinyint(1) DEFAULT '1' COMMENT '只能为1~8',
  `学时` tinyint(1) DEFAULT NULL,
  `学分` tinyint(1) NOT NULL,
  PRIMARY KEY (`课程号`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of kcb
-- ----------------------------
INSERT INTO `kcb` VALUES ('101', '计算机基础', '2', '3', '6');
INSERT INTO `kcb` VALUES ('102', '程序设计与语言', '2', '68', '4');
INSERT INTO `kcb` VALUES ('103', '思想品德', '3', '68', '6');
INSERT INTO `kcb` VALUES ('206', '离散数学', '4', '68', '4');
INSERT INTO `kcb` VALUES ('302', '软件工程', '7', '51', '3');

-- ----------------------------
-- Table structure for `xsb`
-- ----------------------------
DROP TABLE IF EXISTS `xsb`;
CREATE TABLE `xsb` (
  `学号` char(6) NOT NULL,
  `姓名` char(8) NOT NULL,
  `性别` tinyint(1) DEFAULT '1' COMMENT '1男，0女',
  `出生时间` date DEFAULT NULL,
  `专业` char(12) DEFAULT NULL,
  `总学分` int(4) DEFAULT '0',
  `备注` text,
  PRIMARY KEY (`学号`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of xsb
-- ----------------------------
INSERT INTO `xsb` VALUES ('081101', '王林', '1', '1990-02-10', '计算机', '50', '');
INSERT INTO `xsb` VALUES ('081102', '程明', '1', '1991-02-01', '计算机', '50', null);
INSERT INTO `xsb` VALUES ('081103', '王燕', '0', '1989-10-06', '计算机', '50', null);
INSERT INTO `xsb` VALUES ('081104', '王计算', '1', '1997-02-20', '计算机', '67', null);
INSERT INTO `xsb` VALUES ('081105', '王信息', '1', '1997-03-20', '信息管理', '60', null);
INSERT INTO `xsb` VALUES ('081133', '王林', '1', '1990-02-10', '计算机', '50', '');
INSERT INTO `xsb` VALUES ('081188', '李四', '0', '1990-02-10', '通讯工程', '30', '共产党党员');
INSERT INTO `xsb` VALUES ('081189', '2', '0', '1998-00-01', '0', '59', '0');
INSERT INTO `xsb` VALUES ('81189', '2', '0', '1998-00-01', '0', '59', '0');
