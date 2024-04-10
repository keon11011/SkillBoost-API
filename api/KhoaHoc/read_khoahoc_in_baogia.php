<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Initialize our API
include_once('C:/xampp/htdocs/SkillBoost-API/core/initialize.php');

// Instantiate the KhoaHoc object
$khoaHoc = new KhoaHoc($db);

// Get MaLead from the request
$MaLead = isset($_GET['MaLead']) ? $_GET['MaLead'] : die();

// Set MaLead property of KhoaHoc object
$khoaHoc->MaLead = $MaLead;

// Call the read_khoahoc_in_baogia method
$result = $khoaHoc->read_khoahoc_in_baogia();

// Get row count
$num = $result->rowCount();

// Check if any record exists
if ($num > 0) {
    // Fetch all rows as an associative array
    $khoaHoc_arr = $result->fetchAll(PDO::FETCH_ASSOC);

    // Format into JSON and output
    echo json_encode($khoaHoc_arr);
} else {
    // No KhoaHoc
    echo json_encode(
        array('message' => 'No KhoaHoc found for the given criteria.')
    );
}
