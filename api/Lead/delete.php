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
$lead->TrangThaiLead = 'Xóa mềm';
$lead->LyDoTrangThaiLead = isset($data->LyDoTrangThaiLead) ? $data->LyDoTrangThaiLead : null;
$lead->ChinhSuaLanCuoiVaoLuc = date('Y-m-d H:i:s');
$lead->ChinhSuaLanCuoiBoi = isset($data->ChinhSuaLanCuoiBoi) ? $data->ChinhSuaLanCuoiBoi : 3; // sửa

// Update Lead
if ($lead->delete()) {
    echo json_encode(array('message' => 'Xóa thành công Lead.'));
} else {
    echo json_encode(array('message' => 'Xóa thất bại Lead.'));
}

// Free the database connection
$db = null;
?>