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
    public $PhamTramGiamGIa;
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
                $this->PhamTramGiamGIa = $row['PhamTramGiamGIa'];
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
    
    
}
?>