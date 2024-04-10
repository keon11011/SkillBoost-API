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

        public function validate($email, $password) {
            try {
                // Kiểm tra có tồn tại tài khoản hay không
                $stmt_count = $this->conn->prepare("SELECT COUNT(*) AS count FROM TAIKHOAN WHERE EmailTK = ?");
                $stmt_count->execute([$email]);
                $row_count = $stmt_count->fetch(PDO::FETCH_ASSOC);
                $KtrTonTai = $row_count['count'];
        
                // Lấy trạng thái tài khoản
                $stmt_trang_thai = $this->conn->prepare("SELECT TrangThaiTK FROM TAIKHOAN WHERE EmailTK = ?");
                $stmt_trang_thai->execute([$email]);
                $TrangThaiTK = $stmt_trang_thai->fetchColumn();
        
                // Nhập biến MKNhapVao
                $MKNhapVao = $password;
        
                // Hash MKNhapVao với MaSaltTK
                $stmt_hash = $this->conn->prepare("SELECT SHA2(CONCAT(?, MaSaltTK), 256) AS MaHashMKNhapVao FROM TAIKHOAN WHERE EmailTK = ?");
                $stmt_hash->execute([$MKNhapVao, $email]);
                $row_hash = $stmt_hash->fetch(PDO::FETCH_ASSOC);
                $MaHashMKNhapVao = $row_hash['MaHashMKNhapVao'];
        
                // Lấy MatKhauTK
                $stmt_mat_khau = $this->conn->prepare("SELECT MatKhauTK FROM TAIKHOAN WHERE EmailTK = ?");
                $stmt_mat_khau->execute([$email]);
                $MKHash = $stmt_mat_khau->fetchColumn();
        
                // Kiểm tra các điều kiện và trả về kết quả
                $result = ($KtrTonTai == 1 && $TrangThaiTK == 'Đang hoạt động' && $MaHashMKNhapVao === $MKHash) ? true : false;
        
                return $result;
            } catch(PDOException $e) {
                // Handle database connection errors
                echo "Connection failed: " . $e->getMessage();
                return false;
            }
        }        
    }
?>