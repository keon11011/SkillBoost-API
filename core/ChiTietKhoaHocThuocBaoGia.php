<?php
class ChiTietKhoaHocThuocBaoGia{
    private $conn;
    private $table = 'chitietkhoahocthuocbaogia';

    public $MaBaoGia;
    public $MaKhoaHoc;
    public $TenKhoaHoc;
    public $GiangVien;
    public $GiaTien;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        // Create query
        $query = 'INSERT INTO ' . $this->table . ' 
                  SET 
                    MaBaoGia = :MaBaoGia,
                    MaKhoaHoc = :MaKhoaHoc,
                    TenKhoaHoc = :TenKhoaHoc,
                    GiangVien = :GiangVien,
                    GiaTien = :GiaTien';
    
        // Prepare statement
        $stmt = $this->conn->prepare($query);
    
        // Clean data
        $this->MaBaoGia = htmlspecialchars(strip_tags($this->MaBaoGia));
        $this->MaKhoaHoc = htmlspecialchars(strip_tags($this->MaKhoaHoc));
        $this->TenKhoaHoc = htmlspecialchars(strip_tags($this->TenKhoaHoc));
        $this->GiangVien = htmlspecialchars(strip_tags($this->GiangVien));
        $this->GiaTien = htmlspecialchars(strip_tags($this->GiaTien));
    
        // Bind data
        $stmt->bindParam(':MaBaoGia', $this->MaBaoGia);
        $stmt->bindParam(':MaKhoaHoc', $this->MaKhoaHoc);
        $stmt->bindParam(':TenKhoaHoc', $this->TenKhoaHoc);
        $stmt->bindParam(':GiangVien', $this->GiangVien);
        $stmt->bindParam(':GiaTien', $this->GiaTien);
    
        // Execute query
        if($stmt->execute()) {
            return true;
        }
    
        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);
    
        return false;
    }

    public function update_mabaogia(){
        // Create query
        $query = "UPDATE " . $this->table . "
                  SET
                    MaBaoGia = :MaBaoGia
                  WHERE
                    MaBaoGia = -1";
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);
    
        // Clean data
        $this->MaBaoGia = htmlspecialchars(strip_tags($this->MaBaoGia));
    
        // Bind data
        $stmt->bindParam(':MaBaoGia', $this->MaBaoGia);
    
        // Execute query
        if($stmt->execute()) {
            return true;
        }
      
        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);
    
        return false;
    }

    public function delete() {
        // Create query
        $query = "DELETE FROM " . $this->table . " WHERE MaBaoGia = :MaBaoGia";
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);
        
        // Clean data
        $this->MaBaoGia = htmlspecialchars(strip_tags($this->MaBaoGia));
        
        // Bind data
        $stmt->bindParam(':MaBaoGia', $this->MaBaoGia);
        
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