/*
 Navicat Premium Data Transfer

 Source Server         : local-mysql
 Source Server Type    : MySQL
 Source Server Version : 100413
 Source Host           : localhost:3306
 Source Schema         : fuzzy_ahp

 Target Server Type    : MySQL
 Target Server Version : 100413
 File Encoding         : 65001

 Date: 02/12/2020 00:01:46
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for m_himpunan
-- ----------------------------
DROP TABLE IF EXISTS `m_himpunan`;
CREATE TABLE `m_himpunan`  (
  `id` int(11) NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `lower_txt` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `medium_txt` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `upper_txt` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `lower_val` float(20, 4) NULL DEFAULT NULL,
  `medium_val` float(20, 4) NULL DEFAULT NULL,
  `upper_val` float(20, 4) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_himpunan
-- ----------------------------
INSERT INTO `m_himpunan` VALUES (1, '9 kali lebih penting', '4', '9/2', '9/2', 4.0000, 4.5000, 4.5000, '2020-12-01 23:21:04', '2020-12-01 23:51:56', NULL);
INSERT INTO `m_himpunan` VALUES (2, '8 kali lebih penting', '7/2', '4', '9/2', 3.5000, 4.0000, 4.5000, '2020-12-01 23:22:27', '2020-12-01 23:52:08', NULL);
INSERT INTO `m_himpunan` VALUES (3, '7 kali lebih penting', '3', '7/2', '4', 3.0000, 3.5000, 4.0000, '2020-12-01 23:43:29', '2020-12-01 23:52:46', NULL);
INSERT INTO `m_himpunan` VALUES (4, '6 kali lebih penting', '5/2', '3', '7/2', 2.5000, 3.0000, 3.5000, '2020-12-01 23:44:14', '2020-12-01 23:52:57', NULL);
INSERT INTO `m_himpunan` VALUES (5, '5 kali lebih penting', '2', '5/2', '3', 2.0000, 2.5000, 3.0000, '2020-12-01 23:45:05', '2020-12-01 23:53:49', NULL);
INSERT INTO `m_himpunan` VALUES (6, '4 kali lebih penting', '3/2', '2', '5/2', 1.5000, 2.0000, 2.5000, '2020-12-01 23:46:03', '2020-12-01 23:53:57', NULL);
INSERT INTO `m_himpunan` VALUES (7, '3 kali lebih penting', '1', '3/2', '2', 1.0000, 1.5000, 2.0000, '2020-12-01 23:47:24', '2020-12-01 23:54:08', NULL);
INSERT INTO `m_himpunan` VALUES (8, '2 kali lebih penting', '1/2', '1', '3/2', 0.5000, 1.0000, 1.5000, '2020-12-01 23:47:50', '2020-12-01 23:54:16', NULL);
INSERT INTO `m_himpunan` VALUES (9, 'Sama Penting', '1', '1', '1', 1.0000, 1.0000, 1.0000, '2020-12-01 23:48:07', '2020-12-01 23:54:25', NULL);
INSERT INTO `m_himpunan` VALUES (10, '2 kali kurang penting', '2/3', '1', '2', 0.6667, 1.0000, 2.0000, '2020-12-01 23:55:34', NULL, NULL);
INSERT INTO `m_himpunan` VALUES (11, '3 kali kurang penting', '1/2', '2/3', '1', 0.5000, 0.6667, 1.0000, '2020-12-01 23:56:07', NULL, NULL);
INSERT INTO `m_himpunan` VALUES (12, '4 kali kurang penting', '2/5', '1/2', '2/3', 0.4000, 0.5000, 0.6667, '2020-12-01 23:56:35', NULL, NULL);
INSERT INTO `m_himpunan` VALUES (13, '5 kali kurang penting', '1/3', '2/5', '1/2', 0.3333, 0.4000, 0.5000, '2020-12-01 23:57:05', NULL, NULL);
INSERT INTO `m_himpunan` VALUES (14, '6 kali kurang penting', '2/7', '1/3', '2/5', 0.2857, 0.3333, 0.4000, '2020-12-01 23:57:45', NULL, NULL);
INSERT INTO `m_himpunan` VALUES (15, '7 kali kurang penting', '1/4', '2/7', '1/3', 0.2500, 0.2857, 0.3333, '2020-12-01 23:58:20', NULL, NULL);
INSERT INTO `m_himpunan` VALUES (16, '8 kali kurang penting', '2/9', '1/4', '2/7', 0.2222, 0.2500, 0.2857, '2020-12-01 23:58:50', NULL, NULL);
INSERT INTO `m_himpunan` VALUES (17, '9 kali kurang penting', '2/9', '2/9', '1/4', 0.2222, 0.2222, 0.2500, '2020-12-01 23:59:16', NULL, NULL);

-- ----------------------------
-- Table structure for m_menu
-- ----------------------------
DROP TABLE IF EXISTS `m_menu`;
CREATE TABLE `m_menu`  (
  `id` int(11) NOT NULL,
  `id_parent` int(11) NOT NULL,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `judul` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `link` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `icon` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `aktif` int(1) NULL DEFAULT NULL,
  `tingkat` int(11) NULL DEFAULT NULL,
  `urutan` int(11) NULL DEFAULT NULL,
  `add_button` int(1) NULL DEFAULT NULL,
  `edit_button` int(1) NULL DEFAULT NULL,
  `delete_button` int(1) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of m_menu
-- ----------------------------
INSERT INTO `m_menu` VALUES (1, 0, 'Dashboard', 'Dashboard', 'home', 'flaticon2-architecture-and-city', 1, 1, 1, 0, 0, 0);
INSERT INTO `m_menu` VALUES (2, 0, 'Setting (Administrator)', 'Setting', NULL, 'flaticon2-gear', 1, 1, 5, 0, 0, 0);
INSERT INTO `m_menu` VALUES (3, 2, 'Setting Menu', 'Setting Menu', 'set_menu', 'flaticon-grid-menu', 1, 2, 2, 1, 1, 1);
INSERT INTO `m_menu` VALUES (4, 2, 'Setting Role', 'Setting Role', 'set_role', 'flaticon-network', 1, 2, 1, 1, 1, 1);
INSERT INTO `m_menu` VALUES (6, 0, 'Master', 'Master', '', 'flaticon-folder-1', 1, 1, 2, 0, 0, 0);
INSERT INTO `m_menu` VALUES (7, 6, 'Data User', 'Data User', 'master_user', 'flaticon-users', 1, 2, 1, 1, 1, 1);
INSERT INTO `m_menu` VALUES (8, 6, 'Master Himpunan', 'Master Himpunan', 'master_himpunan', 'flaticon2-console', 1, 2, 2, 1, 1, 1);

-- ----------------------------
-- Table structure for m_role
-- ----------------------------
DROP TABLE IF EXISTS `m_role`;
CREATE TABLE `m_role`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `keterangan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '',
  `aktif` int(1) NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of m_role
-- ----------------------------
INSERT INTO `m_role` VALUES (1, 'Administrator', 'Level Administrator Role', 1);
INSERT INTO `m_role` VALUES (2, 'Staff Admin', 'Role Untuk Staff Admin', 1);

-- ----------------------------
-- Table structure for m_user
-- ----------------------------
DROP TABLE IF EXISTS `m_user`;
CREATE TABLE `m_user`  (
  `id` int(64) NOT NULL AUTO_INCREMENT,
  `id_role` int(64) NULL DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status` int(1) NULL DEFAULT NULL,
  `last_login` datetime(0) NULL DEFAULT NULL,
  `kode_user` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_user
-- ----------------------------
INSERT INTO `m_user` VALUES (1, 1, 'admin', 'SnIvSVV6c2UwdWhKS1ZKMDluUlp4dz09', 1, '2020-12-01 21:09:12', 'USR-00001', NULL, NULL, NULL, NULL);
INSERT INTO `m_user` VALUES (2, 1, 'coba', 'Tzg1eTllUlU2a2xNQk5yYktIM1pwUT09', NULL, NULL, 'USR-00002', 'coba-1602775328.jpg', '2020-10-15 22:22:08', '2020-10-15 22:43:54', '2020-10-15 22:58:50');

-- ----------------------------
-- Table structure for t_role_menu
-- ----------------------------
DROP TABLE IF EXISTS `t_role_menu`;
CREATE TABLE `t_role_menu`  (
  `id_menu` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `add_button` int(1) NULL DEFAULT 0,
  `edit_button` int(1) NULL DEFAULT 0,
  `delete_button` int(1) NULL DEFAULT 0,
  INDEX `f_level_user`(`id_role`) USING BTREE,
  INDEX `id_menu`(`id_menu`) USING BTREE,
  CONSTRAINT `t_role_menu_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `m_role` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `t_role_menu_ibfk_2` FOREIGN KEY (`id_menu`) REFERENCES `m_menu` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of t_role_menu
-- ----------------------------
INSERT INTO `t_role_menu` VALUES (1, 1, 0, 0, 0);
INSERT INTO `t_role_menu` VALUES (6, 1, 0, 0, 0);
INSERT INTO `t_role_menu` VALUES (7, 1, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (8, 1, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (2, 1, 0, 0, 0);
INSERT INTO `t_role_menu` VALUES (4, 1, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (3, 1, 1, 1, 1);

SET FOREIGN_KEY_CHECKS = 1;
