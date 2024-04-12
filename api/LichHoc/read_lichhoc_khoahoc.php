<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Initialize our API
include_once('C:/xampp/htdocs/SkillBoost-API/core/initialize.php');

// Instantiate LichHoc
$lichHoc = new LichHoc($db);

// Get MaKhoaHoc from GET request
$lichHoc->MaKhoaHoc = isset($_GET['MaKhoaHoc']) ? $_GET['MaKhoaHoc'] : die();

// LichHoc query
$result = $lichHoc->read_lichhoc_khoahoc();

// Get the row count
$num = $result->rowCount();

if ($num > 0) {
    // Fetch all rows as associative arrays
    $lichHocs_arr = $result->fetchAll(PDO::FETCH_ASSOC);

    // Convert to JSON format and output
    echo json_encode($lichHocs_arr);
} else {
    // No LichHoc found for the provided MaKhoaHoc
    // Output an error message
    echo json_encode(array('message' => 'Không tìm thấy lịch học nào cho khóa học này.'));
}

// Free the database connection
$db = null;
?>
