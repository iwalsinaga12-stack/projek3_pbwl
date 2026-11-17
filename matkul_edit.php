<?php
require_once "inc/Koneksi.php";
require_once "app/Matakuliah.php";

$matkul = new App\Matakuliah();

$row = $matkul->edit($_GET['id'] ?? 0);

if (!$row) {
    echo '<div class="alert alert-warning">Data matakuliah tidak ditemukan.</div>';
    return;
}
?>

<h2>✏️ Edit Matakuliah</h2>
<p class="sub">Ubah data lalu tekan Update.</p>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
            <form action="matkul_proses.php?action=update" method="post">
                <input type="hidden" name="matkul_id" value="<?php echo (int) $row['matkul_id']; ?>">
                <div class="mb-3">
                    <label for="matkul_kode" class="form-label">Kode</label>
                    <input type="text" id="matkul_kode" class="form-control" name="matkul_kode" value="<?php echo e($row['matkul_kode'] ?? ''); ?>" placeholder="Contoh: TIF301" required>
                </div>
                <div class="mb-3">
                    <label for="matkul_nama" class="form-label">Nama mata kuliah</label>
                    <input type="text" id="matkul_nama" class="form-control" name="matkul_nama" value="<?php echo e($row['matkul_nama'] ?? ''); ?>" placeholder="Nama mata kuliah" required>
                </div>
                <div class="mb-3">
                    <label for="matkul_sks" class="form-label">SKS (1-6)</label>
                    <input type="number" id="matkul_sks" class="form-control" name="matkul_sks" value="<?php echo e($row['matkul_sks'] ?? ''); ?>" min="1" max="6" placeholder="3" required>
                </div>
                <div class="mb-3">
                    <label for="matkul_semester" class="form-label">Semester</label>
                    <select id="matkul_semester" class="form-control" name="matkul_semester" required><option value="">-- pilih --</option><option value="1" <?php echo ((string) ($row['matkul_semester'] ?? '') === '1') ? 'selected' : ''; ?>>Semester 1</option><option value="2" <?php echo ((string) ($row['matkul_semester'] ?? '') === '2') ? 'selected' : ''; ?>>Semester 2</option><option value="3" <?php echo ((string) ($row['matkul_semester'] ?? '') === '3') ? 'selected' : ''; ?>>Semester 3</option><option value="4" <?php echo ((string) ($row['matkul_semester'] ?? '') === '4') ? 'selected' : ''; ?>>Semester 4</option><option value="5" <?php echo ((string) ($row['matkul_semester'] ?? '') === '5') ? 'selected' : ''; ?>>Semester 5</option><option value="6" <?php echo ((string) ($row['matkul_semester'] ?? '') === '6') ? 'selected' : ''; ?>>Semester 6</option><option value="7" <?php echo ((string) ($row['matkul_semester'] ?? '') === '7') ? 'selected' : ''; ?>>Semester 7</option><option value="8" <?php echo ((string) ($row['matkul_semester'] ?? '') === '8') ? 'selected' : ''; ?>>Semester 8</option></select>
                </div>
                <button type="submit" name="update" class="btn">Update</button>
                <a href="index.php?page=matkul" class="btn btn-secondary">Batal</a>
            </form>
            </div>
        </div>
    </div>
</div>
