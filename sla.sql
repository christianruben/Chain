/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50711
Source Host           : 127.0.0.1:3306
Source Database       : sla

Target Server Type    : MYSQL
Target Server Version : 50711
File Encoding         : 65001

Date: 2019-04-15 18:03:31
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tbl_area
-- ----------------------------
DROP TABLE IF EXISTS `tbl_area`;
CREATE TABLE `tbl_area` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_sublocation` int(10) NOT NULL,
  `area_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_area
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_items
-- ----------------------------
DROP TABLE IF EXISTS `tbl_items`;
CREATE TABLE `tbl_items` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `id_parameter` int(10) NOT NULL,
  `id_location` int(10) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_items
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_location
-- ----------------------------
DROP TABLE IF EXISTS `tbl_location`;
CREATE TABLE `tbl_location` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `location_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_location
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_parameter
-- ----------------------------
DROP TABLE IF EXISTS `tbl_parameter`;
CREATE TABLE `tbl_parameter` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parameter` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_parameter
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_photo_sla
-- ----------------------------
DROP TABLE IF EXISTS `tbl_photo_sla`;
CREATE TABLE `tbl_photo_sla` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_sla` int(20) NOT NULL,
  `photo_type` tinyint(1) NOT NULL,
  `file_name` varchar(50) NOT NULL,
  `photo_status` tinyint(1) NOT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_photo_sla
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_point
-- ----------------------------
DROP TABLE IF EXISTS `tbl_point`;
CREATE TABLE `tbl_point` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_location` int(10) NOT NULL,
  `yes_point` varchar(10) NOT NULL,
  `no_point` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_point
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_sla
-- ----------------------------
DROP TABLE IF EXISTS `tbl_sla`;
CREATE TABLE `tbl_sla` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `id_location` int(10) NOT NULL,
  `id_subarea` int(10) NOT NULL,
  `id_parameter` int(20) NOT NULL,
  `point_stat` tinyint(1) NOT NULL,
  `user_id` int(10) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_sla
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_subarea
-- ----------------------------
DROP TABLE IF EXISTS `tbl_subarea`;
CREATE TABLE `tbl_subarea` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_area` int(10) NOT NULL,
  `subarea_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_subarea
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_sublocation
-- ----------------------------
DROP TABLE IF EXISTS `tbl_sublocation`;
CREATE TABLE `tbl_sublocation` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_location` int(10) NOT NULL,
  `sublocation_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_sublocation
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_user
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE `tbl_user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `user_type` tinyint(1) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_user
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_verify
-- ----------------------------
DROP TABLE IF EXISTS `tbl_verify`;
CREATE TABLE `tbl_verify` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `random_code` varchar(64) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_verify
-- ----------------------------
