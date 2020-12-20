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

 Date: 21/12/2020 01:01:51
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
  `kode_kategori` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `urut` int(5) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_kategori
-- ----------------------------
INSERT INTO `m_kategori` VALUES (1, 'UMUM', 'C1', 1, '2020-12-02 22:58:05', NULL, NULL);
INSERT INTO `m_kategori` VALUES (2, 'DRAINASE', 'C2', 2, '2020-12-02 22:58:15', NULL, NULL);
INSERT INTO `m_kategori` VALUES (3, 'PEKERJAAN TANAH', 'C3', 3, '2020-12-02 22:58:27', NULL, NULL);
INSERT INTO `m_kategori` VALUES (4, 'PERKERASAN BERBUTIR DAN BETON SEMEN', 'C4', 4, '2020-12-02 22:58:44', NULL, NULL);
INSERT INTO `m_kategori` VALUES (5, 'PERKERASAN BERASPAL', 'C5', 5, '2020-12-02 22:58:53', NULL, NULL);
INSERT INTO `m_kategori` VALUES (6, 'STRUKTUR', 'C6', 6, '2020-12-02 22:59:02', '2020-12-02 22:59:40', NULL);
INSERT INTO `m_kategori` VALUES (7, 'PENGEMBALIAN KONDISI', 'C7', 7, '2020-12-02 22:59:11', NULL, NULL);

-- ----------------------------
-- Table structure for m_kriteria
-- ----------------------------
DROP TABLE IF EXISTS `m_kriteria`;
CREATE TABLE `m_kriteria`  (
  `id` int(11) NOT NULL,
  `id_kategori` int(11) NULL DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `urut` int(5) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_kriteria
-- ----------------------------
INSERT INTO `m_kriteria` VALUES (1, 1, 'PENGUKURAN', 1, '2020-12-03 08:24:39', NULL, NULL);
INSERT INTO `m_kriteria` VALUES (2, 1, 'PAS. PAPAN NAMA PROYEK', 2, '2020-12-03 08:24:57', '2020-12-03 20:46:31', NULL);
INSERT INTO `m_kriteria` VALUES (3, 1, 'PENGAMANAN LALU LINTAS', 3, '2020-12-03 08:25:09', '2020-12-13 23:25:59', NULL);
INSERT INTO `m_kriteria` VALUES (4, 1, 'PASANG RAMBU LALU LINTAS', 4, '2020-12-03 08:25:20', NULL, NULL);
INSERT INTO `m_kriteria` VALUES (5, 1, 'PEMBERSIHAN', 5, '2020-12-03 08:25:32', '2020-12-03 08:30:38', NULL);
INSERT INTO `m_kriteria` VALUES (6, 1, 'MOBILISASI DAN DEMOBILISASI', 6, '2020-12-03 08:25:45', NULL, NULL);
INSERT INTO `m_kriteria` VALUES (7, 1, 'QUALITY CONTROL', 7, '2020-12-03 08:25:56', NULL, NULL);
INSERT INTO `m_kriteria` VALUES (8, 1, 'PEMINDAHAN TIANG UTILITAS', 8, '2020-12-03 08:26:06', NULL, NULL);
INSERT INTO `m_kriteria` VALUES (9, 1, 'PEMINDAHAN POHON', 9, '2020-12-03 08:26:18', NULL, NULL);
INSERT INTO `m_kriteria` VALUES (10, 2, 'GALIAN UTK DRAINASE, SALURAN DAN SALURAN AIR', 1, '2020-12-13 23:30:05', NULL, NULL);
INSERT INTO `m_kriteria` VALUES (11, 2, 'PEKERJAAN SALURAN TEPI (U-DITCH 60.80.120) GANDAR 10 T', 2, '2020-12-13 23:30:35', NULL, NULL);
INSERT INTO `m_kriteria` VALUES (12, 2, 'PEKERJAAN TUTUP SALURAN (COVER U-DITCH 76.12.120) GANDAR 10 T', 3, '2020-12-13 23:31:04', NULL, NULL);
INSERT INTO `m_kriteria` VALUES (13, 2, 'COR SETEMPAT K-225', 4, '2020-12-13 23:31:32', NULL, NULL);
INSERT INTO `m_kriteria` VALUES (14, 2, 'PEKERJAAN BOX CULVERT 100.100.120) GANDAR 20 T', 5, '2020-12-13 23:31:54', NULL, NULL);

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
INSERT INTO `m_menu` VALUES (12, 11, 'Perhitungan AHP', 'Perhitungan AHP', 'hitung_ahp', 'flaticon-list-2', 1, 2, 1, 1, 1, 1);
INSERT INTO `m_menu` VALUES (13, 11, 'Data Perhitungan', 'Data Perhitungan', 'data_hitung', 'flaticon-statistics', 1, 2, 2, 1, 1, 1);

-- ----------------------------
-- Table structure for m_proyek
-- ----------------------------
DROP TABLE IF EXISTS `m_proyek`;
CREATE TABLE `m_proyek`  (
  `id` int(11) NOT NULL,
  `nama_proyek` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `keterangan_proyek` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tahun_proyek` int(11) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_proyek
-- ----------------------------
INSERT INTO `m_proyek` VALUES (1, 'Jembatan Suramadu', 'Pembangunan Jembatan Suramadu', 2020, '2020-12-09 12:18:33', NULL, NULL);
INSERT INTO `m_proyek` VALUES (2, 'Musholla', 'Pembangunan Musholla', 2019, '2020-12-09 12:18:33', NULL, NULL);

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
INSERT INTO `m_user` VALUES (1, 1, 'admin', 'SnIvSVV6c2UwdWhKS1ZKMDluUlp4dz09', 1, '2020-12-20 22:48:13', 'USR-00001', NULL, NULL, NULL, NULL);
INSERT INTO `m_user` VALUES (2, 1, 'coba', 'Tzg1eTllUlU2a2xNQk5yYktIM1pwUT09', NULL, NULL, 'USR-00002', 'coba-1602775328.jpg', '2020-10-15 22:22:08', '2020-10-15 22:43:54', '2020-10-15 22:58:50');

-- ----------------------------
-- Table structure for t_hitung
-- ----------------------------
DROP TABLE IF EXISTS `t_hitung`;
CREATE TABLE `t_hitung`  (
  `id` int(11) NOT NULL,
  `id_proyek` int(11) NULL DEFAULT NULL,
  `id_user` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `total_lower` float(20, 4) NULL DEFAULT NULL,
  `total_medium` float(20, 4) NULL DEFAULT NULL,
  `total_upper` float(20, 4) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_hitung
-- ----------------------------
INSERT INTO `t_hitung` VALUES (1, 2, '1', 51.7515, 64.9580, 81.0691, '2020-12-18 19:43:01', NULL, NULL);

-- ----------------------------
-- Table structure for t_hitung_det
-- ----------------------------
DROP TABLE IF EXISTS `t_hitung_det`;
CREATE TABLE `t_hitung_det`  (
  `id` int(11) NOT NULL,
  `id_hitung` int(11) NULL DEFAULT NULL,
  `id_kategori` int(11) NULL DEFAULT NULL,
  `kode_kategori` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_himpunan` int(11) NULL DEFAULT NULL,
  `id_kategori_tujuan` int(11) NULL DEFAULT NULL,
  `kode_kategori_tujuan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `flag_proses_id_kategori` int(11) NULL DEFAULT NULL COMMENT 'di proses pada id_kategori berapa ?',
  `flag_proses_kode_kategori` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'di proses pada kode_kategori berapa ?',
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_hitung_det
-- ----------------------------
INSERT INTO `t_hitung_det` VALUES (54, 1, 1, 'C1', 9, 1, 'C1', 1, 'C1', '2020-12-19 00:03:55', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (55, 1, 1, 'C1', 4, 2, 'C2', 1, 'C1', '2020-12-19 00:03:55', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (56, 1, 2, 'C2', 14, 1, 'C1', 1, 'C1', '2020-12-19 00:03:55', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (57, 1, 1, 'C1', 6, 3, 'C3', 1, 'C1', '2020-12-19 00:03:55', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (58, 1, 3, 'C3', 12, 1, 'C1', 1, 'C1', '2020-12-19 00:03:55', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (59, 1, 1, 'C1', 5, 4, 'C4', 1, 'C1', '2020-12-19 00:03:55', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (60, 1, 4, 'C4', 13, 1, 'C1', 1, 'C1', '2020-12-19 00:03:55', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (61, 1, 1, 'C1', 7, 5, 'C5', 1, 'C1', '2020-12-19 00:03:55', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (62, 1, 5, 'C5', 11, 1, 'C1', 1, 'C1', '2020-12-19 00:03:55', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (63, 1, 1, 'C1', 1, 6, 'C6', 1, 'C1', '2020-12-19 00:03:55', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (64, 1, 6, 'C6', 17, 1, 'C1', 1, 'C1', '2020-12-19 00:03:55', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (65, 1, 1, 'C1', 8, 7, 'C7', 1, 'C1', '2020-12-19 00:03:55', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (66, 1, 7, 'C7', 10, 1, 'C1', 1, 'C1', '2020-12-19 00:03:55', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (67, 1, 2, 'C2', 9, 2, 'C2', 2, 'C2', '2020-12-19 00:04:06', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (68, 1, 2, 'C2', 5, 3, 'C3', 2, 'C2', '2020-12-19 00:04:06', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (69, 1, 3, 'C3', 13, 2, 'C2', 2, 'C2', '2020-12-19 00:04:06', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (70, 1, 2, 'C2', 4, 4, 'C4', 2, 'C2', '2020-12-19 00:04:06', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (71, 1, 4, 'C4', 14, 2, 'C2', 2, 'C2', '2020-12-19 00:04:06', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (72, 1, 2, 'C2', 6, 5, 'C5', 2, 'C2', '2020-12-19 00:04:06', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (73, 1, 5, 'C5', 12, 2, 'C2', 2, 'C2', '2020-12-19 00:04:06', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (74, 1, 2, 'C2', 3, 6, 'C6', 2, 'C2', '2020-12-19 00:04:06', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (75, 1, 6, 'C6', 15, 2, 'C2', 2, 'C2', '2020-12-19 00:04:06', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (76, 1, 2, 'C2', 7, 7, 'C7', 2, 'C2', '2020-12-19 00:04:06', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (77, 1, 7, 'C7', 11, 2, 'C2', 2, 'C2', '2020-12-19 00:04:06', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (78, 1, 3, 'C3', 9, 3, 'C3', 3, 'C3', '2020-12-19 00:04:11', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (79, 1, 3, 'C3', 6, 4, 'C4', 3, 'C3', '2020-12-19 00:04:11', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (80, 1, 4, 'C4', 12, 3, 'C3', 3, 'C3', '2020-12-19 00:04:11', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (81, 1, 3, 'C3', 7, 5, 'C5', 3, 'C3', '2020-12-19 00:04:11', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (82, 1, 5, 'C5', 11, 3, 'C3', 3, 'C3', '2020-12-19 00:04:11', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (83, 1, 3, 'C3', 5, 6, 'C6', 3, 'C3', '2020-12-19 00:04:11', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (84, 1, 6, 'C6', 13, 3, 'C3', 3, 'C3', '2020-12-19 00:04:11', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (85, 1, 3, 'C3', 8, 7, 'C7', 3, 'C3', '2020-12-19 00:04:11', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (86, 1, 7, 'C7', 10, 3, 'C3', 3, 'C3', '2020-12-19 00:04:11', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (87, 1, 4, 'C4', 9, 4, 'C4', 4, 'C4', '2020-12-19 00:04:17', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (88, 1, 4, 'C4', 7, 5, 'C5', 4, 'C4', '2020-12-19 00:04:17', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (89, 1, 5, 'C5', 11, 4, 'C4', 4, 'C4', '2020-12-19 00:04:17', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (90, 1, 4, 'C4', 2, 6, 'C6', 4, 'C4', '2020-12-19 00:04:17', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (91, 1, 6, 'C6', 16, 4, 'C4', 4, 'C4', '2020-12-19 00:04:17', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (92, 1, 4, 'C4', 8, 7, 'C7', 4, 'C4', '2020-12-19 00:04:17', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (93, 1, 7, 'C7', 10, 4, 'C4', 4, 'C4', '2020-12-19 00:04:17', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (94, 1, 5, 'C5', 9, 5, 'C5', 5, 'C5', '2020-12-19 00:04:22', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (95, 1, 5, 'C5', 4, 6, 'C6', 5, 'C5', '2020-12-19 00:04:22', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (96, 1, 6, 'C6', 14, 5, 'C5', 5, 'C5', '2020-12-19 00:04:22', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (97, 1, 5, 'C5', 7, 7, 'C7', 5, 'C5', '2020-12-19 00:04:22', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (98, 1, 7, 'C7', 11, 5, 'C5', 5, 'C5', '2020-12-19 00:04:22', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (99, 1, 6, 'C6', 9, 6, 'C6', 6, 'C6', '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (100, 1, 6, 'C6', 7, 7, 'C7', 6, 'C6', '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (101, 1, 7, 'C7', 11, 6, 'C6', 6, 'C6', '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (102, 1, 7, 'C7', 9, 7, 'C7', 6, 'C6', '2020-12-21 00:59:31', NULL, NULL);

-- ----------------------------
-- Table structure for t_hitungan_vektor
-- ----------------------------
DROP TABLE IF EXISTS `t_hitungan_vektor`;
CREATE TABLE `t_hitungan_vektor`  (
  `id_hitung` int(11) NULL DEFAULT NULL,
  `id_kategori_proses` int(11) NULL DEFAULT NULL,
  `kode_kategori_proses` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_kategori` int(11) NULL DEFAULT NULL,
  `kode_kategori` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nilai_l` float(20, 4) NULL DEFAULT NULL,
  `nilai_m` float(20, 4) NULL DEFAULT NULL,
  `nilai_u` float(20, 4) NULL DEFAULT NULL,
  `bawah` float(20, 4) NULL DEFAULT NULL,
  `total` float(20, 4) NULL DEFAULT NULL,
  `hasil` float(20, 4) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_hitungan_vektor
-- ----------------------------
INSERT INTO `t_hitungan_vektor` VALUES (1, 1, 'C1', 2, 'C2', -0.2086, -0.1092, 0.0738, -0.1830, 1.1399, 1.0000, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 1, 'C1', 3, 'C3', -0.2647, -0.1092, 0.0539, -0.1631, 1.6229, 1.0000, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 1, 'C1', 4, 'C4', -0.2612, -0.1092, 0.0478, -0.1570, 1.6637, 1.0000, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 1, 'C1', 5, 'C5', -0.2689, -0.1092, 0.0443, -0.1535, 1.7518, 1.0000, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 1, 'C1', 6, 'C6', -0.3069, -0.1092, 0.0205, -0.1297, 2.3662, 1.0000, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 1, 'C1', 7, 'C7', -0.2923, -0.1092, 0.0369, -0.1461, 2.0007, 1.0000, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 2, 'C2', 1, 'C1', -0.1627, -0.1039, 0.0844, -0.1883, 0.8640, 0.8640, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 2, 'C2', 3, 'C3', -0.2338, -0.1039, 0.0539, -0.1578, 1.4816, 1.0000, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 2, 'C2', 4, 'C4', -0.2303, -0.1039, 0.0478, -0.1517, 1.5181, 1.0000, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 2, 'C2', 5, 'C5', -0.2380, -0.1039, 0.0443, -0.1482, 1.6059, 1.0000, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 2, 'C2', 6, 'C6', -0.2760, -0.1039, 0.0205, -0.1244, 2.2186, 1.0000, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 2, 'C2', 7, 'C7', -0.2614, -0.1039, 0.0369, -0.1408, 1.8565, 1.0000, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 3, 'C3', 1, 'C1', -0.0616, -0.0788, 0.0844, -0.1632, 0.3775, 0.3775, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 3, 'C3', 2, 'C2', -0.0766, -0.0788, 0.0738, -0.1526, 0.5020, 0.5020, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 3, 'C3', 4, 'C4', -0.1292, -0.0788, 0.0478, -0.1266, 1.0205, 1.0000, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 3, 'C3', 5, 'C5', -0.1369, -0.0788, 0.0443, -0.1231, 1.1121, 1.0000, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 3, 'C3', 6, 'C6', -0.1749, -0.0788, 0.0205, -0.0993, 1.7613, 1.0000, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 3, 'C3', 7, 'C7', -0.1603, -0.0788, 0.0369, -0.1157, 1.3855, 1.0000, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 4, 'C4', 1, 'C1', -0.0500, -0.0698, 0.0844, -0.1542, 0.3243, 0.3243, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 4, 'C4', 2, 'C2', -0.0650, -0.0698, 0.0738, -0.1436, 0.4526, 0.4526, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 4, 'C4', 3, 'C3', -0.1211, -0.0698, 0.0539, -0.1237, 0.9790, 0.9790, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 4, 'C4', 5, 'C5', -0.1253, -0.0698, 0.0443, -0.1141, 1.0982, 1.0000, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 4, 'C4', 6, 'C6', -0.1633, -0.0698, 0.0205, -0.0903, 1.8084, 1.0000, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 4, 'C4', 7, 'C7', -0.1487, -0.0698, 0.0369, -0.1067, 1.3936, 1.0000, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 5, 'C5', 1, 'C1', -0.0423, -0.0733, 0.0844, -0.1577, 0.2682, 0.2682, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 5, 'C5', 2, 'C2', -0.0573, -0.0733, 0.0738, -0.1471, 0.3895, 0.3895, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 5, 'C5', 3, 'C3', -0.1134, -0.0733, 0.0539, -0.1272, 0.8915, 0.8915, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 5, 'C5', 4, 'C4', -0.1099, -0.0733, 0.0478, -0.1211, 0.9075, 0.9075, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 5, 'C5', 6, 'C6', -0.1556, -0.0733, 0.0205, -0.0938, 1.6588, 1.0000, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 5, 'C5', 7, 'C7', -0.1410, -0.0733, 0.0369, -0.1102, 1.2795, 1.0000, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 6, 'C6', 1, 'C1', 0.0620, -0.0308, 0.0844, -0.1152, -0.5382, 0.0000, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 6, 'C6', 2, 'C2', 0.0470, -0.0308, 0.0738, -0.1046, -0.4493, 0.0000, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 6, 'C6', 3, 'C3', -0.0091, -0.0308, 0.0539, -0.0847, 0.1074, 0.1074, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 6, 'C6', 4, 'C4', -0.0056, -0.0308, 0.0478, -0.0786, 0.0712, 0.0712, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 6, 'C6', 5, 'C5', -0.0133, -0.0308, 0.0443, -0.0751, 0.1771, 0.1771, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 6, 'C6', 7, 'C7', -0.0367, -0.0308, 0.0369, -0.0677, 0.5421, 0.5421, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 7, 'C7', 1, 'C1', -0.0390, -0.1008, 0.0844, -0.1852, 0.2106, 0.2106, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 7, 'C7', 2, 'C2', -0.0540, -0.1008, 0.0738, -0.1746, 0.3093, 0.3093, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 7, 'C7', 3, 'C3', -0.1101, -0.1008, 0.0539, -0.1547, 0.7117, 0.7117, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 7, 'C7', 4, 'C4', -0.1066, -0.1008, 0.0478, -0.1486, 0.7174, 0.7174, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 7, 'C7', 5, 'C5', -0.1143, -0.1008, 0.0443, -0.1451, 0.7877, 0.7877, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 7, 'C7', 6, 'C6', -0.1523, -0.1008, 0.0205, -0.1213, 1.2556, 1.0000, '2020-12-21 00:59:31', NULL, NULL);

-- ----------------------------
-- Table structure for t_normalisasi
-- ----------------------------
DROP TABLE IF EXISTS `t_normalisasi`;
CREATE TABLE `t_normalisasi`  (
  `id_hitung` int(11) NULL DEFAULT NULL,
  `id_kategori` int(11) NULL DEFAULT NULL,
  `kode_kategori` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_kategori_tujuan` int(11) NULL DEFAULT NULL,
  `kode_kategori_tujuan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nilai` float(20, 4) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_normalisasi
-- ----------------------------
INSERT INTO `t_normalisasi` VALUES (1, 1, 'C1', 1, 'C1', 1.0000, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 1, 'C1', 2, 'C2', 1.0000, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 1, 'C1', 3, 'C3', 1.0000, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 1, 'C1', 4, 'C4', 1.0000, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 1, 'C1', 5, 'C5', 1.0000, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 1, 'C1', 6, 'C6', 1.0000, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 1, 'C1', 7, 'C7', 1.0000, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 2, 'C2', 2, 'C2', 1.0000, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 2, 'C2', 1, 'C1', 0.8640, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 2, 'C2', 3, 'C3', 1.0000, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 2, 'C2', 4, 'C4', 1.0000, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 2, 'C2', 5, 'C5', 1.0000, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 2, 'C2', 6, 'C6', 1.0000, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 2, 'C2', 7, 'C7', 1.0000, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 3, 'C3', 3, 'C3', 1.0000, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 3, 'C3', 1, 'C1', 0.3775, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 3, 'C3', 2, 'C2', 0.5020, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 3, 'C3', 4, 'C4', 1.0000, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 3, 'C3', 5, 'C5', 1.0000, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 3, 'C3', 6, 'C6', 1.0000, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 3, 'C3', 7, 'C7', 1.0000, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 4, 'C4', 4, 'C4', 1.0000, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 4, 'C4', 1, 'C1', 0.3243, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 4, 'C4', 2, 'C2', 0.4526, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 4, 'C4', 3, 'C3', 0.9790, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 4, 'C4', 5, 'C5', 1.0000, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 4, 'C4', 6, 'C6', 1.0000, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 4, 'C4', 7, 'C7', 1.0000, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 5, 'C5', 5, 'C5', 1.0000, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 5, 'C5', 1, 'C1', 0.2682, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 5, 'C5', 2, 'C2', 0.3895, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 5, 'C5', 3, 'C3', 0.8915, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 5, 'C5', 4, 'C4', 0.9075, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 5, 'C5', 6, 'C6', 1.0000, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 5, 'C5', 7, 'C7', 1.0000, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 6, 'C6', 6, 'C6', 1.0000, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 6, 'C6', 1, 'C1', 0.0000, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 6, 'C6', 2, 'C2', 0.0000, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 6, 'C6', 3, 'C3', 0.1074, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 6, 'C6', 4, 'C4', 0.0712, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 6, 'C6', 5, 'C5', 0.1771, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 6, 'C6', 7, 'C7', 0.5421, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 7, 'C7', 7, 'C7', 1.0000, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 7, 'C7', 1, 'C1', 0.2106, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 7, 'C7', 2, 'C2', 0.3093, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 7, 'C7', 3, 'C3', 0.7117, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 7, 'C7', 4, 'C4', 0.7174, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 7, 'C7', 5, 'C5', 0.7877, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 7, 'C7', 6, 'C6', 1.0000, '2020-12-21 00:59:31', NULL, NULL);

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

-- ----------------------------
-- Table structure for t_sintesis
-- ----------------------------
DROP TABLE IF EXISTS `t_sintesis`;
CREATE TABLE `t_sintesis`  (
  `id` int(11) NOT NULL,
  `id_hitung` int(11) NULL DEFAULT NULL,
  `id_kategori` int(11) NULL DEFAULT NULL,
  `kode_kategori` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `sintesis_lower` float(20, 4) NULL DEFAULT NULL,
  `sintesis_medium` float(20, 4) NULL DEFAULT NULL,
  `sintesis_upper` float(20, 4) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_sintesis
-- ----------------------------
INSERT INTO `t_sintesis` VALUES (1, 1, 1, 'C1', 0.1542, 0.2386, 0.3478, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_sintesis` VALUES (2, 1, 2, 'C2', 0.1392, 0.2130, 0.3169, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_sintesis` VALUES (3, 1, 3, 'C3', 0.0831, 0.1370, 0.2158, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_sintesis` VALUES (4, 1, 4, 'C4', 0.0866, 0.1344, 0.2042, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_sintesis` VALUES (5, 1, 5, 'C5', 0.0789, 0.1232, 0.1965, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_sintesis` VALUES (6, 1, 6, 'C6', 0.0409, 0.0614, 0.0922, '2020-12-21 00:59:31', NULL, NULL);
INSERT INTO `t_sintesis` VALUES (7, 1, 7, 'C7', 0.0555, 0.0924, 0.1932, '2020-12-21 00:59:31', NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
