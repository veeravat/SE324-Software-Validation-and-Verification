/*
Navicat MySQL Data Transfer

Source Server         : ap-cdbr-azure-southeast-b.cloudapp.net
Source Server Version : 50545
Source Host           : ap-cdbr-azure-southeast-b.cloudapp.net:3306
Source Database       : se324

Target Server Type    : MYSQL
Target Server Version : 50545
File Encoding         : 65001

Date: 2017-03-15 01:17:23
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for user_info
-- ----------------------------
DROP TABLE IF EXISTS `user_info`;
CREATE TABLE `user_info` (
  `us_id` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`us_id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;
