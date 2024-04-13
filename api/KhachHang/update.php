<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PATCH');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// Include necessary files
include_once 'C:/xampp/htdocs/SkillBoost-API/core/initialize.php';

// Instantiate KhachHang object
$khachhang = new KhachHang($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Check if required data is set
if (!isset($data->MaKH)) {
    echo json_encode(array('message' => 'Missing MaKH.'));
    exit;
}

// Set KhachHang properties from the received data
$khachhang->MaKH = $data->MaKH;
$khachhang->HoTenKH = $data->HoTenKH;
$khachhang->GioiTinhKH = $data->GioiTinhKH;
$khachhang->NgaySinhKH = $data->NgaySinhKH;
$khachhang->SoDienThoaiKH = $data->SoDienThoaiKH;
$khachhang->EmailKH = $data->EmailKH;
$khachhang->MaNgheNghiep = $data->MaNgheNghiep;
$khachhang->MaNVPhuTrachKH = isset($data->MaNVPhuTrachKH) ? $data->MaNVPhuTrachKH : 3; 
$khachhang->TenNVPhuTrachKH = isset($data->TenNVPhuTrachKH) ? $data->TenNVPhuTrachKH : 'Nguyễn Phương Thanh';
$khachhang->TrangThaiKH = isset($data->TrangThaiKH) ? $data->TrangThaiKH : 'Đang hoạt động'; 
$khachhang->LyDoTrangThaiKH = isset($data->LyDoTrangThaiKH) ? $data->LyDoTrangThaiKH : null;
$khachhang->GhiChuKH = isset($data->GhiChuKH) ? $data->GhiChuKH : null;
$khachhang->ChuyenDoiTuMaLead = isset($data->ChuyenDoiTuMaLead) ? $data->ChuyenDoiTuMaLead : null;
$khachhang->ChinhSuaLanCuoiVaoLuc = date('Y-m-d H:i:s');
$khachhang->ChinhSuaLanCuoiBoi = isset($data->ChinhSuaLanCuoiBoi) ? $data->ChinhSuaLanCuoiBoi : 3; 

// Update KhachHang
if ($khachhang->update()) {
    echo json_encode(array('message' => 'Cập nhật KhachHang thành công.'));
} else {
    echo json_encode(array('message' => 'Cập nhật KhachHang thất bại.'));
}

// Free the database connection
$db = null;
?>
