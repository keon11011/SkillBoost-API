<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Initialize our API
include_once('C:/xampp/htdocs/SkillBoost-API/core/initialize.php');

// Instantiate NgheNghiep
$ngheNghiep = new NgheNghiep($db);

// NgheNghiep query
$result = $ngheNghiep->read();

// Get the row count
$num = $result->rowCount();

if ($num > 0) {
    // Fetch all rows as associative arrays
    $ngheNghiep_arr = $result->fetchAll(PDO::FETCH_ASSOC);

    // Convert to JSON format and output
    echo json_encode($ngheNghiep_arr);
} else {
    // No NgheNghiep found
    // Output an error message
    echo json_encode(array('message' => 'Không tìm thấy nghề nghiệp nào.'));
}

// Free the database connection
$db = null;
?>