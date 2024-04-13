<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Initialize our API
include_once 'C:/xampp/htdocs/SkillBoost-API/core/initialize.php';

// Instantiate BaoGia
$baoGia = new BaoGia($db);

// Read the latest BaoGia
$baoGiaData = $baoGia->read_lastest();

// Check if a record was found
if ($baoGiaData) {
    // Fetch the data as an associative array
    $baoGiaRow = $baoGiaData->fetch(PDO::FETCH_ASSOC);

    // Construct the BaoGia array
    $baoGiaArray = array(
        'MaBaoGia' => $baoGiaRow['MaBaoGia'],
        'TenBaoGia' => $baoGiaRow['TenBaoGia'],
        'MaLead' => $baoGiaRow['MaLead'],
        'HoTenLead' => $baoGiaRow['HoTenLead'],
        'TongTienTruocGiam' => $baoGiaRow['TongTienTruocGiam'],
        'MaGiamGia' => $baoGiaRow['MaGiamGia'],
        'PhanTramGiamGia' => $baoGiaRow['PhanTramGiamGia'],
        'TongTien' => $baoGiaRow['TongTien'],
        'TrangThaiBaoGia' => $baoGiaRow['TrangThaiBaoGia'],
        'TaoVaoLuc' => $baoGiaRow['TaoVaoLuc'],
        'TaoBoi' => $baoGiaRow['TaoBoi'],
        'ChinhSuaLanCuoiVaoLuc' => $baoGiaRow['ChinhSuaLanCuoiVaoLuc'],
        'ChinhSuaLanCuoiBoi' => $baoGiaRow['ChinhSuaLanCuoiBoi'],
        'GioiTinhLead' => $baoGiaRow['GioiTinhLead'],
        'NgaySinhLead' => $baoGiaRow['NgaySinhLead'],
        'SoDienThoaiLead' => $baoGiaRow['SoDienThoaiLead'],
        'EmailLead' => $baoGiaRow['EmailLead'],
        'MaNgheNghiep' => $baoGiaRow['MaNgheNghiep']
    );

    // Output the BaoGia array as JSON
    echo json_encode($baoGiaArray);
} else {
    // If no record was found, output a JSON error message
    echo json_encode(array('message' => 'No record found.'));
}

// Close the statement and database connection
//$baoGiaData->closeCursor();
$db = null;
?>
