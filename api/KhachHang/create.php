<?php
// Headers
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// Include necessary files
include_once 'C:/xampp/htdocs/SkillBoost-API/core/initialize.php';

// Instantiate KhachHang
$khachhang = new KhachHang($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Check if required data is set
if (!isset($data->HoTenKH, $data->GioiTinhKH, $data->NgaySinhKH, $data->SoDienThoaiKH, $data->EmailKH, $data->MaNgheNghiep)) {
    echo json_encode(array('message' => 'Missing required data.'));
    exit;
}

// Set post properties from the received data
$khachhang->HoTenKH = $data->HoTenKH;
$khachhang->GioiTinhKH = $data->GioiTinhKH;
$khachhang->NgaySinhKH = $data->NgaySinhKH;
$khachhang->SoDienThoaiKH = $data->SoDienThoaiKH;
$khachhang->EmailKH = $data->EmailKH;
$khachhang->MaNgheNghiep = $data->MaNgheNghiep;
$khachhang->MaNVPhuTrachKH = 3; // Đang fix cứng
$khachhang->TenNVPhuTrachKH = 'Nguyễn Phương Thanh'; // Đang fix cứng
$khachhang->TrangThaiKH = 'Đang hoạt động'; // Đang fix cứng
$khachhang->LyDoTrangThaiKH = isset($data->LyDoTrangThaiKH) ? $data->LyDoTrangThaiKH : null;
$khachhang->GhiChuKH = isset($data->GhiChuKH) ? $data->GhiChuKH : null;
$khachhang->ChuyenDoiTuMaLead = isset($data->ChuyenDoiTuMaLead) ? $data->ChuyenDoiTuMaLead : null;
$khachhang->TaoVaoLuc = date('Y-m-d H:i:s');
$khachhang->TaoBoi = 1; // Đang fix cứng
$khachhang->ChinhSuaLanCuoiVaoLuc = date('Y-m-d H:i:s');
$khachhang->ChinhSuaLanCuoiBoi = 3; // Đang fix cứng

// Create KhachHang
if ($khachhang->create()) {
    echo json_encode(array('message' => 'Tạo thành công khách hàng mới.'));
} else {
    echo json_encode(array('message' => 'Tạo thất bại khách hàng mới.'));
}

// Free the database connection
$db = null;
?>
