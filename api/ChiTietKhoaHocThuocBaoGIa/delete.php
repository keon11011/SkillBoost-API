<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// Initialize our API
include_once('C:/xampp/htdocs/SkillBoost-API/core/initialize.php');

// Instantiate the ChiTietKhoaHocThuocBaoGia object
$chiTietKhoaHocThuocBaoGia = new ChiTietKhoaHocThuocBaoGia($db);

// Get ID from the request (either from JSON body or URL parameter)
$chiTietKhoaHocThuocBaoGia->MaBaoGia = isset($_GET['MaBaoGia']) ? $_GET['MaBaoGia'] : die();

// Attempt to delete the record
if ($chiTietKhoaHocThuocBaoGia->delete()) {
    echo json_encode(array('message' => 'Xóa thành công chi tiết khóa học thuộc báo giá.'));
} else {
    echo json_encode(array('message' => 'Xóa thất bại chi tiết khóa học thuộc báo giá'));
}

// Free the database connection
$db = null;
?>