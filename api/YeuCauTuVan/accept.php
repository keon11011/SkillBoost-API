<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PATCH');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// Include necessary files
include_once 'C:/xampp/htdocs/SkillBoost-API/core/initialize.php';

// Instantiate YeuCauTuVan
$yeuCauTuVan = new YeuCauTuVan($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Check if required data is set
if (!isset($data->MaTuVan)) {
    echo json_encode(array('message' => 'Missing MaTuVan.'));
    exit;
}

// Set properties from the received data
$yeuCauTuVan->MaTuVan = $data->MaTuVan;
$yeuCauTuVan->TrangThaiYCTV = 'Đã tiếp nhận';

// Accept consultation request
if ($yeuCauTuVan->accept()) {
    echo json_encode(array('message' => 'Đã tiếp nhận thành công YeuCauTuVan.'));
} else {
    echo json_encode(array('message' => 'Đã tiếp nhận thất bại YeuCauTuVan.'));
}

// Free the database connection
$db = null;
?>
