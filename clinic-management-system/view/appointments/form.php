<div class="row mb-4">
    <div class="col-md-12">
        <h2><?php echo $page_title; ?></h2>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="<?php echo $form_action; ?>" method="post">
            <div class="mb-3">
                <label for="patient_id" class="form-label">Pasien</label>
                <select class="form-select" id="patient_id" name="patient_id" required>
                    <option value="">-- Pilih Pasien --</option>
                    <?php while($patient_data = $patients_result->fetch(PDO::FETCH_ASSOC)): ?>
                        <option value="<?php echo $patient_data['id']; ?>" <?php echo (isset($appointment->patient_id) && $appointment->patient_id == $patient_data['id']) ? "selected" : ""; ?>>
                            <?php echo $patient_data['name']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            
            <div class="mb-3">
                <label for="doctor_id" class="form-label">Dokter</label>
                <select class="form-select" id="doctor_id" name="doctor_id" required>
                    <option value="">-- Pilih Dokter --</option>
                    <?php while($doctor_data = $doctors_result->fetch(PDO::FETCH_ASSOC)): ?>
                        <option value="<?php echo $doctor_data['id']; ?>" <?php echo (isset($appointment->doctor_id) && $appointment->doctor_id == $doctor_data['id']) ? "selected" : ""; ?>>
                            <?php echo $doctor_data['name']; ?> (<?php echo $doctor_data['specialization']; ?>)
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            
            <div class="mb-3">
                <label for="appointment_date" class="form-label">Tanggal & Waktu Janji Temu</label>
                <input type="datetime-local" class="form-control" id="appointment_date" name="appointment_date" value="<?php echo isset($appointment->appointment_date) ? date('Y-m-d\TH:i', strtotime($appointment->appointment_date)) : ''; ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="Terjadwal" <?php echo (isset($appointment->status) && $appointment->status == "Terjadwal") ? "selected" : ""; ?>>Terjadwal</option>
                    <option value="Selesai" <?php echo (isset($appointment->status) && $appointment->status == "Selesai") ? "selected" : ""; ?>>Selesai</option>
                    <option value="Dibatalkan" <?php echo (isset($appointment->status) && $appointment->status == "Dibatalkan") ? "selected" : ""; ?>>Dibatalkan</option>
                </select>
            </div>
            
            <?php if(isset($appointment->id)): ?>
                <input type="hidden" name="id" value="<?php echo $appointment->id; ?>">
            <?php endif; ?>
            
            <div class="d-flex justify-content-between">
                <a href="appointments.php" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary"><?php echo $button_label; ?></button>
            </div>
        </form>
    </div>
</div>