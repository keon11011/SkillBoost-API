<?php
class KhachHang{
    private $conn;
    private $table = 'khachhang';

    public $MaKH;
    public $HoKH;
    public $TenLotKH;
    public $TenKH;
    public $HoTenKH;
    public $GioiTinhKH;
    public $NgaySinhKH;
    public $SoDienThoaiKH;
    public $EmailKH;
    public $MaNgheNghiep;
    public $TenNgheNghiep;
    public $MaNVPhuTrachKH;
    public $TenNVPhuTrachKH;
    public $TrangThaiKH;
    public $LyDoTrangThaiKH;
    public $GhiChuKH;
    public $ChuyenDoiTuMaLead;
    public $TaoVaoLuc;
    public $TaoBoi;
    public $ChinhSuaLanCuoiVaoLuc;
    public $ChinhSuaLanCuoiBoi;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        try {
            $query = "SELECT * FROM " . $this->table;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            // Handle database errors
            echo json_encode(array("error" => $e->getMessage()));
        }
    }
}
?>