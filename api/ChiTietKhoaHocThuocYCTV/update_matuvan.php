<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PATCH');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// Include necessary files
include_once 'C:/xampp/htdocs/SkillBoost-API/core/initialize.php';

// Instantiate ChiTietKhoaHocThuocYCTV
$chiTietKhoaHocThuocYCTV = new ChiTietKhoaHocThuocYCTV($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Check if required data is set
if (!isset($data->MaTuVan)) {
    echo json_encode(array('message' => 'Missing MaTuVan.'));
    exit;
}

// Set chiTietKhoaHocThuocYCTV properties from the received data
$chiTietKhoaHocThuocYCTV->MaTuVan = $data->MaTuVan;

// Update MaTuVan
if ($chiTietKhoaHocThuocYCTV->update_matuvan()) {
    echo json_encode(array('message' => 'Cập nhật mã tư vấn thành công.'));
} else {
    echo json_encode(array('message' => 'Cập nhật mã tư vấn thất bại.'));
}

// Free the database connection
$db = null;
?>