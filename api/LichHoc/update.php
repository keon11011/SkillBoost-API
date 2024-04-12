<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PATCH');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// Include necessary files
include_once 'C:/xampp/htdocs/SkillBoost-API/core/initialize.php';

// Instantiate LichHoc
$lichhoc = new LichHoc($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Check if required data is set
if (!isset($data->ID, $data->MaKhoaHoc, $data->ThuTrongTuan, $data->ThoiGianBatDauBuoiHoc, $data->ThoiGianKetThucBuoiHoc)) {
    echo json_encode(array('message' => 'Missing required data.'));
    exit;
}

// Set LichHoc properties from the received data
$lichhoc->ID = $data->ID;
$lichhoc->MaKhoaHoc = $data->MaKhoaHoc;
$lichhoc->ThuTrongTuan = $data->ThuTrongTuan;
$lichhoc->ThoiGianBatDauBuoiHoc = date('H:i', strtotime($data->ThoiGianBatDauBuoiHoc));
$lichhoc->ThoiGianKetThucBuoiHoc = date('H:i', strtotime($data->ThoiGianKetThucBuoiHoc));
$lichhoc->ChinhSuaLanCuoiVaoLuc = date('Y-m-d H:i:s');
$lichhoc->ChinhSuaLanCuoiBoi = isset($data->ChinhSuaLanCuoiBoi) ? $data->ChinhSuaLanCuoiBoi : 3; // Adjust this according to your application logic

// Update LichHoc record
if ($lichhoc->update()) {
    echo json_encode(array('message' => 'Cập nhật Lịch Học thành công.'));
} else {
    echo json_encode(array('message' => 'Cập nhật Lịch Học thất bại.'));
}

// Free the database connection
$db = null;
?>
