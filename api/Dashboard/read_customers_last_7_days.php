<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Include the necessary files (e.g., database connection and class files)
include_once 'C:/xampp/htdocs/SkillBoost-API/core/initialize.php';

// Create a new instance of the Dashboard class
$dashboard = new Dashboard($db);

// Call the read_customers_last_7_days function to get the data
$results = $dashboard->read_customers_last_7_days();

// Output the results as JSON
if ($results !== null) {
    echo json_encode($results);
}

// Free the database connection
$db = null;
?>
