<?php
// Include file database dan objek
require_once "config/database.php";
require_once "class/Doctor.php";

// Mendapatkan koneksi database
$database = new Database();
$db = $database->getConnection();

// Inisialisasi objek dokter
$doctor = new Doctor($db);

// Mendapatkan action dari parameter URL
$action = isset($_GET['action']) ? $_GET['action'] : 'list';

// Include header
include "view/layouts/header.php";

// Proses berdasarkan action
switch($action) {
    case "create":
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Set nilai dokter
            $doctor->name = $_POST['name'];
            $doctor->specialization = $_POST['specialization'];
            $doctor->phone = $_POST['phone'];
            
            // Membuat dokter baru
            if($doctor->create()) {
                echo "<div class='alert alert-success'>Dokter berhasil ditambahkan.</div>";
                // Redirect ke daftar setelah 2 detik
                echo "<meta http-equiv='refresh' content='2;url=doctors.php'>";
            } else {
                echo "<div class='alert alert-danger'>Gagal menambahkan dokter.</div>";
            }
        } else {
            // Menampilkan form pembuatan
            $page_title = "Tambah Dokter Baru";
            $button_label = "Simpan";
            $form_action = "doctors.php?action=create";
            
            include "view/doctors/form.php";
        }
        break;
        
    case "read":
        // Mendapatkan parameter ID
        $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: ID tidak ditemukan.');
        
        // Set ID
        $doctor->id = $id;
        
        // Membaca detail
        if($doctor->getById()) {
            include "view/doctors/read.php";
        } else {
            echo "<div class='alert alert-danger'>Dokter dengan ID {$id} tidak ditemukan.</div>";
        }
        break;
        
    case "update":
        // Mendapatkan parameter ID
        $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: ID tidak ditemukan.');
        
        // Set ID
        $doctor->id = $id;
        
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Set nilai dokter
            $doctor->name = $_POST['name'];
            $doctor->specialization = $_POST['specialization'];
            $doctor->phone = $_POST['phone'];
            
            // Memperbarui dokter
            if($doctor->update()) {
                echo "<div class='alert alert-success'>Dokter berhasil diperbarui.</div>";
                // Redirect ke daftar setelah 2 detik
                echo "<meta http-equiv='refresh' content='2;url=doctors.php'>";
            } else {
                echo "<div class='alert alert-danger'>Gagal memperbarui dokter.</div>";
            }
        } else {
            // Mendapatkan detail dokter
            if($doctor->getById()) {
                // Menampilkan form pembaruan
                $page_title = "Edit Dokter";
                $button_label = "Perbarui";
                $form_action = "doctors.php?action=update";
                
                include "view/doctors/form.php";
            } else {
                echo "<div class='alert alert-danger'>Dokter dengan ID {$id} tidak ditemukan.</div>";
            }
        }
        break;
        
    case "delete":
        // Mendapatkan parameter ID
        $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: ID tidak ditemukan.');
        
        // Set ID
        $doctor->id = $id;
        
        // Menghapus dokter
        if($doctor->delete()) {
            echo "<div class='alert alert-success'>Dokter berhasil dihapus.</div>";
        } else {
            echo "<div class='alert alert-danger'>Gagal menghapus dokter.</div>";
        }
        
        // Redirect ke daftar setelah 2 detik
        echo "<meta http-equiv='refresh' content='2;url=doctors.php'>";
        break;
        
    default:
        // Mendapatkan semua dokter
        $result = $doctor->getAll();
        
        include "view/doctors/index.php";
        break;
}

// Include footer
include "view/layouts/footer.php";
?>