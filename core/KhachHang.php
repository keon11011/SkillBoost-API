<?php
class KhachHang{
    private $conn;
    private $table = 'khachhang';

    public $MaKH;
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

    public function read_single(){
        // Define the query
        $query = "SELECT * FROM " . $this->table . " WHERE MaKH = :MaKH";
    
        // Prepare the query statement
        $stmt = $this->conn->prepare($query);
    
        // Bind parameter value
        $stmt->bindParam(':MaKH', $this->MaKH);
    
        // Execute query
        $stmt->execute();
    
        // Fetch the single row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Set properties with the fetched data
        $this->MaKH = $row['MaKH'];
        $this->HoTenKH = $row['HoTenKH'];
        $this->GioiTinhKH = $row['GioiTinhKH'];
        $this->NgaySinhKH = $row['NgaySinhKH'];
        $this->SoDienThoaiKH = $row['SoDienThoaiKH'];
        $this->EmailKH = $row['EmailKH'];
        $this->MaNgheNghiep = $row['MaNgheNghiep'];
        $this->TenNgheNghiep = $row['TenNgheNghiep'];
        $this->MaNVPhuTrachKH = $row['MaNVPhuTrachKH'];
        $this->TenNVPhuTrachKH = $row['TenNVPhuTrachKH'];
        $this->TrangThaiKH = $row['TrangThaiKH'];
        $this->LyDoTrangThaiKH = $row['LyDoTrangThaiKH'];
        $this->GhiChuKH = $row['GhiChuKH'];
        $this->ChuyenDoiTuMaLead = $row['ChuyenDoiTuMaLead'];
        $this->TaoVaoLuc = $row['TaoVaoLuc'];
        $this->TaoBoi = $row['TaoBoi'];
        $this->ChinhSuaLanCuoiVaoLuc = $row['ChinhSuaLanCuoiVaoLuc'];
        $this->ChinhSuaLanCuoiBoi = $row['ChinhSuaLanCuoiBoi'];
    
        // Return the fetched user data
        return $row;
    }

    public function create(){
        // Create query
        $query = "INSERT INTO " . $this->table . "
                  SET
                    MaKH = :MaKH,
                    HoTenKH = :HoTenKH,
                    GioiTinhKH = :GioiTinhKH,
                    NgaySinhKH = :NgaySinhKH,
                    SoDienThoaiKH = :SoDienThoaiKH,
                    EmailKH = :EmailKH,
                    MaNgheNghiep = :MaNgheNghiep,
                    TenNgheNghiep = :TenNgheNghiep,
                    MaNVPhuTrachKH = :MaNVPhuTrachKH,
                    TenNVPhuTrachKH = :TenNVPhuTrachKH,
                    TrangThaiKH = :TrangThaiKH,
                    LyDoTrangThaiKH = :LyDoTrangThaiKH,
                    GhiChuKH = :GhiChuKH,
                    ChuyenDoiTuMaLead = :ChuyenDoiTuMaLead,
                    TaoVaoLuc = :TaoVaoLuc,
                    TaoBoi = :TaoBoi,
                    ChinhSuaLanCuoiVaoLuc = :ChinhSuaLanCuoiVaoLuc,
                    ChinhSuaLanCuoiBoi = :ChinhSuaLanCuoiBoi
                    ";
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->MaKH = htmlspecialchars(strip_tags($this->MaKH));
        $this->HoTenKH = htmlspecialchars(strip_tags($this->HoTenKH));
        $this->GioiTinhKH = htmlspecialchars(strip_tags($this->GioiTinhKH));
        $this->NgaySinhKH = date('Y-m-d', strtotime($this->NgaySinhKH));
        $this->SoDienThoaiKH = htmlspecialchars(strip_tags($this->SoDienThoaiKH));
        $this->EmailKH = htmlspecialchars(strip_tags($this->EmailKH));
        $this->MaNgheNghiep = htmlspecialchars(strip_tags($this->MaNgheNghiep));
        $this->TenNgheNghiep = htmlspecialchars(strip_tags($this->TenNgheNghiep));
        $this->MaNVPhuTrachKH = htmlspecialchars(strip_tags($this->MaNVPhuTrachKH));
        $this->TenNVPhuTrachKH = htmlspecialchars(strip_tags($this->TenNVPhuTrachKH));
        $this->TrangThaiKH = htmlspecialchars(strip_tags($this->TrangThaiKH));
        $this->LyDoTrangThaiKH = htmlspecialchars(strip_tags($this->LyDoTrangThaiKH));
        $this->GhiChuKH = htmlspecialchars(strip_tags($this->GhiChuKH));
        // dòng này assigned null
        if ($this->ChuyenDoiTuMaLead !== null) {
            $this->ChuyenDoiTuMaLead = htmlspecialchars(strip_tags($this->ChuyenDoiTuMaLead));
        }        
        //$this->TaoVaoLuc = date('Y-m-d H:i:s', strtotime($this->TaoVaoLuc));
        $this->TaoBoi = htmlspecialchars(strip_tags($this->TaoBoi));
        //$this->ChinhSuaLanCuoiVaoLuc = date('Y-m-d H:i:s', strtotime($this->ChinhSuaLanCuoiVaoLuc));
        $this->ChinhSuaLanCuoiBoi = htmlspecialchars(strip_tags($this->ChinhSuaLanCuoiBoi));

        // Bind data
        $stmt->bindParam(':MaKH', $this->MaKH);
        $stmt->bindParam(':HoTenKH', $this->HoTenKH);
        $stmt->bindParam(':GioiTinhKH', $this->GioiTinhKH);
        $stmt->bindParam(':NgaySinhKH', $this->NgaySinhKH);
        $stmt->bindParam(':SoDienThoaiKH', $this->SoDienThoaiKH);
        $stmt->bindParam(':EmailKH', $this->EmailKH);
        $stmt->bindParam(':MaNgheNghiep', $this->MaNgheNghiep);
        $stmt->bindParam(':TenNgheNghiep', $this->TenNgheNghiep);
        $stmt->bindParam(':MaNVPhuTrachKH', $this->MaNVPhuTrachKH);
        $stmt->bindParam(':TenNVPhuTrachKH', $this->TenNVPhuTrachKH);
        $stmt->bindParam(':TrangThaiKH', $this->TrangThaiKH);
        $stmt->bindParam(':LyDoTrangThaiKH', $this->LyDoTrangThaiKH);
        $stmt->bindParam(':GhiChuKH', $this->GhiChuKH);
        $stmt->bindParam(':ChuyenDoiTuMaLead', $this->ChuyenDoiTuMaLead);
        $stmt->bindParam(':TaoVaoLuc', $this->TaoVaoLuc);
        $stmt->bindParam(':TaoBoi', $this->TaoBoi);
        $stmt->bindParam(':ChinhSuaLanCuoiVaoLuc', $this->ChinhSuaLanCuoiVaoLuc);
        $stmt->bindParam(':ChinhSuaLanCuoiBoi', $this->ChinhSuaLanCuoiBoi);

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