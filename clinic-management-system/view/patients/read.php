<div class="row mb-4">
    <div class="col-md-6">
        <h2>Detail Pasien</h2>
    </div>
    <div class="col-md-6 text-end">
        <a href="patients.php" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="row mb-3">
            <label class="col-md-3 fw-bold">ID</label>
            <div class="col-md-9"><?php echo $patient->id; ?></div>
        </div>
        
        <div class="row mb-3">
            <label class="col-md-3 fw-bold">Nama</label>
            <div class="col-md-9"><?php echo $patient->name; ?></div>
        </div>
        
        <div class="row mb-3">
            <label class="col-md-3 fw-bold">Tanggal Lahir</label>
            <div class="col-md-9"><?php echo date('d M Y', strtotime($patient->birthdate)); ?></div>
        </div>
        
        <div class="row mb-3">
            <label class="col-md-3 fw-bold">Jenis Kelamin</label>
            <div class="col-md-9"><?php echo $patient->gender; ?></div>
        </div>
        
        <div class="row mb-3">
            <label class="col-md-3 fw-bold">Alamat</label>
            <div class="col-md-9"><?php echo $patient->address; ?></div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <a href="patients.php?action=update&id=<?php echo $patient->id; ?>" class="btn btn-primary">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <a href="patients.php?action=delete&id=<?php echo $patient->id; ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                    <i class="fas fa-trash"></i> Hapus
                </a>
            </div>
        </div>
    </div>
</div>