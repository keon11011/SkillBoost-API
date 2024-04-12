<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PATCH');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// Include necessary files
include_once 'C:/xampp/htdocs/SkillBoost-API/core/initialize.php';

// Instantiate KhachHang
$khachHang = new KhachHang($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Check if required data is set
if (!isset($data->MaKH)) {
    echo json_encode(array('message' => 'Missing MaKH'));
    exit;
}

// Set KhachHang properties from the received data
$khachHang->MaKH = $data->MaKH;
$khachHang->TrangThaiKH = 'Xóa mềm';
$khachHang->LyDoTrangThaiKH = isset($data->LyDoTrangThaiKH) ? $data->LyDoTrangThaiKH : null;
$khachHang->ChinhSuaLanCuoiVaoLuc = date('Y-m-d H:i:s');
$khachHang->ChinhSuaLanCuoiBoi = isset($data->ChinhSuaLanCuoiBoi) ? $data->ChinhSuaLanCuoiBoi : 3; 

// Update KhachHang (Soft delete)
if ($khachHang->delete()) {
    echo json_encode(array('message' => 'Xóa thành công KhachHang.'));
} else {
    echo json_encode(array('message' => 'Xóa thất bại KhachHang.'));
}

// Free the database connection
$db = null;
?>
