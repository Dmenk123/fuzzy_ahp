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

 Date: 07/12/2020 00:30:05
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
  `is_sama_penting` int(1) NULL DEFAULT NULL,
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
INSERT INTO `m_himpunan` VALUES (1, '9 kali lebih penting', '4', '9/2', '9/2', NULL, 4.0000, 4.5000, 4.5000, '2020-12-01 23:21:04', '2020-12-01 23:51:56', NULL);
INSERT INTO `m_himpunan` VALUES (2, '8 kali lebih penting', '7/2', '4', '9/2', NULL, 3.5000, 4.0000, 4.5000, '2020-12-01 23:22:27', '2020-12-01 23:52:08', NULL);
INSERT INTO `m_himpunan` VALUES (3, '7 kali lebih penting', '3', '7/2', '4', NULL, 3.0000, 3.5000, 4.0000, '2020-12-01 23:43:29', '2020-12-01 23:52:46', NULL);
INSERT INTO `m_himpunan` VALUES (4, '6 kali lebih penting', '5/2', '3', '7/2', NULL, 2.5000, 3.0000, 3.5000, '2020-12-01 23:44:14', '2020-12-01 23:52:57', NULL);
INSERT INTO `m_himpunan` VALUES (5, '5 kali lebih penting', '2', '5/2', '3', NULL, 2.0000, 2.5000, 3.0000, '2020-12-01 23:45:05', '2020-12-01 23:53:49', NULL);
INSERT INTO `m_himpunan` VALUES (6, '4 kali lebih penting', '3/2', '2', '5/2', NULL, 1.5000, 2.0000, 2.5000, '2020-12-01 23:46:03', '2020-12-01 23:53:57', NULL);
INSERT INTO `m_himpunan` VALUES (7, '3 kali lebih penting', '1', '3/2', '2', NULL, 1.0000, 1.5000, 2.0000, '2020-12-01 23:47:24', '2020-12-01 23:54:08', NULL);
INSERT INTO `m_himpunan` VALUES (8, '2 kali lebih penting', '1/2', '1', '3/2', NULL, 0.5000, 1.0000, 1.5000, '2020-12-01 23:47:50', '2020-12-01 23:54:16', NULL);
INSERT INTO `m_himpunan` VALUES (9, 'Sama Penting', '1', '1', '1', 1, 1.0000, 1.0000, 1.0000, '2020-12-01 23:48:07', '2020-12-01 23:54:25', NULL);
INSERT INTO `m_himpunan` VALUES (10, '2 kali kurang penting', '2/3', '1', '2', NULL, 0.6667, 1.0000, 2.0000, '2020-12-01 23:55:34', NULL, NULL);
INSERT INTO `m_himpunan` VALUES (11, '3 kali kurang penting', '1/2', '2/3', '1', NULL, 0.5000, 0.6667, 1.0000, '2020-12-01 23:56:07', NULL, NULL);
INSERT INTO `m_himpunan` VALUES (12, '4 kali kurang penting', '2/5', '1/2', '2/3', NULL, 0.4000, 0.5000, 0.6667, '2020-12-01 23:56:35', NULL, NULL);
INSERT INTO `m_himpunan` VALUES (13, '5 kali kurang penting', '1/3', '2/5', '1/2', NULL, 0.3333, 0.4000, 0.5000, '2020-12-01 23:57:05', NULL, NULL);
INSERT INTO `m_himpunan` VALUES (14, '6 kali kurang penting', '2/7', '1/3', '2/5', NULL, 0.2857, 0.3333, 0.4000, '2020-12-01 23:57:45', NULL, NULL);
INSERT INTO `m_himpunan` VALUES (15, '7 kali kurang penting', '1/4', '2/7', '1/3', NULL, 0.2500, 0.2857, 0.3333, '2020-12-01 23:58:20', NULL, NULL);
INSERT INTO `m_himpunan` VALUES (16, '8 kali kurang penting', '2/9', '1/4', '2/7', NULL, 0.2222, 0.2500, 0.2857, '2020-12-01 23:58:50', NULL, NULL);
INSERT INTO `m_himpunan` VALUES (17, '9 kali kurang penting', '2/9', '2/9', '1/4', NULL, 0.2222, 0.2222, 0.2500, '2020-12-01 23:59:16', NULL, NULL);

-- ----------------------------
-- Table structure for m_kategori
-- ----------------------------
DROP TABLE IF EXISTS `m_kategori`;
CREATE TABLE `m_kategori`  (
  `id` int(11) NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_kategori
-- ----------------------------
INSERT INTO `m_kategori` VALUES (1, 'UMUM', '2020-12-02 22:58:05', NULL, NULL);
INSERT INTO `m_kategori` VALUES (2, 'DRAINASE', '2020-12-02 22:58:15', NULL, NULL);
INSERT INTO `m_kategori` VALUES (3, 'PEKERJAAN TANAH', '2020-12-02 22:58:27', NULL, NULL);
INSERT INTO `m_kategori` VALUES (4, 'PERKERASAN BERBUTIR DAN BETON SEMEN', '2020-12-02 22:58:44', NULL, NULL);
INSERT INTO `m_kategori` VALUES (5, 'PERKERASAN BERASPAL', '2020-12-02 22:58:53', NULL, NULL);
INSERT INTO `m_kategori` VALUES (6, 'STRUKTUR', '2020-12-02 22:59:02', '2020-12-02 22:59:40', NULL);
INSERT INTO `m_kategori` VALUES (7, 'PENGEMBALIAN KONDISI', '2020-12-02 22:59:11', NULL, NULL);

-- ----------------------------
-- Table structure for m_kriteria
-- ----------------------------
DROP TABLE IF EXISTS `m_kriteria`;
CREATE TABLE `m_kriteria`  (
  `id` int(11) NOT NULL,
  `id_kategori` int(11) NULL DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kode_kriteria` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `urut` int(5) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_kriteria
-- ----------------------------
INSERT INTO `m_kriteria` VALUES (1, 1, 'PENGUKURAN', 'C1', 1, '2020-12-03 08:24:39', NULL, NULL);
INSERT INTO `m_kriteria` VALUES (2, 1, 'PAS. PAPAN NAMA PROYEK', 'C2', 2, '2020-12-03 08:24:57', '2020-12-03 20:46:31', NULL);
INSERT INTO `m_kriteria` VALUES (3, 1, 'PENGAMANAN LALU LINTAS', 'C3', 3, '2020-12-03 08:25:09', NULL, NULL);
INSERT INTO `m_kriteria` VALUES (4, 1, 'PASANG RAMBU LALU LINTAS', 'C4', 4, '2020-12-03 08:25:20', NULL, NULL);
INSERT INTO `m_kriteria` VALUES (5, 1, 'PEMBERSIHAN', 'C5', 5, '2020-12-03 08:25:32', '2020-12-03 08:30:38', NULL);
INSERT INTO `m_kriteria` VALUES (6, 1, 'MOBILISASI DAN DEMOBILISASI', 'C6', 6, '2020-12-03 08:25:45', NULL, NULL);
INSERT INTO `m_kriteria` VALUES (7, 1, 'QUALITY CONTROL', 'C7', 7, '2020-12-03 08:25:56', NULL, NULL);
INSERT INTO `m_kriteria` VALUES (8, 1, 'PEMINDAHAN TIANG UTILITAS', 'C8', 8, '2020-12-03 08:26:06', NULL, NULL);
INSERT INTO `m_kriteria` VALUES (9, 1, 'PEMINDAHAN POHON', 'C9', 9, '2020-12-03 08:26:18', NULL, NULL);

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
INSERT INTO `m_menu` VALUES (9, 6, 'Master Kategori', 'Master Kategori', 'master_kategori', 'flaticon-background', 1, 2, 3, 1, 1, 1);
INSERT INTO `m_menu` VALUES (10, 6, 'Master Kriteria', 'Master Kriteria', 'master_kriteria', 'flaticon-web', 1, 2, 4, 1, 1, 1);
INSERT INTO `m_menu` VALUES (11, 0, 'Perhitungan', 'Perhitungan', '', 'flaticon-list', 1, 1, 3, 0, 0, 0);
INSERT INTO `m_menu` VALUES (12, 11, 'Perhitungan Perkategori', 'Perhitungan Perkategori', 'hitung_kategori', 'flaticon-list-2', 1, 2, 1, 1, 1, 1);
INSERT INTO `m_menu` VALUES (13, 11, 'Data Perhitungan', 'Data Perhitungan', 'data_hitung', 'flaticon-statistics', 1, 2, 2, 1, 1, 1);

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
INSERT INTO `m_user` VALUES (1, 1, 'admin', 'SnIvSVV6c2UwdWhKS1ZKMDluUlp4dz09', 1, '2020-12-06 22:11:45', 'USR-00001', NULL, NULL, NULL, NULL);
INSERT INTO `m_user` VALUES (2, 1, 'coba', 'Tzg1eTllUlU2a2xNQk5yYktIM1pwUT09', NULL, NULL, 'USR-00002', 'coba-1602775328.jpg', '2020-10-15 22:22:08', '2020-10-15 22:43:54', '2020-10-15 22:58:50');

-- ----------------------------
-- Table structure for t_hitung_kategori
-- ----------------------------
DROP TABLE IF EXISTS `t_hitung_kategori`;
CREATE TABLE `t_hitung_kategori`  (
  `id` int(11) NOT NULL,
  `id_kategori` int(11) NULL DEFAULT NULL,
  `id_kriteria` int(11) NULL DEFAULT NULL,
  `kode_kriteria` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_himpunan` int(11) NULL DEFAULT NULL,
  `id_kriteria_tujuan` int(11) NULL DEFAULT NULL,
  `kode_kriteria_tujuan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `flag_proses_id_kriteria` int(11) NULL DEFAULT NULL COMMENT 'di proses pada id_kriteria berapa ?',
  `flag_proses_kode_kriteria` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'di proses pada kode_kriteria berapa ?',
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_hitung_kategori
-- ----------------------------
INSERT INTO `t_hitung_kategori` VALUES (1, 1, 1, 'C1', 9, 1, 'C1', 1, 'C1', '2020-12-07 00:22:04', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (2, 1, 1, 'C1', 1, 2, 'C2', 1, 'C1', '2020-12-07 00:22:04', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (3, 1, 2, 'C2', 17, 1, 'C1', 1, 'C1', '2020-12-07 00:22:04', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (4, 1, 1, 'C1', 2, 3, 'C3', 1, 'C1', '2020-12-07 00:22:04', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (5, 1, 3, 'C3', 16, 1, 'C1', 1, 'C1', '2020-12-07 00:22:04', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (6, 1, 1, 'C1', 3, 4, 'C4', 1, 'C1', '2020-12-07 00:22:04', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (7, 1, 4, 'C4', 15, 1, 'C1', 1, 'C1', '2020-12-07 00:22:04', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (8, 1, 1, 'C1', 4, 5, 'C5', 1, 'C1', '2020-12-07 00:22:04', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (9, 1, 5, 'C5', 14, 1, 'C1', 1, 'C1', '2020-12-07 00:22:04', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (10, 1, 1, 'C1', 5, 6, 'C6', 1, 'C1', '2020-12-07 00:22:04', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (11, 1, 6, 'C6', 13, 1, 'C1', 1, 'C1', '2020-12-07 00:22:04', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (12, 1, 1, 'C1', 6, 7, 'C7', 1, 'C1', '2020-12-07 00:22:04', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (13, 1, 7, 'C7', 12, 1, 'C1', 1, 'C1', '2020-12-07 00:22:04', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (14, 1, 1, 'C1', 7, 8, 'C8', 1, 'C1', '2020-12-07 00:22:04', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (15, 1, 8, 'C8', 11, 1, 'C1', 1, 'C1', '2020-12-07 00:22:04', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (16, 1, 1, 'C1', 8, 9, 'C9', 1, 'C1', '2020-12-07 00:22:04', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (17, 1, 9, 'C9', 10, 1, 'C1', 1, 'C1', '2020-12-07 00:22:04', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (18, 1, 2, 'C2', 9, 2, 'C2', 2, 'C2', '2020-12-07 00:26:59', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (19, 1, 2, 'C2', 1, 3, 'C3', 2, 'C2', '2020-12-07 00:26:59', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (20, 1, 3, 'C3', 17, 2, 'C2', 2, 'C2', '2020-12-07 00:26:59', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (21, 1, 2, 'C2', 2, 4, 'C4', 2, 'C2', '2020-12-07 00:26:59', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (22, 1, 4, 'C4', 16, 2, 'C2', 2, 'C2', '2020-12-07 00:26:59', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (23, 1, 2, 'C2', 3, 5, 'C5', 2, 'C2', '2020-12-07 00:26:59', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (24, 1, 5, 'C5', 15, 2, 'C2', 2, 'C2', '2020-12-07 00:26:59', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (25, 1, 2, 'C2', 4, 6, 'C6', 2, 'C2', '2020-12-07 00:26:59', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (26, 1, 6, 'C6', 14, 2, 'C2', 2, 'C2', '2020-12-07 00:26:59', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (27, 1, 2, 'C2', 5, 7, 'C7', 2, 'C2', '2020-12-07 00:26:59', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (28, 1, 7, 'C7', 13, 2, 'C2', 2, 'C2', '2020-12-07 00:26:59', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (29, 1, 2, 'C2', 6, 8, 'C8', 2, 'C2', '2020-12-07 00:26:59', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (30, 1, 8, 'C8', 12, 2, 'C2', 2, 'C2', '2020-12-07 00:26:59', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (31, 1, 2, 'C2', 7, 9, 'C9', 2, 'C2', '2020-12-07 00:26:59', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (32, 1, 9, 'C9', 11, 2, 'C2', 2, 'C2', '2020-12-07 00:26:59', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (33, 1, 3, 'C3', 9, 3, 'C3', 3, 'C3', '2020-12-07 00:27:35', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (34, 1, 3, 'C3', 1, 4, 'C4', 3, 'C3', '2020-12-07 00:27:35', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (35, 1, 4, 'C4', 17, 3, 'C3', 3, 'C3', '2020-12-07 00:27:35', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (36, 1, 3, 'C3', 2, 5, 'C5', 3, 'C3', '2020-12-07 00:27:35', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (37, 1, 5, 'C5', 16, 3, 'C3', 3, 'C3', '2020-12-07 00:27:35', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (38, 1, 3, 'C3', 3, 6, 'C6', 3, 'C3', '2020-12-07 00:27:35', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (39, 1, 6, 'C6', 15, 3, 'C3', 3, 'C3', '2020-12-07 00:27:35', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (40, 1, 3, 'C3', 4, 7, 'C7', 3, 'C3', '2020-12-07 00:27:35', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (41, 1, 7, 'C7', 14, 3, 'C3', 3, 'C3', '2020-12-07 00:27:35', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (42, 1, 3, 'C3', 5, 8, 'C8', 3, 'C3', '2020-12-07 00:27:35', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (43, 1, 8, 'C8', 13, 3, 'C3', 3, 'C3', '2020-12-07 00:27:35', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (44, 1, 3, 'C3', 6, 9, 'C9', 3, 'C3', '2020-12-07 00:27:35', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (45, 1, 9, 'C9', 12, 3, 'C3', 3, 'C3', '2020-12-07 00:27:35', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (46, 1, 4, 'C4', 9, 4, 'C4', 4, 'C4', '2020-12-07 00:28:06', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (47, 1, 4, 'C4', 1, 5, 'C5', 4, 'C4', '2020-12-07 00:28:06', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (48, 1, 5, 'C5', 17, 4, 'C4', 4, 'C4', '2020-12-07 00:28:06', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (49, 1, 4, 'C4', 2, 6, 'C6', 4, 'C4', '2020-12-07 00:28:06', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (50, 1, 6, 'C6', 16, 4, 'C4', 4, 'C4', '2020-12-07 00:28:06', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (51, 1, 4, 'C4', 3, 7, 'C7', 4, 'C4', '2020-12-07 00:28:06', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (52, 1, 7, 'C7', 15, 4, 'C4', 4, 'C4', '2020-12-07 00:28:06', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (53, 1, 4, 'C4', 4, 8, 'C8', 4, 'C4', '2020-12-07 00:28:06', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (54, 1, 8, 'C8', 14, 4, 'C4', 4, 'C4', '2020-12-07 00:28:06', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (55, 1, 4, 'C4', 5, 9, 'C9', 4, 'C4', '2020-12-07 00:28:06', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (56, 1, 9, 'C9', 13, 4, 'C4', 4, 'C4', '2020-12-07 00:28:06', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (57, 1, 5, 'C5', 9, 5, 'C5', 5, 'C5', '2020-12-07 00:28:50', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (58, 1, 5, 'C5', 1, 6, 'C6', 5, 'C5', '2020-12-07 00:28:50', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (59, 1, 6, 'C6', 17, 5, 'C5', 5, 'C5', '2020-12-07 00:28:50', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (60, 1, 5, 'C5', 2, 7, 'C7', 5, 'C5', '2020-12-07 00:28:50', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (61, 1, 7, 'C7', 16, 5, 'C5', 5, 'C5', '2020-12-07 00:28:50', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (62, 1, 5, 'C5', 3, 8, 'C8', 5, 'C5', '2020-12-07 00:28:50', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (63, 1, 8, 'C8', 15, 5, 'C5', 5, 'C5', '2020-12-07 00:28:50', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (64, 1, 5, 'C5', 4, 9, 'C9', 5, 'C5', '2020-12-07 00:28:50', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (65, 1, 9, 'C9', 14, 5, 'C5', 5, 'C5', '2020-12-07 00:28:50', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (66, 1, 7, 'C7', 9, 7, 'C7', 7, 'C7', '2020-12-07 00:29:19', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (67, 1, 7, 'C7', 1, 8, 'C8', 7, 'C7', '2020-12-07 00:29:19', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (68, 1, 8, 'C8', 17, 7, 'C7', 7, 'C7', '2020-12-07 00:29:19', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (69, 1, 7, 'C7', 2, 9, 'C9', 7, 'C7', '2020-12-07 00:29:19', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (70, 1, 9, 'C9', 16, 7, 'C7', 7, 'C7', '2020-12-07 00:29:19', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (71, 1, 8, 'C8', 9, 8, 'C8', 8, 'C8', '2020-12-07 00:29:43', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (72, 1, 8, 'C8', 1, 9, 'C9', 8, 'C8', '2020-12-07 00:29:43', NULL, NULL);
INSERT INTO `t_hitung_kategori` VALUES (73, 1, 9, 'C9', 17, 8, 'C8', 8, 'C8', '2020-12-07 00:29:43', NULL, NULL);

-- ----------------------------
-- Table structure for t_pasangan_himpunan
-- ----------------------------
DROP TABLE IF EXISTS `t_pasangan_himpunan`;
CREATE TABLE `t_pasangan_himpunan`  (
  `id` int(11) NOT NULL,
  `id_himpunan_use` int(11) NULL DEFAULT NULL,
  `id_himpunan_reverse` int(11) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_pasangan_himpunan
-- ----------------------------
INSERT INTO `t_pasangan_himpunan` VALUES (1, 1, 17, '2020-12-03 22:36:23', NULL, NULL);
INSERT INTO `t_pasangan_himpunan` VALUES (2, 2, 16, '2020-12-03 22:36:23', NULL, NULL);
INSERT INTO `t_pasangan_himpunan` VALUES (3, 3, 15, '2020-12-03 22:36:23', NULL, NULL);
INSERT INTO `t_pasangan_himpunan` VALUES (4, 4, 14, '2020-12-03 22:36:23', NULL, NULL);
INSERT INTO `t_pasangan_himpunan` VALUES (5, 5, 13, '2020-12-03 22:36:23', NULL, NULL);
INSERT INTO `t_pasangan_himpunan` VALUES (6, 6, 12, '2020-12-03 22:36:23', NULL, NULL);
INSERT INTO `t_pasangan_himpunan` VALUES (7, 7, 11, '2020-12-03 22:36:23', NULL, NULL);
INSERT INTO `t_pasangan_himpunan` VALUES (8, 8, 10, '2020-12-03 22:36:23', NULL, NULL);
INSERT INTO `t_pasangan_himpunan` VALUES (9, 9, 9, '2020-12-03 22:36:23', NULL, NULL);
INSERT INTO `t_pasangan_himpunan` VALUES (10, 10, 8, '2020-12-03 22:36:23', NULL, NULL);
INSERT INTO `t_pasangan_himpunan` VALUES (11, 11, 7, '2020-12-03 22:36:23', NULL, NULL);
INSERT INTO `t_pasangan_himpunan` VALUES (12, 12, 6, '2020-12-03 22:36:23', NULL, NULL);
INSERT INTO `t_pasangan_himpunan` VALUES (13, 13, 5, '2020-12-03 22:36:23', NULL, NULL);
INSERT INTO `t_pasangan_himpunan` VALUES (14, 14, 4, '2020-12-03 22:36:23', NULL, NULL);
INSERT INTO `t_pasangan_himpunan` VALUES (15, 15, 3, '2020-12-03 22:36:23', NULL, NULL);
INSERT INTO `t_pasangan_himpunan` VALUES (16, 16, 2, '2020-12-03 22:36:23', NULL, NULL);
INSERT INTO `t_pasangan_himpunan` VALUES (17, 17, 1, '2020-12-03 22:36:23', NULL, NULL);

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
INSERT INTO `t_role_menu` VALUES (9, 1, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (10, 1, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (11, 1, 0, 0, 0);
INSERT INTO `t_role_menu` VALUES (12, 1, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (13, 1, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (2, 1, 0, 0, 0);
INSERT INTO `t_role_menu` VALUES (4, 1, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (3, 1, 1, 1, 1);

SET FOREIGN_KEY_CHECKS = 1;
