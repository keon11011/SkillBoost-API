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

// Instantiate Lead
$lead = new Lead($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Check if required data is set
if (!isset($data->HoTenLead, $data->GioiTinhLead, $data->NgaySinhLead, $data->SoDienThoaiLead, $data->EmailLead)) {
    echo json_encode(array('message' => 'Missing required data.'));
    exit;
}

// Set post properties from the received data
$lead->HoTenLead = $data->HoTenLead;
$lead->GioiTinhLead = $data->GioiTinhLead;
$lead->NgaySinhLead = $data->NgaySinhLead;
$lead->SoDienThoaiLead = $data->SoDienThoaiLead;
$lead->EmailLead = $data->EmailLead;
$lead->MaNgheNghiep = 5;
$lead->MaNVPhuTrachLead = 3; // Đang fix cứng
$lead->TrangThaiLead = 'Đang tư vấn'; // Đang fix cứng
$lead->LyDoTrangThaiLead = isset($data->LyDoTrangThaiLead) ? $data->LyDoTrangThaiLead : null;
$lead->NguonLead = isset($data->NguonLead) ? $data->NguonLead : "Website";
$lead->GhiChuLead = isset($data->GhiChuLead) ? $data->GhiChuLead : null;
$lead->LeadTuKHCu = isset($data->LeadTuKHCu) ? $data->LeadTuKHCu : null;
$lead->TaoVaoLuc = date('Y-m-d H:i:s');
//$lead->TaoBoi = 1;
$lead->TaoBoi = isset($data->TaoBoi) ? $data->TaoBoi : 1; // sửa
$lead->ChinhSuaLanCuoiVaoLuc = date('Y-m-d H:i:s');
//$lead->ChinhSuaLanCuoiBoi = 3; // Đang fix cứng
$lead->ChinhSuaLanCuoiBoi = isset($data->ChinhSuaLanCuoiBoi) ? $data->ChinhSuaLanCuoiBoi : 3; // sửa

// Create Lead
if ($lead->create()) {
    echo json_encode(array('message' => 'Tạo thành công Lead mới.'));
} else {
    echo json_encode(array('message' => 'Tạo thất bại Lead mới.'));
}

// Free the database connection
$db = null;
?>
