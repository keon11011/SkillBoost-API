<?php
class Dashboard {
    private $conn;
    
    public function __construct($db) {
        $this->conn = $db;
    }
    
    // Query số lượng
    public function read_count() {
        try {
            // Prepare the queries
            // Query to count total leads
            $query_lead = "SELECT COUNT(MaLead) AS so_luong_lead FROM tbl_lead;";
            $stmt_lead = $this->conn->prepare($query_lead);
            $stmt_lead->execute();
            $result_lead = $stmt_lead->fetch(PDO::FETCH_ASSOC);
            $so_luong_lead = $result_lead['so_luong_lead'];

            // Query to count total customers
            $query_kh = "SELECT COUNT(MaKH) AS so_luong_khach_hang FROM khachhang;";
            $stmt_kh = $this->conn->prepare($query_kh);
            $stmt_kh->execute();
            $result_kh = $stmt_kh->fetch(PDO::FETCH_ASSOC);
            $so_luong_khach_hang = $result_kh['so_luong_khach_hang'];

            // Query to count total courses
            $query_courses = "SELECT COUNT(MaKhoaHoc) AS tong_so_luong_khoa_hoc FROM khoahoc;";
            $stmt_courses = $this->conn->prepare($query_courses);
            $stmt_courses->execute();
            $result_courses = $stmt_courses->fetch(PDO::FETCH_ASSOC);
            $tong_so_luong_khoa_hoc = $result_courses['tong_so_luong_khoa_hoc'];

            // Query to count courses sold
            $query_courses_sold = "SELECT COUNT(MaKhoaHoc) AS so_luong_khoa_hoc_ban_ra
                                  FROM chitietkhoahocthuochoadon;";
            $stmt_courses_sold = $this->conn->prepare($query_courses_sold);
            $stmt_courses_sold->execute();
            $result_courses_sold = $stmt_courses_sold->fetch(PDO::FETCH_ASSOC);
            $so_luong_khoa_hoc_ban_ra = $result_courses_sold['so_luong_khoa_hoc_ban_ra'];

            // Query to count leads created in the last week
            $query_lead_last_week = "SELECT COUNT(MaLead) AS so_luong_lead_last_week
                                     FROM tbl_lead
                                     WHERE TaoVaoLuc >= DATE_SUB(CURRENT_DATE(), INTERVAL 7 DAY);";
            $stmt_lead_last_week = $this->conn->prepare($query_lead_last_week);
            $stmt_lead_last_week->execute();
            $result_lead_last_week = $stmt_lead_last_week->fetch(PDO::FETCH_ASSOC);
            $so_luong_lead_last_week = $result_lead_last_week['so_luong_lead_last_week'];

            // Query to count customers created in the last week
            $query_kh_last_week = "SELECT COUNT(MaKH) AS so_luong_khach_hang_last_week
                                  FROM khachhang
                                  WHERE TaoVaoLuc >= DATE_SUB(CURRENT_DATE(), INTERVAL 7 DAY);";
            $stmt_kh_last_week = $this->conn->prepare($query_kh_last_week);
            $stmt_kh_last_week->execute();
            $result_kh_last_week = $stmt_kh_last_week->fetch(PDO::FETCH_ASSOC);
            $so_luong_khach_hang_last_week = $result_kh_last_week['so_luong_khach_hang_last_week'];

            // Combine all results into a single array
            $results = [
                'so_luong_lead' => $so_luong_lead,
                'so_luong_khach_hang' => $so_luong_khach_hang,
                'tong_so_luong_khoa_hoc' => $tong_so_luong_khoa_hoc,
                'so_luong_khoa_hoc_ban_ra' => $so_luong_khoa_hoc_ban_ra,
                'so_luong_lead_last_week' => $so_luong_lead_last_week,
                'so_luong_khach_hang_last_week' => $so_luong_khach_hang_last_week
            ];

            // Return the results
            return $results;

        } catch (PDOException $e) {
            // Handle database errors
            echo json_encode(array("error" => $e->getMessage()));
        }
    }

    // Số lượng khách hàng trong 7 ngày gần nhất
    public function read_customers_last_7_days() {
        // Define the query to get the count of customers for each of the last 7 days
        $query = "
            SELECT DATE(TaoVaoLuc) AS date, COUNT(MaKH) AS count
            FROM khachhang
            WHERE TaoVaoLuc >= DATE_SUB(CURRENT_DATE(), INTERVAL 7 DAY)
            GROUP BY DATE(TaoVaoLuc)
            ORDER BY DATE(TaoVaoLuc) ASC;
        ";
    
        // Execute the query and get the result set
        $result = $this->conn->query($query);
    
        // Initialize an array to store the results
        $customers_last_7_days = array();
    
        // Fetch data and populate the array
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            // Add each row to the array
            $customers_last_7_days[] = $row;
        }
    
        // Return the array as a JSON object
        echo json_encode($customers_last_7_days);
    }
    
    // Số lượng khách hàng trong 1 năm gần đây (groupby tháng)
    public function read_customers_last_year_group_by_month() {
        // Query to fetch number of customers in the last year grouped by month
        $query = "SELECT DATE_FORMAT(TaoVaoLuc, '%Y-%m') AS month, COUNT(MaKH) AS count
                  FROM khachhang
                  WHERE TaoVaoLuc >= DATE_SUB(CURRENT_DATE(), INTERVAL 1 YEAR)
                  GROUP BY month
                  ORDER BY month";

        // Prepare and execute the query
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        // Fetch all results as an associative array
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Return the results
        return $results;
    }

    // Tỷ lệ phần trăm khách hàng theo nghề nghiệp
    public function read_cus_occ() {
        try {
            // Define the query
            $query = "SELECT
                        n.TenNgheNghiep AS ten_nghe_nghiep,
                        COUNT(*) AS so_luong_khach_hang
                      FROM khachhang AS kh
                      JOIN nghenghiep AS n ON kh.MaNgheNghiep = n.MaNgheNghiep
                      GROUP BY n.TenNgheNghiep
                      ORDER BY so_luong_khach_hang DESC;";
            
            // Prepare and execute the query
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            
            // Fetch all results as an associative array
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Return the results
            return $results;
            
        } catch (PDOException $e) {
            // Handle database errors
            echo json_encode(array("error" => $e->getMessage()));
        }
    }

    // Top khóa học được mua nhiều nhất
    public function read_top_courses() {
        try {
            // Define the query
            $query = "SELECT kh.TenKhoaHoc, SUM(cthd.MaKhoaHoc) AS so_luong_mua
                      FROM khoahoc AS kh
                      JOIN chitietkhoahocthuocyctv AS cthd ON kh.MaKhoaHoc = cthd.MaKhoaHoc
                      GROUP BY kh.MaKhoaHoc
                      ORDER BY so_luong_mua DESC;";
            
            // Prepare and execute the query
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            
            // Fetch all results as an associative array
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Return the results
            return $results;
            
        } catch (PDOException $e) {
            // Handle database errors
            echo json_encode(array("error" => $e->getMessage()));
        }
    }
}

?>