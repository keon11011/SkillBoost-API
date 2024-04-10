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

    public function read_single() {
        try {
            // Define the query
            $query = "SELECT * FROM " . $this->table . " WHERE MaQuyDinhGiamGia = :MaQuyDinhGiamGia";
        
            // Prepare the query statement
            $stmt = $this->conn->prepare($query);
        
            // Bind parameter value
            $stmt->bindParam(':MaQuyDinhGiamGia', $this->MaQuyDinhGiamGia);
        
            // Execute query
            $stmt->execute();
        
            // Fetch the single row
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
            // Set properties with the fetched data
            $this->MaQuyDinhGiamGia = $row['MaQuyDinhGiamGia'];
            $this->MoTaLoaiGiamGia = $row['MoTaLoaiGiamGia'];
            $this->SoLuongKhoaHocDangKy = $row['SoLuongKhoaHocDangKy'];
            $this->MaNgheNghiep = $row['MaNgheNghiep'];
            $this->NgayBatDau = $row['NgayBatDau'];
            $this->NgayKetThuc = $row['NgayKetThuc'];
            $this->PhanTramGiamGiaMacDinh = $row['PhanTramGiamGiaMacDinh'];
            $this->PhanTramGiamGiaToiDa = $row['PhanTramGiamGiaToiDa'];
            $this->TaoVaoLuc = $row['TaoVaoLuc'];
            $this->TaoBoi = $row['TaoBoi'];
            $this->ChinhSuaLanCuoiVaoLuc = $row['ChinhSuaLanCuoiVaoLuc'];
            $this->ChinhSuaLanCuoiBoi = $row['ChinhSuaLanCuoiBoi'];
            $this->TrangThaiQuyDinhGiamGia = $row['TrangThaiQuyDinhGiamGia'];
        
            // Return the fetched data
            return $row;
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

    public function update() {
        // Create query
        $query = "UPDATE " . $this->table . "
                  SET
                    MoTaLoaiGiamGia = :MoTaLoaiGiamGia,
                    SoLuongKhoaHocDangKy = :SoLuongKhoaHocDangKy,
                    MaNgheNghiep = :MaNgheNghiep,
                    NgayBatDau = :NgayBatDau,
                    NgayKetThuc = :NgayKetThuc,
                    PhanTramGiamGiaMacDinh = :PhanTramGiamGiaMacDinh,
                    PhanTramGiamGiaToiDa = :PhanTramGiamGiaToiDa,
                    ChinhSuaLanCuoiVaoLuc = :ChinhSuaLanCuoiVaoLuc,
                    ChinhSuaLanCuoiBoi = :ChinhSuaLanCuoiBoi,
                    TrangThaiQuyDinhGiamGia = :TrangThaiQuyDinhGiamGia
                  WHERE
                    MaQuyDinhGiamGia = :MaQuyDinhGiamGia";
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);
    
        // Clean data
        $this->MoTaLoaiGiamGia = htmlspecialchars(strip_tags($this->MoTaLoaiGiamGia));
        $this->SoLuongKhoaHocDangKy = htmlspecialchars(strip_tags($this->SoLuongKhoaHocDangKy));
        $this->MaNgheNghiep = htmlspecialchars(strip_tags($this->MaNgheNghiep));
        // dòng này có thể assigned null
        if ($this->NgayBatDau !== null) {
            $this->NgayBatDau = htmlspecialchars(strip_tags($this->NgayBatDau));
        }
        // dòng này có thể assigned null
        if ($this->NgayKetThuc !== null) {
            $this->NgayKetThuc = htmlspecialchars(strip_tags($this->NgayKetThuc));
        }
        $this->PhanTramGiamGiaMacDinh = htmlspecialchars(strip_tags($this->PhanTramGiamGiaMacDinh));
        $this->PhanTramGiamGiaToiDa = htmlspecialchars(strip_tags($this->PhanTramGiamGiaToiDa));
        //$this->ChinhSuaLanCuoiVaoLuc = htmlspecialchars(strip_tags($this->ChinhSuaLanCuoiVaoLuc));
        $this->ChinhSuaLanCuoiBoi = htmlspecialchars(strip_tags($this->ChinhSuaLanCuoiBoi));
        $this->TrangThaiQuyDinhGiamGia = htmlspecialchars(strip_tags($this->TrangThaiQuyDinhGiamGia));
        $this->MaQuyDinhGiamGia = htmlspecialchars(strip_tags($this->MaQuyDinhGiamGia));
    
        // Bind data
        $stmt->bindParam(':MoTaLoaiGiamGia', $this->MoTaLoaiGiamGia);
        $stmt->bindParam(':SoLuongKhoaHocDangKy', $this->SoLuongKhoaHocDangKy);
        $stmt->bindParam(':MaNgheNghiep', $this->MaNgheNghiep);
        $stmt->bindParam(':NgayBatDau', $this->NgayBatDau);
        $stmt->bindParam(':NgayKetThuc', $this->NgayKetThuc);
        $stmt->bindParam(':PhanTramGiamGiaMacDinh', $this->PhanTramGiamGiaMacDinh);
        $stmt->bindParam(':PhanTramGiamGiaToiDa', $this->PhanTramGiamGiaToiDa);
        $stmt->bindParam(':ChinhSuaLanCuoiVaoLuc', $this->ChinhSuaLanCuoiVaoLuc);
        $stmt->bindParam(':ChinhSuaLanCuoiBoi', $this->ChinhSuaLanCuoiBoi);
        $stmt->bindParam(':TrangThaiQuyDinhGiamGia', $this->TrangThaiQuyDinhGiamGia);
        $stmt->bindParam(':MaQuyDinhGiamGia', $this->MaQuyDinhGiamGia);
    
        // Execute query
        if ($stmt->execute()) {
            return true;
        }
    
        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);
    
        return false;
    }
    
    public function delete(){
         // Create query
        $query = "UPDATE " . $this->table . "
                    SET
                    TrangThaiQuyDinhGiamGia = :TrangThaiQuyDinhGiamGia,
                    ChinhSuaLanCuoiVaoLuc = :ChinhSuaLanCuoiVaoLuc,
                    ChinhSuaLanCuoiBoi = :ChinhSuaLanCuoiBoi
                    WHERE
                    MaQuyDinhGiamGia = :MaQuyDinhGiamGia";

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->TrangThaiQuyDinhGiamGia = htmlspecialchars(strip_tags($this->TrangThaiQuyDinhGiamGia));
        $this->ChinhSuaLanCuoiVaoLuc = date('Y-m-d H:i:s');
        $this->ChinhSuaLanCuoiBoi = htmlspecialchars(strip_tags($this->ChinhSuaLanCuoiBoi));
        $this->MaQuyDinhGiamGia = htmlspecialchars(strip_tags($this->MaQuyDinhGiamGia));

        // Bind data
        $stmt->bindParam(':TrangThaiQuyDinhGiamGia', $this->TrangThaiQuyDinhGiamGia);
        $stmt->bindParam(':ChinhSuaLanCuoiVaoLuc', $this->ChinhSuaLanCuoiVaoLuc);
        $stmt->bindParam(':ChinhSuaLanCuoiBoi', $this->ChinhSuaLanCuoiBoi);
        $stmt->bindParam(':MaQuyDinhGiamGia', $this->MaQuyDinhGiamGia);

        // Execute query
        if($stmt->execute()) {
        return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
}
?>
