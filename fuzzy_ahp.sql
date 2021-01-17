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

 Date: 18/01/2021 00:08:58
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
  `lower_val` float(20, 9) NULL DEFAULT NULL,
  `medium_val` float(20, 9) NULL DEFAULT NULL,
  `upper_val` float(20, 9) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_himpunan
-- ----------------------------
INSERT INTO `m_himpunan` VALUES (1, '9 kali lebih penting', '4', '9/2', '9/2', NULL, 4.000000000, 4.500000000, 4.500000000, '2020-12-01 23:21:04', '2020-12-27 13:16:50', NULL);
INSERT INTO `m_himpunan` VALUES (2, '8 kali lebih penting', '7/2', '4', '9/2', NULL, 3.500000000, 4.000000000, 4.500000000, '2020-12-01 23:22:27', '2020-12-27 13:17:01', NULL);
INSERT INTO `m_himpunan` VALUES (3, '7 kali lebih penting', '3', '7/2', '4', NULL, 3.000000000, 3.500000000, 4.000000000, '2020-12-01 23:43:29', '2020-12-27 13:17:11', NULL);
INSERT INTO `m_himpunan` VALUES (4, '6 kali lebih penting', '5/2', '3', '7/2', NULL, 2.500000000, 3.000000000, 3.500000000, '2020-12-01 23:44:14', '2020-12-27 13:17:21', NULL);
INSERT INTO `m_himpunan` VALUES (5, '5 kali lebih penting', '2', '5/2', '3', NULL, 2.000000000, 2.500000000, 3.000000000, '2020-12-01 23:45:05', '2020-12-27 13:17:36', NULL);
INSERT INTO `m_himpunan` VALUES (6, '4 kali lebih penting', '3/2', '2', '5/2', NULL, 1.500000000, 2.000000000, 2.500000000, '2020-12-01 23:46:03', '2020-12-27 13:17:43', NULL);
INSERT INTO `m_himpunan` VALUES (7, '3 kali lebih penting', '1', '3/2', '2', NULL, 1.000000000, 1.500000000, 2.000000000, '2020-12-01 23:47:24', '2020-12-27 13:18:08', NULL);
INSERT INTO `m_himpunan` VALUES (8, '2 kali lebih penting', '1/2', '1', '3/2', NULL, 0.500000000, 1.000000000, 1.500000000, '2020-12-01 23:47:50', '2020-12-27 13:18:16', NULL);
INSERT INTO `m_himpunan` VALUES (9, 'Sama Penting', '1', '1', '1', 1, 1.000000000, 1.000000000, 1.000000000, '2020-12-01 23:48:07', '2020-12-27 13:18:24', NULL);
INSERT INTO `m_himpunan` VALUES (10, '2 kali kurang penting', '2/3', '1', '2', NULL, 0.666666687, 1.000000000, 2.000000000, '2020-12-01 23:55:34', '2020-12-27 13:18:34', NULL);
INSERT INTO `m_himpunan` VALUES (11, '3 kali kurang penting', '1/2', '2/3', '1', NULL, 0.500000000, 0.666666687, 1.000000000, '2020-12-01 23:56:07', '2020-12-27 13:18:55', NULL);
INSERT INTO `m_himpunan` VALUES (12, '4 kali kurang penting', '2/5', '1/2', '2/3', NULL, 0.400000006, 0.500000000, 0.666666687, '2020-12-01 23:56:35', '2020-12-27 13:19:03', NULL);
INSERT INTO `m_himpunan` VALUES (13, '5 kali kurang penting', '1/3', '2/5', '1/2', NULL, 0.333333343, 0.400000006, 0.500000000, '2020-12-01 23:57:05', '2020-12-27 13:19:20', NULL);
INSERT INTO `m_himpunan` VALUES (14, '6 kali kurang penting', '2/7', '1/3', '2/5', NULL, 0.285714298, 0.333333343, 0.400000006, '2020-12-01 23:57:45', '2020-12-27 13:19:28', NULL);
INSERT INTO `m_himpunan` VALUES (15, '7 kali kurang penting', '1/4', '2/7', '1/3', NULL, 0.250000000, 0.285714298, 0.333333343, '2020-12-01 23:58:20', '2020-12-27 13:19:35', NULL);
INSERT INTO `m_himpunan` VALUES (16, '8 kali kurang penting', '2/9', '1/4', '2/7', NULL, 0.222222224, 0.250000000, 0.285714298, '2020-12-01 23:58:50', '2020-12-27 13:19:43', NULL);
INSERT INTO `m_himpunan` VALUES (17, '9 kali kurang penting', '2/9', '2/9', '1/4', NULL, 0.222222224, 0.222222224, 0.250000000, '2020-12-01 23:59:16', '2020-12-27 13:19:51', NULL);

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
INSERT INTO `m_kategori` VALUES (1, 'UMUM', 'C1', 1, '2020-12-02 22:58:05', '2020-12-21 23:10:18', NULL);
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
  `id_satuan` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_kriteria
-- ----------------------------
INSERT INTO `m_kriteria` VALUES (1, 1, 'PENGUKURAN', 1, '2020-12-03 08:24:39', '2021-01-05 23:56:19', NULL, 1);
INSERT INTO `m_kriteria` VALUES (2, 1, 'PAS. PAPAN NAMA PROYEK', 2, '2020-12-03 08:24:57', '2021-01-05 23:56:35', NULL, 2);
INSERT INTO `m_kriteria` VALUES (3, 1, 'PENGAMANAN LALU LINTAS', 3, '2020-12-03 08:25:09', '2021-01-05 23:56:55', NULL, 1);
INSERT INTO `m_kriteria` VALUES (4, 1, 'PASANG RAMBU LALU LINTAS', 4, '2020-12-03 08:25:20', '2021-01-05 23:57:06', NULL, 2);
INSERT INTO `m_kriteria` VALUES (5, 1, 'PEMBERSIHAN', 5, '2020-12-03 08:25:32', '2021-01-05 23:57:16', NULL, 1);
INSERT INTO `m_kriteria` VALUES (6, 1, 'MOBILISASI DAN DEMOBILISASI', 6, '2020-12-03 08:25:45', '2021-01-05 23:57:26', NULL, 1);
INSERT INTO `m_kriteria` VALUES (7, 1, 'QUALITY CONTROL', 7, '2020-12-03 08:25:56', '2021-01-05 23:59:02', NULL, 2);
INSERT INTO `m_kriteria` VALUES (8, 1, 'PEMINDAHAN TIANG UTILITAS', 8, '2020-12-03 08:26:06', NULL, '2021-01-05 23:58:25', NULL);
INSERT INTO `m_kriteria` VALUES (9, 1, 'TEBANG POHON', 8, '2020-12-03 08:26:18', '2021-01-05 23:58:48', NULL, 2);
INSERT INTO `m_kriteria` VALUES (10, 2, 'GALIAN UTK DRAINASE, SALURAN DAN SALURAN AIR', 1, '2020-12-13 23:30:05', '2021-01-05 23:59:13', NULL, 3);
INSERT INTO `m_kriteria` VALUES (11, 2, 'PEKERJAAN SALURAN TEPI (U-DITCH 60.80.120) GANDAR 10 T', 2, '2020-12-13 23:30:35', '2021-01-05 23:59:29', NULL, 4);
INSERT INTO `m_kriteria` VALUES (12, 2, 'PEKERJAAN TUTUP SALURAN (COVER U-DITCH 76.12.120) GANDAR 10 T', 3, '2020-12-13 23:31:04', '2021-01-05 23:59:43', NULL, 4);
INSERT INTO `m_kriteria` VALUES (13, 2, 'COR SETEMPAT K-225', 4, '2020-12-13 23:31:32', '2021-01-05 23:59:57', NULL, 5);
INSERT INTO `m_kriteria` VALUES (14, 2, 'PEKERJAAN BOX CULVERT 100.100.120) GANDAR 20 T', 5, '2020-12-13 23:31:54', '2021-01-06 00:00:08', NULL, 4);
INSERT INTO `m_kriteria` VALUES (15, 3, 'GALIAN TANAH BIASA (MENGGUNAKAN ALAT BERAT)', 1, '2021-01-06 00:00:38', NULL, NULL, 3);
INSERT INTO `m_kriteria` VALUES (16, 3, 'URUGAN PASIR', 2, '2021-01-06 00:01:06', NULL, NULL, 3);
INSERT INTO `m_kriteria` VALUES (17, 3, 'URUGAN SIRTU', 3, '2021-01-06 00:01:27', NULL, NULL, 3);
INSERT INTO `m_kriteria` VALUES (18, 3, 'PENYIAPAN BADAN JALAN', 4, '2021-01-06 00:01:52', NULL, NULL, 5);
INSERT INTO `m_kriteria` VALUES (19, 3, 'GEOTEXTILE NON WOVEN', 5, '2021-01-06 00:02:15', NULL, NULL, 5);
INSERT INTO `m_kriteria` VALUES (20, 4, 'LAPIS PONDASI AGREGAT KLAS A CBR ≥ 90%', 1, '2021-01-06 00:02:48', NULL, NULL, 3);
INSERT INTO `m_kriteria` VALUES (21, 4, 'LAPIS PONDASI AGREGAT KLAS B CBR ≥ 65%', 3, '2021-01-06 00:03:06', NULL, NULL, 3);
INSERT INTO `m_kriteria` VALUES (22, 5, 'LAPIS RESAP PENGIKAT', 1, '2021-01-06 00:03:34', NULL, NULL, 6);
INSERT INTO `m_kriteria` VALUES (23, 5, 'LASTON LAPIS AUS (AC-WC) = 5CM', 2, '2021-01-06 00:04:00', NULL, NULL, 5);
INSERT INTO `m_kriteria` VALUES (24, 6, 'PASANGAN BATU KALI 1:4', 1, '2021-01-06 00:04:34', NULL, NULL, 3);
INSERT INTO `m_kriteria` VALUES (25, 6, 'PLESTERAN HALUS 1 : 4', 2, '2021-01-06 00:04:54', NULL, NULL, 5);
INSERT INTO `m_kriteria` VALUES (26, 6, 'BETON K - 125 ( LANTAI KERJA ) READYMIX', 3, '2021-01-06 00:05:20', NULL, NULL, 3);
INSERT INTO `m_kriteria` VALUES (27, 6, 'BETON K - 400  DENGAN BEGISTING ( READYMIX )', 4, '2021-01-06 00:05:39', NULL, NULL, 3);
INSERT INTO `m_kriteria` VALUES (28, 6, 'BAJA TULANGAN 24 POLOS', 5, '2021-01-06 00:06:00', NULL, NULL, 7);
INSERT INTO `m_kriteria` VALUES (29, 6, 'BAJA TULANGAN 32 ULIR', 6, '2021-01-06 00:06:32', NULL, NULL, 7);
INSERT INTO `m_kriteria` VALUES (30, 6, 'BESI WIREMESH M10-150', 7, '2021-01-06 00:06:53', NULL, NULL, 7);
INSERT INTO `m_kriteria` VALUES (31, 6, 'PEK. PEMASANGAN PLASTIK POLYTHENE T : 85 MIKRON', 8, '2021-01-06 00:07:28', NULL, NULL, 5);
INSERT INTO `m_kriteria` VALUES (32, 6, 'PEK. ASPHALT SEALENT (JOINT SEALENT)', 9, '2021-01-06 00:07:47', NULL, NULL, 6);
INSERT INTO `m_kriteria` VALUES (33, 6, 'PEK. GROOVING', 10, '2021-01-06 00:08:12', NULL, NULL, 5);
INSERT INTO `m_kriteria` VALUES (34, 6, 'PENGECATAN BESI', 11, '2021-01-06 00:09:05', NULL, NULL, 5);
INSERT INTO `m_kriteria` VALUES (35, 6, 'PEK. SELONGSONG PIPA PVC ∅ 1 \"', 12, '2021-01-06 00:09:51', NULL, NULL, 4);
INSERT INTO `m_kriteria` VALUES (36, 6, 'PEK. CONCRETE CUTTING', 13, '2021-01-06 00:10:17', NULL, NULL, 4);
INSERT INTO `m_kriteria` VALUES (37, 6, 'PAS. TRIPLEK UNTUK DILATASI', 14, '2021-01-06 00:11:07', NULL, NULL, 5);
INSERT INTO `m_kriteria` VALUES (38, 6, 'PEMASANGAN BATU ALAM PALIMANAN', 15, '2021-01-06 00:12:02', NULL, NULL, 5);
INSERT INTO `m_kriteria` VALUES (39, 6, 'TRUCUK BAMBU DIA 10 CM, P = 2,5 M', 16, '2021-01-06 00:12:27', NULL, NULL, 2);
INSERT INTO `m_kriteria` VALUES (40, 7, 'MARKA JALAN THERMOPLASTIC', 1, '2021-01-06 00:12:48', NULL, NULL, 5);

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
INSERT INTO `m_menu` VALUES (13, 11, 'Data Perhitungan', 'Data Perhitungan', 'data_hitung', 'flaticon-statistics', 1, 2, 3, 1, 1, 1);
INSERT INTO `m_menu` VALUES (14, 6, 'Master Proyek', 'Master Proyek', 'master_proyek', 'flaticon2-start-up', 1, 2, 5, 1, 1, 1);
INSERT INTO `m_menu` VALUES (15, 11, 'Formulir Anggaran', 'Formulir Anggaran', 'form_anggaran', 'flaticon2-list', 1, 2, 2, 1, 1, 1);
INSERT INTO `m_menu` VALUES (16, 6, 'Master Satuan', 'Master Satuan', 'master_satuan', 'flaticon2-file-1', 1, 2, 6, 1, 1, 1);

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
  `tahun_akhir_proyek` int(11) NULL DEFAULT NULL,
  `durasi_tahun` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_proyek
-- ----------------------------
INSERT INTO `m_proyek` VALUES (1, 'Jembatan Suramadu', 'Pembangunan Jembatan Suramadu', 2020, '2020-12-09 12:18:33', NULL, NULL, 2021, 2);
INSERT INTO `m_proyek` VALUES (2, 'Musholla', 'Pembangunan Musholla', 2019, '2020-12-09 12:18:33', '2021-01-03 13:42:45', NULL, 2019, 1);
INSERT INTO `m_proyek` VALUES (3, 'Proyek Coba', 'Proyek Coba Coba dong', 2020, '2021-01-03 13:31:48', '2021-01-03 13:42:18', NULL, 2021, 2);

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
-- Table structure for m_satuan
-- ----------------------------
DROP TABLE IF EXISTS `m_satuan`;
CREATE TABLE `m_satuan`  (
  `id` int(11) NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_satuan
-- ----------------------------
INSERT INTO `m_satuan` VALUES (1, 'Ls', 'Ls', '2021-01-03 22:55:25', NULL, NULL);
INSERT INTO `m_satuan` VALUES (2, 'Buah', 'Bh', '2021-01-03 22:55:25', NULL, NULL);
INSERT INTO `m_satuan` VALUES (3, 'Meter Kubik', 'M3', '2021-01-03 22:55:25', NULL, NULL);
INSERT INTO `m_satuan` VALUES (4, 'Pieces', 'Pcs', '2021-01-03 22:55:25', NULL, NULL);
INSERT INTO `m_satuan` VALUES (5, 'Meter Kudrat', 'M2', '2021-01-03 22:55:25', NULL, NULL);
INSERT INTO `m_satuan` VALUES (6, 'Ltr', 'Liter', '2021-01-03 22:55:25', NULL, NULL);
INSERT INTO `m_satuan` VALUES (7, 'Kilogram', 'Kg', '2021-01-03 22:55:25', NULL, NULL);

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
INSERT INTO `m_user` VALUES (1, 1, 'admin', 'SnIvSVV6c2UwdWhKS1ZKMDluUlp4dz09', 1, '2021-01-17 20:14:50', 'USR-00001', NULL, NULL, NULL, NULL);
INSERT INTO `m_user` VALUES (2, 1, 'coba', 'Tzg1eTllUlU2a2xNQk5yYktIM1pwUT09', NULL, NULL, 'USR-00002', 'coba-1602775328.jpg', '2020-10-15 22:22:08', '2020-10-15 22:43:54', '2020-10-15 22:58:50');

-- ----------------------------
-- Table structure for t_anggaran
-- ----------------------------
DROP TABLE IF EXISTS `t_anggaran`;
CREATE TABLE `t_anggaran`  (
  `id` int(11) NOT NULL,
  `id_proyek` int(11) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  `data_json` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT 'data perhitungan per kategori per tahun',
  `id_user` int(64) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_anggaran
-- ----------------------------
INSERT INTO `t_anggaran` VALUES (1, 1, '2021-01-09 23:59:46', NULL, NULL, '[{\"total\":\"44410000.00\",\"kode_kategori\":\"C1\",\"id_kategori\":\"1\",\"id_anggaran\":\"1\",\"tahun\":\"2020\"},{\"total\":\"4343118188.83\",\"kode_kategori\":\"C2\",\"id_kategori\":\"2\",\"id_anggaran\":\"1\",\"tahun\":\"2020\"},{\"total\":\"533318015.20\",\"kode_kategori\":\"C3\",\"id_kategori\":\"3\",\"id_anggaran\":\"1\",\"tahun\":\"2020\"},{\"total\":\"591054097.45\",\"kode_kategori\":\"C4\",\"id_kategori\":\"4\",\"id_anggaran\":\"1\",\"tahun\":\"2020\"},{\"total\":\"3816153.22\",\"kode_kategori\":\"C5\",\"id_kategori\":\"5\",\"id_anggaran\":\"1\",\"tahun\":\"2020\"},{\"total\":\"8229747239.58\",\"kode_kategori\":\"C6\",\"id_kategori\":\"6\",\"id_anggaran\":\"1\",\"tahun\":\"2020\"},{\"total\":\"84836006.40\",\"kode_kategori\":\"C7\",\"id_kategori\":\"7\",\"id_anggaran\":\"1\",\"tahun\":\"2020\"},{\"total\":\"28227250.00\",\"kode_kategori\":\"C1\",\"id_kategori\":\"1\",\"id_anggaran\":\"1\",\"tahun\":\"2021\"},{\"total\":\"1014312313.14\",\"kode_kategori\":\"C2\",\"id_kategori\":\"2\",\"id_anggaran\":\"1\",\"tahun\":\"2021\"},{\"total\":\"193510897.29\",\"kode_kategori\":\"C3\",\"id_kategori\":\"3\",\"id_anggaran\":\"1\",\"tahun\":\"2021\"},{\"total\":\"161309515.53\",\"kode_kategori\":\"C4\",\"id_kategori\":\"4\",\"id_anggaran\":\"1\",\"tahun\":\"2021\"},{\"total\":\"8674099.01\",\"kode_kategori\":\"C5\",\"id_kategori\":\"5\",\"id_anggaran\":\"1\",\"tahun\":\"2021\"},{\"total\":\"1296078173.51\",\"kode_kategori\":\"C6\",\"id_kategori\":\"6\",\"id_anggaran\":\"1\",\"tahun\":\"2021\"},{\"total\":\"14515091.08\",\"kode_kategori\":\"C7\",\"id_kategori\":\"7\",\"id_anggaran\":\"1\",\"tahun\":\"2021\"}]', 1);

-- ----------------------------
-- Table structure for t_anggaran_det
-- ----------------------------
DROP TABLE IF EXISTS `t_anggaran_det`;
CREATE TABLE `t_anggaran_det`  (
  `id` int(11) NOT NULL,
  `id_anggaran` int(255) NULL DEFAULT NULL,
  `tahun` int(4) NULL DEFAULT NULL,
  `id_kategori` int(11) NULL DEFAULT NULL,
  `kode_kategori` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_kriteria` int(11) NULL DEFAULT NULL,
  `urut` int(11) NULL DEFAULT NULL COMMENT 'urut per kategori',
  `id_satuan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `qty` decimal(20, 2) NULL DEFAULT 0,
  `harga_satuan` decimal(20, 2) NULL DEFAULT 0,
  `harga_total` decimal(40, 2) NULL DEFAULT 0,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_anggaran_det
-- ----------------------------
INSERT INTO `t_anggaran_det` VALUES (1, 1, 2020, 1, 'C1', 1, 1, '1', 1.00, 170000.00, 170000.00, '2021-01-10 14:06:17', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (2, 1, 2020, 1, 'C1', 2, 2, '2', 2.00, 250000.00, 500000.00, '2021-01-10 14:06:17', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (3, 1, 2020, 1, 'C1', 3, 3, '1', 1.00, 1500000.00, 1500000.00, '2021-01-10 14:06:17', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (4, 1, 2020, 1, 'C1', 4, 4, '2', 2.00, 120000.00, 240000.00, '2021-01-10 14:06:17', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (5, 1, 2020, 1, 'C1', 5, 5, '1', 1.00, 1000000.00, 1000000.00, '2021-01-10 14:06:17', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (6, 1, 2020, 1, 'C1', 6, 6, '1', 1.00, 6500000.00, 6500000.00, '2021-01-10 14:06:17', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (7, 1, 2020, 1, 'C1', 7, 7, '2', 1.00, 4500000.00, 4500000.00, '2021-01-10 14:06:17', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (8, 1, 2020, 1, 'C1', 9, 8, '2', 20.00, 1500000.00, 30000000.00, '2021-01-10 14:06:17', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (9, 1, 2020, 2, 'C2', 10, 9, '3', 1687.20, 14107.11, 23801515.99, '2021-01-10 14:06:17', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (10, 1, 2020, 2, 'C2', 11, 10, '4', 3083.00, 1000000.00, 3083000000.00, '2021-01-10 14:06:17', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (11, 1, 2020, 2, 'C2', 12, 11, '4', 3083.00, 370000.00, 1140710000.00, '2021-01-10 14:06:17', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (12, 1, 2020, 2, 'C2', 13, 12, '5', 6.80, 1000981.30, 6806672.84, '2021-01-10 14:06:17', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (13, 1, 2020, 2, 'C2', 14, 13, '4', 24.00, 3700000.00, 88800000.00, '2021-01-10 14:06:17', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (14, 1, 2020, 3, 'C3', 15, 14, '3', 3038.94, 26383.32, 80177326.48, '2021-01-10 14:06:17', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (15, 1, 2020, 3, 'C3', 16, 15, '3', 438.22, 217389.70, 95264514.33, '2021-01-10 14:06:17', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (16, 1, 2020, 3, 'C3', 17, 16, '3', 2279.73, 155922.07, 355460220.64, '2021-01-10 14:06:17', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (17, 1, 2020, 3, 'C3', 18, 17, '5', 5075.00, 476.05, 2415953.75, '2021-01-10 14:06:17', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (18, 1, 2020, 3, 'C3', 19, 18, '5', 0.00, 0.00, 0.00, '2021-01-10 14:06:17', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (19, 1, 2020, 4, 'C4', 20, 19, '3', 721.50, 216545.05, 156237253.57, '2021-01-10 14:06:17', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (20, 1, 2020, 4, 'C4', 21, 20, '3', 2085.50, 208495.25, 434816843.88, '2021-01-10 14:06:17', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (21, 1, 2020, 5, 'C5', 22, 21, '6', 19.20, 9466.88, 181764.10, '2021-01-10 14:06:17', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (22, 1, 2020, 5, 'C5', 23, 22, '5', 24.00, 151432.88, 3634389.12, '2021-01-10 14:06:17', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (23, 1, 2020, 6, 'C6', 24, 23, '3', 2439.43, 658230.40, 1605706984.67, '2021-01-10 14:06:17', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (24, 1, 2020, 6, 'C6', 25, 24, '5', 1196.42, 39616.93, 47398487.39, '2021-01-10 14:06:17', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (25, 1, 2020, 6, 'C6', 26, 25, '3', 1669.84, 719954.31, 1202208505.01, '2021-01-10 14:06:17', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (26, 1, 2020, 6, 'C6', 27, 26, '3', 3330.00, 1005954.31, 3349827852.30, '2021-01-10 14:06:17', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (27, 1, 2020, 6, 'C6', 28, 27, '7', 49070.29, 11026.26, 541061775.82, '2021-01-10 14:06:17', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (28, 1, 2020, 6, 'C6', 29, 28, '7', 6177.65, 12236.26, 75591331.59, '2021-01-10 14:06:17', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (29, 1, 2020, 6, 'C6', 30, 29, '7', 96483.20, 12478.26, 1203942455.23, '2021-01-10 14:06:17', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (30, 1, 2020, 6, 'C6', 31, 30, '5', 11100.00, 3500.00, 38850000.00, '2021-01-10 14:06:17', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (31, 1, 2020, 6, 'C6', 32, 31, '6', 1933.00, 24000.00, 46392000.00, '2021-01-10 14:06:17', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (32, 1, 2020, 6, 'C6', 33, 32, '5', 11100.00, 958.65, 10641015.00, '2021-01-10 14:06:17', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (33, 1, 2020, 6, 'C6', 34, 33, '5', 63.65, 83406.13, 5308800.17, '2021-01-10 14:06:17', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (34, 1, 2020, 6, 'C6', 35, 34, '4', 3326.40, 14159.75, 47100992.40, '2021-01-10 14:06:17', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (35, 1, 2020, 6, 'C6', 36, 35, '4', 3866.00, 3740.00, 14458840.00, '2021-01-10 14:06:17', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (36, 1, 2020, 6, 'C6', 37, 36, '5', 201.60, 19500.00, 3931200.00, '2021-01-10 14:06:17', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (37, 1, 2020, 6, 'C6', 38, 37, '5', 3.52, 325000.00, 1144000.00, '2021-01-10 14:06:17', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (38, 1, 2020, 6, 'C6', 39, 38, '2', 1723.00, 21000.00, 36183000.00, '2021-01-10 14:06:17', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (39, 1, 2020, 7, 'C7', 40, 39, '5', 527.16, 160930.28, 84836006.40, '2021-01-10 14:06:17', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (40, 1, 2021, 1, 'C1', 1, 1, '1', 1.00, 2500000.00, 2500000.00, '2021-01-16 21:16:15', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (41, 1, 2021, 1, 'C1', 2, 2, '2', 2.00, 600000.00, 1200000.00, '2021-01-16 21:16:15', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (42, 1, 2021, 1, 'C1', 3, 3, '1', 1.00, 3000000.00, 3000000.00, '2021-01-16 21:16:15', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (43, 1, 2021, 1, 'C1', 4, 4, '2', 2.00, 2000000.00, 4000000.00, '2021-01-16 21:16:15', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (44, 1, 2021, 1, 'C1', 5, 5, '1', 1.00, 2611000.00, 2611000.00, '2021-01-16 21:16:15', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (45, 1, 2021, 1, 'C1', 6, 6, '1', 1.00, 8000000.00, 8000000.00, '2021-01-16 21:16:15', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (46, 1, 2021, 1, 'C1', 7, 7, '2', 1.00, 3863750.00, 3863750.00, '2021-01-16 21:16:15', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (47, 1, 2021, 1, 'C1', 9, 8, '2', 5.00, 610500.00, 3052500.00, '2021-01-16 21:16:15', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (48, 1, 2021, 2, 'C2', 10, 9, '3', 279.07, 33997.66, 9487726.98, '2021-01-16 21:16:15', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (49, 1, 2021, 2, 'C2', 11, 10, '4', 510.00, 1161000.00, 592110000.00, '2021-01-16 21:16:15', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (50, 1, 2021, 2, 'C2', 12, 11, '4', 510.00, 706650.55, 360391780.50, '2021-01-16 21:16:15', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (51, 1, 2021, 2, 'C2', 13, 12, '5', 2.72, 3640494.33, 9902144.58, '2021-01-16 21:16:15', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (52, 1, 2021, 2, 'C2', 14, 13, '4', 7.00, 6060094.44, 42420661.08, '2021-01-16 21:16:15', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (53, 1, 2021, 3, 'C3', 15, 14, '3', 386.69, 63778.79, 24662620.31, '2021-01-16 21:16:15', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (54, 1, 2021, 3, 'C3', 16, 15, '3', 46.51, 347611.00, 16167387.61, '2021-01-16 21:16:15', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (55, 1, 2021, 3, 'C3', 17, 16, '3', 154.13, 317683.46, 48964551.69, '2021-01-16 21:16:15', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (56, 1, 2021, 3, 'C3', 18, 17, '5', 918.00, 4268.86, 3918813.48, '2021-01-16 21:16:15', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (57, 1, 2021, 3, 'C3', 19, 18, '5', 1652.40, 60395.50, 99797524.20, '2021-01-16 21:16:15', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (58, 1, 2021, 4, 'C4', 20, 19, '3', 119.34, 333373.86, 39784836.45, '2021-01-16 21:16:15', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (59, 1, 2021, 4, 'C4', 21, 20, '3', 378.00, 321493.86, 121524679.08, '2021-01-16 21:16:15', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (60, 1, 2021, 5, 'C5', 22, 21, '6', 38.40, 10462.77, 401770.37, '2021-01-16 21:16:15', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (61, 1, 2021, 5, 'C5', 23, 22, '5', 48.00, 172340.18, 8272328.64, '2021-01-16 21:16:15', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (62, 1, 2021, 6, 'C6', 24, 23, '3', 0.51, 881116.85, 449369.59, '2021-01-16 21:16:15', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (63, 1, 2021, 6, 'C6', 25, 24, '5', 3.28, 84491.55, 277132.28, '2021-01-16 21:16:15', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (64, 1, 2021, 6, 'C6', 26, 25, '3', 277.19, 856258.72, 237346354.60, '2021-01-16 21:16:15', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (65, 1, 2021, 6, 'C6', 27, 26, '3', 550.80, 1124259.42, 619242088.54, '2021-01-16 21:16:15', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (66, 1, 2021, 6, 'C6', 28, 27, '7', 8163.47, 13618.55, 111174624.37, '2021-01-16 21:16:15', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (67, 1, 2021, 6, 'C6', 29, 28, '7', 682.40, 14163.05, 9664865.32, '2021-01-16 21:16:15', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (68, 1, 2021, 6, 'C6', 30, 29, '7', 16033.92, 18004.80, 288687522.82, '2021-01-16 21:16:15', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (69, 1, 2021, 6, 'C6', 31, 30, '5', 1836.00, 4000.00, 7344000.00, '2021-01-16 21:16:15', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (70, 1, 2021, 6, 'C6', 32, 31, '6', 321.00, 10462.77, 3358549.17, '2021-01-16 21:16:15', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (71, 1, 2021, 6, 'C6', 33, 32, '5', 1836.00, 1870.00, 3433320.00, '2021-01-16 21:16:15', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (72, 1, 2021, 6, 'C6', 34, 33, '5', 10.60, 112919.07, 1196942.14, '2021-01-16 21:16:15', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (73, 1, 2021, 6, 'C6', 35, 34, '4', 554.40, 14322.00, 7940116.80, '2021-01-16 21:16:15', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (74, 1, 2021, 6, 'C6', 36, 35, '4', 642.00, 4867.50, 3124935.00, '2021-01-16 21:16:15', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (75, 1, 2021, 6, 'C6', 37, 36, '5', 33.60, 62500.00, 2100000.00, '2021-01-16 21:16:15', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (76, 1, 2021, 6, 'C6', 38, 37, '5', 0.88, 225401.00, 198352.88, '2021-01-16 21:16:15', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (77, 1, 2021, 6, 'C6', 39, 38, '2', 30.00, 18000.00, 540000.00, '2021-01-16 21:16:15', NULL, NULL);
INSERT INTO `t_anggaran_det` VALUES (78, 1, 2021, 7, 'C7', 40, 39, '5', 87.12, 166610.32, 14515091.08, '2021-01-16 21:16:15', NULL, NULL);

-- ----------------------------
-- Table structure for t_bobot_proses
-- ----------------------------
DROP TABLE IF EXISTS `t_bobot_proses`;
CREATE TABLE `t_bobot_proses`  (
  `id` int(11) NOT NULL,
  `id_anggaran` int(11) NULL DEFAULT NULL,
  `kode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nilai_awal` decimal(20, 2) NULL DEFAULT NULL,
  `max` decimal(20, 2) NULL DEFAULT NULL,
  `min` decimal(20, 2) NULL DEFAULT NULL,
  `max_min` decimal(20, 2) NULL DEFAULT NULL,
  `bobot` float(20, 20) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  `tahun` int(4) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_bobot_proses
-- ----------------------------
INSERT INTO `t_bobot_proses` VALUES (1, 1, 'C1', 0.00, 44410000.00, 28227250.00, 16182750.00, 0.00000000000000000000, '2021-01-16 21:16:15', NULL, NULL, 2020);
INSERT INTO `t_bobot_proses` VALUES (2, 1, 'C1', 16182750.00, 44410000.00, 28227250.00, 16182750.00, 1.00000000000000000000, '2021-01-16 21:16:15', NULL, NULL, 2021);
INSERT INTO `t_bobot_proses` VALUES (3, 1, 'C2', 0.00, 4343118188.83, 1014312313.14, 3328805875.69, 0.00000000000000000000, '2021-01-16 21:16:15', NULL, NULL, 2020);
INSERT INTO `t_bobot_proses` VALUES (4, 1, 'C2', 3328805875.69, 4343118188.83, 1014312313.14, 3328805875.69, 1.00000000000000000000, '2021-01-16 21:16:15', NULL, NULL, 2021);
INSERT INTO `t_bobot_proses` VALUES (5, 1, 'C3', 0.00, 533318015.20, 193510897.29, 339807117.91, 0.00000000000000000000, '2021-01-16 21:16:15', NULL, NULL, 2020);
INSERT INTO `t_bobot_proses` VALUES (6, 1, 'C3', 339807117.91, 533318015.20, 193510897.29, 339807117.91, 1.00000000000000000000, '2021-01-16 21:16:15', NULL, NULL, 2021);
INSERT INTO `t_bobot_proses` VALUES (7, 1, 'C4', 0.00, 591054097.45, 161309515.53, 429744581.92, 0.00000000000000000000, '2021-01-16 21:16:15', NULL, NULL, 2020);
INSERT INTO `t_bobot_proses` VALUES (8, 1, 'C4', 429744581.92, 591054097.45, 161309515.53, 429744581.92, 1.00000000000000000000, '2021-01-16 21:16:15', NULL, NULL, 2021);
INSERT INTO `t_bobot_proses` VALUES (9, 1, 'C5', 4857945.79, 8674099.01, 3816153.22, 4857945.79, 1.00000000000000000000, '2021-01-16 21:16:15', NULL, NULL, 2020);
INSERT INTO `t_bobot_proses` VALUES (10, 1, 'C5', 0.00, 8674099.01, 3816153.22, 4857945.79, 0.00000000000000000000, '2021-01-16 21:16:15', NULL, NULL, 2021);
INSERT INTO `t_bobot_proses` VALUES (11, 1, 'C6', 0.00, 8229747239.58, 1296078173.51, 6933669066.07, 0.00000000000000000000, '2021-01-16 21:16:15', NULL, NULL, 2020);
INSERT INTO `t_bobot_proses` VALUES (12, 1, 'C6', 6933669066.07, 8229747239.58, 1296078173.51, 6933669066.07, 1.00000000000000000000, '2021-01-16 21:16:15', NULL, NULL, 2021);
INSERT INTO `t_bobot_proses` VALUES (13, 1, 'C7', 0.00, 84836006.40, 14515091.08, 70320915.32, 0.00000000000000000000, '2021-01-16 21:16:15', NULL, NULL, 2020);
INSERT INTO `t_bobot_proses` VALUES (14, 1, 'C7', 70320915.32, 84836006.40, 14515091.08, 70320915.32, 1.00000000000000000000, '2021-01-16 21:16:15', NULL, NULL, 2021);

-- ----------------------------
-- Table structure for t_hitung
-- ----------------------------
DROP TABLE IF EXISTS `t_hitung`;
CREATE TABLE `t_hitung`  (
  `id` int(11) NOT NULL,
  `id_proyek` int(11) NULL DEFAULT NULL,
  `id_user` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `total_lower` float(20, 9) NULL DEFAULT NULL,
  `total_medium` float(20, 9) NULL DEFAULT NULL,
  `total_upper` float(20, 9) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_hitung
-- ----------------------------
INSERT INTO `t_hitung` VALUES (1, 2, '1', 51.751586914, 64.957939148, 81.069046021, '2020-12-18 19:43:01', NULL, NULL);
INSERT INTO `t_hitung` VALUES (2, 1, '1', 51.751586914, 64.957939148, 81.069046021, '2020-12-28 10:46:26', NULL, NULL);
INSERT INTO `t_hitung` VALUES (3, 3, '1', NULL, NULL, NULL, '2021-01-03 14:11:03', NULL, NULL);

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
INSERT INTO `t_hitung_det` VALUES (99, 1, 6, 'C6', 9, 6, 'C6', 6, 'C6', '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (100, 1, 6, 'C6', 7, 7, 'C7', 6, 'C6', '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (101, 1, 7, 'C7', 11, 6, 'C6', 6, 'C6', '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (102, 1, 7, 'C7', 9, 7, 'C7', 6, 'C6', '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (103, 2, 1, 'C1', 9, 1, 'C1', 1, 'C1', '2020-12-28 10:47:46', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (104, 2, 1, 'C1', 4, 2, 'C2', 1, 'C1', '2020-12-28 10:47:46', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (105, 2, 2, 'C2', 14, 1, 'C1', 1, 'C1', '2020-12-28 10:47:46', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (106, 2, 1, 'C1', 6, 3, 'C3', 1, 'C1', '2020-12-28 10:47:46', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (107, 2, 3, 'C3', 12, 1, 'C1', 1, 'C1', '2020-12-28 10:47:46', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (108, 2, 1, 'C1', 5, 4, 'C4', 1, 'C1', '2020-12-28 10:47:46', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (109, 2, 4, 'C4', 13, 1, 'C1', 1, 'C1', '2020-12-28 10:47:46', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (110, 2, 1, 'C1', 7, 5, 'C5', 1, 'C1', '2020-12-28 10:47:46', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (111, 2, 5, 'C5', 11, 1, 'C1', 1, 'C1', '2020-12-28 10:47:46', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (112, 2, 1, 'C1', 1, 6, 'C6', 1, 'C1', '2020-12-28 10:47:46', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (113, 2, 6, 'C6', 17, 1, 'C1', 1, 'C1', '2020-12-28 10:47:46', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (114, 2, 1, 'C1', 8, 7, 'C7', 1, 'C1', '2020-12-28 10:47:46', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (115, 2, 7, 'C7', 10, 1, 'C1', 1, 'C1', '2020-12-28 10:47:46', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (116, 2, 2, 'C2', 9, 2, 'C2', 2, 'C2', '2020-12-28 10:48:38', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (117, 2, 2, 'C2', 5, 3, 'C3', 2, 'C2', '2020-12-28 10:48:38', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (118, 2, 3, 'C3', 13, 2, 'C2', 2, 'C2', '2020-12-28 10:48:38', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (119, 2, 2, 'C2', 4, 4, 'C4', 2, 'C2', '2020-12-28 10:48:38', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (120, 2, 4, 'C4', 14, 2, 'C2', 2, 'C2', '2020-12-28 10:48:38', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (121, 2, 2, 'C2', 6, 5, 'C5', 2, 'C2', '2020-12-28 10:48:38', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (122, 2, 5, 'C5', 12, 2, 'C2', 2, 'C2', '2020-12-28 10:48:38', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (123, 2, 2, 'C2', 3, 6, 'C6', 2, 'C2', '2020-12-28 10:48:38', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (124, 2, 6, 'C6', 15, 2, 'C2', 2, 'C2', '2020-12-28 10:48:38', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (125, 2, 2, 'C2', 7, 7, 'C7', 2, 'C2', '2020-12-28 10:48:38', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (126, 2, 7, 'C7', 11, 2, 'C2', 2, 'C2', '2020-12-28 10:48:38', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (127, 2, 3, 'C3', 9, 3, 'C3', 3, 'C3', '2020-12-28 10:49:20', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (128, 2, 3, 'C3', 6, 4, 'C4', 3, 'C3', '2020-12-28 10:49:20', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (129, 2, 4, 'C4', 12, 3, 'C3', 3, 'C3', '2020-12-28 10:49:20', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (130, 2, 3, 'C3', 7, 5, 'C5', 3, 'C3', '2020-12-28 10:49:20', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (131, 2, 5, 'C5', 11, 3, 'C3', 3, 'C3', '2020-12-28 10:49:20', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (132, 2, 3, 'C3', 5, 6, 'C6', 3, 'C3', '2020-12-28 10:49:20', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (133, 2, 6, 'C6', 13, 3, 'C3', 3, 'C3', '2020-12-28 10:49:20', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (134, 2, 3, 'C3', 8, 7, 'C7', 3, 'C3', '2020-12-28 10:49:20', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (135, 2, 7, 'C7', 10, 3, 'C3', 3, 'C3', '2020-12-28 10:49:20', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (136, 2, 4, 'C4', 9, 4, 'C4', 4, 'C4', '2020-12-28 10:49:44', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (137, 2, 4, 'C4', 7, 5, 'C5', 4, 'C4', '2020-12-28 10:49:44', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (138, 2, 5, 'C5', 11, 4, 'C4', 4, 'C4', '2020-12-28 10:49:44', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (139, 2, 4, 'C4', 2, 6, 'C6', 4, 'C4', '2020-12-28 10:49:44', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (140, 2, 6, 'C6', 16, 4, 'C4', 4, 'C4', '2020-12-28 10:49:44', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (141, 2, 4, 'C4', 8, 7, 'C7', 4, 'C4', '2020-12-28 10:49:44', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (142, 2, 7, 'C7', 10, 4, 'C4', 4, 'C4', '2020-12-28 10:49:44', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (143, 2, 5, 'C5', 9, 5, 'C5', 5, 'C5', '2020-12-28 10:49:59', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (144, 2, 5, 'C5', 4, 6, 'C6', 5, 'C5', '2020-12-28 10:49:59', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (145, 2, 6, 'C6', 14, 5, 'C5', 5, 'C5', '2020-12-28 10:49:59', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (146, 2, 5, 'C5', 7, 7, 'C7', 5, 'C5', '2020-12-28 10:49:59', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (147, 2, 7, 'C7', 11, 5, 'C5', 5, 'C5', '2020-12-28 10:49:59', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (148, 2, 6, 'C6', 9, 6, 'C6', 6, 'C6', '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (149, 2, 6, 'C6', 7, 7, 'C7', 6, 'C6', '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (150, 2, 7, 'C7', 11, 6, 'C6', 6, 'C6', '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_hitung_det` VALUES (151, 2, 7, 'C7', 9, 7, 'C7', 6, 'C6', '2020-12-28 10:50:07', NULL, NULL);

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
  `nilai_l` float(20, 9) NULL DEFAULT NULL,
  `nilai_m` float(20, 9) NULL DEFAULT NULL,
  `nilai_u` float(20, 9) NULL DEFAULT NULL,
  `bawah` float(20, 9) NULL DEFAULT NULL,
  `total` float(20, 9) NULL DEFAULT NULL,
  `hasil` float(20, 9) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_hitungan_vektor
-- ----------------------------
INSERT INTO `t_hitungan_vektor` VALUES (1, 1, 'C1', 2, 'C2', -0.208604276, -0.109199464, 0.073747188, -0.182946652, 1.140246511, 1.000000000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 1, 'C1', 3, 'C3', -0.264758646, -0.109199464, 0.053954970, -0.163154438, 1.622748733, 1.000000000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 1, 'C1', 4, 'C4', -0.261234313, -0.109199464, 0.047864873, -0.157064334, 1.663231254, 1.000000000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 1, 'C1', 5, 'C5', -0.268870354, -0.109199464, 0.044211570, -0.153411031, 1.752614260, 1.000000000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 1, 'C1', 6, 'C6', -0.306942940, -0.109199464, 0.020571446, -0.129770905, 2.365267754, 1.000000000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 1, 'C1', 7, 'C7', -0.292307168, -0.109199464, 0.036859229, -0.146058694, 2.001299381, 1.000000000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 2, 'C2', 1, 'C1', -0.162708938, -0.103940167, 0.084426403, -0.188366577, 0.863788843, 0.863788843, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 2, 'C2', 3, 'C3', -0.233841717, -0.103940167, 0.053954970, -0.157895133, 1.480993748, 1.000000000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 2, 'C2', 4, 'C4', -0.230317384, -0.103940167, 0.047864873, -0.151805043, 1.517192006, 1.000000000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 2, 'C2', 5, 'C5', -0.237953439, -0.103940167, 0.044211570, -0.148151740, 1.606146812, 1.000000000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 2, 'C2', 6, 'C6', -0.276026011, -0.103940167, 0.020571446, -0.124511614, 2.216869593, 1.000000000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 2, 'C2', 7, 'C7', -0.261390239, -0.103940167, 0.036859229, -0.140799388, 1.856472850, 1.000000000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 3, 'C3', 1, 'C1', -0.061584830, -0.078762636, 0.084426403, -0.163189039, 0.377383351, 0.377383351, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 3, 'C3', 2, 'C2', -0.076563247, -0.078762636, 0.073747188, -0.152509823, 0.502021730, 0.502021730, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 3, 'C3', 4, 'C4', -0.129193276, -0.078762636, 0.047864873, -0.126627520, 1.020262241, 1.000000000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 3, 'C3', 5, 'C5', -0.136829332, -0.078762636, 0.044211570, -0.122974209, 1.112666845, 1.000000000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 3, 'C3', 6, 'C6', -0.174901918, -0.078762636, 0.020571446, -0.099334083, 1.760744214, 1.000000000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 3, 'C3', 7, 'C7', -0.160266146, -0.078762636, 0.036859229, -0.115621865, 1.386123061, 1.000000000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 4, 'C4', 1, 'C1', -0.049990982, -0.069734551, 0.084426403, -0.154160962, 0.324277848, 0.324277848, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 4, 'C4', 2, 'C2', -0.064969398, -0.069734551, 0.073747188, -0.143481746, 0.452806026, 0.452806026, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 4, 'C4', 3, 'C3', -0.121123761, -0.069734551, 0.053954970, -0.123689525, 0.979256451, 0.979256451, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 4, 'C4', 5, 'C5', -0.125235483, -0.069734551, 0.044211570, -0.113946125, 1.099076271, 1.000000000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 4, 'C4', 6, 'C6', -0.163308069, -0.069734551, 0.020571446, -0.090305999, 1.808385491, 1.000000000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 4, 'C4', 7, 'C7', -0.148672298, -0.069734551, 0.036859229, -0.106593780, 1.394755721, 1.000000000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 5, 'C5', 1, 'C1', -0.042261750, -0.073294677, 0.084426403, -0.157721087, 0.267952442, 0.267952442, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 5, 'C5', 2, 'C2', -0.057240166, -0.073294677, 0.073747188, -0.147041872, 0.389277995, 0.389277995, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 5, 'C5', 3, 'C3', -0.113394529, -0.073294677, 0.053954970, -0.127249643, 0.891118586, 0.891118586, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 5, 'C5', 4, 'C4', -0.109870195, -0.073294677, 0.047864873, -0.121159554, 0.906822383, 0.906822383, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 5, 'C5', 6, 'C6', -0.155578837, -0.073294677, 0.020571446, -0.093866125, 1.657454491, 1.000000000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 5, 'C5', 7, 'C7', -0.140943065, -0.073294677, 0.036859229, -0.110153906, 1.279510379, 1.000000000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 6, 'C6', 1, 'C1', 0.062036868, -0.030708769, 0.084426403, -0.115135171, -0.538817704, 0.000000000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 6, 'C6', 2, 'C2', 0.047058456, -0.030708769, 0.073747188, -0.104455955, -0.450509995, 0.000000000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 6, 'C6', 3, 'C3', -0.009095912, -0.030708769, 0.053954970, -0.084663741, 0.107435748, 0.107435748, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 6, 'C6', 4, 'C4', -0.005571579, -0.030708769, 0.047864873, -0.078573644, 0.070909008, 0.070909008, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 6, 'C6', 5, 'C5', -0.013207634, -0.030708769, 0.044211570, -0.074920341, 0.176289022, 0.176289022, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 6, 'C6', 7, 'C7', -0.036644444, -0.030708769, 0.036859229, -0.067567997, 0.542334318, 0.542334318, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 7, 'C7', 1, 'C1', -0.039041236, -0.100863323, 0.084426403, -0.185289726, 0.210703731, 0.210703731, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 7, 'C7', 2, 'C2', -0.054019652, -0.100863323, 0.073747188, -0.174610510, 0.309372276, 0.309372276, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 7, 'C7', 3, 'C3', -0.110174015, -0.100863323, 0.053954970, -0.154818296, 0.711634338, 0.711634338, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 7, 'C7', 4, 'C4', -0.106649682, -0.100863323, 0.047864873, -0.148728192, 0.717077792, 0.717077792, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 7, 'C7', 5, 'C5', -0.114285737, -0.100863323, 0.044211570, -0.145074889, 0.787770629, 0.787770629, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (1, 7, 'C7', 6, 'C6', -0.152358323, -0.100863323, 0.020571446, -0.121434763, 1.254651546, 1.000000000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (2, 1, 'C1', 2, 'C2', -0.208604276, -0.109199464, 0.073747188, -0.182946652, 1.140246511, 1.000000000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (2, 1, 'C1', 3, 'C3', -0.264758646, -0.109199464, 0.053954970, -0.163154438, 1.622748733, 1.000000000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (2, 1, 'C1', 4, 'C4', -0.261234313, -0.109199464, 0.047864873, -0.157064334, 1.663231254, 1.000000000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (2, 1, 'C1', 5, 'C5', -0.268870354, -0.109199464, 0.044211570, -0.153411031, 1.752614260, 1.000000000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (2, 1, 'C1', 6, 'C6', -0.306942940, -0.109199464, 0.020571446, -0.129770905, 2.365267754, 1.000000000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (2, 1, 'C1', 7, 'C7', -0.292307168, -0.109199464, 0.036859229, -0.146058694, 2.001299381, 1.000000000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (2, 2, 'C2', 1, 'C1', -0.162708938, -0.103940167, 0.084426403, -0.188366577, 0.863788843, 0.863788843, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (2, 2, 'C2', 3, 'C3', -0.233841717, -0.103940167, 0.053954970, -0.157895133, 1.480993748, 1.000000000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (2, 2, 'C2', 4, 'C4', -0.230317384, -0.103940167, 0.047864873, -0.151805043, 1.517192006, 1.000000000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (2, 2, 'C2', 5, 'C5', -0.237953439, -0.103940167, 0.044211570, -0.148151740, 1.606146812, 1.000000000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (2, 2, 'C2', 6, 'C6', -0.276026011, -0.103940167, 0.020571446, -0.124511614, 2.216869593, 1.000000000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (2, 2, 'C2', 7, 'C7', -0.261390239, -0.103940167, 0.036859229, -0.140799388, 1.856472850, 1.000000000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (2, 3, 'C3', 1, 'C1', -0.061584830, -0.078762636, 0.084426403, -0.163189039, 0.377383351, 0.377383351, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (2, 3, 'C3', 2, 'C2', -0.076563247, -0.078762636, 0.073747188, -0.152509823, 0.502021730, 0.502021730, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (2, 3, 'C3', 4, 'C4', -0.129193276, -0.078762636, 0.047864873, -0.126627520, 1.020262241, 1.000000000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (2, 3, 'C3', 5, 'C5', -0.136829332, -0.078762636, 0.044211570, -0.122974209, 1.112666845, 1.000000000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (2, 3, 'C3', 6, 'C6', -0.174901918, -0.078762636, 0.020571446, -0.099334083, 1.760744214, 1.000000000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (2, 3, 'C3', 7, 'C7', -0.160266146, -0.078762636, 0.036859229, -0.115621865, 1.386123061, 1.000000000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (2, 4, 'C4', 1, 'C1', -0.049990982, -0.069734551, 0.084426403, -0.154160962, 0.324277848, 0.324277848, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (2, 4, 'C4', 2, 'C2', -0.064969398, -0.069734551, 0.073747188, -0.143481746, 0.452806026, 0.452806026, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (2, 4, 'C4', 3, 'C3', -0.121123761, -0.069734551, 0.053954970, -0.123689525, 0.979256451, 0.979256451, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (2, 4, 'C4', 5, 'C5', -0.125235483, -0.069734551, 0.044211570, -0.113946125, 1.099076271, 1.000000000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (2, 4, 'C4', 6, 'C6', -0.163308069, -0.069734551, 0.020571446, -0.090305999, 1.808385491, 1.000000000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (2, 4, 'C4', 7, 'C7', -0.148672298, -0.069734551, 0.036859229, -0.106593780, 1.394755721, 1.000000000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (2, 5, 'C5', 1, 'C1', -0.042261750, -0.073294677, 0.084426403, -0.157721087, 0.267952442, 0.267952442, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (2, 5, 'C5', 2, 'C2', -0.057240166, -0.073294677, 0.073747188, -0.147041872, 0.389277995, 0.389277995, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (2, 5, 'C5', 3, 'C3', -0.113394529, -0.073294677, 0.053954970, -0.127249643, 0.891118586, 0.891118586, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (2, 5, 'C5', 4, 'C4', -0.109870195, -0.073294677, 0.047864873, -0.121159554, 0.906822383, 0.906822383, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (2, 5, 'C5', 6, 'C6', -0.155578837, -0.073294677, 0.020571446, -0.093866125, 1.657454491, 1.000000000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (2, 5, 'C5', 7, 'C7', -0.140943065, -0.073294677, 0.036859229, -0.110153906, 1.279510379, 1.000000000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (2, 6, 'C6', 1, 'C1', 0.062036868, -0.030708769, 0.084426403, -0.115135171, -0.538817704, 0.000000000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (2, 6, 'C6', 2, 'C2', 0.047058456, -0.030708769, 0.073747188, -0.104455955, -0.450509995, 0.000000000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (2, 6, 'C6', 3, 'C3', -0.009095912, -0.030708769, 0.053954970, -0.084663741, 0.107435748, 0.107435748, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (2, 6, 'C6', 4, 'C4', -0.005571579, -0.030708769, 0.047864873, -0.078573644, 0.070909008, 0.070909008, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (2, 6, 'C6', 5, 'C5', -0.013207634, -0.030708769, 0.044211570, -0.074920341, 0.176289022, 0.176289022, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (2, 6, 'C6', 7, 'C7', -0.036644444, -0.030708769, 0.036859229, -0.067567997, 0.542334318, 0.542334318, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (2, 7, 'C7', 1, 'C1', -0.039041236, -0.100863323, 0.084426403, -0.185289726, 0.210703731, 0.210703731, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (2, 7, 'C7', 2, 'C2', -0.054019652, -0.100863323, 0.073747188, -0.174610510, 0.309372276, 0.309372276, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (2, 7, 'C7', 3, 'C3', -0.110174015, -0.100863323, 0.053954970, -0.154818296, 0.711634338, 0.711634338, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (2, 7, 'C7', 4, 'C4', -0.106649682, -0.100863323, 0.047864873, -0.148728192, 0.717077792, 0.717077792, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (2, 7, 'C7', 5, 'C5', -0.114285737, -0.100863323, 0.044211570, -0.145074889, 0.787770629, 0.787770629, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_hitungan_vektor` VALUES (2, 7, 'C7', 6, 'C6', -0.152358323, -0.100863323, 0.020571446, -0.121434763, 1.254651546, 1.000000000, '2020-12-28 10:50:07', NULL, NULL);

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
  `nilai` float(20, 20) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_normalisasi
-- ----------------------------
INSERT INTO `t_normalisasi` VALUES (1, 1, 'C1', 1, 'C1', 1.00000000000000000000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 1, 'C1', 2, 'C2', 1.00000000000000000000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 1, 'C1', 3, 'C3', 1.00000000000000000000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 1, 'C1', 4, 'C4', 1.00000000000000000000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 1, 'C1', 5, 'C5', 1.00000000000000000000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 1, 'C1', 6, 'C6', 1.00000000000000000000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 1, 'C1', 7, 'C7', 1.00000000000000000000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 2, 'C2', 2, 'C2', 1.00000000000000000000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 2, 'C2', 1, 'C1', 0.86378884315490720000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 2, 'C2', 3, 'C3', 1.00000000000000000000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 2, 'C2', 4, 'C4', 1.00000000000000000000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 2, 'C2', 5, 'C5', 1.00000000000000000000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 2, 'C2', 6, 'C6', 1.00000000000000000000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 2, 'C2', 7, 'C7', 1.00000000000000000000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 3, 'C3', 3, 'C3', 1.00000000000000000000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 3, 'C3', 1, 'C1', 0.37738335132598877000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 3, 'C3', 2, 'C2', 0.50202172994613650000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 3, 'C3', 4, 'C4', 1.00000000000000000000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 3, 'C3', 5, 'C5', 1.00000000000000000000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 3, 'C3', 6, 'C6', 1.00000000000000000000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 3, 'C3', 7, 'C7', 1.00000000000000000000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 4, 'C4', 4, 'C4', 1.00000000000000000000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 4, 'C4', 1, 'C1', 0.32427784800529480000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 4, 'C4', 2, 'C2', 0.45280602574348450000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 4, 'C4', 3, 'C3', 0.97925645112991330000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 4, 'C4', 5, 'C5', 1.00000000000000000000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 4, 'C4', 6, 'C6', 1.00000000000000000000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 4, 'C4', 7, 'C7', 1.00000000000000000000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 5, 'C5', 5, 'C5', 1.00000000000000000000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 5, 'C5', 1, 'C1', 0.26795244216918945000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 5, 'C5', 2, 'C2', 0.38927799463272095000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 5, 'C5', 3, 'C3', 0.89111858606338500000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 5, 'C5', 4, 'C4', 0.90682238340377810000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 5, 'C5', 6, 'C6', 1.00000000000000000000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 5, 'C5', 7, 'C7', 1.00000000000000000000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 6, 'C6', 6, 'C6', 1.00000000000000000000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 6, 'C6', 1, 'C1', 0.00000000000000000000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 6, 'C6', 2, 'C2', 0.00000000000000000000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 6, 'C6', 3, 'C3', 0.10743574798107147000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 6, 'C6', 4, 'C4', 0.07090900838375092000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 6, 'C6', 5, 'C5', 0.17628902196884155000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 6, 'C6', 7, 'C7', 0.54233431816101070000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 7, 'C7', 7, 'C7', 1.00000000000000000000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 7, 'C7', 1, 'C1', 0.21070373058319092000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 7, 'C7', 2, 'C2', 0.30937227606773376000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 7, 'C7', 3, 'C3', 0.71163433790206910000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 7, 'C7', 4, 'C4', 0.71707779169082640000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 7, 'C7', 5, 'C5', 0.78777062892913820000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (1, 7, 'C7', 6, 'C6', 1.00000000000000000000, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (2, 1, 'C1', 1, 'C1', 1.00000000000000000000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (2, 1, 'C1', 2, 'C2', 1.00000000000000000000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (2, 1, 'C1', 3, 'C3', 1.00000000000000000000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (2, 1, 'C1', 4, 'C4', 1.00000000000000000000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (2, 1, 'C1', 5, 'C5', 1.00000000000000000000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (2, 1, 'C1', 6, 'C6', 1.00000000000000000000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (2, 1, 'C1', 7, 'C7', 1.00000000000000000000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (2, 2, 'C2', 2, 'C2', 1.00000000000000000000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (2, 2, 'C2', 1, 'C1', 0.86378884315490720000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (2, 2, 'C2', 3, 'C3', 1.00000000000000000000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (2, 2, 'C2', 4, 'C4', 1.00000000000000000000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (2, 2, 'C2', 5, 'C5', 1.00000000000000000000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (2, 2, 'C2', 6, 'C6', 1.00000000000000000000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (2, 2, 'C2', 7, 'C7', 1.00000000000000000000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (2, 3, 'C3', 3, 'C3', 1.00000000000000000000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (2, 3, 'C3', 1, 'C1', 0.37738335132598877000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (2, 3, 'C3', 2, 'C2', 0.50202172994613650000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (2, 3, 'C3', 4, 'C4', 1.00000000000000000000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (2, 3, 'C3', 5, 'C5', 1.00000000000000000000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (2, 3, 'C3', 6, 'C6', 1.00000000000000000000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (2, 3, 'C3', 7, 'C7', 1.00000000000000000000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (2, 4, 'C4', 4, 'C4', 1.00000000000000000000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (2, 4, 'C4', 1, 'C1', 0.32427784800529480000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (2, 4, 'C4', 2, 'C2', 0.45280602574348450000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (2, 4, 'C4', 3, 'C3', 0.97925645112991330000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (2, 4, 'C4', 5, 'C5', 1.00000000000000000000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (2, 4, 'C4', 6, 'C6', 1.00000000000000000000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (2, 4, 'C4', 7, 'C7', 1.00000000000000000000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (2, 5, 'C5', 5, 'C5', 1.00000000000000000000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (2, 5, 'C5', 1, 'C1', 0.26795244216918945000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (2, 5, 'C5', 2, 'C2', 0.38927799463272095000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (2, 5, 'C5', 3, 'C3', 0.89111858606338500000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (2, 5, 'C5', 4, 'C4', 0.90682238340377810000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (2, 5, 'C5', 6, 'C6', 1.00000000000000000000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (2, 5, 'C5', 7, 'C7', 1.00000000000000000000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (2, 6, 'C6', 6, 'C6', 1.00000000000000000000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (2, 6, 'C6', 1, 'C1', 0.00000000000000000000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (2, 6, 'C6', 2, 'C2', 0.00000000000000000000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (2, 6, 'C6', 3, 'C3', 0.10743574798107147000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (2, 6, 'C6', 4, 'C4', 0.07090900838375092000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (2, 6, 'C6', 5, 'C5', 0.17628902196884155000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (2, 6, 'C6', 7, 'C7', 0.54233431816101070000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (2, 7, 'C7', 7, 'C7', 1.00000000000000000000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (2, 7, 'C7', 1, 'C1', 0.21070373058319092000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (2, 7, 'C7', 2, 'C2', 0.30937227606773376000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (2, 7, 'C7', 3, 'C3', 0.71163433790206910000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (2, 7, 'C7', 4, 'C4', 0.71707779169082640000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (2, 7, 'C7', 5, 'C5', 0.78777062892913820000, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_normalisasi` VALUES (2, 7, 'C7', 6, 'C6', 1.00000000000000000000, '2020-12-28 10:50:07', NULL, NULL);

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
INSERT INTO `t_role_menu` VALUES (14, 1, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (16, 1, 1, 1, 0);
INSERT INTO `t_role_menu` VALUES (11, 1, 0, 0, 0);
INSERT INTO `t_role_menu` VALUES (12, 1, 1, 1, 1);
INSERT INTO `t_role_menu` VALUES (15, 1, 1, 1, 1);
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
  `sintesis_lower` float(20, 9) NULL DEFAULT NULL,
  `sintesis_medium` float(20, 9) NULL DEFAULT NULL,
  `sintesis_upper` float(20, 9) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_sintesis
-- ----------------------------
INSERT INTO `t_sintesis` VALUES (1, 1, 1, 'C1', 0.154189557, 0.238615960, 0.347815424, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_sintesis` VALUES (2, 1, 2, 'C2', 0.139211133, 0.212958321, 0.316898495, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_sintesis` VALUES (3, 1, 3, 'C3', 0.083056770, 0.137011737, 0.215774387, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_sintesis` VALUES (4, 1, 4, 'C4', 0.086581104, 0.134445980, 0.204180539, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_sintesis` VALUES (5, 1, 5, 'C5', 0.078945048, 0.123156622, 0.196451306, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_sintesis` VALUES (6, 1, 6, 'C6', 0.040872470, 0.061443914, 0.092152685, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_sintesis` VALUES (7, 1, 7, 'C7', 0.055508237, 0.092367470, 0.193230793, '2020-12-27 13:20:06', NULL, NULL);
INSERT INTO `t_sintesis` VALUES (8, 2, 1, 'C1', 0.154189557, 0.238615960, 0.347815424, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_sintesis` VALUES (9, 2, 2, 'C2', 0.139211133, 0.212958321, 0.316898495, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_sintesis` VALUES (10, 2, 3, 'C3', 0.083056770, 0.137011737, 0.215774387, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_sintesis` VALUES (11, 2, 4, 'C4', 0.086581104, 0.134445980, 0.204180539, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_sintesis` VALUES (12, 2, 5, 'C5', 0.078945048, 0.123156622, 0.196451306, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_sintesis` VALUES (13, 2, 6, 'C6', 0.040872470, 0.061443914, 0.092152685, '2020-12-28 10:50:07', NULL, NULL);
INSERT INTO `t_sintesis` VALUES (14, 2, 7, 'C7', 0.055508237, 0.092367470, 0.193230793, '2020-12-28 10:50:07', NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
