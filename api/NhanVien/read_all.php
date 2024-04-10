<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Initialize our API
include_once('C:/xampp/htdocs/SkillBoost-API/core/initialize.php');

// Instantiate NhanVien
$nhanVien = new NhanVien($db);

// NhanVien query
$result = $nhanVien->read();

// Get the row count
$num = $result->rowCount();

if ($num > 0) {
    // Fetch all rows as associative arrays
    $nhanViens_arr = $result->fetchAll(PDO::FETCH_ASSOC);

    // Convert to JSON format and output
    echo json_encode($nhanViens_arr);
} else {
    // No NhanVien found
    // Output an error message
    echo json_encode(array('message' => 'Không tìm thấy nhân viên nào.'));
}

// Free the database connection
$db = null;
?>
