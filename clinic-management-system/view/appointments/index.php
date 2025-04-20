<div class="row mb-4">
    <div class="col-md-6">
        <h2>Daftar Janji Temu</h2>
    </div>
    <div class="col-md-6 text-end">
        <a href="appointments.php?action=create" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Janji Temu Baru
        </a>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0">Pencarian</h5>
    </div>
    <div class="card-body">
        <form action="appointments.php" method="get">
            <div class="row">
                <div class="col-md-10">
                    <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan nama pasien..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search"></i> Cari
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Pasien</th>
                        <th>Dokter</th>
                        <th>Spesialisasi</th>
                        <th>Tanggal & Waktu</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($result->rowCount() > 0): ?>
                        <?php while($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
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
                                <td>
                                    <a href="appointments.php?action=read&id=<?php echo $row['id']; ?>" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="appointments.php?action=update&id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="appointments.php?action=delete&id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data janji temu</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>