<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Include necessary files
include_once 'C:/xampp/htdocs/SkillBoost-API/core/initialize.php';

// Instantiate BaoGia
$baoGia = new BaoGia($db);

// Call the read_new function to get the latest MaBaoGia
$result = $baoGia->read_new();

// Check if any record was found
if ($result) {
    // Extract MaBaoGia from the result
    $maBaoGia = $result['MaBaoGia'];

    // Output the MaBaoGia as JSON
    echo json_encode(array('MaBaoGia' => $maBaoGia));
} else {
    // No record found
    echo json_encode(array('message' => 'Không tìm thấy báo giá mới nhất.'));
}

// Free the database connection
$db = null;
?>
