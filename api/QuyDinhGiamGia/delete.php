<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PATCH');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// Include necessary files
include_once 'C:/xampp/htdocs/SkillBoost-API/core/initialize.php';

// Instantiate QuyDinhGiamGia
$quyDinhGiamGia = new QuyDinhGiamGia($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Check if required data is set
if (!isset($data->MaQuyDinhGiamGia)) {
    echo json_encode(array('message' => 'Missing MaQuyDinhGiamGia.'));
    exit;
}

// Set QuyDinhGiamGia properties from the received data
$quyDinhGiamGia->MaQuyDinhGiamGia = $data->MaQuyDinhGiamGia;
$quyDinhGiamGia->TrangThaiQuyDinhGiamGia = 'Xóa mềm';
$quyDinhGiamGia->ChinhSuaLanCuoiVaoLuc = date('Y-m-d H:i:s');
$quyDinhGiamGia->ChinhSuaLanCuoiBoi = 3; // Fix cứng

// Delete QuyDinhGiamGia
if ($quyDinhGiamGia->delete()) {
    echo json_encode(array('message' => 'Xóa thành công Quy định giảm giá.'));
} else {
    echo json_encode(array('message' => 'Xóa thất bại Quy định giảm giá.'));
}

// Free the database connection
$db = null;
?>
