/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306_01
Source Server Version : 50728
Source Host           : localhost:3306
Source Database       : layui

Target Server Type    : MYSQL
Target Server Version : 50728
File Encoding         : 65001

Date: 2020-02-20 17:20:46
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phome` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '联系电话',
  `role_id` int(10) unsigned DEFAULT '0',
  `status` tinyint(1) unsigned DEFAULT '1' COMMENT '1 正常 0 禁用',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'zhangsan', '', '0', '1', null, null, '$2y$10$GdNcjMky6fIGd1AkWMmlOOca3S3hdLrQbS.c5OK6uyWqfiP83Xr0e', null, '2020-02-11 03:34:01', '2020-02-19 03:34:35');
