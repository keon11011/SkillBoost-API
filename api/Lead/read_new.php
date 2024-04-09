<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Include necessary files
include_once 'C:/xampp/htdocs/SkillBoost-API/core/initialize.php';

// Instantiate Lead
$lead = new Lead($db);

// Call read_new function to get the latest MaLead
$result = $lead->read_new();

// Check if any record was found
if ($result) {
    // Extract MaLead from the result
    $maLead = $result['MaLead'];

    // Output the MaLead as JSON
    echo json_encode(array('MaLead' => $maLead));
} else {
    // No record found
    echo json_encode(array('message' => 'Không tìm thấy Lead mới nhất.'));
}

// Free the database connection
$db = null;
?>
