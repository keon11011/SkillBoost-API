<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Initialize our API
include_once 'C:/xampp/htdocs/SkillBoost-API/core/initialize.php';

// Instantiate KhoaHoc
$khoahoc = new KhoaHoc($db);

// Set the KhoaHoc ID
$khoahoc->MaKhoaHoc = isset($_GET['MaKhoaHoc']) ? $_GET['MaKhoaHoc'] : die(); // Set the MaKhoaHoc you want to retrieve

// Read a single KhoaHoc
$khoahocData = $khoahoc->read_single();

// Construct the KhoaHoc array
$khoahocArray = array(
    'MaKhoaHoc' => $khoahocData['MaKhoaHoc'],
    'TenKhoaHoc' => $khoahocData['TenKhoaHoc'],
    'HinhMinhHoa' => $khoahocData['HinhMinhHoa'],
    'MoTaNgan' => $khoahocData['MoTaNgan'],
    'MoTaDai' => $khoahocData['MoTaDai'],
    'ThoiLuongKhoaHoc' => $khoahocData['ThoiLuongKhoaHoc'],
    'SoBaiViet' => $khoahocData['SoBaiViet'],
    'SoFileTaiXuong' => $khoahocData['SoFileTaiXuong'],
    'GiangVien' => $khoahocData['GiangVien'],
    'MucDoKhoaHoc' => $khoahocData['MucDoKhoaHoc'],
    'LuotDanhGia' => $khoahocData['LuotDanhGia'],
    'SoLuongHocVienToiDa' => $khoahocData['SoLuongHocVienToiDa'],
    'SoLuongHocVienConLai' => $khoahocData['SoLuongHocVienConLai'],
    'GiaTien' => $khoahocData['GiaTien'],
    'NgayKhaiGiang' => $khoahocData['NgayKhaiGiang'],
    'NgayBeGiang' => $khoahocData['NgayBeGiang'],
    'DanhGiaKhoaHoc' => $khoahocData['DanhGiaKhoaHoc'],
    'TrangThaiKhoaHoc' => $khoahocData['TrangThaiKhoaHoc'],
    'MaLoaiKhoaHoc' => $khoahocData['MaLoaiKhoaHoc'],
    'TaoVaoLuc' => $khoahocData['TaoVaoLuc'],
    'TaoBoi' => $khoahocData['TaoBoi'],
    'ChinhSuaLanCuoiVaoLuc' => $khoahocData['ChinhSuaLanCuoiVaoLuc'],
    'ChinhSuaLanCuoiBoi' => $khoahocData['ChinhSuaLanCuoiBoi']
);

// Output the KhoaHoc array as JSON and exit
echo json_encode($khoahocArray);

// Free the database connection
$db = null;
?>
