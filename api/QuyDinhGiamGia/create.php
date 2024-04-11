<?php
// Headers
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// Include necessary files
include_once 'C:/xampp/htdocs/SkillBoost-API/core/initialize.php'; // Adjust path as per your file structure

// Instantiate QuyDinhGiamGia
$quyDinhGiamGia = new QuyDinhGiamGia($db); // Assuming $db is the database connection

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Check if required data is set
if (!isset($data->MoTaLoaiGiamGia, $data->SoLuongKhoaHocDangKy, $data->MaNgheNghiep, $data->NgayBatDau, $data->NgayKetThuc, $data->PhanTramGiamGiaMacDinh, $data->PhanTramGiamGiaToiDa)) {
    echo json_encode(array('message' => 'Missing required data.'));
    exit;
}

// Set post properties from the received data
$quyDinhGiamGia->MoTaLoaiGiamGia = $data->MoTaLoaiGiamGia;
$quyDinhGiamGia->SoLuongKhoaHocDangKy = $data->SoLuongKhoaHocDangKy;
$quyDinhGiamGia->MaNgheNghiep = $data->MaNgheNghiep;
$quyDinhGiamGia->NgayBatDau = isset($data->NgayBatDau) ? $data->NgayBatDau : null;
$quyDinhGiamGia->NgayKetThuc = isset($data->NgayKetThuc) ? $data->NgayKetThuc : null;
$quyDinhGiamGia->PhanTramGiamGiaMacDinh = $data->PhanTramGiamGiaMacDinh;
$quyDinhGiamGia->PhanTramGiamGiaToiDa = $data->PhanTramGiamGiaToiDa;
$quyDinhGiamGia->TaoVaoLuc = date('Y-m-d H:i:s');
//$quyDinhGiamGia->TaoBoi = 3;
$quyDinhGiamGia->TaoBoi = isset($data->TaoBoi) ? $data->TaoBoi : 3; // sửa
$quyDinhGiamGia->ChinhSuaLanCuoiVaoLuc = date('Y-m-d H:i:s');
//$quyDinhGiamGia->ChinhSuaLanCuoiBoi = 3; // Fix cứng 
$quyDinhGiamGia->ChinhSuaLanCuoiBoi = isset($data->ChinhSuaLanCuoiBoi) ? $data->ChinhSuaLanCuoiBoi : 3; // sửa
$quyDinhGiamGia->TrangThaiQuyDinhGiamGia = 'Đang hoạt động';

// Create QuyDinhGiamGia
if ($quyDinhGiamGia->create()) {
    echo json_encode(array('message' => 'Tạo thành công quy định giảm giá mới.'));
} else {
    echo json_encode(array('message' => 'Tạo thất bại quy định giảm giá mới.'));
}

// Free the database connection
$db = null;
?>
