<?php
/**
 * Class Appointment
 * Kelas untuk manajemen data janji temu
 */

class Appointment {
    // Koneksi database dan nama tabel
    private $conn;
    private $table_name = "appointments";

    // Property objek
    public $id;
    public $patient_id;
    public $doctor_id;
    public $appointment_date;
    public $status;

    // Constructor
    public function __construct($db) {
        $this->conn = $db;
    }

    // Mendapatkan semua data janji temu beserta detail pasien dan dokter
    public function getAll() {
        $query = "SELECT a.id, a.patient_id, a.doctor_id, a.appointment_date, a.status,
                 p.name as patient_name, d.name as doctor_name, d.specialization
                 FROM " . $this->table_name . " a
                 LEFT JOIN patients p ON a.patient_id = p.id
                 LEFT JOIN doctors d ON a.doctor_id = d.id
                 ORDER BY a.appointment_date DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // Mendapatkan data janji temu berdasarkan ID beserta detail pasien dan dokter
    public function getById() {
        $query = "SELECT a.id, a.patient_id, a.doctor_id, a.appointment_date, a.status,
                 p.name as patient_name, d.name as doctor_name, d.specialization
                 FROM " . $this->table_name . " a
                 LEFT JOIN patients p ON a.patient_id = p.id
                 LEFT JOIN doctors d ON a.doctor_id = d.id
                 WHERE a.id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row) {
            $this->patient_id = $row['patient_id'];
            $this->doctor_id = $row['doctor_id'];
            $this->appointment_date = $row['appointment_date'];
            $this->status = $row['status'];
            return true;
        }
        
        return false;
    }

    // Membuat janji temu baru
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (patient_id, doctor_id, appointment_date, status) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        // Sanitasi input
        $this->patient_id = htmlspecialchars(strip_tags($this->patient_id));
        $this->doctor_id = htmlspecialchars(strip_tags($this->doctor_id));
        $this->appointment_date = htmlspecialchars(strip_tags($this->appointment_date));
        $this->status = htmlspecialchars(strip_tags($this->status));

        // Binding parameter
        $stmt->bindParam(1, $this->patient_id);
        $stmt->bindParam(2, $this->doctor_id);
        $stmt->bindParam(3, $this->appointment_date);
        $stmt->bindParam(4, $this->status);

        // Eksekusi query
        if($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Memperbarui data janji temu
    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET patient_id = ?, doctor_id = ?, appointment_date = ?, status = ? 
                  WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        // Sanitasi input
        $this->patient_id = htmlspecialchars(strip_tags($this->patient_id));
        $this->doctor_id = htmlspecialchars(strip_tags($this->doctor_id));
        $this->appointment_date = htmlspecialchars(strip_tags($this->appointment_date));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Binding parameter
        $stmt->bindParam(1, $this->patient_id);
        $stmt->bindParam(2, $this->doctor_id);
        $stmt->bindParam(3, $this->appointment_date);
        $stmt->bindParam(4, $this->status);
        $stmt->bindParam(5, $this->id);

        // Eksekusi query
        if($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Menghapus data janji temu
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

    // Mencari janji temu berdasarkan nama pasien
    public function searchByPatientName($keyword) {
        $query = "SELECT a.id, a.patient_id, a.doctor_id, a.appointment_date, a.status,
                 p.name as patient_name, d.name as doctor_name, d.specialization
                 FROM " . $this->table_name . " a
                 LEFT JOIN patients p ON a.patient_id = p.id
                 LEFT JOIN doctors d ON a.doctor_id = d.id
                 WHERE p.name LIKE ?
                 ORDER BY a.appointment_date DESC";
        
        $keyword = "%{$keyword}%";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $keyword);
        $stmt->execute();

        return $stmt;
    }
}
?>