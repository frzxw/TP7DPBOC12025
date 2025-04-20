<div class="row mb-4">
    <div class="col-md-12">
        <h2><?php echo $page_title; ?></h2>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="<?php echo $form_action; ?>" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo isset($patient->name) ? $patient->name : ''; ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="birthdate" class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" id="birthdate" name="birthdate" value="<?php echo isset($patient->birthdate) ? $patient->birthdate : ''; ?>" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Jenis Kelamin</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="gender_male" value="Laki-laki" <?php echo (isset($patient->gender) && $patient->gender == "Laki-laki") ? "checked" : ""; ?> required>
                    <label class="form-check-label" for="gender_male">
                        Laki-laki
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="gender_female" value="Perempuan" <?php echo (isset($patient->gender) && $patient->gender == "Perempuan") ? "checked" : ""; ?> required>
                    <label class="form-check-label" for="gender_female">
                        Perempuan
                    </label>
                </div>
            </div>
            
            <div class="mb-3">
                <label for="address" class="form-label">Alamat</label>
                <textarea class="form-control" id="address" name="address" rows="3" required><?php echo isset($patient->address) ? $patient->address : ''; ?></textarea>
            </div>
            
            <?php if(isset($patient->id)): ?>
                <input type="hidden" name="id" value="<?php echo $patient->id; ?>">
            <?php endif; ?>
            
            <div class="d-flex justify-content-between">
                <a href="patients.php" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary"><?php echo $button_label; ?></button>
            </div>
        </form>
    </div>
</div>