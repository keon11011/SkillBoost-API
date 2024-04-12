<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// Include necessary files
include_once 'C:/xampp/htdocs/SkillBoost-API/core/initialize.php';

// Instantiate LichHoc
$lichHoc = new LichHoc($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Check if required data is set
if (!isset($data->MaKhoaHoc, $data->ThuTrongTuan, $data->ThoiGianBatDauBuoiHoc, $data->ThoiGianKetThucBuoiHoc)) {
    echo json_encode(array('message' => 'Missing required data.'));
    exit;
}

// Set LichHoc properties from the received data
$lichHoc->MaKhoaHoc = $data->MaKhoaHoc;
$lichHoc->ThuTrongTuan = $data->ThuTrongTuan;
$lichHoc->ThoiGianBatDauBuoiHoc = $data->ThoiGianBatDauBuoiHoc;
$lichHoc->ThoiGianKetThucBuoiHoc = $data->ThoiGianKetThucBuoiHoc;
$lichHoc->TaoVaoLuc = date('Y-m-d H:i:s'); 
$lichHoc->TaoBoi = isset($data->TaoBoi) ? $data->TaoBoi : 3; 
$lichHoc->ChinhSuaLanCuoiVaoLuc = date('Y-m-d H:i:s'); 
$lichHoc->ChinhSuaLanCuoiBoi = isset($data->ChinhSuaLanCuoiBoi) ? $data->ChinhSuaLanCuoiBoi : 3; 

// Create LichHoc
if ($lichHoc->create()) {
    echo json_encode(array('message' => 'Tạo lịch học mới thành công.'));
} else {
    echo json_encode(array('message' => 'Tạo lịch học mới thất bại.'));
}

// Free the database connection
$db = null;
?>
