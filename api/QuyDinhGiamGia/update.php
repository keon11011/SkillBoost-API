<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PATCH');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// Include necessary files
include_once 'C:/xampp/htdocs/SkillBoost-API/core/initialize.php'; 

// Instantiate QuyDinhGiamGia
$quyDinhGiamGia = new QuyDinhGiamGia($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Check if required data is set
if (!isset($data->MaQuyDinhGiamGia)) {
    echo json_encode(array('message' => 'Missing MaQuyDinhGiamGia.'));
    exit;
}

// Set QuyDinhGiamGia properties from the received data
$quyDinhGiamGia->MaQuyDinhGiamGia = $data->MaQuyDinhGiamGia;
$quyDinhGiamGia->MoTaLoaiGiamGia = $data->MoTaLoaiGiamGia;
$quyDinhGiamGia->SoLuongKhoaHocDangKy = $data->SoLuongKhoaHocDangKy;
$quyDinhGiamGia->MaNgheNghiep = $data->MaNgheNghiep;
$quyDinhGiamGia->NgayBatDau = $data->NgayBatDau;
$quyDinhGiamGia->NgayKetThuc = $data->NgayKetThuc;
$quyDinhGiamGia->PhanTramGiamGiaMacDinh = $data->PhanTramGiamGiaMacDinh;
$quyDinhGiamGia->PhanTramGiamGiaToiDa = $data->PhanTramGiamGiaToiDa;
$quyDinhGiamGia->ChinhSuaLanCuoiVaoLuc = date('Y-m-d H:i:s');
$quyDinhGiamGia->ChinhSuaLanCuoiBoi = 3;
$quyDinhGiamGia->TrangThaiQuyDinhGiamGia = 'Đang hoạt động';

// Update QuyDinhGiamGia
if ($quyDinhGiamGia->update()) {
    echo json_encode(array('message' => 'Cập nhật Quy định giảm giá thành công.'));
} else {
    echo json_encode(array('message' => 'Cập nhật Quy định giảm giá thất bại.'));
}

// Free the database connection
$db = null;
?>
