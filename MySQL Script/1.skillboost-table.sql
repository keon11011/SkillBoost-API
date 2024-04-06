/* TẠO DATABASE SkillBoost */
;
-- CREATE DATABASE SkillBoost

; 
USE SkillBoost

/*USE CASE 1*/
/* TẠO TABLE NHAN_VIEN */
;
CREATE TABLE NhanVien(
    MaNV VARCHAR(6) PRIMARY KEY,
    HoTenNV VARCHAR(70) NOT NULL,
    GioiTinhNV VARCHAR(10),
    NgaySinhNV DATE,
    ChucVu VARCHAR(20) NOT NULL,
    SoDienThoaiNV CHAR(10) NOT NULL,
    EmailNV VARCHAR(70) NOT NULL,
    TrangThaiNV VARCHAR(30) NOT NULL,
    TaoVaoLuc DATETIME NOT NULL,
    TaoBoi INT NOT NULL,
    ChinhSuaLanCuoiVaoLuc DATETIME NOT NULL,
    ChinhSuaLanCuoiBoi INT NOT NULL
);


/* TẠO TABLE TaiKhoan */
CREATE TABLE TaiKhoan(
    MaTK INT AUTO_INCREMENT PRIMARY KEY,
    EmailTK VARCHAR(70) NOT NULL,
    MatKhauTK VARCHAR(50) NOT NULL,
    MaHashTK BINARY(64),
    MaSaltTK BINARY(16) DEFAULT (unhex(replace(uuid(),'-',''))),
    TrangThaiTK NVARCHAR(50) NOT NULL,
    MaNV INT NOT NULL,
    TaoVaoLuc DATETIME NOT NULL,
    TaoBoi INT NOT NULL,
    ChinhSuaLanCuoiVaoLuc DATETIME NOT NULL,
    ChinhSuaLanCuoiBoi INT NOT NULL
);
