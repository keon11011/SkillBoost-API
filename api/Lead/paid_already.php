<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PATCH');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// Include necessary files
include_once 'C:/xampp/htdocs/SkillBoost-API/core/initialize.php';

// Instantiate Lead
$lead = new Lead($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Check if required data is set
if (!isset($data->MaLead)) {
    echo json_encode(array('message' => 'Missing MaLead.'));
    exit;
}

// Set Lead properties from the received data
$lead->MaLead = $data->MaLead;
$lead->TrangThaiLead = 'Đã thanh toán';
$lead->LyDoTrangThaiLead = isset($data->LyDoTrangThaiLead) ? $data->LyDoTrangThaiLead : null;
$lead->ChinhSuaLanCuoiVaoLuc = date('Y-m-d H:i:s');
$lead->ChinhSuaLanCuoiBoi = 3; // Đang fix cứng

// Update Lead
if ($lead->update_trangthai()) {
    echo json_encode(array('message' => 'Cập nhật trạng thái thanh toán thành công Lead.'));
} else {
    echo json_encode(array('message' => 'Cập nhật trạng thái thanh toán thất bại Lead.'));
}

// Free the database connection
$db = null;
?>