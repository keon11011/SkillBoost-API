/* TẠO DATABASE SkillBoost */
CREATE DATABASE SkillBoost

; 
USE SkillBoost

/*USE CASE 1*/
/* TẠO TABLE NHAN_VIEN */
;

CREATE TABLE NhanVien(
   MaNV                  INT AUTO_INCREMENT NOT NULL PRIMARY KEY
  ,HoTenNV               VARCHAR(255) NOT NULL
  ,GioiTinhNV            VARCHAR(4)
  ,NgaySinhNV            DATE 
  ,ChucVu                VARCHAR(255) NOT NULL
  ,SoDienThoaiNV         VARCHAR(10) NOT NULL
  ,EmailNV               VARCHAR(255) NOT NULL
  ,TrangThaiNV           VARCHAR(255) NOT NULL
  ,TaoVaoLuc             DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
  ,TaoBoi                INT NOT NULL
  ,ChinhSuaLanCuoiVaoLuc DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
  ,ChinhSuaLanCuoiBoi    INT NOT NULL
);
-- DROP TABLE NhanVien;
/* TẠO TABLE TaiKhoan */
CREATE TABLE TaiKhoan(
   MaTK                  INT AUTO_INCREMENT NOT NULL PRIMARY KEY
  ,EmailTK               VARCHAR(255) NOT NULL
  ,MatKhauTK             VARCHAR(255) NOT NULL
  ,MaSaltTK 		     VARCHAR(255)
  ,TrangThaiTK           VARCHAR(255) NOT NULL
  ,MaNV                  INT NOT NULL
  ,TaoVaoLuc             DATETIME  NOT NULL DEFAULT CURRENT_TIMESTAMP
  ,TaoBoi                INT NOT NULL
  ,ChinhSuaLanCuoiVaoLuc DATETIME  NOT NULL DEFAULT CURRENT_TIMESTAMP
  ,ChinhSuaLanCuoiBoi    INT NOT NULL
);
-- DROP TABLE TaiKhoan;

CREATE TABLE YeuCauTuVan(
   MaTuVan            INT AUTO_INCREMENT NOT NULL PRIMARY KEY
  ,TenLeadYeuCau      VARCHAR(255) NOT NULL
  ,NgaySinhLeadYeuCau DATE  NOT NULL
  ,EmailLeadYeuCau    VARCHAR(255) NOT NULL
  ,SDTLeadYeuCau      VARCHAR(10) NOT NULL
  ,GhiChuYCTV         VARCHAR(255)
  ,TrangThaiYCTV      VARCHAR(255) NOT NULL
  ,TaoVaoLuc          DATETIME  NOT NULL DEFAULT CURRENT_TIMESTAMP
  ,TaoBoiLead         INT NOT NULL
);
-- DROP TABLE YeuCauTuVan;

CREATE TABLE ChiTietKhoaHocThuocYCTV(
   MaTuVan    INT NOT NULL
  ,MaKhoaHoc  INT NOT NULL
  ,TenKhoaHoc VARCHAR(255) NOT NULL
  ,GiangVien  VARCHAR(255) NOT NULL
  ,HocPhi     INT  NOT NULL
  ,PRIMARY KEY (MaTuVan, MaKhoaHoc)
);
-- DROP TABLE ChiTietKhoaHocThuocYCTV;

CREATE TABLE TBL_Lead(
   MaLead                INT AUTO_INCREMENT NOT NULL PRIMARY KEY
  ,HoTenLead             VARCHAR(255) NOT NULL
  ,GioiTinhLead          VARCHAR(255) NOT NULL
  ,NgaySinhLead          DATE  NOT NULL
  ,SoDienThoaiLead       VARCHAR(10) NOT NULL
  ,EmailLead             VARCHAR(255) NOT NULL
  ,MaNgheNghiep          INT NOT NULL
  ,MaNVPhuTrachLead      VARCHAR(255) NOT NULL
  ,TrangThaiLead         VARCHAR(255) NOT NULL
  ,LyDoTrangThaiLead     VARCHAR(255)
  ,NguonLead             VARCHAR(255) NOT NULL
  ,GhiChuLead            VARCHAR(255)
  ,LeadTuKHCu            INT
  ,TaoVaoLuc             DATETIME  NOT NULL DEFAULT CURRENT_TIMESTAMP
  ,TaoBoi                INT NOT NULL
  ,ChinhSuaLanCuoiVaoLuc DATETIME  NOT NULL DEFAULT CURRENT_TIMESTAMP
  ,ChinhSuaLanCuoiBoi    INT NOT NULL
);

CREATE TABLE HoatDongLead(
   MaHDLead            INT AUTO_INCREMENT NOT NULL PRIMARY KEY
  ,MaLead              INT NOT NULL
  ,TenHDLead           VARCHAR(255) NOT NULL
  ,LoaiHDLead          VARCHAR(255) NOT NULL
  ,HDLeadDuocTaoBoi    VARCHAR(255) NOT NULL
  ,MaNVPhuTrachHDLead  INT NOT NULL
  ,TenNVPhuTrachHDLead VARCHAR(255) NOT NULL
  ,MaEmailDenLead      INT
  ,TaoVaoLuc           DATETIME  NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE NgheNghiep(
   MaNgheNghiep          INT AUTO_INCREMENT NOT NULL PRIMARY KEY
  ,TenNgheNghiep         VARCHAR(255) NOT NULL
  ,TrangThaiNgheNghiep   VARCHAR(255) NOT NULL
  ,TaoVaoLuc             DATETIME  NOT NULL DEFAULT CURRENT_TIMESTAMP
  ,TaoBoi                INT NOT NULL
  ,ChinhSuaLanCuoiVaoLuc DATETIME  NOT NULL DEFAULT CURRENT_TIMESTAMP
  ,ChinhSuaLanCuoiBoi    INT NOT NULL 
);
-- DROP TABLE NgheNghiep;

CREATE TABLE BaoGia(
   MaBaoGia              INT AUTO_INCREMENT NOT NULL PRIMARY KEY
  ,TenBaoGia             VARCHAR(255) NOT NULL
  ,MaLead                INT NOT NULL
  ,HoTenLead             VARCHAR(255) NOT NULL
  ,TongTienTruocGiam     INT NOT NULL
  ,MaGiamGia             INT
  ,PhamTramGiamGIa       INT 
  ,TongTien              INT NOT NULL
  ,TrangThaiBaoGia       VARCHAR(255) NOT NULL
  ,TaoVaoLuc             DATETIME  NOT NULL DEFAULT CURRENT_TIMESTAMP
  ,TaoBoi                INT NOT NULL
  ,ChinhSuaLanCuoiVaoLuc DATETIME  NOT NULL DEFAULT CURRENT_TIMESTAMP
  ,ChinhSuaLanCuoiBoi    INT NOT NULL
);
-- DROP TABLE BaoGia;

CREATE TABLE ChiTietKhoaHocThuocBaoGia(
   MaBaoGia   INT NOT NULL
  ,MaKhoaHoc  INT NOT NULL
  ,TenKhoaHoc VARCHAR(255) NOT NULL
  ,GiangVien  VARCHAR(255) NOT NULL
  ,GiaTien    INT  NOT NULL
  ,PRIMARY KEY (MaBaoGia, MaKhoaHoc)
);
-- DROP TABLE ChiTietKhoaHocThuocBaoGia;

CREATE TABLE QuyDinhGiamGia(
   MaQuyDinhGiamGia        INT AUTO_INCREMENT NOT NULL PRIMARY KEY
  ,MoTaLoaiGiamGia         VARCHAR(255) NOT NULL
  ,SoLuongKhoaHocDangKy    INTEGER  NOT NULL
  ,MaNgheNghiep            VARCHAR(255)
  ,NgayBatDau              DATE 
  ,NgayKetThuc             DATE 
  ,PhanTramGiamGiaMacDinh  INT  NOT NULL
  ,PhanTramGiamGiaToiDa    INT  NOT NULL
  ,TaoVaoLuc               DATETIME  NOT NULL DEFAULT CURRENT_TIMESTAMP
  ,TaoBoi                  VARCHAR(255) NOT NULL
  ,ChinhSuaLanCuoiVaoLuc   DATETIME  NOT NULL
  ,ChinhSuaLanCuoiBoi      VARCHAR(255) NOT NULL DEFAULT CURRENT_TIMESTAMP
  ,TrangThaiQuyDinhGiamGia VARCHAR(14) NOT NULL
);
-- DROP TABLE QuyDinhGiamGia;

CREATE TABLE MaGiamGia(
   MaGiamGia             INT AUTO_INCREMENT NOT NULL PRIMARY KEY
  ,MoTaMaGiamGia         VARCHAR(255) NOT NULL
  ,PhamViApDung          VARCHAR(255) NOT NULL
  ,PhanTramGiamGia       INT  NOT NULL
  ,TrangThaiMaGiamGia    VARCHAR(10) NOT NULL
  ,MaQuyDinhGiamGia      VARCHAR(255) NOT NULL 
  ,TaoVaoLuc             DATETIME  NOT NULL DEFAULT CURRENT_TIMESTAMP
  ,TaoBoi                INT  NOT NULL
  ,ChinhSuaLanCuoiVaoLuc DATETIME  NOT NULL DEFAULT CURRENT_TIMESTAMP
  ,ChinhSuaLanCuoiBoi    INT  NOT NULL
);
-- DROP TABLE MaGiamGia;

CREATE TABLE ChiTietDoiTuongUuDai(
   MaGiamGia INT NOT NULL
  ,MaLead    INT NOT NULL
  ,DaApDung  VARCHAR(255) NOT NULL
  ,PRIMARY KEY (MaGiamGia, MaLead)
);
-- DROP TABLE ChiTietDoiTuongUuDai;

CREATE TABLE KhachHang(
   MaKH                  INT AUTO_INCREMENT NOT NULL PRIMARY KEY
  ,HoTenKH               VARCHAR(255) NOT NULL
  ,GioiTinhKH            VARCHAR(255) NOT NULL
  ,NgaySinhKH            DATE  NOT NULL
  ,SoDienThoaiKH         VARCHAR(10) NOT NULL
  ,EmailKH               VARCHAR(255) NOT NULL
  ,MaNgheNghiep          INT NOT NULL
  ,MaNVPhuTrachKH        INT NOT NULL
  ,TenNVPhuTrachKH       VARCHAR(255) NOT NULL
  ,TrangThaiKH           VARCHAR(255) NOT NULL
  ,LyDoTrangThaiKH       VARCHAR(255)
  ,GhiChuKH              VARCHAR(255)
  ,ChuyenDoiTuMaLead     INT NOT NULL
  ,TaoVaoLuc             DATETIME  NOT NULL DEFAULT CURRENT_TIMESTAMP
  ,TaoBoi                INT NOT NULL
  ,ChinhSuaLanCuoiVaoLuc DATETIME  NOT NULL DEFAULT CURRENT_TIMESTAMP
  ,ChinhSuaLanCuoiBoi    INT NOT NULL
);
-- DROP TABLE KhachHang;

CREATE TABLE HoatDongKH(
   MaHDKH            INT AUTO_INCREMENT NOT NULL PRIMARY KEY
  ,MaKH              INT NOT NULL
  ,TenHDKH           VARCHAR(255) NOT NULL
  ,LoaiHDKH          VARCHAR(255) NOT NULL
  ,HDKHDuocTaoBoi    VARCHAR(255) NOT NULL
  ,MaNVPhuTrachHDKH  INT NOT NULL
  ,TenNVPhuTrachHDKH VARCHAR(255) NOT NULL
  ,MaEmailDenKH      INT
  ,TaoVaoLuc         DATETIME  NOT NULL DEFAULT CURRENT_TIMESTAMP
);
-- DROP TABLE HoatDongKH;

CREATE TABLE KhoaHoc(
   MaKhoaHoc             INT AUTO_INCREMENT NOT NULL PRIMARY KEY
  ,TenKhoaHoc            VARCHAR(255) NOT NULL
  ,MoTaNgan              TEXT NOT NULL
  ,MoTaDai               LONGTEXT NOT NULL
  ,ThoiLuongKhoaHoc      INT  NOT NULL
  ,SoBaiViet             INT  NOT NULL
  ,SoFileTaiXuong        INT  NOT NULL
  ,GiangVien             VARCHAR(255) NOT NULL
  ,MucDoKhoaHoc          VARCHAR(255) NOT NULL
  ,LuotDanhGia           INT  NOT NULL
  ,SoLuongHocVienToiDa   INT  NOT NULL
  ,SoLuongHocVienConLai  INT  NOT NULL
  ,GiaTien               INT  NOT NULL
  ,NgayKhaiGiang         DATE  NOT NULL
  ,NgayBeGiang           DATE  NOT NULL
  ,DanhGiaKhoaHoc        FLOAT  NOT NULL
  ,TrangThaiKhoaHoc      VARCHAR(255) NOT NULL
  ,MaLoaiKhoaHoc         INT NOT NULL
  ,TaoVaoLuc             DATETIME  NOT NULL DEFAULT CURRENT_TIMESTAMP
  ,TaoBoi                INT NOT NULL
  ,ChinhSuaLanCuoiVaoLuc DATETIME  NOT NULL DEFAULT CURRENT_TIMESTAMP
  ,ChinhSuaLanCuoiBoi    INT NOT NULL
);
-- DROP TABLE KhoaHoc;

CREATE TABLE LoaiKhoaHoc(
   MaLoaiKhoaHoc         INT AUTO_INCREMENT NOT NULL PRIMARY KEY
  ,TenLoaiKhoaHoc        VARCHAR(255) NOT NULL
  ,TrangThaiLoaiKhoaHoc  VARCHAR(255) NOT NULL
  ,TaoVaoLuc             DATETIME  NOT NULL DEFAULT CURRENT_TIMESTAMP
  ,TaoBoi                INT NOT NULL
  ,ChinhSuaLanCuoiVaoLuc DATETIME  NOT NULL DEFAULT CURRENT_TIMESTAMP
  ,ChinhSuaLanCuoiBoi    INT NOT NULL
);
-- DROP TABLE LoaiKhoaHoc;

CREATE TABLE LichHoc(
   ID                     INT AUTO_INCREMENT PRIMARY KEY
  ,MaKhoaHoc              INT NOT NULL
  ,ThuTrongTuan           VARCHAR(255) NOT NULL
  ,ThoiGianBatDauBuoiHoc  VARCHAR(255) NOT NULL
  ,ThoiGianKetThucBuoiHoc VARCHAR(255) NOT NULL
  ,TaoVaoLuc              DATETIME  NOT NULL DEFAULT CURRENT_TIMESTAMP
  ,TaoBoi                 INT NOT NULL
  ,ChinhSuaLanCuoiVaoLuc  DATETIME  NOT NULL DEFAULT CURRENT_TIMESTAMP
  ,ChinhSuaLanCuoiBoi     INT NOT NULL
);
-- DROP TABLE LichHoc;

CREATE TABLE Email(
   MaEmail               INT AUTO_INCREMENT NOT NULL PRIMARY KEY
  ,TieuDeEmail           VARCHAR(255) NOT NULL
  ,NoiDungEmail          LONGTEXT  NOT NULL
  ,LichGuiEmail          DATETIME  NOT NULL
  ,NguoiNhan             VARCHAR(255) NOT NULL
  ,TrangThaiEmail        VARCHAR(255) NOT NULL
  ,MaYCTV                INT
  ,MaBaoGia              INT
  ,MaHoaDon              INT
  ,MaEmailMau            INT NOT NULL
  ,TaoVaoLuc             DATETIME  NOT NULL DEFAULT CURRENT_TIMESTAMP
  ,TaoBoi                INT NOT NULL 
  ,ChinhSuaLanCuoiVaoLuc DATETIME  NOT NULL DEFAULT CURRENT_TIMESTAMP
  ,ChinhSuaLanCuoiBoi    INT NOT NULL
);
-- DROP TABLE Email;

CREATE TABLE EmailMau(
   MaEmailMau            INT AUTO_INCREMENT NOT NULL PRIMARY KEY
  ,TieuDeEmailMau        VARCHAR(255) NOT NULL
  ,MoTaEmailMau          VARCHAR(255) NOT NULL
  ,NoiDungEmailMau       LONGTEXT NOT NULL
  ,TrangThaiEmailMau     VARCHAR(255) NOT NULL
  ,TaoVaoLuc             DATETIME  NOT NULL DEFAULT CURRENT_TIMESTAMP
  ,TaoBoi                INT NOT NULL
  ,ChinhSuaLanCuoiVaoLuc DATETIME  NOT NULL DEFAULT CURRENT_TIMESTAMP
  ,ChinhSuaLanCuoiBoi    INT NOT NULL
);
-- DROP TABLE EmailMau;

CREATE TABLE HoaDon(
   MaHoaDon          INT AUTO_INCREMENT NOT NULL PRIMARY KEY
  ,MoTaHoaDon        LONGTEXT NOT NULL
  ,TenKH             VARCHAR(255) NOT NULL
  ,ThoiDiemThanhToan DATETIME  NOT NULL
  ,TongHoaDon        INT  NOT NULL
  ,MaBaoGia          INT NOT NULL
  ,TaoVaoLuc         DATETIME  NOT NULL DEFAULT CURRENT_TIMESTAMP
  ,TaoBoi            INT NOT NULL
);
-- DROP TABLE Email;

CREATE TABLE ChiTietKhoaHocThuocHoaDon(
   MaHoaDon   INT NOT NULL
  ,MaKhoaHoc  INT NOT NULL
  ,TenKhoaHoc VARCHAR(255) NOT NULL
  ,GiangVien  VARCHAR(255) NOT NULL
  ,GiaTien    INT  NOT NULL
  ,PRIMARY KEY (MaHoaDon, MaKhoaHoc)
);
-- DROP TABLE ChiTietKhoaHocThuocHoaDon;
