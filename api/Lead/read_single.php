<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Initialize our API
include_once 'C:/xampp/htdocs/SkillBoost-API/core/initialize.php';

// Instantiate KhachHang
$lead = new Lead($db);

// Set the KhachHang ID
$lead->MaLead = isset($_GET['MaLead']) ? $_GET['MaLead'] : die(); // Set the MaLead you want to retrieve

// Read a single KhachHang
$leadData = $lead->read_single();

// Construct the KhachHang array
$leadArray = array(
    'MaLead' => $leadData['MaLead'],
    'HoTenLead' => $leadData['HoTenLead'],
    'GioiTinhLead' => $leadData['GioiTinhLead'],
    'NgaySinhLead' => $leadData['NgaySinhLead'],
    'SoDienThoaiLead' => $leadData['SoDienThoaiLead'],
    'EmailLead' => $leadData['EmailLead'],
    'MaNgheNghiep' => $leadData['MaNgheNghiep'],
    'MaNVPhuTrachLead' => $leadData['MaNVPhuTrachLead'],
    'TrangThaiLead' => $leadData['TrangThaiLead'],
    'LyDoTrangThaiLead' => $leadData['LyDoTrangThaiLead'],
    'NguonLead' => $leadData['NguonLead'],
    'GhiChuLead' => $leadData['GhiChuLead'],
    'LeadTuKHCu' => $leadData['LeadTuKHCu'],
    'TaoVaoLuc' => $leadData['TaoVaoLuc'],
    'TaoBoi' => $leadData['TaoBoi'],
    'ChinhSuaLanCuoiVaoLuc' => $leadData['ChinhSuaLanCuoiVaoLuc'],
    'ChinhSuaLanCuoiBoi' => $leadData['ChinhSuaLanCuoiBoi']
);

// Output the Lead array as JSON and exit
echo json_encode($leadArray);

// Free the database connection
$db = null;
?>
