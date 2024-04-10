<?php
class MaGiamGia{
    private $conn;
    private $table = 'magiamgia';

    public $MaGiamGia;
    public $MoTaMaGiamGia;
    public $PhamViApDung;
    public $PhanTramGiamGia;
    public $TrangThaiMaGiamGia;
    public $MaQuyDinhGiamGia;
    public $TaoVaoLuc;
    public $TaoBoi;
    public $ChinhSuaLanCuoiVaoLuc;
    public $ChinhSuaLanCuoiBoi;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read_new(){
        // Define the query
        $query = "SELECT MaGiamGia FROM " . $this->table . " ORDER BY MaGiamGia DESC LIMIT 1";
    
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
                  MoTaMaGiamGia = :MoTaMaGiamGia,
                  PhamViApDung = :PhamViApDung,
                  PhanTramGiamGia = :PhanTramGiamGia,
                  TrangThaiMaGiamGia = :TrangThaiMaGiamGia,
                  MaQuyDinhGiamGia = :MaQuyDinhGiamGia,
                  TaoVaoLuc = :TaoVaoLuc,
                  TaoBoi = :TaoBoi,
                  ChinhSuaLanCuoiVaoLuc = :ChinhSuaLanCuoiVaoLuc,
                  ChinhSuaLanCuoiBoi = :ChinhSuaLanCuoiBoi";
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);
        
        // Clean data
        $this->MoTaMaGiamGia = htmlspecialchars(strip_tags($this->MoTaMaGiamGia));
        $this->PhamViApDung = htmlspecialchars(strip_tags($this->PhamViApDung));
        $this->PhanTramGiamGia = htmlspecialchars(strip_tags($this->PhanTramGiamGia));
        $this->TrangThaiMaGiamGia = htmlspecialchars(strip_tags($this->TrangThaiMaGiamGia));
        $this->MaQuyDinhGiamGia = htmlspecialchars(strip_tags($this->MaQuyDinhGiamGia));
        //$this->TaoVaoLuc = htmlspecialchars(strip_tags($this->TaoVaoLuc));
        $this->TaoBoi = htmlspecialchars(strip_tags($this->TaoBoi));
        //$this->ChinhSuaLanCuoiVaoLuc = htmlspecialchars(strip_tags($this->ChinhSuaLanCuoiVaoLuc));
        $this->ChinhSuaLanCuoiBoi = htmlspecialchars(strip_tags($this->ChinhSuaLanCuoiBoi));
        
        // Bind data
        $stmt->bindParam(':MoTaMaGiamGia', $this->MoTaMaGiamGia);
        $stmt->bindParam(':PhamViApDung', $this->PhamViApDung);
        $stmt->bindParam(':PhanTramGiamGia', $this->PhanTramGiamGia);
        $stmt->bindParam(':TrangThaiMaGiamGia', $this->TrangThaiMaGiamGia);
        $stmt->bindParam(':MaQuyDinhGiamGia', $this->MaQuyDinhGiamGia);
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