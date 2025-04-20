<?php
/**
 * Konfigurasi Database
 * File ini berisi konfigurasi untuk koneksi database sistem manajemen klinik
 */

class Database {
    // Kredensial database
    private $host = "localhost";
    private $db_name = "db_clinic";
    private $username = "root";
    private $password = "";
    public $conn;

    // Method untuk mendapatkan koneksi database
    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>