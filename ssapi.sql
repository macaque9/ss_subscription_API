/*
Navicat MySQL Data Transfer

Source Server         : Mysqlserver
Source Server Version : 50720
Source Host           : localhost:3306
Source Database       : ssapi

Target Server Type    : MYSQL
Target Server Version : 50720
File Encoding         : 65001

Date: 2017-12-17 01:33:34
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for server
-- ----------------------------
DROP TABLE IF EXISTS `server`;
CREATE TABLE `server` (
  `SID` int(3) NOT NULL AUTO_INCREMENT,
  `S_IP` varchar(20) NOT NULL,
  `S_name` varchar(50) NOT NULL,
  PRIMARY KEY (`SID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of server
-- ----------------------------
INSERT INTO `server` VALUES ('1', '1.1.1.1', 'TW');
INSERT INTO `server` VALUES ('2', '2.2.2.2', 'JP');
INSERT INTO `server` VALUES ('3', '3.3.3.3', 'US');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `UID` int(3) NOT NULL AUTO_INCREMENT,
  `U_port` int(5) NOT NULL,
  `U_pass` varchar(30) NOT NULL,
  `U_name` varchar(255) NOT NULL,
  PRIMARY KEY (`UID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'port1', 'pass1', 'name1');
INSERT INTO `user` VALUES ('2', 'port2', 'pass2', 'name2');
INSERT INTO `user` VALUES ('3', 'port3', 'pass3', 'name3');
INSERT INTO `user` VALUES ('4', 'port4', 'pass4', 'name4');
INSERT INTO `user` VALUES ('5', 'port5', 'pass5', 'name5');
INSERT INTO `user` VALUES ('6', 'port6', 'pass6', 'name6');
SET FOREIGN_KEY_CHECKS=1;
