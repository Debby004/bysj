/*
Navicat MySQL Data Transfer

Source Server         : ahh
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : bysj

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2019-03-26 17:27:09
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for address
-- ----------------------------
DROP TABLE IF EXISTS `address`;
CREATE TABLE `address` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `account` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `provice` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `tel` varchar(255) DEFAULT NULL,
  `created_id` int(255) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of address
-- ----------------------------
INSERT INTO `address` VALUES ('11', '11111', null, '红弘化化', '河南省', '郑州市', '电厂路乐丁广场', '214748364744', null, null);
INSERT INTO `address` VALUES ('14', '111', null, '郑州红岩手机快修', '河南省', '郑州市', '电厂路乐丁广场', '0377-56895895', null, null);
INSERT INTO `address` VALUES ('15', '111', null, '郑州红岩手机快修', '河南省', '郑州市', '电厂路乐丁广场', '11111', null, null);
INSERT INTO `address` VALUES ('16', '1222', null, '郑州红岩手机快修', '河南省', '郑州市', '电厂路乐丁广场', '2147483647', null, null);
INSERT INTO `address` VALUES ('18', '666666', null, '郑州红岩手机快修', '河南省', '郑州市', '电厂路乐丁广场', '2147483647', null, null);
INSERT INTO `address` VALUES ('21', '郑州红岩手机快修', null, '郑州红岩手机快修', '河南省', '郑州市', '电厂路乐丁广场', '156757877887', null, '2019-03-14');
INSERT INTO `address` VALUES ('22', '22222222222222222', null, '郑州红岩手机快修', '河南省', '郑州市', '电厂路乐丁广场', '11111111111', null, '2019-03-23');
INSERT INTO `address` VALUES ('23', '55555', null, '郑州红岩手机快修', '河南省', '郑州市', '电厂路乐丁广场', '156757877887', null, '2019-03-23');

-- ----------------------------
-- Table structure for faculty
-- ----------------------------
DROP TABLE IF EXISTS `faculty`;
CREATE TABLE `faculty` (
  `id` int(50) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `name` varchar(200) DEFAULT NULL COMMENT '院系名称',
  `faculty_id` int(50) DEFAULT NULL COMMENT '院系id',
  `created_at` date DEFAULT NULL,
  `create_id` int(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=262 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of faculty
-- ----------------------------
INSERT INTO `faculty` VALUES ('255', '应用数学', '254', '2019-03-21', null);
INSERT INTO `faculty` VALUES ('254', '应用统计学院', null, null, null);
INSERT INTO `faculty` VALUES ('252', '外国语学院', null, null, null);
INSERT INTO `faculty` VALUES ('253', '法语学院', '252', null, null);
INSERT INTO `faculty` VALUES ('251', '网络工程', '249', null, null);
INSERT INTO `faculty` VALUES ('250', '软件工程', '249', null, null);
INSERT INTO `faculty` VALUES ('249', '计算机科学与信息工程学院', null, '2019-03-20', null);
INSERT INTO `faculty` VALUES ('258', '机械工程', null, '2019-03-23', null);
INSERT INTO `faculty` VALUES ('259', '机械专业', '258', '2019-03-23', null);
INSERT INTO `faculty` VALUES ('260', '网络工程22', '249', '2019-03-23', null);
INSERT INTO `faculty` VALUES ('261', '机械工程2222', '252', '2019-03-23', null);

-- ----------------------------
-- Table structure for forum
-- ----------------------------
DROP TABLE IF EXISTS `forum`;
CREATE TABLE `forum` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `descript` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of forum
-- ----------------------------
INSERT INTO `forum` VALUES ('4', '计算机', '计算机有关问题请在此论坛下讨论');
INSERT INTO `forum` VALUES ('8', '实习资源问题', '444');

-- ----------------------------
-- Table structure for group
-- ----------------------------
DROP TABLE IF EXISTS `group`;
CREATE TABLE `group` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `account` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `limit_count` int(255) DEFAULT NULL,
  `address_id` int(255) DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `led_teacher_id` int(255) DEFAULT NULL,
  `guide_teacher_id` int(255) DEFAULT NULL,
  `stu_id` varchar(255) DEFAULT NULL,
  `type` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of group
-- ----------------------------
INSERT INTO `group` VALUES ('14', 'sx4444', '144444444444', '4', null, null, null, null, null, null, '2');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `tel` varchar(15) DEFAULT NULL,
  `nation` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `birth` date DEFAULT NULL,
  `faculty_id` int(11) DEFAULT NULL,
  `major_id` int(11) DEFAULT NULL,
  `creater_id` int(11) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', '超管', null, '15672751550', '汉族', 'master', '2019-03-21', '249', '250', null, null);
INSERT INTO `user` VALUES ('21', '00002', '唐长老', null, '186595895879', '汉族', 'teacher', null, '252', '253', null, null);
INSERT INTO `user` VALUES ('22', '1321', '孙悟空', null, '186595986989', '蒙古族', 'teacher', null, '249', '251', null, null);
INSERT INTO `user` VALUES ('6', '12313', '猪八戒', null, '156757877887', '\'汉族\'', 'teacher', null, '252', '253', null, null);
INSERT INTO `user` VALUES ('25', '17031230135', '李兰迪', null, '156757877887', '汉族', 'student', null, '254', '255', null, '2019-03-13');
INSERT INTO `user` VALUES ('24', '1703123', '李进', null, '15672751550', '汉族', 'student', null, '249', '250', null, '2019-03-19');
INSERT INTO `user` VALUES ('26', '00002', '猪八戒123213', null, '156757877887', '汉族', 'student', null, '252', '253', null, '2019-03-13');
INSERT INTO `user` VALUES ('27', '00002', '郑州红岩手机快修', null, '156757877887', '汉族', 'teacher', null, '252', '253', null, '2019-03-23');
