/*
Navicat MySQL Data Transfer

Source Server         : student.aumsys.net
Source Server Version : 50733
Source Host           : localhost:3306
Source Database       : admin_dbstudent

Target Server Type    : MYSQL
Target Server Version : 50733
File Encoding         : 65001

Date: 2021-06-18 11:22:53
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tbl_chuongtrinhhoc
-- ----------------------------
DROP TABLE IF EXISTS `tbl_chuongtrinhhoc`;
CREATE TABLE `tbl_chuongtrinhhoc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_lop` varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
  `id_monhoc` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hocky` int(11) DEFAULT NULL,
  `slot` int(11) DEFAULT NULL,
  `tinchi` int(11) DEFAULT NULL,
  `cdate` int(11) DEFAULT NULL,
  `start_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=161 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_chuongtrinhhoc
-- ----------------------------
INSERT INTO `tbl_chuongtrinhhoc` VALUES ('81', 'el1_qtkd11', 'MC11', '1', '0', '2', null, null);
INSERT INTO `tbl_chuongtrinhhoc` VALUES ('82', 'el1_qtkd11', 'MC15', '1', '0', '3', null, null);
INSERT INTO `tbl_chuongtrinhhoc` VALUES ('83', 'el1_qtkd11', 'MC21', '1', '0', '2', null, null);
INSERT INTO `tbl_chuongtrinhhoc` VALUES ('84', 'el1_qtkd11', 'MC16', '1', '0', '2', null, null);
INSERT INTO `tbl_chuongtrinhhoc` VALUES ('85', 'el1_qtkd11', 'QTKD06', '1', '0', '2', null, null);
INSERT INTO `tbl_chuongtrinhhoc` VALUES ('86', 'el1_lkt11', 'MC11', '1', '0', '2', null, null);
INSERT INTO `tbl_chuongtrinhhoc` VALUES ('87', 'el1_lkt11', 'MC16', '1', '0', '3', null, null);
INSERT INTO `tbl_chuongtrinhhoc` VALUES ('88', 'el1_lkt11', 'MC19', '1', '0', '2', null, null);
INSERT INTO `tbl_chuongtrinhhoc` VALUES ('89', 'el1_lkt11', 'LKT04', '1', '0', '2', null, null);
INSERT INTO `tbl_chuongtrinhhoc` VALUES ('90', 'el1_lkt11', 'LKT05', '1', '0', '2', null, null);
INSERT INTO `tbl_chuongtrinhhoc` VALUES ('91', 'el1_lkt11', 'LKT10', '1', '0', '2', null, null);
INSERT INTO `tbl_chuongtrinhhoc` VALUES ('92', 'el1_lkt11', 'LKT13', '1', '0', '2', null, null);
INSERT INTO `tbl_chuongtrinhhoc` VALUES ('93', 'el1_qlnn11', 'MC01', '1', '0', '3', null, null);
INSERT INTO `tbl_chuongtrinhhoc` VALUES ('94', 'el1_qlnn11', 'MC19', '1', '0', '2', null, null);
INSERT INTO `tbl_chuongtrinhhoc` VALUES ('95', 'el1_qlnn11', 'QLNN22', '1', '0', '2', null, null);
INSERT INTO `tbl_chuongtrinhhoc` VALUES ('96', 'el1_qlnn11', 'QLNN29', '1', '0', '2', null, null);
INSERT INTO `tbl_chuongtrinhhoc` VALUES ('97', 'el1_qlnn11', 'QLNN30', '1', '0', '2', null, null);
INSERT INTO `tbl_chuongtrinhhoc` VALUES ('98', 'el1_qtkd11', 'MC02', '1', '0', '3', null, null);
INSERT INTO `tbl_chuongtrinhhoc` VALUES ('99', 'el1_qlnn11', 'MC13', '1', '0', '3', null, null);
INSERT INTO `tbl_chuongtrinhhoc` VALUES ('100', 'el1_lkt11', 'MC18', '1', '0', '3', null, null);
INSERT INTO `tbl_chuongtrinhhoc` VALUES ('108', 'el22_lkt11', 'MC11', '1', '0', '2', null, null);
INSERT INTO `tbl_chuongtrinhhoc` VALUES ('109', 'el22_lkt11', 'LKT04', '1', '0', '2', null, null);
INSERT INTO `tbl_chuongtrinhhoc` VALUES ('110', 'el22_lkt11', 'LKT05', '1', '0', '2', null, null);
INSERT INTO `tbl_chuongtrinhhoc` VALUES ('111', 'el22_lkt11', 'LKT10', '1', '0', '2', null, null);
INSERT INTO `tbl_chuongtrinhhoc` VALUES ('112', 'el22_lkt11', 'LKT13', '1', '0', '2', null, null);
INSERT INTO `tbl_chuongtrinhhoc` VALUES ('113', 'el22_lkt11', 'MC16', '1', '0', '3', null, null);
INSERT INTO `tbl_chuongtrinhhoc` VALUES ('114', 'el22_lkt11', 'MC19', '1', '0', '2', null, null);
INSERT INTO `tbl_chuongtrinhhoc` VALUES ('115', 'aa123', 'MC01', '2', '0', '3', null, null);
INSERT INTO `tbl_chuongtrinhhoc` VALUES ('116', 'aa123', 'MC08', '1', '0', '3', null, null);
INSERT INTO `tbl_chuongtrinhhoc` VALUES ('117', 'aa123', 'MC02', '1', '0', '3', null, null);
INSERT INTO `tbl_chuongtrinhhoc` VALUES ('119', 'el1_qtkd11', 'MC03', '1', '0', '3', null, null);
INSERT INTO `tbl_chuongtrinhhoc` VALUES ('120', 'AUM0121HNCNAC', '1000001', '1', '0', '1', null, null);
INSERT INTO `tbl_chuongtrinhhoc` VALUES ('124', 'AUM0121HNCNCX', 'MC03', '1', '0', '3', null, null);
INSERT INTO `tbl_chuongtrinhhoc` VALUES ('126', 'AUM0121HNCNCX', 'MC16', '1', '0', '3', null, null);
INSERT INTO `tbl_chuongtrinhhoc` VALUES ('148', 'test-1', 'LKT06', '1', '1', '4', null, null);
INSERT INTO `tbl_chuongtrinhhoc` VALUES ('150', 'AUM0220HNCNBC', 'MC01', '1', '1', '3', null, '1621443600');
INSERT INTO `tbl_chuongtrinhhoc` VALUES ('152', 'AUM0220HNCNBC', 'MC04', '1', '1', '3', null, '1621443600');
INSERT INTO `tbl_chuongtrinhhoc` VALUES ('153', 'AUM0220HNCNBC', 'MC06', '1', '1', '3', null, '1621443600');
INSERT INTO `tbl_chuongtrinhhoc` VALUES ('154', 'AUM0220HNCNBC', 'LKT01', '2', '1', '3', null, '1632934800');
INSERT INTO `tbl_chuongtrinhhoc` VALUES ('155', 'AUM0220HNCNBC', 'MC09', '2', '1', '4', null, '1632934800');
INSERT INTO `tbl_chuongtrinhhoc` VALUES ('156', 'AUM0220HNCNBC', 'QTKD25', '2', '1', '4', null, '1632934800');
INSERT INTO `tbl_chuongtrinhhoc` VALUES ('157', 'AUM0220HNCNBC', '1000001', '1', '1', '3', null, '1621443600');
INSERT INTO `tbl_chuongtrinhhoc` VALUES ('158', 'test-1', 'LKT01', '1', '1', '4', '1621931003', '1622307600');
INSERT INTO `tbl_chuongtrinhhoc` VALUES ('159', 'test-1', '1000001', '1', '1', '4', '1621931125', '1622307600');
INSERT INTO `tbl_chuongtrinhhoc` VALUES ('160', 'C211', '1000001', '1', '1', '3', '1623383815', '1625072400');

-- ----------------------------
-- Table structure for tbl_city
-- ----------------------------
DROP TABLE IF EXISTS `tbl_city`;
CREATE TABLE `tbl_city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order` int(11) DEFAULT '0',
  `isactive` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_city
-- ----------------------------
INSERT INTO `tbl_city` VALUES ('1', 'Hà Nội', '0', '1');
INSERT INTO `tbl_city` VALUES ('64', 'Yên Bái', '0', '1');
INSERT INTO `tbl_city` VALUES ('65', 'Đà Lạt', '0', '1');
INSERT INTO `tbl_city` VALUES ('66', 'Hải Dương', '0', '1');
INSERT INTO `tbl_city` VALUES ('67', 'Hải Phòng', '0', '1');
INSERT INTO `tbl_city` VALUES ('68', 'Bắc Ninh', '0', '1');
INSERT INTO `tbl_city` VALUES ('69', 'Phú Thọ', '0', '1');
INSERT INTO `tbl_city` VALUES ('70', 'Lâm Đồng', '0', '1');
INSERT INTO `tbl_city` VALUES ('71', 'Hưng Yên', '0', '1');
INSERT INTO `tbl_city` VALUES ('72', 'Hải Dương', '0', '1');
INSERT INTO `tbl_city` VALUES ('73', 'Thanh Hoá', '0', '1');
INSERT INTO `tbl_city` VALUES ('74', 'Vĩnh Phúc', '0', '1');
INSERT INTO `tbl_city` VALUES ('75', 'Bắc Giang', '0', '1');
INSERT INTO `tbl_city` VALUES ('76', 'Thái Bình', '0', '1');
INSERT INTO `tbl_city` VALUES ('77', 'Tuyên Quang', '0', '1');

-- ----------------------------
-- Table structure for tbl_configsite
-- ----------------------------
DROP TABLE IF EXISTS `tbl_configsite`;
CREATE TABLE `tbl_configsite` (
  `config_id` int(11) NOT NULL AUTO_INCREMENT,
  `tem_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thilai` int(11) NOT NULL,
  `thicaithien` int(11) NOT NULL,
  `hoclai` int(11) NOT NULL,
  `hoccaithien` int(11) NOT NULL,
  `hocchuyendoi` int(11) DEFAULT NULL,
  `bvluanvan` int(11) DEFAULT NULL,
  `chuantinhoc` int(11) DEFAULT NULL,
  `chuantienganh` int(11) DEFAULT NULL,
  `thilaitotnghiep` int(11) DEFAULT NULL,
  PRIMARY KEY (`config_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_configsite
-- ----------------------------
INSERT INTO `tbl_configsite` VALUES ('1', '0', 'AUM - STUDENT - HỆ THỐNG QUẢN LÝ HỌC VIÊN', 'Hà Nội', '100000', '100000', '260000', '260000', '0', '0', '1000000', '800000', '500000');

-- ----------------------------
-- Table structure for tbl_dangky_note
-- ----------------------------
DROP TABLE IF EXISTS `tbl_dangky_note`;
CREATE TABLE `tbl_dangky_note` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_hoso` int(11) DEFAULT NULL,
  `masv` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `notes` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cdate` int(11) DEFAULT NULL,
  `author` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1701 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_dangky_note
-- ----------------------------
INSERT INTO `tbl_dangky_note` VALUES ('1692', '1620570019', '', 'Hồ sơ #1620570019 ( a) tạo mới thành công', '1620570075', 'N/A');
INSERT INTO `tbl_dangky_note` VALUES ('1693', '1620570019', '', 'Hồ sơ #1620570019 ( a) tạo mới thành công', '1620570091', 'N/A');
INSERT INTO `tbl_dangky_note` VALUES ('1694', '1620611787', '', 'Hồ sơ #1620611787 ( a) tạo mới thành công', '1620611928', 'N/A');
INSERT INTO `tbl_dangky_note` VALUES ('1695', '1620611787', '', 'Hồ sơ #1620611787 ( a) tạo mới thành công', '1620612592', 'N/A');
INSERT INTO `tbl_dangky_note` VALUES ('1696', '1620611787', '', 'Hồ sơ #1620611787 ( a) tạo mới thành công', '1620612859', 'N/A');
INSERT INTO `tbl_dangky_note` VALUES ('1697', '1620613268', '', 'Hồ sơ #1620613268 ( a) tạo mới thành công', '1620613317', 'N/A');
INSERT INTO `tbl_dangky_note` VALUES ('1698', '1620613831', null, 'Hồ sơ #1620613831 ( abc) tạo mới thành công', '1620613868', 'N/A');
INSERT INTO `tbl_dangky_note` VALUES ('1699', '1620614019', null, 'Hồ sơ #1620614019 ( abc) tạo mới thành công', '1620614099', 'N/A');
INSERT INTO `tbl_dangky_note` VALUES ('1700', '1620615331', null, 'Hồ sơ #1620615331 (nguyễn văn a) tạo mới thành công', '1620615364', 'N/A');

-- ----------------------------
-- Table structure for tbl_dangky_tuyensinh
-- ----------------------------
DROP TABLE IF EXISTS `tbl_dangky_tuyensinh`;
CREATE TABLE `tbl_dangky_tuyensinh` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cdate` int(11) DEFAULT NULL,
  `mdate` int(11) DEFAULT NULL,
  `type` tinyint(4) DEFAULT '1' COMMENT '1: Chính quy 2:Chứng chỉ ngắn hạn',
  `id_khoa` varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
  `id_he` varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
  `id_nganh` varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
  `id_hoso` varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
  `masv` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `masv_edu` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `truong_thpt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hetotnghiep` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `diemtongket12` float DEFAULT NULL,
  `xettuyen` tinyint(4) DEFAULT '1' COMMENT '0: thi ; 1: xét tuyển',
  `diadiemhoc` varchar(50) COLLATE utf8_unicode_ci DEFAULT '0' COMMENT '0: Cơ sở 1; 1: cơ sở 2',
  `sbd` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phongthi` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mon1` decimal(10,1) DEFAULT NULL,
  `mon2` decimal(10,1) DEFAULT NULL,
  `mon3` decimal(10,1) DEFAULT NULL,
  `dathi` tinyint(4) DEFAULT '0',
  `trungtuyen` tinyint(4) DEFAULT '-1',
  `baoluu` tinyint(4) DEFAULT '0',
  `nhaphoc` tinyint(4) DEFAULT '0',
  `date_nhaphoc` int(11) DEFAULT NULL,
  `malop` varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
  `nhomkhachhang` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_staff` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngayBG` int(11) DEFAULT NULL,
  `tinhtrangBG` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lydoBG` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hs_tinhtrang` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hs_vo` int(11) DEFAULT NULL,
  `hs_anh` int(11) DEFAULT NULL,
  `hs_bang` int(11) DEFAULT NULL,
  `hs_cn_totnghiep` int(11) DEFAULT NULL,
  `hs_bangdiem` int(11) DEFAULT NULL,
  `hs_hocba` int(11) DEFAULT NULL,
  `hs_pdk` int(11) DEFAULT NULL,
  `hs_giay_ks` int(11) DEFAULT NULL,
  `hs_cmt` int(11) DEFAULT NULL,
  `hs_syll` int(11) DEFAULT NULL,
  `hs_mota` text COLLATE utf8_unicode_ci,
  `dotnhaphoc` int(11) DEFAULT NULL,
  `namnhaphoc` int(11) DEFAULT NULL,
  `kyhoc` int(11) DEFAULT NULL,
  `qd_trungtuyen` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `qd_congnhansv` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tinhtrang_call` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tinhtrang_call_hp` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tinhtrang_sv` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tinhtrang_hocphi` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(4) COLLATE utf8_unicode_ci DEFAULT '',
  `date_level_up` int(11) DEFAULT NULL,
  `last_contact` int(11) DEFAULT NULL,
  `author` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `isactive` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `masv_unique` (`masv`),
  KEY `idx_khoa_he_nganh` (`id_khoa`,`id_he`,`id_nganh`),
  KEY `idx_nhaphoc` (`nhaphoc`),
  KEY `idx_trungquyen` (`trungtuyen`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_dangky_tuyensinh
-- ----------------------------
INSERT INTO `tbl_dangky_tuyensinh` VALUES ('1', '1623983968', null, '1', '', '15', 'NNA', 'KH269642', 'MASV5', null, null, null, null, '1', '0', null, null, null, null, null, '0', '-1', '0', '0', null, 'ML5', '114', 'tranhiep2', '0', '', '', '', '0', '0', '0', '0', '0', '0', '0', '0', null, '0', '', null, '2021', null, null, null, null, null, null, null, '', null, null, null, '1');
INSERT INTO `tbl_dangky_tuyensinh` VALUES ('2', '1623983968', null, '1', '', '18', 'TCNH', 'KH269638', 'MASV10', null, null, null, null, '1', '0', null, null, null, null, null, '0', '-1', '0', '0', null, 'ML10', '114', 'tranhiep2', '0', '', '', '', '0', '0', '0', '0', '0', '0', '0', '0', null, '0', '', null, '2021', null, null, null, null, null, null, null, '', null, null, null, '1');
INSERT INTO `tbl_dangky_tuyensinh` VALUES ('3', '1623983968', null, '1', '', '19', 'NNA', 'KH269637', 'MASV7', null, null, null, null, '1', '0', null, null, null, null, null, '0', '-1', '0', '0', null, 'ML7', '114', 'tranhiep2', '0', '', '', '', '0', '0', '0', '0', '0', '0', '0', '0', null, '0', '', null, '2021', null, null, null, null, null, null, null, '', null, null, null, '1');
INSERT INTO `tbl_dangky_tuyensinh` VALUES ('4', '1623983968', null, '1', '', '21', '114', 'KH269639', 'MASV8', null, null, null, null, '1', '0', null, null, null, null, null, '0', '-1', '0', '0', null, 'ML8', '114', 'tranhiep3', '0', '', '', '', '0', '0', '0', '0', '0', '0', '0', '0', null, '0', '', null, '2021', null, null, null, null, null, null, null, '', null, null, null, '1');
INSERT INTO `tbl_dangky_tuyensinh` VALUES ('5', '1623983968', null, '1', '', '14', '122', 'KH269636', 'MASV9', null, null, null, null, '1', '0', null, null, null, null, null, '0', '-1', '0', '0', null, 'ML9', '114', 'tranhiep3', '0', '', '', '', '0', '0', '0', '0', '0', '0', '0', '0', null, '0', '', null, '2021', null, null, null, null, null, null, null, '', null, null, null, '1');
INSERT INTO `tbl_dangky_tuyensinh` VALUES ('6', '1623983968', null, '1', '', '12', '116', 'KH269643', 'MASV4', null, null, null, null, '1', '0', null, null, null, null, null, '0', '-1', '0', '0', null, 'ML4', '114', 'tranhiep3', '0', '', '', '', '0', '0', '0', '0', '0', '0', '0', '0', null, '0', '', null, '2021', null, null, null, null, null, null, null, '', null, null, null, '1');
INSERT INTO `tbl_dangky_tuyensinh` VALUES ('7', '1623983968', null, '1', '', '21', 'NNA', 'KH269645', 'MASV1', null, null, null, null, '1', '0', null, null, null, null, null, '0', '-1', '0', '0', null, 'ML1', '114', 'tranhiep3', '0', '', '', '', '0', '0', '0', '0', '0', '0', '0', '0', null, '0', '', null, '2021', null, null, null, null, null, null, null, '', null, null, null, '1');
INSERT INTO `tbl_dangky_tuyensinh` VALUES ('8', '1623983968', null, '1', '', '19', '116', 'KH269641', 'MASV6', null, null, null, null, '1', '0', null, null, null, null, null, '0', '-1', '0', '0', null, 'ML6', '114', 'tranhiep3', '0', '', '', '', '0', '0', '0', '0', '0', '0', '0', '0', null, '0', '', null, '2021', null, null, null, null, null, null, null, '', null, null, null, '1');

-- ----------------------------
-- Table structure for tbl_dmhocphi
-- ----------------------------
DROP TABLE IF EXISTS `tbl_dmhocphi`;
CREATE TABLE `tbl_dmhocphi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_he` varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
  `id_nganh` varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hocphi` int(11) DEFAULT NULL,
  `intro` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `all` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_he_nganh` (`id_he`,`id_nganh`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=221 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_dmhocphi
-- ----------------------------
INSERT INTO `tbl_dmhocphi` VALUES ('218', null, null, 'Lệ phí xét tuyển, nhập học', '300000', null, '1');
INSERT INTO `tbl_dmhocphi` VALUES ('219', null, null, 'Đào tạo nhập môn E-learning', '1200000', null, '1');
INSERT INTO `tbl_dmhocphi` VALUES ('220', null, null, 'Thẻ sinh viên', '50000', null, '1');

-- ----------------------------
-- Table structure for tbl_dmhoso
-- ----------------------------
DROP TABLE IF EXISTS `tbl_dmhoso`;
CREATE TABLE `tbl_dmhoso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_he` varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `intro` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `all` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_dmhoso
-- ----------------------------
INSERT INTO `tbl_dmhoso` VALUES ('78', null, 'Phiếu xét tuyển', null, '1');
INSERT INTO `tbl_dmhoso` VALUES ('79', null, 'Bằng tốt nghiệp', null, '1');
INSERT INTO `tbl_dmhoso` VALUES ('80', null, 'Bảng điểm', null, '1');
INSERT INTO `tbl_dmhoso` VALUES ('81', null, 'Chứng minh thư', null, '1');
INSERT INTO `tbl_dmhoso` VALUES ('82', 'AUM', '2 Ảnh 3x4', null, '1');

-- ----------------------------
-- Table structure for tbl_giaovien
-- ----------------------------
DROP TABLE IF EXISTS `tbl_giaovien`;
CREATE TABLE `tbl_giaovien` (
  `id` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tenVT` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_khoa` varchar(50) COLLATE utf8_unicode_ci DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_giaovien
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_he
-- ----------------------------
DROP TABLE IF EXISTS `tbl_he`;
CREATE TABLE `tbl_he` (
  `id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `par_id` int(10) DEFAULT '1',
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hocphi` int(11) DEFAULT NULL,
  `hocphi_thilai` int(11) DEFAULT NULL,
  `hocphi_thict` int(11) DEFAULT NULL,
  `hocphi_hoclai` int(11) DEFAULT NULL,
  `hocphi_hocct` int(11) DEFAULT NULL,
  `sohocky` int(11) DEFAULT NULL,
  `isactive` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_he
-- ----------------------------
INSERT INTO `tbl_he` VALUES ('AUM', '1', 'AUM DH', '260000', '100000', '100000', '260000', '260000', '8', '1');

-- ----------------------------
-- Table structure for tbl_hocphan_khung
-- ----------------------------
DROP TABLE IF EXISTS `tbl_hocphan_khung`;
CREATE TABLE `tbl_hocphan_khung` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_khoa` varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
  `id_nganh` varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
  `id_he` varchar(50) COLLATE utf8_unicode_ci DEFAULT '0',
  `id_monhoc` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hocky` int(11) DEFAULT NULL,
  `slot` int(11) DEFAULT NULL,
  `tinchi` int(11) DEFAULT NULL,
  `lotrinh` longtext COLLATE utf8_unicode_ci,
  `diem_chuyencan` decimal(11,2) DEFAULT NULL,
  `diem_kiemtra` decimal(11,2) DEFAULT NULL,
  `diem_thi` decimal(11,2) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_khoa_he_nganh` (`id_khoa`,`id_nganh`,`id_he`,`id_monhoc`)
) ENGINE=InnoDB AUTO_INCREMENT=778 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_hocphan_khung
-- ----------------------------
INSERT INTO `tbl_hocphan_khung` VALUES ('599', null, '111', 'AUM', 'MC01', null, null, null, '3', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('600', null, '111', 'AUM', 'MC02', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('601', null, '111', 'AUM', 'MC03', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('602', null, '111', 'AUM', 'MC04', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('603', null, '111', 'AUM', 'MC05', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('604', null, '111', 'AUM', 'MC06', null, null, null, '3', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('605', null, '111', 'AUM', 'MC07', null, null, null, '3', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('606', null, '111', 'AUM', 'MC08', null, null, null, '3', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('607', null, '111', 'AUM', 'MC09', null, null, null, '3', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('608', null, '111', 'AUM', 'MC10', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('609', null, '111', 'AUM', 'MC11', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('610', null, '111', 'AUM', 'MC12', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('612', null, '111', 'AUM', 'MC20', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('613', null, '111', 'AUM', 'QTKD01', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('614', null, '111', 'AUM', 'QTKD02', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('615', null, '111', 'AUM', 'MC14', null, null, null, '3', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('616', null, '111', 'AUM', 'MC15', null, null, null, '3', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('617', null, '111', 'AUM', 'QTKD03', null, null, null, '3', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('618', null, '111', 'AUM', 'QTKD04', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('619', null, '111', 'AUM', 'MC21', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('620', null, '111', 'AUM', 'MC16', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('621', null, '111', 'AUM', 'QTKD05', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('622', null, '111', 'AUM', 'QTKD06', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('623', null, '111', 'AUM', 'QTKD07', null, null, null, '3', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('624', null, '111', 'AUM', 'QTKD08', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('625', null, '111', 'AUM', 'QTKD09', null, null, null, '3', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('626', null, '111', 'AUM', 'QTKD10', null, null, null, '3', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('627', null, '111', 'AUM', 'QTKD11', null, null, null, '3', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('628', null, '111', 'AUM', 'QTKD12', null, null, null, '3', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('629', null, '111', 'AUM', 'QTKD13', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('630', null, '111', 'AUM', 'QTKD14', null, null, null, '3', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('631', null, '111', 'AUM', 'QTKD15', null, null, null, '3', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('632', null, '111', 'AUM', 'QTKD16', null, null, null, '3', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('633', null, '111', 'AUM', 'QTKD17', null, null, null, '3', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('634', null, '111', 'AUM', 'QTKD18', null, null, null, '3', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('635', null, '111', 'AUM', 'QTKD19', null, null, null, '3', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('636', null, '111', 'AUM', 'QTKD20', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('637', null, '111', 'AUM', 'QTKD21', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('638', null, '111', 'AUM', 'QTKD22', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('639', null, '111', 'AUM', 'QTKD23', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('640', null, '111', 'AUM', 'QTKD24', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('641', null, '111', 'AUM', 'QTKD25', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('642', null, '111', 'AUM', 'QTKD26', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('643', null, '111', 'AUM', 'QTKD27', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('644', null, '116', 'AUM', 'MC01', null, null, null, '3', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('645', null, '116', 'AUM', 'MC02', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('646', null, '116', 'AUM', 'MC03', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('647', null, '116', 'AUM', 'MC04', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('648', null, '116', 'AUM', 'MC05', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('649', null, '116', 'AUM', 'MC06', null, null, null, '3', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('650', null, '116', 'AUM', 'MC07', null, null, null, '3', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('651', null, '116', 'AUM', 'MC08', null, null, null, '3', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('652', null, '116', 'AUM', 'MC09', null, null, null, '3', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('653', null, '116', 'AUM', 'MC10', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('654', null, '116', 'AUM', 'LKT01', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('655', null, '116', 'AUM', 'MC11', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('656', null, '116', 'AUM', 'MC12', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('657', null, '116', 'AUM', 'MC13', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('658', null, '116', 'AUM', 'MC14', null, null, null, '3', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('659', null, '116', 'AUM', 'MC15', null, null, null, '3', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('660', null, '116', 'AUM', 'MC16', null, null, null, '3', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('661', null, '116', 'AUM', 'MC18', null, null, null, '3', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('662', null, '116', 'AUM', 'MC19', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('663', null, '116', 'AUM', 'LKT02', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('664', null, '116', 'AUM', 'LKT03', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('665', null, '116', 'AUM', 'LKT04', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('666', null, '116', 'AUM', 'LKT05', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('667', null, '116', 'AUM', 'LKT06', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('668', null, '116', 'AUM', 'LKT07', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('669', null, '116', 'AUM', 'LKT08', null, null, null, '3', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('670', null, '116', 'AUM', 'LKT09', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('671', null, '116', 'AUM', 'LKT10', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('672', null, '116', 'AUM', 'LKT11', null, null, null, '3', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('673', null, '116', 'AUM', 'LKT12', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('674', null, '116', 'AUM', 'LKT13', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('675', null, '116', 'AUM', 'LKT14', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('676', null, '116', 'AUM', 'LKT15', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('677', null, '116', 'AUM', 'LKT16', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('678', null, '116', 'AUM', 'LKT17', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('679', null, '116', 'AUM', 'LKT18', null, null, null, '3', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('680', null, '116', 'AUM', 'LKT19', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('681', null, '116', 'AUM', 'LKT20', null, null, null, '3', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('682', null, '116', 'AUM', 'LKT21', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('683', null, '116', 'AUM', 'LKT22', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('684', null, '116', 'AUM', 'LKT23', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('685', null, '116', 'AUM', 'LKT24', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('686', null, '116', 'AUM', 'LKT25', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('687', null, '116', 'AUM', 'LKT26', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('688', null, '116', 'AUM', 'LKT27', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('689', null, '116', 'AUM', 'LKT28', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('690', null, '116', 'AUM', 'LKT29', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('691', null, '116', 'AUM', 'LKT30', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('692', null, '116', 'AUM', 'LKT31', null, null, null, '4', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('693', null, '116', 'AUM', 'MC17', null, null, null, '3', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('695', null, '122', 'AUM', 'MC01', null, null, null, '3', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('707', null, '122', 'AUM', 'MC02', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('708', null, '122', 'AUM', 'MC03', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('709', null, '122', 'AUM', 'MC04', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('710', null, '122', 'AUM', 'MC05', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('711', null, '122', 'AUM', 'MC06', null, null, null, '3', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('712', null, '122', 'AUM', 'MC07', null, null, null, '3', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('713', null, '122', 'AUM', 'MC08', null, null, null, '3', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('714', null, '122', 'AUM', 'MC09', null, null, null, '3', null, '20.00', '30.00', '50.00', '4.00');
INSERT INTO `tbl_hocphan_khung` VALUES ('715', null, '122', 'AUM', 'MC10', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.00');
INSERT INTO `tbl_hocphan_khung` VALUES ('716', null, '122', 'AUM', 'QLNN01', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('717', null, '122', 'AUM', 'QLNN02', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('718', null, '122', 'AUM', 'QLNN03', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('719', null, '122', 'AUM', 'MC14', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('720', null, '122', 'AUM', 'MC15', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('721', null, '122', 'AUM', 'MC13', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('722', null, '122', 'AUM', 'QLNN04', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('723', null, '122', 'AUM', 'MC11', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('724', null, '122', 'AUM', 'QLNN05', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('725', null, '122', 'AUM', 'QLNN06', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('726', null, '122', 'AUM', 'MC17', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('727', null, '122', 'AUM', 'MC18', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('728', null, '122', 'AUM', 'MC19', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('729', null, '122', 'AUM', 'QLNN07', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('730', null, '122', 'AUM', 'QLNN08', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('731', null, '122', 'AUM', 'MC21', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('732', null, '122', 'AUM', 'QLNN09', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('733', null, '122', 'AUM', 'QLNN10', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('734', null, '122', 'AUM', 'QLNN11', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('735', null, '122', 'AUM', 'QLNN19', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('736', null, '122', 'AUM', 'QLNN12', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('737', null, '122', 'AUM', 'QLNN13', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('738', null, '122', 'AUM', 'QLNN14', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('739', null, '122', 'AUM', 'QLNN15', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('740', null, '122', 'AUM', 'QLNN16', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('741', null, '122', 'AUM', 'QLNN17', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('742', null, '122', 'AUM', 'QLNN18', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('743', null, '122', 'AUM', 'QLNN20', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('744', null, '122', 'AUM', 'QLNN21', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('745', null, '122', 'AUM', 'MC20', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('746', null, '122', 'AUM', 'QLNN22', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('747', null, '122', 'AUM', 'QLNN23', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('748', null, '122', 'AUM', 'QLNN24', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('749', null, '122', 'AUM', 'QLNN25', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('750', null, '122', 'AUM', 'QLNN26', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('751', null, '122', 'AUM', 'QLNN27', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('752', null, '122', 'AUM', 'QLNN28', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('753', null, '122', 'AUM', 'QLNN29', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('754', null, '122', 'AUM', 'QLNN30', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('755', null, '122', 'AUM', 'QLNN31', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('756', null, '122', 'AUM', 'QLNN32', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('757', null, '122', 'AUM', 'QLNN33', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('758', null, '122', 'AUM', 'QLNN34', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('759', null, '122', 'AUM', 'QLNN35', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('760', null, '122', 'AUM', 'QLNN36', null, null, null, '2', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('761', null, '122', 'AUM', 'QLNN37', null, null, null, '6', null, '20.00', '30.00', '50.00', '4.50');
INSERT INTO `tbl_hocphan_khung` VALUES ('763', '', '111', 'AUM', '1000001', null, '0', '0', '3', '[{\"tuan\":\"1\",\"noidung\":\"H\\u01b0\\u1edbng d\\u1eabn nh\\u1eadp m\\u00f4n\"},{\"tuan\":\"2\",\"noidung\":\"H\\u01b0\\u1edbng d\\u1eabn nh\\u1eadp m\\u00f4n\"}]', '20.00', '30.00', '50.00', '4.00');
INSERT INTO `tbl_hocphan_khung` VALUES ('764', '', '111', 'AUM', 'LKT01', null, null, null, '4', null, '20.00', '30.00', '50.00', '4.00');
INSERT INTO `tbl_hocphan_khung` VALUES ('777', '', '111', 'AUM', 'LKT06', null, '3', '3', '3', '[{\"tuan\":\"1\",\"noidung\":\"H\\u01b0\\u1edbng d\\u1eabn nh\\u1eadp m\\u00f4n\"},{\"tuan\":\"2\",\"noidung\":\"H\\u01b0\\u1edbng d\\u1eabn nh\\u1eadp m\\u00f4n\"},{\"tuan\":\"3\",\"noidung\":\"H\\u01b0\\u1edbng d\\u1eabn nh\\u1eadp m\\u00f4n\"}]', '20.00', '30.00', '50.00', '4.00');

-- ----------------------------
-- Table structure for tbl_hocphi
-- ----------------------------
DROP TABLE IF EXISTS `tbl_hocphi`;
CREATE TABLE `tbl_hocphi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `masv` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ma_truong` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `masv_edu` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ma_lop` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ma_hp` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ten_hp` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slot` int(11) DEFAULT NULL,
  `hocky` int(11) DEFAULT NULL,
  `hocphi` float DEFAULT NULL,
  `dadong` float DEFAULT NULL,
  `conlai` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=139 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_hocphi
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_hocphi_detail
-- ----------------------------
DROP TABLE IF EXISTS `tbl_hocphi_detail`;
CREATE TABLE `tbl_hocphi_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_order` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `masv` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `masv_edu` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ma_he` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ma_nganh` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ma_lop` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hocky` int(11) DEFAULT NULL,
  `slot` int(11) DEFAULT NULL,
  `hocphi` float DEFAULT NULL,
  `dadong` float DEFAULT NULL,
  `conlai` float DEFAULT NULL,
  `flag` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6551 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_hocphi_detail
-- ----------------------------
INSERT INTO `tbl_hocphi_detail` VALUES ('5072', null, '20AUM114271', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5073', null, '20AUM114272', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5074', null, '20AUM114273', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5075', null, '20AUM114274', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5076', null, '20AUM114275', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5077', null, '20AUM114276', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5078', null, '20AUM114277', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5079', null, '20AUM114278', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5080', null, '20AUM114279', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5081', null, '20AUM114280', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5082', null, '20AUM114281', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5083', null, '20AUM114282', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5084', null, '20AUM114283', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5085', null, '20AUM114284', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5086', null, '20AUM114285', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5087', null, '20AUM114286', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5088', null, '20AUM114271', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5089', null, '20AUM114272', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5090', null, '20AUM114273', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5091', null, '20AUM114274', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5092', null, '20AUM114275', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5093', null, '20AUM114276', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5094', null, '20AUM114277', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5095', null, '20AUM114278', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5096', null, '20AUM114279', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5097', null, '20AUM114280', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5098', null, '20AUM114281', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5099', null, '20AUM114282', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5100', null, '20AUM114283', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5101', null, '20AUM114284', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5102', null, '20AUM114285', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5103', null, '20AUM114286', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5104', null, '20AUM114271', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5105', null, '20AUM114272', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5106', null, '20AUM114273', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5107', null, '20AUM114274', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5108', null, '20AUM114275', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5109', null, '20AUM114276', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5110', null, '20AUM114277', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5111', null, '20AUM114278', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5112', null, '20AUM114279', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5113', null, '20AUM114280', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5114', null, '20AUM114281', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5115', null, '20AUM114282', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5116', null, '20AUM114283', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5117', null, '20AUM114284', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5118', null, '20AUM114285', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5119', null, '20AUM114286', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5120', null, '20AUM114271', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5121', null, '20AUM114272', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5122', null, '20AUM114273', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5123', null, '20AUM114274', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5124', null, '20AUM114275', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5125', null, '20AUM114276', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5126', null, '20AUM114277', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5127', null, '20AUM114278', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5128', null, '20AUM114279', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5129', null, '20AUM114280', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5130', null, '20AUM114281', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5131', null, '20AUM114282', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5132', null, '20AUM114283', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5133', null, '20AUM114284', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5134', null, '20AUM114285', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5135', null, '20AUM114286', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5136', null, '20AUM114271', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5137', null, '20AUM114272', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5138', null, '20AUM114273', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5139', null, '20AUM114274', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5140', null, '20AUM114275', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5141', null, '20AUM114276', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5142', null, '20AUM114277', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5143', null, '20AUM114278', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5144', null, '20AUM114279', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5145', null, '20AUM114280', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5146', null, '20AUM114281', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5147', null, '20AUM114282', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5148', null, '20AUM114283', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5149', null, '20AUM114284', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5150', null, '20AUM114285', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5151', null, '20AUM114286', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5152', null, '20AUM114271', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5153', null, '20AUM114272', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5154', null, '20AUM114273', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5155', null, '20AUM114274', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5156', null, '20AUM114275', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5157', null, '20AUM114276', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5158', null, '20AUM114277', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5159', null, '20AUM114278', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5160', null, '20AUM114279', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5161', null, '20AUM114280', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5162', null, '20AUM114281', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5163', null, '20AUM114282', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5164', null, '20AUM114283', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5165', null, '20AUM114284', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5166', null, '20AUM114285', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5167', null, '20AUM114286', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5168', null, '20AUM114271', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5169', null, '20AUM114271', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5170', null, '20AUM114271', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5171', null, '20AUM114274', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5172', null, '20AUM114274', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5173', null, '20AUM114274', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5174', null, '20AUM114279', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5175', null, '20AUM114279', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5176', null, '20AUM114279', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5177', null, '20AUM114278', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5178', null, '20AUM114278', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5179', null, '20AUM114278', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5180', null, '20AUM114277', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5181', null, '20AUM114277', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5182', null, '20AUM114277', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5183', null, '20AUM114276', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5184', null, '20AUM114276', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5185', null, '20AUM114276', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5186', null, '20AUM114275', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5187', null, '20AUM114275', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5188', null, '20AUM114275', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5189', null, '20AUM114284', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5190', null, '20AUM114284', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5191', null, '20AUM114284', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5192', null, '20AUM114283', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5193', null, '20AUM114283', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5194', null, '20AUM114283', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5195', null, '20AUM114282', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5196', null, '20AUM114282', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5197', null, '20AUM114282', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5198', null, '20AUM114281', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5199', null, '20AUM114281', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5200', null, '20AUM114281', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5201', null, '20AUM114280', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5202', null, '20AUM114280', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5203', null, '20AUM114280', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5204', null, '20AUM114286', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5205', null, '20AUM114286', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5206', null, '20AUM114286', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5207', null, '20AUM114285', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5208', null, '20AUM114285', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5209', null, '20AUM114285', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5210', null, '20AUM114273', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5211', null, '20AUM114273', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5212', null, '20AUM114273', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5213', null, '20AUM114272', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5214', null, '20AUM114272', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5215', null, '20AUM114272', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5216', null, '20AUM116287', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5217', null, '20AUM116287', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5218', null, '20AUM116287', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5219', null, '20AUM116288', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5220', null, '20AUM116288', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5221', null, '20AUM116288', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5222', null, '20AUM116289', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5223', null, '20AUM116289', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5224', null, '20AUM116289', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5225', null, '20AUM116290', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5226', null, '20AUM116290', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5227', null, '20AUM116290', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5228', null, '20AUM116291', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5229', null, '20AUM116291', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5230', null, '20AUM116291', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5231', null, '20AUM116292', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5232', null, '20AUM116292', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5233', null, '20AUM116292', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5234', null, '20AUM116293', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5235', null, '20AUM116293', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5236', null, '20AUM116293', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5237', null, '20AUM116294', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5238', null, '20AUM116294', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5239', null, '20AUM116294', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5240', null, '20AUM116295', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5241', null, '20AUM116295', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5242', null, '20AUM116295', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5243', null, '20AUM116310', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5244', null, '20AUM116310', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5245', null, '20AUM116310', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5246', null, '20AUM116296', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5247', null, '20AUM116296', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5248', null, '20AUM116296', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5249', null, '20AUM116297', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5250', null, '20AUM116297', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5251', null, '20AUM116297', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5252', null, '20AUM116298', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5253', null, '20AUM116298', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5254', null, '20AUM116298', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5255', null, '20AUM116299', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5256', null, '20AUM116299', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5257', null, '20AUM116299', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5258', null, '20AUM116300', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5259', null, '20AUM116300', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5260', null, '20AUM116300', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5261', null, '20AUM116301', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5262', null, '20AUM116301', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5263', null, '20AUM116301', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5264', null, '20AUM116302', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5265', null, '20AUM116302', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5266', null, '20AUM116302', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5267', null, '20AUM116303', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5268', null, '20AUM116303', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5269', null, '20AUM116303', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5270', null, '20AUM116304', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5271', null, '20AUM116304', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5272', null, '20AUM116304', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5273', null, '20AUM116305', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5274', null, '20AUM116305', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5275', null, '20AUM116305', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5276', null, '20AUM116306', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5277', null, '20AUM116306', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5278', null, '20AUM116306', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5279', null, '20AUM116307', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5280', null, '20AUM116307', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5281', null, '20AUM116307', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5282', null, '20AUM116308', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5283', null, '20AUM116308', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5284', null, '20AUM116308', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5285', null, '20AUM116309', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5286', null, '20AUM116309', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5287', null, '20AUM116309', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5288', null, '20AUM116287', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5289', null, '20AUM116288', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5290', null, '20AUM116289', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5291', null, '20AUM116290', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5292', null, '20AUM116291', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5293', null, '20AUM116292', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5294', null, '20AUM116293', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5295', null, '20AUM116294', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5296', null, '20AUM116295', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5297', null, '20AUM116296', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5298', null, '20AUM116297', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5299', null, '20AUM116298', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5300', null, '20AUM116299', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5301', null, '20AUM116300', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5302', null, '20AUM116301', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5303', null, '20AUM116302', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5304', null, '20AUM116303', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5305', null, '20AUM116304', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5306', null, '20AUM116305', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5307', null, '20AUM116306', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5308', null, '20AUM116307', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5309', null, '20AUM116308', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5310', null, '20AUM116309', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5311', null, '20AUM116310', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5312', null, '20AUM116287', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5313', null, '20AUM116288', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5314', null, '20AUM116289', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5315', null, '20AUM116290', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5316', null, '20AUM116291', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5317', null, '20AUM116292', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5318', null, '20AUM116293', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5319', null, '20AUM116294', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5320', null, '20AUM116295', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5321', null, '20AUM116296', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5322', null, '20AUM116297', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5323', null, '20AUM116298', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5324', null, '20AUM116299', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5325', null, '20AUM116300', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5326', null, '20AUM116301', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5327', null, '20AUM116302', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5328', null, '20AUM116303', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5329', null, '20AUM116304', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5330', null, '20AUM116305', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5331', null, '20AUM116306', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5332', null, '20AUM116307', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5333', null, '20AUM116308', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5334', null, '20AUM116309', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5335', null, '20AUM116310', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5336', null, '20AUM116287', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5337', null, '20AUM116288', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5338', null, '20AUM116289', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5339', null, '20AUM116290', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5340', null, '20AUM116291', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5341', null, '20AUM116292', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5342', null, '20AUM116293', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5343', null, '20AUM116294', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5344', null, '20AUM116295', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5345', null, '20AUM116296', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5346', null, '20AUM116297', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5347', null, '20AUM116298', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5348', null, '20AUM116299', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5349', null, '20AUM116300', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5350', null, '20AUM116301', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5351', null, '20AUM116302', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5352', null, '20AUM116303', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5353', null, '20AUM116304', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5354', null, '20AUM116305', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5355', null, '20AUM116306', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5356', null, '20AUM116307', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5357', null, '20AUM116308', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5358', null, '20AUM116309', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5359', null, '20AUM116310', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5360', null, '20AUM116287', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5361', null, '20AUM116288', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5362', null, '20AUM116289', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5363', null, '20AUM116290', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5364', null, '20AUM116291', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5365', null, '20AUM116292', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5366', null, '20AUM116293', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5367', null, '20AUM116294', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5368', null, '20AUM116295', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5369', null, '20AUM116296', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5370', null, '20AUM116297', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5371', null, '20AUM116298', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5372', null, '20AUM116299', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5373', null, '20AUM116300', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5374', null, '20AUM116301', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5375', null, '20AUM116302', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5376', null, '20AUM116303', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5377', null, '20AUM116304', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5378', null, '20AUM116305', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5379', null, '20AUM116306', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5380', null, '20AUM116307', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5381', null, '20AUM116308', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5382', null, '20AUM116309', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5383', null, '20AUM116310', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5384', null, '20AUM116287', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5385', null, '20AUM116288', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5386', null, '20AUM116289', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5387', null, '20AUM116290', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5388', null, '20AUM116291', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5389', null, '20AUM116292', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5390', null, '20AUM116293', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5391', null, '20AUM116294', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5392', null, '20AUM116295', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5393', null, '20AUM116296', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5394', null, '20AUM116297', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5395', null, '20AUM116298', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5396', null, '20AUM116299', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5397', null, '20AUM116300', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5398', null, '20AUM116301', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5399', null, '20AUM116302', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5400', null, '20AUM116303', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5401', null, '20AUM116304', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5402', null, '20AUM116305', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5403', null, '20AUM116306', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5404', null, '20AUM116307', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5405', null, '20AUM116308', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5406', null, '20AUM116309', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5407', null, '20AUM116310', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5408', null, '20AUM116287', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5409', null, '20AUM116288', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5410', null, '20AUM116289', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5411', null, '20AUM116290', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5412', null, '20AUM116291', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5413', null, '20AUM116292', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5414', null, '20AUM116293', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5415', null, '20AUM116294', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5416', null, '20AUM116295', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5417', null, '20AUM116296', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5418', null, '20AUM116297', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5419', null, '20AUM116298', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5420', null, '20AUM116299', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5421', null, '20AUM116300', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5422', null, '20AUM116301', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5423', null, '20AUM116302', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5424', null, '20AUM116303', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5425', null, '20AUM116304', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5426', null, '20AUM116305', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5427', null, '20AUM116306', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5428', null, '20AUM116307', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5429', null, '20AUM116308', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5430', null, '20AUM116309', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5431', null, '20AUM116310', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5432', null, '20AUM116287', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5433', null, '20AUM116288', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5434', null, '20AUM116289', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5435', null, '20AUM116290', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5436', null, '20AUM116291', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5437', null, '20AUM116292', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5438', null, '20AUM116293', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5439', null, '20AUM116294', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5440', null, '20AUM116295', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5441', null, '20AUM116296', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5442', null, '20AUM116297', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5443', null, '20AUM116298', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5444', null, '20AUM116299', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5445', null, '20AUM116300', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5446', null, '20AUM116301', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5447', null, '20AUM116302', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5448', null, '20AUM116303', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5449', null, '20AUM116304', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5450', null, '20AUM116305', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5451', null, '20AUM116306', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5452', null, '20AUM116307', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5453', null, '20AUM116308', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5454', null, '20AUM116309', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5455', null, '20AUM116310', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5456', null, '20AUM122311', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5457', null, '20AUM122311', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5458', null, '20AUM122311', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5459', null, '20AUM122312', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5460', null, '20AUM122312', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5461', null, '20AUM122312', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5462', null, '20AUM122313', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5463', null, '20AUM122313', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5464', null, '20AUM122313', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5465', null, '20AUM122314', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5466', null, '20AUM122314', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5467', null, '20AUM122314', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5468', null, '20AUM122315', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5469', null, '20AUM122315', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5470', null, '20AUM122315', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5471', null, '20AUM122316', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5472', null, '20AUM122316', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5473', null, '20AUM122316', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5474', null, '20AUM122319', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5475', null, '20AUM122319', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5476', null, '20AUM122319', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5477', null, '20AUM122318', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5478', null, '20AUM122318', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5479', null, '20AUM122318', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5480', null, '20AUM122335', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5481', null, '20AUM122335', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5482', null, '20AUM122335', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5483', null, '20AUM122326', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5484', null, '20AUM122326', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5485', null, '20AUM122326', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5486', null, '20AUM122325', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5487', null, '20AUM122325', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5488', null, '20AUM122325', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5489', null, '20AUM122324', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5490', null, '20AUM122324', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5491', null, '20AUM122324', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5492', null, '20AUM122334', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5493', null, '20AUM122334', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5494', null, '20AUM122334', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5495', null, '20AUM122322', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5496', null, '20AUM122322', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5497', null, '20AUM122322', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5498', null, '20AUM122321', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5499', null, '20AUM122321', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5500', null, '20AUM122321', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5501', null, '20AUM122320', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5502', null, '20AUM122320', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5503', null, '20AUM122320', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5504', null, '20AUM122317', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5505', null, '20AUM122317', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5506', null, '20AUM122317', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5507', null, '20AUM122341', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5508', null, '20AUM122341', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5509', null, '20AUM122341', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5510', null, '20AUM122333', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5511', null, '20AUM122333', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5512', null, '20AUM122333', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5513', null, '20AUM122332', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5514', null, '20AUM122332', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5515', null, '20AUM122332', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5516', null, '20AUM122331', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5517', null, '20AUM122331', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5518', null, '20AUM122331', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5519', null, '20AUM122330', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5520', null, '20AUM122330', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5521', null, '20AUM122330', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5522', null, '20AUM122329', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5523', null, '20AUM122329', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5524', null, '20AUM122329', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5525', null, '20AUM122328', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5526', null, '20AUM122328', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5527', null, '20AUM122328', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5528', null, '20AUM122327', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5529', null, '20AUM122327', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5530', null, '20AUM122327', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5531', null, '20AUM122323', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5532', null, '20AUM122323', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5533', null, '20AUM122323', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5534', null, '20AUM122340', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5535', null, '20AUM122340', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5536', null, '20AUM122340', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5537', null, '20AUM122339', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5538', null, '20AUM122339', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5539', null, '20AUM122339', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5540', null, '20AUM122338', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5541', null, '20AUM122338', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5542', null, '20AUM122338', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5543', null, '20AUM122337', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5544', null, '20AUM122337', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5545', null, '20AUM122337', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5546', null, '20AUM122336', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5547', null, '20AUM122336', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5548', null, '20AUM122336', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5549', null, '20AUM122342', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5550', null, '20AUM122342', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5551', null, '20AUM122342', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5552', null, '20AUM122311', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5553', null, '20AUM122312', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5554', null, '20AUM122313', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5555', null, '20AUM122314', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5556', null, '20AUM122315', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5557', null, '20AUM122316', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5558', null, '20AUM122317', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5559', null, '20AUM122318', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5560', null, '20AUM122319', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5561', null, '20AUM122320', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5562', null, '20AUM122321', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5563', null, '20AUM122322', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5564', null, '20AUM122323', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5565', null, '20AUM122324', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5566', null, '20AUM122325', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5567', null, '20AUM122326', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5568', null, '20AUM122327', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5569', null, '20AUM122328', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5570', null, '20AUM122329', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5571', null, '20AUM122330', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5572', null, '20AUM122331', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5573', null, '20AUM122332', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5574', null, '20AUM122333', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5575', null, '20AUM122334', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5576', null, '20AUM122335', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5577', null, '20AUM122336', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5578', null, '20AUM122337', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5579', null, '20AUM122338', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5580', null, '20AUM122339', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5581', null, '20AUM122340', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5582', null, '20AUM122341', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5583', null, '20AUM122342', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5584', null, '20AUM122311', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5585', null, '20AUM122312', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5586', null, '20AUM122313', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5587', null, '20AUM122314', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5588', null, '20AUM122315', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5589', null, '20AUM122316', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5590', null, '20AUM122317', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5591', null, '20AUM122318', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5592', null, '20AUM122319', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5593', null, '20AUM122320', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5594', null, '20AUM122321', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5595', null, '20AUM122322', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5596', null, '20AUM122323', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5597', null, '20AUM122324', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5598', null, '20AUM122325', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5599', null, '20AUM122326', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5600', null, '20AUM122327', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5601', null, '20AUM122328', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5602', null, '20AUM122329', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5603', null, '20AUM122330', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5604', null, '20AUM122331', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5605', null, '20AUM122332', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5606', null, '20AUM122333', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5607', null, '20AUM122334', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5608', null, '20AUM122335', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5609', null, '20AUM122336', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5610', null, '20AUM122337', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5611', null, '20AUM122338', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5612', null, '20AUM122339', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5613', null, '20AUM122340', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5614', null, '20AUM122341', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5615', null, '20AUM122342', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5616', null, '20AUM122311', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5617', null, '20AUM122312', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5618', null, '20AUM122313', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5619', null, '20AUM122314', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5620', null, '20AUM122315', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5621', null, '20AUM122316', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5622', null, '20AUM122317', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5623', null, '20AUM122318', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5624', null, '20AUM122319', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5625', null, '20AUM122320', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5626', null, '20AUM122321', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5627', null, '20AUM122322', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5628', null, '20AUM122323', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5629', null, '20AUM122324', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5630', null, '20AUM122325', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5631', null, '20AUM122326', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5632', null, '20AUM122327', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5633', null, '20AUM122328', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5634', null, '20AUM122329', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5635', null, '20AUM122330', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5636', null, '20AUM122331', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5637', null, '20AUM122332', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5638', null, '20AUM122333', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5639', null, '20AUM122334', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5640', null, '20AUM122335', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5641', null, '20AUM122336', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5642', null, '20AUM122337', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5643', null, '20AUM122338', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5644', null, '20AUM122339', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5645', null, '20AUM122340', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5646', null, '20AUM122341', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5647', null, '20AUM122342', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5648', null, '20AUM122311', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5649', null, '20AUM122312', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5650', null, '20AUM122313', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5651', null, '20AUM122314', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5652', null, '20AUM122315', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5653', null, '20AUM122316', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5654', null, '20AUM122317', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5655', null, '20AUM122318', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5656', null, '20AUM122319', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5657', null, '20AUM122320', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5658', null, '20AUM122321', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5659', null, '20AUM122322', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5660', null, '20AUM122323', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5661', null, '20AUM122324', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5662', null, '20AUM122325', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5663', null, '20AUM122326', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5664', null, '20AUM122327', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5665', null, '20AUM122328', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5666', null, '20AUM122329', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5667', null, '20AUM122330', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5668', null, '20AUM122331', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5669', null, '20AUM122332', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5670', null, '20AUM122333', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5671', null, '20AUM122334', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5672', null, '20AUM122335', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5673', null, '20AUM122336', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5674', null, '20AUM122337', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5675', null, '20AUM122338', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5676', null, '20AUM122339', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5677', null, '20AUM122340', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5678', null, '20AUM122341', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5679', null, '20AUM122342', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5680', null, '20AUM122311', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5681', null, '20AUM122312', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5682', null, '20AUM122313', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5683', null, '20AUM122314', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5684', null, '20AUM122315', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5685', null, '20AUM122316', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5686', null, '20AUM122317', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5687', null, '20AUM122318', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5688', null, '20AUM122319', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5689', null, '20AUM122320', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5690', null, '20AUM122321', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5691', null, '20AUM122322', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5692', null, '20AUM122323', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5693', null, '20AUM122324', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5694', null, '20AUM122325', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5695', null, '20AUM122326', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5696', null, '20AUM122327', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5697', null, '20AUM122328', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5698', null, '20AUM122329', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5699', null, '20AUM122330', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5700', null, '20AUM122331', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5701', null, '20AUM122332', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5702', null, '20AUM122333', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5703', null, '20AUM122334', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5704', null, '20AUM122335', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5705', null, '20AUM122336', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5706', null, '20AUM122337', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5707', null, '20AUM122338', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5708', null, '20AUM122339', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5709', null, '20AUM122340', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5710', null, '20AUM122341', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5711', null, '20AUM122342', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5712', null, '20AUM114271', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5713', null, '20AUM114272', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5714', null, '20AUM114273', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5715', null, '20AUM114274', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5716', null, '20AUM114275', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5717', null, '20AUM114276', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5718', null, '20AUM114277', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5719', null, '20AUM114278', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5720', null, '20AUM114279', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5721', null, '20AUM114280', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5722', null, '20AUM114281', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5723', null, '20AUM114282', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5724', null, '20AUM114283', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5725', null, '20AUM114284', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5726', null, '20AUM114285', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5727', null, '20AUM114286', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5728', null, '20AUM122311', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5729', null, '20AUM122312', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5730', null, '20AUM122313', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5731', null, '20AUM122314', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5732', null, '20AUM122315', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5733', null, '20AUM122316', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5734', null, '20AUM122317', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5735', null, '20AUM122318', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5736', null, '20AUM122319', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5737', null, '20AUM122320', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5738', null, '20AUM122321', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5739', null, '20AUM122322', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5740', null, '20AUM122323', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5741', null, '20AUM122324', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5742', null, '20AUM122325', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5743', null, '20AUM122326', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5744', null, '20AUM122327', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5745', null, '20AUM122328', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5746', null, '20AUM122329', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5747', null, '20AUM122330', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5748', null, '20AUM122331', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5749', null, '20AUM122332', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5750', null, '20AUM122333', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5751', null, '20AUM122334', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5752', null, '20AUM122335', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5753', null, '20AUM122336', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5754', null, '20AUM122337', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5755', null, '20AUM122338', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5756', null, '20AUM122339', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5757', null, '20AUM122340', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5758', null, '20AUM122341', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5759', null, '20AUM122342', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5760', null, '20AUM116287', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5761', null, '20AUM116288', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5762', null, '20AUM116289', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5763', null, '20AUM116290', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5764', null, '20AUM116291', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5765', null, '20AUM116292', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5766', null, '20AUM116293', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5767', null, '20AUM116294', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5768', null, '20AUM116295', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5769', null, '20AUM116296', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5770', null, '20AUM116297', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5771', null, '20AUM116298', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5772', null, '20AUM116299', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5773', null, '20AUM116300', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5774', null, '20AUM116301', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5775', null, '20AUM116302', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5776', null, '20AUM116303', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5777', null, '20AUM116304', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5778', null, '20AUM116305', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5779', null, '20AUM116306', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5780', null, '20AUM116307', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5781', null, '20AUM116308', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5782', null, '20AUM116309', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5783', null, '20AUM116310', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5784', null, '20AUM116343', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5785', null, '20AUM116343', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5786', null, '20AUM116343', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5787', null, '20AUM116349', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5788', null, '20AUM116349', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5789', null, '20AUM116349', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5793', null, '20AUM116345', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5794', null, '20AUM116345', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5795', null, '20AUM116345', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5796', null, '20AUM116346', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5797', null, '20AUM116346', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5798', null, '20AUM116346', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5799', null, '20AUM116347', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5800', null, '20AUM116347', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5801', null, '20AUM116347', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5802', null, '20AUM116348', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5803', null, '20AUM116348', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5804', null, '20AUM116348', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5805', null, '20AUM116362', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5806', null, '20AUM116362', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5807', null, '20AUM116362', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5808', null, '20AUM116350', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5809', null, '20AUM116350', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5810', null, '20AUM116350', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5811', null, '20AUM116351', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5812', null, '20AUM116351', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5813', null, '20AUM116351', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5814', null, '20AUM116352', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5815', null, '20AUM116352', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5816', null, '20AUM116352', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5817', null, '20AUM116353', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5818', null, '20AUM116353', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5819', null, '20AUM116353', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5820', null, '20AUM116354', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5821', null, '20AUM116354', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5822', null, '20AUM116354', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5823', null, '20AUM116355', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5824', null, '20AUM116355', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5825', null, '20AUM116355', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5826', null, '20AUM116356', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5827', null, '20AUM116356', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5828', null, '20AUM116356', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5829', null, '20AUM116357', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5830', null, '20AUM116357', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5831', null, '20AUM116357', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5832', null, '20AUM116358', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5833', null, '20AUM116358', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5834', null, '20AUM116358', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5835', null, '20AUM116359', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5836', null, '20AUM116359', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5837', null, '20AUM116359', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5838', null, '20AUM116360', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5839', null, '20AUM116360', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5840', null, '20AUM116360', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5841', null, '20AUM116361', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5842', null, '20AUM116361', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5843', null, '20AUM116361', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5984', null, '20AUM116344', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5985', null, '20AUM116344', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5986', null, '20AUM116344', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5987', null, '20AUM116343', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5988', null, '20AUM116344', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5989', null, '20AUM116345', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5990', null, '20AUM116346', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5991', null, '20AUM116347', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5992', null, '20AUM116348', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5993', null, '20AUM116349', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5994', null, '20AUM116350', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5995', null, '20AUM116351', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5996', null, '20AUM116352', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5997', null, '20AUM116353', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5998', null, '20AUM116354', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('5999', null, '20AUM116355', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6000', null, '20AUM116356', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6001', null, '20AUM116357', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6002', null, '20AUM116358', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6003', null, '20AUM116359', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6004', null, '20AUM116360', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6005', null, '20AUM116361', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6006', null, '20AUM116362', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6007', null, '20AUM116343', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6008', null, '20AUM116344', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6009', null, '20AUM116345', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6010', null, '20AUM116346', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6011', null, '20AUM116347', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6012', null, '20AUM116348', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6013', null, '20AUM116349', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6014', null, '20AUM116350', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6015', null, '20AUM116351', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6016', null, '20AUM116352', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6017', null, '20AUM116353', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6018', null, '20AUM116354', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6019', null, '20AUM116355', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6020', null, '20AUM116356', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6021', null, '20AUM116357', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6022', null, '20AUM116358', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6023', null, '20AUM116359', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6024', null, '20AUM116360', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6025', null, '20AUM116361', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6026', null, '20AUM116362', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6027', null, '20AUM116343', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6028', null, '20AUM116344', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6029', null, '20AUM116345', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6030', null, '20AUM116346', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6031', null, '20AUM116347', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6032', null, '20AUM116348', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6033', null, '20AUM116349', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6034', null, '20AUM116350', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6035', null, '20AUM116351', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6036', null, '20AUM116352', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6037', null, '20AUM116353', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6038', null, '20AUM116354', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6039', null, '20AUM116355', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6040', null, '20AUM116356', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6041', null, '20AUM116357', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6042', null, '20AUM116358', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6043', null, '20AUM116359', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6044', null, '20AUM116360', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6045', null, '20AUM116361', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6046', null, '20AUM116362', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6047', null, '20AUM116343', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6048', null, '20AUM116344', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6049', null, '20AUM116345', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6050', null, '20AUM116346', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6051', null, '20AUM116347', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6052', null, '20AUM116348', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6053', null, '20AUM116349', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6054', null, '20AUM116350', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6055', null, '20AUM116351', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6056', null, '20AUM116352', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6057', null, '20AUM116353', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6058', null, '20AUM116354', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6059', null, '20AUM116355', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6060', null, '20AUM116356', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6061', null, '20AUM116357', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6062', null, '20AUM116358', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6063', null, '20AUM116359', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6064', null, '20AUM116360', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6065', null, '20AUM116361', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6066', null, '20AUM116362', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6067', null, '20AUM116343', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6068', null, '20AUM116344', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6069', null, '20AUM116345', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6070', null, '20AUM116346', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6071', null, '20AUM116347', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6072', null, '20AUM116348', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6073', null, '20AUM116349', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6074', null, '20AUM116350', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6075', null, '20AUM116351', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6076', null, '20AUM116352', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6077', null, '20AUM116353', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6078', null, '20AUM116354', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6079', null, '20AUM116355', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6080', null, '20AUM116356', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6081', null, '20AUM116357', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6082', null, '20AUM116358', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6083', null, '20AUM116359', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6084', null, '20AUM116360', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6085', null, '20AUM116361', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6086', null, '20AUM116362', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6087', null, '20AUM116343', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6088', null, '20AUM116344', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6089', null, '20AUM116345', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6090', null, '20AUM116346', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6091', null, '20AUM116347', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6092', null, '20AUM116348', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6093', null, '20AUM116349', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6094', null, '20AUM116350', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6095', null, '20AUM116351', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6096', null, '20AUM116352', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6097', null, '20AUM116353', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6098', null, '20AUM116354', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6099', null, '20AUM116355', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6100', null, '20AUM116356', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6101', null, '20AUM116357', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6102', null, '20AUM116358', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6103', null, '20AUM116359', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6104', null, '20AUM116360', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6105', null, '20AUM116361', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6106', null, '20AUM116362', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6107', null, '20AUM116343', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6108', null, '20AUM116344', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6109', null, '20AUM116345', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6110', null, '20AUM116346', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6111', null, '20AUM116347', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6112', null, '20AUM116348', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6113', null, '20AUM116349', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6114', null, '20AUM116350', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6115', null, '20AUM116351', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6116', null, '20AUM116352', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6117', null, '20AUM116353', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6118', null, '20AUM116354', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6119', null, '20AUM116355', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6120', null, '20AUM116356', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6121', null, '20AUM116357', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6122', null, '20AUM116358', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6123', null, '20AUM116359', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6124', null, '20AUM116360', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6125', null, '20AUM116361', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6126', null, '20AUM116362', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6127', null, '20AUM116363', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6128', null, '20AUM116363', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6129', null, '20AUM116363', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6130', null, '20AUM116364', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6131', null, '20AUM116364', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6132', null, '20AUM116364', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6133', null, '20AUM116366', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6134', null, '20AUM116366', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6135', null, '20AUM116366', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6136', null, '20AUM116369', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6137', null, '20AUM116369', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6138', null, '20AUM116369', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6139', null, '20AUM116372', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6140', null, '20AUM116372', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6141', null, '20AUM116372', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6142', null, '20AUM116373', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6143', null, '20AUM116373', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6144', null, '20AUM116373', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6145', null, '20AUM116374', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6146', null, '20AUM116374', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6147', null, '20AUM116374', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6148', null, '20AUM116375', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6149', null, '20AUM116375', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6150', null, '20AUM116375', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6151', null, '20AUM116376', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6152', null, '20AUM116376', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6153', null, '20AUM116376', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6154', null, '20AUM116377', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6155', null, '20AUM116377', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6156', null, '20AUM116377', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6157', null, '20AUM116378', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6158', null, '20AUM116378', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6159', null, '20AUM116378', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6160', null, '20AUM116379', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6161', null, '20AUM116379', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6162', null, '20AUM116379', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6163', null, '20AUM116380', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6164', null, '20AUM116380', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6165', null, '20AUM116380', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6166', null, '20AUM116381', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6167', null, '20AUM116381', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6168', null, '20AUM116381', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6169', null, '20AUM116382', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6170', null, '20AUM116382', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6171', null, '20AUM116382', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6172', null, '20AUM116383', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6173', null, '20AUM116383', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6174', null, '20AUM116383', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6175', null, '20AUM116384', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6176', null, '20AUM116384', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6177', null, '20AUM116384', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6178', null, '20AUM116385', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6179', null, '20AUM116385', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6180', null, '20AUM116385', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6181', null, '20AUM116387', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6182', null, '20AUM116387', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6183', null, '20AUM116387', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6184', null, '20AUM116388', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6185', null, '20AUM116388', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6186', null, '20AUM116388', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6187', null, '20AUM116389', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6188', null, '20AUM116389', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6189', null, '20AUM116389', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6190', null, '20AUM116392', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6191', null, '20AUM116392', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6192', null, '20AUM116392', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6193', null, '20AUM116393', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6194', null, '20AUM116393', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6195', null, '20AUM116393', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6196', null, '20AUM116395', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6197', null, '20AUM116395', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6198', null, '20AUM116395', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6199', null, '20AUM116396', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6200', null, '20AUM116396', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6201', null, '20AUM116396', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6202', null, '20AUM116397', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6203', null, '20AUM116397', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6204', null, '20AUM116397', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6205', null, '20AUM116398', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6206', null, '20AUM116398', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6207', null, '20AUM116398', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6208', null, '20AUM116399', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6209', null, '20AUM116399', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6210', null, '20AUM116399', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6211', null, '20AUM116400', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6212', null, '20AUM116400', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6213', null, '20AUM116400', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6214', null, '20AUM116401', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6215', null, '20AUM116401', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6216', null, '20AUM116401', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6217', null, '20AUM116402', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6218', null, '20AUM116402', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6219', null, '20AUM116402', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6220', null, '20AUM116403', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6221', null, '20AUM116403', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6222', null, '20AUM116403', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6223', null, '20AUM116404', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6224', null, '20AUM116404', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6225', null, '20AUM116404', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6226', null, '20AUM116406', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6227', null, '20AUM116406', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6228', null, '20AUM116406', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6229', null, '20AUM116407', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6230', null, '20AUM116407', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6231', null, '20AUM116407', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6232', null, '20AUM116408', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6233', null, '20AUM116408', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6234', null, '20AUM116408', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6235', null, '20AUM116409', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6236', null, '20AUM116409', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6237', null, '20AUM116409', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6238', null, '20AUM116410', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6239', null, '20AUM116410', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6240', null, '20AUM116410', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6241', null, '20AUM116411', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6242', null, '20AUM116411', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6243', null, '20AUM116411', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6244', null, '20AUM116412', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6245', null, '20AUM116412', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6246', null, '20AUM116412', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6247', null, '20AUM116414', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6248', null, '20AUM116414', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6249', null, '20AUM116414', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6250', null, '20AUM116415', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6251', null, '20AUM116415', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6252', null, '20AUM116415', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6253', null, '20AUM116417', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6254', null, '20AUM116417', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6255', null, '20AUM116417', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6256', null, '20AUM116418', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6257', null, '20AUM116418', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6258', null, '20AUM116418', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6259', null, '20AUM116419', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6260', null, '20AUM116419', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6261', null, '20AUM116419', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6262', null, '20AUM116421', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6263', null, '20AUM116421', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6264', null, '20AUM116421', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6265', null, '20AUM116423', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6266', null, '20AUM116423', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6267', null, '20AUM116423', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6268', null, '20AUM116424', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6269', null, '20AUM116424', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6270', null, '20AUM116424', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6271', null, '20AUM116425', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6272', null, '20AUM116425', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6273', null, '20AUM116425', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6274', null, '20AUM116426', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6275', null, '20AUM116426', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6276', null, '20AUM116426', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6277', null, '20AUM116427', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6278', null, '20AUM116427', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6279', null, '20AUM116427', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6280', null, '20AUM116405', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6281', null, '20AUM116405', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6282', null, '20AUM116405', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6283', null, '20AUM116365', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6284', null, '20AUM116365', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6285', null, '20AUM116365', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6286', null, '20AUM116367', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6287', null, '20AUM116367', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6288', null, '20AUM116367', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6289', null, '20AUM116368', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6290', null, '20AUM116368', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6291', null, '20AUM116368', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6292', null, '20AUM116370', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6293', null, '20AUM116370', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6294', null, '20AUM116370', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6295', null, '20AUM116371', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6296', null, '20AUM116371', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6297', null, '20AUM116371', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6298', null, '20AUM116386', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6299', null, '20AUM116386', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6300', null, '20AUM116386', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6301', null, '20AUM116390', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6302', null, '20AUM116390', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6303', null, '20AUM116390', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6304', null, '20AUM116391', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6305', null, '20AUM116391', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6306', null, '20AUM116391', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6307', null, '20AUM116394', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6308', null, '20AUM116394', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6309', null, '20AUM116394', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6310', null, '20AUM116413', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6311', null, '20AUM116413', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6312', null, '20AUM116413', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6313', null, '20AUM116416', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6314', null, '20AUM116416', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6315', null, '20AUM116416', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6316', null, '20AUM116420', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6317', null, '20AUM116420', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6318', null, '20AUM116420', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6319', null, '20AUM116422', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6320', null, '20AUM116422', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6321', null, '20AUM116422', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6322', null, '20AUM114271', null, null, null, null, '0', null, '100000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6323', null, '20AUM116343', null, null, null, null, '0', null, '100000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6324', null, '20AUM116428', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6325', null, '20AUM116428', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6326', null, '20AUM116428', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6327', null, '20AUM116429', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6328', null, '20AUM116429', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6329', null, '20AUM116429', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6330', null, '20AUM116430', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6331', null, '20AUM116430', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6332', null, '20AUM116430', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6333', null, '20AUM116431', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6334', null, '20AUM116431', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6335', null, '20AUM116431', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6336', null, '20AUM116432', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6337', null, '20AUM116432', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6338', null, '20AUM116432', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6339', null, '20AUM116433', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6340', null, '20AUM116433', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6341', null, '20AUM116433', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6342', null, '20AUM116434', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6343', null, '20AUM116434', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6344', null, '20AUM116434', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6345', null, '20AUM116435', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6346', null, '20AUM116435', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6347', null, '20AUM116435', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6348', null, '20AUM116436', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6349', null, '20AUM116436', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6350', null, '20AUM116436', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6351', null, '20AUM116437', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6352', null, '20AUM116437', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6353', null, '20AUM116437', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6354', null, '20AUM116438', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6355', null, '20AUM116438', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6356', null, '20AUM116438', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6357', null, '20AUM116439', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6358', null, '20AUM116439', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6359', null, '20AUM116439', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6360', null, '20AUM116440', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6361', null, '20AUM116440', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6362', null, '20AUM116440', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6363', null, '20AUM116441', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6364', null, '20AUM116441', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6365', null, '20AUM116441', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6366', null, '20AUM116442', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6367', null, '20AUM116442', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6368', null, '20AUM116442', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6369', null, '20AUM116443', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6370', null, '20AUM116443', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6371', null, '20AUM116443', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6372', null, '20AUM116444', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6373', null, '20AUM116444', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6374', null, '20AUM116444', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6375', null, '20AUM116445', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6376', null, '20AUM116445', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6377', null, '20AUM116445', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6378', null, '20AUM116446', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6379', null, '20AUM116446', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6380', null, '20AUM116446', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6381', null, '20AUM116447', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6382', null, '20AUM116447', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6383', null, '20AUM116447', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6384', null, '20AUM116448', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6385', null, '20AUM116448', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6386', null, '20AUM116448', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6387', null, '20AUM116449', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6388', null, '20AUM116449', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6389', null, '20AUM116449', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6390', null, '20AUM116450', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6391', null, '20AUM116450', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6392', null, '20AUM116450', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6393', null, '20AUM116451', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6394', null, '20AUM116451', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6395', null, '20AUM116451', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6396', null, '20AUM116452', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6397', null, '20AUM116452', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6398', null, '20AUM116452', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6399', null, '20AUM116453', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6400', null, '20AUM116453', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6401', null, '20AUM116453', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6402', null, '20AUM116454', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6403', null, '20AUM116454', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6404', null, '20AUM116454', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6405', null, '20AUM114271', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6406', null, '20AUM114271', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6407', null, '20AUM114271', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6408', null, '20AUM114271', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6409', null, '20AUM114271', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6410', null, '20AUM114271', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6411', null, '20AUM114271', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6412', null, '20AUM114271', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6413', null, '20AUM114271', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6414', null, '20AUM114271', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6415', null, '20AUM114271', null, null, null, null, '2', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6416', null, '20AUM114271', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6417', null, '20AUM114271', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6434', null, '20AUM114271', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6435', null, '20AUM114272', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6436', null, '20AUM114273', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6437', null, '20AUM114274', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6438', null, '20AUM114275', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6439', null, '20AUM114276', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6440', null, '20AUM114277', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6441', null, '20AUM114278', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6442', null, '20AUM114279', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6443', null, '20AUM114280', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6444', null, '20AUM114281', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6445', null, '20AUM114282', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6446', null, '20AUM114283', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6447', null, '20AUM114284', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6448', null, '20AUM114285', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6449', null, '20AUM114286', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6473', null, '20AUM114271', null, null, null, null, '1', null, '300000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6474', null, '20AUM114271', null, null, null, null, '1', null, '1200000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6475', null, '20AUM114271', null, null, null, null, '1', null, '50000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6476', null, '20AUM114271', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6477', null, '20AUM114271', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6478', null, '20AUM114271', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6479', null, '20AUM114271', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6480', null, '20AUM114271', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6481', null, '20AUM114271', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6482', null, '20AUM122464', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6483', null, '20AUM122464', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6484', null, '20AUM122464', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6485', null, '20AUM122464', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6486', null, '20AUM122464', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6487', null, '20AUM122464', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6488', null, '20AUM116471', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6489', null, '20AUM116471', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6490', null, '20AUM116471', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6491', null, '20AUM116471', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6492', null, '20AUM116471', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6493', null, '20AUM116471', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6494', null, '20AUM116471', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6495', null, '20AUM114472', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6496', null, '20AUM114472', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6497', null, '20AUM114472', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6498', null, '20AUM114472', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6499', null, '20AUM114472', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6500', null, '20AUM114472', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6501', null, '20AUM114472', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6502', null, '20AUM122473', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6503', null, '20AUM122473', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6504', null, '20AUM122473', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6505', null, '20AUM122473', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6506', null, '20AUM122473', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6507', null, '20AUM122473', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6508', null, '20AUM114476', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6509', null, '20AUM114476', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6510', null, '20AUM114476', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6511', null, '20AUM114476', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6512', null, '20AUM114476', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6513', null, '20AUM114476', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6514', null, '20AUM114476', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6515', null, '20AUM116477', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6516', null, '20AUM116477', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6517', null, '20AUM116477', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6518', null, '20AUM116477', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6519', null, '20AUM116477', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6520', null, '20AUM116477', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6521', null, '20AUM116477', null, null, null, null, '1', null, '520000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6522', null, '20AUM116477', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6523', null, '21-2-7480201-0104', null, null, null, null, '1', null, '260000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6524', null, '21-2-7480201-0104', null, null, null, null, '1', null, '350000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6525', null, '21-2-7480201-0109', null, null, null, null, '1', null, '0', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6529', null, '21-2-7480201-0006', null, null, null, null, '1', null, '1000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6530', null, '21-2-7480201-0099', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6532', null, '21-2-7480201-0099', null, null, null, null, '1', null, '780000', null, null, null, null);
INSERT INTO `tbl_hocphi_detail` VALUES ('6550', null, 'AUM111709', '', null, null, 'test-1', '1', '1', '1040000', '0', '1040000', null, null);

-- ----------------------------
-- Table structure for tbl_hocphi_note
-- ----------------------------
DROP TABLE IF EXISTS `tbl_hocphi_note`;
CREATE TABLE `tbl_hocphi_note` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `masv` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `hocphi_ids` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `money` int(11) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `cdate` int(11) DEFAULT NULL,
  `author` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_hocphi_note
-- ----------------------------
INSERT INTO `tbl_hocphi_note` VALUES ('1', '20AUM116303', '5267,5268,5269,5304,5328,5352,5376,5400,5424,5448,5776,', '6230000', 'Đã đóng 6,230,000 VNĐ', '1615830738', 'tranhiep');
INSERT INTO `tbl_hocphi_note` VALUES ('2', '20AUM116296', '5246,', '300000', 'Đã đóng 300,000 VNĐ', '1615830778', 'tranhiep');
INSERT INTO `tbl_hocphi_note` VALUES ('3', '20AUM114271', '5072,5088,5104,5120,5136,5152,5168,5169,5170,5712,6322,6405,6406,6407,6408,6409,6410,6411,6412,6413,6414,6415,6416,6417,', '14380000', 'Đã đóng 14,380,000 VNĐ', '1616554837', 'tranhiep');

-- ----------------------------
-- Table structure for tbl_hocphi_order
-- ----------------------------
DROP TABLE IF EXISTS `tbl_hocphi_order`;
CREATE TABLE `tbl_hocphi_order` (
  `id` varchar(50) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ma_truong` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `hocky` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `slot` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `cdate` int(11) DEFAULT NULL,
  `start_date` int(11) DEFAULT NULL,
  `end_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_hocphi_order
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_hocphi_pay
-- ----------------------------
DROP TABLE IF EXISTS `tbl_hocphi_pay`;
CREATE TABLE `tbl_hocphi_pay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_order` int(11) DEFAULT NULL,
  `id_order_detail` int(11) DEFAULT NULL,
  `masv` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `sotien` float DEFAULT NULL,
  `noidung` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_pay` int(11) DEFAULT NULL,
  `author` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tbl_hocphi_pay
-- ----------------------------
INSERT INTO `tbl_hocphi_pay` VALUES ('5', '20', null, null, '100000', 'Đóng học phí', '1616647766', 'tranhiep');
INSERT INTO `tbl_hocphi_pay` VALUES ('6', '20', null, null, '100000', 'Đóng học phí', '1616659975', 'tranhiep');
INSERT INTO `tbl_hocphi_pay` VALUES ('7', '20', null, null, '100000', 'Đóng học phí', '1616659975', 'tranhiep');
INSERT INTO `tbl_hocphi_pay` VALUES ('8', '20', null, null, '200000', 'Đóng học phí', '1616660312', 'tranhiep');
INSERT INTO `tbl_hocphi_pay` VALUES ('9', '20', null, null, '150000', 'Đóng học phí & in biên lai', '1616668953', 'tranhiep');
INSERT INTO `tbl_hocphi_pay` VALUES ('10', '20', null, null, '300000', 'Đóng học phí & in biên lai', '1616669281', 'tranhiep');
INSERT INTO `tbl_hocphi_pay` VALUES ('11', '20', null, null, '1', 'Đóng học phí & in biên lai', '1616669429', 'tranhiep');
INSERT INTO `tbl_hocphi_pay` VALUES ('12', '20', null, null, '1', 'Đóng học phí & in biên lai', '1616669557', 'tranhiep');
INSERT INTO `tbl_hocphi_pay` VALUES ('13', '20', null, null, '12', 'Đóng học phí & in biên lai', '1616669561', 'tranhiep');
INSERT INTO `tbl_hocphi_pay` VALUES ('14', '20', null, null, '12', 'Đóng học phí & in biên lai', '1616669795', 'tranhiep');
INSERT INTO `tbl_hocphi_pay` VALUES ('15', '20', null, null, '1', 'Đóng học phí & in biên lai', '1616669806', 'tranhiep');
INSERT INTO `tbl_hocphi_pay` VALUES ('16', '20', null, null, '1', 'Đóng học phí & in biên lai', '1616669816', 'tranhiep');
INSERT INTO `tbl_hocphi_pay` VALUES ('17', '20', null, null, '1', 'Đóng học phí & in biên lai', '1616669830', 'tranhiep');
INSERT INTO `tbl_hocphi_pay` VALUES ('18', '20', null, null, '1', 'Đóng học phí & in biên lai', '1616669830', 'tranhiep');
INSERT INTO `tbl_hocphi_pay` VALUES ('19', '20', null, null, '1', 'Đóng học phí & in biên lai', '1616669937', 'tranhiep');
INSERT INTO `tbl_hocphi_pay` VALUES ('20', '20', null, null, '1', 'Đóng học phí & in biên lai', '1616669937', 'tranhiep');
INSERT INTO `tbl_hocphi_pay` VALUES ('21', '20', null, null, '1', 'Đóng học phí & in biên lai', '1616669945', 'tranhiep');
INSERT INTO `tbl_hocphi_pay` VALUES ('22', '20', null, null, '1', 'Đóng học phí & in biên lai', '1616669945', 'tranhiep');
INSERT INTO `tbl_hocphi_pay` VALUES ('23', '20', null, null, '1', 'Đóng học phí & in biên lai', '1616669946', 'tranhiep');
INSERT INTO `tbl_hocphi_pay` VALUES ('24', '20', null, null, '1', 'Đóng học phí & in biên lai', '1616669946', 'tranhiep');
INSERT INTO `tbl_hocphi_pay` VALUES ('25', '20', null, null, '1', 'Đóng học phí & in biên lai', '1616669947', 'tranhiep');
INSERT INTO `tbl_hocphi_pay` VALUES ('26', '20', null, null, '1', 'Đóng học phí & in biên lai', '1616669947', 'tranhiep');
INSERT INTO `tbl_hocphi_pay` VALUES ('27', '20', null, null, '1', 'Đóng học phí & in biên lai', '1616669949', 'tranhiep');
INSERT INTO `tbl_hocphi_pay` VALUES ('28', '20', null, null, '1', 'Đóng học phí & in biên lai', '1616669949', 'tranhiep');
INSERT INTO `tbl_hocphi_pay` VALUES ('29', '20', null, null, '1', 'Đóng học phí & in biên lai', '1616669974', 'tranhiep');
INSERT INTO `tbl_hocphi_pay` VALUES ('30', '20', null, null, '1', 'Đóng học phí & in biên lai', '1616669975', 'tranhiep');
INSERT INTO `tbl_hocphi_pay` VALUES ('31', '20', null, null, '1', 'Đóng học phí & in biên lai', '1616669975', 'tranhiep');
INSERT INTO `tbl_hocphi_pay` VALUES ('32', '20', null, null, '1', 'Đóng học phí & in biên lai', '1616669976', 'tranhiep');
INSERT INTO `tbl_hocphi_pay` VALUES ('33', '20', null, null, '1', 'Đóng học phí & in biên lai', '1616669976', 'tranhiep');
INSERT INTO `tbl_hocphi_pay` VALUES ('34', '20', null, null, '1', 'Đóng học phí & in biên lai', '1616670011', 'tranhiep');
INSERT INTO `tbl_hocphi_pay` VALUES ('35', '20', null, null, '555', 'Đóng học phí & in biên lai', '1616670029', 'tranhiep');
INSERT INTO `tbl_hocphi_pay` VALUES ('36', '20', null, null, '1000000', 'Đóng tiền học phí', '1616670169', 'tranhiep');
INSERT INTO `tbl_hocphi_pay` VALUES ('37', '20', null, null, '2000000', 'Đóng tiền học phí', '1617554510', 'tranhiep');
INSERT INTO `tbl_hocphi_pay` VALUES ('38', '21', null, null, '1000000', 'Đóng học phí', '1619517663', 'N/A');

-- ----------------------------
-- Table structure for tbl_hocsinh
-- ----------------------------
DROP TABLE IF EXISTS `tbl_hocsinh`;
CREATE TABLE `tbl_hocsinh` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `partner_id` int(11) DEFAULT '0',
  `ma` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ho_dem` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nickname` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngaysinh` int(11) DEFAULT NULL,
  `noisinh` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gioitinh` varchar(3) COLLATE utf8_unicode_ci DEFAULT '' COMMENT 'nam,nu',
  `diachi` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` int(11) DEFAULT NULL,
  `dienthoai` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cmt` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngaycap_cmt` int(11) DEFAULT NULL,
  `noicap_cmt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quoctich` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nguyenquan` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hktt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dantoc` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tongiao` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `khuvucTS` varchar(10) COLLATE utf8_unicode_ci DEFAULT '1',
  `doituongUT` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `daoduc` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trinhdo` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `diencs` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thanhphan` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `doan` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dang` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngayct` date DEFAULT NULL,
  `stk` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci,
  `dmhoso` text COLLATE utf8_unicode_ci,
  `qhgiadinh` text COLLATE utf8_unicode_ci,
  `qthoctap` text COLLATE utf8_unicode_ci,
  `qthoc` text COLLATE utf8_unicode_ci,
  `khenthuong` text COLLATE utf8_unicode_ci,
  `kyluat` text COLLATE utf8_unicode_ci,
  `partner` int(11) DEFAULT NULL,
  `cdate` int(11) DEFAULT NULL,
  `mdate` int(11) DEFAULT NULL,
  `author` varchar(255) COLLATE utf8_unicode_ci DEFAULT '50',
  `brief` text COLLATE utf8_unicode_ci,
  `brief_full` tinyint(4) DEFAULT '0' COMMENT '0: Chưa check hồ sơ, 1: Check đủ hồ sơ, -1: Hồ sơ thiếu',
  `status` tinyint(4) DEFAULT '0',
  `xettuyen` tinyint(4) DEFAULT '0',
  `isactive` tinyint(4) DEFAULT '1',
  `ngayBG` int(11) DEFAULT NULL,
  `tinhtrangBG` int(11) DEFAULT NULL,
  `lydoBG` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ma_unique` (`ma`),
  KEY `idx_ma` (`ma`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_hocsinh
-- ----------------------------
INSERT INTO `tbl_hocsinh` VALUES ('1', '0', 'KH269642', 'Phạm', 'Hải', null, '645814800', null, 'nu', '', null, '0987123585', '0129993929', null, null, null, null, null, null, null, '1', null, null, '3', null, null, null, null, null, null, '0987123585@gmail.com', null, null, null, null, null, null, null, null, '1623983968', null, '50', null, '0', '0', '0', '1', null, null, null);
INSERT INTO `tbl_hocsinh` VALUES ('2', '0', 'KH269638', 'Mai Thị', 'Yến', null, '645814800', null, 'nu', '', null, '0987123589', '0129993929', null, null, null, null, null, null, null, '1', null, null, '4', null, null, null, null, null, null, '0987123589@gmail.com', null, null, null, null, null, null, null, null, '1623983968', null, '50', null, '0', '0', '0', '1', null, null, null);
INSERT INTO `tbl_hocsinh` VALUES ('3', '0', 'KH269637', 'Nguyễn Tiến', 'Việt', null, '507574800', null, 'nu', '', null, '0987123590', '0129993929', null, null, null, null, null, null, null, '1', null, null, '3', null, null, null, null, null, null, '0987123590@gmail.com', null, null, null, null, null, null, null, null, '1623983968', null, '50', null, '0', '0', '0', '1', null, null, null);
INSERT INTO `tbl_hocsinh` VALUES ('4', '0', 'KH269639', 'Diệp', 'Diệp', null, '645814800', null, 'nu', '', null, '0987123588', '0129993929', null, null, null, null, null, null, null, '1', null, null, '3', null, null, null, null, null, null, '0987123588@gmail.com', null, null, null, null, null, null, null, null, '1623983968', null, '50', null, '0', '0', '0', '1', null, null, null);
INSERT INTO `tbl_hocsinh` VALUES ('5', '0', 'KH269636', 'Thuy', 'Ngo', null, '584038800', null, 'nu', '', null, '0987123591', '0973764220', null, null, null, null, null, null, null, '1', null, null, '1', null, null, null, null, null, null, '0987123591@gmail.com', null, null, null, null, null, null, null, null, '1623983968', null, '50', null, '0', '0', '0', '1', null, null, null);
INSERT INTO `tbl_hocsinh` VALUES ('6', '0', 'KH269643', 'Thuy', 'Ngo', null, '1621357200', null, 'nu', '', null, '0987123584', '0129993929', null, null, null, null, null, null, null, '1', null, null, '1', null, null, null, null, null, null, '0987123584@gmail.com', null, null, null, null, null, null, null, null, '1623983968', null, '50', null, '0', '0', '0', '1', null, null, null);
INSERT INTO `tbl_hocsinh` VALUES ('7', '0', 'KH269645', 'Thuy', 'Ngo', null, '645814800', null, 'nu', '', null, '0987123582', '0129993929', null, null, null, null, null, null, null, '1', null, null, '1', null, null, null, null, null, null, '0987123582@gmail.com', null, null, null, null, null, null, null, null, '1623983968', null, '50', null, '0', '0', '0', '1', null, null, null);
INSERT INTO `tbl_hocsinh` VALUES ('8', '0', 'KH269641', 'Giang', 'Vo', null, '645814800', null, 'nu', '', null, '0987123586', '0129993929', null, null, null, null, null, null, null, '1', null, null, '4', null, null, null, null, null, null, '0987123586@gmail.com', null, null, null, null, null, null, null, null, '1623983968', null, '50', null, '0', '0', '0', '1', null, null, null);

-- ----------------------------
-- Table structure for tbl_hoctap
-- ----------------------------
DROP TABLE IF EXISTS `tbl_hoctap`;
CREATE TABLE `tbl_hoctap` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `masv` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_monhoc` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `tinchi` int(11) DEFAULT NULL,
  `type` tinyint(4) DEFAULT '0',
  `status` varchar(4) DEFAULT '-1' COMMENT 'chưa xét, 0:không đạt, 1:đạt, 2:thi lại, 3:thi cải thiện, 4:học lại, 5:học cải thiện',
  `diem` text,
  `ketqua` float DEFAULT NULL,
  `ketqua2` float DEFAULT NULL,
  `ketqua3` float DEFAULT NULL,
  `hoclai` tinyint(4) DEFAULT '0',
  `dieukienthi` varchar(4) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '',
  `mdate` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3472 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tbl_hoctap
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_hoctap_note
-- ----------------------------
DROP TABLE IF EXISTS `tbl_hoctap_note`;
CREATE TABLE `tbl_hoctap_note` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_hoctap` int(11) DEFAULT NULL,
  `masv` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_monhoc` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `cdate` int(11) DEFAULT NULL,
  `author` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=342 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_hoctap_note
-- ----------------------------
INSERT INTO `tbl_hoctap_note` VALUES ('257', '2845', '20AUM114271', 'MC02', 'Đăng ký thi lại môn MC02', '1610440734', 'admindemo');
INSERT INTO `tbl_hoctap_note` VALUES ('258', '2845', '20AUM114271', 'MC02', 'KQ lần 2: Không đạt môn MC02', '1610440750', 'admindemo');
INSERT INTO `tbl_hoctap_note` VALUES ('259', '3177', '20AUM116343', 'MC19', 'Đăng ký thi lại môn MC19', '1610440949', 'admindemo');
INSERT INTO `tbl_hoctap_note` VALUES ('260', '2501', null, null, 'Note', '1615920155', 'tranhiep');
INSERT INTO `tbl_hoctap_note` VALUES ('261', '2501', null, null, 'Note 2', '1615920248', 'tranhiep');
INSERT INTO `tbl_hoctap_note` VALUES ('262', '2485', null, null, 'Note', '1615920409', 'tranhiep');
INSERT INTO `tbl_hoctap_note` VALUES ('263', '2609', null, null, 'Note', '1615920477', 'tranhiep');
INSERT INTO `tbl_hoctap_note` VALUES ('264', null, '20AUM114271', 'MC03', 'Cập nhật điểm: chuyên cần (10) điểm kiểm tra (9) điểm thi (7)', '1616672624', 'tranhiep');
INSERT INTO `tbl_hoctap_note` VALUES ('265', null, '20AUM114271', 'MC03', 'Cập nhật điểm: chuyên cần (10) điểm kiểm tra (9) điểm thi (7)', '1616672627', 'tranhiep');
INSERT INTO `tbl_hoctap_note` VALUES ('266', null, '20AUM114271', 'MC01', 'Cập nhật điểm: chuyên cần (9) điểm kiểm tra (10) điểm thi (8)', '1616731417', 'tranhiep');
INSERT INTO `tbl_hoctap_note` VALUES ('267', null, '20AUM114271', 'MC02', 'Cập nhật điểm: chuyên cần (10) điểm kiểm tra (9) điểm thi (7)', '1616731450', 'tranhiep');
INSERT INTO `tbl_hoctap_note` VALUES ('268', '3292', null, null, 'Note', '1617619689', 'tranhiep');
INSERT INTO `tbl_hoctap_note` VALUES ('269', '3309', null, null, 'thao tác cập nhật điểm yêu cầu chứng minh thư?', '1620806249', 'N/A');
INSERT INTO `tbl_hoctap_note` VALUES ('270', '3447', '20-2-7480201-0172', 'QTKD25', 'KQ: Không đạt môn QTKD25', '1621309306', 'nxtuyen.pro@gmail.com');
INSERT INTO `tbl_hoctap_note` VALUES ('271', '3449', '20-2-7480201-0173', 'QTKD25', 'KQ: Không đạt môn QTKD25', '1621309306', 'nxtuyen.pro@gmail.com');
INSERT INTO `tbl_hoctap_note` VALUES ('272', '3446', '20-2-7480201-0174', 'QTKD25', 'KQ: Không đạt môn QTKD25', '1621309306', 'nxtuyen.pro@gmail.com');
INSERT INTO `tbl_hoctap_note` VALUES ('273', '3448', '20-2-7480201-0175', 'QTKD25', 'KQ: Không đạt môn QTKD25', '1621309306', 'nxtuyen.pro@gmail.com');
INSERT INTO `tbl_hoctap_note` VALUES ('274', '3442', '20-2-7480201-0176', 'QTKD25', 'KQ: Không đạt môn QTKD25', '1621309306', 'nxtuyen.pro@gmail.com');
INSERT INTO `tbl_hoctap_note` VALUES ('275', '3445', '20-2-7480201-0269', 'QTKD25', 'KQ: Không đạt môn QTKD25', '1621309306', 'nxtuyen.pro@gmail.com');
INSERT INTO `tbl_hoctap_note` VALUES ('276', '3444', '20-2-7480201-0270', 'QTKD25', 'KQ: Không đạt môn QTKD25', '1621309306', 'nxtuyen.pro@gmail.com');
INSERT INTO `tbl_hoctap_note` VALUES ('277', '3439', '20-2-7480201-0362', 'QTKD25', 'KQ: Không đạt môn QTKD25', '1621309306', 'nxtuyen.pro@gmail.com');
INSERT INTO `tbl_hoctap_note` VALUES ('278', '3436', '20-2-7480201-0363', 'QTKD25', 'KQ: Không đạt môn QTKD25', '1621309306', 'nxtuyen.pro@gmail.com');
INSERT INTO `tbl_hoctap_note` VALUES ('279', '3441', '20-2-7480201-0364', 'QTKD25', 'KQ: Không đạt môn QTKD25', '1621309306', 'nxtuyen.pro@gmail.com');
INSERT INTO `tbl_hoctap_note` VALUES ('280', '3438', '20-2-7480201-0368', 'QTKD25', 'KQ: Không đạt môn QTKD25', '1621309306', 'nxtuyen.pro@gmail.com');
INSERT INTO `tbl_hoctap_note` VALUES ('281', '3443', '20-2-7480201-0369', 'QTKD25', 'KQ: Không đạt môn QTKD25', '1621309306', 'nxtuyen.pro@gmail.com');
INSERT INTO `tbl_hoctap_note` VALUES ('282', '3437', '20-2-7480201-0370', 'QTKD25', 'KQ: Không đạt môn QTKD25', '1621309306', 'nxtuyen.pro@gmail.com');
INSERT INTO `tbl_hoctap_note` VALUES ('283', '3440', '20-2-7480201-0371', 'QTKD25', 'KQ: Không đạt môn QTKD25', '1621309306', 'nxtuyen.pro@gmail.com');
INSERT INTO `tbl_hoctap_note` VALUES ('284', '3435', '20-2-7480201-0374', 'QTKD25', 'KQ: Không đạt môn QTKD25', '1621309306', 'nxtuyen.pro@gmail.com');
INSERT INTO `tbl_hoctap_note` VALUES ('285', '3447', '20-2-7480201-0172', 'QTKD25', 'KQ: Không đạt môn QTKD25', '1621310045', 'nxtuyen.pro@gmail.com');
INSERT INTO `tbl_hoctap_note` VALUES ('286', '3449', '20-2-7480201-0173', 'QTKD25', 'KQ: Không đạt môn QTKD25', '1621310045', 'nxtuyen.pro@gmail.com');
INSERT INTO `tbl_hoctap_note` VALUES ('287', '3446', '20-2-7480201-0174', 'QTKD25', 'KQ: Không đạt môn QTKD25', '1621310045', 'nxtuyen.pro@gmail.com');
INSERT INTO `tbl_hoctap_note` VALUES ('288', '3448', '20-2-7480201-0175', 'QTKD25', 'KQ: Không đạt môn QTKD25', '1621310045', 'nxtuyen.pro@gmail.com');
INSERT INTO `tbl_hoctap_note` VALUES ('289', '3442', '20-2-7480201-0176', 'QTKD25', 'KQ: Không đạt môn QTKD25', '1621310045', 'nxtuyen.pro@gmail.com');
INSERT INTO `tbl_hoctap_note` VALUES ('290', '3445', '20-2-7480201-0269', 'QTKD25', 'KQ: Không đạt môn QTKD25', '1621310045', 'nxtuyen.pro@gmail.com');
INSERT INTO `tbl_hoctap_note` VALUES ('291', '3444', '20-2-7480201-0270', 'QTKD25', 'KQ: Không đạt môn QTKD25', '1621310045', 'nxtuyen.pro@gmail.com');
INSERT INTO `tbl_hoctap_note` VALUES ('292', '3439', '20-2-7480201-0362', 'QTKD25', 'KQ: Không đạt môn QTKD25', '1621310045', 'nxtuyen.pro@gmail.com');
INSERT INTO `tbl_hoctap_note` VALUES ('293', '3436', '20-2-7480201-0363', 'QTKD25', 'KQ: Không đạt môn QTKD25', '1621310045', 'nxtuyen.pro@gmail.com');
INSERT INTO `tbl_hoctap_note` VALUES ('294', '3441', '20-2-7480201-0364', 'QTKD25', 'KQ: Không đạt môn QTKD25', '1621310045', 'nxtuyen.pro@gmail.com');
INSERT INTO `tbl_hoctap_note` VALUES ('295', '3438', '20-2-7480201-0368', 'QTKD25', 'KQ: Không đạt môn QTKD25', '1621310045', 'nxtuyen.pro@gmail.com');
INSERT INTO `tbl_hoctap_note` VALUES ('296', '3443', '20-2-7480201-0369', 'QTKD25', 'KQ: Không đạt môn QTKD25', '1621310045', 'nxtuyen.pro@gmail.com');
INSERT INTO `tbl_hoctap_note` VALUES ('297', '3437', '20-2-7480201-0370', 'QTKD25', 'KQ: Không đạt môn QTKD25', '1621310045', 'nxtuyen.pro@gmail.com');
INSERT INTO `tbl_hoctap_note` VALUES ('298', '3440', '20-2-7480201-0371', 'QTKD25', 'KQ: Không đạt môn QTKD25', '1621310045', 'nxtuyen.pro@gmail.com');
INSERT INTO `tbl_hoctap_note` VALUES ('299', '3435', '20-2-7480201-0374', 'QTKD25', 'KQ: Không đạt môn QTKD25', '1621310045', 'nxtuyen.pro@gmail.com');
INSERT INTO `tbl_hoctap_note` VALUES ('300', null, '20-2-7480201-0172', 'MC01', 'Cập nhật điểm: chuyên cần (8) điểm kiểm tra (9) điểm thi (8)', '1621322036', 'N/A');
INSERT INTO `tbl_hoctap_note` VALUES ('301', null, '20-2-7480201-0173', 'MC01', 'Cập nhật điểm: chuyên cần (7) điểm kiểm tra (6) điểm thi (6)', '1621322046', 'N/A');
INSERT INTO `tbl_hoctap_note` VALUES ('302', null, '20-2-7480201-0174', 'MC01', 'Cập nhật điểm: chuyên cần (6) điểm kiểm tra (6) điểm thi (6.5)', '1621322055', 'N/A');
INSERT INTO `tbl_hoctap_note` VALUES ('303', null, '20-2-7480201-0175', 'MC01', 'Cập nhật điểm: chuyên cần (8) điểm kiểm tra (6) điểm thi (6)', '1621322067', 'N/A');
INSERT INTO `tbl_hoctap_note` VALUES ('304', '3357', '20-2-7480201-0172', 'MC01', 'KQ: Đạt môn MC01', '1621322086', 'nxtuyen.pro@gmail.com');
INSERT INTO `tbl_hoctap_note` VALUES ('305', '3359', '20-2-7480201-0173', 'MC01', 'KQ: Đạt môn MC01', '1621322086', 'nxtuyen.pro@gmail.com');
INSERT INTO `tbl_hoctap_note` VALUES ('306', '3356', '20-2-7480201-0174', 'MC01', 'KQ: Đạt môn MC01', '1621322086', 'nxtuyen.pro@gmail.com');
INSERT INTO `tbl_hoctap_note` VALUES ('307', '3358', '20-2-7480201-0175', 'MC01', 'KQ: Đạt môn MC01', '1621322086', 'nxtuyen.pro@gmail.com');
INSERT INTO `tbl_hoctap_note` VALUES ('308', null, '20-2-7480201-0176', 'MC01', 'Cập nhật điểm: chuyên cần (5) điểm kiểm tra (6) điểm thi (5)', '1621322177', 'N/A');
INSERT INTO `tbl_hoctap_note` VALUES ('309', '3357', '20-2-7480201-0172', 'MC01', 'KQ: Đạt môn MC01', '1621322198', 'nxtuyen.pro@gmail.com');
INSERT INTO `tbl_hoctap_note` VALUES ('310', '3359', '20-2-7480201-0173', 'MC01', 'KQ: Đạt môn MC01', '1621322198', 'nxtuyen.pro@gmail.com');
INSERT INTO `tbl_hoctap_note` VALUES ('311', '3356', '20-2-7480201-0174', 'MC01', 'KQ: Đạt môn MC01', '1621322198', 'nxtuyen.pro@gmail.com');
INSERT INTO `tbl_hoctap_note` VALUES ('312', '3358', '20-2-7480201-0175', 'MC01', 'KQ: Đạt môn MC01', '1621322198', 'nxtuyen.pro@gmail.com');
INSERT INTO `tbl_hoctap_note` VALUES ('313', '3352', '20-2-7480201-0176', 'MC01', 'KQ: Đạt môn MC01', '1621322198', 'nxtuyen.pro@gmail.com');
INSERT INTO `tbl_hoctap_note` VALUES ('314', null, '20-2-7480201-0269', 'MC01', 'Cập nhật điểm: chuyên cần (4) điểm kiểm tra (4) điểm thi (2)', '1621322430', 'N/A');
INSERT INTO `tbl_hoctap_note` VALUES ('315', null, '20-2-7480201-0270', 'MC01', 'Cập nhật điểm: chuyên cần (3) điểm kiểm tra (3) điểm thi (3)', '1621322435', 'N/A');
INSERT INTO `tbl_hoctap_note` VALUES ('316', '3357', '20-2-7480201-0172', 'MC01', 'KQ: Đạt môn MC01', '1621322439', 'nxtuyen.pro@gmail.com');
INSERT INTO `tbl_hoctap_note` VALUES ('317', '3359', '20-2-7480201-0173', 'MC01', 'KQ: Đạt môn MC01', '1621322439', 'nxtuyen.pro@gmail.com');
INSERT INTO `tbl_hoctap_note` VALUES ('318', '3356', '20-2-7480201-0174', 'MC01', 'KQ: Đạt môn MC01', '1621322439', 'nxtuyen.pro@gmail.com');
INSERT INTO `tbl_hoctap_note` VALUES ('319', '3358', '20-2-7480201-0175', 'MC01', 'KQ: Đạt môn MC01', '1621322439', 'nxtuyen.pro@gmail.com');
INSERT INTO `tbl_hoctap_note` VALUES ('320', '3352', '20-2-7480201-0176', 'MC01', 'KQ: Đạt môn MC01', '1621322439', 'nxtuyen.pro@gmail.com');
INSERT INTO `tbl_hoctap_note` VALUES ('321', '3355', '20-2-7480201-0269', 'MC01', 'KQ: Không đạt môn MC01', '1621322439', 'nxtuyen.pro@gmail.com');
INSERT INTO `tbl_hoctap_note` VALUES ('322', '3354', '20-2-7480201-0270', 'MC01', 'KQ: Không đạt môn MC01', '1621322439', 'nxtuyen.pro@gmail.com');
INSERT INTO `tbl_hoctap_note` VALUES ('323', '3349', '20-2-7480201-0362', 'MC01', 'Đăng ký thi lại môn MC01', '1621322565', 'N/A');
INSERT INTO `tbl_hoctap_note` VALUES ('324', null, '20-2-7480201-0362', 'MC01', 'Cập nhật điểm: chuyên cần (3) điểm kiểm tra (3) điểm thi (3)', '1621323356', 'N/A');
INSERT INTO `tbl_hoctap_note` VALUES ('325', '3349', '20-2-7480201-0362', 'MC01', 'Đăng ký thi lại môn MC01', '1621323368', 'N/A');
INSERT INTO `tbl_hoctap_note` VALUES ('326', '3346', '20-2-7480201-0363', 'MC01', 'Đăng ký thi lại môn MC01', '1621323535', 'N/A');
INSERT INTO `tbl_hoctap_note` VALUES ('327', '3351', '20-2-7480201-0364', 'MC01', 'Đăng ký thi lại môn MC01', '1621323700', 'N/A');
INSERT INTO `tbl_hoctap_note` VALUES ('328', '3354', '20-2-7480201-0270', 'MC01', 'Nhập điểm thi lại: 3.55', '1621334259', 'N/A');
INSERT INTO `tbl_hoctap_note` VALUES ('329', '3354', '20-2-7480201-0270', 'MC01', 'Đăng ký học lại môn MC01', '1621351689', 'N/A');
INSERT INTO `tbl_hoctap_note` VALUES ('330', '3354', '20-2-7480201-0270', 'MC01', 'Đăng ký học lại môn MC01', '1621352663', 'nxtuyen.pro@gmail.com');
INSERT INTO `tbl_hoctap_note` VALUES ('331', null, '20-2-7480201-0172', '1000001', 'Cập nhật điểm: chuyên cần (10) điểm kiểm tra (6) điểm thi (7)', '1621390782', 'N/A');
INSERT INTO `tbl_hoctap_note` VALUES ('332', null, '20-2-7480201-0172', 'MC09', 'Cập nhật điểm: chuyên cần (7) điểm kiểm tra (7) điểm thi (7)', '1621391298', 'N/A');
INSERT INTO `tbl_hoctap_note` VALUES ('333', null, '21-2-7480201-0109', '1000001', 'Cập nhật điểm: chuyên cần (10) điểm kiểm tra (9) điểm thi (8)', '1622219332', 'N/A');
INSERT INTO `tbl_hoctap_note` VALUES ('334', null, '20-2-7480201-0270', 'MC01', 'Cập nhật điểm: chuyên cần (3) điểm kiểm tra (3) điểm thi (3)', '1622885667', 'N/A');
INSERT INTO `tbl_hoctap_note` VALUES ('335', null, '20-2-7480201-0270', 'MC01', 'Cập nhật điểm: chuyên cần (3) điểm kiểm tra (3) điểm thi (3)', '1622885672', 'N/A');
INSERT INTO `tbl_hoctap_note` VALUES ('336', null, '20-2-7480201-0270', 'MC01', 'Cập nhật điểm: chuyên cần (3) điểm kiểm tra (3) điểm thi (3)', '1622885675', 'N/A');
INSERT INTO `tbl_hoctap_note` VALUES ('337', null, '20-2-7480201-0270', 'MC01', 'Cập nhật điểm: chuyên cần (3) điểm kiểm tra (3) điểm thi (3)', '1622885831', 'N/A');
INSERT INTO `tbl_hoctap_note` VALUES ('338', null, '20-2-7480201-0270', 'MC01', 'Cập nhật điểm: chuyên cần (3) điểm kiểm tra (3) điểm thi (3)', '1622885969', 'N/A');
INSERT INTO `tbl_hoctap_note` VALUES ('339', null, '20-2-7480201-0270', 'MC01', 'Cập nhật điểm: chuyên cần (3) điểm kiểm tra (3) điểm thi (3)', '1622885987', 'N/A');
INSERT INTO `tbl_hoctap_note` VALUES ('340', null, '20-2-7480201-0270', 'MC01', 'Cập nhật điểm: chuyên cần (3) điểm kiểm tra (3) điểm thi (3)', '1622886126', 'N/A');
INSERT INTO `tbl_hoctap_note` VALUES ('341', null, '20-2-7480201-0176', 'MC01', 'Cập nhật điểm: chuyên cần (5) điểm kiểm tra (6) điểm thi (5)', '1622886202', 'N/A');

-- ----------------------------
-- Table structure for tbl_hoctap_warning
-- ----------------------------
DROP TABLE IF EXISTS `tbl_hoctap_warning`;
CREATE TABLE `tbl_hoctap_warning` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `masv` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_hoctap` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_hoctap_warning
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_khoa
-- ----------------------------
DROP TABLE IF EXISTS `tbl_khoa`;
CREATE TABLE `tbl_khoa` (
  `id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `type` tinyint(4) DEFAULT '1',
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `startDay` int(11) DEFAULT '1',
  `quan` int(11) DEFAULT NULL,
  `hocphi` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_khoa
-- ----------------------------
INSERT INTO `tbl_khoa` VALUES ('2020', '0', 'Khóa 2020-2021', '1577811600', '60', '0');
INSERT INTO `tbl_khoa` VALUES ('2021', '0', 'Khóa 2021', '1609434000', '60', null);
INSERT INTO `tbl_khoa` VALUES ('AUM0121HC', '1', 'AUM0121HC', '1', null, null);
INSERT INTO `tbl_khoa` VALUES ('AUM0121HN', '1', 'AUM0121HN', '1', null, null);
INSERT INTO `tbl_khoa` VALUES ('AUM0220HC', '1', 'AUM0220HC', '1', null, null);
INSERT INTO `tbl_khoa` VALUES ('AUM0220HN', '1', 'AUM0220HN', '1', null, null);
INSERT INTO `tbl_khoa` VALUES ('AUM0221HN', '1', 'AUM0221HN', '1', null, null);
INSERT INTO `tbl_khoa` VALUES ('AUM0320HC', '1', 'AUM0320HC', '1', null, null);
INSERT INTO `tbl_khoa` VALUES ('AUM0320HN', '1', 'AUM0320HN', '1', null, null);
INSERT INTO `tbl_khoa` VALUES ('AUM0420HC', '1', 'AUM0420HC', '1', null, null);
INSERT INTO `tbl_khoa` VALUES ('AUM0420HN', '1', 'AUM0420HN', '1', null, null);
INSERT INTO `tbl_khoa` VALUES ('AUM0520HC', '1', 'AUM0520HC', '1', null, null);
INSERT INTO `tbl_khoa` VALUES ('AUM0520HN', '1', 'AUM0520HN', '1', null, null);
INSERT INTO `tbl_khoa` VALUES ('AUM0620HC', '1', 'AUM0620HC', '1', null, null);
INSERT INTO `tbl_khoa` VALUES ('AUM0620HN', '1', 'AUM0620HN', '1', null, null);

-- ----------------------------
-- Table structure for tbl_khoa_nganh
-- ----------------------------
DROP TABLE IF EXISTS `tbl_khoa_nganh`;
CREATE TABLE `tbl_khoa_nganh` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_khoa` varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
  `id_nganh` varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
  `id_he` varchar(50) COLLATE utf8_unicode_ci DEFAULT '1',
  `note` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_khoa_nganh
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_logs
-- ----------------------------
DROP TABLE IF EXISTS `tbl_logs`;
CREATE TABLE `tbl_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) DEFAULT NULL,
  `config` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_logs
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_lop
-- ----------------------------
DROP TABLE IF EXISTS `tbl_lop`;
CREATE TABLE `tbl_lop` (
  `id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `id_nganh` varchar(50) COLLATE utf8_unicode_ci DEFAULT '1',
  `id_he` varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
  `id_khoa` varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gvcn` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `permission` text COLLATE utf8_unicode_ci,
  `opendate` int(11) DEFAULT NULL,
  `cdate` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_nganh` (`id_nganh`),
  KEY `idx_he` (`id_he`),
  KEY `idx_khoa` (`id_khoa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_lop
-- ----------------------------
INSERT INTO `tbl_lop` VALUES ('AUM0121HCTCBK', 'TCNH', 'AUM', '2020', 'AUM0121HCTCBK', null, null, '1621575379', '1621575379', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0121HNCNAC', '111', 'AUM', 'AUM0121HN', 'AUM0121HNCNAC', null, null, '1619517235', '1619517235', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0121HNCNAK', '111', 'AUM', 'AUM0121HN', 'AUM0121HNCNAK', null, null, '1619517235', '1619517235', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0121HNCNBK', '111', 'AUM', 'AUM0121HN', 'AUM0121HNCNBK', null, null, '1619517235', '1619517235', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0121HNCNCX', '111', 'AUM', 'AUM0121HN', 'AUM0121HNCNCX', null, null, '1619517252', '1619517252', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0121HNCNDX', '111', 'AUM', 'AUM0121HN', 'AUM0121HNCNDX', null, null, '1619517235', '1619517235', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0121HNTCBK', 'TCNH', 'AUM', 'AUM0121HN', 'AUM0121HNTCBK', null, null, '1621575379', '1621575379', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0202HNCNBK', '111', 'AUM', 'AUM0220HN', 'AUM0202HNCNBK', null, null, '1619517241', '1619517241', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0202HNCNCX', '111', 'AUM', 'AUM0220HN', 'AUM0202HNCNCX', null, null, '1619517251', '1619517251', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0202HNCNDX', '111', 'AUM', 'AUM0220HN', 'AUM0202HNCNDX', null, null, '1619517249', '1619517249', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0220HCCNBC', '111', 'AUM', 'AUM0220HC', 'AUM0220HCCNBC', null, null, '1619517240', '1619517240', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0220HCCNBK', '111', 'AUM', 'AUM0220HC', 'AUM0220HCCNBK', null, null, '1619517239', '1619517239', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0220HCCNCX', '111', 'AUM', 'AUM0220HC', 'AUM0220HCCNCX', null, null, '1619517239', '1619517239', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0220HCCNDX', '111', 'AUM', 'AUM0220HC', 'AUM0220HCCNDX', null, null, '1619517239', '1619517239', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0220HNCNAC', '111', 'AUM', 'AUM0220HN', 'AUM0220HNCNAC', null, null, '1619517248', '1619517248', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0220HNCNAK', '111', 'AUM', 'AUM0220HN', 'AUM0220HNCNAK', null, null, '1619517243', '1619517243', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0220HNCNBC', '111', 'AUM', 'AUM0220HN', 'AUM0220HNCNBC', null, null, '1619517243', '1619517243', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0220HNCNBK', '111', 'AUM', 'AUM0220HN', 'AUM0220HNCNBK', null, null, '1619517242', '1619517242', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0220HNCNCX', '111', 'AUM', 'AUM0220HN', 'AUM0220HNCNCX', null, null, '1619517241', '1619517241', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0220HNCNDX', '111', 'AUM', 'AUM0220HN', 'AUM0220HNCNDX', null, null, '1619517241', '1619517241', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0221HNTCBC', 'TCNH', 'AUM', 'AUM0121HN', 'AUM0221HNTCBC', null, null, '1621575379', '1621575379', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0320HCCNAC', '111', 'AUM', 'AUM0320HC', 'AUM0320HCCNAC', null, null, '1619517238', '1619517238', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0320HCCNAK', '111', 'AUM', 'AUM0320HC', 'AUM0320HCCNAK', null, null, '1619517238', '1619517238', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0320HCCNBC', '111', 'AUM', 'AUM0320HC', 'AUM0320HCCNBC', null, null, '1619517238', '1619517238', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0320HCCNBK', '111', 'AUM', 'AUM0320HC', 'AUM0320HCCNBK', null, null, '1619517239', '1619517239', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0320HCCNCX', '111', 'AUM', 'AUM0320HC', 'AUM0320HCCNCX', null, null, '1619517238', '1619517238', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0320HCCNDX', '111', 'AUM', 'AUM0320HC', 'AUM0320HCCNDX', null, null, '1619517238', '1619517238', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0320HCQTBK', '111', 'AUM', 'AUM0320HC', 'AUM0320HCQTBK', null, null, '1619517245', '1619517245', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0320HCTCAK', 'TCNH', 'AUM', 'AUM0320HC', 'AUM0320HCTCAK', null, null, '1621575379', '1621575379', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0320HNCNAC', '111', 'AUM', 'AUM0320HN', 'AUM0320HNCNAC', null, null, '1619517240', '1619517240', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0320HNCNAK', '111', 'AUM', 'AUM0320HN', 'AUM0320HNCNAK', null, null, '1619517238', '1619517238', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0320HNCNBC', '111', 'AUM', 'AUM0320HN', 'AUM0320HNCNBC', null, null, '1619517239', '1619517239', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0320HNCNBK', '111', 'AUM', 'AUM0320HN', 'AUM0320HNCNBK', null, null, '1619517239', '1619517239', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0320HNCNCX', '111', 'AUM', 'AUM0320HN', 'AUM0320HNCNCX', null, null, '1619517239', '1619517239', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0320HNCNDX', '111', 'AUM', 'AUM0320HN', 'AUM0320HNCNDX', null, null, '1619517238', '1619517238', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0320HNTCBC', 'TCNH', 'AUM', 'AUM0320HN', 'AUM0320HNTCBC', null, null, '1621575379', '1621575379', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0420HCCNAK', '111', 'AUM', 'AUM0420HC', 'AUM0420HCCNAK', null, null, '1619517237', '1619517237', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0420HCCNBC', '111', 'AUM', 'AUM0420HC', 'AUM0420HCCNBC', null, null, '1619517237', '1619517237', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0420HCCNBK', '111', 'AUM', 'AUM0420HC', 'AUM0420HCCNBK', null, null, '1619517237', '1619517237', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0420HCCNCX', '111', 'AUM', 'AUM0420HC', 'AUM0420HCCNCX', null, null, '1619517239', '1619517239', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0420HCCNDX', '111', 'AUM', 'AUM0420HC', 'AUM0420HCCNDX', null, null, '1619517237', '1619517237', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0420HNCNAK', '111', 'AUM', 'AUM0420HN', 'AUM0420HNCNAK', null, null, '1619517237', '1619517237', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0420HNCNBC', '111', 'AUM', 'AUM0420HN', 'AUM0420HNCNBC', null, null, '1619517237', '1619517237', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0420HNCNBK', '111', 'AUM', 'AUM0420HN', 'AUM0420HNCNBK', null, null, '1619517237', '1619517237', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0420HNCNCX', '111', 'AUM', 'AUM0420HN', 'AUM0420HNCNCX', null, null, '1619517237', '1619517237', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0420HNCNDK', '111', 'AUM', 'AUM0420HN', 'AUM0420HNCNDK', null, null, '1619517237', '1619517237', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0420HNCNDX', '111', 'AUM', 'AUM0420HN', 'AUM0420HNCNDX', null, null, '1619517237', '1619517237', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0420HNTCAK', 'TCNH', 'AUM', 'AUM0420HN', 'AUM0420HNTCAK', null, null, '1621575379', '1621575379', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0420HNTCBC', 'TCNH', 'AUM', 'AUM0420HN', 'AUM0420HNTCBC', null, null, '1621575379', '1621575379', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0420HNTCDX', 'TCNH', 'AUM', 'AUM0420HN', 'AUM0420HNTCDX', null, null, '1621575379', '1621575379', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0520HCCNAK', '111', 'AUM', 'AUM0520HC', 'AUM0520HCCNAK', null, null, '1619517236', '1619517236', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0520HCCNBC', '111', 'AUM', 'AUM0520HC', 'AUM0520HCCNBC', null, null, '1619517239', '1619517239', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0520HCCNBK', '111', 'AUM', 'AUM0520HC', 'AUM0520HCCNBK', null, null, '1619517236', '1619517236', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0520HCCNCX', '111', 'AUM', 'AUM0520HC', 'AUM0520HCCNCX', null, null, '1619517236', '1619517236', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0520HCCNDX', '111', 'AUM', 'AUM0520HC', 'AUM0520HCCNDX', null, null, '1619517236', '1619517236', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0520HCTCAK', 'TCNH', 'AUM', 'AUM0520HC', 'AUM0520HCTCAK', null, null, '1621575379', '1621575379', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0520HCTCBC', 'TCNH', 'AUM', 'AUM0520HC', 'AUM0520HCTCBC', null, null, '1621575379', '1621575379', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0520HCTCDX', 'TCNH', 'AUM', 'AUM0520HC', 'AUM0520HCTCDX', null, null, '1621575379', '1621575379', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0520HNCNAC', '111', 'AUM', 'AUM0520HN', 'AUM0520HNCNAC', null, null, '1619517236', '1619517236', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0520HNCNAK', '111', 'AUM', 'AUM0520HN', 'AUM0520HNCNAK', null, null, '1619517236', '1619517236', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0520HNCNBC', '111', 'AUM', 'AUM0520HN', 'AUM0520HNCNBC', null, null, '1619517236', '1619517236', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0520HNCNBK', '111', 'AUM', 'AUM0520HN', 'AUM0520HNCNBK', null, null, '1619517236', '1619517236', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0520HNCNCX', '111', 'AUM', 'AUM0520HN', 'AUM0520HNCNCX', null, null, '1619517236', '1619517236', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0520HNCNDX', '111', 'AUM', 'AUM0520HN', 'AUM0520HNCNDX', null, null, '1619517236', '1619517236', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0520HNTCAC', 'TCNH', 'AUM', 'AUM0520HN', 'AUM0520HNTCAC', null, null, '1621575379', '1621575379', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0520HNTCAK', 'TCNH', 'AUM', 'AUM0520HN', 'AUM0520HNTCAK', null, null, '1621575379', '1621575379', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0520HNTCDX', 'TCNH', 'AUM', 'AUM0520HN', 'AUM0520HNTCDX', null, null, '1621575379', '1621575379', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0620HCCNAC', '111', 'AUM', 'AUM0620HC', 'AUM0620HCCNAC', null, null, '1619517235', '1619517235', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0620HCCNBC', '111', 'AUM', 'AUM0620HC', 'AUM0620HCCNBC', null, null, '1619517235', '1619517235', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0620HCCNBK', '111', 'AUM', 'AUM0620HC', 'AUM0620HCCNBK', null, null, '1619517236', '1619517236', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0620HCCNCX', '111', 'AUM', 'AUM0620HC', 'AUM0620HCCNCX', null, null, '1619517235', '1619517235', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0620HCCNDX', '111', 'AUM', 'AUM0620HC', 'AUM0620HCCNDX', null, null, '1619517235', '1619517235', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0620HCTCAK', 'TCNH', 'AUM', 'AUM0620HC', 'AUM0620HCTCAK', null, null, '1621575379', '1621575379', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0620HCTCBC', 'TCNH', 'AUM', 'AUM0620HC', 'AUM0620HCTCBC', null, null, '1621575379', '1621575379', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0620HNCNAC', '111', 'AUM', 'AUM0620HN', 'AUM0620HNCNAC', null, null, '1619517235', '1619517235', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0620HNCNAK', '111', 'AUM', 'AUM0620HN', 'AUM0620HNCNAK', null, null, '1619517235', '1619517235', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0620HNCNBC', '111', 'AUM', 'AUM0620HN', 'AUM0620HNCNBC', null, null, '1619517236', '1619517236', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0620HNCNBK', '111', 'AUM', 'AUM0620HN', 'AUM0620HNCNBK', null, null, '1619517235', '1619517235', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0620HNCNCX', '111', 'AUM', 'AUM0620HN', 'AUM0620HNCNCX', null, null, '1619517235', '1619517235', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0620HNCNDX', '111', 'AUM', 'AUM0620HN', 'AUM0620HNCNDX', null, null, '1619517236', '1619517236', '0');
INSERT INTO `tbl_lop` VALUES ('AUM0620HNTCDX', 'TCNH', 'AUM', 'AUM0620HN', 'AUM0620HNTCDX', null, null, '1621575379', '1621575379', '0');
INSERT INTO `tbl_lop` VALUES ('C211', '111', 'AUM', '2021', 'C211', null, null, '1622197392', '1622197392', '0');
INSERT INTO `tbl_lop` VALUES ('el1_lkt11', '116', 'AUM', '2020', 'el1_lkt11', null, null, '1599788648', '1599788648', '0');
INSERT INTO `tbl_lop` VALUES ('el1_qlnn11', '122', 'AUM', '2020', 'el1_qlnn11', null, null, '1599788672', '1599788672', '0');
INSERT INTO `tbl_lop` VALUES ('el1_qtkd11', '114', 'AUM', '2020', 'el1_qtkd11', null, null, '1599788603', '1599788603', '0');
INSERT INTO `tbl_lop` VALUES ('el21_lkt11', '116', 'AUM', '2020', 'el21_lkt11', null, null, '1609727005', '1609727005', '0');
INSERT INTO `tbl_lop` VALUES ('el22_lkt11', '116', 'AUM', '2020', 'el22_lkt11', null, null, '1609727033', '1609727033', '0');
INSERT INTO `tbl_lop` VALUES ('el3_lkt11', '116', 'AUM', '2020', 'el3_lkt11', null, null, '1610936848', '1610936848', '0');
INSERT INTO `tbl_lop` VALUES ('el4_lkt11', '116', 'AUM', '2020', 'el4_lkt11', null, null, '1609727056', '1609727056', '0');
INSERT INTO `tbl_lop` VALUES ('LKT211', '116', 'AUM', '2021', 'LKT211', null, null, '1622197392', '1622197392', '0');
INSERT INTO `tbl_lop` VALUES ('ML1', 'NNA', 'AUM', '2021', 'ML1', null, null, null, '1623982788', '0');
INSERT INTO `tbl_lop` VALUES ('ML10', 'TCNH', 'AUM', '2021', 'ML10', null, null, null, '1623983968', '0');
INSERT INTO `tbl_lop` VALUES ('ML4', '116', 'AUM', '2021', 'ML4', null, null, null, '1623982788', '0');
INSERT INTO `tbl_lop` VALUES ('ML5', 'NNA', 'AUM', '2021', 'ML5', null, null, null, '1623982788', '0');
INSERT INTO `tbl_lop` VALUES ('ML6', '116', 'AUM', '2021', 'ML6', null, null, null, '1623982788', '0');
INSERT INTO `tbl_lop` VALUES ('ML7', 'NNA', 'AUM', '2021', 'ML7', null, null, null, '1623983968', '0');
INSERT INTO `tbl_lop` VALUES ('ML8', '114', 'AUM', '2021', 'ML8', null, null, null, '1623983968', '0');
INSERT INTO `tbl_lop` VALUES ('ML9', '122', 'AUM', '2021', 'ML9', null, null, null, '1623983968', '0');
INSERT INTO `tbl_lop` VALUES ('test-1', '111', 'AUM', '2020', 'test-1', null, null, '1619748733', '1619748733', '0');
INSERT INTO `tbl_lop` VALUES ('TNU_LOP1', 'NNA', 'AUM', '2021', 'TNU_LOP1', null, null, null, '1623924632', '0');

-- ----------------------------
-- Table structure for tbl_monhoc
-- ----------------------------
DROP TABLE IF EXISTS `tbl_monhoc`;
CREATE TABLE `tbl_monhoc` (
  `id` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ttn` tinyint(4) DEFAULT NULL,
  `intro` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_monhoc
-- ----------------------------
INSERT INTO `tbl_monhoc` VALUES ('1000001', 'Nhập môn E-Learning', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('LKT01', 'Kỹ năng soạn thảo và ban hành văn bản', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('LKT02', 'Luật dân sự Việt Nam 1', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('LKT03', 'Luật dân sự Việt Nam 2', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('LKT04', 'Pháp luật phòng chống tham nhũng', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('LKT05', 'Lịch sử nhà nước và pháp luật', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('LKT06', 'Luật thương mại Việt Nam 1', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('LKT07', 'Luật thương mại Việt Nam 2', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('LKT08', 'Luật lao động Việt Nam', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('LKT09', 'Luật tài chính Việt Nam', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('LKT10', 'Luật ngân hàng Việt Nam', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('LKT11', 'Luật đất đai Việt Nam', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('LKT12', 'Luật môi trường', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('LKT13', 'Luật cạnh tranh', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('LKT14', 'Luật sở hữu trí tuệ', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('LKT15', 'Luật tố tụng dân sự Việt Nam', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('LKT16', 'Luật hình sự Việt Nam', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('LKT17', 'Luật hôn nhân và gia đình', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('LKT18', 'Luật đầu tư', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('LKT19', 'Pháp luật bảo vệ quyền lợi người tiêu dùng', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('LKT20', 'Luật thuế Việt Nam', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('LKT21', 'Luật chứng khoán', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('LKT22', 'Luật kinh doanh bảo hiểm', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('LKT23', 'Luật kinh doanh bất động sản', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('LKT24', 'Pháp luật môi trường trong kinh doanh', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('LKT25', 'Pháp luật về thương mại điện tử', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('LKT26', 'Luật thương mại quốc tế', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('LKT27', 'Luật du lịch', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('LKT28', 'Kỹ năng tư vấn pháp luật thuế', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('LKT29', 'Kỹ năng tư vấn trong lĩnh vực đất đai', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('LKT30', 'Kỹ năng giải quyết các vụ án lao động', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('LKT31', 'Tiếng anh chuyên ngành luật', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('MC01', 'Triết học Mác Lênin', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('MC02', 'Kinh tế chính trị Mác Lênin', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('MC03', 'Chủ nghĩa xã hội khoa học', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('MC04', 'Tư tưởng Hồ Chí Minh', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('MC05', 'Lịch sử Đảng cộng sản Việt Nam', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('MC06', 'Tiếng anh cơ bản 1', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('MC07', 'Tiếng anh cơ bản 2', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('MC08', 'Tiếng anh cơ bản 3', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('MC09', 'Tin đại cương', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('MC10', 'Kỹ năng mềm', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('MC11', 'Phương pháp nghiên cứu khoa học', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('MC12', 'Khởi nghiệp', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('MC13', 'Lịch sử văn minh thế giới', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('MC14', 'Kinh tế vi mô', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('MC15', 'Kinh tế vĩ mô', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('MC16', 'Marketing căn bản', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('MC17', 'Lý luận nhà nước và pháp luật', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('MC18', 'Luật hiến pháp Việt Nam', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('MC19', 'Luật hành chính Việt Nam', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('MC20', 'Kỹ thuật soạn thảo và ban hành văn bản', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('MC21', 'Quản trị học', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('QLNN01', 'Xã hội học đại cương', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('QLNN02', 'Tâm lý học đại cương', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('QLNN03', 'Cơ sở văn hoá Việt Nam', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('QLNN04', 'Logic học đại cương', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('QLNN05', 'Văn hoá công sở', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('QLNN06', 'Phát triển cộng đồng', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('QLNN07', 'Luật lao động', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('QLNN08', 'Pháp luật về cán bộ, công chức, viên chức', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('QLNN09', 'Khoa học quản lý', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('QLNN10', 'Lịch sử nhà nước và pháp luật Việt Nam', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('QLNN11', 'Tiếng anh chuyên ngành QLNN 1', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('QLNN12', 'Hành chính công', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('QLNN13', 'Tổ chức bộ máy hành chính nhà nước', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('QLNN14', 'Hoạch định và phân tích chính sách công', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('QLNN15', 'Tài chính công', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('QLNN16', 'Nghiệp vụ văn thư', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('QLNN17', 'Nghiệp vụ lưu trữ', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('QLNN18', 'Thủ tục hành chính', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('QLNN19', 'Tiếng anh chuyên ngành QLNN 2', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('QLNN20', 'Thông tin trong quản lý hành chính nhà nước', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('QLNN21', 'Kế toán hành chính sự nghiệp', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('QLNN22', 'Kỹ năng giao tiếp hành chính', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('QLNN23', 'Quản lý nhà nước về đầu tư', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('QLNN24', 'Quản lý nhà nước về kinh tế trong hội nhập kinh tế quốc tế', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('QLNN25', 'Quản lý nhà nước về hành chính tư pháp', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('QLNN26', 'Quản lý nhà nước về thương mại', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('QLNN27', 'Quản lý nhà nước về đô thị và nông thôn', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('QLNN28', 'Quản lý nhà nước về văn hoá, giáo dục, đào tạo và y tế', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('QLNN29', 'Quản lý nhà nước về tôn giáo và dân tộc', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('QLNN30', 'Quản lý nhà nước về an ninh quốc phòng', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('QLNN31', 'Quản lý chi tiêu công', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('QLNN32', 'Quản lý nhà nước về tài nguyên và môi trường', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('QLNN33', 'Quản lý dự án', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('QLNN34', 'Công vụ, công chức và đạo đức công vụ', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('QLNN35', 'Thanh tra và giải quyết khiếu nại hành chính', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('QLNN36', 'Chính phủ điện tử', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('QLNN37', 'Chuyên ngành quản lý nhà nước ở cấp xã', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('QTKD01', 'Toán kinh tế', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('QTKD02', 'Luật kinh tế', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('QTKD03', 'Nguyên lý kế toán', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('QTKD04', 'Thuế', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('QTKD05', 'Nguyên lý thống kê kinh tế', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('QTKD06', 'Tài chính tiền tệ', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('QTKD07', 'Tiếng anh chuyên ngành QTKD', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('QTKD08', 'Tài chính doanh nghiệp', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('QTKD09', 'Quản trị chiến lược', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('QTKD10', 'Quản trị Marketing', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('QTKD11', 'Quản trị sản xuất', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('QTKD12', 'Quản trị nhân lực', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('QTKD13', 'Lập và quản lý dự án đầu tư', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('QTKD14', 'Hệ thống thông tin quản lý', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('QTKD15', 'Quản trị chất lượng', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('QTKD16', 'Quản trị chuỗi cung ứng', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('QTKD17', 'Quản trị kinh doanh quốc tế', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('QTKD18', 'Quản trị thương hiệu', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('QTKD19', 'Phát triển kỹ năng quản trị', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('QTKD20', 'Quan hệ công chúng', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('QTKD21', 'Giao tiếp và lễ tân ngoại giao', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('QTKD22', 'Hành vi người tiêu dùng', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('QTKD23', 'Nhượng quyền thương mại', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('QTKD24', 'Định giá tài sản', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('QTKD25', 'Thương mại điện tử', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('QTKD26', 'Trách nhiệm xã hội của doanh nghiệp', '0', null);
INSERT INTO `tbl_monhoc` VALUES ('QTKD27', 'Nghệ thuật lãnh đạo tổ chức', '0', null);

-- ----------------------------
-- Table structure for tbl_nganh
-- ----------------------------
DROP TABLE IF EXISTS `tbl_nganh`;
CREATE TABLE `tbl_nganh` (
  `id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `id_bo` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_nganh
-- ----------------------------
INSERT INTO `tbl_nganh` VALUES ('111', '52340101', 'Công nghệ thông tin');
INSERT INTO `tbl_nganh` VALUES ('114', '52340101', 'Quản trị kinh doanh');
INSERT INTO `tbl_nganh` VALUES ('116', '52380107', 'Luật kinh tế');
INSERT INTO `tbl_nganh` VALUES ('122', '52310205', 'Quản lý nhà nước');
INSERT INTO `tbl_nganh` VALUES ('TCNH', 'TCNH', 'Tài chính ngân hàng');

-- ----------------------------
-- Table structure for tbl_notify
-- ----------------------------
DROP TABLE IF EXISTS `tbl_notify`;
CREATE TABLE `tbl_notify` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) DEFAULT NULL,
  `id_hoso` varchar(50) DEFAULT NULL,
  `masv` varchar(50) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `cdate` int(11) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `isactive` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4350 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_notify
-- ----------------------------
INSERT INTO `tbl_notify` VALUES ('3052', null, '', '', 'Thêm dm học phí chung: Lệ phí xét tuyển, nhập học', '1599634423', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3053', null, '', '', 'Thêm dm học phí chung: Đào tạo nhập môn E-learning', '1599634440', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3054', null, '', '', 'Thêm dm học phí chung: Thẻ sinh viên', '1599634458', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3055', null, '', '', 'Mã ngành 116 vừa được tạo thành công', '1599634883', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3056', null, '', '', 'Mã ngành 114 vừa được tạo thành công', '1599634919', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3057', null, '', '', 'Mã ngành 122 vừa được tạo thành công', '1599635042', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3058', null, '', '', 'Thêm chương trình khung: MC01 (ngành 114, hệ AUM)', '1599637653', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3059', null, '', '', 'Thêm chương trình khung: MC02 (ngành 114, hệ AUM)', '1599638080', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3060', null, '', '', 'Thêm chương trình khung: MC03 (ngành 114, hệ AUM)', '1599638101', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3061', null, '', '', 'Thêm chương trình khung: MC04 (ngành 114, hệ AUM)', '1599638160', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3062', null, '', '', 'Thêm chương trình khung: MC05 (ngành 114, hệ AUM)', '1599638226', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3063', null, '', '', 'Thêm chương trình khung: MC06 (ngành 114, hệ AUM)', '1599638331', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3064', null, '', '', 'Thêm chương trình khung: MC07 (ngành 114, hệ AUM)', '1599638369', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3065', null, '', '', 'Thêm chương trình khung: MC08 (ngành 114, hệ AUM)', '1599638400', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3066', null, '', '', 'Thêm chương trình khung: MC09 (ngành 114, hệ AUM)', '1599638452', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3067', null, '', '', 'Thêm chương trình khung: MC10 (ngành 114, hệ AUM)', '1599721699', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3068', null, '', '', 'Thêm chương trình khung: MC11 (ngành 114, hệ AUM)', '1599721729', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3069', null, '', '', 'Thêm chương trình khung: MC12 (ngành 114, hệ AUM)', '1599721764', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3070', null, '', '', 'Thêm chương trình khung: LKT01 (ngành 114, hệ AUM)', '1599721806', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3071', null, '', '', 'Thêm chương trình khung: MC20 (ngành 114, hệ AUM)', '1599721885', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3072', null, '', '', 'Thêm chương trình khung: QTKD01 (ngành 114, hệ AUM)', '1599721999', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3073', null, '', '', 'Thêm chương trình khung: QTKD02 (ngành 114, hệ AUM)', '1599722063', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3074', null, '', '', 'Thêm chương trình khung: MC14 (ngành 114, hệ AUM)', '1599722139', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3075', null, '', '', 'Thêm chương trình khung: MC15 (ngành 114, hệ AUM)', '1599722163', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3076', null, '', '', 'Thêm chương trình khung: QTKD03 (ngành 114, hệ AUM)', '1599722212', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3077', null, '', '', 'Thêm chương trình khung: QTKD04 (ngành 114, hệ AUM)', '1599722232', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3078', null, '', '', 'Thêm chương trình khung: MC21 (ngành 114, hệ AUM)', '1599722287', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3079', null, '', '', 'Thêm chương trình khung: MC16 (ngành 114, hệ AUM)', '1599722333', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3080', null, '', '', 'Thêm chương trình khung: QTKD05 (ngành 114, hệ AUM)', '1599722366', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3081', null, '', '', 'Thêm chương trình khung: QTKD06 (ngành 114, hệ AUM)', '1599722434', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3082', null, '', '', 'Thêm chương trình khung: QTKD07 (ngành 114, hệ AUM)', '1599722620', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3083', null, '', '', 'Thêm chương trình khung: QTKD08 (ngành 114, hệ AUM)', '1599722842', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3084', null, '', '', 'Thêm chương trình khung: QTKD09 (ngành 114, hệ AUM)', '1599722908', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3085', null, '', '', 'Thêm chương trình khung: QTKD10 (ngành 114, hệ AUM)', '1599722931', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3086', null, '', '', 'Thêm chương trình khung: QTKD11 (ngành 114, hệ AUM)', '1599722952', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3087', null, '', '', 'Thêm chương trình khung: QTKD12 (ngành 114, hệ AUM)', '1599722981', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3088', null, '', '', 'Thêm chương trình khung: QTKD13 (ngành 114, hệ AUM)', '1599723091', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3089', null, '', '', 'Thêm chương trình khung: QTKD14 (ngành 114, hệ AUM)', '1599723129', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3090', null, '', '', 'Thêm chương trình khung: QTKD15 (ngành 114, hệ AUM)', '1599723152', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3091', null, '', '', 'Thêm chương trình khung: QTKD16 (ngành 114, hệ AUM)', '1599723172', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3092', null, '', '', 'Thêm chương trình khung: QTKD17 (ngành 114, hệ AUM)', '1599723195', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3093', null, '', '', 'Thêm chương trình khung: QTKD18 (ngành 114, hệ AUM)', '1599723213', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3094', null, '', '', 'Thêm chương trình khung: QTKD19 (ngành 114, hệ AUM)', '1599723254', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3095', null, '', '', 'Thêm chương trình khung: QTKD20 (ngành 114, hệ AUM)', '1599723277', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3096', null, '', '', 'Thêm chương trình khung: QTKD21 (ngành 114, hệ AUM)', '1599723320', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3097', null, '', '', 'Thêm chương trình khung: QTKD22 (ngành 114, hệ AUM)', '1599723347', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3098', null, '', '', 'Thêm chương trình khung: QTKD23 (ngành 114, hệ AUM)', '1599723366', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3099', null, '', '', 'Thêm chương trình khung: QTKD24 (ngành 114, hệ AUM)', '1599723389', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3100', null, '', '', 'Thêm chương trình khung: QTKD25 (ngành 114, hệ AUM)', '1599723411', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3101', null, '', '', 'Thêm chương trình khung: QTKD26 (ngành 114, hệ AUM)', '1599723434', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3102', null, '', '', 'Thêm chương trình khung: QTKD27 (ngành 114, hệ AUM)', '1599723450', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3103', null, '', '', 'Thêm chương trình khung: MC01 (ngành 116, hệ AUM)', '1599723786', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3104', null, '', '', 'Thêm chương trình khung: MC02 (ngành 116, hệ AUM)', '1599723807', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3105', null, '', '', 'Thêm chương trình khung: MC03 (ngành 116, hệ AUM)', '1599724177', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3106', null, '', '', 'Thêm chương trình khung: MC04 (ngành 116, hệ AUM)', '1599724366', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3107', null, '', '', 'Thêm chương trình khung: MC05 (ngành 116, hệ AUM)', '1599724392', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3108', null, '', '', 'Thêm chương trình khung: MC06 (ngành 116, hệ AUM)', '1599724434', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3109', null, '', '', 'Thêm chương trình khung: MC07 (ngành 116, hệ AUM)', '1599724453', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3110', null, '', '', 'Thêm chương trình khung: MC08 (ngành 116, hệ AUM)', '1599724489', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3111', null, '', '', 'Thêm chương trình khung: MC09 (ngành 116, hệ AUM)', '1599724509', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3112', null, '', '', 'Thêm chương trình khung: MC10 (ngành 116, hệ AUM)', '1599724534', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3113', null, '', '', 'Thêm chương trình khung: LKT01 (ngành 116, hệ AUM)', '1599724557', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3114', null, '', '', 'Thêm chương trình khung: MC11 (ngành 116, hệ AUM)', '1599724595', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3115', null, '', '', 'Thêm chương trình khung: MC12 (ngành 116, hệ AUM)', '1599724616', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3116', null, '', '', 'Thêm chương trình khung: MC13 (ngành 116, hệ AUM)', '1599724648', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3117', null, '', '', 'Thêm chương trình khung: MC14 (ngành 116, hệ AUM)', '1599724669', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3118', null, '', '', 'Thêm chương trình khung: MC15 (ngành 116, hệ AUM)', '1599724684', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3119', null, '', '', 'Thêm chương trình khung: MC16 (ngành 116, hệ AUM)', '1599724705', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3120', null, '', '', 'Thêm chương trình khung: MC18 (ngành 116, hệ AUM)', '1599724752', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3121', null, '', '', 'Thêm chương trình khung: MC19 (ngành 116, hệ AUM)', '1599725075', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3122', null, '', '', 'Thêm chương trình khung: LKT02 (ngành 116, hệ AUM)', '1599725112', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3123', null, '', '', 'Thêm chương trình khung: LKT03 (ngành 116, hệ AUM)', '1599725129', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3124', null, '', '', 'Thêm chương trình khung: LKT04 (ngành 116, hệ AUM)', '1599725242', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3125', null, '', '', 'Thêm chương trình khung: LKT05 (ngành 116, hệ AUM)', '1599725281', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3126', null, '', '', 'Thêm chương trình khung: LKT06 (ngành 116, hệ AUM)', '1599725366', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3127', null, '', '', 'Thêm chương trình khung: LKT07 (ngành 116, hệ AUM)', '1599725383', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3128', null, '', '', 'Thêm chương trình khung: LKT08 (ngành 116, hệ AUM)', '1599725399', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3129', null, '', '', 'Thêm chương trình khung: LKT09 (ngành 116, hệ AUM)', '1599725445', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3130', null, '', '', 'Thêm chương trình khung: LKT10 (ngành 116, hệ AUM)', '1599725464', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3131', null, '', '', 'Thêm chương trình khung: LKT11 (ngành 116, hệ AUM)', '1599725478', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3132', null, '', '', 'Thêm chương trình khung: LKT12 (ngành 116, hệ AUM)', '1599725500', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3133', null, '', '', 'Thêm chương trình khung: LKT13 (ngành 116, hệ AUM)', '1599725515', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3134', null, '', '', 'Thêm chương trình khung: LKT14 (ngành 116, hệ AUM)', '1599725527', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3135', null, '', '', 'Thêm chương trình khung: LKT15 (ngành 116, hệ AUM)', '1599725550', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3136', null, '', '', 'Thêm chương trình khung: LKT16 (ngành 116, hệ AUM)', '1599725570', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3137', null, '', '', 'Thêm chương trình khung: LKT17 (ngành 116, hệ AUM)', '1599725596', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3138', null, '', '', 'Thêm chương trình khung: LKT18 (ngành 116, hệ AUM)', '1599725611', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3139', null, '', '', 'Thêm chương trình khung: LKT19 (ngành 116, hệ AUM)', '1599725629', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3140', null, '', '', 'Thêm chương trình khung: LKT20 (ngành 116, hệ AUM)', '1599725644', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3141', null, '', '', 'Thêm chương trình khung: LKT21 (ngành 116, hệ AUM)', '1599725661', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3142', null, '', '', 'Thêm chương trình khung: LKT22 (ngành 116, hệ AUM)', '1599725698', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3143', null, '', '', 'Thêm chương trình khung: LKT23 (ngành 116, hệ AUM)', '1599725716', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3144', null, '', '', 'Thêm chương trình khung: LKT24 (ngành 116, hệ AUM)', '1599725732', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3145', null, '', '', 'Thêm chương trình khung: LKT25 (ngành 116, hệ AUM)', '1599725749', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3146', null, '', '', 'Thêm chương trình khung: LKT26 (ngành 116, hệ AUM)', '1599725764', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3147', null, '', '', 'Thêm chương trình khung: LKT27 (ngành 116, hệ AUM)', '1599725780', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3148', null, '', '', 'Thêm chương trình khung: LKT28 (ngành 116, hệ AUM)', '1599725796', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3149', null, '', '', 'Thêm chương trình khung: LKT29 (ngành 116, hệ AUM)', '1599725812', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3150', null, '', '', 'Thêm chương trình khung: LKT30 (ngành 116, hệ AUM)', '1599725826', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3151', null, '', '', 'Thêm chương trình khung: LKT31 (ngành 116, hệ AUM)', '1599725850', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3152', null, '', '', 'Thêm chương trình khung: MC17 (ngành 116, hệ AUM)', '1599725913', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3153', null, '', '', 'Thêm chương trình khung: MC01 (ngành 122, hệ AUM)', '1599726316', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3154', null, '', '', 'Thêm chương trình khung: MC01 (ngành 122, hệ AUM)', '1599726316', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3155', null, '', '', 'Thêm chương trình khung: MC01 (ngành 122, hệ AUM)', '1599726317', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3156', null, '', '', 'Thêm chương trình khung: MC01 (ngành 122, hệ AUM)', '1599726322', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3157', null, '', '', 'Thêm chương trình khung: MC01 (ngành 122, hệ AUM)', '1599726323', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3158', null, '', '', 'Thêm chương trình khung: MC01 (ngành 122, hệ AUM)', '1599726324', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3159', null, '', '', 'Thêm chương trình khung: MC01 (ngành 122, hệ AUM)', '1599726325', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3160', null, '', '', 'Thêm chương trình khung: MC01 (ngành 122, hệ AUM)', '1599726325', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3161', null, '', '', 'Thêm chương trình khung: MC01 (ngành 122, hệ AUM)', '1599726325', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3162', null, '', '', 'Thêm chương trình khung: MC01 (ngành 122, hệ AUM)', '1599726325', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3163', null, '', '', 'Thêm chương trình khung: MC01 (ngành 122, hệ AUM)', '1599726325', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3164', null, '', '', 'Thêm chương trình khung: MC01 (ngành 122, hệ AUM)', '1599726325', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3165', null, '', '', 'Thêm chương trình khung: MC01 (ngành 122, hệ AUM)', '1599726325', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3166', null, '', '', 'Thêm chương trình khung: MC02 (ngành 122, hệ AUM)', '1599726444', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3167', null, '', '', 'Thêm chương trình khung: MC03 (ngành 122, hệ AUM)', '1599726468', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3168', null, '', '', 'Thêm chương trình khung: MC04 (ngành 122, hệ AUM)', '1599726487', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3169', null, '', '', 'Thêm chương trình khung: MC05 (ngành 122, hệ AUM)', '1599726571', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3170', null, '', '', 'Thêm chương trình khung: MC06 (ngành 122, hệ AUM)', '1599726592', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3171', null, '', '', 'Thêm chương trình khung: MC07 (ngành 122, hệ AUM)', '1599726608', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3172', null, '', '', 'Thêm chương trình khung: MC08 (ngành 122, hệ AUM)', '1599726636', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3173', null, '', '', 'Thêm chương trình khung: MC09 (ngành 122, hệ AUM)', '1599726703', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3174', null, '', '', 'Thêm chương trình khung: MC10 (ngành 122, hệ AUM)', '1599726734', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3175', null, '', '', 'Thêm chương trình khung: QLNN01 (ngành 122, hệ AUM)', '1599726752', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3176', null, '', '', 'Thêm chương trình khung: QLNN02 (ngành 122, hệ AUM)', '1599726780', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3177', null, '', '', 'Thêm chương trình khung: QLNN03 (ngành 122, hệ AUM)', '1599726802', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3178', null, '', '', 'Thêm chương trình khung: MC14 (ngành 122, hệ AUM)', '1599726823', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3179', null, '', '', 'Thêm chương trình khung: MC15 (ngành 122, hệ AUM)', '1599726836', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3180', null, '', '', 'Thêm chương trình khung: MC13 (ngành 122, hệ AUM)', '1599726875', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3181', null, '', '', 'Thêm chương trình khung: QLNN04 (ngành 122, hệ AUM)', '1599726904', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3182', null, '', '', 'Thêm chương trình khung: MC11 (ngành 122, hệ AUM)', '1599726958', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3183', null, '', '', 'Thêm chương trình khung: QLNN05 (ngành 122, hệ AUM)', '1599726980', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3184', null, '', '', 'Thêm chương trình khung: QLNN06 (ngành 122, hệ AUM)', '1599727022', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3185', null, '', '', 'Thêm chương trình khung: MC17 (ngành 122, hệ AUM)', '1599727050', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3186', null, '', '', 'Thêm chương trình khung: MC18 (ngành 122, hệ AUM)', '1599727101', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3187', null, '', '', 'Thêm chương trình khung: MC19 (ngành 122, hệ AUM)', '1599727148', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3188', null, '', '', 'Thêm chương trình khung: QLNN07 (ngành 122, hệ AUM)', '1599727173', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3189', null, '', '', 'Thêm chương trình khung: QLNN08 (ngành 122, hệ AUM)', '1599727212', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3190', null, '', '', 'Thêm chương trình khung: MC21 (ngành 122, hệ AUM)', '1599727228', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3191', null, '', '', 'Thêm chương trình khung: QLNN09 (ngành 122, hệ AUM)', '1599727252', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3192', null, '', '', 'Thêm chương trình khung: QLNN10 (ngành 122, hệ AUM)', '1599727274', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3193', null, '', '', 'Thêm chương trình khung: QLNN11 (ngành 122, hệ AUM)', '1599727299', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3194', null, '', '', 'Thêm chương trình khung: QLNN19 (ngành 122, hệ AUM)', '1599727320', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3195', null, '', '', 'Thêm chương trình khung: QLNN12 (ngành 122, hệ AUM)', '1599727345', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3196', null, '', '', 'Thêm chương trình khung: QLNN13 (ngành 122, hệ AUM)', '1599727399', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3197', null, '', '', 'Thêm chương trình khung: QLNN14 (ngành 122, hệ AUM)', '1599727421', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3198', null, '', '', 'Thêm chương trình khung: QLNN15 (ngành 122, hệ AUM)', '1599727451', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3199', null, '', '', 'Thêm chương trình khung: QLNN16 (ngành 122, hệ AUM)', '1599727470', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3200', null, '', '', 'Thêm chương trình khung: QLNN17 (ngành 122, hệ AUM)', '1599727487', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3201', null, '', '', 'Thêm chương trình khung: QLNN18 (ngành 122, hệ AUM)', '1599727523', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3202', null, '', '', 'Thêm chương trình khung: QLNN20 (ngành 122, hệ AUM)', '1599727560', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3203', null, '', '', 'Thêm chương trình khung: QLNN21 (ngành 122, hệ AUM)', '1599727619', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3204', null, '', '', 'Thêm chương trình khung: MC20 (ngành 122, hệ AUM)', '1599727647', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3205', null, '', '', 'Thêm chương trình khung: QLNN22 (ngành 122, hệ AUM)', '1599727685', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3206', null, '', '', 'Thêm chương trình khung: QLNN23 (ngành 122, hệ AUM)', '1599727702', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3207', null, '', '', 'Thêm chương trình khung: QLNN24 (ngành 122, hệ AUM)', '1599727722', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3208', null, '', '', 'Thêm chương trình khung: QLNN25 (ngành 122, hệ AUM)', '1599727746', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3209', null, '', '', 'Thêm chương trình khung: QLNN26 (ngành 122, hệ AUM)', '1599727769', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3210', null, '', '', 'Thêm chương trình khung: QLNN27 (ngành 122, hệ AUM)', '1599727791', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3211', null, '', '', 'Thêm chương trình khung: QLNN28 (ngành 122, hệ AUM)', '1599727812', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3212', null, '', '', 'Thêm chương trình khung: QLNN29 (ngành 122, hệ AUM)', '1599727827', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3213', null, '', '', 'Thêm chương trình khung: QLNN30 (ngành 122, hệ AUM)', '1599727842', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3214', null, '', '', 'Thêm chương trình khung: QLNN31 (ngành 122, hệ AUM)', '1599727856', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3215', null, '', '', 'Thêm chương trình khung: QLNN32 (ngành 122, hệ AUM)', '1599727874', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3216', null, '', '', 'Thêm chương trình khung: QLNN33 (ngành 122, hệ AUM)', '1599727900', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3217', null, '', '', 'Thêm chương trình khung: QLNN34 (ngành 122, hệ AUM)', '1599727919', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3218', null, '', '', 'Thêm chương trình khung: QLNN35 (ngành 122, hệ AUM)', '1599727938', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3219', null, '', '', 'Thêm chương trình khung: QLNN36 (ngành 122, hệ AUM)', '1599727953', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3220', null, '', '', 'Thêm chương trình khung: QLNN37 (ngành 122, hệ AUM)', '1599727976', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3221', null, '1599788697', '', 'Hồ sơ #1599788697 (Hoàng Văn Tôn) tạo mới thành công', '1599789011', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3222', null, '1599788697', '', 'Hồ sơ #1599788697 đã cập nhật thông tin', '1599789024', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3223', null, '159979300115', '', 'Hồ sơ #159979300115 đã cập nhật thông tin', '1599793495', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3224', null, '159979300114', '', 'Hồ sơ #159979300114 đã cập nhật thông tin', '1599793584', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3225', null, '15997930011', '', 'Hồ sơ #15997930011 đã cập nhật thông tin', '1599793693', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3226', null, '15997930016', '', 'Hồ sơ #15997930016 đã cập nhật thông tin', '1599793852', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3227', null, '15997930015', '', 'Hồ sơ #15997930015 đã cập nhật thông tin', '1599793943', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3228', null, '15997930014', '', 'Hồ sơ #15997930014 đã cập nhật thông tin', '1599794111', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3229', null, '15997930014', '', 'Hồ sơ #15997930014 đã cập nhật thông tin', '1599794133', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3230', null, '15997930013', '', 'Hồ sơ #15997930013 đã cập nhật thông tin', '1599794222', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3231', null, '15997930014', '', 'Hồ sơ #15997930014 đã cập nhật thông tin', '1599794269', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3232', null, '15997930012', '', 'Hồ sơ #15997930012 đã cập nhật thông tin', '1599794347', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3233', null, '159979300111', '', 'Hồ sơ #159979300111 đã cập nhật thông tin', '1599794451', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3234', null, '159979300110', '', 'Hồ sơ #159979300110 đã cập nhật thông tin', '1599794545', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3235', null, '159979300110', '', 'Hồ sơ #159979300110 đã cập nhật thông tin', '1599794611', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3236', null, '15997930019', '', 'Hồ sơ #15997930019 đã cập nhật thông tin', '1599794702', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3237', null, '15997930018', '', 'Hồ sơ #15997930018 đã cập nhật thông tin', '1599794798', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3238', null, '15997930017', '', 'Hồ sơ #15997930017 đã cập nhật thông tin', '1599794892', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3239', null, '159979300113', '', 'Hồ sơ #159979300113 đã cập nhật thông tin', '1599794944', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3240', null, '159979300112', '', 'Hồ sơ #159979300112 đã cập nhật thông tin', '1599795060', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3241', null, '159979300112', '', 'Hồ sơ #159979300112 đã trúng tuyển', '1599795178', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3242', null, '159979300113', '', 'Hồ sơ #159979300113 đã trúng tuyển', '1599795179', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3243', null, '15997930017', '', 'Hồ sơ #15997930017 đã trúng tuyển', '1599795179', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3244', null, '15997930018', '', 'Hồ sơ #15997930018 đã trúng tuyển', '1599795180', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3245', null, '15997930019', '', 'Hồ sơ #15997930019 đã trúng tuyển', '1599795181', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3246', null, '159979300110', '', 'Hồ sơ #159979300110 đã trúng tuyển', '1599795182', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3247', null, '159979300111', '', 'Hồ sơ #159979300111 đã trúng tuyển', '1599795183', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3248', null, '15997930012', '', 'Hồ sơ #15997930012 đã trúng tuyển', '1599795184', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3249', null, '15997930013', '', 'Hồ sơ #15997930013 đã trúng tuyển', '1599795184', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3250', null, '15997930014', '', 'Hồ sơ #15997930014 đã trúng tuyển', '1599795185', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3251', null, '15997930015', '', 'Hồ sơ #15997930015 đã trúng tuyển', '1599795185', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3252', null, '15997930016', '', 'Hồ sơ #15997930016 đã trúng tuyển', '1599795186', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3253', null, '15997930011', '', 'Hồ sơ #15997930011 đã trúng tuyển', '1599795187', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3254', null, '159979300114', '', 'Hồ sơ #159979300114 đã trúng tuyển', '1599795189', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3255', null, '159979300115', '', 'Hồ sơ #159979300115 đã trúng tuyển', '1599795192', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3256', null, '1599788697', '', 'Hồ sơ #1599788697 đã trúng tuyển', '1599795193', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3257', null, '1599788697', '20AUM1141', 'Hồ sơ #1599788697 đã nhập học', '1599795210', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3258', null, '15997930011', '20AUM1142', 'Hồ sơ #15997930011 đã nhập học', '1599795256', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3259', null, '15997930012', '20AUM1143', 'Hồ sơ #15997930012 đã nhập học', '1599795264', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3260', null, '15997930013', '20AUM1144', 'Hồ sơ #15997930013 đã nhập học', '1599795274', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3261', null, '15997930014', '20AUM1144', 'Hồ sơ #15997930014 đã nhập học', '1599795284', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3262', null, '15997930015', '20AUM1144', 'Hồ sơ #15997930015 đã nhập học', '1599795291', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3263', null, '15997930016', '20AUM1144', 'Hồ sơ #15997930016 đã nhập học', '1599795297', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3264', null, '15997930017', '20AUM1144', 'Hồ sơ #15997930017 đã nhập học', '1599795302', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3265', null, '15997930018', '20AUM1145', 'Hồ sơ #15997930018 đã nhập học', '1599795308', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3266', null, '15997930019', '20AUM1145', 'Hồ sơ #15997930019 đã nhập học', '1599795313', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3267', null, '159979300110', '20AUM1145', 'Hồ sơ #159979300110 đã nhập học', '1599795320', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3268', null, '159979300111', '20AUM1145', 'Hồ sơ #159979300111 đã nhập học', '1599795327', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3269', null, '159979300112', '20AUM1145', 'Hồ sơ #159979300112 đã nhập học', '1599795334', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3270', null, '159979300113', '20AUM1146', 'Hồ sơ #159979300113 đã nhập học', '1599795340', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3271', null, '159979300114', '20AUM1146', 'Hồ sơ #159979300114 đã nhập học', '1599795345', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3272', null, '159979300115', '20AUM1146', 'Hồ sơ #159979300115 đã nhập học', '1599795351', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3273', null, null, '20AUM1146', 'Xóa danh mục học phí Thẻ sinh viên', '1599795372', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3274', null, null, '20AUM1146', 'Xóa danh mục học phí Đào tạo nhập môn E-learning', '1599795377', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3275', null, null, '20AUM1146', 'Xóa danh mục học phí Lệ phí xét tuyển, nhập học', '1599795382', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3276', null, null, '20AUM1146', 'Xóa danh mục học phí Thẻ sinh viên', '1599795390', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3277', null, null, '20AUM1146', 'Xóa danh mục học phí Đào tạo nhập môn E-learning', '1599795406', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3278', null, null, '20AUM1146', 'Xóa danh mục học phí Lệ phí xét tuyển, nhập học', '1599795418', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3279', null, null, '20AUM1141', 'Mã SV #20AUM1141 đã được thêm vào lớp el1_qtkd11', '1599795435', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3280', null, null, '20AUM1142', 'Mã SV #20AUM1142 đã được thêm vào lớp el1_qtkd11', '1599795444', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3281', null, null, '20AUM1143', 'Mã SV #20AUM1143 đã được thêm vào lớp el1_qtkd11', '1599795451', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3282', null, null, '20AUM1144', 'Mã SV #20AUM1144 đã được thêm vào lớp el1_qtkd11', '1599795459', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3283', null, null, '20AUM1144', 'Mã SV #20AUM1144 đã được thêm vào lớp el1_qtkd11', '1599795474', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3284', null, null, '20AUM1144', 'Mã SV #20AUM1144 đã được thêm vào lớp el1_qtkd11', '1599795481', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3285', null, null, '20AUM1144', 'Mã SV #20AUM1144 đã được thêm vào lớp el1_qtkd11', '1599795487', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3286', null, null, '20AUM1144', 'Mã SV #20AUM1144 đã được thêm vào lớp el1_qtkd11', '1599795493', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3287', null, null, '20AUM1145', 'Mã SV #20AUM1145 đã được thêm vào lớp el1_qtkd11', '1599795499', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3288', null, null, '20AUM1145', 'Mã SV #20AUM1145 đã được thêm vào lớp el1_qtkd11', '1599795506', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3289', null, null, '20AUM1145', 'Mã SV #20AUM1145 đã được thêm vào lớp el1_qtkd11', '1599795511', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3290', null, null, '20AUM1145', 'Mã SV #20AUM1145 đã được thêm vào lớp el1_qtkd11', '1599795523', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3291', null, null, '20AUM1146', 'Mã SV #20AUM1146 đã được thêm vào lớp el1_qtkd11', '1599795528', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3292', null, null, '20AUM1145', 'Mã SV #20AUM1145 đã được thêm vào lớp el1_qtkd11', '1599795532', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3293', null, null, '20AUM1146', 'Mã SV #20AUM1146 đã được thêm vào lớp el1_qtkd11', '1599795534', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3294', null, null, '20AUM1146', 'Mã SV #20AUM1146 đã được thêm vào lớp el1_qtkd11', '1599795540', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3295', null, '15997930012', '', 'Hồ sơ #15997930012 đã cập nhật thông tin', '1599795620', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3296', null, '15997930012', '', 'Hồ sơ #15997930012 đã cập nhật thông tin', '1599795643', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3297', null, null, '20AUM1146', 'Xóa danh mục học phí Triết học Mác Lênin', '1599796003', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3298', null, null, '20AUM1146', 'Xóa danh mục học phí Triết học Mác Lênin', '1599796010', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3299', null, null, '20AUM1146', 'Xóa danh mục học phí Phương pháp nghiên cứu khoa học', '1599796019', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3300', null, null, '20AUM1146', 'Xóa danh mục học phí Phương pháp nghiên cứu khoa học', '1599796026', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3301', null, null, '20AUM1146', 'Xóa danh mục học phí Kinh tế vĩ mô', '1599796031', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3302', null, null, '20AUM1146', 'Xóa danh mục học phí Kinh tế vĩ mô', '1599796036', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3303', null, null, '20AUM1146', 'Xóa danh mục học phí Quản trị học', '1599796044', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3304', null, null, '20AUM1146', 'Xóa danh mục học phí Quản trị học', '1599796049', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3305', null, null, '20AUM1146', 'Xóa danh mục học phí Tài chính tiền tệ', '1599796055', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3306', null, null, '20AUM1146', 'Xóa danh mục học phí Tài chính tiền tệ', '1599796060', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3307', null, null, '20AUM1146', 'Xóa danh mục học phí Marketing căn bản', '1599796064', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3308', null, null, '20AUM1146', 'Xóa danh mục học phí Marketing căn bản', '1599796073', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3309', null, null, '20AUM1145', 'Xóa danh mục học phí Lệ phí xét tuyển, nhập học', '1599796187', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3310', null, null, '20AUM1145', 'Xóa danh mục học phí Đào tạo nhập môn E-learning', '1599796194', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3311', null, null, '20AUM1145', 'Xóa danh mục học phí Thẻ sinh viên', '1599796201', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3312', null, null, '20AUM1145', 'Xóa danh mục học phí Lệ phí xét tuyển, nhập học', '1599796211', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3313', null, null, '20AUM1145', 'Xóa danh mục học phí Đào tạo nhập môn E-learning', '1599796217', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3314', null, null, '20AUM1145', 'Xóa danh mục học phí Thẻ sinh viên', '1599796239', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3315', null, null, '20AUM1144', 'Xóa danh mục học phí Lệ phí xét tuyển, nhập học', '1599796831', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3316', null, null, '20AUM1144', 'Xóa danh mục học phí Đào tạo nhập môn E-learning', '1599796836', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3317', null, null, '20AUM1144', 'Xóa danh mục học phí Thẻ sinh viên', '1599796918', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3318', null, null, '20AUM1144', 'Xóa danh mục học phí Lệ phí xét tuyển, nhập học', '1599796924', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3319', null, null, '20AUM1144', 'Xóa danh mục học phí Đào tạo nhập môn E-learning', '1599796931', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3320', null, null, '20AUM1144', 'Xóa danh mục học phí Thẻ sinh viên', '1599796936', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3321', null, null, '20AUM1144', 'Xóa danh mục học phí Lệ phí xét tuyển, nhập học', '1599796943', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3322', null, null, '20AUM1144', 'Xóa danh mục học phí Đào tạo nhập môn E-learning', '1599796952', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3323', null, null, '20AUM1144', 'Xóa danh mục học phí Thẻ sinh viên', '1599796958', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3324', null, null, '20AUM1144', 'Xóa danh mục học phí Lệ phí xét tuyển, nhập học', '1599796968', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3325', null, null, '20AUM1144', 'Xóa danh mục học phí Đào tạo nhập môn E-learning', '1599796974', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3326', null, null, '20AUM1144', 'Xóa danh mục học phí Thẻ sinh viên', '1599796979', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3327', null, null, '20AUM1144', 'Xóa danh mục học phí Triết học Mác Lênin', '1599796990', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3328', null, null, '20AUM1144', 'Xóa danh mục học phí Triết học Mác Lênin', '1599796995', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3329', null, null, '20AUM1144', 'Xóa danh mục học phí Triết học Mác Lênin', '1599797003', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3330', null, null, '20AUM1144', 'Xóa danh mục học phí Triết học Mác Lênin', '1599797007', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3331', null, null, '20AUM1144', 'Xóa danh mục học phí Phương pháp nghiên cứu khoa học', '1599797014', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3332', null, null, '20AUM1144', 'Xóa danh mục học phí Phương pháp nghiên cứu khoa học', '1599797020', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3333', null, null, '20AUM1144', 'Xóa danh mục học phí Phương pháp nghiên cứu khoa học', '1599797026', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3334', null, null, '20AUM1144', 'Xóa danh mục học phí Phương pháp nghiên cứu khoa học', '1599797031', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3335', null, null, '20AUM1144', 'Xóa danh mục học phí Kinh tế vĩ mô', '1599797042', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3336', null, null, '20AUM1144', 'Xóa danh mục học phí Kinh tế vĩ mô', '1599797044', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3337', null, null, '20AUM1144', 'Xóa danh mục học phí Kinh tế vĩ mô', '1599797047', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3338', null, null, '20AUM1144', 'Xóa danh mục học phí Kinh tế vĩ mô', '1599797052', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3339', null, null, '20AUM1144', 'Xóa danh mục học phí Quản trị học', '1599797057', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3340', null, null, '20AUM1144', 'Xóa danh mục học phí Quản trị học', '1599797060', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3341', null, null, '20AUM1144', 'Xóa danh mục học phí Quản trị học', '1599797062', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3342', null, null, '20AUM1144', 'Xóa danh mục học phí Quản trị học', '1599797065', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3343', null, null, '20AUM1144', 'Xóa danh mục học phí Quản trị học', '1599797072', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3344', null, null, '20AUM1144', 'Xóa danh mục học phí Tài chính tiền tệ', '1599797085', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3345', null, null, '20AUM1144', 'Xóa danh mục học phí Tài chính tiền tệ', '1599797088', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3346', null, null, '20AUM1144', 'Xóa danh mục học phí Tài chính tiền tệ', '1599797090', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3347', null, null, '20AUM1145', 'Xóa danh mục học phí Lệ phí xét tuyển, nhập học', '1599797126', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3348', null, null, '20AUM1145', 'Xóa danh mục học phí Đào tạo nhập môn E-learning', '1599797131', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3349', null, null, '20AUM1145', 'Xóa danh mục học phí Lệ phí xét tuyển, nhập học', '1599797137', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3350', null, null, '20AUM1145', 'Xóa danh mục học phí Đào tạo nhập môn E-learning', '1599797142', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3351', null, null, '20AUM1145', 'Xóa danh mục học phí Thẻ sinh viên', '1599797145', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3352', null, null, '20AUM1145', 'Xóa danh mục học phí Thẻ sinh viên', '1599797150', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3353', null, '15998092011', '', 'Hồ sơ #15998092011 đã cập nhật thông tin', '1599810435', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3354', null, '15998092012', '', 'Hồ sơ #15998092012 đã cập nhật thông tin', '1599810491', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3355', null, '15998092013', '', 'Hồ sơ #15998092013 đã cập nhật thông tin', '1599810620', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3356', null, '15998092014', '', 'Hồ sơ #15998092014 đã cập nhật thông tin', '1599810759', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3357', null, '15998092015', '', 'Hồ sơ #15998092015 đã cập nhật thông tin', '1599810834', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3358', null, '15998092016', '', 'Hồ sơ #15998092016 đã cập nhật thông tin', '1599810898', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3359', null, '15998092017', '', 'Hồ sơ #15998092017 đã cập nhật thông tin', '1599811068', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3360', null, '15998092018', '', 'Hồ sơ #15998092018 đã cập nhật thông tin', '1599811194', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3361', null, '15998092019', '', 'Hồ sơ #15998092019 đã cập nhật thông tin', '1599811397', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3362', null, '159980920111', '', 'Hồ sơ #159980920111 đã cập nhật thông tin', '1599811881', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3363', null, '159980920112', '', 'Hồ sơ #159980920112 đã cập nhật thông tin', '1599812105', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3364', null, '159980920113', '', 'Hồ sơ #159980920113 đã cập nhật thông tin', '1599812229', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3365', null, '159980920114', '', 'Hồ sơ #159980920114 đã cập nhật thông tin', '1599812279', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3366', null, '159980920115', '', 'Hồ sơ #159980920115 đã cập nhật thông tin', '1599812424', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3367', null, '159980920116', '', 'Hồ sơ #159980920116 đã cập nhật thông tin', '1599812518', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3368', null, '159980920117', '', 'Hồ sơ #159980920117 đã cập nhật thông tin', '1599812647', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3369', null, '159980920118', '', 'Hồ sơ #159980920118 đã cập nhật thông tin', '1599812715', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3370', null, '159980920119', '', 'Hồ sơ #159980920119 đã cập nhật thông tin', '1599812802', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3371', null, '159980920120', '', 'Hồ sơ #159980920120 đã cập nhật thông tin', '1599812873', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3372', null, '159980920121', '', 'Hồ sơ #159980920121 đã cập nhật thông tin', '1599812969', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3373', null, '159980920122', '', 'Hồ sơ #159980920122 đã cập nhật thông tin', '1599813049', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3374', null, '159980920123', '', 'Hồ sơ #159980920123 đã cập nhật thông tin', '1599813127', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3375', null, '159980920124', '', 'Hồ sơ #159980920124 đã cập nhật thông tin', '1599813179', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3376', null, '159980920110', '', 'Hồ sơ #159980920110 đã cập nhật thông tin', '1599813267', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3377', null, '159980920110', '', 'Hồ sơ #159980920110 đã trúng tuyển', '1599813315', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3378', null, '159980920124', '', 'Hồ sơ #159980920124 đã trúng tuyển', '1599813316', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3379', null, '159980920123', '', 'Hồ sơ #159980920123 đã trúng tuyển', '1599813317', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3380', null, '159980920122', '', 'Hồ sơ #159980920122 đã trúng tuyển', '1599813320', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3381', null, '159980920121', '', 'Hồ sơ #159980920121 đã trúng tuyển', '1599813321', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3382', null, '159980920120', '', 'Hồ sơ #159980920120 đã trúng tuyển', '1599813323', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3383', null, '159980920119', '', 'Hồ sơ #159980920119 đã trúng tuyển', '1599813324', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3384', null, '159980920118', '', 'Hồ sơ #159980920118 đã trúng tuyển', '1599813326', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3385', null, '159980920117', '', 'Hồ sơ #159980920117 đã trúng tuyển', '1599813327', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3386', null, '159980920116', '', 'Hồ sơ #159980920116 đã trúng tuyển', '1599813329', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3387', null, '159980920115', '', 'Hồ sơ #159980920115 đã trúng tuyển', '1599813330', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3388', null, '159980920114', '', 'Hồ sơ #159980920114 đã trúng tuyển', '1599813331', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3389', null, '159980920113', '', 'Hồ sơ #159980920113 đã trúng tuyển', '1599813333', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3390', null, '159980920112', '', 'Hồ sơ #159980920112 đã trúng tuyển', '1599813334', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3391', null, '159980920111', '', 'Hồ sơ #159980920111 đã trúng tuyển', '1599813335', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3392', null, '15998092019', '', 'Hồ sơ #15998092019 đã trúng tuyển', '1599813336', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3393', null, '15998092018', '', 'Hồ sơ #15998092018 đã trúng tuyển', '1599813337', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3394', null, '15998092017', '', 'Hồ sơ #15998092017 đã trúng tuyển', '1599813338', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3395', null, '15998092016', '', 'Hồ sơ #15998092016 đã trúng tuyển', '1599813340', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3396', null, '15998092015', '', 'Hồ sơ #15998092015 đã trúng tuyển', '1599813342', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3397', null, '15998092014', '', 'Hồ sơ #15998092014 đã trúng tuyển', '1599813343', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3398', null, '15998092013', '', 'Hồ sơ #15998092013 đã trúng tuyển', '1599813345', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3399', null, '15998092012', '', 'Hồ sơ #15998092012 đã trúng tuyển', '1599813346', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3400', null, '15998092011', '', 'Hồ sơ #15998092011 đã trúng tuyển', '1599813347', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3401', null, '159980920124', '20AUM1161', 'Hồ sơ #159980920124 đã nhập học', '1599813363', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3402', null, '15998092011', '20AUM1162', 'Hồ sơ #15998092011 đã nhập học', '1599813384', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3403', null, '15998092012', '20AUM1162', 'Hồ sơ #15998092012 đã nhập học', '1599813389', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3404', null, '15998092013', '20AUM1162', 'Hồ sơ #15998092013 đã nhập học', '1599813394', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3405', null, '15998092014', '20AUM1162', 'Hồ sơ #15998092014 đã nhập học', '1599813399', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3406', null, '15998092015', '20AUM1162', 'Hồ sơ #15998092015 đã nhập học', '1599813404', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3407', null, '15998092016', '20AUM1162', 'Hồ sơ #15998092016 đã nhập học', '1599813412', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3408', null, '15998092017', '20AUM1162', 'Hồ sơ #15998092017 đã nhập học', '1599813417', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3409', null, '15998092018', '20AUM1162', 'Hồ sơ #15998092018 đã nhập học', '1599813422', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3410', null, '15998092019', '20AUM1162', 'Hồ sơ #15998092019 đã nhập học', '1599813427', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3411', null, '159980920110', '20AUM1162', 'Hồ sơ #159980920110 đã nhập học', '1599813432', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3412', null, '159980920111', '20AUM1163', 'Hồ sơ #159980920111 đã nhập học', '1599813437', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3413', null, '159980920112', '20AUM1163', 'Hồ sơ #159980920112 đã nhập học', '1599813442', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3414', null, '159980920113', '20AUM1163', 'Hồ sơ #159980920113 đã nhập học', '1599813447', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3415', null, '159980920114', '20AUM1163', 'Hồ sơ #159980920114 đã nhập học', '1599813452', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3416', null, '159980920115', '20AUM1163', 'Hồ sơ #159980920115 đã nhập học', '1599813458', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3417', null, '159980920123', '20AUM1163', 'Hồ sơ #159980920123 đã nhập học', '1599813473', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3418', null, '159980920116', '20AUM1163', 'Hồ sơ #159980920116 đã nhập học', '1599813478', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3419', null, '159980920117', '20AUM1163', 'Hồ sơ #159980920117 đã nhập học', '1599813488', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3420', null, '159980920118', '20AUM1163', 'Hồ sơ #159980920118 đã nhập học', '1599813492', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3421', null, '159980920119', '20AUM1163', 'Hồ sơ #159980920119 đã nhập học', '1599813500', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3422', null, '159980920120', '20AUM1163', 'Hồ sơ #159980920120 đã nhập học', '1599813505', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3423', null, '159980920121', '20AUM1163', 'Hồ sơ #159980920121 đã nhập học', '1599813510', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3424', null, '159980920122', '20AUM1163', 'Hồ sơ #159980920122 đã nhập học', '1599813514', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3425', null, null, '20AUM1162', 'Mã SV #20AUM1162 đã được thêm vào lớp el1_lkt11', '1599813562', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3426', null, null, '20AUM1162', 'Mã SV #20AUM1162 đã được thêm vào lớp el1_lkt11', '1599813568', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3427', null, null, '20AUM1162', 'Mã SV #20AUM1162 đã được thêm vào lớp el1_lkt11', '1599813574', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3428', null, null, '20AUM1162', 'Mã SV #20AUM1162 đã được thêm vào lớp el1_lkt11', '1599813579', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3429', null, null, '20AUM1162', 'Mã SV #20AUM1162 đã được thêm vào lớp el1_lkt11', '1599813584', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3430', null, null, '20AUM1162', 'Mã SV #20AUM1162 đã được thêm vào lớp el1_lkt11', '1599813590', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3431', null, null, '20AUM1162', 'Mã SV #20AUM1162 đã được thêm vào lớp el1_lkt11', '1599813597', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3432', null, null, '20AUM1162', 'Mã SV #20AUM1162 đã được thêm vào lớp el1_lkt11', '1599813603', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3433', null, null, '20AUM1162', 'Mã SV #20AUM1162 đã được thêm vào lớp el1_lkt11', '1599813608', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3434', null, null, '20AUM1162', 'Mã SV #20AUM1162 đã được thêm vào lớp el1_lkt11', '1599813613', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3435', null, null, '20AUM1163', 'Mã SV #20AUM1163 đã được thêm vào lớp el1_lkt11', '1599813619', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3436', null, null, '20AUM1163', 'Mã SV #20AUM1163 đã được thêm vào lớp el1_lkt11', '1599813628', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3437', null, null, '20AUM1163', 'Mã SV #20AUM1163 đã được thêm vào lớp el1_lkt11', '1599813634', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3438', null, null, '20AUM1163', 'Mã SV #20AUM1163 đã được thêm vào lớp el1_lkt11', '1599813640', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3439', null, null, '20AUM1163', 'Mã SV #20AUM1163 đã được thêm vào lớp el1_lkt11', '1599813645', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3440', null, null, '20AUM1163', 'Mã SV #20AUM1163 đã được thêm vào lớp el1_lkt11', '1599813648', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3441', null, null, '20AUM1163', 'Mã SV #20AUM1163 đã được thêm vào lớp el1_lkt11', '1599813651', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3442', null, null, '20AUM1163', 'Mã SV #20AUM1163 đã được thêm vào lớp el1_lkt11', '1599813657', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3443', null, null, '20AUM1163', 'Mã SV #20AUM1163 đã được thêm vào lớp el1_lkt11', '1599813663', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3444', null, null, '20AUM1163', 'Mã SV #20AUM1163 đã được thêm vào lớp el1_lkt11', '1599813666', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3445', null, null, '20AUM1163', 'Mã SV #20AUM1163 đã được thêm vào lớp el1_lkt11', '1599813669', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3446', null, null, '20AUM1163', 'Mã SV #20AUM1163 đã được thêm vào lớp el1_lkt11', '1599813675', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3447', null, null, '20AUM1163', 'Mã SV #20AUM1163 đã được thêm vào lớp el1_lkt11', '1599813681', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3448', null, null, '20AUM1163', 'Mã SV #20AUM1163 đã được thêm vào lớp el1_lkt11', '1599813687', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3449', null, null, '20AUM1161', 'Mã SV #20AUM1161 đã được thêm vào lớp el1_lkt11', '1599813692', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3450', null, '1599788697', '20AUM114271', 'Hồ sơ #1599788697 đã nhập học', '1600312226', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3451', null, '15997930011', '20AUM114274', 'Hồ sơ #15997930011 đã nhập học', '1600312237', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3452', null, '15997930012', '20AUM114279', 'Hồ sơ #15997930012 đã nhập học', '1600312247', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3453', null, '15997930013', '20AUM114278', 'Hồ sơ #15997930013 đã nhập học', '1600312254', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3454', null, '15997930014', '20AUM114277', 'Hồ sơ #15997930014 đã nhập học', '1600312262', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3455', null, '15997930015', '20AUM114276', 'Hồ sơ #15997930015 đã nhập học', '1600312271', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3456', null, '15997930016', '20AUM114275', 'Hồ sơ #15997930016 đã nhập học', '1600312279', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3457', null, '15997930017', '20AUM114284', 'Hồ sơ #15997930017 đã nhập học', '1600312287', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3458', null, '15997930018', '20AUM114283', 'Hồ sơ #15997930018 đã nhập học', '1600312294', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3459', null, '15997930019', '20AUM114282', 'Hồ sơ #15997930019 đã nhập học', '1600312302', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3460', null, '159979300110', '20AUM114281', 'Hồ sơ #159979300110 đã nhập học', '1600312309', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3461', null, '159979300111', '20AUM114280', 'Hồ sơ #159979300111 đã nhập học', '1600312317', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3462', null, '159979300112', '20AUM114286', 'Hồ sơ #159979300112 đã nhập học', '1600312324', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3463', null, '159979300113', '20AUM114285', 'Hồ sơ #159979300113 đã nhập học', '1600312333', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3464', null, '159979300114', '20AUM114273', 'Hồ sơ #159979300114 đã nhập học', '1600312337', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3465', null, '159979300115', '20AUM114272', 'Hồ sơ #159979300115 đã nhập học', '1600312346', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3466', null, '15998092011', '20AUM116287', 'Hồ sơ #15998092011 đã nhập học', '1600312542', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3467', null, '15998092012', '20AUM116288', 'Hồ sơ #15998092012 đã nhập học', '1600312549', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3468', null, '15998092013', '20AUM116289', 'Hồ sơ #15998092013 đã nhập học', '1600312563', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3469', null, '15998092014', '20AUM116290', 'Hồ sơ #15998092014 đã nhập học', '1600312579', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3470', null, '15998092015', '20AUM116291', 'Hồ sơ #15998092015 đã nhập học', '1600312586', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3471', null, '15998092016', '20AUM116292', 'Hồ sơ #15998092016 đã nhập học', '1600312595', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3472', null, '15998092017', '20AUM116293', 'Hồ sơ #15998092017 đã nhập học', '1600312600', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3473', null, '15998092018', '20AUM116294', 'Hồ sơ #15998092018 đã nhập học', '1600312608', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3474', null, '15998092019', '20AUM116295', 'Hồ sơ #15998092019 đã nhập học', '1600312616', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3475', null, '159980920110', '20AUM116310', 'Hồ sơ #159980920110 đã nhập học', '1600312621', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3476', null, '159980920111', '20AUM116296', 'Hồ sơ #159980920111 đã nhập học', '1600312626', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3477', null, '159980920112', '20AUM116297', 'Hồ sơ #159980920112 đã nhập học', '1600312631', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3478', null, '159980920113', '20AUM116298', 'Hồ sơ #159980920113 đã nhập học', '1600312640', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3479', null, '159980920114', '20AUM116299', 'Hồ sơ #159980920114 đã nhập học', '1600312647', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3480', null, '159980920115', '20AUM116300', 'Hồ sơ #159980920115 đã nhập học', '1600312652', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3481', null, '159980920116', '20AUM116301', 'Hồ sơ #159980920116 đã nhập học', '1600312657', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3482', null, '159980920117', '20AUM116302', 'Hồ sơ #159980920117 đã nhập học', '1600312672', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3483', null, '159980920118', '20AUM116303', 'Hồ sơ #159980920118 đã nhập học', '1600312678', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3484', null, '159980920119', '20AUM116304', 'Hồ sơ #159980920119 đã nhập học', '1600312685', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3485', null, '159980920120', '20AUM116305', 'Hồ sơ #159980920120 đã nhập học', '1600312692', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3486', null, '159980920121', '20AUM116306', 'Hồ sơ #159980920121 đã nhập học', '1600312698', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3487', null, '159980920122', '20AUM116307', 'Hồ sơ #159980920122 đã nhập học', '1600312702', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3488', null, '159980920123', '20AUM116308', 'Hồ sơ #159980920123 đã nhập học', '1600312708', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3489', null, '159980920124', '20AUM116309', 'Hồ sơ #159980920124 đã nhập học', '1600312712', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3490', null, '15998093191', '', 'Hồ sơ #15998093191 đã cập nhật thông tin', '1600313375', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3491', null, '15998093192', '', 'Hồ sơ #15998093192 đã cập nhật thông tin', '1600313436', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3492', null, '15998093193', '', 'Hồ sơ #15998093193 đã cập nhật thông tin', '1600313488', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3493', null, '15998093194', '', 'Hồ sơ #15998093194 đã cập nhật thông tin', '1600313536', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3494', null, '15998093195', '', 'Hồ sơ #15998093195 đã cập nhật thông tin', '1600313608', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3495', null, '15998093196', '', 'Hồ sơ #15998093196 đã cập nhật thông tin', '1600313722', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3496', null, '159980931917', '', 'Hồ sơ #159980931917 đã cập nhật thông tin', '1600313832', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3497', null, '15998093198', '', 'Hồ sơ #15998093198 đã cập nhật thông tin', '1600313891', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3498', null, '15998093197', '', 'Hồ sơ #15998093197 đã cập nhật thông tin', '1600313949', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3499', null, '159980931916', '', 'Hồ sơ #159980931916 đã cập nhật thông tin', '1600314002', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3500', null, '159980931915', '', 'Hồ sơ #159980931915 đã cập nhật thông tin', '1600314053', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3501', null, '159980931914', '', 'Hồ sơ #159980931914 đã cập nhật thông tin', '1600314191', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3502', null, '159980931925', '', 'Hồ sơ #159980931925 đã cập nhật thông tin', '1600314271', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3503', null, '159980931912', '', 'Hồ sơ #159980931912 đã cập nhật thông tin', '1600314325', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3504', null, '159980931911', '', 'Hồ sơ #159980931911 đã cập nhật thông tin', '1600314407', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3505', null, '159980931910', '', 'Hồ sơ #159980931910 đã cập nhật thông tin', '1600314472', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3506', null, '159980931924', '', 'Hồ sơ #159980931924 đã cập nhật thông tin', '1600314523', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3507', null, '159980931923', '', 'Hồ sơ #159980931923 đã cập nhật thông tin', '1600314685', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3508', null, '159980931922', '', 'Hồ sơ #159980931922 đã cập nhật thông tin', '1600314738', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3509', null, '159980931921', '', 'Hồ sơ #159980931921 đã cập nhật thông tin', '1600314850', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3510', null, '159980931920', '', 'Hồ sơ #159980931920 đã cập nhật thông tin', '1600314885', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3511', null, '159980931919', '', 'Hồ sơ #159980931919 đã cập nhật thông tin', '1600314928', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3512', null, '159980931918', '', 'Hồ sơ #159980931918 đã cập nhật thông tin', '1600315037', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3513', null, '159980931913', '', 'Hồ sơ #159980931913 đã cập nhật thông tin', '1600315096', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3514', null, '15998093199', '', 'Hồ sơ #15998093199 đã cập nhật thông tin', '1600315135', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3515', null, '159980931930', '', 'Hồ sơ #159980931930 đã cập nhật thông tin', '1600315174', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3516', null, '159980931929', '', 'Hồ sơ #159980931929 đã cập nhật thông tin', '1600315225', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3517', null, '159980931928', '', 'Hồ sơ #159980931928 đã cập nhật thông tin', '1600315276', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3518', null, '159980931927', '', 'Hồ sơ #159980931927 đã cập nhật thông tin', '1600315325', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3519', null, '159980931926', '', 'Hồ sơ #159980931926 đã cập nhật thông tin', '1600315390', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3520', null, '159980931932', '', 'Hồ sơ #159980931932 đã cập nhật thông tin', '1600315452', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3521', null, '159980931931', '', 'Hồ sơ #159980931931 đã cập nhật thông tin', '1600315511', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3522', null, '159980931913', '', 'Hồ sơ #159980931913 đã cập nhật thông tin', '1600315579', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3523', null, '15998093194', '', 'Hồ sơ #15998093194 đã cập nhật thông tin', '1600315601', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3524', null, '159980931931', '', 'Hồ sơ #159980931931 đã trúng tuyển', '1600315694', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3525', null, '159980931932', '', 'Hồ sơ #159980931932 đã trúng tuyển', '1600315695', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3526', null, '159980931926', '', 'Hồ sơ #159980931926 đã trúng tuyển', '1600315695', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3527', null, '159980931927', '', 'Hồ sơ #159980931927 đã trúng tuyển', '1600315696', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3528', null, '159980931928', '', 'Hồ sơ #159980931928 đã trúng tuyển', '1600315697', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3529', null, '159980931929', '', 'Hồ sơ #159980931929 đã trúng tuyển', '1600315697', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3530', null, '159980931930', '', 'Hồ sơ #159980931930 đã trúng tuyển', '1600315698', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3531', null, '15998093199', '', 'Hồ sơ #15998093199 đã trúng tuyển', '1600315698', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3532', null, '15998093199', '', 'Hồ sơ #15998093199 đã trúng tuyển', '1600315698', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3533', null, '159980931913', '', 'Hồ sơ #159980931913 đã trúng tuyển', '1600315699', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3534', null, '159980931918', '', 'Hồ sơ #159980931918 đã trúng tuyển', '1600315699', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3535', null, '159980931919', '', 'Hồ sơ #159980931919 đã trúng tuyển', '1600315700', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3536', null, '159980931919', '', 'Hồ sơ #159980931919 đã trúng tuyển', '1600315700', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3537', null, '159980931920', '', 'Hồ sơ #159980931920 đã trúng tuyển', '1600315701', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3538', null, '159980931920', '', 'Hồ sơ #159980931920 đã trúng tuyển', '1600315701', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3539', null, '159980931921', '', 'Hồ sơ #159980931921 đã trúng tuyển', '1600315701', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3540', null, '159980931922', '', 'Hồ sơ #159980931922 đã trúng tuyển', '1600315702', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3541', null, '159980931923', '', 'Hồ sơ #159980931923 đã trúng tuyển', '1600315702', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3542', null, '159980931923', '', 'Hồ sơ #159980931923 đã trúng tuyển', '1600315703', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3543', null, '159980931924', '', 'Hồ sơ #159980931924 đã trúng tuyển', '1600315703', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3544', null, '159980931910', '', 'Hồ sơ #159980931910 đã trúng tuyển', '1600315703', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3545', null, '159980931911', '', 'Hồ sơ #159980931911 đã trúng tuyển', '1600315704', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3546', null, '159980931911', '', 'Hồ sơ #159980931911 đã trúng tuyển', '1600315704', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3547', null, '159980931912', '', 'Hồ sơ #159980931912 đã trúng tuyển', '1600315704', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3548', null, '159980931912', '', 'Hồ sơ #159980931912 đã trúng tuyển', '1600315705', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3549', null, '159980931912', '', 'Hồ sơ #159980931912 đã trúng tuyển', '1600315705', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3550', null, '159980931925', '', 'Hồ sơ #159980931925 đã trúng tuyển', '1600315705', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3551', null, '159980931914', '', 'Hồ sơ #159980931914 đã trúng tuyển', '1600315706', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3552', null, '159980931915', '', 'Hồ sơ #159980931915 đã trúng tuyển', '1600315706', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3553', null, '159980931916', '', 'Hồ sơ #159980931916 đã trúng tuyển', '1600315709', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3554', null, '15998093197', '', 'Hồ sơ #15998093197 đã trúng tuyển', '1600315710', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3555', null, '15998093198', '', 'Hồ sơ #15998093198 đã trúng tuyển', '1600315710', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3556', null, '159980931917', '', 'Hồ sơ #159980931917 đã trúng tuyển', '1600315711', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3557', null, '15998093196', '', 'Hồ sơ #15998093196 đã trúng tuyển', '1600315712', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3558', null, '15998093195', '', 'Hồ sơ #15998093195 đã trúng tuyển', '1600315713', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3559', null, '15998093194', '', 'Hồ sơ #15998093194 đã trúng tuyển', '1600315713', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3560', null, '15998093193', '', 'Hồ sơ #15998093193 đã trúng tuyển', '1600315714', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3561', null, '15998093192', '', 'Hồ sơ #15998093192 đã trúng tuyển', '1600315717', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3562', null, '15998093191', '', 'Hồ sơ #15998093191 đã trúng tuyển', '1600315718', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3563', null, '15998093191', '20AUM122311', 'Hồ sơ #15998093191 đã nhập học', '1600315774', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3564', null, '15998093192', '20AUM122312', 'Hồ sơ #15998093192 đã nhập học', '1600315786', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3565', null, '15998093193', '20AUM122313', 'Hồ sơ #15998093193 đã nhập học', '1600315791', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3566', null, '15998093194', '20AUM122314', 'Hồ sơ #15998093194 đã nhập học', '1600315803', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3567', null, '15998093195', '20AUM122315', 'Hồ sơ #15998093195 đã nhập học', '1600315808', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3568', null, '15998093196', '20AUM122316', 'Hồ sơ #15998093196 đã nhập học', '1600315813', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3569', null, '15998093197', '20AUM122319', 'Hồ sơ #15998093197 đã nhập học', '1600315818', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3570', null, '15998093198', '20AUM122318', 'Hồ sơ #15998093198 đã nhập học', '1600315824', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3571', null, '15998093199', '20AUM122335', 'Hồ sơ #15998093199 đã nhập học', '1600315830', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3572', null, '159980931910', '20AUM122326', 'Hồ sơ #159980931910 đã nhập học', '1600315835', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3573', null, '159980931911', '20AUM122325', 'Hồ sơ #159980931911 đã nhập học', '1600315840', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3574', null, '159980931912', '20AUM122324', 'Hồ sơ #159980931912 đã nhập học', '1600315845', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3575', null, '159980931913', '20AUM122334', 'Hồ sơ #159980931913 đã nhập học', '1600315849', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3576', null, '159980931914', '20AUM122322', 'Hồ sơ #159980931914 đã nhập học', '1600315853', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3577', null, '159980931915', '20AUM122321', 'Hồ sơ #159980931915 đã nhập học', '1600315859', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3578', null, '159980931916', '20AUM122320', 'Hồ sơ #159980931916 đã nhập học', '1600315864', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3579', null, '159980931917', '20AUM122317', 'Hồ sơ #159980931917 đã nhập học', '1600315868', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3580', null, '159980931932', '20AUM122341', 'Hồ sơ #159980931932 đã nhập học', '1600315876', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3581', null, '159980931918', '20AUM122333', 'Hồ sơ #159980931918 đã nhập học', '1600315880', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3582', null, '159980931919', '20AUM122332', 'Hồ sơ #159980931919 đã nhập học', '1600315886', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3583', null, '159980931920', '20AUM122331', 'Hồ sơ #159980931920 đã nhập học', '1600315891', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3584', null, '159980931921', '20AUM122330', 'Hồ sơ #159980931921 đã nhập học', '1600315895', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3585', null, '159980931922', '20AUM122329', 'Hồ sơ #159980931922 đã nhập học', '1600315900', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3586', null, '159980931923', '20AUM122328', 'Hồ sơ #159980931923 đã nhập học', '1600315904', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3587', null, '159980931924', '20AUM122327', 'Hồ sơ #159980931924 đã nhập học', '1600315909', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3588', null, '159980931925', '20AUM122323', 'Hồ sơ #159980931925 đã nhập học', '1600315913', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3589', null, '159980931926', '20AUM122340', 'Hồ sơ #159980931926 đã nhập học', '1600315918', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3590', null, '159980931927', '20AUM122339', 'Hồ sơ #159980931927 đã nhập học', '1600315923', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3591', null, '159980931928', '20AUM122338', 'Hồ sơ #159980931928 đã nhập học', '1600315927', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3592', null, '159980931929', '20AUM122337', 'Hồ sơ #159980931929 đã nhập học', '1600315932', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3593', null, '159980931930', '20AUM122336', 'Hồ sơ #159980931930 đã nhập học', '1600315937', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3594', null, '159980931931', '20AUM122342', 'Hồ sơ #159980931931 đã nhập học', '1600315941', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3595', null, null, '20AUM122311', 'Mã SV #20AUM122311 đã được thêm vào lớp el1_qlnn11', '1600315962', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3596', null, null, '20AUM122312', 'Mã SV #20AUM122312 đã được thêm vào lớp el1_qlnn11', '1600315968', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3597', null, null, '20AUM122313', 'Mã SV #20AUM122313 đã được thêm vào lớp el1_qlnn11', '1600315974', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3598', null, null, '20AUM122314', 'Mã SV #20AUM122314 đã được thêm vào lớp el1_qlnn11', '1600315980', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3599', null, null, '20AUM122315', 'Mã SV #20AUM122315 đã được thêm vào lớp el1_qlnn11', '1600315987', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3600', null, null, '20AUM122316', 'Mã SV #20AUM122316 đã được thêm vào lớp el1_qlnn11', '1600315994', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3601', null, null, '20AUM122319', 'Mã SV #20AUM122319 đã được thêm vào lớp el1_qlnn11', '1600316000', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3602', null, null, '20AUM122318', 'Mã SV #20AUM122318 đã được thêm vào lớp el1_qlnn11', '1600316006', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3603', null, null, '20AUM122335', 'Mã SV #20AUM122335 đã được thêm vào lớp el1_qlnn11', '1600316012', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3604', null, null, '20AUM122326', 'Mã SV #20AUM122326 đã được thêm vào lớp el1_qlnn11', '1600316017', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3605', null, null, '20AUM122325', 'Mã SV #20AUM122325 đã được thêm vào lớp el1_qlnn11', '1600316022', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3606', null, null, '20AUM122324', 'Mã SV #20AUM122324 đã được thêm vào lớp el1_qlnn11', '1600316028', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3607', null, null, '20AUM122334', 'Mã SV #20AUM122334 đã được thêm vào lớp el1_qlnn11', '1600316033', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3608', null, null, '20AUM122322', 'Mã SV #20AUM122322 đã được thêm vào lớp el1_qlnn11', '1600316040', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3609', null, null, '20AUM122321', 'Mã SV #20AUM122321 đã được thêm vào lớp el1_qlnn11', '1600316045', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3610', null, null, '20AUM122320', 'Mã SV #20AUM122320 đã được thêm vào lớp el1_qlnn11', '1600316051', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3611', null, null, '20AUM122317', 'Mã SV #20AUM122317 đã được thêm vào lớp el1_qlnn11', '1600316057', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3612', null, null, '20AUM122333', 'Mã SV #20AUM122333 đã được thêm vào lớp el1_qlnn11', '1600316064', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3613', null, null, '20AUM122332', 'Mã SV #20AUM122332 đã được thêm vào lớp el1_qlnn11', '1600316069', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3614', null, null, '20AUM122332', 'Mã SV #20AUM122332 đã được thêm vào lớp el1_qlnn11', '1600316072', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3615', null, null, '20AUM122331', 'Mã SV #20AUM122331 đã được thêm vào lớp el1_qlnn11', '1600316074', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3616', null, null, '20AUM122330', 'Mã SV #20AUM122330 đã được thêm vào lớp el1_qlnn11', '1600316077', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3617', null, null, '20AUM122329', 'Mã SV #20AUM122329 đã được thêm vào lớp el1_qlnn11', '1600316083', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3618', null, null, '20AUM122328', 'Mã SV #20AUM122328 đã được thêm vào lớp el1_qlnn11', '1600316089', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3619', null, null, '20AUM122327', 'Mã SV #20AUM122327 đã được thêm vào lớp el1_qlnn11', '1600316094', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3620', null, null, '20AUM122323', 'Mã SV #20AUM122323 đã được thêm vào lớp el1_qlnn11', '1600316101', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3621', null, null, '20AUM122340', 'Mã SV #20AUM122340 đã được thêm vào lớp el1_qlnn11', '1600316106', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3622', null, null, '20AUM122339', 'Mã SV #20AUM122339 đã được thêm vào lớp el1_qlnn11', '1600316112', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3623', null, null, '20AUM122338', 'Mã SV #20AUM122338 đã được thêm vào lớp el1_qlnn11', '1600316117', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3624', null, null, '20AUM122337', 'Mã SV #20AUM122337 đã được thêm vào lớp el1_qlnn11', '1600316122', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3625', null, null, '20AUM122336', 'Mã SV #20AUM122336 đã được thêm vào lớp el1_qlnn11', '1600316126', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3626', null, null, '20AUM122336', 'Mã SV #20AUM122336 đã được thêm vào lớp el1_qlnn11', '1600316128', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3627', null, null, '20AUM122342', 'Mã SV #20AUM122342 đã được thêm vào lớp el1_qlnn11', '1600316134', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3628', null, null, '20AUM122341', 'Mã SV #20AUM122341 đã được thêm vào lớp el1_qlnn11', '1600316140', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3629', null, '1609743738', '', 'Hồ sơ #1609743738 (Phan Văn Uông) tạo mới thành công', '1609744748', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3630', null, '1609743738', '', 'Hồ sơ #1609743738 đã cập nhật thông tin', '1609744762', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3631', null, '1609744773', '', 'Hồ sơ #1609744773 (Lý Thị Nga) tạo mới thành công', '1609744849', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3632', null, '1609744773', '', 'Hồ sơ #1609744773 đã cập nhật thông tin', '1609744870', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3633', null, '1609744877', '', 'Hồ sơ #1609744877 (Thái Anh Tuấn) tạo mới thành công', '1609744950', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3634', null, '1609744877', '', 'Hồ sơ #1609744877 đã cập nhật thông tin', '1609744990', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3635', null, '1609744999', '', 'Hồ sơ #1609744999 (Vũ Lương Trung Đức) tạo mới thành công', '1609745071', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3636', null, '1609744999', '', 'Hồ sơ #1609744999 đã cập nhật thông tin', '1609745080', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3637', null, '1609745086', '', 'Hồ sơ #1609745086 (Sa Văn Dược) tạo mới thành công', '1609745160', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3638', null, '1609745086', '', 'Hồ sơ #1609745086 đã cập nhật thông tin', '1609745170', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3639', null, '1609745185', '', 'Hồ sơ #1609745185 (Đinh Thị Hường) tạo mới thành công', '1609745266', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3640', null, '1609745185', '', 'Hồ sơ #1609745185 đã cập nhật thông tin', '1609745275', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3641', null, '1609745284', '', 'Hồ sơ #1609745284 (Hà Đình Long) tạo mới thành công', '1609745360', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3642', null, '1609745284', '', 'Hồ sơ #1609745284 đã cập nhật thông tin', '1609745368', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3643', null, '1609745284', '', 'Hồ sơ #1609745284 đã cập nhật thông tin', '1609745376', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3644', null, '1609745387', '', 'Hồ sơ #1609745387 (Chi Thị Hà) tạo mới thành công', '1609745434', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3645', null, '1609745387', '', 'Hồ sơ #1609745387 đã cập nhật thông tin', '1609745444', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3646', null, '1609745452', '', 'Hồ sơ #1609745452 (Hoàng Văn Doanh) tạo mới thành công', '1609745503', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3647', null, '1609745452', '', 'Hồ sơ #1609745452 đã cập nhật thông tin', '1609745512', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3648', null, '1609745452', '', 'Hồ sơ #1609745452 đã cập nhật thông tin', '1609745517', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3649', null, '1609745524', '', 'Hồ sơ #1609745524 (Triệu Thị Thương) tạo mới thành công', '1609745574', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3650', null, '1609745524', '', 'Hồ sơ #1609745524 đã cập nhật thông tin', '1609745583', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3651', null, '1609745588', '', 'Hồ sơ #1609745588 (Nguyễn Thị Diệu Linh) tạo mới thành công', '1609745645', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3652', null, '1609745588', '', 'Hồ sơ #1609745588 đã cập nhật thông tin', '1609745654', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3653', null, '1609745661', '', 'Hồ sơ #1609745661 (Lại Anh Tâm) tạo mới thành công', '1609745712', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3654', null, '1609745661', '', 'Hồ sơ #1609745661 đã cập nhật thông tin', '1609745721', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3655', null, '1609745729', '', 'Hồ sơ #1609745729 (Hà Quang Tối) tạo mới thành công', '1609745785', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3656', null, '1609745729', '', 'Hồ sơ #1609745729 đã cập nhật thông tin', '1609745793', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3657', null, '1609745799', '', 'Hồ sơ #1609745799 (Lò Thị Hoài) tạo mới thành công', '1609745851', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3658', null, '1609745799', '', 'Hồ sơ #1609745799 đã cập nhật thông tin', '1609745859', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3659', null, '1609745865', '', 'Hồ sơ #1609745865 (Lý Thị Của) tạo mới thành công', '1609745889', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3660', null, '1609745865', '', 'Hồ sơ #1609745865 đã cập nhật thông tin', '1609745897', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3661', null, '1609745903', '', 'Hồ sơ #1609745903 (Hảng Thị Mỷ) tạo mới thành công', '1609745976', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3662', null, '1609745903', '', 'Hồ sơ #1609745903 đã cập nhật thông tin', '1609745983', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3663', null, '1609745992', '', 'Hồ sơ #1609745992 (Hoàng Đức Học) tạo mới thành công', '1609746020', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3664', null, '1609745992', '', 'Hồ sơ #1609745992 đã cập nhật thông tin', '1609746029', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3665', null, '1609746037', '', 'Hồ sơ #1609746037 (Sùng A Phệ) tạo mới thành công', '1609746064', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3666', null, '1609746037', '', 'Hồ sơ #1609746037 đã cập nhật thông tin', '1609746072', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3667', null, '1609746078', '', 'Hồ sơ #1609746078 (Giàng A Ninh) tạo mới thành công', '1609746105', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3668', null, '1609746078', '', 'Hồ sơ #1609746078 đã cập nhật thông tin', '1609746113', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3669', null, '1609746125', '', 'Hồ sơ #1609746125 (Hờ A Vàng) tạo mới thành công', '1609746147', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3670', null, '1609746125', '', 'Hồ sơ #1609746125 đã cập nhật thông tin', '1609746187', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3671', null, '1609746125', '', 'Hồ sơ #1609746125 đã trúng tuyển', '1609746235', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3672', null, '1609746078', '', 'Hồ sơ #1609746078 đã trúng tuyển', '1609746237', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3673', null, '1609746037', '', 'Hồ sơ #1609746037 đã trúng tuyển', '1609746238', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3674', null, '1609745992', '', 'Hồ sơ #1609745992 đã trúng tuyển', '1609746239', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3675', null, '1609745903', '', 'Hồ sơ #1609745903 đã trúng tuyển', '1609746240', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3676', null, '1609745865', '', 'Hồ sơ #1609745865 đã trúng tuyển', '1609746240', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3677', null, '1609745799', '', 'Hồ sơ #1609745799 đã trúng tuyển', '1609746241', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3678', null, '1609745729', '', 'Hồ sơ #1609745729 đã trúng tuyển', '1609746242', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3679', null, '1609745661', '', 'Hồ sơ #1609745661 đã trúng tuyển', '1609746243', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3680', null, '1609745588', '', 'Hồ sơ #1609745588 đã trúng tuyển', '1609746243', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3681', null, '1609745524', '', 'Hồ sơ #1609745524 đã trúng tuyển', '1609746244', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3682', null, '1609745452', '', 'Hồ sơ #1609745452 đã trúng tuyển', '1609746244', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3683', null, '1609745387', '', 'Hồ sơ #1609745387 đã trúng tuyển', '1609746245', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3684', null, '1609745284', '', 'Hồ sơ #1609745284 đã trúng tuyển', '1609746245', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3685', null, '1609745185', '', 'Hồ sơ #1609745185 đã trúng tuyển', '1609746246', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3686', null, '1609745086', '', 'Hồ sơ #1609745086 đã trúng tuyển', '1609746247', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3687', null, '1609744999', '', 'Hồ sơ #1609744999 đã trúng tuyển', '1609746249', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3688', null, '1609744773', '', 'Hồ sơ #1609744773 đã trúng tuyển', '1609746250', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3689', null, '1609744877', '', 'Hồ sơ #1609744877 đã trúng tuyển', '1609746250', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3690', null, '1609743738', '', 'Hồ sơ #1609743738 đã trúng tuyển', '1609746252', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3691', null, '1609743738', '20AUM116343', 'Hồ sơ #1609743738 đã nhập học', '1609746286', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3692', null, '1609745284', '20AUM116349', 'Hồ sơ #1609745284 đã nhập học', '1609746317', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3693', null, '1609744773', '20AUM116344', 'Hồ sơ #1609744773 đã nhập học', '1609746332', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3694', null, '1609744877', '20AUM116345', 'Hồ sơ #1609744877 đã nhập học', '1609746342', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3695', null, '1609744999', '20AUM116346', 'Hồ sơ #1609744999 đã nhập học', '1609746348', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3696', null, '1609745086', '20AUM116347', 'Hồ sơ #1609745086 đã nhập học', '1609746353', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3697', null, '1609745185', '20AUM116348', 'Hồ sơ #1609745185 đã nhập học', '1609746360', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3698', null, '1609746125', '20AUM116362', 'Hồ sơ #1609746125 đã nhập học', '1609746370', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3699', null, '1609745387', '20AUM116350', 'Hồ sơ #1609745387 đã nhập học', '1609746377', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3700', null, '1609745452', '20AUM116351', 'Hồ sơ #1609745452 đã nhập học', '1609746384', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3701', null, '1609745524', '20AUM116352', 'Hồ sơ #1609745524 đã nhập học', '1609746389', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3702', null, '1609745588', '20AUM116353', 'Hồ sơ #1609745588 đã nhập học', '1609746394', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3703', null, '1609745661', '20AUM116354', 'Hồ sơ #1609745661 đã nhập học', '1609746400', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3704', null, '1609745729', '20AUM116355', 'Hồ sơ #1609745729 đã nhập học', '1609746405', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3705', null, '1609745799', '20AUM116356', 'Hồ sơ #1609745799 đã nhập học', '1609746412', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3706', null, '1609745865', '20AUM116357', 'Hồ sơ #1609745865 đã nhập học', '1609746419', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3707', null, '1609745903', '20AUM116358', 'Hồ sơ #1609745903 đã nhập học', '1609746423', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3708', null, '1609745992', '20AUM116359', 'Hồ sơ #1609745992 đã nhập học', '1609746428', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3709', null, '1609746037', '20AUM116360', 'Hồ sơ #1609746037 đã nhập học', '1609746432', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3710', null, '1609746078', '20AUM116361', 'Hồ sơ #1609746078 đã nhập học', '1609746437', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3711', null, null, '20AUM116343', 'Mã SV #20AUM116343 đã được thêm vào lớp el22_lkt11', '1609746470', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3712', null, null, '20AUM116344', 'Mã SV #20AUM116344 đã được thêm vào lớp el21_lkt11', '1609746483', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3713', null, null, '20AUM116345', 'Mã SV #20AUM116345 đã được thêm vào lớp el22_lkt11', '1609746492', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3714', null, null, '20AUM116346', 'Mã SV #20AUM116346 đã được thêm vào lớp el22_lkt11', '1609746506', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3715', null, null, '20AUM116347', 'Mã SV #20AUM116347 đã được thêm vào lớp el22_lkt11', '1609746518', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3716', null, null, '20AUM116348', 'Mã SV #20AUM116348 đã được thêm vào lớp el22_lkt11', '1609746530', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3717', null, null, '20AUM116349', 'Mã SV #20AUM116349 đã được thêm vào lớp el22_lkt11', '1609746538', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3718', null, null, '20AUM116350', 'Mã SV #20AUM116350 đã được thêm vào lớp el22_lkt11', '1609746551', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3719', null, null, '20AUM116351', 'Mã SV #20AUM116351 đã được thêm vào lớp el22_lkt11', '1609746560', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3720', null, null, '20AUM116352', 'Mã SV #20AUM116352 đã được thêm vào lớp el22_lkt11', '1609746567', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3721', null, null, '20AUM116353', 'Mã SV #20AUM116353 đã được thêm vào lớp el22_lkt11', '1609746573', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3722', null, null, '20AUM116354', 'Mã SV #20AUM116354 đã được thêm vào lớp el22_lkt11', '1609746580', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3723', null, null, '20AUM116355', 'Mã SV #20AUM116355 đã được thêm vào lớp el22_lkt11', '1609746590', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3724', null, null, '20AUM116356', 'Mã SV #20AUM116356 đã được thêm vào lớp el22_lkt11', '1609746597', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3725', null, null, '20AUM116357', 'Mã SV #20AUM116357 đã được thêm vào lớp el22_lkt11', '1609746604', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3726', null, null, '20AUM116358', 'Mã SV #20AUM116358 đã được thêm vào lớp el22_lkt11', '1609746611', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3727', null, null, '20AUM116359', 'Mã SV #20AUM116359 đã được thêm vào lớp el22_lkt11', '1609746618', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3728', null, null, '20AUM116360', 'Mã SV #20AUM116360 đã được thêm vào lớp el22_lkt11', '1609746625', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3729', null, null, '20AUM116361', 'Mã SV #20AUM116361 đã được thêm vào lớp el22_lkt11', '1609746632', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3730', null, null, '20AUM116362', 'Mã SV #20AUM116362 đã được thêm vào lớp el22_lkt11', '1609746638', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3731', null, null, '20AUM116344', 'Mã SV #20AUM116344 chuyển từ lớp el21_lkt11 sang lớp el22_lkt11', '1609746674', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3732', null, '1609744773', '20AUM116344', 'Hủy nhập học hồ sơ #1609744773. Lý do: lại', '1609746847', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3733', null, '1609744773', '20AUM116344', 'Hồ sơ #1609744773 đã nhập học', '1609746901', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3734', null, '1609922428', '', 'Hồ sơ #1609922428 (Nguyễn Văn Quyết) tạo mới thành công', '1609922497', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3735', null, '1609922828', '', 'Hồ sơ #1609922828 (Nguyễn Hải Bằng) tạo mới thành công', '1609922878', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3736', null, '1609922884', '', 'Hồ sơ #1609922884 (Hờ A Cầu) tạo mới thành công', '1609922923', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3737', null, '1609923051', '', 'Hồ sơ #1609923051 (Giàng A Chinh) tạo mới thành công', '1609923123', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3738', null, '1609923179', '', 'Hồ sơ #1609923179 (Giàng A Chu) tạo mới thành công', '1609923209', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3739', null, '1609923219', '', 'Hồ sơ #1609923219 (Giàng A Chú) tạo mới thành công', '1609923253', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3740', null, '1609923259', '', 'Hồ sơ #1609923259 (Bàn Tòn Lai) tạo mới thành công', '1609923310', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3741', null, '1609923317', '', 'Hồ sơ #1609923317 (Giàng A Lềnh) tạo mới thành công', '1609923361', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3742', null, '1609923371', '', 'Hồ sơ #1609923371 (Giàng A Lềnh) tạo mới thành công', '1609923398', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3743', null, '1609923411', '', 'Hồ sơ #1609923411 (Giàng A Lồng) tạo mới thành công', '1609923446', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3744', null, '1609923461', '', 'Hồ sơ #1609923461 (Hờ A Sùng) tạo mới thành công', '1609923500', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3745', null, '1609923505', '', 'Hồ sơ #1609923505 (Lò Văn Thức) tạo mới thành công', '1609923549', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3746', null, '1609923557', '', 'Hồ sơ #1609923557 (Thào A Trư) tạo mới thành công', '1609923587', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3747', null, '1609923592', '', 'Hồ sơ #1609923592 (Giàng A Tủa) tạo mới thành công', '1609923624', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3748', null, '16099217421', '', 'Hồ sơ #16099217421 đã cập nhật thông tin', '1609987476', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3749', null, '16099217422', '', 'Hồ sơ #16099217422 đã cập nhật thông tin', '1609987571', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3750', null, '1609922828', '', 'Hồ sơ #1609922828 đã cập nhật thông tin', '1609987617', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3751', null, '16099217423', '', 'Hồ sơ #16099217423 đã cập nhật thông tin', '1609987666', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3752', null, '1609922884', '', 'Hồ sơ #1609922884 đã cập nhật thông tin', '1609987993', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3753', null, '1609923051', '', 'Hồ sơ #1609923051 đã cập nhật thông tin', '1609988014', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3754', null, '16099217424', '', 'Hồ sơ #16099217424 đã cập nhật thông tin', '1609988097', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3755', null, '1609923179', '', 'Hồ sơ #1609923179 đã cập nhật thông tin', '1609988161', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3756', null, '1609923219', '', 'Hồ sơ #1609923219 đã cập nhật thông tin', '1609988176', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3757', null, '16099217425', '', 'Hồ sơ #16099217425 đã cập nhật thông tin', '1609988211', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3758', null, '16099217426', '', 'Hồ sơ #16099217426 đã cập nhật thông tin', '1609988778', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3759', null, '16099217427', '', 'Hồ sơ #16099217427 đã cập nhật thông tin', '1609988816', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3760', null, '16099217428', '', 'Hồ sơ #16099217428 đã cập nhật thông tin', '1609988864', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3761', null, '16099217429', '', 'Hồ sơ #16099217429 đã cập nhật thông tin', '1609988905', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3762', null, '160992174210', '', 'Hồ sơ #160992174210 đã cập nhật thông tin', '1609988948', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3763', null, '160992174211', '', 'Hồ sơ #160992174211 đã cập nhật thông tin', '1609988975', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3764', null, '160992174212', '', 'Hồ sơ #160992174212 đã cập nhật thông tin', '1609989008', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3765', null, '160992174213', '', 'Hồ sơ #160992174213 đã cập nhật thông tin', '1609989080', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3766', null, '160992174214', '', 'Hồ sơ #160992174214 đã cập nhật thông tin', '1609989112', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3767', null, '160992174215', '', 'Hồ sơ #160992174215 đã cập nhật thông tin', '1609989177', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3768', null, '160992174216', '', 'Hồ sơ #160992174216 đã cập nhật thông tin', '1609989215', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3769', null, '160992174217', '', 'Hồ sơ #160992174217 đã cập nhật thông tin', '1609989245', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3770', null, '160992174218', '', 'Hồ sơ #160992174218 đã cập nhật thông tin', '1609989275', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3771', null, '1609923259', '', 'Hồ sơ #1609923259 đã cập nhật thông tin', '1609989310', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3772', null, '160992174219', '', 'Hồ sơ #160992174219 đã cập nhật thông tin', '1609989342', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3773', null, '160992174220', '', 'Hồ sơ #160992174220 đã cập nhật thông tin', '1609989376', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3774', null, '160992174221', '', 'Hồ sơ #160992174221 đã cập nhật thông tin', '1609989410', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3775', null, '1609923317', '', 'Hồ sơ #1609923317 đã cập nhật thông tin', '1609989434', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3776', null, '1609923371', '', 'Hồ sơ #1609923371 đã cập nhật thông tin', '1609989451', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3777', null, '160992174222', '', 'Hồ sơ #160992174222 đã cập nhật thông tin', '1609989513', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3778', null, '160992174223', '', 'Hồ sơ #160992174223 đã cập nhật thông tin', '1609989559', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3779', null, '1609923411', '', 'Hồ sơ #1609923411 đã cập nhật thông tin', '1609989586', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3780', null, '160992174224', '', 'Hồ sơ #160992174224 đã cập nhật thông tin', '1609989616', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3781', null, '160992174225', '', 'Hồ sơ #160992174225 đã cập nhật thông tin', '1609989643', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3782', null, '160992174225', '', 'Hồ sơ #160992174225 đã cập nhật thông tin', '1609989649', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3783', null, '160992174226', '', 'Hồ sơ #160992174226 đã cập nhật thông tin', '1609989707', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3784', null, '160992174227', '', 'Hồ sơ #160992174227 đã cập nhật thông tin', '1609989751', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3785', null, '160992174228', '', 'Hồ sơ #160992174228 đã cập nhật thông tin', '1609989798', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3786', null, '160992174229', '', 'Hồ sơ #160992174229 đã cập nhật thông tin', '1609989871', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3787', null, '160992174230', '', 'Hồ sơ #160992174230 đã cập nhật thông tin', '1609989906', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3788', null, '160992174231', '', 'Hồ sơ #160992174231 đã cập nhật thông tin', '1609989933', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3789', null, '160992174232', '', 'Hồ sơ #160992174232 đã cập nhật thông tin', '1609989963', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3790', null, '160992174233', '', 'Hồ sơ #160992174233 đã cập nhật thông tin', '1609990005', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3791', null, '1609922428', '', 'Hồ sơ #1609922428 đã cập nhật thông tin', '1609990028', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3792', null, '160992174235', '', 'Hồ sơ #160992174235 đã cập nhật thông tin', '1609990065', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3793', null, '160992174236', '', 'Hồ sơ #160992174236 đã cập nhật thông tin', '1609990095', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3794', null, '160992174237', '', 'Hồ sơ #160992174237 đã cập nhật thông tin', '1609990125', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3795', null, '160992174238', '', 'Hồ sơ #160992174238 đã cập nhật thông tin', '1609990167', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3796', null, '160992174239', '', 'Hồ sơ #160992174239 đã cập nhật thông tin', '1609990216', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3797', null, '160992174240', '', 'Hồ sơ #160992174240 đã cập nhật thông tin', '1609990249', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3798', null, '160992174241', '', 'Hồ sơ #160992174241 đã cập nhật thông tin', '1609990284', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3799', null, '1609923461', '', 'Hồ sơ #1609923461 đã cập nhật thông tin', '1609990299', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3800', null, '160992174242', '', 'Hồ sơ #160992174242 đã cập nhật thông tin', '1609990330', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3801', null, '160992174243', '', 'Hồ sơ #160992174243 đã cập nhật thông tin', '1609990354', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3802', null, '1609923505', '', 'Hồ sơ #1609923505 đã cập nhật thông tin', '1609990367', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3803', null, '160992174244', '', 'Hồ sơ #160992174244 đã cập nhật thông tin', '1609990396', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3804', null, '160992174245', '', 'Hồ sơ #160992174245 đã cập nhật thông tin', '1609990423', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3805', null, '160992174246', '', 'Hồ sơ #160992174246 đã cập nhật thông tin', '1609990455', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3806', null, '1609923557', '', 'Hồ sơ #1609923557 đã cập nhật thông tin', '1609990467', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3807', null, '160992174347', '', 'Hồ sơ #160992174347 đã cập nhật thông tin', '1609990509', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3808', null, '1609923592', '', 'Hồ sơ #1609923592 đã cập nhật thông tin', '1609990531', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3809', null, '160992174348', '', 'Hồ sơ #160992174348 đã cập nhật thông tin', '1609990556', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3810', null, '160992174349', '', 'Hồ sơ #160992174349 đã cập nhật thông tin', '1609990585', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3811', null, '160992174350', '', 'Hồ sơ #160992174350 đã cập nhật thông tin', '1609990628', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3812', null, '160992174351', '', 'Hồ sơ #160992174351 đã cập nhật thông tin', '1609990662', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3813', null, '160992174352', '', 'Hồ sơ #160992174352 đã cập nhật thông tin', '1609990694', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3814', null, '16099217421', '', 'Hồ sơ #16099217421 đã trúng tuyển', '1609990745', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3815', null, '16099217422', '', 'Hồ sơ #16099217422 đã trúng tuyển', '1609990748', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3816', null, '1609922828', '', 'Hồ sơ #1609922828 đã trúng tuyển', '1609990750', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3817', null, '16099217423', '', 'Hồ sơ #16099217423 đã trúng tuyển', '1609990751', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3818', null, '1609922884', '', 'Hồ sơ #1609922884 đã trúng tuyển', '1609990753', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3819', null, '1609923051', '', 'Hồ sơ #1609923051 đã trúng tuyển', '1609990754', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3820', null, '16099217424', '', 'Hồ sơ #16099217424 đã trúng tuyển', '1609990755', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3821', null, '1609923179', '', 'Hồ sơ #1609923179 đã trúng tuyển', '1609990757', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3822', null, '1609923219', '', 'Hồ sơ #1609923219 đã trúng tuyển', '1609990758', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3823', null, '16099217425', '', 'Hồ sơ #16099217425 đã trúng tuyển', '1609990759', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3824', null, '16099217426', '', 'Hồ sơ #16099217426 đã trúng tuyển', '1609990761', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3825', null, '16099217427', '', 'Hồ sơ #16099217427 đã trúng tuyển', '1609990762', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3826', null, '16099217428', '', 'Hồ sơ #16099217428 đã trúng tuyển', '1609990763', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3827', null, '16099217429', '', 'Hồ sơ #16099217429 đã trúng tuyển', '1609990764', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3828', null, '160992174210', '', 'Hồ sơ #160992174210 đã trúng tuyển', '1609990765', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3829', null, '160992174211', '', 'Hồ sơ #160992174211 đã trúng tuyển', '1609990767', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3830', null, '160992174212', '', 'Hồ sơ #160992174212 đã trúng tuyển', '1609990768', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3831', null, '160992174213', '', 'Hồ sơ #160992174213 đã trúng tuyển', '1609990769', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3832', null, '160992174214', '', 'Hồ sơ #160992174214 đã trúng tuyển', '1609990770', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3833', null, '160992174215', '', 'Hồ sơ #160992174215 đã trúng tuyển', '1609990771', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3834', null, '160992174216', '', 'Hồ sơ #160992174216 đã trúng tuyển', '1609990772', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3835', null, '160992174217', '', 'Hồ sơ #160992174217 đã trúng tuyển', '1609990773', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3836', null, '160992174218', '', 'Hồ sơ #160992174218 đã trúng tuyển', '1609990775', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3837', null, '1609923259', '', 'Hồ sơ #1609923259 đã trúng tuyển', '1609990776', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3838', null, '160992174219', '', 'Hồ sơ #160992174219 đã trúng tuyển', '1609990776', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3839', null, '160992174220', '', 'Hồ sơ #160992174220 đã trúng tuyển', '1609990777', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3840', null, '160992174221', '', 'Hồ sơ #160992174221 đã trúng tuyển', '1609990778', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3841', null, '1609923317', '', 'Hồ sơ #1609923317 đã trúng tuyển', '1609990779', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3842', null, '1609923371', '', 'Hồ sơ #1609923371 đã trúng tuyển', '1609990780', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3843', null, '160992174222', '', 'Hồ sơ #160992174222 đã trúng tuyển', '1609990781', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3844', null, '160992174223', '', 'Hồ sơ #160992174223 đã trúng tuyển', '1609990782', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3845', null, '1609923411', '', 'Hồ sơ #1609923411 đã trúng tuyển', '1609990783', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3846', null, '160992174224', '', 'Hồ sơ #160992174224 đã trúng tuyển', '1609990784', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3847', null, '160992174225', '', 'Hồ sơ #160992174225 đã trúng tuyển', '1609990785', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3848', null, '160992174226', '', 'Hồ sơ #160992174226 đã trúng tuyển', '1609990785', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3849', null, '160992174227', '', 'Hồ sơ #160992174227 đã trúng tuyển', '1609990786', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3850', null, '160992174228', '', 'Hồ sơ #160992174228 đã trúng tuyển', '1609990787', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3851', null, '160992174229', '', 'Hồ sơ #160992174229 đã trúng tuyển', '1609990788', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3852', null, '160992174230', '', 'Hồ sơ #160992174230 đã trúng tuyển', '1609990789', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3853', null, '160992174231', '', 'Hồ sơ #160992174231 đã trúng tuyển', '1609990790', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3854', null, '160992174232', '', 'Hồ sơ #160992174232 đã trúng tuyển', '1609990791', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3855', null, '160992174233', '', 'Hồ sơ #160992174233 đã trúng tuyển', '1609990792', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3856', null, '1609922428', '', 'Hồ sơ #1609922428 đã trúng tuyển', '1609990793', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3857', null, '160992174235', '', 'Hồ sơ #160992174235 đã trúng tuyển', '1609990794', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3858', null, '160992174236', '', 'Hồ sơ #160992174236 đã trúng tuyển', '1609990794', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3859', null, '160992174237', '', 'Hồ sơ #160992174237 đã trúng tuyển', '1609990795', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3860', null, '160992174238', '', 'Hồ sơ #160992174238 đã trúng tuyển', '1609990796', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3861', null, '160992174239', '', 'Hồ sơ #160992174239 đã trúng tuyển', '1609990797', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3862', null, '160992174240', '', 'Hồ sơ #160992174240 đã trúng tuyển', '1609990798', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3863', null, '160992174241', '', 'Hồ sơ #160992174241 đã trúng tuyển', '1609990799', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3864', null, '1609923461', '', 'Hồ sơ #1609923461 đã trúng tuyển', '1609990800', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3865', null, '160992174242', '', 'Hồ sơ #160992174242 đã trúng tuyển', '1609990801', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3866', null, '160992174243', '', 'Hồ sơ #160992174243 đã trúng tuyển', '1609990801', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3867', null, '1609923505', '', 'Hồ sơ #1609923505 đã trúng tuyển', '1609990802', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3868', null, '160992174244', '', 'Hồ sơ #160992174244 đã trúng tuyển', '1609990803', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3869', null, '160992174245', '', 'Hồ sơ #160992174245 đã trúng tuyển', '1609990804', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3870', null, '160992174246', '', 'Hồ sơ #160992174246 đã trúng tuyển', '1609990805', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3871', null, '1609923557', '', 'Hồ sơ #1609923557 đã trúng tuyển', '1609990806', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3872', null, '160992174347', '', 'Hồ sơ #160992174347 đã trúng tuyển', '1609990806', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3873', null, '1609923592', '', 'Hồ sơ #1609923592 đã trúng tuyển', '1609990809', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3874', null, '160992174348', '', 'Hồ sơ #160992174348 đã trúng tuyển', '1609990810', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3875', null, '160992174349', '', 'Hồ sơ #160992174349 đã trúng tuyển', '1609990811', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3876', null, '160992174350', '', 'Hồ sơ #160992174350 đã trúng tuyển', '1609990812', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3877', null, '160992174351', '', 'Hồ sơ #160992174351 đã trúng tuyển', '1609990813', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3878', null, '160992174352', '', 'Hồ sơ #160992174352 đã trúng tuyển', '1609990814', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3879', null, '16099217421', '20AUM116363', 'Hồ sơ #16099217421 đã nhập học', '1609990862', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3880', null, '16099217422', '20AUM116364', 'Hồ sơ #16099217422 đã nhập học', '1609990872', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3881', null, '16099217423', '20AUM116366', 'Hồ sơ #16099217423 đã nhập học', '1609990882', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3882', null, '16099217424', '20AUM116369', 'Hồ sơ #16099217424 đã nhập học', '1610006035', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3883', null, '16099217425', '20AUM116372', 'Hồ sơ #16099217425 đã nhập học', '1610006040', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3884', null, '16099217426', '20AUM116373', 'Hồ sơ #16099217426 đã nhập học', '1610006046', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3885', null, '16099217427', '20AUM116374', 'Hồ sơ #16099217427 đã nhập học', '1610006051', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3886', null, '16099217428', '20AUM116375', 'Hồ sơ #16099217428 đã nhập học', '1610006057', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3887', null, '16099217429', '20AUM116376', 'Hồ sơ #16099217429 đã nhập học', '1610006062', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3888', null, '160992174210', '20AUM116377', 'Hồ sơ #160992174210 đã nhập học', '1610006067', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3889', null, '160992174211', '20AUM116378', 'Hồ sơ #160992174211 đã nhập học', '1610006074', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3890', null, '160992174212', '20AUM116379', 'Hồ sơ #160992174212 đã nhập học', '1610006079', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3891', null, '160992174213', '20AUM116380', 'Hồ sơ #160992174213 đã nhập học', '1610006084', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3892', null, '160992174214', '20AUM116381', 'Hồ sơ #160992174214 đã nhập học', '1610006089', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3893', null, '160992174215', '20AUM116382', 'Hồ sơ #160992174215 đã nhập học', '1610006094', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3894', null, '160992174216', '20AUM116383', 'Hồ sơ #160992174216 đã nhập học', '1610006098', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3895', null, '160992174217', '20AUM116384', 'Hồ sơ #160992174217 đã nhập học', '1610006104', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3896', null, '160992174218', '20AUM116385', 'Hồ sơ #160992174218 đã nhập học', '1610006134', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3897', null, '160992174219', '20AUM116387', 'Hồ sơ #160992174219 đã nhập học', '1610006141', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3898', null, '160992174220', '20AUM116388', 'Hồ sơ #160992174220 đã nhập học', '1610006147', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3899', null, '160992174221', '20AUM116389', 'Hồ sơ #160992174221 đã nhập học', '1610006259', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3900', null, '160992174222', '20AUM116392', 'Hồ sơ #160992174222 đã nhập học', '1610006265', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3901', null, '160992174223', '20AUM116393', 'Hồ sơ #160992174223 đã nhập học', '1610006270', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3902', null, '160992174224', '20AUM116395', 'Hồ sơ #160992174224 đã nhập học', '1610006274', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3903', null, '160992174225', '20AUM116396', 'Hồ sơ #160992174225 đã nhập học', '1610006279', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3904', null, '160992174226', '20AUM116397', 'Hồ sơ #160992174226 đã nhập học', '1610006284', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3905', null, '160992174227', '20AUM116398', 'Hồ sơ #160992174227 đã nhập học', '1610006289', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3906', null, '160992174228', '20AUM116399', 'Hồ sơ #160992174228 đã nhập học', '1610006295', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3907', null, '160992174229', '20AUM116400', 'Hồ sơ #160992174229 đã nhập học', '1610006300', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3908', null, '160992174230', '20AUM116401', 'Hồ sơ #160992174230 đã nhập học', '1610006310', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3909', null, '160992174231', '20AUM116402', 'Hồ sơ #160992174231 đã nhập học', '1610006314', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3910', null, '160992174232', '20AUM116403', 'Hồ sơ #160992174232 đã nhập học', '1610006319', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3911', null, '160992174233', '20AUM116404', 'Hồ sơ #160992174233 đã nhập học', '1610006324', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3912', null, '160992174235', '20AUM116406', 'Hồ sơ #160992174235 đã nhập học', '1610006328', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3913', null, '160992174236', '20AUM116407', 'Hồ sơ #160992174236 đã nhập học', '1610006333', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3914', null, '160992174237', '20AUM116408', 'Hồ sơ #160992174237 đã nhập học', '1610006342', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3915', null, '160992174238', '20AUM116409', 'Hồ sơ #160992174238 đã nhập học', '1610006348', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3916', null, '160992174239', '20AUM116410', 'Hồ sơ #160992174239 đã nhập học', '1610006356', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3917', null, '160992174240', '20AUM116411', 'Hồ sơ #160992174240 đã nhập học', '1610006361', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3918', null, '160992174241', '20AUM116412', 'Hồ sơ #160992174241 đã nhập học', '1610006375', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3919', null, '160992174242', '20AUM116414', 'Hồ sơ #160992174242 đã nhập học', '1610006382', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3920', null, '160992174243', '20AUM116415', 'Hồ sơ #160992174243 đã nhập học', '1610006387', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3921', null, '160992174244', '20AUM116417', 'Hồ sơ #160992174244 đã nhập học', '1610006392', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3922', null, '160992174245', '20AUM116418', 'Hồ sơ #160992174245 đã nhập học', '1610006397', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3923', null, '160992174246', '20AUM116419', 'Hồ sơ #160992174246 đã nhập học', '1610006402', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3924', null, '160992174347', '20AUM116421', 'Hồ sơ #160992174347 đã nhập học', '1610006407', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3925', null, '160992174348', '20AUM116423', 'Hồ sơ #160992174348 đã nhập học', '1610006411', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3926', null, '160992174349', '20AUM116424', 'Hồ sơ #160992174349 đã nhập học', '1610006415', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3927', null, '160992174350', '20AUM116425', 'Hồ sơ #160992174350 đã nhập học', '1610006420', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3928', null, '160992174351', '20AUM116426', 'Hồ sơ #160992174351 đã nhập học', '1610006424', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3929', null, '160992174352', '20AUM116427', 'Hồ sơ #160992174352 đã nhập học', '1610006429', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3930', null, '1609922428', '20AUM116405', 'Hồ sơ #1609922428 đã nhập học', '1610006433', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3931', null, '1609922828', '20AUM116365', 'Hồ sơ #1609922828 đã nhập học', '1610006437', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3932', null, '1609922884', '20AUM116367', 'Hồ sơ #1609922884 đã nhập học', '1610006442', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3933', null, '1609923051', '20AUM116368', 'Hồ sơ #1609923051 đã nhập học', '1610006446', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3934', null, '1609923179', '20AUM116370', 'Hồ sơ #1609923179 đã nhập học', '1610006451', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3935', null, '1609923219', '20AUM116371', 'Hồ sơ #1609923219 đã nhập học', '1610006455', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3936', null, '1609923259', '20AUM116386', 'Hồ sơ #1609923259 đã nhập học', '1610006459', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3937', null, '1609923317', '20AUM116390', 'Hồ sơ #1609923317 đã nhập học', '1610006463', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3938', null, '1609923371', '20AUM116391', 'Hồ sơ #1609923371 đã nhập học', '1610006467', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3939', null, '1609923411', '20AUM116394', 'Hồ sơ #1609923411 đã nhập học', '1610006471', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3940', null, '1609923461', '20AUM116413', 'Hồ sơ #1609923461 đã nhập học', '1610006475', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3941', null, '1609923505', '20AUM116416', 'Hồ sơ #1609923505 đã nhập học', '1610006479', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3942', null, '1609923557', '20AUM116420', 'Hồ sơ #1609923557 đã nhập học', '1610006484', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3943', null, '1609923592', '20AUM116422', 'Hồ sơ #1609923592 đã nhập học', '1610006488', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3944', null, null, '20AUM116363', 'Mã SV #20AUM116363 đã được thêm vào lớp el21_lkt11', '1610006637', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3945', null, null, '20AUM116364', 'Mã SV #20AUM116364 đã được thêm vào lớp el21_lkt11', '1610006647', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3946', null, null, '20AUM116366', 'Mã SV #20AUM116366 đã được thêm vào lớp el21_lkt11', '1610006656', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3947', null, null, '20AUM116369', 'Mã SV #20AUM116369 đã được thêm vào lớp el21_lkt11', '1610006667', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3948', null, null, '20AUM116372', 'Mã SV #20AUM116372 đã được thêm vào lớp el21_lkt11', '1610006674', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3949', null, null, '20AUM116373', 'Mã SV #20AUM116373 đã được thêm vào lớp el21_lkt11', '1610006799', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3950', null, null, '20AUM116374', 'Mã SV #20AUM116374 đã được thêm vào lớp el21_lkt11', '1610006807', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3951', null, null, '20AUM116375', 'Mã SV #20AUM116375 đã được thêm vào lớp el21_lkt11', '1610006816', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3952', null, null, '20AUM116376', 'Mã SV #20AUM116376 đã được thêm vào lớp el21_lkt11', '1610006824', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3953', null, null, '20AUM116377', 'Mã SV #20AUM116377 đã được thêm vào lớp el21_lkt11', '1610006831', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3954', null, null, '20AUM116378', 'Mã SV #20AUM116378 đã được thêm vào lớp el21_lkt11', '1610006861', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3955', null, null, '20AUM116379', 'Mã SV #20AUM116379 đã được thêm vào lớp el21_lkt11', '1610006868', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3956', null, null, '20AUM116380', 'Mã SV #20AUM116380 đã được thêm vào lớp el21_lkt11', '1610006876', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3957', null, null, '20AUM116381', 'Mã SV #20AUM116381 đã được thêm vào lớp el21_lkt11', '1610006984', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3958', null, null, '20AUM116382', 'Mã SV #20AUM116382 đã được thêm vào lớp el21_lkt11', '1610006993', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3959', null, null, '20AUM116383', 'Mã SV #20AUM116383 đã được thêm vào lớp el21_lkt11', '1610007000', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3960', null, null, '20AUM116384', 'Mã SV #20AUM116384 đã được thêm vào lớp el21_lkt11', '1610007008', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3961', null, null, '20AUM116385', 'Mã SV #20AUM116385 đã được thêm vào lớp el21_lkt11', '1610007015', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3962', null, null, '20AUM116387', 'Mã SV #20AUM116387 đã được thêm vào lớp el21_lkt11', '1610007025', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3963', null, null, '20AUM116388', 'Mã SV #20AUM116388 đã được thêm vào lớp el21_lkt11', '1610007034', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3964', null, null, '20AUM116389', 'Mã SV #20AUM116389 đã được thêm vào lớp el21_lkt11', '1610007041', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3965', null, null, '20AUM116392', 'Mã SV #20AUM116392 đã được thêm vào lớp el21_lkt11', '1610007048', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3966', null, null, '20AUM116393', 'Mã SV #20AUM116393 đã được thêm vào lớp el21_lkt11', '1610007056', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3967', null, null, '20AUM116395', 'Mã SV #20AUM116395 đã được thêm vào lớp el21_lkt11', '1610007064', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3968', null, null, '20AUM116396', 'Mã SV #20AUM116396 đã được thêm vào lớp el21_lkt11', '1610007083', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3969', null, null, '20AUM116397', 'Mã SV #20AUM116397 đã được thêm vào lớp el21_lkt11', '1610007090', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3970', null, null, '20AUM116398', 'Mã SV #20AUM116398 đã được thêm vào lớp el21_lkt11', '1610007097', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3971', null, null, '20AUM116399', 'Mã SV #20AUM116399 đã được thêm vào lớp el21_lkt11', '1610007104', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3972', null, null, '20AUM116400', 'Mã SV #20AUM116400 đã được thêm vào lớp el21_lkt11', '1610007111', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3973', null, null, '20AUM116401', 'Mã SV #20AUM116401 đã được thêm vào lớp el21_lkt11', '1610007118', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3974', null, null, '20AUM116402', 'Mã SV #20AUM116402 đã được thêm vào lớp el21_lkt11', '1610007125', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3975', null, null, '20AUM116403', 'Mã SV #20AUM116403 đã được thêm vào lớp el21_lkt11', '1610007132', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3976', null, null, '20AUM116404', 'Mã SV #20AUM116404 đã được thêm vào lớp el21_lkt11', '1610007144', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3977', null, null, '20AUM116406', 'Mã SV #20AUM116406 đã được thêm vào lớp el21_lkt11', '1610007164', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3978', null, null, '20AUM116407', 'Mã SV #20AUM116407 đã được thêm vào lớp el21_lkt11', '1610007171', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3979', null, null, '20AUM116408', 'Mã SV #20AUM116408 đã được thêm vào lớp el21_lkt11', '1610007178', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3980', null, null, '20AUM116409', 'Mã SV #20AUM116409 đã được thêm vào lớp el21_lkt11', '1610007184', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3981', null, null, '20AUM116410', 'Mã SV #20AUM116410 đã được thêm vào lớp el21_lkt11', '1610007191', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3982', null, null, '20AUM116411', 'Mã SV #20AUM116411 đã được thêm vào lớp el21_lkt11', '1610007197', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3983', null, null, '20AUM116412', 'Mã SV #20AUM116412 đã được thêm vào lớp el21_lkt11', '1610007204', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3984', null, null, '20AUM116414', 'Mã SV #20AUM116414 đã được thêm vào lớp el21_lkt11', '1610007211', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3985', null, null, '20AUM116415', 'Mã SV #20AUM116415 đã được thêm vào lớp el21_lkt11', '1610007218', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3986', null, null, '20AUM116417', 'Mã SV #20AUM116417 đã được thêm vào lớp el21_lkt11', '1610007224', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3987', null, null, '20AUM116418', 'Mã SV #20AUM116418 đã được thêm vào lớp el21_lkt11', '1610007234', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3988', null, null, '20AUM116419', 'Mã SV #20AUM116419 đã được thêm vào lớp el21_lkt11', '1610007241', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3989', null, null, '20AUM116421', 'Mã SV #20AUM116421 đã được thêm vào lớp el21_lkt11', '1610007248', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3990', null, null, '20AUM116423', 'Mã SV #20AUM116423 đã được thêm vào lớp el21_lkt11', '1610007255', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3991', null, null, '20AUM116424', 'Mã SV #20AUM116424 đã được thêm vào lớp el21_lkt11', '1610007262', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3992', null, null, '20AUM116425', 'Mã SV #20AUM116425 đã được thêm vào lớp el21_lkt11', '1610007269', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3993', null, null, '20AUM116426', 'Mã SV #20AUM116426 đã được thêm vào lớp el21_lkt11', '1610007276', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3994', null, null, '20AUM116427', 'Mã SV #20AUM116427 đã được thêm vào lớp el21_lkt11', '1610007283', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3995', null, null, '20AUM116405', 'Mã SV #20AUM116405 đã được thêm vào lớp el21_lkt11', '1610007290', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3996', null, null, '20AUM116365', 'Mã SV #20AUM116365 đã được thêm vào lớp el21_lkt11', '1610007302', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3997', null, null, '20AUM116367', 'Mã SV #20AUM116367 đã được thêm vào lớp el21_lkt11', '1610007309', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3998', null, null, '20AUM116368', 'Mã SV #20AUM116368 đã được thêm vào lớp el21_lkt11', '1610007316', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('3999', null, null, '20AUM116370', 'Mã SV #20AUM116370 đã được thêm vào lớp el21_lkt11', '1610007323', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4000', null, null, '20AUM116371', 'Mã SV #20AUM116371 đã được thêm vào lớp el21_lkt11', '1610007329', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4001', null, null, '20AUM116386', 'Mã SV #20AUM116386 đã được thêm vào lớp el21_lkt11', '1610007336', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4002', null, null, '20AUM116390', 'Mã SV #20AUM116390 đã được thêm vào lớp el21_lkt11', '1610007344', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4003', null, null, '20AUM116391', 'Mã SV #20AUM116391 đã được thêm vào lớp el21_lkt11', '1610007353', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4004', null, null, '20AUM116394', 'Mã SV #20AUM116394 đã được thêm vào lớp el21_lkt11', '1610007360', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4005', null, null, '20AUM116413', 'Mã SV #20AUM116413 đã được thêm vào lớp el21_lkt11', '1610007367', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4006', null, null, '20AUM116416', 'Mã SV #20AUM116416 đã được thêm vào lớp el21_lkt11', '1610007373', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4007', null, null, '20AUM116420', 'Mã SV #20AUM116420 đã được thêm vào lớp el21_lkt11', '1610007380', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4008', null, null, '20AUM116422', 'Mã SV #20AUM116422 đã được thêm vào lớp el21_lkt11', '1610007387', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4009', null, '1610175409', '', 'Hồ sơ #1610175409 (Lê Bá Anh) tạo mới thành công', '1610175452', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4010', null, '1610175409', '', 'Hồ sơ #1610175409 đã cập nhật thông tin', '1610175465', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4011', null, '1610175471', '', 'Hồ sơ #1610175471 (Đặng Nguyễn Hải Đăng) tạo mới thành công', '1610175493', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4012', null, '1610175471', '', 'Hồ sơ #1610175471 đã cập nhật thông tin', '1610175501', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4013', null, '1610175509', '', 'Hồ sơ #1610175509 (Lê Thị Bích Hồng) tạo mới thành công', '1610175540', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4014', null, '1610175509', '', 'Hồ sơ #1610175509 đã cập nhật thông tin', '1610175549', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4015', null, '1610175554', '', 'Hồ sơ #1610175554 (Hồ Thị Thanh Huyền) tạo mới thành công', '1610175589', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4016', null, '1610175554', '', 'Hồ sơ #1610175554 đã cập nhật thông tin', '1610175597', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4017', null, '1610175602', '', 'Hồ sơ #1610175602 (Lê Phước Thắng) tạo mới thành công', '1610175633', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4018', null, '1610175602', '', 'Hồ sơ #1610175602 đã cập nhật thông tin', '1610175641', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4019', null, '1610175647', '', 'Hồ sơ #1610175647 (Phạm Xuân Trường) tạo mới thành công', '1610175674', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4020', null, '1610175647', '', 'Hồ sơ #1610175647 đã cập nhật thông tin', '1610175683', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4021', null, '1610175688', '', 'Hồ sơ #1610175688 (Đoàn Phan Vũ) tạo mới thành công', '1610175715', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4022', null, '1610175688', '', 'Hồ sơ #1610175688 đã cập nhật thông tin', '1610175724', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4023', null, '1610175688', '', 'Hồ sơ #1610175688 đã cập nhật thông tin', '1610175776', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4024', null, '1610175782', '', 'Hồ sơ #1610175782 (Nguyễn Thị Thuỳ Dung) tạo mới thành công', '1610175810', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4025', null, '1610175782', '', 'Hồ sơ #1610175782 đã cập nhật thông tin', '1610175818', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4026', null, '1610175847', '', 'Hồ sơ #1610175847 (Nguyễn Bảo Long) tạo mới thành công', '1610176202', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4027', null, '1610175847', '', 'Hồ sơ #1610175847 đã cập nhật thông tin', '1610176210', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4028', null, '1610176218', '', 'Hồ sơ #1610176218 (Trần Hồng Phong) tạo mới thành công', '1610176246', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4029', null, '1610176218', '', 'Hồ sơ #1610176218 đã cập nhật thông tin', '1610176254', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4030', null, '1610176263', '', 'Hồ sơ #1610176263 (Đào Kim Chi) tạo mới thành công', '1610176294', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4031', null, '1610176263', '', 'Hồ sơ #1610176263 đã cập nhật thông tin', '1610176304', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4032', null, '1610176310', '', 'Hồ sơ #1610176310 (Đặng Thu Hiền) tạo mới thành công', '1610176349', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4033', null, '1610176310', '', 'Hồ sơ #1610176310 đã cập nhật thông tin', '1610176376', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4034', null, '1610176382', '', 'Hồ sơ #1610176382 (Lê Văn Hoà) tạo mới thành công', '1610176410', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4035', null, '1610176382', '', 'Hồ sơ #1610176382 đã cập nhật thông tin', '1610176418', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4036', null, '1610176382', '', 'Hồ sơ #1610176382 đã cập nhật thông tin', '1610176452', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4037', null, '1610176460', '', 'Hồ sơ #1610176460 (Trần Hoàng Lam) tạo mới thành công', '1610176485', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4038', null, '1610176460', '', 'Hồ sơ #1610176460 đã cập nhật thông tin', '1610176493', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4039', null, '1610176498', '', 'Hồ sơ #1610176498 (Crujang Cơi Long) tạo mới thành công', '1610176524', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4040', null, '1610176498', '', 'Hồ sơ #1610176498 đã cập nhật thông tin', '1610176532', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4041', null, '1610176544', '', 'Hồ sơ #1610176544 (Nguyễn Thị Lợi) tạo mới thành công', '1610176579', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4042', null, '1610176544', '', 'Hồ sơ #1610176544 đã cập nhật thông tin', '1610176590', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4043', null, '1610176624', '', 'Hồ sơ #1610176624 (K\' Mai Ly) tạo mới thành công', '1610176878', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4044', null, '1610176624', '', 'Hồ sơ #1610176624 đã cập nhật thông tin', '1610176886', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4045', null, '1610176892', '', 'Hồ sơ #1610176892 (Nguyễn Thị Trang Nhung) tạo mới thành công', '1610177493', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4046', null, '1610176892', '', 'Hồ sơ #1610176892 đã cập nhật thông tin', '1610177500', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4047', null, '1610177507', '', 'Hồ sơ #1610177507 (Nguyễn Mạnh Tuân) tạo mới thành công', '1610177543', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4048', null, '1610177507', '', 'Hồ sơ #1610177507 đã cập nhật thông tin', '1610177550', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4049', null, '1610177575', '', 'Hồ sơ #1610177575 (Ya Tứ) tạo mới thành công', '1610177599', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4050', null, '1610177575', '', 'Hồ sơ #1610177575 đã cập nhật thông tin', '1610177607', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4051', null, '1610177775', '', 'Hồ sơ #1610177775 (Đỗ Thị Ngọc Thảo) tạo mới thành công', '1610177799', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4052', null, '1610177775', '', 'Hồ sơ #1610177775 đã cập nhật thông tin', '1610177807', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4053', null, '1610177813', '', 'Hồ sơ #1610177813 (Đinh Tường Vi) tạo mới thành công', '1610177845', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4054', null, '1610177813', '', 'Hồ sơ #1610177813 đã cập nhật thông tin', '1610177860', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4055', null, '1610177872', '', 'Hồ sơ #1610177872 (Huỳnh Đình Thịnh) tạo mới thành công', '1610177905', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4056', null, '1610177872', '', 'Hồ sơ #1610177872 đã cập nhật thông tin', '1610177913', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4057', null, '1610177920', '', 'Hồ sơ #1610177920 (Giang Chí Hào) tạo mới thành công', '1610177942', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4058', null, '1610177920', '', 'Hồ sơ #1610177920 đã cập nhật thông tin', '1610177950', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4059', null, '1610178041', '', 'Hồ sơ #1610178041 (Đỗ Sĩ Kiêm) tạo mới thành công', '1610178605', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4060', null, '1610178041', '', 'Hồ sơ #1610178041 đã cập nhật thông tin', '1610178616', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4061', null, '1610178625', '', 'Hồ sơ #1610178625 (Nguyễn Thảo Vy) tạo mới thành công', '1610178846', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4062', null, '1610178625', '', 'Hồ sơ #1610178625 đã cập nhật thông tin', '1610178856', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4063', null, '1610178937', '', 'Hồ sơ #1610178937 (Tạ Văn Tuấn) tạo mới thành công', '1610178963', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4064', null, '1610178937', '', 'Hồ sơ #1610178937 đã cập nhật thông tin', '1610178978', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4065', null, '1610175409', '', 'Hồ sơ #1610175409 đã trúng tuyển', '1610179039', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4066', null, '1610175471', '', 'Hồ sơ #1610175471 đã trúng tuyển', '1610179041', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4067', null, '1610175509', '', 'Hồ sơ #1610175509 đã trúng tuyển', '1610179042', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4068', null, '1610175554', '', 'Hồ sơ #1610175554 đã trúng tuyển', '1610179043', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4069', null, '1610175602', '', 'Hồ sơ #1610175602 đã trúng tuyển', '1610179044', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4070', null, '1610175647', '', 'Hồ sơ #1610175647 đã trúng tuyển', '1610179045', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4071', null, '1610175688', '', 'Hồ sơ #1610175688 đã trúng tuyển', '1610179046', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4072', null, '1610175782', '', 'Hồ sơ #1610175782 đã trúng tuyển', '1610179048', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4073', null, '1610175847', '', 'Hồ sơ #1610175847 đã trúng tuyển', '1610179050', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4074', null, '1610176218', '', 'Hồ sơ #1610176218 đã trúng tuyển', '1610179051', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4075', null, '1610176263', '', 'Hồ sơ #1610176263 đã trúng tuyển', '1610179052', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4076', null, '1610176310', '', 'Hồ sơ #1610176310 đã trúng tuyển', '1610179053', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4077', null, '1610176382', '', 'Hồ sơ #1610176382 đã trúng tuyển', '1610179054', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4078', null, '1610176460', '', 'Hồ sơ #1610176460 đã trúng tuyển', '1610179056', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4079', null, '1610176498', '', 'Hồ sơ #1610176498 đã trúng tuyển', '1610179057', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4080', null, '1610176544', '', 'Hồ sơ #1610176544 đã trúng tuyển', '1610179058', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4081', null, '1610176624', '', 'Hồ sơ #1610176624 đã trúng tuyển', '1610179060', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4082', null, '1610176892', '', 'Hồ sơ #1610176892 đã trúng tuyển', '1610179061', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4083', null, '1610177507', '', 'Hồ sơ #1610177507 đã trúng tuyển', '1610179065', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4084', null, '1610178937', '', 'Hồ sơ #1610178937 đã trúng tuyển', '1610179068', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4085', null, '1610177575', '', 'Hồ sơ #1610177575 đã trúng tuyển', '1610179071', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4086', null, '1610177775', '', 'Hồ sơ #1610177775 đã trúng tuyển', '1610179072', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4087', null, '1610177813', '', 'Hồ sơ #1610177813 đã trúng tuyển', '1610179073', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4088', null, '1610177872', '', 'Hồ sơ #1610177872 đã trúng tuyển', '1610179074', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4089', null, '1610177920', '', 'Hồ sơ #1610177920 đã trúng tuyển', '1610179074', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4090', null, '1610178041', '', 'Hồ sơ #1610178041 đã trúng tuyển', '1610179075', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4091', null, '1610178625', '', 'Hồ sơ #1610178625 đã trúng tuyển', '1610179076', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4092', null, null, '20AUM114271', '#20AUM114271 đăng ký thi lại.', '1610440734', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4093', null, '', '', '#20AUM114271 KQ lần 2: Không đạt môn MC02', '1610440750', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4094', null, null, '20AUM116343', '#20AUM116343 đăng ký thi lại.', '1610440949', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4095', null, '1610175409', '20AUM116428', 'Hồ sơ #1610175409 đã nhập học', '1610936527', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4096', null, '1610175471', '20AUM116429', 'Hồ sơ #1610175471 đã nhập học', '1610936537', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4097', null, '1610175509', '20AUM116430', 'Hồ sơ #1610175509 đã nhập học', '1610936547', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4098', null, '1610175554', '20AUM116431', 'Hồ sơ #1610175554 đã nhập học', '1610936555', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4099', null, '1610175602', '20AUM116432', 'Hồ sơ #1610175602 đã nhập học', '1610936561', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4100', null, '1610175647', '20AUM116433', 'Hồ sơ #1610175647 đã nhập học', '1610936567', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4101', null, '1610175688', '20AUM116434', 'Hồ sơ #1610175688 đã nhập học', '1610936573', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4102', null, '1610175782', '20AUM116435', 'Hồ sơ #1610175782 đã nhập học', '1610936580', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4103', null, '1610175847', '20AUM116436', 'Hồ sơ #1610175847 đã nhập học', '1610936585', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4104', null, '1610176218', '20AUM116437', 'Hồ sơ #1610176218 đã nhập học', '1610936591', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4105', null, '1610176263', '20AUM116438', 'Hồ sơ #1610176263 đã nhập học', '1610936598', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4106', null, '1610176310', '20AUM116439', 'Hồ sơ #1610176310 đã nhập học', '1610936604', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4107', null, '1610176382', '20AUM116440', 'Hồ sơ #1610176382 đã nhập học', '1610936609', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4108', null, '1610176460', '20AUM116441', 'Hồ sơ #1610176460 đã nhập học', '1610936616', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4109', null, '1610176498', '20AUM116442', 'Hồ sơ #1610176498 đã nhập học', '1610936623', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4110', null, '1610176544', '20AUM116443', 'Hồ sơ #1610176544 đã nhập học', '1610936631', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4111', null, '1610176624', '20AUM116444', 'Hồ sơ #1610176624 đã nhập học', '1610936643', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4112', null, '1610176892', '20AUM116445', 'Hồ sơ #1610176892 đã nhập học', '1610936690', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4113', null, '1610177507', '20AUM116446', 'Hồ sơ #1610177507 đã nhập học', '1610936697', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4114', null, '1610177575', '20AUM116447', 'Hồ sơ #1610177575 đã nhập học', '1610936705', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4115', null, '1610177775', '20AUM116448', 'Hồ sơ #1610177775 đã nhập học', '1610936711', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4116', null, '1610177813', '20AUM116449', 'Hồ sơ #1610177813 đã nhập học', '1610936717', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4117', null, '1610177872', '20AUM116450', 'Hồ sơ #1610177872 đã nhập học', '1610936723', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4118', null, '1610177920', '20AUM116451', 'Hồ sơ #1610177920 đã nhập học', '1610936729', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4119', null, '1610178041', '20AUM116452', 'Hồ sơ #1610178041 đã nhập học', '1610936735', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4120', null, '1610178625', '20AUM116453', 'Hồ sơ #1610178625 đã nhập học', '1610936741', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4121', null, '1610178937', '20AUM116454', 'Hồ sơ #1610178937 đã nhập học', '1610936748', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4122', null, null, '20AUM116428', 'Mã SV #20AUM116428 đã được thêm vào lớp el3_lkt11', '1610936875', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4123', null, null, '20AUM116429', 'Mã SV #20AUM116429 đã được thêm vào lớp el3_lkt11', '1610937158', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4124', null, null, '20AUM116430', 'Mã SV #20AUM116430 đã được thêm vào lớp el3_lkt11', '1610937170', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4125', null, null, '20AUM116431', 'Mã SV #20AUM116431 đã được thêm vào lớp el3_lkt11', '1610937179', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4126', null, null, '20AUM116432', 'Mã SV #20AUM116432 đã được thêm vào lớp el3_lkt11', '1610937249', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4127', null, null, '20AUM116433', 'Mã SV #20AUM116433 đã được thêm vào lớp el3_lkt11', '1610937273', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4128', null, null, '20AUM116434', 'Mã SV #20AUM116434 đã được thêm vào lớp el3_lkt11', '1610937283', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4129', null, null, '20AUM116435', 'Mã SV #20AUM116435 đã được thêm vào lớp el3_lkt11', '1610937293', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4130', null, null, '20AUM116436', 'Mã SV #20AUM116436 đã được thêm vào lớp el3_lkt11', '1610937303', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4131', null, null, '20AUM116437', 'Mã SV #20AUM116437 đã được thêm vào lớp el3_lkt11', '1610937327', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4132', null, null, '20AUM116438', 'Mã SV #20AUM116438 đã được thêm vào lớp el3_lkt11', '1610937336', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4133', null, null, '20AUM116439', 'Mã SV #20AUM116439 đã được thêm vào lớp el3_lkt11', '1610937351', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4134', null, null, '20AUM116440', 'Mã SV #20AUM116440 đã được thêm vào lớp el3_lkt11', '1610937360', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4135', null, null, '20AUM116441', 'Mã SV #20AUM116441 đã được thêm vào lớp el3_lkt11', '1610937373', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4136', null, null, '20AUM116442', 'Mã SV #20AUM116442 đã được thêm vào lớp el3_lkt11', '1610937383', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4137', null, null, '20AUM116443', 'Mã SV #20AUM116443 đã được thêm vào lớp el3_lkt11', '1610937392', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4138', null, null, '20AUM116444', 'Mã SV #20AUM116444 đã được thêm vào lớp el3_lkt11', '1610937440', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4139', null, null, '20AUM116445', 'Mã SV #20AUM116445 đã được thêm vào lớp el3_lkt11', '1610937449', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4140', null, null, '20AUM116446', 'Mã SV #20AUM116446 đã được thêm vào lớp el3_lkt11', '1610937459', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4141', null, null, '20AUM116447', 'Mã SV #20AUM116447 đã được thêm vào lớp el3_lkt11', '1610937467', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4142', null, null, '20AUM116448', 'Mã SV #20AUM116448 đã được thêm vào lớp el3_lkt11', '1610937478', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4143', null, null, '20AUM116449', 'Mã SV #20AUM116449 đã được thêm vào lớp el3_lkt11', '1610937490', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4144', null, null, '20AUM116450', 'Mã SV #20AUM116450 đã được thêm vào lớp el3_lkt11', '1610937499', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4145', null, null, '20AUM116451', 'Mã SV #20AUM116451 đã được thêm vào lớp el3_lkt11', '1610937508', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4146', null, null, '20AUM116452', 'Mã SV #20AUM116452 đã được thêm vào lớp el3_lkt11', '1610937517', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4147', null, null, '20AUM116453', 'Mã SV #20AUM116453 đã được thêm vào lớp el3_lkt11', '1610937526', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4148', null, null, '20AUM116454', 'Mã SV #20AUM116454 đã được thêm vào lớp el3_lkt11', '1610937535', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4149', null, '1610940369', '', 'Hồ sơ #1610940369 (Nguyễn Văn Bình) tạo mới thành công', '1610940706', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4150', null, '1610940369', '', 'Hồ sơ #1610940369 đã cập nhật thông tin', '1610940719', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4151', null, '1610940726', '', 'Hồ sơ #1610940726 (Sùng Thị Công) tạo mới thành công', '1610940758', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4152', null, '1610940726', '', 'Hồ sơ #1610940726 đã cập nhật thông tin', '1610940772', 'admindemo', '0');
INSERT INTO `tbl_notify` VALUES ('4153', null, '1610940726', '', 'Hồ sơ #1610940726 đã trúng tuyển', '1615363889', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4154', null, '1610940726', '', 'Hồ sơ #1610940726 hủy trúng tuyển', '1615824489', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4155', null, '1610940726', '', 'Hồ sơ #1610940726 hủy trúng tuyển', '1615824492', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4156', null, '1610940726', '', 'Hồ sơ #1610940726 hủy trúng tuyển', '1615824565', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4157', null, '1610940726', '', 'Hồ sơ #1610940726 hủy trúng tuyển', '1615824697', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4158', null, '1610940726', '', 'Hồ sơ #1610940726 hủy trúng tuyển', '1615824738', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4159', null, '1610940726', '', 'Hồ sơ #1610940726 hủy trúng tuyển', '1615824754', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4160', null, '1610940726', '', 'Hồ sơ #1610940726 đã trúng tuyển', '1615824772', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4161', null, '1610940726', '', 'Hồ sơ #1610940726 đã trúng tuyển', '1615824772', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4162', null, '1610940726', '', 'Hồ sơ #1610940726 hủy trúng tuyển', '1615824878', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4163', null, '1610940726', '', 'Hồ sơ #1610940726 đã trúng tuyển', '1615825071', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4164', null, '1610940726', '', 'Hồ sơ #1610940726 đã trúng tuyển', '1615825071', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4165', null, '159980920118', '20AUM116303', 'Thêm khoản học phí: test, số tiền 1,500,000 VNĐ', '1615830704', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4166', null, null, '20AUM116303', 'Xóa danh mục học phí test', '1615830717', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4167', null, '159980920118', '20AUM116303', 'Đã đóng 6,230,000 VNĐ', '1615830738', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4168', null, '159980920111', '20AUM116296', 'Đã đóng 300,000 VNĐ', '1615830778', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4169', null, '1610940726', '', 'Hồ sơ #1610940726 đăng ký ngành thành công', '1616469760', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4170', null, '1599788697', '', 'Hồ sơ #1599788697 đăng ký ngành thành công', '1616488717', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4171', null, '1599788697', '', 'Hồ sơ #1599788697 đăng ký ngành thành công', '1616488724', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4172', null, '1599788697', '', 'Hồ sơ #1599788697 đã trúng tuyển', '1616491327', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4173', null, '1599788697', '20AUM114271', 'Hồ sơ #1599788697 đã nhập học', '1616491368', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4174', null, null, '20AUM114271', 'Mã SV #20AUM114271 đã được thêm vào lớp el1_qtkd11', '1616493672', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4175', null, null, '20AUM114271', 'Mã SV #20AUM114271 đã được thêm vào lớp el21_lkt11', '1616493682', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4176', null, null, '20AUM114271', 'Mã SV #20AUM114271 đã được thêm vào lớp aa123', '1616493690', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4177', null, '1599788697', '20AUM114271', 'Đã đóng 14,380,000 VNĐ', '1616554837', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4178', null, null, '20AUM114271', 'Xóa danh mục học phí Chủ nghĩa xã hội khoa học', '1616560632', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4179', null, '1599788697', '20AUM114271', 'Thêm khoản học phí: Test, số tiền 100,000 VNĐ', '1616641824', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4180', null, '', '20AUM114271', 'Đã đóng  VNĐ', '1616646237', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4181', null, '', '20AUM114271', 'Đã đóng  VNĐ', '1616646883', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4182', null, '', '20AUM114271', 'Đã đóng  VNĐ', '1616646906', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4183', null, '', '20AUM114271', 'Thêm khoản học phí: , số tiền 0 VNĐ', '1616647418', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4184', null, '', '20AUM114271', 'Thêm khoản học phí: , số tiền 0 VNĐ', '1616647454', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4185', null, '', '20AUM114271', 'Thêm khoản học phí: , số tiền 0 VNĐ', '1616647543', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4186', null, '', '20AUM114271', 'Thêm khoản học phí: , số tiền 0 VNĐ', '1616647548', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4187', null, '', '20AUM114271', 'Thêm khoản học phí: , số tiền 0 VNĐ', '1616647577', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4188', null, '', '20AUM114271', 'Thêm khoản học phí: , số tiền 0 VNĐ', '1616647587', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4189', null, '', '20AUM114271', 'Đã đóng 100,000 VNĐ', '1616647766', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4190', null, '1599788697', '20AUM114271', 'Đã đóng 100,000 VNĐ', '1616659975', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4191', null, '1599788697', '20AUM114271', 'Đã đóng 200,000 VNĐ', '1616660241', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4192', null, '1599788697', '20AUM114271', 'Đã đóng 200,000 VNĐ', '1616660312', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4193', null, '1599788697', '20AUM114271', 'Đã đóng 200,000 VNĐ', '1616660312', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4194', null, null, '20AUM114271', 'Xóa danh mục học phí ', '1616660426', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4195', null, null, '20AUM114271', 'Xóa danh mục học phí ', '1616660430', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4196', null, null, '20AUM114271', 'Xóa danh mục học phí ', '1616660436', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4197', null, null, '20AUM114271', 'Xóa danh mục học phí ', '1616660440', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4198', null, null, '20AUM114271', 'Xóa danh mục học phí ', '1616660445', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4199', null, null, '20AUM114271', 'Xóa danh mục học phí ', '1616660450', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4200', null, '1599788697', '20AUM114271', 'Đã đóng 150,000 VNĐ', '1616668953', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4201', null, '1599788697', '20AUM114271', 'Đã đóng 300,000 VNĐ', '1616669281', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4202', null, '1599788697', '20AUM114271', 'Đã đóng 1 VNĐ', '1616669429', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4203', null, '1599788697', '20AUM114271', 'Đã đóng 1 VNĐ', '1616669557', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4204', null, '1599788697', '20AUM114271', 'Đã đóng 12 VNĐ', '1616669561', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4205', null, '1599788697', '20AUM114271', 'Đã đóng 1 VNĐ', '1616670011', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4206', null, '1599788697', '20AUM114271', 'Đã đóng 555 VNĐ', '1616670029', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4207', null, '1599788697', '20AUM114271', 'Đã đóng 1,000,000 VNĐ', '1616670169', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4208', null, null, '20AUM114271', '#20AUM114271 cập nhật điểm: chuyên cần (10) điểm kiểm tra (9) điểm thi (7)', '1616672624', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4209', null, null, '20AUM114271', '#20AUM114271 cập nhật điểm: chuyên cần (10) điểm kiểm tra (9) điểm thi (7)', '1616672627', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4210', null, null, '20AUM114271', '#20AUM114271 cập nhật điểm: chuyên cần (9) điểm kiểm tra (10) điểm thi (8)', '1616731417', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4211', null, null, '20AUM114271', '#20AUM114271 cập nhật điểm: chuyên cần (10) điểm kiểm tra (9) điểm thi (7)', '1616731450', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4212', null, null, '20AUM114271', 'Xóa danh mục học phí Test', '1616753603', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4213', null, '1599788697', '', 'Hồ sơ #1599788697 đánh SBD: 1234567', '1617079079', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4214', null, '1599788697', '', 'Hồ sơ #1599788697 thiết lập phòng thi: ', '1617092868', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4215', null, '', '', '0 hồ sơ được phân lớp 1142K21', '1617093460', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4216', null, '', '', '2 Hồ sơ đã cập nhật sbd & phòng thi', '1617248927', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4217', null, '1610940369', '', 'Hồ sơ #1610940369 đã trúng tuyển', '1617249304', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4218', null, '1599788697', '', 'Hồ sơ #1599788697 đã cập nhật điểm: (8),(8),(9)', '1617250870', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4219', null, '1599788697', '', 'Hồ sơ #1599788697 đã trúng tuyển', '1617250994', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4220', null, '1599788697', '', 'Hồ sơ #1599788697 hủy trúng tuyển', '1617251057', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4221', null, '1599788697', '', 'Hồ sơ #1599788697 đã trúng tuyển', '1617251068', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4222', null, '1610940726', '', 'Hồ sơ #1610940726 đã trúng tuyển', '1617251133', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4223', null, '1610940726', '', 'Hồ sơ #1610940726 đã trúng tuyển', '1617251133', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4224', null, '1599788697', '20AUM114271', 'Hồ sơ #1599788697 đã nhập học', '1617251342', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4225', null, '1599788697', '', 'Hồ sơ #1599788697 cập nhật trạng thái thành công', '1617335023', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4226', null, '1599788697', '', 'Hồ sơ #1599788697 cập nhật trạng thái thành công', '1617335115', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4227', null, '1599788697', '', 'Hồ sơ #1599788697 cập nhật trạng thái thành công', '1617335141', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4228', null, '1599788697', '', 'Hồ sơ #1599788697 cập nhật trạng thái thành công', '1617335210', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4229', null, null, '20AUM114271', 'Mã SV #20AUM114271 đã được thêm vào lớp el1_qlnn11', '1617336522', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4230', null, '1617339465', '', 'Hồ sơ #1617339465 ( ABC) tạo mới thành công', '1617339545', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4231', null, '1617340024', '', 'Hồ sơ #1617340024 ( ABC) tạo mới thành công', '1617340036', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4232', null, '1617340024', '', 'Hồ sơ #1617340024 ( ABC) tạo mới thành công', '1617340157', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4233', null, '1617340024', '', 'Hồ sơ #1617340024 đăng ký ngành thành công', '1617352997', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4234', null, '1617340024', '', 'Hồ sơ #1617340024 cập nhật ngành thành công', '1617355215', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4235', null, '1617340024', '', 'Hồ sơ #1617340024 đăng ký ngành thành công', '1617356119', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4236', null, '1617340024', '', 'Hồ sơ #1617340024 cập nhật ngành thành công', '1617357142', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4237', null, '1617340024', '', 'Hồ sơ #1617340024 đăng ký ngành thành công', '1617357431', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4238', null, '1617340024', '', 'Hồ sơ #1617340024 đăng ký ngành thành công', '1617357470', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4239', null, '1617340024', '', 'Hồ sơ #1617340024 đăng ký ngành thành công', '1617357475', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4240', null, '1617340024', '', 'Hồ sơ #1617340024 đăng ký ngành thành công', '1617357826', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4241', null, '1617340024', '', 'Hồ sơ #1617340024 đăng ký ngành thành công', '1617357888', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4242', null, '1617340024', '', 'Hồ sơ #1617340024 đăng ký ngành thành công', '1617357950', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4243', null, '1617340024', '', 'Hồ sơ #1617340024 đăng ký ngành thành công', '1617357974', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4244', null, null, '20AUM122464', 'Mã SV #20AUM122464 đã được thêm vào lớp el1_qlnn11', '1617358317', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4245', null, null, '20AUM116471', 'Mã SV #20AUM116471 đã được thêm vào lớp el22_lkt11', '1617358342', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4246', null, '1617340024', '', 'Hồ sơ #1617340024 đăng ký ngành thành công', '1617359143', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4247', null, '1617340024', '', 'Hồ sơ #1617340024 đăng ký ngành thành công', '1617359162', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4248', null, null, '20AUM114472', 'Mã SV #20AUM114472 đã được thêm vào lớp el1_qtkd11', '1617359171', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4249', null, null, '20AUM122473', 'Mã SV #20AUM122473 đã được thêm vào lớp el1_qlnn11', '1617359513', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4250', null, '1617340024', '', 'Hồ sơ #1617340024 đăng ký ngành thành công', '1617360909', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4251', null, '1599788697', '', 'Hồ sơ #1599788697 đã cập nhật thông tin', '1617552804', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4252', null, '1599788697', '', 'Hồ sơ #1599788697 đăng ký ngành thành công', '1617554371', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4253', null, '1599788697', '', 'Hồ sơ #1599788697 đăng ký ngành thành công', '1617554381', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4254', null, null, '20AUM114476', 'Mã SV #20AUM114476 đã được thêm vào lớp el1_qtkd11', '1617554462', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4255', null, null, '20AUM116477', 'Mã SV #20AUM116477 đã được thêm vào lớp el1_lkt11', '1617554469', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4256', null, '1599788697', '20AUM116477', 'Đã đóng 2,000,000 VNĐ', '1617554510', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4257', null, '159979300110', '', 'Hồ sơ #159979300110 đã cập nhật thông tin', '1617577966', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4258', null, '159979300110', '', 'Hồ sơ #159979300110 đã cập nhật thông tin', '1617577978', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4259', null, '1617595316', '', 'Hồ sơ #1617595316 (Nguyễn Văn Bình) tạo mới thành công', '1617595395', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4260', null, '1599788697', '', 'Hồ sơ #1599788697 cập nhật trạng thái thành công', '1617617036', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4261', null, '1599788697', '', 'Hồ sơ #1599788697 cập nhật trạng thái thành công', '1617617267', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4262', null, '1599788697', '', 'Hồ sơ #1599788697 cập nhật trạng thái thành công', '1617617379', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4263', null, '1599788697', '', 'Hồ sơ #1599788697 cập nhật trạng thái thành công', '1617617505', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4264', null, '1599788697', '', 'Hồ sơ #1599788697 cập nhật trạng thái thành công', '1617617602', 'tranhiep', '0');
INSERT INTO `tbl_notify` VALUES ('4265', null, '', '', 'Thêm chương trình khung: LKT17 (ngành 111, hệ AUM)', '1619516268', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4266', null, '', '', 'Thêm chương trình khung: 1000001 (ngành 111, hệ AUM)', '1619517516', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4267', null, 'KH249320', '21-2-7480201-0104', 'Thêm khoản học phí: Lệ phí nhập học, số tiền 350,000 VNĐ', '1619517633', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4268', null, 'KH249320', '21-2-7480201-0104', 'Đã đóng 1,000,000 VNĐ', '1619517663', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4269', null, null, '21-2-7480201-0109', 'Mã SV #21-2-7480201-0109 chuyển từ lớp AUM0121HNCNAK sang lớp AUM0121HNCNDX', '1619521767', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4270', null, null, '21-2-7480201-0109', 'Mã SV #21-2-7480201-0109 chuyển từ lớp AUM0121HNCNDX sang lớp AUM0121HNCNAC', '1619521775', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4271', null, 'KH247098', '', 'Hồ sơ #KH247098 đăng ký ngành thành công', '1619742777', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4272', null, 'KH247098', '', 'Hồ sơ #KH247098 đăng ký ngành thành công', '1619742928', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4273', null, 'KH247098', '', 'Hồ sơ #KH247098 đăng ký ngành thành công', '1619742986', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4274', null, 'KH249320', '', 'Hồ sơ #KH249320 đăng ký ngành thành công', '1619747007', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4275', null, 'KH249320', '', 'Hồ sơ #KH249320 đăng ký ngành thành công', '1619749753', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4276', null, null, 'AUM111709', 'Mã SV #AUM111709 đã được thêm vào lớp test-1', '1619749763', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4277', null, 'KH249320', '', 'Hồ sơ #KH249320 cập nhật trạng thái thành công', '1619749867', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4278', null, '', '', 'Thêm chương trình khung: LKT01 (ngành 111, hệ AUM)', '1619772474', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4279', null, '1620570019', '', 'Hồ sơ #1620570019 ( a) tạo mới thành công', '1620570075', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4280', null, '1620570019', '', 'Hồ sơ #1620570019 ( a) tạo mới thành công', '1620570091', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4281', null, '1620611787', '', 'Hồ sơ #1620611787 ( a) tạo mới thành công', '1620611928', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4282', null, '1620611787', '', 'Hồ sơ #1620611787 ( a) tạo mới thành công', '1620612592', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4283', null, '1620611787', '', 'Hồ sơ #1620611787 ( a) tạo mới thành công', '1620612859', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4284', null, '1620613268', '', 'Hồ sơ #1620613268 ( a) tạo mới thành công', '1620613317', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4285', null, '1620613831', null, 'Hồ sơ #1620613831 ( abc) tạo mới thành công', '1620613868', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4286', null, '1620614019', null, 'Hồ sơ #1620614019 ( abc) tạo mới thành công', '1620614099', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4287', null, '1620615331', null, 'Hồ sơ #1620615331 (nguyễn văn a) tạo mới thành công', '1620615364', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4288', null, 'KH241483', '21-2-7480201-0006', 'Thêm khoản học phí: Ngoại khóa, số tiền 1,000 VNĐ', '1620648055', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4289', null, '', '', 'Thêm chương trình khung: LKT02 (ngành 111, hệ AUM)', '1620903404', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4290', null, '', '', 'Thêm chương trình khung: LKT02 (ngành 111, hệ AUM)', '1620960221', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4291', null, '', '', 'Thêm chương trình khung: LKT03 (ngành 111, hệ AUM)', '1620968473', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4292', null, '', '', 'Thêm chương trình khung: LKT03 (ngành 111, hệ AUM)', '1620968481', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4293', null, '', '', 'Thêm chương trình khung: LKT02 (ngành 111, hệ AUM)', '1620968592', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4294', null, '', '', 'Thêm chương trình khung: LKT02 (ngành 111, hệ AUM)', '1620969134', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4295', null, '', '', 'Thêm chương trình khung: LKT03 (ngành 111, hệ AUM)', '1620978569', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4296', null, '', '', 'Thêm chương trình khung: LKT02 (ngành 111, hệ AUM)', '1620978597', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4297', null, '', '', 'Thêm chương trình khung: LKT02 (ngành 111, hệ AUM)', '1620978599', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4298', null, '', '', 'Thêm chương trình khung: LKT02 (ngành 111, hệ AUM)', '1620978607', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4299', null, '', '', 'Thêm chương trình khung: LKT04 (ngành 111, hệ AUM)', '1620978610', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4300', null, '', '', 'Thêm chương trình khung: LKT05 (ngành 111, hệ AUM)', '1620979539', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4301', null, '', '', 'Thêm chương trình khung: LKT06 (ngành 111, hệ AUM)', '1620980374', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4302', null, '', '', 'Cập nhật chương trình khung: 1000001 (ngành 111, hệ AUM)', '1620984813', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4303', null, '', '', 'Lớp AUM0220HNCNBC thực hiện Xét Đạt/Không Đạt môn QTKD25', '1621309306', 'nxtuyen.pro@gmail.com', '0');
INSERT INTO `tbl_notify` VALUES ('4304', null, '', '', 'Lớp AUM0220HNCNBC thực hiện Xét Đạt/Không Đạt môn QTKD25', '1621310045', 'nxtuyen.pro@gmail.com', '0');
INSERT INTO `tbl_notify` VALUES ('4305', null, '', '', 'Lớp AUM0220HNCNBC thực hiện Xét Đạt/Không Đạt môn QTKD25', '1621313779', 'nxtuyen.pro@gmail.com', '0');
INSERT INTO `tbl_notify` VALUES ('4306', null, '', '', 'Lớp AUM0220HNCNBC thực hiện Xét Đạt/Không Đạt môn QTKD25', '1621313889', 'nxtuyen.pro@gmail.com', '0');
INSERT INTO `tbl_notify` VALUES ('4307', null, '', '', 'Lớp AUM0220HNCNBC thực hiện Xét Đạt/Không Đạt môn QTKD25', '1621314050', 'nxtuyen.pro@gmail.com', '0');
INSERT INTO `tbl_notify` VALUES ('4308', null, '', '', 'Lớp AUM0220HNCNBC thực hiện Xét Đạt/Không Đạt môn QTKD25', '1621314123', 'nxtuyen.pro@gmail.com', '0');
INSERT INTO `tbl_notify` VALUES ('4309', null, '', '', 'Lớp AUM0220HNCNBC thực hiện Xét Đạt/Không Đạt môn QTKD25', '1621321452', 'nxtuyen.pro@gmail.com', '0');
INSERT INTO `tbl_notify` VALUES ('4310', null, null, '20-2-7480201-0172', '#20-2-7480201-0172 cập nhật điểm: chuyên cần (8) điểm kiểm tra (9) điểm thi (8)', '1621322036', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4311', null, null, '20-2-7480201-0173', '#20-2-7480201-0173 cập nhật điểm: chuyên cần (7) điểm kiểm tra (6) điểm thi (6)', '1621322046', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4312', null, null, '20-2-7480201-0174', '#20-2-7480201-0174 cập nhật điểm: chuyên cần (6) điểm kiểm tra (6) điểm thi (6.5)', '1621322055', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4313', null, null, '20-2-7480201-0175', '#20-2-7480201-0175 cập nhật điểm: chuyên cần (8) điểm kiểm tra (6) điểm thi (6)', '1621322067', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4314', null, null, '20-2-7480201-0176', '#20-2-7480201-0176 cập nhật điểm: chuyên cần (5) điểm kiểm tra (6) điểm thi (5)', '1621322177', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4315', null, null, '20-2-7480201-0269', '#20-2-7480201-0269 cập nhật điểm: chuyên cần (4) điểm kiểm tra (4) điểm thi (2)', '1621322430', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4316', null, null, '20-2-7480201-0270', '#20-2-7480201-0270 cập nhật điểm: chuyên cần (3) điểm kiểm tra (3) điểm thi (3)', '1621322435', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4317', null, null, '20-2-7480201-0362', '#20-2-7480201-0362 đăng ký thi lại.', '1621322565', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4318', null, null, '20-2-7480201-0362', '#20-2-7480201-0362 cập nhật điểm: chuyên cần (3) điểm kiểm tra (3) điểm thi (3)', '1621323356', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4319', null, null, '20-2-7480201-0362', '#20-2-7480201-0362 đăng ký thi lại.', '1621323368', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4320', null, null, '20-2-7480201-0363', '#20-2-7480201-0363 đăng ký thi lại.', '1621323535', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4321', null, null, '20-2-7480201-0364', '#20-2-7480201-0364 đăng ký thi lại.', '1621323700', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4322', null, null, '20-2-7480201-0270', '#20-2-7480201-0270 Nhập điểm thi lại: 3.55', '1621334259', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4323', null, null, '20-2-7480201-0270', '#20-2-7480201-0270 đăng ký học lại.', '1621351689', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4324', null, null, '20-2-7480201-0270', '#20-2-7480201-0270 đăng ký học lại.', '1621352663', 'nxtuyen.pro@gmail.com', '0');
INSERT INTO `tbl_notify` VALUES ('4325', null, '', '', '# cập nhật điểm thi lại lần 1', '1621359022', 'nxtuyen.pro@gmail.com', '0');
INSERT INTO `tbl_notify` VALUES ('4326', null, '', '', '# cập nhật điểm thi lại lần 1', '1621359024', 'nxtuyen.pro@gmail.com', '0');
INSERT INTO `tbl_notify` VALUES ('4327', null, null, '20-2-7480201-0172', '#20-2-7480201-0172 cập nhật điểm: chuyên cần (10) điểm kiểm tra (6) điểm thi (7)', '1621390782', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4328', null, null, '20-2-7480201-0172', '#20-2-7480201-0172 cập nhật điểm: chuyên cần (7) điểm kiểm tra (7) điểm thi (7)', '1621391298', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4329', null, '', '', 'Mã ngành TCNH vừa được tạo thành công', '1621563331', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4330', null, '', '', 'Mã ngành TCNH vừa cập nhật', '1621567982', 'nxtuyen.pro@gmail.com', '0');
INSERT INTO `tbl_notify` VALUES ('4331', null, '', '', 'Mã ngành TCNH vừa cập nhật', '1621568064', 'nxtuyen.pro@gmail.com', '0');
INSERT INTO `tbl_notify` VALUES ('4332', null, '', '', 'Mã ngành TCNH vừa cập nhật', '1621568347', 'nxtuyen.pro@gmail.com', '0');
INSERT INTO `tbl_notify` VALUES ('4333', null, '', '', 'Mã ngành TCNH vừa cập nhật', '1621568358', 'nxtuyen.pro@gmail.com', '0');
INSERT INTO `tbl_notify` VALUES ('4334', null, '', '', 'Mã ngành TCNH vừa cập nhật', '1621568563', 'nxtuyen.pro@gmail.com', '0');
INSERT INTO `tbl_notify` VALUES ('4335', null, '', '', 'Mã ngành TCNH vừa cập nhật', '1621568650', 'nxtuyen.pro@gmail.com', '0');
INSERT INTO `tbl_notify` VALUES ('4336', null, '', '', 'Mã ngành 1102 vừa được tạo thành công', '1621568793', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4337', null, '', '', 'Mã ngành 1102 vừa được tạo thành công', '1621568904', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4338', null, '', '', 'Mã ngành TCNH vừa cập nhật', '1621568936', 'nxtuyen.pro@gmail.com', '0');
INSERT INTO `tbl_notify` VALUES ('4339', null, '', '', 'Mã ngành 1102 vừa được tạo thành công', '1621569242', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4340', null, '', '', 'Mã ngành 1102 vừa được tạo thành công', '1621569423', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4341', null, null, '21-2-7480201-0109', '#21-2-7480201-0109 cập nhật điểm: chuyên cần (10) điểm kiểm tra (9) điểm thi (8)', '1622219332', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4342', null, null, '20-2-7480201-0270', '#20-2-7480201-0270 cập nhật điểm: chuyên cần (3) điểm kiểm tra (3) điểm thi (3)', '1622885667', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4343', null, null, '20-2-7480201-0270', '#20-2-7480201-0270 cập nhật điểm: chuyên cần (3) điểm kiểm tra (3) điểm thi (3)', '1622885672', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4344', null, null, '20-2-7480201-0270', '#20-2-7480201-0270 cập nhật điểm: chuyên cần (3) điểm kiểm tra (3) điểm thi (3)', '1622885675', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4345', null, null, '20-2-7480201-0270', '#20-2-7480201-0270 cập nhật điểm: chuyên cần (3) điểm kiểm tra (3) điểm thi (3)', '1622885831', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4346', null, null, '20-2-7480201-0270', '#20-2-7480201-0270 cập nhật điểm: chuyên cần (3) điểm kiểm tra (3) điểm thi (3)', '1622885969', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4347', null, null, '20-2-7480201-0270', '#20-2-7480201-0270 cập nhật điểm: chuyên cần (3) điểm kiểm tra (3) điểm thi (3)', '1622885987', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4348', null, null, '20-2-7480201-0270', '#20-2-7480201-0270 cập nhật điểm: chuyên cần (3) điểm kiểm tra (3) điểm thi (3)', '1622886126', 'N/A', '0');
INSERT INTO `tbl_notify` VALUES ('4349', null, null, '20-2-7480201-0176', '#20-2-7480201-0176 cập nhật điểm: chuyên cần (5) điểm kiểm tra (6) điểm thi (5)', '1622886202', 'N/A', '0');

-- ----------------------------
-- Table structure for tbl_partner
-- ----------------------------
DROP TABLE IF EXISTS `tbl_partner`;
CREATE TABLE `tbl_partner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `diachi` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_partner
-- ----------------------------
INSERT INTO `tbl_partner` VALUES ('6', 'TT ĐT TRỰC TUYẾN AUM', 'Số 36 Đường Cầu Diễn Hà Nội', '0915238189', null);

-- ----------------------------
-- Table structure for tbl_user
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `birthday` date DEFAULT NULL,
  `gender` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `identify` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `organ` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gsecret` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `joindate` datetime NOT NULL,
  `lastlogin` datetime DEFAULT NULL,
  `gid` int(11) NOT NULL,
  `isroot` tinyint(4) DEFAULT NULL,
  `isactive` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_user
-- ----------------------------
INSERT INTO `tbl_user` VALUES ('1', 'admindemo', '89c382235e41a0ddca349ca5565174fd', 'Admin', '', '1994-09-06', '0', '', '0936831277', '', 'info@igf.com.vn', '', '', '', '', '2016-12-01 12:17:05', '2021-01-18 04:24:45', '9', '1', '1');
INSERT INTO `tbl_user` VALUES ('16', 'thuynt', '9cd94d377acdd4661915607e00728a33', 'Thuy', '', null, '', '', '0984486830', '', '', '', '', '', '', '2019-04-04 11:20:10', '2020-10-28 11:23:08', '9', '1', '1');
INSERT INTO `tbl_user` VALUES ('48', 'thaott_daotao', '00cd5ba0e25fd9ae5b89019744d0d7b8', 'Trần Thị Thảo', '', null, '', '', '0967875563', '', '', null, null, null, null, '2020-03-03 13:57:44', '2020-09-29 08:30:34', '22', null, '1');
INSERT INTO `tbl_user` VALUES ('47', 'demodaotao', '453b885e6c7c3683041ab4bd8f717f46', 'Đào tạo', '', null, '', '', '012345678', '', '', null, null, null, null, '2020-02-27 11:11:55', null, '22', null, '1');
INSERT INTO `tbl_user` VALUES ('45', 'hatn', '2220dc2d04ab4611f78cb4615dc0aa25', 'Trương Ngọc Hà', '', null, '', '', '0917796898', '', '', '', '', '', '', '2019-11-04 16:41:26', null, '9', '0', '1');
INSERT INTO `tbl_user` VALUES ('50', 'hungtv_daotao', '9b40eccc3434b426c10abb927e80c098', 'Trần Văn Hưng', '', null, '', '', '0972848718', '', '', null, null, null, null, '2020-04-08 15:50:43', null, '22', null, '1');
INSERT INTO `tbl_user` VALUES ('51', 'tranhiep', 'b8a1099b57fb53d28fba7d5717e317ea', 'Trần Viết Hiệp', '', null, '', '', '0969549903', '', 'tranviethiepdz@gmail.com', null, null, null, null, '2020-04-08 15:50:43', '2021-04-22 04:16:22', '9', null, '1');
INSERT INTO `tbl_user` VALUES ('53', 'test', 'b8a1099b57fb53d28fba7d5717e317ea', 'test', '', null, '', '', '09695499991', '', '', null, null, null, null, '2021-03-22 10:49:14', '2021-03-22 10:50:12', '33', null, '1');

-- ----------------------------
-- Table structure for tbl_user_group
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user_group`;
CREATE TABLE `tbl_user_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `par_id` int(11) DEFAULT '0',
  `path` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `intro` text COLLATE utf8_unicode_ci,
  `permission` int(11) NOT NULL DEFAULT '0',
  `config` text COLLATE utf8_unicode_ci,
  `isroot` tinyint(4) DEFAULT NULL,
  `isadmin` int(11) NOT NULL DEFAULT '0',
  `issale` tinyint(4) DEFAULT '0',
  `isstore` tinyint(4) DEFAULT '0',
  `isactive` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_user_group
-- ----------------------------
INSERT INTO `tbl_user_group` VALUES ('9', '0', '1', 'Super Admin', '', '67108863', '', '0', '1', '0', '0', '1');
INSERT INTO `tbl_user_group` VALUES ('22', '18', '9_18_22', 'Phòng Đào tạo', 'Phòng Đào tạo', '2079240', '', '0', '0', '0', '0', '1');
INSERT INTO `tbl_user_group` VALUES ('18', '9', '9_18', 'Admin', 'Admin', '4193848', '', '0', '0', '0', '0', '1');
INSERT INTO `tbl_user_group` VALUES ('21', '18', '9_18_21', 'Phòng kế toán', 'Phòng kế toán', '2147328', '', '0', '0', '0', '0', '1');
INSERT INTO `tbl_user_group` VALUES ('23', '18', '9_18_23', 'Phòng công tác HSSV', 'Phòng công tác HSSV', '3', '', '0', '0', '0', '0', '1');
INSERT INTO `tbl_user_group` VALUES ('24', '21', '9_18_21_24', 'Trưởng phòng kế toán', 'Trưởng phòng kế toán', '2122752', '', '0', '0', '0', '0', '1');

-- ----------------------------
-- Table structure for tbl_working_log
-- ----------------------------
DROP TABLE IF EXISTS `tbl_working_log`;
CREATE TABLE `tbl_working_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_hoso` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '',
  `masv` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '',
  `ma_mon` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` int(11) DEFAULT NULL,
  `noidung` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '',
  `ketqua` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '',
  `finish` tinyint(1) DEFAULT NULL,
  `author` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '',
  `cdate` int(11) DEFAULT NULL,
  `fdate` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=129 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tbl_working_log
-- ----------------------------
INSERT INTO `tbl_working_log` VALUES ('128', '', 'AUM.A00016.16062021.1408', null, 'hocphi', '1623978517', 'Chuyển tình trạng cuộc gọi học phí từ: () sang: (Chăm sóc sau 7 ngày)', 'Hoàn thành', '1', 'nxtuyen.pro@gmail.com', '1623978517', null);

-- ----------------------------
-- Table structure for tbl_working_log_hocphi
-- ----------------------------
DROP TABLE IF EXISTS `tbl_working_log_hocphi`;
CREATE TABLE `tbl_working_log_hocphi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_hoso` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '',
  `masv` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '',
  `date` int(11) DEFAULT NULL,
  `noidung` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '',
  `ketqua` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '',
  `finish` tinyint(1) DEFAULT NULL,
  `author` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '',
  `cdate` int(11) DEFAULT NULL,
  `fdate` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tbl_working_log_hocphi
-- ----------------------------
