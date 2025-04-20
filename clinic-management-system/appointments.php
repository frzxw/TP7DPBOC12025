<?php
// Include file database dan objek
require_once "config/database.php";
require_once "class/Appointment.php";
require_once "class/Patient.php";
require_once "class/Doctor.php";

// Mendapatkan koneksi database
$database = new Database();
$db = $database->getConnection();

// Inisialisasi objek
$appointment = new Appointment($db);
$patient = new Patient($db);
$doctor = new Doctor($db);

// Mendapatkan action dari parameter URL
$action = isset($_GET['action']) ? $_GET['action'] : 'list';

// Include header
include "view/layouts/header.php";

// Proses berdasarkan action
switch($action) {
    case "create":
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Set nilai janji temu
            $appointment->patient_id = $_POST['patient_id'];
            $appointment->doctor_id = $_POST['doctor_id'];
            $appointment->appointment_date = $_POST['appointment_date'];
            $appointment->status = $_POST['status'];
            
            // Membuat janji temu baru
            if($appointment->create()) {
                echo "<div class='alert alert-success'>Janji temu berhasil ditambahkan.</div>";
                // Redirect ke daftar setelah 2 detik
                echo "<meta http-equiv='refresh' content='2;url=appointments.php'>";
            } else {
                echo "<div class='alert alert-danger'>Gagal menambahkan janji temu.</div>";
            }
        } else {
            // Menampilkan form pembuatan
            $page_title = "Tambah Janji Temu Baru";
            $button_label = "Simpan";
            $form_action = "appointments.php?action=create";
            
            // Mendapatkan semua pasien dan dokter untuk dropdown form
            $patients_result = $patient->getAll();
            $doctors_result = $doctor->getAll();
            
            include "view/appointments/form.php";
        }
        break;
        
    case "read":
        // Mendapatkan parameter ID
        $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: ID tidak ditemukan.');
        
        // Set ID
        $appointment->id = $id;
        
        // Membaca detail
        if($appointment->getById()) {
            // Mendapatkan nama pasien dan dokter
            $patient->id = $appointment->patient_id;
            $patient->getById();
            $patient_name = $patient->name;
            
            $doctor->id = $appointment->doctor_id;
            $doctor->getById();
            $doctor_name = $doctor->name;
            $specialization = $doctor->specialization;
            
            include "view/appointments/read.php";
        } else {
            echo "<div class='alert alert-danger'>Janji temu dengan ID {$id} tidak ditemukan.</div>";
        }
        break;
        
    case "update":
        // Mendapatkan parameter ID
        $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: ID tidak ditemukan.');
        
        // Set ID
        $appointment->id = $id;
        
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Set nilai janji temu
            $appointment->patient_id = $_POST['patient_id'];
            $appointment->doctor_id = $_POST['doctor_id'];
            $appointment->appointment_date = $_POST['appointment_date'];
            $appointment->status = $_POST['status'];
            
            // Memperbarui janji temu
            if($appointment->update()) {
                echo "<div class='alert alert-success'>Janji temu berhasil diperbarui.</div>";
                // Redirect ke daftar setelah 2 detik
                echo "<meta http-equiv='refresh' content='2;url=appointments.php'>";
            } else {
                echo "<div class='alert alert-danger'>Gagal memperbarui janji temu.</div>";
            }
        } else {
            // Mendapatkan detail janji temu
            if($appointment->getById()) {
                // Menampilkan form pembaruan
                $page_title = "Edit Janji Temu";
                $button_label = "Perbarui";
                $form_action = "appointments.php?action=update";
                
                // Mendapatkan semua pasien dan dokter untuk dropdown form
                $patients_result = $patient->getAll();
                $doctors_result = $doctor->getAll();
                
                include "view/appointments/form.php";
            } else {
                echo "<div class='alert alert-danger'>Janji temu dengan ID {$id} tidak ditemukan.</div>";
            }
        }
        break;
        
    case "delete":
        // Mendapatkan parameter ID
        $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: ID tidak ditemukan.');
        
        // Set ID
        $appointment->id = $id;
        
        // Menghapus janji temu
        if($appointment->delete()) {
            echo "<div class='alert alert-success'>Janji temu berhasil dihapus.</div>";
        } else {
            echo "<div class='alert alert-danger'>Gagal menghapus janji temu.</div>";
        }
        
        // Redirect ke daftar setelah 2 detik
        echo "<meta http-equiv='refresh' content='2;url=appointments.php'>";
        break;
        
    default:
        // Memeriksa jika parameter pencarian ada
        if(isset($_GET['search']) && !empty($_GET['search'])) {
            // Mencari janji temu berdasarkan nama pasien
            $result = $appointment->searchByPatientName($_GET['search']);
            
            // Menampilkan informasi pencarian
            echo "<div class='alert alert-info'>Hasil pencarian untuk: '" . htmlspecialchars($_GET['search']) . "'</div>";
        } else {
            // Mendapatkan semua janji temu
            $result = $appointment->getAll();
        }
        
        include "view/appointments/index.php";
        break;
}

// Include footer
include "view/layouts/footer.php";
?>