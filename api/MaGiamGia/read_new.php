<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Include necessary files
include_once 'C:/xampp/htdocs/SkillBoost-API/core/initialize.php';

// Instantiate MaGiamGia
$maGiamGia = new MaGiamGia($db);

// Call read_new function to get the latest MaGiamGia
$result = $maGiamGia->read_new();

// Check if any record was found
if ($result) {
    // Extract MaGiamGia from the result
    $maGiamGiaValue = $result['MaGiamGia'];

    // Output the MaGiamGia as JSON
    echo json_encode(array('MaGiamGia' => $maGiamGiaValue));
} else {
    // No record found
    echo json_encode(array('message' => 'Không tìm thấy MaGiamGia mới nhất.'));
}

// Free the database connection
$db = null;
?>
