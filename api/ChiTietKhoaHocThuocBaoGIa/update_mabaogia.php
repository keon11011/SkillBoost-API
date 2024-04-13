<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PATCH');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// Include necessary files
include_once 'C:/xampp/htdocs/SkillBoost-API/core/initialize.php';

// Instantiate ChiTietKhoaHocThuocBaoGia
$chiTietKhoaHocThuocBaoGia = new ChiTietKhoaHocThuocBaoGia($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Check if required data is set
if (!isset($data->MaBaoGia)) {
    echo json_encode(array('message' => 'Missing MaBaoGia.'));
    exit;
}

// Set chiTietKhoaHocThuocBaoGia properties from the received data
$chiTietKhoaHocThuocBaoGia->MaBaoGia = $data->MaBaoGia;

// Update MaBaoGia
if ($chiTietKhoaHocThuocBaoGia->update_mabaogia()) {
    echo json_encode(array('message' => 'Cập nhật mã báo giá thành công.'));
} else {
    echo json_encode(array('message' => 'Cập nhật mã báo giá thất bại.'));
}

// Free the database connection
$db = null;
?>