<div class="row mb-4">
    <div class="col-md-6">
        <h2>Detail Janji Temu</h2>
    </div>
    <div class="col-md-6 text-end">
        <a href="appointments.php" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="row mb-3">
            <label class="col-md-3 fw-bold">ID</label>
            <div class="col-md-9"><?php echo $appointment->id; ?></div>
        </div>
        
        <div class="row mb-3">
            <label class="col-md-3 fw-bold">Pasien</label>
            <div class="col-md-9"><?php echo $patient_name; ?></div>
        </div>
        
        <div class="row mb-3">
            <label class="col-md-3 fw-bold">Dokter</label>
            <div class="col-md-9"><?php echo $doctor_name; ?></div>
        </div>
        
        <div class="row mb-3">
            <label class="col-md-3 fw-bold">Spesialisasi Dokter</label>
            <div class="col-md-9"><?php echo $specialization; ?></div>
        </div>
        
        <div class="row mb-3">
            <label class="col-md-3 fw-bold">Tanggal & Waktu</label>
            <div class="col-md-9"><?php echo date('d M Y H:i', strtotime($appointment->appointment_date)); ?></div>
        </div>
        
        <div class="row mb-3">
            <label class="col-md-3 fw-bold">Status</label>
            <div class="col-md-9">
                <?php if ($appointment->status == 'Terjadwal'): ?>
                    <span class="badge bg-warning">Terjadwal</span>
                <?php elseif ($appointment->status == 'Selesai'): ?>
                    <span class="badge bg-success">Selesai</span>
                <?php else: ?>
                    <span class="badge bg-danger">Dibatalkan</span>
                <?php endif; ?>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <a href="appointments.php?action=update&id=<?php echo $appointment->id; ?>" class="btn btn-primary">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <a href="appointments.php?action=delete&id=<?php echo $appointment->id; ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                    <i class="fas fa-trash"></i> Hapus
                </a>
            </div>
        </div>
    </div>
</div>