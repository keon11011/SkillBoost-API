<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Initialize our API
include_once 'C:/xampp/htdocs/SkillBoost-API/core/initialize.php'; // Adjust path as per your file structure

// Instantiate QuyDinhGiamGia
$quyDinhGiamGia = new QuyDinhGiamGia($db); // Assuming $db is the database connection

// QuyDinhGiamGia query
$result = $quyDinhGiamGia->read();

// Get the row count
$num = $result->rowCount();

if ($num > 0) {
    // Fetch all rows as associative arrays
    $quyDinhGiamGia_arr = $result->fetchAll(PDO::FETCH_ASSOC);

    // Convert to JSON format and output
    echo json_encode($quyDinhGiamGia_arr);
} else {
    // No QuyDinhGiamGia found
    // Output an error message
    echo json_encode(array('message' => 'Không tìm thấy quy định giảm giá nào.'));
}

// Free the database connection
$db = null;
?>
