/*
 Navicat Premium Data Transfer

 Source Server         : PHPMYADMIN
 Source Server Type    : MySQL
 Source Server Version : 100131
 Source Host           : localhost:3306
 Source Schema         : adhikarya

 Target Server Type    : MySQL
 Target Server Version : 100131
 File Encoding         : 65001

 Date: 19/06/2019 22:22:54
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for analisa
-- ----------------------------
DROP TABLE IF EXISTS `analisa`;
CREATE TABLE `analisa`  (
  `analisa_id` int(11) NOT NULL AUTO_INCREMENT,
  `analisa_idpekerjaan` int(11) NULL DEFAULT NULL,
  `analisa_date` datetime(0) NULL DEFAULT NULL,
  `analisa_idtafsiran` int(255) NULL DEFAULT NULL,
  PRIMARY KEY (`analisa_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 152 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of analisa
-- ----------------------------
INSERT INTO `analisa` VALUES (147, 3, NULL, 6);
INSERT INTO `analisa` VALUES (149, 1, NULL, 6);
INSERT INTO `analisa` VALUES (150, 3, NULL, 3);
INSERT INTO `analisa` VALUES (151, 1, NULL, 5);

-- ----------------------------
-- Table structure for analisa_old
-- ----------------------------
DROP TABLE IF EXISTS `analisa_old`;
CREATE TABLE `analisa_old`  (
  `analisa_id` int(11) NOT NULL AUTO_INCREMENT,
  `analisa_idpekerjaan` int(11) NULL DEFAULT NULL,
  `analisa_kode` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `analisa_analisa` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `analisa_overhead` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `analisa_idsatuan` int(11) NULL DEFAULT NULL,
  `analisa_jumlah` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `analisa_date` datetime(0) NULL DEFAULT NULL,
  `analisa_idtafsiran` int(255) NULL DEFAULT NULL,
  PRIMARY KEY (`analisa_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 149 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of analisa_old
-- ----------------------------
INSERT INTO `analisa_old` VALUES (147, 3, NULL, NULL, NULL, NULL, NULL, NULL, 6);
INSERT INTO `analisa_old` VALUES (148, 3, NULL, NULL, NULL, NULL, NULL, NULL, 6);

-- ----------------------------
-- Table structure for analisadetail
-- ----------------------------
DROP TABLE IF EXISTS `analisadetail`;
CREATE TABLE `analisadetail`  (
  `analisadetail_id` int(11) NOT NULL AUTO_INCREMENT,
  `analisadetail_idanalisapekerjaan` int(11) NULL DEFAULT NULL,
  `analisadetail_idhargasatuan` int(11) NULL DEFAULT NULL,
  `analisadetail_koefisien` int(11) NULL DEFAULT NULL,
  `analisadetail_date` date NULL DEFAULT NULL,
  PRIMARY KEY (`analisadetail_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of analisadetail
-- ----------------------------
INSERT INTO `analisadetail` VALUES (3, 160, 2, 1, '2019-04-11');
INSERT INTO `analisadetail` VALUES (4, 156, 2, 1, '2019-04-11');

-- ----------------------------
-- Table structure for analisapekerjaan
-- ----------------------------
DROP TABLE IF EXISTS `analisapekerjaan`;
CREATE TABLE `analisapekerjaan`  (
  `analisapekerjaan_id` int(11) NOT NULL AUTO_INCREMENT,
  `analisapekerjaan_idpekerjaan` int(11) NULL DEFAULT NULL,
  `analisapekerjaan_kode` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `analisapekerjaan_kegiatan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `analisapekerjaan_overhead` int(11) NULL DEFAULT NULL,
  `analisapekerjaan_harga` int(11) NULL DEFAULT NULL,
  `analisapekerjaan_date` datetime(0) NULL DEFAULT NULL,
  `analisapekerjaan_total` int(11) NULL DEFAULT NULL,
  `analisapekerjaan_idsatuan` int(255) NULL DEFAULT NULL,
  PRIMARY KEY (`analisapekerjaan_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 163 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of analisapekerjaan
-- ----------------------------
INSERT INTO `analisapekerjaan` VALUES (156, 1, 'P.01.e.2', 'Pembongkaran pasangan batu kali', 15, NULL, '2019-04-11 00:00:00', NULL, 3);
INSERT INTO `analisapekerjaan` VALUES (160, 3, 'p.01.e.2', 'Pembongkaran pasangan batu kali', 15, NULL, '2019-04-11 00:00:00', NULL, 3);
INSERT INTO `analisapekerjaan` VALUES (162, 3, 'B.29', 'Bongkar beton jembatan', 17, NULL, '2019-04-11 00:00:00', NULL, 7);

-- ----------------------------
-- Table structure for analisapekerjaandetail
-- ----------------------------
DROP TABLE IF EXISTS `analisapekerjaandetail`;
CREATE TABLE `analisapekerjaandetail`  (
  `analisapekerjaandetail_id` int(11) NOT NULL AUTO_INCREMENT,
  `analisapekerjaandetail_idanalisapekerjaan` int(11) NULL DEFAULT NULL,
  `analisapekerjaandetail_idsatuan` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`analisapekerjaandetail_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for hargasatuan
-- ----------------------------
DROP TABLE IF EXISTS `hargasatuan`;
CREATE TABLE `hargasatuan`  (
  `hargasatuan_id` int(11) NOT NULL AUTO_INCREMENT,
  `hargasatuan_idkategori` int(10) NULL DEFAULT NULL,
  `hargasatuan_kode` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `hargasatuan_uraian` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `hargasatuan_hargasatuan` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `hargasatuan_satuan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `hargasatuan_keterangan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`hargasatuan_id`) USING BTREE,
  INDEX `fk_idkatefori_on_hargasatuan`(`hargasatuan_idkategori`) USING BTREE,
  CONSTRAINT `fk_idkatefori_on_hargasatuan` FOREIGN KEY (`hargasatuan_idkategori`) REFERENCES `kategorisatuan` (`kategorisatuan_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of hargasatuan
-- ----------------------------
INSERT INTO `hargasatuan` VALUES (1, 1, 'M.02', 'Air', '130', '4', '-');
INSERT INTO `hargasatuan` VALUES (2, 1, 'M.03b', 'Batu Belah', '225000', '4', 'dawda');
INSERT INTO `hargasatuan` VALUES (3, 2, 'L.01', 'Tenaga/Pekerja tidak terlatih', '53000', '4', '');

-- ----------------------------
-- Table structure for kategorisatuan
-- ----------------------------
DROP TABLE IF EXISTS `kategorisatuan`;
CREATE TABLE `kategorisatuan`  (
  `kategorisatuan_id` int(11) NOT NULL AUTO_INCREMENT,
  `kategorisatuan_kode` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `kategorisatuan_nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `kategorisatuan_dibuat` datetime(0) NULL DEFAULT NULL,
  `kategorisatuan_keterangan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`kategorisatuan_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of kategorisatuan
-- ----------------------------
INSERT INTO `kategorisatuan` VALUES (1, 'A', 'Bahan', '2018-09-12 00:00:00', 'kategori bahan');
INSERT INTO `kategorisatuan` VALUES (2, 'B', 'Upah', '2018-09-12 00:00:00', 'kategori upah');
INSERT INTO `kategorisatuan` VALUES (3, 'C', 'Alat', '2018-09-12 00:00:00', 'kategori alat');

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu`  (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `menu_ikon` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `menu_is_mainmenu` int(5) NULL DEFAULT NULL,
  `menu_link` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `menu_akses_level` int(5) NULL DEFAULT NULL,
  `menu_urutan` int(5) NULL DEFAULT NULL,
  `menu_status` varchar(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`menu_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES (1, 'master', 'fa  fa-adjust', 0, '#', 1, 1, '1');
INSERT INTO `menu` VALUES (2, 'harga satuan', 'fa fa-circle-o', 1, 'hargasatuan/admin', 1, 3, '1');
INSERT INTO `menu` VALUES (3, 'daftar taksiran', 'fa fa-circle-o', 1, 'taksiran/admin', 1, 4, '1');
INSERT INTO `menu` VALUES (4, 'analisis', 'fa fa-bar-chart', 0, '#', 1, 2, '1');
INSERT INTO `menu` VALUES (5, 'pekerjaan', 'fa fa-circle-o', 4, 'pekerjaan/admin', 1, 1, '1');
INSERT INTO `menu` VALUES (6, 'analisis', 'fa fa-circle-o', 4, 'analisa/admin', 1, 2, '0');
INSERT INTO `menu` VALUES (7, 'laporan', 'fa fa-print', 0, '#', 1, 3, '1');
INSERT INTO `menu` VALUES (8, 'satuan pekerjaan', 'fa fa-file', 7, 'satuanpekerjaan/admin', 1, 1, '1');
INSERT INTO `menu` VALUES (9, 'kuantitas harga', 'fa fa-file', 7, 'kuantitasharga/admin', 1, 2, '1');
INSERT INTO `menu` VALUES (10, 'rekapitulasi', 'fa fa-file', 7, 'rekapitulasi/admin', 1, 3, '1');
INSERT INTO `menu` VALUES (11, 'setting', 'fa fa-gears', 0, '#', 1, 5, '1');
INSERT INTO `menu` VALUES (12, 'user', 'fa fa-circle-o', 11, 'user/admin', 1, 1, '0');
INSERT INTO `menu` VALUES (13, 'kategori', 'fa fa-circle-o', 1, 'kategori/admin', 1, 2, '1');
INSERT INTO `menu` VALUES (14, 'satuan', 'fa fa-circle-o', 1, 'satuan/admin', 1, 1, '1');
INSERT INTO `menu` VALUES (15, 'pengguna', 'fa fa-circle-o', 11, 'user/admin2', 1, 1, '1');
INSERT INTO `menu` VALUES (16, 'analisa', 'fa fa-circle-o', 4, 'analisa2/admin', 3, 1, '1');

-- ----------------------------
-- Table structure for pekerjaan
-- ----------------------------
DROP TABLE IF EXISTS `pekerjaan`;
CREATE TABLE `pekerjaan`  (
  `pekerjaan_id` int(11) NOT NULL AUTO_INCREMENT,
  `pekerjaan_kegiatan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `pekerjaan_pekerjaan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `pekerjaan_lokasi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `pekerjaan_tahunanggaran` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`pekerjaan_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of pekerjaan
-- ----------------------------
INSERT INTO `pekerjaan` VALUES (1, 'penignkatan/rahabilitasi saluran drainase kelurahan kramat utara', 'fisik rehabilitasi/peningkatan saluran drainase kelurahan kramat utara', 'kota magelang', '2018');
INSERT INTO `pekerjaan` VALUES (2, 'Pembuatan Jalan Kabupaten Magelang KM 18', 'Pembuatan Jalan Kabupaten Magelang KM 18', 'kota Magelang', '2018');
INSERT INTO `pekerjaan` VALUES (3, 'Test kegiatan', 'test pekerjaan', 'bantul', '2019');

-- ----------------------------
-- Table structure for satuan
-- ----------------------------
DROP TABLE IF EXISTS `satuan`;
CREATE TABLE `satuan`  (
  `satuan_id` int(11) NOT NULL AUTO_INCREMENT,
  `satuan_satuan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `satuan_kode` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `satuan_status` bit(2) NULL DEFAULT NULL,
  PRIMARY KEY (`satuan_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of satuan
-- ----------------------------
INSERT INTO `satuan` VALUES (3, 'liter', '/Ltr', b'01');
INSERT INTO `satuan` VALUES (4, 'hari', '/hari', b'01');
INSERT INTO `satuan` VALUES (5, 'kilogram', '/kg', b'01');
INSERT INTO `satuan` VALUES (6, 'tafsiran', '/Ls', b'01');
INSERT INTO `satuan` VALUES (7, 'meter persegi', '/M Persegi', b'01');
INSERT INTO `satuan` VALUES (8, 'meter  kibik', '/M Kibik', b'01');
INSERT INTO `satuan` VALUES (9, 'unit', '/Unit', b'01');
INSERT INTO `satuan` VALUES (11, 'lebar', '/Lbr', b'01');

-- ----------------------------
-- Table structure for taksiran
-- ----------------------------
DROP TABLE IF EXISTS `taksiran`;
CREATE TABLE `taksiran`  (
  `taksiran_id` int(11) NOT NULL AUTO_INCREMENT,
  `taksiran_kode` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `taksiran_uraian` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `taksiran_volume` int(255) NULL DEFAULT NULL,
  `taksiran_satuan` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `taksiran_hargasatuan` int(255) NULL DEFAULT NULL,
  PRIMARY KEY (`taksiran_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of taksiran
-- ----------------------------
INSERT INTO `taksiran` VALUES (1, 'ditaksir', 'papan nama pekerjaan', 1000, '6', 250000);
INSERT INTO `taksiran` VALUES (2, 'ditaksir', 'pengukuran dan bowplank', 1000, '6', 200000);
INSERT INTO `taksiran` VALUES (3, 'ditaksir', 'administrasi dan dokumentasi', 1000, '6', 450000);
INSERT INTO `taksiran` VALUES (4, 'ditaksir', 'pengadaan air dan listrik kerja', 1000, '6', 250000);
INSERT INTO `taksiran` VALUES (5, 'ditaksir', 'utility/perbaikan jaringan dalam tanah', 1000, '6', 3500000);
INSERT INTO `taksiran` VALUES (6, 'ditaksir', 'pembersihan lahan', 1000, '6', 500000);
INSERT INTO `taksiran` VALUES (8, 'ditaksir', 'dawdwa', 1000, '4', 300000);

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `user_username` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `user_password` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `user_tersimpan` datetime(0) NULL DEFAULT NULL,
  `user_level` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 22 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'admin', 'admin', 'admin', '2018-09-01 17:10:34', '1');
INSERT INTO `user` VALUES (19, 'duwi', 'duwi', 'duwi', '2018-12-31 00:00:00', '2');
INSERT INTO `user` VALUES (20, 'dani', 'dani', 'dani', '2018-12-31 00:00:00', '2');
INSERT INTO `user` VALUES (21, 'demo', 'demo', 'demo', '2019-06-19 00:00:00', '1');

SET FOREIGN_KEY_CHECKS = 1;