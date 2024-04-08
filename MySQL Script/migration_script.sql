-- ----------------------------------------------------------------------------
-- MySQL Workbench Migration
-- Migrated Schemata: SkillBoost
-- Source Schemata: SkillBoost
-- Created: Sun Apr  7 12:32:31 2024
-- Workbench Version: 8.0.36
-- ----------------------------------------------------------------------------

SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------------------------------------------------------
-- Schema SkillBoost
-- ----------------------------------------------------------------------------
DROP SCHEMA IF EXISTS `SkillBoost` ;
CREATE SCHEMA IF NOT EXISTS `SkillBoost` ;

-- ----------------------------------------------------------------------------
-- Table SkillBoost.sysdiagrams
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `SkillBoost`.`sysdiagrams` (
  `name` VARCHAR(160) NOT NULL,
  `principal_id` INT NOT NULL,
  `diagram_id` INT NOT NULL,
  `version` INT NULL,
  `definition` LONGBLOB NULL,
  PRIMARY KEY (`diagram_id`),
  UNIQUE INDEX `UK_principal_name` (`principal_id` ASC, `name` ASC) VISIBLE);

-- ----------------------------------------------------------------------------
-- Table SkillBoost.NhanVien
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `SkillBoost`.`NhanVien` (
  `STT` INT NOT NULL,
  `MaNV` VARCHAR(13) NOT NULL,
  `HoTenNV` VARCHAR(70) CHARACTER SET 'utf8mb4' NOT NULL,
  `GioiTinhNV` VARCHAR(10) CHARACTER SET 'utf8mb4' NULL,
  `NgaySinhNV` DATE NULL,
  `ChucVu` VARCHAR(20) CHARACTER SET 'utf8mb4' NOT NULL,
  `SoDienThoaiNV` CHAR(10) NOT NULL,
  `EmailNV` VARCHAR(70) NOT NULL,
  `TrangThaiNV` VARCHAR(30) CHARACTER SET 'utf8mb4' NOT NULL,
  `TaoVaoLuc` DATETIME NOT NULL,
  `TaoBoi` VARCHAR(20) CHARACTER SET 'utf8mb4' NOT NULL,
  `ChinhSuaLanCuoiVaoLuc` DATETIME NOT NULL,
  `ChinhSuaLanCuoiBoi` VARCHAR(20) CHARACTER SET 'utf8mb4' NOT NULL,
  PRIMARY KEY (`MaNV`),
  UNIQUE INDEX `ConstraintUniqueSDTNV` (`SoDienThoaiNV` ASC) VISIBLE,
  UNIQUE INDEX `ConstraintUniqueEmailNV` (`EmailNV` ASC) VISIBLE);

-- ----------------------------------------------------------------------------
-- Table SkillBoost.TaiKhoan
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `SkillBoost`.`TaiKhoan` (
  `STT` INT NOT NULL,
  `MaTK` VARCHAR(13) NOT NULL,
  `EmailTK` VARCHAR(70) NOT NULL,
  `MatKhauTK` VARCHAR(50) NOT NULL,
  `MaHashTK` BINARY(64) NULL,
  `MaSaltTK` VARCHAR(64) NOT NULL,
  `TrangThaiTK` VARCHAR(50) CHARACTER SET 'utf8mb4' NOT NULL,
  `MaNV` VARCHAR(13) NOT NULL,
  `TaoVaoLuc` DATETIME NOT NULL,
  `TaoBoi` VARCHAR(20) CHARACTER SET 'utf8mb4' NOT NULL,
  `ChinhSuaLanCuoiVaoLuc` DATETIME NOT NULL,
  `ChinhSuaLanCuoiBoi` VARCHAR(20) CHARACTER SET 'utf8mb4' NOT NULL,
  PRIMARY KEY (`MaTK`),
  CONSTRAINT `FK__TaiKhoan__MaNV__5DCAEF64`
    FOREIGN KEY (`MaNV`)
    REFERENCES `SkillBoost`.`NhanVien` (`MaNV`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

-- ----------------------------------------------------------------------------
-- Table SkillBoost.YeuCauTuVan
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `SkillBoost`.`YeuCauTuVan` (
  `STT` INT NOT NULL,
  `MaTuVan` VARCHAR(13) NOT NULL,
  `TenLeadYeuCau` VARCHAR(50) CHARACTER SET 'utf8mb4' NOT NULL,
  `NgaySinhLeadYeuCau` DATE NOT NULL,
  `EmailLeadYeuCau` VARCHAR(70) NOT NULL,
  `SDTLeadYeuCau` CHAR(10) NOT NULL,
  `GhiChuYCTV` VARCHAR(100) CHARACTER SET 'utf8mb4' NULL,
  `TrangThaiYCTV` VARCHAR(50) CHARACTER SET 'utf8mb4' NOT NULL,
  `TaoVaoLuc` DATETIME NOT NULL,
  `TaoBoiLead` VARCHAR(13) NOT NULL,
  PRIMARY KEY (`MaTuVan`),
  CONSTRAINT `FK__YeuCauTuV__TaoBo__5EBF139D`
    FOREIGN KEY (`TaoBoiLead`)
    REFERENCES `SkillBoost`.`Lead` (`MaLead`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

-- ----------------------------------------------------------------------------
-- Table SkillBoost.ChiTietKhoaHocThuocYeuCauTuVan
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `SkillBoost`.`ChiTietKhoaHocThuocYeuCauTuVan` (
  `MaTuVan` VARCHAR(13) NOT NULL,
  `MaKhoaHoc` VARCHAR(13) NOT NULL,
  `TenKhoaHoc` VARCHAR(100) CHARACTER SET 'utf8mb4' NOT NULL,
  `GiangVien` VARCHAR(20) CHARACTER SET 'utf8mb4' NOT NULL,
  `GiaTien` DOUBLE NOT NULL,
  PRIMARY KEY (`MaTuVan`, `MaKhoaHoc`),
  CONSTRAINT `FK__ChiTietKh__MaTuV__5FB337D6`
    FOREIGN KEY (`MaTuVan`)
    REFERENCES `SkillBoost`.`YeuCauTuVan` (`MaTuVan`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK__ChiTietKh__MaKho__60A75C0F`
    FOREIGN KEY (`MaKhoaHoc`)
    REFERENCES `SkillBoost`.`KhoaHoc` (`MaKhoaHoc`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

-- ----------------------------------------------------------------------------
-- Table SkillBoost.Lead
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `SkillBoost`.`Lead` (
  `STT` INT NOT NULL,
  `MaLead` VARCHAR(13) NOT NULL,
  `HoTenLead` VARCHAR(70) CHARACTER SET 'utf8mb4' NOT NULL,
  `GioiTinhLead` VARCHAR(10) CHARACTER SET 'utf8mb4' NULL,
  `NgaySinhLead` DATE NULL,
  `SoDienThoaiLead` CHAR(10) NOT NULL,
  `EmailLead` VARCHAR(70) NOT NULL,
  `MaNgheNghiep` VARCHAR(13) NULL,
  `TenNgheNghiep` VARCHAR(50) CHARACTER SET 'utf8mb4' NULL,
  `MaNVPhuTrachLead` VARCHAR(13) NOT NULL,
  `TenNVPhuTrachLead` VARCHAR(50) CHARACTER SET 'utf8mb4' NOT NULL,
  `TrangThaiLead` VARCHAR(30) CHARACTER SET 'utf8mb4' NOT NULL,
  `LyDoTrangThaiLead` VARCHAR(100) CHARACTER SET 'utf8mb4' NULL,
  `NguonLead` VARCHAR(20) CHARACTER SET 'utf8mb4' NOT NULL,
  `GhiChuLead` VARCHAR(100) CHARACTER SET 'utf8mb4' NULL,
  `LeadTuKHCu` VARCHAR(13) NULL,
  `TaoVaoLuc` DATETIME NOT NULL,
  `TaoBoi` VARCHAR(20) CHARACTER SET 'utf8mb4' NOT NULL,
  `ChinhSuaLanCuoiVaoLuc` DATETIME NOT NULL,
  `ChinhSuaLanCuoiBoi` VARCHAR(20) CHARACTER SET 'utf8mb4' NOT NULL,
  PRIMARY KEY (`MaLead`),
  UNIQUE INDEX `ConstraintUniqueSDTLead` (`SoDienThoaiLead` ASC) VISIBLE,
  UNIQUE INDEX `ConstraintUniqueEmailLead` (`EmailLead` ASC) VISIBLE,
  CONSTRAINT `FK__Lead__MaNgheNghi__619B8048`
    FOREIGN KEY (`MaNgheNghiep`)
    REFERENCES `SkillBoost`.`NgheNghiep` (`MaNgheNghiep`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK__Lead__MaNVPhuTra__628FA481`
    FOREIGN KEY (`MaNVPhuTrachLead`)
    REFERENCES `SkillBoost`.`NhanVien` (`MaNV`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK__Lead__LeadTuKHCu__6383C8BA`
    FOREIGN KEY (`LeadTuKHCu`)
    REFERENCES `SkillBoost`.`KhachHang` (`MaKH`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

-- ----------------------------------------------------------------------------
-- Table SkillBoost.HoatDongLead
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `SkillBoost`.`HoatDongLead` (
  `STT` INT NOT NULL,
  `MaHDLead` VARCHAR(13) NOT NULL,
  `MaLead` VARCHAR(13) NOT NULL,
  `TenHDLead` VARCHAR(100) CHARACTER SET 'utf8mb4' NOT NULL,
  `LoaiHDLead` VARCHAR(30) CHARACTER SET 'utf8mb4' NOT NULL,
  `HDLeadDuocTaoBoi` VARCHAR(20) CHARACTER SET 'utf8mb4' NOT NULL,
  `MaNVPhuTrachHDLead` VARCHAR(13) NOT NULL,
  `TenNVPhuTrachHDLead` VARCHAR(50) CHARACTER SET 'utf8mb4' NOT NULL,
  `MaEmailDenLead` VARCHAR(13) NULL,
  `TaoVaoLuc` DATETIME NOT NULL,
  PRIMARY KEY (`MaHDLead`),
  CONSTRAINT `FK__HoatDongL__MaLea__6477ECF3`
    FOREIGN KEY (`MaLead`)
    REFERENCES `SkillBoost`.`Lead` (`MaLead`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK__HoatDongL__MaNVP__656C112C`
    FOREIGN KEY (`MaNVPhuTrachHDLead`)
    REFERENCES `SkillBoost`.`NhanVien` (`MaNV`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK__HoatDongL__MaEma__66603565`
    FOREIGN KEY (`MaEmailDenLead`)
    REFERENCES `SkillBoost`.`Email` (`MaEmail`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

-- ----------------------------------------------------------------------------
-- Table SkillBoost.NgheNghiep
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `SkillBoost`.`NgheNghiep` (
  `STT` INT NOT NULL,
  `MaNgheNghiep` VARCHAR(13) NOT NULL,
  `TenNgheNghiep` VARCHAR(100) CHARACTER SET 'utf8mb4' NOT NULL,
  `TrangThaiNgheNghiep` VARCHAR(100) CHARACTER SET 'utf8mb4' NOT NULL,
  `TaoVaoLuc` DATETIME NOT NULL,
  `TaoBoi` VARCHAR(20) CHARACTER SET 'utf8mb4' NOT NULL,
  `ChinhSuaLanCuoiVaoLuc` DATETIME NOT NULL,
  `ChinhSuaLanCuoiBoi` VARCHAR(20) CHARACTER SET 'utf8mb4' NOT NULL,
  PRIMARY KEY (`MaNgheNghiep`));

-- ----------------------------------------------------------------------------
-- Table SkillBoost.BaoGia
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `SkillBoost`.`BaoGia` (
  `STT` INT NOT NULL,
  `MaBaoGia` VARCHAR(13) NOT NULL,
  `TenBaoGia` VARCHAR(255) CHARACTER SET 'utf8mb4' NOT NULL,
  `MaLead` VARCHAR(13) NOT NULL,
  `HoTenLead` VARCHAR(70) CHARACTER SET 'utf8mb4' NOT NULL,
  `TongTienTruocGiam` DOUBLE NOT NULL,
  `MaGiamGia` VARCHAR(13) NULL,
  `PhanTramGiamGia` INT NULL,
  `TongTien` DOUBLE NOT NULL,
  `TrangThaiBaoGia` VARCHAR(30) CHARACTER SET 'utf8mb4' NOT NULL,
  `TaoVaoLuc` DATETIME NOT NULL,
  `TaoBoi` VARCHAR(20) CHARACTER SET 'utf8mb4' NOT NULL,
  `ChinhSuaLanCuoiVaoLuc` DATETIME NOT NULL,
  `ChinhSuaLanCuoiBoi` VARCHAR(20) CHARACTER SET 'utf8mb4' NOT NULL,
  PRIMARY KEY (`MaBaoGia`),
  CONSTRAINT `FK__BaoGia__MaLead__6754599E`
    FOREIGN KEY (`MaLead`)
    REFERENCES `SkillBoost`.`Lead` (`MaLead`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK__BaoGia__MaGiamGi__68487DD7`
    FOREIGN KEY (`MaGiamGia`)
    REFERENCES `SkillBoost`.`MaGiamGia` (`MaGiamGia`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

-- ----------------------------------------------------------------------------
-- Table SkillBoost.ChiTietKhoaHocThuocBaoGia
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `SkillBoost`.`ChiTietKhoaHocThuocBaoGia` (
  `MaBaoGia` VARCHAR(13) NOT NULL,
  `MaKhoaHoc` VARCHAR(13) NOT NULL,
  `TenKhoaHoc` VARCHAR(100) CHARACTER SET 'utf8mb4' NOT NULL,
  `GiangVien` VARCHAR(20) CHARACTER SET 'utf8mb4' NOT NULL,
  `GiaTien` DOUBLE NOT NULL,
  PRIMARY KEY (`MaBaoGia`, `MaKhoaHoc`),
  CONSTRAINT `FK__ChiTietKh__MaBao__693CA210`
    FOREIGN KEY (`MaBaoGia`)
    REFERENCES `SkillBoost`.`BaoGia` (`MaBaoGia`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK__ChiTietKh__MaKho__6A30C649`
    FOREIGN KEY (`MaKhoaHoc`)
    REFERENCES `SkillBoost`.`KhoaHoc` (`MaKhoaHoc`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

-- ----------------------------------------------------------------------------
-- Table SkillBoost.QuyDinhGiamGia
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `SkillBoost`.`QuyDinhGiamGia` (
  `STT` INT NOT NULL,
  `MaQuyDinhGiamGia` VARCHAR(13) NOT NULL,
  `MoTaLoaiGiamGia` VARCHAR(150) CHARACTER SET 'utf8mb4' NOT NULL,
  `SoLuongKhoaHocDangKy` INT NOT NULL,
  `MaNgheNghiep` VARCHAR(13) NULL,
  `TenNgheNghiep` VARCHAR(100) CHARACTER SET 'utf8mb4' NULL,
  `NgayBatDau` DATE NULL,
  `NgayKetThuc` DATE NULL,
  `PhanTramGiamGiaMacDinh` INT NOT NULL,
  `PhanTramGiamGiaToiDa` INT NOT NULL,
  `TaoVaoLuc` DATETIME NOT NULL,
  `TaoBoi` VARCHAR(20) CHARACTER SET 'utf8mb4' NOT NULL,
  `TaoBoiNV` VARCHAR(50) CHARACTER SET 'utf8mb4' NOT NULL,
  `ChinhSuaLanCuoiVaoLuc` DATETIME NOT NULL,
  `ChinhSuaLanCuoiBoi` VARCHAR(20) CHARACTER SET 'utf8mb4' NOT NULL,
  `TrangThaiQuyDinhGiamGia` VARCHAR(30) CHARACTER SET 'utf8mb4' NOT NULL,
  PRIMARY KEY (`MaQuyDinhGiamGia`),
  CONSTRAINT `FK__QuyDinhGi__MaNgh__6B24EA82`
    FOREIGN KEY (`MaNgheNghiep`)
    REFERENCES `SkillBoost`.`NgheNghiep` (`MaNgheNghiep`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

-- ----------------------------------------------------------------------------
-- Table SkillBoost.MaGiamGia
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `SkillBoost`.`MaGiamGia` (
  `STT` INT NOT NULL,
  `MaGiamGia` VARCHAR(13) NOT NULL,
  `MoTaMaGiamGia` VARCHAR(30) NOT NULL,
  `PhamViApDung` VARCHAR(50) CHARACTER SET 'utf8mb4' NOT NULL,
  `PhanTramGiamGia` INT NOT NULL,
  `TrangThaiMaGiamGia` VARCHAR(30) CHARACTER SET 'utf8mb4' NOT NULL,
  `MaQuyDinhGiamGia` VARCHAR(13) NOT NULL,
  `TaoVaoLuc` DATETIME NOT NULL,
  `TaoBoi` VARCHAR(20) CHARACTER SET 'utf8mb4' NOT NULL,
  PRIMARY KEY (`MaGiamGia`),
  CONSTRAINT `FK__MaGiamGia__MaQuy__6C190EBB`
    FOREIGN KEY (`MaQuyDinhGiamGia`)
    REFERENCES `SkillBoost`.`QuyDinhGiamGia` (`MaQuyDinhGiamGia`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

-- ----------------------------------------------------------------------------
-- Table SkillBoost.ChiTietDoiTuongUuDai
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `SkillBoost`.`ChiTietDoiTuongUuDai` (
  `MaGiamGia` VARCHAR(13) NOT NULL,
  `MaLead` VARCHAR(13) NOT NULL,
  `DaApDung` VARCHAR(20) CHARACTER SET 'utf8mb4' NOT NULL,
  PRIMARY KEY (`MaGiamGia`, `MaLead`),
  CONSTRAINT `FK__ChiTietDo__MaGia__6D0D32F4`
    FOREIGN KEY (`MaGiamGia`)
    REFERENCES `SkillBoost`.`MaGiamGia` (`MaGiamGia`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK__ChiTietDo__MaLea__6E01572D`
    FOREIGN KEY (`MaLead`)
    REFERENCES `SkillBoost`.`Lead` (`MaLead`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

-- ----------------------------------------------------------------------------
-- Table SkillBoost.KhachHang
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `SkillBoost`.`KhachHang` (
  `STT` INT NOT NULL,
  `MaKH` VARCHAR(13) NOT NULL,
  `HoTenKH` VARCHAR(70) CHARACTER SET 'utf8mb4' NOT NULL,
  `GioiTinhKH` VARCHAR(10) CHARACTER SET 'utf8mb4' NULL,
  `NgaySinhKH` DATE NULL,
  `SoDienThoaiKH` CHAR(10) NOT NULL,
  `EmailKH` VARCHAR(70) NOT NULL,
  `MaNgheNghiep` VARCHAR(13) NULL,
  `TenNgheNghiep` VARCHAR(50) CHARACTER SET 'utf8mb4' NULL,
  `MaNVPhuTrachKH` VARCHAR(13) NOT NULL,
  `TenNVPhuTrachKH` VARCHAR(50) CHARACTER SET 'utf8mb4' NOT NULL,
  `TrangThaiKH` VARCHAR(30) CHARACTER SET 'utf8mb4' NOT NULL,
  `LyDoTrangThaiKH` VARCHAR(100) CHARACTER SET 'utf8mb4' NULL,
  `GhiChuKH` VARCHAR(100) CHARACTER SET 'utf8mb4' NULL,
  `ChuyenDoiTuMaLead` VARCHAR(13) NULL,
  `TaoVaoLuc` DATETIME NOT NULL,
  `TaoBoi` VARCHAR(20) CHARACTER SET 'utf8mb4' NOT NULL,
  `ChinhSuaLanCuoiVaoLuc` DATETIME NOT NULL,
  `ChinhSuaLanCuoiBoi` VARCHAR(20) CHARACTER SET 'utf8mb4' NOT NULL,
  PRIMARY KEY (`MaKH`),
  UNIQUE INDEX `ConstraintUniqueSDTKH` (`SoDienThoaiKH` ASC) VISIBLE,
  UNIQUE INDEX `ConstraintUniqueEmailKH` (`EmailKH` ASC) VISIBLE,
  CONSTRAINT `FK__KhachHang__MaNgh__6EF57B66`
    FOREIGN KEY (`MaNgheNghiep`)
    REFERENCES `SkillBoost`.`NgheNghiep` (`MaNgheNghiep`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK__KhachHang__MaNVP__6FE99F9F`
    FOREIGN KEY (`MaNVPhuTrachKH`)
    REFERENCES `SkillBoost`.`NhanVien` (`MaNV`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK__KhachHang__Chuye__70DDC3D8`
    FOREIGN KEY (`ChuyenDoiTuMaLead`)
    REFERENCES `SkillBoost`.`Lead` (`MaLead`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

-- ----------------------------------------------------------------------------
-- Table SkillBoost.HoatDongKH
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `SkillBoost`.`HoatDongKH` (
  `STT` INT NOT NULL,
  `MaHDKH` VARCHAR(12) NOT NULL,
  `MaKH` VARCHAR(13) NOT NULL,
  `TenHDKH` VARCHAR(200) CHARACTER SET 'utf8mb4' NOT NULL,
  `LoaiHDKH` VARCHAR(30) CHARACTER SET 'utf8mb4' NOT NULL,
  `HDKHDuocTaoBoi` VARCHAR(30) CHARACTER SET 'utf8mb4' NOT NULL,
  `MaNVPhuTrachHDKH` VARCHAR(13) NOT NULL,
  `TenNVPhuTrachHDKH` VARCHAR(50) CHARACTER SET 'utf8mb4' NOT NULL,
  `MaEmailDenKH` VARCHAR(13) NULL,
  `TaoVaoLuc` DATETIME NOT NULL,
  PRIMARY KEY (`MaHDKH`),
  CONSTRAINT `FK__HoatDongKH__MaKH__71D1E811`
    FOREIGN KEY (`MaKH`)
    REFERENCES `SkillBoost`.`KhachHang` (`MaKH`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK__HoatDongK__MaNVP__72C60C4A`
    FOREIGN KEY (`MaNVPhuTrachHDKH`)
    REFERENCES `SkillBoost`.`NhanVien` (`MaNV`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK__HoatDongK__MaEma__73BA3083`
    FOREIGN KEY (`MaEmailDenKH`)
    REFERENCES `SkillBoost`.`Email` (`MaEmail`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

-- ----------------------------------------------------------------------------
-- Table SkillBoost.KhoaHoc
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `SkillBoost`.`KhoaHoc` (
  `STT` INT NOT NULL,
  `MaKhoaHoc` VARCHAR(13) NOT NULL,
  `TenKhoaHoc` VARCHAR(100) CHARACTER SET 'utf8mb4' NOT NULL,
  `MoTaKhoaHoc` LONGTEXT NOT NULL,
  `ThoiLuongKhoaHoc` VARCHAR(20) CHARACTER SET 'utf8mb4' NOT NULL,
  `GiangVien` VARCHAR(20) CHARACTER SET 'utf8mb4' NOT NULL,
  `MucDoKhoaHoc` VARCHAR(30) CHARACTER SET 'utf8mb4' NOT NULL,
  `SoLuongHocVienToiDa` INT NOT NULL,
  `GiaTien` DOUBLE NOT NULL,
  `NgayKhaiGiang` DATE NOT NULL,
  `NgayBeGiang` DATE NOT NULL,
  `DanhGiaKhoaHoc` DOUBLE NOT NULL,
  `TrangThaiKhoaHoc` VARCHAR(30) CHARACTER SET 'utf8mb4' NOT NULL,
  `MaLoaiKhoaHoc` VARCHAR(13) NOT NULL,
  `TaoVaoLuc` DATETIME NOT NULL,
  `TaoBoi` VARCHAR(20) CHARACTER SET 'utf8mb4' NOT NULL,
  `ChinhSuaLanCuoiVaoLuc` DATETIME NOT NULL,
  `ChinhSuaLanCuoiBoi` VARCHAR(20) CHARACTER SET 'utf8mb4' NOT NULL,
  PRIMARY KEY (`MaKhoaHoc`),
  CONSTRAINT `FK__KhoaHoc__MaLoaiK__74AE54BC`
    FOREIGN KEY (`MaLoaiKhoaHoc`)
    REFERENCES `SkillBoost`.`LoaiKhoaHoc` (`MaLoaiKhoaHoc`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

-- ----------------------------------------------------------------------------
-- Table SkillBoost.LoaiKhoaHoc
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `SkillBoost`.`LoaiKhoaHoc` (
  `STT` INT NOT NULL,
  `MaLoaiKhoaHoc` VARCHAR(13) NOT NULL,
  `TenLoaiKhoaHoc` VARCHAR(30) CHARACTER SET 'utf8mb4' NOT NULL,
  `TrangThaiLoaiKhoaHoc` VARCHAR(30) CHARACTER SET 'utf8mb4' NOT NULL,
  `TaoVaoLuc` DATETIME NOT NULL,
  `TaoBoi` VARCHAR(20) CHARACTER SET 'utf8mb4' NOT NULL,
  `ChinhSuaLanCuoiVaoLuc` DATETIME NOT NULL,
  `ChinhSuaLanCuoiBoi` VARCHAR(20) CHARACTER SET 'utf8mb4' NOT NULL,
  PRIMARY KEY (`MaLoaiKhoaHoc`));

-- ----------------------------------------------------------------------------
-- Table SkillBoost.Email
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `SkillBoost`.`Email` (
  `STT` INT NOT NULL,
  `MaEmail` VARCHAR(13) NOT NULL,
  `TieuDeEmail` VARCHAR(200) CHARACTER SET 'utf8mb4' NOT NULL,
  `NoiDungEmail` LONGTEXT NOT NULL,
  `LichGuiEmail` DATETIME NOT NULL,
  `NguoiNhan` VARCHAR(50) CHARACTER SET 'utf8mb4' NOT NULL,
  `TrangThaiEmail` VARCHAR(30) CHARACTER SET 'utf8mb4' NOT NULL,
  `MaYCTV` VARCHAR(13) NULL,
  `MaBaoGia` VARCHAR(13) NULL,
  `MaHoaDon` VARCHAR(13) NULL,
  `MaEmailMau` VARCHAR(13) NOT NULL,
  `TaoVaoLuc` DATETIME NOT NULL,
  `TaoBoi` VARCHAR(20) CHARACTER SET 'utf8mb4' NOT NULL,
  `ChinhSuaLanCuoiVaoLuc` DATETIME NOT NULL,
  `ChinhSuaLanCuoiBoi` VARCHAR(20) CHARACTER SET 'utf8mb4' NOT NULL,
  PRIMARY KEY (`MaEmail`),
  CONSTRAINT `FK__Email__MaYCTV__75A278F5`
    FOREIGN KEY (`MaYCTV`)
    REFERENCES `SkillBoost`.`YeuCauTuVan` (`MaTuVan`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK__Email__MaBaoGia__76969D2E`
    FOREIGN KEY (`MaBaoGia`)
    REFERENCES `SkillBoost`.`BaoGia` (`MaBaoGia`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK__Email__MaHoaDon__778AC167`
    FOREIGN KEY (`MaHoaDon`)
    REFERENCES `SkillBoost`.`HoaDon` (`MaHoaDon`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK__Email__MaEmailMa__787EE5A0`
    FOREIGN KEY (`MaEmailMau`)
    REFERENCES `SkillBoost`.`EmailMau` (`MaEmailMau`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

-- ----------------------------------------------------------------------------
-- Table SkillBoost.EmailMau
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `SkillBoost`.`EmailMau` (
  `STT` INT NOT NULL,
  `MaEmailMau` VARCHAR(13) NOT NULL,
  `TieuDeEmailMau` VARCHAR(200) CHARACTER SET 'utf8mb4' NOT NULL,
  `MoTaEmailMau` LONGTEXT NOT NULL,
  `NoiDungEmailMau` LONGTEXT NOT NULL,
  `TrangThaiEmailMau` VARCHAR(30) CHARACTER SET 'utf8mb4' NOT NULL,
  `TaoVaoLuc` DATETIME NOT NULL,
  `TaoBoi` VARCHAR(20) CHARACTER SET 'utf8mb4' NOT NULL,
  `ChinhSuaLanCuoiVaoLuc` DATETIME NOT NULL,
  `ChinhSuaLanCuoiBoi` VARCHAR(20) CHARACTER SET 'utf8mb4' NOT NULL,
  PRIMARY KEY (`MaEmailMau`));

-- ----------------------------------------------------------------------------
-- Table SkillBoost.HoaDon
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `SkillBoost`.`HoaDon` (
  `STT` INT NOT NULL,
  `MaHoaDon` VARCHAR(13) NOT NULL,
  `MoTaHoaDon` VARCHAR(200) CHARACTER SET 'utf8mb4' NOT NULL,
  `TenKH` VARCHAR(50) CHARACTER SET 'utf8mb4' NOT NULL,
  `ThoiDiemThanhToan` DATETIME NOT NULL,
  `TongHoaDon` DOUBLE NOT NULL,
  `MaBaoGia` VARCHAR(13) NOT NULL,
  `TaoVaoLuc` DATETIME NOT NULL,
  `TaoBoi` VARCHAR(20) CHARACTER SET 'utf8mb4' NOT NULL,
  PRIMARY KEY (`MaHoaDon`),
  CONSTRAINT `FK__HoaDon__MaBaoGia__797309D9`
    FOREIGN KEY (`MaBaoGia`)
    REFERENCES `SkillBoost`.`BaoGia` (`MaBaoGia`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

-- ----------------------------------------------------------------------------
-- Table SkillBoost.ChiTietKhoaHocThuocHoaDon
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `SkillBoost`.`ChiTietKhoaHocThuocHoaDon` (
  `MaHoaDon` VARCHAR(13) NOT NULL,
  `MaKhoaHoc` VARCHAR(13) NOT NULL,
  `TenKhoaHoc` VARCHAR(100) CHARACTER SET 'utf8mb4' NOT NULL,
  `GiangVien` VARCHAR(20) CHARACTER SET 'utf8mb4' NOT NULL,
  `GiaTien` DOUBLE NOT NULL,
  PRIMARY KEY (`MaHoaDon`, `MaKhoaHoc`),
  CONSTRAINT `FK__ChiTietKh__MaHoa__7A672E12`
    FOREIGN KEY (`MaHoaDon`)
    REFERENCES `SkillBoost`.`HoaDon` (`MaHoaDon`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK__ChiTietKh__MaKho__7B5B524B`
    FOREIGN KEY (`MaKhoaHoc`)
    REFERENCES `SkillBoost`.`KhoaHoc` (`MaKhoaHoc`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

-- ----------------------------------------------------------------------------
-- Trigger SkillBoost.TR_HASH_MK
-- ----------------------------------------------------------------------------
-- DELIMITER $$
-- USE `SkillBoost`$$
-- 
-- CREATE TRIGGER TR_HASH_MK ON TaiKhoan
-- AFTER INSERT
-- AS
-- DECLARE @mk_tmp VARCHAR(50), @salt UNIQUEIDENTIFIER;
-- SELECT @mk_tmp = MatKhauTK, @salt = MaSaltTK
-- FROM inserted
-- UPDATE TaiKhoan 
-- SET MaHashTK = (HASHBYTES('SHA2_512', @mk_tmp + CAST(@salt AS NVARCHAR(36)))),
-- MatKhauTK = '###'
-- WHERE MaSaltTK = @salt
-- 
-- ;
SET FOREIGN_KEY_CHECKS = 1;
