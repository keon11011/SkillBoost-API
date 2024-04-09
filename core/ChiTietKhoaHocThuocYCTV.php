<?php
    class ChiTietKhoaHocThuocYCTV{
        private $conn;
        private $table = 'chitietkhoahocthuocyctv';

        public $MaTuVan;
        public $MaKhoaHoc;
        public $TenKhoaHoc;
        public $GiangVien;
        public $HocPhi;

        public function __construct($db) {
            $this->conn = $db;
        }

        public function create() {
            // Create query
            $query = 'INSERT INTO ' . $this->table . ' 
                      SET 
                        MaTuVan = :MaTuVan,
                        MaKhoaHoc = :MaKhoaHoc,
                        TenKhoaHoc = :TenKhoaHoc,
                        GiangVien = :GiangVien,
                        HocPhi = :HocPhi';
        
            // Prepare statement
            $stmt = $this->conn->prepare($query);
        
            // Clean data
            $this->MaTuVan = htmlspecialchars(strip_tags($this->MaTuVan));
            $this->MaKhoaHoc = htmlspecialchars(strip_tags($this->MaKhoaHoc));
            $this->TenKhoaHoc = htmlspecialchars(strip_tags($this->TenKhoaHoc));
            $this->GiangVien = htmlspecialchars(strip_tags($this->GiangVien));
            $this->HocPhi = htmlspecialchars(strip_tags($this->HocPhi));
        
            // Bind data
            $stmt->bindParam(':MaTuVan', $this->MaTuVan);
            $stmt->bindParam(':MaKhoaHoc', $this->MaKhoaHoc);
            $stmt->bindParam(':TenKhoaHoc', $this->TenKhoaHoc);
            $stmt->bindParam(':GiangVien', $this->GiangVien);
            $stmt->bindParam(':HocPhi', $this->HocPhi);
        
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
            $query = "DELETE FROM " . $this->table . " WHERE MaTuVan = :MaTuVan";
            
            // Prepare statement
            $stmt = $this->conn->prepare($query);
            
            // Clean data
            $this->MaTuVan = htmlspecialchars(strip_tags($this->MaTuVan));
            
            // Bind data
            $stmt->bindParam(':MaTuVan', $this->MaTuVan);
            
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