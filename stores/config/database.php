<?php
class Database {
    private $host = "localhost";   // server database
    private $db_name = "n1_webbandienthoai_wd20302"; // tên database của bạn
    private $username = "root";    // user MySQL
    private $password = "bao20042006";        // password MySQL
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password
            );
            // Thiết lập PDO lỗi ra Exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            echo "Lỗi kết nối: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
