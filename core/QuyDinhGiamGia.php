<?php
class QuyDinhGiamGia {
    private $conn;
    private $table = 'quydinhgiamgia';

    public $MaQuyDinhGiamGia;
    public $MoTaLoaiGiamGia;
    public $SoLuongKhoaHocDangKy;
    public $MaNgheNghiep;
    public $NgayBatDau;
    public $NgayKetThuc;
    public $PhanTramGiamGiaMacDinh;
    public $PhanTramGiamGiaToiDa;
    public $TaoVaoLuc;
    public $TaoBoi;
    public $ChinhSuaLanCuoiVaoLuc;
    public $ChinhSuaLanCuoiBoi;
    public $TrangThaiQuyDinhGiamGia;

    // Constructor
    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        try {
            $query = "SELECT * FROM " . $this->table . " WHERE TrangThaiQuyDinhGiamGia != 'Xóa mềm'";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            // Handle database errors
            echo json_encode(array("error" => $e->getMessage()));
        }
    }

    public function create() {
        // Create query
        $query = 'INSERT INTO ' . $this->table . ' 
                  SET 
                    MoTaLoaiGiamGia = :MoTaLoaiGiamGia,
                    SoLuongKhoaHocDangKy = :SoLuongKhoaHocDangKy,
                    MaNgheNghiep = :MaNgheNghiep,
                    NgayBatDau = :NgayBatDau,
                    NgayKetThuc = :NgayKetThuc,
                    PhanTramGiamGiaMacDinh = :PhanTramGiamGiaMacDinh,
                    PhanTramGiamGiaToiDa = :PhanTramGiamGiaToiDa,
                    TaoVaoLuc = :TaoVaoLuc,
                    TaoBoi = :TaoBoi,
                    ChinhSuaLanCuoiVaoLuc = :ChinhSuaLanCuoiVaoLuc,
                    ChinhSuaLanCuoiBoi = :ChinhSuaLanCuoiBoi,
                    TrangThaiQuyDinhGiamGia = :TrangThaiQuyDinhGiamGia';
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);
        
        // Clean data
        $this->MoTaLoaiGiamGia = htmlspecialchars(strip_tags($this->MoTaLoaiGiamGia));
        $this->SoLuongKhoaHocDangKy = htmlspecialchars(strip_tags($this->SoLuongKhoaHocDangKy));
        $this->MaNgheNghiep = htmlspecialchars(strip_tags($this->MaNgheNghiep));
        $this->NgayBatDau = date('Y-m-d', strtotime($this->NgayBatDau));
        $this->NgayKetThuc = date('Y-m-d', strtotime($this->NgayKetThuc));
        $this->PhanTramGiamGiaMacDinh = htmlspecialchars(strip_tags($this->PhanTramGiamGiaMacDinh));
        $this->PhanTramGiamGiaToiDa = htmlspecialchars(strip_tags($this->PhanTramGiamGiaToiDa));
        //$this->TaoVaoLuc = htmlspecialchars(strip_tags($this->TaoVaoLuc));
        $this->TaoBoi = htmlspecialchars(strip_tags($this->TaoBoi));
        //$this->ChinhSuaLanCuoiVaoLuc = htmlspecialchars(strip_tags($this->ChinhSuaLanCuoiVaoLuc));
        $this->ChinhSuaLanCuoiBoi = htmlspecialchars(strip_tags($this->ChinhSuaLanCuoiBoi));
        $this->TrangThaiQuyDinhGiamGia = htmlspecialchars(strip_tags($this->TrangThaiQuyDinhGiamGia));
        
        // Bind data
        $stmt->bindParam(':MoTaLoaiGiamGia', $this->MoTaLoaiGiamGia);
        $stmt->bindParam(':SoLuongKhoaHocDangKy', $this->SoLuongKhoaHocDangKy);
        $stmt->bindParam(':MaNgheNghiep', $this->MaNgheNghiep);
        $stmt->bindParam(':NgayBatDau', $this->NgayBatDau);
        $stmt->bindParam(':NgayKetThuc', $this->NgayKetThuc);
        $stmt->bindParam(':PhanTramGiamGiaMacDinh', $this->PhanTramGiamGiaMacDinh);
        $stmt->bindParam(':PhanTramGiamGiaToiDa', $this->PhanTramGiamGiaToiDa);
        $stmt->bindParam(':TaoVaoLuc', $this->TaoVaoLuc);
        $stmt->bindParam(':TaoBoi', $this->TaoBoi);
        $stmt->bindParam(':ChinhSuaLanCuoiVaoLuc', $this->ChinhSuaLanCuoiVaoLuc);
        $stmt->bindParam(':ChinhSuaLanCuoiBoi', $this->ChinhSuaLanCuoiBoi);
        $stmt->bindParam(':TrangThaiQuyDinhGiamGia', $this->TrangThaiQuyDinhGiamGia);
        
        // Execute query
        if ($stmt->execute()) {
            return true;
        }
        
        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);
        
        return false;
    }
    
}
?>
