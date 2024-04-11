<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PATCH');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// Include necessary files
include_once 'C:/xampp/htdocs/SkillBoost-API/core/initialize.php';

// Instantiate BaoGia
$baoGia = new BaoGia($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Check if required data is set
if (!isset($data->MaBaoGia)) {
    echo json_encode(array('message' => 'Missing MaBaoGia.'));
    exit;
}

// Set BaoGia properties from the received data
$baoGia->MaBaoGia = $data->MaBaoGia;
$baoGia->TenBaoGia = $data->TenBaoGia;
$baoGia->MaLead = $data->MaLead;
$baoGia->HoTenLead = $data->HoTenLead;
$baoGia->TongTienTruocGiam = $data->TongTienTruocGiam;
$baoGia->MaGiamGia = isset($data->MaGiamGia) ? $data->MaGiamGia : null;
$baoGia->PhanTramGiamGia = isset($data->PhanTramGiamGia) ? $data->PhanTramGiamGia : null;
$baoGia->TongTien = $data->TongTien;
$baoGia->TrangThaiBaoGia = isset($data->TrangThaiBaoGia) ? $data->TrangThaiBaoGia : 'Chưa thanh toán';
$baoGia->ChinhSuaLanCuoiVaoLuc = date('Y-m-d H:i:s');
$baoGia->ChinhSuaLanCuoiBoi = isset($data->ChinhSuaLanCuoiBoi) ? $data->ChinhSuaLanCuoiBoi : 3; // sửa

// Update BaoGia
if ($baoGia->update()) {
    echo json_encode(array('message' => 'Cập nhật Báo Giá thành công.'));
} else {
    echo json_encode(array('message' => 'Cập nhật Báo Giá thất bại.'));
}

// Free the database connection
$db = null;
?>
