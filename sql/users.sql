/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306_01
Source Server Version : 50728
Source Host           : localhost:3306
Source Database       : layui

Target Server Type    : MYSQL
Target Server Version : 50728
File Encoding         : 65001

Date: 2020-02-21 17:33:52
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for model_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of model_has_permissions
-- ----------------------------

-- ----------------------------
-- Table structure for model_has_roles
-- ----------------------------
DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of model_has_roles
-- ----------------------------

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pid` int(10) unsigned DEFAULT '0',
  `uri` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '权限跳转地址',
  `route_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '权限名称',
  `cate_pid_arr` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '父级权限ids',
  `is_menu` tinyint(1) unsigned DEFAULT '0' COMMENT '是否菜单栏显示',
  `status` tinyint(1) DEFAULT '1' COMMENT '0 禁用 1 正常',
  `icon` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '图标',
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `desc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '权限描述',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of permissions
-- ----------------------------
INSERT INTO `permissions` VALUES ('9', '后台首页', '0', 'main.index', 'main.index', null, '1', '1', null, 'web', '2020-02-20 15:56:52', '2020-02-20 17:33:56', null);
INSERT INTO `permissions` VALUES ('10', '后台主页', '9', 'main.home', 'main.home', '9,', '0', '1', null, 'web', '2020-02-20 15:57:41', '2020-02-20 17:34:31', null);
INSERT INTO `permissions` VALUES ('11', '权限管理', '0', 'main.home', 'index.main', null, '1', '1', null, 'web', '2020-02-20 15:59:05', '2020-02-20 17:38:27', null);
INSERT INTO `permissions` VALUES ('12', '角色列表', '11', 'role.index', 'role.index', '11', '1', '1', null, 'web', '2020-02-20 15:59:52', '2020-02-20 15:59:52', null);
INSERT INTO `permissions` VALUES ('13', '删除角色', '12', 'role.roleDel', 'role.roleDel', '11,12', '0', '1', null, 'web', '2020-02-20 16:02:50', '2020-02-20 16:02:50', null);
INSERT INTO `permissions` VALUES ('14', '添加角色', '12', 'role.editRole', 'role.editRole|role.add', '11,12,', '0', '1', null, 'web', '2020-02-20 16:03:37', '2020-02-20 16:07:04', null);
INSERT INTO `permissions` VALUES ('15', '修改角色', '12', 'role.save', 'role.save|role.saveRole|role.status', '11,12,', '0', '1', null, 'web', '2020-02-20 16:08:19', '2020-02-20 16:08:19', null);
INSERT INTO `permissions` VALUES ('16', '权限分配', '12', 'role.rolePermission', 'role.rolePermission|role.saveRolePermission', '11,12,', '0', '1', null, 'web', '2020-02-20 16:09:23', '2020-02-20 16:09:23', null);
INSERT INTO `permissions` VALUES ('17', '用户列表', '11', 'user.index', 'user.index', '11,', '1', '1', null, 'web', '2020-02-20 16:10:03', '2020-02-20 16:10:03', null);
INSERT INTO `permissions` VALUES ('18', '删除用户', '17', 'user.del', 'user.del', '11,17', '0', '1', null, 'web', '2020-02-20 16:10:44', '2020-02-20 16:10:44', null);
INSERT INTO `permissions` VALUES ('19', '添加用户', '17', 'role.add', 'role.add|role.doAdd', '11,17,', '0', '1', null, 'web', '2020-02-20 16:11:47', '2020-02-20 16:11:47', null);
INSERT INTO `permissions` VALUES ('20', '修改用户', '17', 'user.save', 'user.save|user.status|user.doSave|user.ajaxList', '11,17,', '0', '1', null, 'web', '2020-02-20 16:13:32', '2020-02-20 16:14:22', null);
INSERT INTO `permissions` VALUES ('21', '权限列表', '11', 'permission.index', 'permission.index|permission.ajaxList', '11,', '1', '1', null, 'web', '2020-02-20 16:15:43', '2020-02-20 16:30:10', null);
INSERT INTO `permissions` VALUES ('22', '删除权限', '21', 'permission.del', 'permission.del', '11,21', '0', '1', null, 'web', '2020-02-20 16:18:01', '2020-02-20 16:18:01', null);
INSERT INTO `permissions` VALUES ('23', '添加权限', '21', 'permission.add', 'permission.add|permission.editRole', '11,21,', '0', '1', null, 'web', '2020-02-20 16:27:41', '2020-02-20 16:27:41', null);
INSERT INTO `permissions` VALUES ('24', '修改权限', '21', 'permission.save', 'permission.save|permission.status|permission.saveRole', '11,21,', '0', '1', null, 'web', '2020-02-20 16:29:19', '2020-02-20 16:29:19', null);

-- ----------------------------
-- Table structure for role_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of role_has_permissions
-- ----------------------------

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) unsigned DEFAULT '1' COMMENT '1 正常 0 禁用',
  `is_super` tinyint(1) DEFAULT '0' COMMENT '1为超级管理员权限组',
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of roles
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phome` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '联系电话',
  `is_super` tinyint(1) unsigned DEFAULT '0' COMMENT '1 代表超级管理员',
  `user_desc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '用户描述',
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
INSERT INTO `users` VALUES ('1', 'admin', null, '1', '超级管理员', '17', '1', null, null, '$2y$10$GdNcjMky6fIGd1AkWMmlOOca3S3hdLrQbS.c5OK6uyWqfiP83Xr0e', null, '2020-02-11 03:34:01', '2020-02-20 17:12:59');
