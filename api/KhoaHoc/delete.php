<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PATCH');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// Include necessary files
include_once 'C:/xampp/htdocs/SkillBoost-API/core/initialize.php';

// Instantiate KhoaHoc
$khoahoc = new KhoaHoc($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Check if required data is set
if (!isset($data->MaKhoaHoc)) {
    echo json_encode(array('message' => 'Missing MaKhoaHoc.'));
    exit;
}

// Set KhoaHoc properties from the received data
$khoahoc->MaKhoaHoc = $data->MaKhoaHoc;
$khoahoc->TrangThaiKhoaHoc = 'Xóa mềm';
$khoahoc->ChinhSuaLanCuoiVaoLuc = date('Y-m-d H:i:s');
$khoahoc->ChinhSuaLanCuoiBoi = isset($data->ChinhSuaLanCuoiBoi) ? $data->ChinhSuaLanCuoiBoi : 3; // sửa

// Delete KhoaHoc (soft delete)
if ($khoahoc->delete()) {
    echo json_encode(array('message' => 'Xóa thành công KhoaHoc.'));
} else {
    echo json_encode(array('message' => 'Xóa thất bại KhoaHoc.'));
}

// Free the database connection
$db = null;
?>
