<?php
// Headers
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// Include necessary files
include_once 'C:/xampp/htdocs/SkillBoost-API/core/initialize.php';

// Instantiate ChiTietKhoaHocThuocBaoGia
$chiTietKhoaHoc = new ChiTietKhoaHocThuocBaoGia($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Check if required data is set
if (!isset($data->MaBaoGia, $data->MaKhoaHoc, $data->TenKhoaHoc, $data->GiangVien, $data->GiaTien)) {
    echo json_encode(array('message' => 'Missing required data.'));
    exit;
}

// Set post properties from the received data
$chiTietKhoaHoc->MaBaoGia = $data->MaBaoGia;
$chiTietKhoaHoc->MaKhoaHoc = $data->MaKhoaHoc;
$chiTietKhoaHoc->TenKhoaHoc = $data->TenKhoaHoc;
$chiTietKhoaHoc->GiangVien = $data->GiangVien;
$chiTietKhoaHoc->GiaTien = $data->GiaTien;

// Create ChiTietKhoaHocThuocBaoGia
if ($chiTietKhoaHoc->create()) {
    echo json_encode(array('message' => 'Thêm thành công chi tiết Khóa học thuộc báo giá.'));
} else {
    echo json_encode(array('message' => 'Thêm thất bại chi tiết Khóa học thuộc báo giá.'));
}

// Free the database connection
$db = null;
?>
