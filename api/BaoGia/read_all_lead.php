<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Initialize our API
include_once('C:/xampp/htdocs/SkillBoost-API/core/initialize.php');

// Instantiate BaoGia
$baoGia = new BaoGia($db);

// Set MaLead if it's provided in the request, otherwise set it to null
$baoGia->MaLead = isset($_GET['MaLead']) ? $_GET['MaLead'] : null;

// BaoGia query
$result = $baoGia->read();

// Get the row count
$num = $result->rowCount();

if ($num > 0) {
    // Fetch all rows as associative arrays
    $baoGia_arr = $result->fetchAll(PDO::FETCH_ASSOC);

    // Convert to JSON format and output
    echo json_encode($baoGia_arr);
} else {
    // No BaoGia found
    // Output an error message
    echo json_encode(array('message' => 'Không tìm thấy BaoGia nào.'));
}

// Free the database connection
$db = null;
?>
