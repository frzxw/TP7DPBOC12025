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
                <input type="text" class="form-control" id="name" name="name" value="<?php echo isset($doctor->name) ? $doctor->name : ''; ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="specialization" class="form-label">Spesialisasi</label>
                <input type="text" class="form-control" id="specialization" name="specialization" value="<?php echo isset($doctor->specialization) ? $doctor->specialization : ''; ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="phone" class="form-label">Nomor Telepon</label>
                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo isset($doctor->phone) ? $doctor->phone : ''; ?>" required>
            </div>
            
            <?php if(isset($doctor->id)): ?>
                <input type="hidden" name="id" value="<?php echo $doctor->id; ?>">
            <?php endif; ?>
            
            <div class="d-flex justify-content-between">
                <a href="doctors.php" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary"><?php echo $button_label; ?></button>
            </div>
        </form>
    </div>
</div>