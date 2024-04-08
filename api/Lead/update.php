<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
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
$lead->HoTenLead = $data->HoTenLead;
$lead->GioiTinhLead = $data->GioiTinhLead;
$lead->NgaySinhLead = $data->NgaySinhLead;
$lead->SoDienThoaiLead = $data->SoDienThoaiLead;
$lead->EmailLead = $data->EmailLead;
$lead->MaNgheNghiep = $data->MaNgheNghiep;
$lead->MaNVPhuTrachLead = 'STA1';
$lead->TrangThaiLead = $data->TrangThaiLead;
$lead->LyDoTrangThaiLead = isset($data->LyDoTrangThaiLead) ? $data->LyDoTrangThaiLead : null;
$lead->NguonLead = $data->NguonLead;
$lead->GhiChuLead = isset($data->GhiChuLead) ? $data->GhiChuLead : null;
$lead->LeadTuKHCu = isset($data->LeadTuKHCu) ? $data->LeadTuKHCu : null;
$lead->ChinhSuaLanCuoiVaoLuc = date('Y-m-d H:i:s');
$lead->ChinhSuaLanCuoiBoi = 'Nguyễn Phương Thanh'; // Assuming it's fixed

// Update Lead
if ($lead->update()) {
    echo json_encode(array('message' => 'Lead updated.'));
} else {
    echo json_encode(array('message' => 'Lead not updated.'));
}

// Free the database connection
$db = null;
?>
