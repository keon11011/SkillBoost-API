<?php
class KhoaHoc{
    private $conn;
    private $table = 'khoahoc';

    public $MaKhoaHoc;
    public $TenKhoaHoc;
    public $MoTaNgan;
    public $MoTaDai;
    public $ThoiLuongKhoaHoc;
    public $SoBaiViet;
    public $SoFileTaiXuong;
    public $GiangVien;
    public $MucDoKhoaHoc;
    public $LuotDanhGia;
    public $SoLuongHocVienToiDa;
    public $SoLuongHocVienConLai;
    public $GiaTien;
    public $NgayKhaiGiang;
    public $NgayBeGiang;
    public $DanhGiaKhoaHoc;
    public $TrangThaiKhoaHoc;
    public $MaLoaiKhoaHoc;
    public $TaoVaoLuc;
    public $TaoBoi;
    public $ChinhSuaLanCuoiVaoLuc;
    public $ChinhSuaLanCuoiBoi;
    public $MaLead;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        try {
            $query = "SELECT * FROM " . $this->table . " WHERE TrangThaiKhoaHoc != 'Xóa mềm'";
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
        $query = "SELECT * FROM " . $this->table . " WHERE MaKhoaHoc = :MaKhoaHoc";
    
        // Prepare the query statement
        $stmt = $this->conn->prepare($query);
    
        // Bind parameter value
        $stmt->bindParam(':MaKhoaHoc', $this->MaKhoaHoc);
    
        // Execute query
        $stmt->execute();
    
        // Fetch the single row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Check if data is fetched
        if ($row) {
            // Set properties with the fetched data
            $this->MaKhoaHoc = $row['MaKhoaHoc'];
            $this->TenKhoaHoc = $row['TenKhoaHoc'];
            $this->MoTaNgan = $row['MoTaNgan'];
            $this->MoTaDai = $row['MoTaDai'];
            $this->ThoiLuongKhoaHoc = $row['ThoiLuongKhoaHoc'];
            $this->SoBaiViet = $row['SoBaiViet'];
            $this->SoFileTaiXuong = $row['SoFileTaiXuong'];
            $this->GiangVien = $row['GiangVien'];
            $this->MucDoKhoaHoc = $row['MucDoKhoaHoc'];
            $this->LuotDanhGia = $row['LuotDanhGia'];
            $this->SoLuongHocVienToiDa = $row['SoLuongHocVienToiDa'];
            $this->SoLuongHocVienConLai = $row['SoLuongHocVienConLai'];
            $this->GiaTien = $row['GiaTien'];
            $this->NgayKhaiGiang = $row['NgayKhaiGiang'];
            $this->NgayBeGiang = $row['NgayBeGiang'];
            $this->DanhGiaKhoaHoc = $row['DanhGiaKhoaHoc'];
            $this->TrangThaiKhoaHoc = $row['TrangThaiKhoaHoc'];
            $this->MaLoaiKhoaHoc = $row['MaLoaiKhoaHoc'];
            $this->TaoVaoLuc = $row['TaoVaoLuc'];
            $this->TaoBoi = $row['TaoBoi'];
            $this->ChinhSuaLanCuoiVaoLuc = $row['ChinhSuaLanCuoiVaoLuc'];
            $this->ChinhSuaLanCuoiBoi = $row['ChinhSuaLanCuoiBoi'];
        }
    
        // Return the fetched user data
        return $row;
    }

    public function read_khoahoc_in_yctv(){
        $query = "
                    SELECT * 
                    FROM " . $this->table . "
                    WHERE MaKhoaHoc IN (
                        SELECT MaKhoaHoc 
                        FROM chitietkhoahocthuocyctv 
                        WHERE MaTuVan IN (
                            SELECT MaTuVan 
                            FROM yeucautuvan 
                            WHERE TaoBoiLead = :MaLead
                        )
                    )
                ";
        
        // Prepare the statement
        $stmt = $this->conn->prepare($query);

        // Bind parameter
        $stmt->bindParam(':MaLead', $this->MaLead);

        // Execute query
        $stmt->execute();

        // Return result set
        return $stmt;
    }
}
?>