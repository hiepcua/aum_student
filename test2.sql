/* Reset tbl_nganh, tbl_hocsinh, tbl_dangky_tuyensinh, tbl_working_log */
DROP TABLE IF EXISTS `tbl_khoa`;
CREATE TABLE `tbl_khoa` (
  `id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `type` tinyint(4) DEFAULT 1,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `startDay` int(11) DEFAULT 1,
  `quan` int(11) DEFAULT NULL,
  `hocphi` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_khoa
-- ----------------------------
INSERT INTO `tbl_khoa` VALUES ('2020', '0', 'Khóa 2020-2021', '1577811600', '60', '0');
INSERT INTO `tbl_khoa` VALUES ('2021', '0', 'Khóa 2021', '1609434000', '60', null);


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

DROP TABLE IF EXISTS `tbl_hocsinh`;
CREATE TABLE `tbl_hocsinh` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `partner_id` int(11) DEFAULT 0,
  `ma` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `masv` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ho_dem` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nickname` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngaysinh` int(11) DEFAULT NULL,
  `noisinh` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gioitinh` tinyint(4) DEFAULT 1 COMMENT '0:nữ, 1:nam',
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
  `note` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `dmhoso` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `qhgiadinh` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `qthoctap` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `qthoc` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `khenthuong` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `kyluat` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `partner` int(11) DEFAULT NULL,
  `cdate` int(11) DEFAULT NULL,
  `mdate` int(11) DEFAULT NULL,
  `author` varchar(255) COLLATE utf8_unicode_ci DEFAULT '50',
  `brief` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `brief_full` tinyint(4) DEFAULT 0 COMMENT '0: Chưa check hồ sơ, 1: Check đủ hồ sơ, -1: Hồ sơ thiếu',
  `status` tinyint(4) DEFAULT 0,
  `xettuyen` tinyint(4) DEFAULT 0,
  `isactive` tinyint(4) DEFAULT 1,
  /* Thêm trường */
  `hetotnghiep` int(11) DEFAULT NULL,
  `ngayBG` int(11) DEFAULT NULL, /*Ngày bàn giao trường */
  `tinhtrangBG` int(11) DEFAULT NULL, /*Tình trạng bàn giao*/
  `lydoBG` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  /* /.Thêm trường */
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `tbl_dangky_tuyensinh`;
CREATE TABLE `tbl_dangky_tuyensinh` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cdate` int(11) DEFAULT NULL,
  `mdate` int(11) DEFAULT NULL,
  `type` tinyint(4) DEFAULT 1 COMMENT '1: Chính quy 2:Chứng chỉ ngắn hạn',
  `id_khoa` varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
  `id_he` varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
  `id_nganh` varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
  `id_hoso` varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
  `truong_thpt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `diemtongket12` float DEFAULT NULL,
  `xettuyen` tinyint(4) DEFAULT 1 COMMENT '0: thi ; 1: xét tuyển',
  `diadiemhoc` varchar(50) COLLATE utf8_unicode_ci DEFAULT '0' COMMENT '0: Cơ sở 1; 1: cơ sở 2',
  `masv` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sbd` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phongthi` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mon1` decimal(10,1) DEFAULT NULL,
  `mon2` decimal(10,1) DEFAULT NULL,
  `mon3` decimal(10,1) DEFAULT NULL,
  `dathi` tinyint(4) DEFAULT 0,
  `trungtuyen` tinyint(4) DEFAULT -1,
  `baoluu` tinyint(4) DEFAULT 0,
  `nhaphoc` tinyint(4) DEFAULT 0,
  `date_nhaphoc` int(11) DEFAULT NULL,
  `malop` varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
  `status` varchar(4) COLLATE utf8_unicode_ci DEFAULT '',
  /* Thêm trường */
  `nhomkhachhang` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_staff` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL, /*Người phụ trách*/
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
  `hs_mota` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `dotnhaphoc` int(11) DEFAULT NULL,
  `namnhaphoc` int(11) DEFAULT NULL,
  `kyhoc` int(11) DEFAULT NULL,
  `qd_trungtuyen` int(11) DEFAULT NULL,
  `qd_congnhansv` int(11) DEFAULT NULL,
  `tinhtrang_sv` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tinhtrang_hocphi` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_contact` int(11) DEFAULT NULL,
  `date_level_up` int(11) DEFAULT NULL, /*Ngày lên level*/
  /* /.Thêm trường */
  `author` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `isactive` tinyint(4) DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `idx_khoa_he_nganh` (`id_khoa`,`id_he`,`id_nganh`),
  KEY `idx_nhaphoc` (`nhaphoc`),
  KEY `idx_trungquyen` (`trungtuyen`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;