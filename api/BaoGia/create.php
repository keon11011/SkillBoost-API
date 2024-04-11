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

// Instantiate BaoGia
$baoGia = new BaoGia($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Check if required data is set
if (!isset($data->TenBaoGia, $data->MaLead, $data->HoTenLead, $data->TongTienTruocGiam, $data->TongTien)) {
    echo json_encode(array('message' => 'Missing required data.'));
    exit;
}

// Set post properties from the received data
$baoGia->TenBaoGia = $data->TenBaoGia;
$baoGia->MaLead = $data->MaLead;
$baoGia->HoTenLead = $data->HoTenLead;
$baoGia->TongTienTruocGiam = $data->TongTienTruocGiam;
$baoGia->MaGiamGia = isset($data->MaGiamGia) ? $data->MaGiamGia : null;
$baoGia->PhanTramGiamGia = isset($data->PhanTramGiamGia) ? $data->PhanTramGiamGia : null;
$baoGia->TongTien = $data->TongTien;
$baoGia->TrangThaiBaoGia = 'Chưa thanh toán'; // Fix cứng
$baoGia->TaoVaoLuc = date('Y-m-d H:i:s');
$baoGia->TaoBoi = isset($data->TaoBoi) ? $data->TaoBoi : 3; // sửa
$baoGia->ChinhSuaLanCuoiVaoLuc = date('Y-m-d H:i:s'); 
$baoGia->ChinhSuaLanCuoiBoi = isset($data->ChinhSuaLanCuoiBoi) ? $data->ChinhSuaLanCuoiBoi : 3; // sửa

// Create BaoGia
if ($baoGia->create()) {
    echo json_encode(array('message' => 'Tạo thành công báo giá mới.'));
} else {
    echo json_encode(array('message' => 'Tạo thất bại báo giá mới.'));
}

// Free the database connection
$db = null;
?>
