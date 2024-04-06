<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Initialize our API
include_once('C:/xampp/htdocs/SkillBoost-API/core/initialize.php');

// Instantiate KhachHang
$khachHang = new KhachHang($db);

// KhachHang query
$result = $khachHang->read();

// Get the row count
$num = $result->rowCount();

if ($num > 0) {
    // Fetch all rows as associative arrays
    $khachHangs_arr = $result->fetchAll(PDO::FETCH_ASSOC);

    // Convert to JSON format and output
    echo json_encode($khachHangs_arr);
} else {
    // No KhachHang found
    // Output an error message
    echo json_encode(array('message' => 'Không tìm thấy khách hàng nào.'));
}

// Free the database connection
$db = null;
?>
