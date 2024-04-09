<?php
class KhoaHoc{
    private $conn;
    private $table = 'khoahoc';

    public $MaKhoaHoc;
    public $TenKhoaHoc;
    public $MoTaNgan;
    public $MoTaDai;
    public $ThoiLuongKhoaHoc;
    public $SoBaiViet;
    public $SoFileTaiXuong;
    public $GiangVien;
    public $MucDoKhoaHoc;
    public $LuotDanhGia;
    public $SoLuongHocVienToiDa;
    public $SoLuongHocVienConLai;
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
    //public $MaLead;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        try {
            $query = "SELECT * FROM " . $this->table . " WHERE TrangThaiKhoaHoc != 'Xóa mềm'";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            // Handle database errors
            echo json_encode(array("error" => $e->getMessage()));
        }
    }

    public function read_khoahoc_in_yctv(){
        $query = "
                    SELECT * 
                    FROM " . $this->table . "
                    WHERE MaKhoaHoc IN (
                        SELECT MaKhoaHoc 
                        FROM chitietkhoahocthuocyctv 
                        WHERE MaTuVan IN (
                            SELECT MaTuVan 
                            FROM yeucautuvan 
                            WHERE TaoBoiLead = :MaLead
                        )
                    )
                ";
        
        // Prepare the statement
        $stmt = $this->conn->prepare($query);

        // Bind parameter
        $stmt->bindParam(':MaLead', $MaLead);

        // Execute query
        $stmt->execute();

        // Return result set
        return $stmt;
    }
}
?>