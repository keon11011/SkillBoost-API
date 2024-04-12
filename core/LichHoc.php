<?php
class LichHoc{
    private $conn;
    private $table = 'lichhoc';

    public $ID;
    public $MaKhoaHoc;
    public $ThuTrongTuan;
    public $ThoiGianBatDauBuoiHoc;
    public $ThoiGianKetThucBuoiHoc;
    public $TaoVaoLuc;
    public $TaoBoi;
    public $ChinhSuaLanCuoiVaoLuc;
    public $ChinhSuaLanCuoiBoi;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read_lichhoc_khoahoc(){
        try {
            $query = "SELECT * FROM " . $this->table . " WHERE MaKhoaHoc = :MaKhoaHoc";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':MaKhoaHoc', $this->MaKhoaHoc);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            // Handle database errors
            echo json_encode(array("error" => $e->getMessage()));
        }
    }

    public function create() {
        // Define the query
        $query = "INSERT INTO " . $this->table . "
                  SET
                    MaKhoaHoc = :MaKhoaHoc,
                    ThuTrongTuan = :ThuTrongTuan,
                    ThoiGianBatDauBuoiHoc = :ThoiGianBatDauBuoiHoc,
                    ThoiGianKetThucBuoiHoc = :ThoiGianKetThucBuoiHoc,
                    TaoVaoLuc = :TaoVaoLuc,
                    TaoBoi = :TaoBoi,
                    ChinhSuaLanCuoiVaoLuc = :ChinhSuaLanCuoiVaoLuc,
                    ChinhSuaLanCuoiBoi = :ChinhSuaLanCuoiBoi";
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);
        
        // Clean data
        $this->MaKhoaHoc = htmlspecialchars(strip_tags($this->MaKhoaHoc));
        $this->ThuTrongTuan = htmlspecialchars(strip_tags($this->ThuTrongTuan));
        $this->ThoiGianBatDauBuoiHoc = date('H:i', strtotime($this->ThoiGianBatDauBuoiHoc));
        $this->ThoiGianKetThucBuoiHoc = date('H:i', strtotime($this->ThoiGianKetThucBuoiHoc));
        $this->TaoBoi = htmlspecialchars(strip_tags($this->TaoBoi));
        $this->ChinhSuaLanCuoiBoi = htmlspecialchars(strip_tags($this->ChinhSuaLanCuoiBoi));
        
        // Bind data
        $stmt->bindParam(':MaKhoaHoc', $this->MaKhoaHoc);
        $stmt->bindParam(':ThuTrongTuan', $this->ThuTrongTuan);
        $stmt->bindParam(':ThoiGianBatDauBuoiHoc', $this->ThoiGianBatDauBuoiHoc);
        $stmt->bindParam(':ThoiGianKetThucBuoiHoc', $this->ThoiGianKetThucBuoiHoc);
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

    public function update() {
        // Define the query to update a LichHoc record
        $query = "UPDATE " . $this->table . " 
                  SET
                    MaKhoaHoc = :MaKhoaHoc,
                    ThuTrongTuan = :ThuTrongTuan,
                    ThoiGianBatDauBuoiHoc = :ThoiGianBatDauBuoiHoc,
                    ThoiGianKetThucBuoiHoc = :ThoiGianKetThucBuoiHoc,
                    ChinhSuaLanCuoiVaoLuc = :ChinhSuaLanCuoiVaoLuc,
                    ChinhSuaLanCuoiBoi = :ChinhSuaLanCuoiBoi
                  WHERE ID = :ID";
    
        // Prepare the statement
        $stmt = $this->conn->prepare($query);
    
        // Clean data to avoid any SQL injection attacks
        $this->MaKhoaHoc = htmlspecialchars(strip_tags($this->MaKhoaHoc));
        $this->ThuTrongTuan = htmlspecialchars(strip_tags($this->ThuTrongTuan));
        $this->ThoiGianBatDauBuoiHoc = date('H:i', strtotime($this->ThoiGianBatDauBuoiHoc));
        $this->ThoiGianKetThucBuoiHoc = date('H:i', strtotime($this->ThoiGianKetThucBuoiHoc));
        $this->ChinhSuaLanCuoiBoi = htmlspecialchars(strip_tags($this->ChinhSuaLanCuoiBoi));
        $this->ID = htmlspecialchars(strip_tags($this->ID));
    
        // Bind data to the query parameters
        $stmt->bindParam(':MaKhoaHoc', $this->MaKhoaHoc);
        $stmt->bindParam(':ThuTrongTuan', $this->ThuTrongTuan);
        $stmt->bindParam(':ThoiGianBatDauBuoiHoc', $this->ThoiGianBatDauBuoiHoc);
        $stmt->bindParam(':ThoiGianKetThucBuoiHoc', $this->ThoiGianKetThucBuoiHoc);
        $stmt->bindParam(':ChinhSuaLanCuoiVaoLuc', $this->ChinhSuaLanCuoiVaoLuc);
        $stmt->bindParam(':ChinhSuaLanCuoiBoi', $this->ChinhSuaLanCuoiBoi);
        $stmt->bindParam(':ID', $this->ID);
    
        // Execute the query and check for success
        if ($stmt->execute()) {
            return true;
        } else {
            // Print the error message if something goes wrong
            printf("Error: %s.\n", $stmt->errorInfo()[2]);
            return false;
        }
    }
    
    
}
?>