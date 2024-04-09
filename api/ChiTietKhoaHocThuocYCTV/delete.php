<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// Initialize our API
include_once('C:/xampp/htdocs/SkillBoost-API/core/initialize.php');

// Instantiate the ChiTietKhoaHocThuocYCTV object
$chiTietKhoaHocThuocYCTV = new ChiTietKhoaHocThuocYCTV($db);

// Get ID from the request (either from JSON body or URL parameter)
$chiTietKhoaHocThuocYCTV->MaTuVan = isset($_GET['MaTuVan']) ? $_GET['MaTuVan'] : die();

// Attempt to delete the record
if ($chiTietKhoaHocThuocYCTV->delete()) {
    echo json_encode(array('message' => 'Xóa thành công chi tiết khóa học thuộc YCTV.'));
} else {
    echo json_encode(array('message' => 'Xóa thất bại chi tiết khóa học thuộc YCTV'));
}

// Free the database connection
$db = null;
?>