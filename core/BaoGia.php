<?php
class BaoGia{
    private $conn;
    private $table = 'baogia';

    public $MaBaoGia;
    public $TenBaoGia;
    public $MaLead;
    public $HoTenLead;
    public $TongTienTruocGiam; 
    public $MaGiamGia;
    public $PhanTramGiamGia;
    public $TongTien;
    public $TrangThaiBaoGia;
    public $TaoVaoLuc;
    public $TaoBoi;
    public $ChinhSuaLanCuoiVaoLuc;
    public $ChinhSuaLanCuoiBoi;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        try {
            $query = "
                SELECT * 
                FROM " . $this->table . "
                WHERE 
                    TrangThaiBaoGia != 'Xóa mềm' 
                    AND MaLead = :MaLead
            ";
    
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':MaLead', $this->MaLead);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            // Handle database errors
            echo json_encode(array("error" => $e->getMessage()));
        }
    }
    
    public function read_single(){
        try {
            // Define the query
            $query = "
                SELECT * 
                FROM " . $this->table . " 
                WHERE MaBaoGia = :MaBaoGia
            ";
    
            // Prepare the query statement
            $stmt = $this->conn->prepare($query);
    
            // Bind parameter value
            $stmt->bindParam(':MaBaoGia', $this->MaBaoGia);
    
            // Execute query
            $stmt->execute();
    
            // Fetch the single row
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // Check if data is fetched
            if ($row) {
                // Set properties with the fetched data
                $this->MaBaoGia = $row['MaBaoGia'];
                $this->TenBaoGia = $row['TenBaoGia'];
                $this->MaLead = $row['MaLead'];
                $this->HoTenLead = $row['HoTenLead'];
                $this->TongTienTruocGiam = $row['TongTienTruocGiam'];
                $this->MaGiamGia = $row['MaGiamGia'];
                $this->PhanTramGiamGia = $row['PhanTramGiamGia'];
                $this->TongTien = $row['TongTien'];
                $this->TrangThaiBaoGia = $row['TrangThaiBaoGia'];
                $this->TaoVaoLuc = $row['TaoVaoLuc'];
                $this->TaoBoi = $row['TaoBoi'];
                $this->ChinhSuaLanCuoiVaoLuc = $row['ChinhSuaLanCuoiVaoLuc'];
                $this->ChinhSuaLanCuoiBoi = $row['ChinhSuaLanCuoiBoi'];
            }
    
            // Return the fetched data
            return $row;
        } catch (PDOException $e) {
            // Handle database errors
            echo json_encode(array("error" => $e->getMessage()));
        }
    }

    public function read_new(){
        try {
            // Define the query
            $query = "SELECT MaBaoGia FROM " . $this->table . " ORDER BY MaBaoGia DESC LIMIT 1";
    
            // Prepare the query statement
            $stmt = $this->conn->prepare($query);
    
            // Execute the query
            $stmt->execute();
    
            // Fetch the result
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // Return the fetched result
            return $result;
        } catch (PDOException $e) {
            // Handle database errors
            echo json_encode(array("error" => $e->getMessage()));
        }
    }

    public function read_lastest(){
        try {
            // Define the query
            $query = "SELECT * FROM " . $this->table . " ORDER BY MaBaoGia DESC LIMIT 1";
    
            // Prepare the query statement
            $stmt = $this->conn->prepare($query);
    
            // Execute the query
            $stmt->execute();
    
            // Fetch the single row
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // Check if data is fetched
            if ($row) {
                // Set properties with the fetched data
                $this->MaBaoGia = $row['MaBaoGia'];
                $this->TenBaoGia = $row['TenBaoGia'];
                $this->MaLead = $row['MaLead'];
                $this->HoTenLead = $row['HoTenLead'];
                $this->TongTienTruocGiam = $row['TongTienTruocGiam'];
                $this->MaGiamGia = $row['MaGiamGia'];
                $this->PhanTramGiamGia = $row['PhanTramGiamGia'];
                $this->TongTien = $row['TongTien'];
                $this->TrangThaiBaoGia = $row['TrangThaiBaoGia'];
                $this->TaoVaoLuc = $row['TaoVaoLuc'];
                $this->TaoBoi = $row['TaoBoi'];
                $this->ChinhSuaLanCuoiVaoLuc = $row['ChinhSuaLanCuoiVaoLuc'];
                $this->ChinhSuaLanCuoiBoi = $row['ChinhSuaLanCuoiBoi'];
            }
    
            // Return the fetched data
            return $row;
            
        } catch (PDOException $e) {
            // Handle database errors
            echo json_encode(array("error" => $e->getMessage()));
        }
    }
    
    public function create() {
        try {
            // Define the query
            $query = "INSERT INTO " . $this->table . "
                      SET
                      TenBaoGia = :TenBaoGia,
                      MaLead = :MaLead,
                      HoTenLead = :HoTenLead,
                      TongTienTruocGiam = :TongTienTruocGiam,
                      MaGiamGia = :MaGiamGia,
                      PhanTramGiamGia = :PhanTramGiamGia,
                      TongTien = :TongTien,
                      TrangThaiBaoGia = :TrangThaiBaoGia,
                      TaoVaoLuc = :TaoVaoLuc,
                      TaoBoi = :TaoBoi,
                      ChinhSuaLanCuoiVaoLuc = :ChinhSuaLanCuoiVaoLuc,
                      ChinhSuaLanCuoiBoi = :ChinhSuaLanCuoiBoi";
            
            // Prepare statement
            $stmt = $this->conn->prepare($query);
            
            // Clean data
            $this->TenBaoGia = htmlspecialchars(strip_tags($this->TenBaoGia));
            $this->MaLead = htmlspecialchars(strip_tags($this->MaLead));
            $this->HoTenLead = htmlspecialchars(strip_tags($this->HoTenLead));
            $this->TongTienTruocGiam = htmlspecialchars(strip_tags($this->TongTienTruocGiam));
            // dòng này có thể assigned null
            if ($this->MaGiamGia !== null) {
                $this->MaGiamGia = htmlspecialchars(strip_tags($this->MaGiamGia));
            }
            // dòng này có thể assigned null
            if ($this->PhanTramGiamGia !== null) {
                $this->PhanTramGiamGia = htmlspecialchars(strip_tags($this->PhanTramGiamGia));
            }
            $this->TongTien = htmlspecialchars(strip_tags($this->TongTien));
            $this->TrangThaiBaoGia = htmlspecialchars(strip_tags($this->TrangThaiBaoGia));
            //$this->TaoVaoLuc = date('Y-m-d H:i:s'); // Set current timestamp for TaoVaoLuc
            $this->TaoBoi = htmlspecialchars(strip_tags($this->TaoBoi));
            //$this->ChinhSuaLanCuoiVaoLuc = $this->TaoVaoLuc;
            $this->ChinhSuaLanCuoiBoi = htmlspecialchars(strip_tags($this->ChinhSuaLanCuoiBoi));
            
            // Bind data
            $stmt->bindParam(':TenBaoGia', $this->TenBaoGia);
            $stmt->bindParam(':MaLead', $this->MaLead);
            $stmt->bindParam(':HoTenLead', $this->HoTenLead);
            $stmt->bindParam(':TongTienTruocGiam', $this->TongTienTruocGiam);
            $stmt->bindParam(':MaGiamGia', $this->MaGiamGia);
            $stmt->bindParam(':PhanTramGiamGia', $this->PhanTramGiamGia);
            $stmt->bindParam(':TongTien', $this->TongTien);
            $stmt->bindParam(':TrangThaiBaoGia', $this->TrangThaiBaoGia);
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
        } catch (PDOException $e) {
            // Handle database errors
            echo json_encode(array("error" => $e->getMessage()));
        }
    }

    public function update() {
        try {
            // Define the query
            $query = "UPDATE " . $this->table . "
                      SET
                      TenBaoGia = :TenBaoGia,
                      MaLead = :MaLead,
                      HoTenLead = :HoTenLead,
                      TongTienTruocGiam = :TongTienTruocGiam,
                      MaGiamGia = :MaGiamGia,
                      PhanTramGiamGia = :PhanTramGiamGia,
                      TongTien = :TongTien,
                      TrangThaiBaoGia = :TrangThaiBaoGia,
                      ChinhSuaLanCuoiVaoLuc = :ChinhSuaLanCuoiVaoLuc,
                      ChinhSuaLanCuoiBoi = :ChinhSuaLanCuoiBoi
                      WHERE MaBaoGia = :MaBaoGia";
            
            // Prepare statement
            $stmt = $this->conn->prepare($query);
            
            // Clean data
            $this->TenBaoGia = htmlspecialchars(strip_tags($this->TenBaoGia));
            $this->MaLead = htmlspecialchars(strip_tags($this->MaLead));
            $this->HoTenLead = htmlspecialchars(strip_tags($this->HoTenLead));
            $this->TongTienTruocGiam = htmlspecialchars(strip_tags($this->TongTienTruocGiam));
            $this->MaGiamGia = htmlspecialchars(strip_tags($this->MaGiamGia));
            $this->PhanTramGiamGia = htmlspecialchars(strip_tags($this->PhanTramGiamGia));
            $this->TongTien = htmlspecialchars(strip_tags($this->TongTien));
            $this->TrangThaiBaoGia = htmlspecialchars(strip_tags($this->TrangThaiBaoGia));
            $this->TaoBoi = htmlspecialchars(strip_tags($this->TaoBoi));
            $this->ChinhSuaLanCuoiBoi = htmlspecialchars(strip_tags($this->ChinhSuaLanCuoiBoi));
            $this->MaBaoGia = htmlspecialchars(strip_tags($this->MaBaoGia));
            
            // Bind data
            $stmt->bindParam(':TenBaoGia', $this->TenBaoGia);
            $stmt->bindParam(':MaLead', $this->MaLead);
            $stmt->bindParam(':HoTenLead', $this->HoTenLead);
            $stmt->bindParam(':TongTienTruocGiam', $this->TongTienTruocGiam);
            $stmt->bindParam(':MaGiamGia', $this->MaGiamGia);
            $stmt->bindParam(':PhanTramGiamGia', $this->PhanTramGiamGia);
            $stmt->bindParam(':TongTien', $this->TongTien);
            $stmt->bindParam(':TrangThaiBaoGia', $this->TrangThaiBaoGia);
            $stmt->bindParam(':ChinhSuaLanCuoiVaoLuc', $this->ChinhSuaLanCuoiVaoLuc);
            $stmt->bindParam(':ChinhSuaLanCuoiBoi', $this->ChinhSuaLanCuoiBoi);
            $stmt->bindParam(':MaBaoGia', $this->MaBaoGia); 
            
            // Execute query
            if($stmt->execute()) {
                return true;
            }
            
            // Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);
            
            return false;
        } catch (PDOException $e) {
            // Handle database errors
            echo json_encode(array("error" => $e->getMessage()));
        }
    }

    public function delete() {
        try {
            // Define the query
            $query = "UPDATE " . $this->table . "
                      SET
                      TrangThaiBaoGia = :TrangThaiBaoGia,
                      ChinhSuaLanCuoiVaoLuc = :ChinhSuaLanCuoiVaoLuc,
                      ChinhSuaLanCuoiBoi = :ChinhSuaLanCuoiBoi
                      WHERE MaBaoGia = :MaBaoGia";
            
            // Prepare statement
            $stmt = $this->conn->prepare($query);
            
            // Clean data
            $this->TrangThaiBaoGia = htmlspecialchars(strip_tags($this->TrangThaiBaoGia));
            $this->ChinhSuaLanCuoiBoi = htmlspecialchars(strip_tags($this->ChinhSuaLanCuoiBoi));
            $stmt->bindParam(':MaBaoGia', $this->MaBaoGia); 
            
            // Bind data
            $stmt->bindParam(':TrangThaiBaoGia', $this->TrangThaiBaoGia);
            $stmt->bindParam(':ChinhSuaLanCuoiVaoLuc', $this->ChinhSuaLanCuoiVaoLuc);
            $stmt->bindParam(':ChinhSuaLanCuoiBoi', $this->ChinhSuaLanCuoiBoi);
            $stmt->bindParam(':MaBaoGia', $this->MaBaoGia);
            
            // Execute query
            if($stmt->execute()) {
                return true;
            }
            
            // Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);
            
            return false;
        } catch (PDOException $e) {
            // Handle database errors
            echo json_encode(array("error" => $e->getMessage()));
        }
    }

    public function update_trangthai() {
        try {
            // Define the query
            $query = "UPDATE " . $this->table . "
                      SET
                      TrangThaiBaoGia = :TrangThaiBaoGia,
                      ChinhSuaLanCuoiVaoLuc = :ChinhSuaLanCuoiVaoLuc,
                      ChinhSuaLanCuoiBoi = :ChinhSuaLanCuoiBoi
                      WHERE MaBaoGia = :MaBaoGia";
            
            // Prepare statement
            $stmt = $this->conn->prepare($query);
            
            // Clean data
            $this->TrangThaiBaoGia = htmlspecialchars(strip_tags($this->TrangThaiBaoGia));
            $this->ChinhSuaLanCuoiBoi = htmlspecialchars(strip_tags($this->ChinhSuaLanCuoiBoi));
            $stmt->bindParam(':MaBaoGia', $this->MaBaoGia); 
            
            // Bind data
            $stmt->bindParam(':TrangThaiBaoGia', $this->TrangThaiBaoGia);
            $stmt->bindParam(':ChinhSuaLanCuoiVaoLuc', $this->ChinhSuaLanCuoiVaoLuc);
            $stmt->bindParam(':ChinhSuaLanCuoiBoi', $this->ChinhSuaLanCuoiBoi);
            $stmt->bindParam(':MaBaoGia', $this->MaBaoGia);
            
            // Execute query
            if($stmt->execute()) {
                return true;
            }
            
            // Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);
            
            return false;
        } catch (PDOException $e) {
            // Handle database errors
            echo json_encode(array("error" => $e->getMessage()));
        }
    }
    
}
?>