<?php
/**
 * Class Doctor
 * Kelas untuk manajemen data dokter
 */

class Doctor {
    // Koneksi database dan nama tabel
    private $conn;
    private $table_name = "doctors";

    // Property objek
    public $id;
    public $name;
    public $specialization;
    public $phone;

    // Constructor
    public function __construct($db) {
        $this->conn = $db;
    }

    // Mendapatkan semua data dokter
    public function getAll() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY name";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // Mendapatkan data dokter berdasarkan ID
    public function getById() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row) {
            $this->name = $row['name'];
            $this->specialization = $row['specialization'];
            $this->phone = $row['phone'];
            return true;
        }
        
        return false;
    }

    // Membuat data dokter baru
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (name, specialization, phone) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        // Sanitasi input
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->specialization = htmlspecialchars(strip_tags($this->specialization));
        $this->phone = htmlspecialchars(strip_tags($this->phone));

        // Binding parameter
        $stmt->bindParam(1, $this->name);
        $stmt->bindParam(2, $this->specialization);
        $stmt->bindParam(3, $this->phone);

        // Eksekusi query
        if($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Memperbarui data dokter
    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET name = ?, specialization = ?, phone = ? 
                  WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        // Sanitasi input
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->specialization = htmlspecialchars(strip_tags($this->specialization));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Binding parameter
        $stmt->bindParam(1, $this->name);
        $stmt->bindParam(2, $this->specialization);
        $stmt->bindParam(3, $this->phone);
        $stmt->bindParam(4, $this->id);

        // Eksekusi query
        if($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Menghapus data dokter
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        // Sanitasi input
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Binding parameter
        $stmt->bindParam(1, $this->id);

        // Eksekusi query
        if($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>