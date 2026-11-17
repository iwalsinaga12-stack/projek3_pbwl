<?php
require_once "inc/Koneksi.php";
require_once "app/Mahasiswa.php";

$mhsw = new App\Mahasiswa();

$row = $mhsw->edit($_GET['id'] ?? 0);

if (!$row) {
    echo '<div class="alert alert-warning">Data mahasiswa tidak ditemukan.</div>';
    return;
}
?>

<h2>✏️ Edit Mahasiswa</h2>
<p class="sub">Ubah data lalu tekan Update.</p>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
            <form action="mhsw_proses.php?action=update" method="post">
                <input type="hidden" name="mhsw_id" value="<?php echo (int) $row['mhsw_id']; ?>">
                <div class="mb-3">
                    <label for="mhsw_nim" class="form-label">NIM</label>
                    <input type="text" id="mhsw_nim" class="form-control" name="mhsw_nim" value="<?php echo e($row['mhsw_nim'] ?? ''); ?>" placeholder="Contoh: 2201001" required>
                </div>
                <div class="mb-3">
                    <label for="mhsw_nama" class="form-label">Nama lengkap</label>
                    <input type="text" id="mhsw_nama" class="form-control" name="mhsw_nama" value="<?php echo e($row['mhsw_nama'] ?? ''); ?>" placeholder="Nama mahasiswa" required>
                </div>
                <div class="mb-3">
                    <label for="mhsw_alamat" class="form-label">Alamat</label>
                    <textarea id="mhsw_alamat" class="form-control" name="mhsw_alamat" placeholder="Alamat tinggal"><?php echo e($row['mhsw_alamat'] ?? ''); ?></textarea>
                </div>
                <button type="submit" name="update" class="btn">Update</button>
                <a href="index.php?page=mhsw" class="btn btn-secondary">Batal</a>
            </form>
            </div>
        </div>
    </div>
</div>
