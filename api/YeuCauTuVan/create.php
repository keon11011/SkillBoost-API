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

// Instantiate YeuCauTuVan
$yeuCauTuVan = new YeuCauTuVan($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Check if required data is set
if (!isset($data->MaTuVan, $data->TenLeadYeuCau, $data->NgaySinhLeadYeuCau, $data->EmailLeadYeuCau, $data->SDTLeadYeuCau, $data->TrangThaiYCTV)) {
    echo json_encode(array('message' => 'Missing required data.'));
    exit;
}

// Set post properties from the received data
$yeuCauTuVan->MaTuVan = $data->MaTuVan;
$yeuCauTuVan->TenLeadYeuCau = $data->TenLeadYeuCau;
$yeuCauTuVan->NgaySinhLeadYeuCau = $data->NgaySinhLeadYeuCau;
$yeuCauTuVan->EmailLeadYeuCau = $data->EmailLeadYeuCau;
$yeuCauTuVan->SDTLeadYeuCau = $data->SDTLeadYeuCau;
$yeuCauTuVan->TrangThaiYCTV = $data->TrangThaiYCTV;

// Optional properties
$yeuCauTuVan->GhiChuYCTV = isset($data->GhiChuYCTV) ? $data->GhiChuYCTV : null;
$yeuCauTuVan->TaoVaoLuc = date('Y-m-d H:i:s'); // Assuming it's the current date/time

// Create YeuCauTuVan
if ($yeuCauTuVan->create()) {
    echo json_encode(array('message' => 'Successfully created a new record.'));
} else {
    echo json_encode(array('message' => 'Failed to create a new record.'));
}

// Free the database connection
$db = null;
?>
