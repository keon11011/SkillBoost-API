<?php
class Lead{
    private $conn;
    private $table = 'lead';

    public $MaLead;
    public $HoTenLead;
    public $GioiTinhLead;
    public $NgaySinhLead;
    public $SoDienThoaiLead;
    public $EmailLead;
    public $MaNgheNghiep;
    public $MaNVPhuTrachLead;
    public $TrangThaiLead;
    public $LyDoTrangThaiLead;
    public $NguonLead;
    public $GhiChuLead;
    public $LeadTuKHCu;
    public $TaoVaoLuc;
    public $TaoBoi;
    public $ChinhSuaLanCuoiVaoLuc;
    public $ChinhSuaLanCuoiBoi;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        try {
            $query = "SELECT * FROM " . $this->table . " WHERE TrangThaiLead != 'Xóa mềm'";
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
        $query = "SELECT * FROM " . $this->table . " WHERE MaLead = :MaLead";
    
        // Prepare the query statement
        $stmt = $this->conn->prepare($query);
    
        // Bind parameter value
        $stmt->bindParam(':MaLead', $this->MaLead);
    
        // Execute query
        $stmt->execute();
    
        // Fetch the single row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Set properties with the fetched data
        $this->MaLead = $row['MaLead'];
        $this->HoTenLead = $row['HoTenLead'];
        $this->GioiTinhLead = $row['GioiTinhLead'];
        $this->NgaySinhLead = $row['NgaySinhLead'];
        $this->SoDienThoaiLead = $row['SoDienThoaiLead'];
        $this->EmailLead = $row['EmailLead'];
        $this->MaNgheNghiep = $row['MaNgheNghiep'];
        $this->MaNVPhuTrachLead = $row['MaNVPhuTrachLead'];
        $this->TrangThaiLead = $row['TrangThaiLead'];
        $this->LyDoTrangThaiLead = $row['LyDoTrangThaiLead'];
        $this->NguonLead = $row['NguonLead'];
        $this->GhiChuLead = $row['GhiChuLead'];
        $this->LeadTuKHCu = $row['LeadTuKHCu'];
        $this->TaoVaoLuc = $row['TaoVaoLuc'];
        $this->TaoBoi = $row['TaoBoi'];
        $this->ChinhSuaLanCuoiVaoLuc = $row['ChinhSuaLanCuoiVaoLuc'];
        $this->ChinhSuaLanCuoiBoi = $row['ChinhSuaLanCuoiBoi'];
    
        // Return the fetched user data
        return $row;
    }

    public function read_new(){
        // Define the query
        $query = "SELECT MaLead FROM " . $this->table . " ORDER BY MaLead DESC LIMIT 1";

        // Prepare the query statement
        $stmt = $this->conn->prepare($query);

        // Execute the query
        $stmt->execute();

        // Fetch the result
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Return the fetched result
        return $result;
    }
        
    public function create() {
        // Define the query
        $query = "INSERT INTO " . $this->table . "
                  SET
                    MaLead = :MaLead,
                    HoTenLead = :HoTenLead,
                    GioiTinhLead = :GioiTinhLead,
                    NgaySinhLead = :NgaySinhLead,
                    SoDienThoaiLead = :SoDienThoaiLead,
                    EmailLead = :EmailLead,
                    MaNgheNghiep = :MaNgheNghiep,
                    MaNVPhuTrachLead = :MaNVPhuTrachLead,
                    TrangThaiLead = :TrangThaiLead,
                    LyDoTrangThaiLead = :LyDoTrangThaiLead,
                    NguonLead = :NguonLead,
                    GhiChuLead = :GhiChuLead,
                    LeadTuKHCu = :LeadTuKHCu,
                    TaoVaoLuc = :TaoVaoLuc,
                    TaoBoi = :TaoBoi,
                    ChinhSuaLanCuoiVaoLuc = :ChinhSuaLanCuoiVaoLuc,
                    ChinhSuaLanCuoiBoi = :ChinhSuaLanCuoiBoi";
    
        // Prepare statement
        $stmt = $this->conn->prepare($query);
    
        // Clean data
        $this->MaLead = htmlspecialchars(strip_tags($this->MaLead));
        $this->HoTenLead = htmlspecialchars(strip_tags($this->HoTenLead));
        $this->GioiTinhLead = htmlspecialchars(strip_tags($this->GioiTinhLead));
        $this->NgaySinhLead = date('Y-m-d', strtotime($this->NgaySinhLead));
        $this->SoDienThoaiLead = htmlspecialchars(strip_tags($this->SoDienThoaiLead));
        $this->EmailLead = htmlspecialchars(strip_tags($this->EmailLead));
        $this->MaNgheNghiep = htmlspecialchars(strip_tags($this->MaNgheNghiep));
        $this->MaNVPhuTrachLead = htmlspecialchars(strip_tags($this->MaNVPhuTrachLead));
        $this->TrangThaiLead = htmlspecialchars(strip_tags($this->TrangThaiLead));
        // dòng này có thể assigned null
        if ($this->LyDoTrangThaiLead !== null) {
            $this->LyDoTrangThaiLead = htmlspecialchars(strip_tags($this->LyDoTrangThaiLead));
        }
        $this->NguonLead = htmlspecialchars(strip_tags($this->NguonLead));
        // dòng này có thể assigned null
        if ($this->GhiChuLead !== null) {
            $this->GhiChuLead = htmlspecialchars(strip_tags($this->GhiChuLead));
        }
        // dòng này có thể assigned null
        if ($this->LeadTuKHCu !== null) {
            $this->LeadTuKHCu = htmlspecialchars(strip_tags($this->LeadTuKHCu));
        }
        //$this->TaoVaoLuc = date('Y-m-d H:i:s', strtotime($this->TaoVaoLuc));
        $this->TaoBoi = htmlspecialchars(strip_tags($this->TaoBoi));
        //$this->ChinhSuaLanCuoiVaoLuc = date('Y-m-d H:i:s', strtotime($this->ChinhSuaLanCuoiVaoLuc));
        $this->ChinhSuaLanCuoiBoi = htmlspecialchars(strip_tags($this->ChinhSuaLanCuoiBoi));
    
        // Bind data
        $stmt->bindParam(':MaLead', $this->MaLead);
        $stmt->bindParam(':HoTenLead', $this->HoTenLead);
        $stmt->bindParam(':GioiTinhLead', $this->GioiTinhLead);
        $stmt->bindParam(':NgaySinhLead', $this->NgaySinhLead);
        $stmt->bindParam(':SoDienThoaiLead', $this->SoDienThoaiLead);
        $stmt->bindParam(':EmailLead', $this->EmailLead);
        $stmt->bindParam(':MaNgheNghiep', $this->MaNgheNghiep);
        $stmt->bindParam(':MaNVPhuTrachLead', $this->MaNVPhuTrachLead);
        $stmt->bindParam(':TrangThaiLead', $this->TrangThaiLead);
        $stmt->bindParam(':LyDoTrangThaiLead', $this->LyDoTrangThaiLead);
        $stmt->bindParam(':NguonLead', $this->NguonLead);
        $stmt->bindParam(':GhiChuLead', $this->GhiChuLead);
        $stmt->bindParam(':LeadTuKHCu', $this->LeadTuKHCu);
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

    public function update(){
        // Create query
        $query = "UPDATE " . $this->table . "
                  SET
                    HoTenLead = :HoTenLead,
                    GioiTinhLead = :GioiTinhLead,
                    NgaySinhLead = :NgaySinhLead,
                    SoDienThoaiLead = :SoDienThoaiLead,
                    EmailLead = :EmailLead,
                    MaNgheNghiep = :MaNgheNghiep,
                    MaNVPhuTrachLead = :MaNVPhuTrachLead,
                    TrangThaiLead = :TrangThaiLead,
                    LyDoTrangThaiLead = :LyDoTrangThaiLead,
                    NguonLead = :NguonLead,
                    GhiChuLead = :GhiChuLead,
                    LeadTuKHCu = :LeadTuKHCu,
                    ChinhSuaLanCuoiVaoLuc = :ChinhSuaLanCuoiVaoLuc,
                    ChinhSuaLanCuoiBoi = :ChinhSuaLanCuoiBoi
                  WHERE
                    MaLead = :MaLead";
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);
    
        // Clean data
        $this->HoTenLead = htmlspecialchars(strip_tags($this->HoTenLead));
        $this->GioiTinhLead = htmlspecialchars(strip_tags($this->GioiTinhLead));
        $this->NgaySinhLead = date('Y-m-d', strtotime($this->NgaySinhLead));
        $this->SoDienThoaiLead = htmlspecialchars(strip_tags($this->SoDienThoaiLead));
        $this->EmailLead = htmlspecialchars(strip_tags($this->EmailLead));
        $this->MaNgheNghiep = htmlspecialchars(strip_tags($this->MaNgheNghiep));
        $this->MaNVPhuTrachLead = htmlspecialchars(strip_tags($this->MaNVPhuTrachLead));
        $this->TrangThaiLead = htmlspecialchars(strip_tags($this->TrangThaiLead));
        $this->LyDoTrangThaiLead = htmlspecialchars(strip_tags($this->LyDoTrangThaiLead));
        $this->NguonLead = htmlspecialchars(strip_tags($this->NguonLead));
        $this->GhiChuLead = htmlspecialchars(strip_tags($this->GhiChuLead));
        $this->LeadTuKHCu = htmlspecialchars(strip_tags($this->LeadTuKHCu));
        //$this->ChinhSuaLanCuoiVaoLuc = date('Y-m-d H:i:s', strtotime($this->ChinhSuaLanCuoiVaoLuc));
        $this->ChinhSuaLanCuoiBoi = htmlspecialchars(strip_tags($this->ChinhSuaLanCuoiBoi));
        $this->MaLead = htmlspecialchars(strip_tags($this->MaLead));
    
        // Bind data
        $stmt->bindParam(':HoTenLead', $this->HoTenLead);
        $stmt->bindParam(':GioiTinhLead', $this->GioiTinhLead);
        $stmt->bindParam(':NgaySinhLead', $this->NgaySinhLead);
        $stmt->bindParam(':SoDienThoaiLead', $this->SoDienThoaiLead);
        $stmt->bindParam(':EmailLead', $this->EmailLead);
        $stmt->bindParam(':MaNgheNghiep', $this->MaNgheNghiep);
        $stmt->bindParam(':MaNVPhuTrachLead', $this->MaNVPhuTrachLead);
        $stmt->bindParam(':TrangThaiLead', $this->TrangThaiLead);
        $stmt->bindParam(':LyDoTrangThaiLead', $this->LyDoTrangThaiLead);
        $stmt->bindParam(':NguonLead', $this->NguonLead);
        $stmt->bindParam(':GhiChuLead', $this->GhiChuLead);
        $stmt->bindParam(':LeadTuKHCu', $this->LeadTuKHCu);
        $stmt->bindParam(':ChinhSuaLanCuoiVaoLuc', $this->ChinhSuaLanCuoiVaoLuc);
        $stmt->bindParam(':ChinhSuaLanCuoiBoi', $this->ChinhSuaLanCuoiBoi);
        $stmt->bindParam(':MaLead', $this->MaLead);
    
        // Execute query
        if($stmt->execute()) {
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
                    TrangThaiLead = :TrangThaiLead,
                    ChinhSuaLanCuoiVaoLuc = :ChinhSuaLanCuoiVaoLuc,
                    ChinhSuaLanCuoiBoi = :ChinhSuaLanCuoiBoi
                  WHERE
                    MaLead = :MaLead";
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);
    
        // Clean data
        $this->TrangThaiLead = htmlspecialchars(strip_tags($this->TrangThaiLead));
        //$this->ChinhSuaLanCuoiVaoLuc = date('Y-m-d H:i:s', strtotime($this->ChinhSuaLanCuoiVaoLuc));
        $this->ChinhSuaLanCuoiBoi = htmlspecialchars(strip_tags($this->ChinhSuaLanCuoiBoi));
        $this->MaLead = htmlspecialchars(strip_tags($this->MaLead));
    
        // Bind data
        $stmt->bindParam(':TrangThaiLead', $this->TrangThaiLead);
        $stmt->bindParam(':ChinhSuaLanCuoiVaoLuc', $this->ChinhSuaLanCuoiVaoLuc);
        $stmt->bindParam(':ChinhSuaLanCuoiBoi', $this->ChinhSuaLanCuoiBoi);
        $stmt->bindParam(':MaLead', $this->MaLead);
    
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