<?php
/**
 * Class Patient
 * Kelas untuk manajemen data pasien
 */

class Patient {
    // Koneksi database dan nama tabel
    private $conn;
    private $table_name = "patients";

    // Property objek
    public $id;
    public $name;
    public $birthdate;
    public $gender;
    public $address;

    // Constructor
    public function __construct($db) {
        $this->conn = $db;
    }

    // Mendapatkan semua data pasien
    public function getAll() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY name";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // Mendapatkan data pasien berdasarkan ID
    public function getById() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row) {
            $this->name = $row['name'];
            $this->birthdate = $row['birthdate'];
            $this->gender = $row['gender'];
            $this->address = $row['address'];
            return true;
        }
        
        return false;
    }

    // Membuat data pasien baru
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (name, birthdate, gender, address) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        // Sanitasi input
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->birthdate = htmlspecialchars(strip_tags($this->birthdate));
        $this->gender = htmlspecialchars(strip_tags($this->gender));
        $this->address = htmlspecialchars(strip_tags($this->address));

        // Binding parameter
        $stmt->bindParam(1, $this->name);
        $stmt->bindParam(2, $this->birthdate);
        $stmt->bindParam(3, $this->gender);
        $stmt->bindParam(4, $this->address);

        // Eksekusi query
        if($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Memperbarui data pasien
    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET name = ?, birthdate = ?, gender = ?, address = ? 
                  WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        // Sanitasi input
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->birthdate = htmlspecialchars(strip_tags($this->birthdate));
        $this->gender = htmlspecialchars(strip_tags($this->gender));
        $this->address = htmlspecialchars(strip_tags($this->address));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Binding parameter
        $stmt->bindParam(1, $this->name);
        $stmt->bindParam(2, $this->birthdate);
        $stmt->bindParam(3, $this->gender);
        $stmt->bindParam(4, $this->address);
        $stmt->bindParam(5, $this->id);

        // Eksekusi query
        if($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Menghapus data pasien
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