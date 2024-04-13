<?php
    class TaiKhoan{
        private $conn;
        private $table = 'taikhoan';

        public $MaTK;
        public $EmailTK;
        public $MatKhauTK;
        public $MaSaltTK;
        public $TrangThaiTK;
        public $MaNV;
        public $TaoVaoLuc;
        public $TaoBoi;
        public $ChinhSuaLanCuoiVaoLuc;
        public $ChinhSuaLanCuoiBoi;

        public function __construct($db) {
            $this->conn = $db;
        }

        // public function validate($email, $password) {
        //     try {
        //         // Kiểm tra có tồn tại tài khoản hay không
        //         $stmt_count = $this->conn->prepare("SELECT COUNT(*) AS count FROM TAIKHOAN WHERE EmailTK = ?");
        //         $stmt_count->execute([$email]);
        //         $row_count = $stmt_count->fetch(PDO::FETCH_ASSOC);
        //         $KtrTonTai = $row_count['count'];
        
        //         // Lấy trạng thái tài khoản và MaNV
        //         $stmt_trang_thai = $this->conn->prepare("SELECT TrangThaiTK, MaNV FROM TAIKHOAN WHERE EmailTK = ?");
        //         $stmt_trang_thai->execute([$email]);
        //         $row_trang_thai = $stmt_trang_thai->fetch(PDO::FETCH_ASSOC);
        //         $TrangThaiTK = $row_trang_thai['TrangThaiTK'];
        //         $MaNV = $row_trang_thai['MaNV'];
        
        //         // Nhập biến MKNhapVao
        //         $MKNhapVao = $password;
        
        //         // Hash MKNhapVao với MaSaltTK
        //         $stmt_hash = $this->conn->prepare("SELECT SHA2(CONCAT(?, MaSaltTK), 256) AS MaHashMKNhapVao FROM TAIKHOAN WHERE EmailTK = ?");
        //         $stmt_hash->execute([$MKNhapVao, $email]);
        //         $row_hash = $stmt_hash->fetch(PDO::FETCH_ASSOC);
        //         $MaHashMKNhapVao = $row_hash['MaHashMKNhapVao'];
        
        //         // Lấy MatKhauTK
        //         $stmt_mat_khau = $this->conn->prepare("SELECT MatKhauTK FROM TAIKHOAN WHERE EmailTK = ?");
        //         $stmt_mat_khau->execute([$email]);
        //         $MKHash = $stmt_mat_khau->fetchColumn();
        
        //         // Kiểm tra các điều kiện và trả về kết quả
        //         $result = ($KtrTonTai == 1 && $TrangThaiTK == 'Đang hoạt động' && $MaHashMKNhapVao === $MKHash) ? true : false;
        
        //         return array('valid' => $result, 'MaNV' => $MaNV);
        //     } catch(PDOException $e) {
        //         // Handle database connection errors
        //         echo "Connection failed: " . $e->getMessage();
        //         return array('valid' => false, 'MaNV' => null);
        //     }
        // }   
        
        public function validate($email, $password) {
            try {
                // Join TaiKhoan and NhanVien on MaNV
                $stmt = $this->conn->prepare("
                    SELECT 
                        tk.TrangThaiTK, 
                        tk.MaNV, 
                        nv.HoTenNV, 
                        nv.ChucVu,
                        tk.MatKhauTK,
                        SHA2(CONCAT(?, tk.MaSaltTK), 256) AS MaHashMKNhapVao
                    FROM TAIKHOAN tk
                    JOIN NHANVIEN nv ON tk.MaNV = nv.MaNV
                    WHERE tk.EmailTK = ?
                ");
                $stmt->execute([$password, $email]);
                
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
                if ($result) {
                    // Check if the user is valid
                    $isValid = $result['TrangThaiTK'] === 'Đang hoạt động' && $result['MaHashMKNhapVao'] === $result['MatKhauTK'];
                    
                    return array(
                        'valid' => $isValid,
                        'MaNV' => $result['MaNV'],
                        'HoTenNV' => $result['HoTenNV'],
                        'ChucVu' => $result['ChucVu']
                    );
                } else {
                    // If no matching record found
                    return array('valid' => false, 'MaNV' => null, 'HoTenNV' => null, 'ChucVu' => null);
                }
            } catch (PDOException $e) {
                // Handle database connection errors
                echo "Connection failed: " . $e->getMessage();
                return array('valid' => false, 'MaNV' => null, 'HoTenNV' => null, 'ChucVu' => null);
            }
        }
        
    }
?>