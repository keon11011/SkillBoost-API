<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Initialize our API
include_once('C:/xampp/htdocs/SkillBoost-API/core/initialize.php');

// Instantiate Lead
$lead = new Lead($db);

// Lead query
$result = $lead->read();

// Get the row count
$num = $result->rowCount();

if ($num > 0) {
    // Fetch all rows as associative arrays
    $leads_arr = $result->fetchAll(PDO::FETCH_ASSOC);

    // Convert to JSON format and output
    echo json_encode($leads_arr);
} else {
    // No Lead found
    // Output an error message
    echo json_encode(array('message' => 'Không tìm thấy Lead nào.'));
}

// Free the database connection
$db = null;
?>
