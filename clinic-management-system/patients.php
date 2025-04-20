<?php
// Include file database dan objek
require_once "config/database.php";
require_once "class/Patient.php";

// Mendapatkan koneksi database
$database = new Database();
$db = $database->getConnection();

// Inisialisasi objek pasien
$patient = new Patient($db);

// Mendapatkan action dari parameter URL
$action = isset($_GET['action']) ? $_GET['action'] : 'list';

// Include header
include "view/layouts/header.php";

// Proses berdasarkan action
switch($action) {
    case "create":
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Set nilai pasien
            $patient->name = $_POST['name'];
            $patient->birthdate = $_POST['birthdate'];
            $patient->gender = $_POST['gender'];
            $patient->address = $_POST['address'];
            
            // Membuat pasien baru
            if($patient->create()) {
                echo "<div class='alert alert-success'>Pasien berhasil ditambahkan.</div>";
                // Redirect ke daftar setelah 2 detik
                echo "<meta http-equiv='refresh' content='2;url=patients.php'>";
            } else {
                echo "<div class='alert alert-danger'>Gagal menambahkan pasien.</div>";
            }
        } else {
            // Menampilkan form pembuatan
            $page_title = "Tambah Pasien Baru";
            $button_label = "Simpan";
            $form_action = "patients.php?action=create";
            
            include "view/patients/form.php";
        }
        break;
        
    case "read":
        // Mendapatkan parameter ID
        $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: ID tidak ditemukan.');
        
        // Set ID
        $patient->id = $id;
        
        // Membaca detail
        if($patient->getById()) {
            include "view/patients/read.php";
        } else {
            echo "<div class='alert alert-danger'>Pasien dengan ID {$id} tidak ditemukan.</div>";
        }
        break;
        
    case "update":
        // Mendapatkan parameter ID
        $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: ID tidak ditemukan.');
        
        // Set ID
        $patient->id = $id;
        
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Set nilai pasien
            $patient->name = $_POST['name'];
            $patient->birthdate = $_POST['birthdate'];
            $patient->gender = $_POST['gender'];
            $patient->address = $_POST['address'];
            
            // Memperbarui pasien
            if($patient->update()) {
                echo "<div class='alert alert-success'>Pasien berhasil diperbarui.</div>";
                // Redirect ke daftar setelah 2 detik
                echo "<meta http-equiv='refresh' content='2;url=patients.php'>";
            } else {
                echo "<div class='alert alert-danger'>Gagal memperbarui pasien.</div>";
            }
        } else {
            // Mendapatkan detail pasien
            if($patient->getById()) {
                // Menampilkan form pembaruan
                $page_title = "Edit Pasien";
                $button_label = "Perbarui";
                $form_action = "patients.php?action=update";
                
                include "view/patients/form.php";
            } else {
                echo "<div class='alert alert-danger'>Pasien dengan ID {$id} tidak ditemukan.</div>";
            }
        }
        break;
        
    case "delete":
        // Mendapatkan parameter ID
        $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: ID tidak ditemukan.');
        
        // Set ID
        $patient->id = $id;
        
        // Menghapus pasien
        if($patient->delete()) {
            echo "<div class='alert alert-success'>Pasien berhasil dihapus.</div>";
        } else {
            echo "<div class='alert alert-danger'>Gagal menghapus pasien.</div>";
        }
        
        // Redirect ke daftar setelah 2 detik
        echo "<meta http-equiv='refresh' content='2;url=patients.php'>";
        break;
        
    default:
        // Mendapatkan semua pasien
        $result = $patient->getAll();
        
        include "view/patients/index.php";
        break;
}

// Include footer
include "view/layouts/footer.php";
?>