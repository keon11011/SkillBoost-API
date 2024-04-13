<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Initialize our API
include_once 'C:/xampp/htdocs/SkillBoost-API/core/initialize.php';

// Instantiate BaoGia
$baoGia = new BaoGia($db);

// Read a single BaoGia
$baoGiaData = $baoGia->read_lastest();

// Construct the BaoGia array
$baoGiaArray = array(
    'MaBaoGia' => $baoGiaData['MaBaoGia'],
    'TenBaoGia' => $baoGiaData['TenBaoGia'],
    'MaLead' => $baoGiaData['MaLead'],
    'HoTenLead' => $baoGiaData['HoTenLead'],
    'TongTienTruocGiam' => $baoGiaData['TongTienTruocGiam'],
    'MaGiamGia' => $baoGiaData['MaGiamGia'],
    'PhanTramGiamGia' => $baoGiaData['PhanTramGiamGia'],
    'TongTien' => $baoGiaData['TongTien'],
    'TrangThaiBaoGia' => $baoGiaData['TrangThaiBaoGia'],
    'TaoVaoLuc' => $baoGiaData['TaoVaoLuc'],
    'TaoBoi' => $baoGiaData['TaoBoi'],
    'ChinhSuaLanCuoiVaoLuc' => $baoGiaData['ChinhSuaLanCuoiVaoLuc'],
    'ChinhSuaLanCuoiBoi' => $baoGiaData['ChinhSuaLanCuoiBoi']
);

// Output the BaoGia array as JSON and exit
echo json_encode($baoGiaArray);

// Free the database connection
$db = null;
?>
