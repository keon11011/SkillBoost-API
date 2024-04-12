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

// Instantiate KhoaHoc
$khoahoc = new KhoaHoc($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Check if required data is set
if (!isset($data->TenKhoaHoc, $data->MoTaNgan, $data->NgayKhaiGiang, $data->NgayBeGiang, $data->GiaTien, $data->SoLuongHocVienToiDa)) {
    echo json_encode(array('message' => 'Missing required data.'));
    exit;
}

// Set post properties from the received data
$khoahoc->TenKhoaHoc = $data->TenKhoaHoc;
$khoahoc->MoTaNgan = $data->MoTaNgan;
$khoahoc->MoTaDai = isset($data->MoTaDai) ? $data->MoTaDai : null;
$khoahoc->ThoiLuongKhoaHoc = isset($data->ThoiLuongKhoaHoc) ? $data->ThoiLuongKhoaHoc : null;
$khoahoc->SoBaiViet = isset($data->SoBaiViet) ? $data->SoBaiViet : null;
$khoahoc->SoFileTaiXuong = isset($data->SoFileTaiXuong) ? $data->SoFileTaiXuong : null;
$khoahoc->GiangVien = 'Ryan Nguyễn';
$khoahoc->MucDoKhoaHoc = isset($data->MucDoKhoaHoc) ? $data->MucDoKhoaHoc : 'Người mới';
$khoahoc->LuotDanhGia = isset($data->LuotDanhGia) ? $data->LuotDanhGia : 4.8;
$khoahoc->SoLuongHocVienToiDa = $data->SoLuongHocVienToiDa;
$khoahoc->SoLuongHocVienConLai = isset($data->SoLuongHocVienConLai) ? $data->SoLuongHocVienConLai : $data->SoLuongHocVienToiDa;
$khoahoc->GiaTien = $data->GiaTien;
$khoahoc->NgayKhaiGiang = $data->NgayKhaiGiang;
$khoahoc->NgayBeGiang = $data->NgayBeGiang;
$khoahoc->DanhGiaKhoaHoc = isset($data->DanhGiaKhoaHoc) ? $data->DanhGiaKhoaHoc : 123;
$khoahoc->TrangThaiKhoaHoc = isset($data->TrangThaiKhoaHoc) ? $data->TrangThaiKhoaHoc : 'Đang vận hành';
$khoahoc->MaLoaiKhoaHoc = 1;
$khoahoc->TaoVaoLuc = date('Y-m-d H:i:s');
$khoahoc->TaoBoi = isset($data->TaoBoi) ? $data->TaoBoi : 3; 
$khoahoc->ChinhSuaLanCuoiVaoLuc = date('Y-m-d H:i:s');
$khoahoc->ChinhSuaLanCuoiBoi = isset($data->ChinhSuaLanCuoiBoi) ? $data->ChinhSuaLanCuoiBoi : 3; 

// Create KhoaHoc
if ($khoahoc->create()) {
    echo json_encode(array('message' => 'Tạo thành công KhoaHoc mới.'));
} else {
    echo json_encode(array('message' => 'Tạo thất bại KhoaHoc mới.'));
}

// Free the database connection
$db = null;
?>
