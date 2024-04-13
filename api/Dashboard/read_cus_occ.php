<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Import necessary dependencies
include_once 'C:/xampp/htdocs/SkillBoost-API/core/initialize.php';

// Instantiate the Dashboard class
$dashboard = new Dashboard($db);

// Call the read_cus_occ() function from the Dashboard class
$results = $dashboard->read_cus_occ();

// Output the results as JSON
echo json_encode($results);

// Free the database connection
$db = null;
?>
