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

// Instantiate MaGiamGia
$maGiamGia = new MaGiamGia($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Check if required data is set
if (!isset($data->PhanTramGiamGia, $data->MaQuyDinhGiamGia)) {
    echo json_encode(array('message' => 'Missing required data.'));
    exit;
}

// Set post properties from the received data
$maGiamGia->MoTaMaGiamGia = 'MAGIAMGIACANHANCUALEAD';
$maGiamGia->PhamViApDung = 'Cho cá nhân';
$maGiamGia->PhanTramGiamGia = $data->PhanTramGiamGia;
$maGiamGia->TrangThaiMaGiamGia = 'Khả dụng';
$maGiamGia->MaQuyDinhGiamGia = $data->MaQuyDinhGiamGia;
$maGiamGia->TaoVaoLuc = date('Y-m-d H:i:s');
//$maGiamGia->TaoBoi = 1; // Fix cứng
$maGiamGia->TaoBoi = isset($data->TaoBoi) ? $data->TaoBoi : 1; // sửa
$maGiamGia->ChinhSuaLanCuoiVaoLuc = date('Y-m-d H:i:s');
//$maGiamGia->ChinhSuaLanCuoiBoi = 1; // Fix cứng
$maGiamGia->ChinhSuaLanCuoiBoi = isset($data->ChinhSuaLanCuoiBoi) ? $data->ChinhSuaLanCuoiBoi : 3; // sửa

// Create MaGiamGia
if ($maGiamGia->create()) {
    echo json_encode(array('message' => 'Tạo thành công mã giảm giá mới.'));
} else {
    echo json_encode(array('message' => 'Tạo thất bại mã giảm giá mới.'));
}

// Free the database connection
$db = null;
?>
