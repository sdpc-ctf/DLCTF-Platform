/*
 Navicat Premium Data Transfer

 Source Server         : dlctf
 Source Server Type    : MySQL
 Source Server Version : 50723
 Source Host           : localhost:3306
 Source Schema         : dlctf

 Target Server Type    : MySQL
 Target Server Version : 50723
 File Encoding         : 65001

 Date: 30/08/2019 11:57:28
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for hint
-- ----------------------------
DROP TABLE IF EXISTS `hint`;
CREATE TABLE `hint` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `taskid` int(10) NOT NULL,
  `hintdata` varchar(2000) NOT NULL,
  `addtime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hint
-- ----------------------------
BEGIN;
INSERT INTO `hint` VALUES (1, 2, 'YXNk', '2019-07-18 14:26:01');
COMMIT;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
BEGIN;
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
COMMIT;

-- ----------------------------
-- Table structure for notice
-- ----------------------------
DROP TABLE IF EXISTS `notice`;
CREATE TABLE `notice` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `noticedata` varchar(2000) NOT NULL,
  `addtime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of notice
-- ----------------------------
BEGIN;
INSERT INTO `notice` VALUES (1, '6LW15LiA5bG65aSq5biF5LqG', '2019-08-30 03:56:11');
INSERT INTO `notice` VALUES (2, '5oiR5aSq6Zq+5LqG', '2019-08-30 03:56:23');
INSERT INTO `notice` VALUES (3, '6LW15LiA5bG65piv5beo5L2s5beo', '2019-08-30 03:56:35');
COMMIT;

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for solvedtask
-- ----------------------------
DROP TABLE IF EXISTS `solvedtask`;
CREATE TABLE `solvedtask` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL,
  `taskid` varchar(2000) NOT NULL,
  `score` int(10) NOT NULL,
  `addtime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of solvedtask
-- ----------------------------
BEGIN;
INSERT INTO `solvedtask` VALUES (1, 'venenof7', '[\"1\",\"3\"]', 1211, '2019-07-18 14:45:50');
COMMIT;

-- ----------------------------
-- Table structure for submit_flag
-- ----------------------------
DROP TABLE IF EXISTS `submit_flag`;
CREATE TABLE `submit_flag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL,
  `taskid` int(10) NOT NULL,
  `check_status` int(10) NOT NULL,
  `addtime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of submit_flag
-- ----------------------------
BEGIN;
INSERT INTO `submit_flag` VALUES (1, 'venenof7', 1, 1, '2019-07-18 14:42:51');
INSERT INTO `submit_flag` VALUES (2, 'venenof7', 1, 0, '2019-07-18 14:43:33');
INSERT INTO `submit_flag` VALUES (3, 'venenof7', 3, 1, '2019-07-18 14:45:50');
INSERT INTO `submit_flag` VALUES (4, 'venenof7', 3, 0, '2019-07-18 14:45:56');
COMMIT;

-- ----------------------------
-- Table structure for task
-- ----------------------------
DROP TABLE IF EXISTS `task`;
CREATE TABLE `task` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `typetask` varchar(40) NOT NULL,
  `taskname` varchar(40) NOT NULL,
  `taskdata` varchar(2000) NOT NULL,
  `check` varchar(20) DEFAULT NULL,
  `score` int(10) NOT NULL,
  `fbuserid` int(10) NOT NULL,
  `flag` varchar(100) NOT NULL,
  `addtime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of task
-- ----------------------------
BEGIN;
INSERT INTO `task` VALUES (2, 'pwn', '1231', 'MTIz', 'on', 123, 7, '123123', '2019-07-18 14:25:18');
INSERT INTO `task` VALUES (3, 'web', '1zzz', 'enp6', 'on', 1111, 7, '111', '2019-07-18 14:45:26');
COMMIT;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES (1, 'test', 'nu1lctf@163.com', '$2y$10$VKcjo51llJrTlEWVS1pZRufkvYzoxYXYS/SpqxivdB4mn1vQTu/6y', 'eHb2T1erND5HVFdzvdNjMdVLphzAzI1bx1GUlDGowup38ZI2qx1xBi4mtpM5', '2019-07-17 12:42:57', '2019-07-17 12:42:57');
INSERT INTO `users` VALUES (7, 'venenof7', 'venenof7@11.com', '$2y$10$Vb2MP266rdK9mtXP6XqRSOSBKNUY83rRSXEQa2Ato7EiVgKOHxWre', 'hdak7MH6OjkAFqqG4IpCdoQygpl1kgyuvM9nyTT8CkHczByM3fsL54jxQqhG', '2019-07-17 12:58:11', '2019-07-17 12:58:11');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
