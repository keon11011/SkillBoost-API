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

    public function read_khoahoc_in_baogia(){
        $query = "
                    SELECT * 
                    FROM " . $this->table . "
                    WHERE MaKhoaHoc IN (
                        SELECT MaKhoaHoc 
                        FROM chitietkhoahocthuocbaogia 
                        WHERE MaBaoGia IN (
                            SELECT MaBaoGia 
                            FROM baogia 
                            WHERE MaLead = :MaLead
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

    public function create() {
        // Define the query
        $query = "INSERT INTO " . $this->table . "
                  SET
                  TenKhoaHoc = :TenKhoaHoc,
                  MoTaNgan = :MoTaNgan,
                  MoTaDai = :MoTaDai,
                  ThoiLuongKhoaHoc = :ThoiLuongKhoaHoc,
                  SoBaiViet = :SoBaiViet,
                  SoFileTaiXuong = :SoFileTaiXuong,
                  GiangVien = :GiangVien,
                  MucDoKhoaHoc = :MucDoKhoaHoc,
                  LuotDanhGia = :LuotDanhGia,
                  SoLuongHocVienToiDa = :SoLuongHocVienToiDa,
                  SoLuongHocVienConLai = :SoLuongHocVienConLai,
                  GiaTien = :GiaTien,
                  NgayKhaiGiang = :NgayKhaiGiang,
                  NgayBeGiang = :NgayBeGiang,
                  DanhGiaKhoaHoc = :DanhGiaKhoaHoc,
                  TrangThaiKhoaHoc = :TrangThaiKhoaHoc,
                  MaLoaiKhoaHoc = :MaLoaiKhoaHoc,
                  TaoVaoLuc = :TaoVaoLuc,
                  TaoBoi = :TaoBoi,
                  ChinhSuaLanCuoiVaoLuc = :ChinhSuaLanCuoiVaoLuc,
                  ChinhSuaLanCuoiBoi = :ChinhSuaLanCuoiBoi";
    
        // Prepare the query statement
        $stmt = $this->conn->prepare($query);
    
        // Clean data
        $this->TenKhoaHoc = htmlspecialchars(strip_tags($this->TenKhoaHoc));
        $this->MoTaNgan = htmlspecialchars(strip_tags($this->MoTaNgan));
        if ($this->MoTaDai !== null) {
            $this->MoTaDai = htmlspecialchars(strip_tags($this->MoTaDai));
        }
        if ($this->ThoiLuongKhoaHoc !== null) {
            $this->ThoiLuongKhoaHoc = htmlspecialchars(strip_tags($this->ThoiLuongKhoaHoc));
        }
        if ($this->SoBaiViet !== null) {
            $this->SoBaiViet = htmlspecialchars(strip_tags($this->SoBaiViet));
        }
        if ($this->SoFileTaiXuong !== null) {
            $this->SoFileTaiXuong = htmlspecialchars(strip_tags($this->SoFileTaiXuong));
        }
        $this->GiangVien = htmlspecialchars(strip_tags($this->GiangVien));
        if ($this->MucDoKhoaHoc !== null) {
            $this->MucDoKhoaHoc = htmlspecialchars(strip_tags($this->MucDoKhoaHoc));
        }
        $this->LuotDanhGia = htmlspecialchars(strip_tags($this->LuotDanhGia));
        $this->SoLuongHocVienToiDa = htmlspecialchars(strip_tags($this->SoLuongHocVienToiDa));
        if ($this->SoLuongHocVienConLai !== null) {
            $this->SoLuongHocVienConLai = htmlspecialchars(strip_tags($this->SoLuongHocVienConLai));
        }
        $this->GiaTien = htmlspecialchars(strip_tags($this->GiaTien));
        $this->NgayKhaiGiang = htmlspecialchars(strip_tags($this->NgayKhaiGiang));
        $this->NgayBeGiang = htmlspecialchars(strip_tags($this->NgayBeGiang));
        $this->DanhGiaKhoaHoc = htmlspecialchars(strip_tags($this->DanhGiaKhoaHoc));
        $this->TrangThaiKhoaHoc = htmlspecialchars(strip_tags($this->TrangThaiKhoaHoc));
        $this->MaLoaiKhoaHoc = htmlspecialchars(strip_tags($this->MaLoaiKhoaHoc));
        $this->TaoBoi = htmlspecialchars(strip_tags($this->TaoBoi));
        $this->ChinhSuaLanCuoiBoi = htmlspecialchars(strip_tags($this->ChinhSuaLanCuoiBoi));
    
        // Bind parameters
        $stmt->bindParam(':TenKhoaHoc', $this->TenKhoaHoc);
        $stmt->bindParam(':MoTaNgan', $this->MoTaNgan);
        $stmt->bindParam(':MoTaDai', $this->MoTaDai);
        $stmt->bindParam(':ThoiLuongKhoaHoc', $this->ThoiLuongKhoaHoc);
        $stmt->bindParam(':SoBaiViet', $this->SoBaiViet);
        $stmt->bindParam(':SoFileTaiXuong', $this->SoFileTaiXuong);
        $stmt->bindParam(':GiangVien', $this->GiangVien);
        $stmt->bindParam(':MucDoKhoaHoc', $this->MucDoKhoaHoc);
        $stmt->bindParam(':LuotDanhGia', $this->LuotDanhGia);
        $stmt->bindParam(':SoLuongHocVienToiDa', $this->SoLuongHocVienToiDa);
        $stmt->bindParam(':SoLuongHocVienConLai', $this->SoLuongHocVienConLai);
        $stmt->bindParam(':GiaTien', $this->GiaTien);
        $stmt->bindParam(':NgayKhaiGiang', $this->NgayKhaiGiang);
        $stmt->bindParam(':NgayBeGiang', $this->NgayBeGiang);
        $stmt->bindParam(':DanhGiaKhoaHoc', $this->DanhGiaKhoaHoc);
        $stmt->bindParam(':TrangThaiKhoaHoc', $this->TrangThaiKhoaHoc);
        $stmt->bindParam(':MaLoaiKhoaHoc', $this->MaLoaiKhoaHoc);
        $stmt->bindParam(':TaoVaoLuc', $this->TaoVaoLuc);
        $stmt->bindParam(':TaoBoi', $this->TaoBoi);
        $stmt->bindParam(':ChinhSuaLanCuoiVaoLuc', $this->ChinhSuaLanCuoiVaoLuc);
        $stmt->bindParam(':ChinhSuaLanCuoiBoi', $this->ChinhSuaLanCuoiBoi);
    
        // Execute the query
        if ($stmt->execute()) {
            return true;
        }
    
        // Print an error message if the query fails
        printf("Error: %s.\n", $stmt->errorInfo()[2]);
        return false;
    }

    public function update() {
        // Create the query for updating a KhoaHoc record
        $query = "UPDATE " . $this->table . "
                  SET
                    TenKhoaHoc = :TenKhoaHoc,
                    MoTaNgan = :MoTaNgan,
                    MoTaDai = :MoTaDai,
                    ThoiLuongKhoaHoc = :ThoiLuongKhoaHoc,
                    SoBaiViet = :SoBaiViet,
                    SoFileTaiXuong = :SoFileTaiXuong,
                    GiangVien = :GiangVien,
                    MucDoKhoaHoc = :MucDoKhoaHoc,
                    LuotDanhGia = :LuotDanhGia,
                    SoLuongHocVienToiDa = :SoLuongHocVienToiDa,
                    SoLuongHocVienConLai = :SoLuongHocVienConLai,
                    GiaTien = :GiaTien,
                    NgayKhaiGiang = :NgayKhaiGiang,
                    NgayBeGiang = :NgayBeGiang,
                    DanhGiaKhoaHoc = :DanhGiaKhoaHoc,
                    TrangThaiKhoaHoc = :TrangThaiKhoaHoc,
                    MaLoaiKhoaHoc = :MaLoaiKhoaHoc,
                    ChinhSuaLanCuoiVaoLuc = :ChinhSuaLanCuoiVaoLuc,
                    ChinhSuaLanCuoiBoi = :ChinhSuaLanCuoiBoi
                  WHERE
                    MaKhoaHoc = :MaKhoaHoc";
    
        // Prepare the statement
        $stmt = $this->conn->prepare($query);
    
        // Clean data
        $this->TenKhoaHoc = htmlspecialchars(strip_tags($this->TenKhoaHoc));
        $this->MoTaNgan = htmlspecialchars(strip_tags($this->MoTaNgan));
        if ($this->MoTaDai !== null) {
            $this->MoTaDai = htmlspecialchars(strip_tags($this->MoTaDai));
        }
        if ($this->ThoiLuongKhoaHoc !== null) {
            $this->ThoiLuongKhoaHoc = htmlspecialchars(strip_tags($this->ThoiLuongKhoaHoc));
        }
        if ($this->SoBaiViet !== null) {
            $this->SoBaiViet = htmlspecialchars(strip_tags($this->SoBaiViet));
        }
        if ($this->SoFileTaiXuong !== null) {
            $this->SoFileTaiXuong = htmlspecialchars(strip_tags($this->SoFileTaiXuong));
        }
        $this->GiangVien = htmlspecialchars(strip_tags($this->GiangVien));
        if ($this->MucDoKhoaHoc !== null) {
            $this->MucDoKhoaHoc = htmlspecialchars(strip_tags($this->MucDoKhoaHoc));
        }
        $this->LuotDanhGia = htmlspecialchars(strip_tags($this->LuotDanhGia));
        $this->SoLuongHocVienToiDa = htmlspecialchars(strip_tags($this->SoLuongHocVienToiDa));
        if ($this->SoLuongHocVienConLai !== null) {
            $this->SoLuongHocVienConLai = htmlspecialchars(strip_tags($this->SoLuongHocVienConLai));
        }
        $this->GiaTien = htmlspecialchars(strip_tags($this->GiaTien));
        $this->NgayKhaiGiang = htmlspecialchars(strip_tags($this->NgayKhaiGiang));
        $this->NgayBeGiang = htmlspecialchars(strip_tags($this->NgayBeGiang));
        $this->DanhGiaKhoaHoc = htmlspecialchars(strip_tags($this->DanhGiaKhoaHoc));
        $this->TrangThaiKhoaHoc = htmlspecialchars(strip_tags($this->TrangThaiKhoaHoc));
        $this->MaLoaiKhoaHoc = htmlspecialchars(strip_tags($this->MaLoaiKhoaHoc));
        $this->ChinhSuaLanCuoiBoi = htmlspecialchars(strip_tags($this->ChinhSuaLanCuoiBoi));
        $this->MaKhoaHoc = htmlspecialchars(strip_tags($this->MaKhoaHoc));
    
        // Bind data to statement parameters
        $stmt->bindParam(':TenKhoaHoc', $this->TenKhoaHoc);
        $stmt->bindParam(':MoTaNgan', $this->MoTaNgan);
        $stmt->bindParam(':MoTaDai', $this->MoTaDai);
        $stmt->bindParam(':ThoiLuongKhoaHoc', $this->ThoiLuongKhoaHoc);
        $stmt->bindParam(':SoBaiViet', $this->SoBaiViet);
        $stmt->bindParam(':SoFileTaiXuong', $this->SoFileTaiXuong);
        $stmt->bindParam(':GiangVien', $this->GiangVien);
        $stmt->bindParam(':MucDoKhoaHoc', $this->MucDoKhoaHoc);
        $stmt->bindParam(':LuotDanhGia', $this->LuotDanhGia);
        $stmt->bindParam(':SoLuongHocVienToiDa', $this->SoLuongHocVienToiDa);
        $stmt->bindParam(':SoLuongHocVienConLai', $this->SoLuongHocVienConLai);
        $stmt->bindParam(':GiaTien', $this->GiaTien);
        $stmt->bindParam(':NgayKhaiGiang', $this->NgayKhaiGiang);
        $stmt->bindParam(':NgayBeGiang', $this->NgayBeGiang);
        $stmt->bindParam(':DanhGiaKhoaHoc', $this->DanhGiaKhoaHoc);
        $stmt->bindParam(':TrangThaiKhoaHoc', $this->TrangThaiKhoaHoc);
        $stmt->bindParam(':MaLoaiKhoaHoc', $this->MaLoaiKhoaHoc);
        $stmt->bindParam(':ChinhSuaLanCuoiVaoLuc', $this->ChinhSuaLanCuoiVaoLuc);
        $stmt->bindParam(':ChinhSuaLanCuoiBoi', $this->ChinhSuaLanCuoiBoi);
        $stmt->bindParam(':MaKhoaHoc', $this->MaKhoaHoc);
        
        // Execute query
        if ($stmt->execute()) {
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
                    TrangThaiKhoaHoc = :TrangThaiKhoaHoc,
                    ChinhSuaLanCuoiVaoLuc = :ChinhSuaLanCuoiVaoLuc,
                    ChinhSuaLanCuoiBoi = :ChinhSuaLanCuoiBoi
                  WHERE
                    MaKhoaHoc = :MaKhoaHoc";
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);
    
        // Clean data
        $this->TrangThaiKhoaHoc = htmlspecialchars(strip_tags($this->TrangThaiKhoaHoc));
        $this->ChinhSuaLanCuoiVaoLuc = date('Y-m-d H:i:s');
        $this->ChinhSuaLanCuoiBoi = htmlspecialchars(strip_tags($this->ChinhSuaLanCuoiBoi));
        $this->MaKhoaHoc = htmlspecialchars(strip_tags($this->MaKhoaHoc));
    
        // Bind data
        $stmt->bindParam(':TrangThaiKhoaHoc', $this->TrangThaiKhoaHoc);
        $stmt->bindParam(':ChinhSuaLanCuoiVaoLuc', $this->ChinhSuaLanCuoiVaoLuc);
        $stmt->bindParam(':ChinhSuaLanCuoiBoi', $this->ChinhSuaLanCuoiBoi);
        $stmt->bindParam(':MaKhoaHoc', $this->MaKhoaHoc);
    
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