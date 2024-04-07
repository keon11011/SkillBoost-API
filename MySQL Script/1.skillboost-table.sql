/* TẠO DATABASE SkillBoost */
;
CREATE DATABASE SkillBoost

; 
USE SkillBoost

/*USE CASE 1*/
/* TẠO TABLE NHAN_VIEN */
;

CREATE TABLE NhanVien(
   MaNV                  VARCHAR(255) NOT NULL PRIMARY KEY
  ,HoTenNV               VARCHAR(255) NOT NULL
  ,GioiTinhNV            VARCHAR(4)
  ,NgaySinhNV            DATE 
  ,ChucVu                VARCHAR(255) NOT NULL
  ,SoDienThoaiNV         VARCHAR(10) NOT NULL
  ,EmailNV               VARCHAR(255) NOT NULL
  ,TrangThaiNV           VARCHAR(255) NOT NULL
  ,TaoVaoLuc             DATETIME NOT NULL
  ,TaoBoi                VARCHAR(255) NOT NULL
  ,ChinhSuaLanCuoiVaoLuc DATETIME NOT NULL
  ,ChinhSuaLanCuoiBoi    VARCHAR(255) NOT NULL
);
-- DROP TABLE NhanVien;
/* TẠO TABLE TaiKhoan */
CREATE TABLE TaiKhoan(
   MaTK                  VARCHAR(255) NOT NULL PRIMARY KEY
  ,EmailTK               VARCHAR(255) NOT NULL
  ,MatKhauTK             VARCHAR(255) NOT NULL
  ,MaSaltTK 		     VARCHAR(255)
  ,TrangThaiTK           VARCHAR(255) NOT NULL
  ,MaNV                  VARCHAR(255) NOT NULL
  ,TaoVaoLuc             DATETIME  NOT NULL
  ,TaoBoi                VARCHAR(255) NOT NULL
  ,ChinhSuaLanCuoiVaoLuc DATETIME  NOT NULL
  ,ChinhSuaLanCuoiBoi    VARCHAR(255) NOT NULL
);
-- DROP TABLE TaiKhoan;

CREATE TABLE YeuCauTuVan(
   MaTuVan            VARCHAR(255) NOT NULL PRIMARY KEY
  ,TenLeadYeuCau      VARCHAR(255) NOT NULL
  ,NgaySinhLeadYeuCau DATE  NOT NULL
  ,EmailLeadYeuCau    VARCHAR(255) NOT NULL
  ,SDTLeadYeuCau      VARCHAR(10) NOT NULL
  ,GhiChuYCTV         VARCHAR(255)
  ,TrangThaiYCTV      VARCHAR(255) NOT NULL
  ,TaoVaoLuc          DATETIME  NOT NULL
  ,TaoBoiLead         VARCHAR(255) NOT NULL
);
-- DROP TABLE YeuCauTuVan;

CREATE TABLE ChiTietKhoaHocThuocYCTV(
   MaTuVan    VARCHAR(255) NOT NULL
  ,MaKhoaHoc  VARCHAR(255) NOT NULL
  ,TenKhoaHoc VARCHAR(255) NOT NULL
  ,GiangVien  VARCHAR(255) NOT NULL
  ,HocPhi     INT  NOT NULL
  ,PRIMARY KEY (MaTuVan, MaKhoaHoc)
);
-- DROP TABLE ChiTietKhoaHocThuocYCTV;

CREATE TABLE TBL_Lead(
   MaLead                VARCHAR(255) NOT NULL PRIMARY KEY
  ,HoTenLead             VARCHAR(255) NOT NULL
  ,GioiTinhLead          VARCHAR(255) NOT NULL
  ,NgaySinhLead          DATE  NOT NULL
  ,SoDienThoaiLead       VARCHAR(10) NOT NULL
  ,EmailLead             VARCHAR(255) NOT NULL
  ,MaNgheNghiep          VARCHAR(255) NOT NULL
  ,MaNVPhuTrachLead      VARCHAR(255) NOT NULL
  ,TrangThaiLead         VARCHAR(255) NOT NULL
  ,LyDoTrangThaiLead     VARCHAR(255)
  ,NguonLead             VARCHAR(255) NOT NULL
  ,GhiChuLead            VARCHAR(255)
  ,LeadTuKHCu            VARCHAR(255)
  ,TaoVaoLuc             DATETIME  NOT NULL
  ,TaoBoi                VARCHAR(255) NOT NULL
  ,ChinhSuaLanCuoiVaoLuc DATETIME  NOT NULL
  ,ChinhSuaLanCuoiBoi    VARCHAR(255) NOT NULL
);

CREATE TABLE HoatDongLead(
   MaHDLead            VARCHAR(255) NOT NULL PRIMARY KEY
  ,MaLead              VARCHAR(255) NOT NULL
  ,TenHDLead           VARCHAR(255) NOT NULL
  ,LoaiHDLead          VARCHAR(255) NOT NULL
  ,HDLeadDuocTaoBoi    VARCHAR(255) NOT NULL
  ,MaNVPhuTrachHDLead  VARCHAR(255) NOT NULL
  ,TenNVPhuTrachHDLead VARCHAR(255) NOT NULL
  ,MaEmailDenLead      VARCHAR(255)
  ,TaoVaoLuc           DATETIME  NOT NULL
);

CREATE TABLE NgheNghiep(
   MaNgheNghiep          VARCHAR(255) NOT NULL PRIMARY KEY
  ,TenNgheNghiep         VARCHAR(255) NOT NULL
  ,TrangThaiNgheNghiep   VARCHAR(255) NOT NULL
  ,TaoVaoLuc             DATETIME  NOT NULL
  ,TaoBoi                VARCHAR(255) NOT NULL
  ,ChinhSuaLanCuoiVaoLuc DATETIME  NOT NULL
  ,ChinhSuaLanCuoiBoi    VARCHAR(255) NOT NULL
);
-- DROP TABLE NgheNghiep;

CREATE TABLE BaoGia(
   MaBaoGia              VARCHAR(255) NOT NULL PRIMARY KEY
  ,TenBaoGia             VARCHAR(255) NOT NULL
  ,MaLead                VARCHAR(255) NOT NULL
  ,HoTenLead             VARCHAR(255) NOT NULL
  ,TongTienTruocGiam     INT  NOT NULL
  ,MaGiamGia             VARCHAR(255)
  ,PhamTramGiamGIa       INT 
  ,TongTien              INT  NOT NULL
  ,TrangThaiBaoGia       VARCHAR(255) NOT NULL
  ,TaoVaoLuc             DATETIME  NOT NULL
  ,TaoBoi                VARCHAR(255) NOT NULL
  ,ChinhSuaLanCuoiVaoLuc DATETIME  NOT NULL
  ,ChinhSuaLanCuoiBoi    VARCHAR(255) NOT NULL
);
-- DROP TABLE BaoGia;

CREATE TABLE ChiTietKhoaHocThuocBaoGia(
   MaBaoGia   VARCHAR(255) NOT NULL
  ,MaKhoaHoc  VARCHAR(255) NOT NULL
  ,TenKhoaHoc VARCHAR(255) NOT NULL
  ,GiangVien  VARCHAR(255) NOT NULL
  ,GiaTien    INT  NOT NULL
  ,PRIMARY KEY (MaBaoGia, MaKhoaHoc)
);
-- DROP TABLE ChiTietKhoaHocThuocBaoGia;

CREATE TABLE QuyDinhGiamGia(
   MaQuyDinhGiamGia        VARCHAR(255) NOT NULL PRIMARY KEY
  ,MoTaLoaiGiamGia         VARCHAR(255) NOT NULL
  ,SoLuongKhoaHocDangKy    INTEGER  NOT NULL
  ,MaNgheNghiep            VARCHAR(255)
  ,NgayBatDau              DATE 
  ,NgayKetThuc             DATE 
  ,PhanTramGiamGiaMacDinh  INT  NOT NULL
  ,PhanTramGiamGiaToiDa    INT  NOT NULL
  ,TaoVaoLuc               DATETIME  NOT NULL
  ,TaoBoi                  VARCHAR(255) NOT NULL
  ,ChinhSuaLanCuoiVaoLuc   DATETIME  NOT NULL
  ,ChinhSuaLanCuoiBoi      VARCHAR(255) NOT NULL
  ,TrangThaiQuyDinhGiamGia VARCHAR(14) NOT NULL
);
-- DROP TABLE QuyDinhGiamGia;

CREATE TABLE MaGiamGia(
   MaGiamGia             VARCHAR(255) NOT NULL PRIMARY KEY
  ,MoTaMaGiamGia         VARCHAR(255) NOT NULL
  ,PhamViApDung          VARCHAR(255) NOT NULL
  ,PhanTramGiamGia       INTEGER  NOT NULL
  ,TrangThaiMaGiamGia    VARCHAR(10) NOT NULL
  ,MaQuyDinhGiamGia      VARCHAR(255) NOT NULL
  ,TaoVaoLuc             DATETIME  NOT NULL
  ,TaoBoi                VARCHAR(255) NOT NULL
  ,ChinhSuaLanCuoiVaoLuc DATETIME  NOT NULL
  ,ChinhSuaLanCuoiBoi    VARCHAR(255) NOT NULL
);
-- DROP TABLE MaGiamGia;

CREATE TABLE ChiTietDoiTuongUuDai(
   MaGiamGia VARCHAR(255) NOT NULL PRIMARY KEY
  ,MaLead    VARCHAR(255) NOT NULL
  ,DaApDung  VARCHAR(255) NOT NULL
);
-- DROP TABLE ChiTietDoiTuongUuDai;

CREATE TABLE KhachHang(
   MaKH                  VARCHAR(255) NOT NULL PRIMARY KEY
  ,HoTenKH               VARCHAR(255) NOT NULL
  ,GioiTinhKH            VARCHAR(255) NOT NULL
  ,NgaySinhKH            DATE  NOT NULL
  ,SoDienThoaiKH         VARCHAR(10) NOT NULL
  ,EmailKH               VARCHAR(255) NOT NULL
  ,MaNgheNghiep          VARCHAR(255) NOT NULL
  ,MaNVPhuTrachKH        VARCHAR(255) NOT NULL
  ,TenNVPhuTrachKH       VARCHAR(255) NOT NULL
  ,TrangThaiKH           VARCHAR(255) NOT NULL
  ,LyDoTrangThaiKH       VARCHAR(255)
  ,GhiChuKH              VARCHAR(255)
  ,ChuyenDoiTuMaLead     VARCHAR(255) NOT NULL
  ,TaoVaoLuc             DATETIME  NOT NULL
  ,TaoBoi                VARCHAR(255) NOT NULL
  ,ChinhSuaLanCuoiVaoLuc DATETIME  NOT NULL
  ,ChinhSuaLanCuoiBoi    VARCHAR(255) NOT NULL
);
-- DROP TABLE KhachHang;

CREATE TABLE HoatDongKH(
   MaHDKH            VARCHAR(255) NOT NULL PRIMARY KEY
  ,MaKH              VARCHAR(255) NOT NULL
  ,TenHDKH           VARCHAR(255) NOT NULL
  ,LoaiHDKH          VARCHAR(255) NOT NULL
  ,HDKHDuocTaoBoi    VARCHAR(255) NOT NULL
  ,MaNVPhuTrachHDKH  VARCHAR(255) NOT NULL
  ,TenNVPhuTrachHDKH VARCHAR(255) NOT NULL
  ,MaEmailDenKH      VARCHAR(255)
  ,TaoVaoLuc         DATETIME  NOT NULL
);
-- DROP TABLE HoatDongKH;
