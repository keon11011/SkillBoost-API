<?php
class YeuCauTuVan {
    private $conn;
    private $table = 'yeucautuvan';

    public $MaTuVan;
    public $TenLeadYeuCau;
    public $NgaySinhLeadYeuCau;
    public $EmailLeadYeuCau;
    public $SDTLeadYeuCau;
    public $GhiChuYCTV;
    public $TrangThaiYCTV;
    public $TaoVaoLuc;
    public $TaoBoiLead;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read_new(){
        // Define the query
        $query = "SELECT MaTuVan FROM " . $this->table . " ORDER BY MaTuVan DESC LIMIT 1";
    
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
        // Create query
        $query = 'INSERT INTO ' . $this->table . ' 
                  SET 
                    TenLeadYeuCau = :TenLeadYeuCau,
                    NgaySinhLeadYeuCau = :NgaySinhLeadYeuCau,
                    EmailLeadYeuCau = :EmailLeadYeuCau,
                    SDTLeadYeuCau = :SDTLeadYeuCau,
                    GhiChuYCTV = :GhiChuYCTV,
                    TrangThaiYCTV = :TrangThaiYCTV,
                    TaoVaoLuc = :TaoVaoLuc,
                    TaoBoiLead = :TaoBoiLead';
    
        // Prepare statement
        $stmt = $this->conn->prepare($query);
    
        // Clean data
        $this->TenLeadYeuCau = htmlspecialchars(strip_tags($this->TenLeadYeuCau));
        $this->NgaySinhLeadYeuCau = htmlspecialchars(strip_tags($this->NgaySinhLeadYeuCau));
        $this->EmailLeadYeuCau = htmlspecialchars(strip_tags($this->EmailLeadYeuCau));
        $this->SDTLeadYeuCau = htmlspecialchars(strip_tags($this->SDTLeadYeuCau));
        $this->GhiChuYCTV = htmlspecialchars(strip_tags($this->GhiChuYCTV));
        $this->TrangThaiYCTV = htmlspecialchars(strip_tags($this->TrangThaiYCTV));
        //$this->TaoVaoLuc = date('Y-m-d H:i:s', strtotime($this->TaoVaoLuc));
        $this->TaoBoiLead = htmlspecialchars(strip_tags($this->TaoBoiLead));
    
        // Bind data
        $stmt->bindParam(':TenLeadYeuCau', $this->TenLeadYeuCau);
        $stmt->bindParam(':NgaySinhLeadYeuCau', $this->NgaySinhLeadYeuCau);
        $stmt->bindParam(':EmailLeadYeuCau', $this->EmailLeadYeuCau);
        $stmt->bindParam(':SDTLeadYeuCau', $this->SDTLeadYeuCau);
        $stmt->bindParam(':GhiChuYCTV', $this->GhiChuYCTV);
        $stmt->bindParam(':TrangThaiYCTV', $this->TrangThaiYCTV);
        $stmt->bindParam(':TaoVaoLuc', $this->TaoVaoLuc);
        $stmt->bindParam(':TaoBoiLead', $this->TaoBoiLead);
    
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
