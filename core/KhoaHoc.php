<?php
class KhoaHoc{
    private $conn;
    private $table = 'khoahoc';

    public $MaKhoaHoc;
    public $TenKhoaHoc;
    public $MoTaKhoaHoc;
    public $ThoiLuongKhoaHoc;
    public $GiangVien;
    public $MucDoKhoaHoc;
    public $SoLuongHocVienToiDa;
    public $GiaTien;
    public $NgayKhaiGiang;
    public $NgayBeGiang;
    public $DanhGiaKhoaHoc;
    public $TrangThaiKhoaHoc;
    public $MaLoaiKhoaHoc;
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