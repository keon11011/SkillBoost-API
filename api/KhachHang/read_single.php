<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Initialize our API
include_once 'C:/xampp/htdocs/SkillBoost-API/core/initialize.php';

// Instantiate KhachHang
$khachhang = new KhachHang($db);

// Set the KhachHang ID
$khachhang->MaKH = isset($_GET['MaKH']) ? $_GET['MaKH'] : die(); // Set the MaKH you want to retrieve

// Read a single KhachHang
$khachhangData = $khachhang->read_single();

// Construct the KhachHang array
$khachhangArray = array(
    'MaKH' => $khachhangData['MaKH'],
    'HoTenKH' => $khachhangData['HoTenKH'],
    'GioiTinhKH' => $khachhangData['GioiTinhKH'],
    'NgaySinhKH' => $khachhangData['NgaySinhKH'],
    'SoDienThoaiKH' => $khachhangData['SoDienThoaiKH'],
    'EmailKH' => $khachhangData['EmailKH'],
    'MaNgheNghiep' => $khachhangData['MaNgheNghiep'],
    'TenNgheNghiep' => $khachhangData['TenNgheNghiep'],
    'MaNVPhuTrachKH' => $khachhangData['MaNVPhuTrachKH'],
    'TenNVPhuTrachKH' => $khachhangData['TenNVPhuTrachKH'],
    'TrangThaiKH' => $khachhangData['TrangThaiKH'],
    'LyDoTrangThaiKH' => $khachhangData['LyDoTrangThaiKH'],
    'GhiChuKH' => $khachhangData['GhiChuKH'],
    'ChuyenDoiTuMaLead' => $khachhangData['ChuyenDoiTuMaLead'],
    'TaoVaoLuc' => $khachhangData['TaoVaoLuc'],
    'TaoBoi' => $khachhangData['TaoBoi'],
    'ChinhSuaLanCuoiVaoLuc' => $khachhangData['ChinhSuaLanCuoiVaoLuc'],
    'ChinhSuaLanCuoiBoi' => $khachhangData['ChinhSuaLanCuoiBoi']
);

// Output the KhachHang array as JSON and exit
echo json_encode($khachhangArray);

// Free the database connection
$db = null;
?>
