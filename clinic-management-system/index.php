<?php
// Include file database dan objek
require_once "config/database.php";
require_once "class/Patient.php";
require_once "class/Doctor.php";
require_once "class/Appointment.php";

// Mendapatkan koneksi database
$database = new Database();
$db = $database->getConnection();

// Inisialisasi objek
$patient = new Patient($db);
$doctor = new Doctor($db);
$appointment = new Appointment($db);

// Mendapatkan jumlah pasien, dokter, dan janji temu
$stmt_patients = $patient->getAll();
$total_patients = $stmt_patients->rowCount();

$stmt_doctors = $doctor->getAll();
$total_doctors = $stmt_doctors->rowCount();

$stmt_appointments = $appointment->getAll();
$total_appointments = $stmt_appointments->rowCount();

// Janji temu terbaru
$recent_appointments = [];
$count = 0;
while($row = $stmt_appointments->fetch(PDO::FETCH_ASSOC)) {
    if($count < 5) {
        $recent_appointments[] = $row;
        $count++;
    } else {
        break;
    }
}

// Include header
include "view/layouts/header.php";
?>

<div class="row mb-4">
    <div class="col-md-12">
        <h2>Dashboard Sistem Manajemen Klinik</h2>
        <hr>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <div class="row">
                    <div class="col-3">
                        <i class="fas fa-users fa-3x"></i>
                    </div>
                    <div class="col-9 text-end">
                        <h1><?php echo $total_patients; ?></h1>
                        <p class="mb-0">Total Pasien</p>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-transparent border-top text-end">
                <a href="patients.php" class="text-white text-decoration-none">Detail <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card text-white bg-success">
            <div class="card-body">
                <div class="row">
                    <div class="col-3">
                        <i class="fas fa-user-md fa-3x"></i>
                    </div>
                    <div class="col-9 text-end">
                        <h1><?php echo $total_doctors; ?></h1>
                        <p class="mb-0">Total Dokter</p>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-transparent border-top text-end">
                <a href="doctors.php" class="text-white text-decoration-none">Detail <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card text-white bg-info">
            <div class="card-body">
                <div class="row">
                    <div class="col-3">
                        <i class="fas fa-calendar-check fa-3x"></i>
                    </div>
                    <div class="col-9 text-end">
                        <h1><?php echo $total_appointments; ?></h1>
                        <p class="mb-0">Total Janji Temu</p>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-transparent border-top text-end">
                <a href="appointments.php" class="text-white text-decoration-none">Detail <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-light">
                <h5 class="mb-0">Janji Temu Terbaru</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Pasien</th>
                                <th>Dokter</th>
                                <th>Spesialisasi</th>
                                <th>Tanggal & Waktu</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($recent_appointments) > 0): ?>
                                <?php foreach ($recent_appointments as $row): ?>
                                    <tr>
                                        <td><?php echo $row['patient_name']; ?></td>
                                        <td><?php echo $row['doctor_name']; ?></td>
                                        <td><?php echo $row['specialization']; ?></td>
                                        <td><?php echo date('d M Y H:i', strtotime($row['appointment_date'])); ?></td>
                                        <td>
                                            <?php if ($row['status'] == 'Terjadwal'): ?>
                                                <span class="badge bg-warning">Terjadwal</span>
                                            <?php elseif ($row['status'] == 'Selesai'): ?>
                                                <span class="badge bg-success">Selesai</span>
                                            <?php else: ?>
                                                <span class="badge bg-danger">Dibatalkan</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada janji temu terbaru</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="text-end mt-3">
                    <a href="appointments.php" class="btn btn-primary">Lihat Semua Janji Temu</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Include footer
include "view/layouts/footer.php";
?>