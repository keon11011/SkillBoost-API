<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Include necessary files
include_once 'C:/xampp/htdocs/SkillBoost-API/core/initialize.php';

// Instantiate YeuCauTuVan
$yeuCauTuVan = new YeuCauTuVan($db);

// Call read_new function to get the latest record
$result = $yeuCauTuVan->read_new();

// Check if any record was found
if ($result) {
    // Output the result as JSON
    echo json_encode($result);
} else {
    // No record found
    echo json_encode(array('message' => 'No record found.'));
}

// Free the database connection
$db = null;
?>
