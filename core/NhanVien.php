<?php
class NhanVien{
    private $conn;
    private $table = 'nhanvien';

    public $MaNV;
    public $HoTenNV;
    public $GioiTinhNV;
    public $NgaySinhNV;
    public $ChucVu;
    public $SoDienThoaiNV;
    public $EmailNV;
    public $TrangThaiNV;
    public $TaoVaoLuc;
    public $TaoBoi;
    public $ChinhSuaLanCuoiVaoLuc;
    public $ChinhSuaLanCuoiBoi;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        try {
            $query = "SELECT * FROM NhanVien WHERE MaNV != 1 AND TrangThaiNV != 'Xóa mềm'";
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