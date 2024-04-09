<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Initialize our API
include_once 'C:/xampp/htdocs/SkillBoost-API/core/initialize.php'; // Adjust path as per your file structure

// Instantiate QuyDinhGiamGia
$quyDinhGiamGia = new QuyDinhGiamGia($db);

// Set the QuyDinhGiamGia ID
$quyDinhGiamGia->MaQuyDinhGiamGia = isset($_GET['MaQuyDinhGiamGia']) ? $_GET['MaQuyDinhGiamGia'] : die(); // Set the MaQuyDinhGiamGia you want to retrieve

// Read a single QuyDinhGiamGia
$quyDinhGiamGiaData = $quyDinhGiamGia->read_single();

// Construct the QuyDinhGiamGia array
$quyDinhGiamGiaArray = array(
    'MaQuyDinhGiamGia' => $quyDinhGiamGiaData['MaQuyDinhGiamGia'],
    'MoTaLoaiGiamGia' => $quyDinhGiamGiaData['MoTaLoaiGiamGia'],
    'SoLuongKhoaHocDangKy' => $quyDinhGiamGiaData['SoLuongKhoaHocDangKy'],
    'MaNgheNghiep' => $quyDinhGiamGiaData['MaNgheNghiep'],
    'NgayBatDau' => $quyDinhGiamGiaData['NgayBatDau'],
    'NgayKetThuc' => $quyDinhGiamGiaData['NgayKetThuc'],
    'PhanTramGiamGiaMacDinh' => $quyDinhGiamGiaData['PhanTramGiamGiaMacDinh'],
    'PhanTramGiamGiaToiDa' => $quyDinhGiamGiaData['PhanTramGiamGiaToiDa'],
    'TaoVaoLuc' => $quyDinhGiamGiaData['TaoVaoLuc'],
    'TaoBoi' => $quyDinhGiamGiaData['TaoBoi'],
    'ChinhSuaLanCuoiVaoLuc' => $quyDinhGiamGiaData['ChinhSuaLanCuoiVaoLuc'],
    'ChinhSuaLanCuoiBoi' => $quyDinhGiamGiaData['ChinhSuaLanCuoiBoi'],
    'TrangThaiQuyDinhGiamGia' => $quyDinhGiamGiaData['TrangThaiQuyDinhGiamGia']
);

// Output the QuyDinhGiamGia array as JSON and exit
echo json_encode($quyDinhGiamGiaArray);

// Free the database connection
$db = null;
?>
