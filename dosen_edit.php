<?php
require_once "inc/Koneksi.php";
require_once "app/Dosen.php";

$dosen = new App\Dosen();

$row = $dosen->edit($_GET['id'] ?? 0);

if (!$row) {
    echo '<div class="alert alert-warning">Data dosen tidak ditemukan.</div>';
    return;
}
?>

<h2>✏️ Edit Dosen</h2>
<p class="sub">Ubah data lalu tekan Update.</p>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
            <form action="dosen_proses.php?action=update" method="post">
                <input type="hidden" name="dosen_id" value="<?php echo (int) $row['dosen_id']; ?>">
                <div class="mb-3">
                    <label for="dosen_nip" class="form-label">NIP</label>
                    <input type="text" id="dosen_nip" class="form-control" name="dosen_nip" value="<?php echo e($row['dosen_nip'] ?? ''); ?>" placeholder="18 digit NIP" required>
                </div>
                <div class="mb-3">
                    <label for="dosen_nama" class="form-label">Nama lengkap & gelar</label>
                    <input type="text" id="dosen_nama" class="form-control" name="dosen_nama" value="<?php echo e($row['dosen_nama'] ?? ''); ?>" placeholder="Nama dosen" required>
                </div>
                <div class="mb-3">
                    <label for="dosen_golongan" class="form-label">Golongan</label>
                    <select id="dosen_golongan" class="form-control" name="dosen_golongan"><option value="">-- pilih --</option><option value="III/a" <?php echo ((string) ($row['dosen_golongan'] ?? '') === 'III/a') ? 'selected' : ''; ?>>III/a</option><option value="III/b" <?php echo ((string) ($row['dosen_golongan'] ?? '') === 'III/b') ? 'selected' : ''; ?>>III/b</option><option value="III/c" <?php echo ((string) ($row['dosen_golongan'] ?? '') === 'III/c') ? 'selected' : ''; ?>>III/c</option><option value="III/d" <?php echo ((string) ($row['dosen_golongan'] ?? '') === 'III/d') ? 'selected' : ''; ?>>III/d</option><option value="IV/a" <?php echo ((string) ($row['dosen_golongan'] ?? '') === 'IV/a') ? 'selected' : ''; ?>>IV/a</option><option value="IV/b" <?php echo ((string) ($row['dosen_golongan'] ?? '') === 'IV/b') ? 'selected' : ''; ?>>IV/b</option><option value="IV/c" <?php echo ((string) ($row['dosen_golongan'] ?? '') === 'IV/c') ? 'selected' : ''; ?>>IV/c</option></select>
                </div>
                <button type="submit" name="update" class="btn">Update</button>
                <a href="index.php?page=dosen" class="btn btn-secondary">Batal</a>
            </form>
            </div>
        </div>
    </div>
</div>
