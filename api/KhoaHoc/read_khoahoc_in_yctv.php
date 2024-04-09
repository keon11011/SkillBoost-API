<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Initialize our API
include_once('C:/xampp/htdocs/SkillBoost-API/core/initialize.php');

// Instantiate the ChiTietKhoaHocThuocYCTV object
$chiTietKhoaHocThuocYCTV = new ChiTietKhoaHocThuocYCTV($db);

// Get MaLead from the request
$MaLead = isset($_GET['MaLead']) ? $_GET['MaLead'] : die();

// Set MaLead property of ChiTietKhoaHocThuocYCTV object
$chiTietKhoaHocThuocYCTV->MaLead = $MaLead;

// Call the read_khoahoc_in_yctv method
$result = $chiTietKhoaHocThuocYCTV->read_khoahoc_in_yctv();

// Get row count
$num = $result->rowCount();

// Check if any record exists
if ($num > 0) {
    // KhoaHoc array
    $khoaHoc_arr = array();
    $khoaHoc_arr['data'] = array();

while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    extract($row);

    $khoaHoc_item = array(
        'MaKhoaHoc' => $MaKhoaHoc,
        'TenKhoaHoc' => $TenKhoaHoc,
        'GiangVien' => $GiangVien,
        'HocPhi' => $HocPhi
        // Add more fields if needed
    );

    // Push to "data"
    array_push($khoaHoc_arr['data'], $khoaHoc_item);
}

// Turn to JSON & output
echo json_encode($khoaHoc_arr);
} else {
    // No KhoaHoc
    echo json_encode(
        array('message' => 'No KhoaHoc found for the given criteria.')
    );
}

// Free the database connection
$db = null;

?>