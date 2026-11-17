<?php
require_once "inc/Koneksi.php";
require_once "app/Matakuliah.php";

$matkul = new App\Matakuliah();

$rows = $matkul->index();
?>

<h2>📚 Matakuliah</h2>
<p class="sub"><?php echo count($rows); ?> data tercatat</p>

<?php
$pesan = [
    'saved'   => ['success', 'Matakuliah baru berhasil disimpan.'],
    'updated' => ['success', 'Data matakuliah berhasil diperbarui.'],
    'deleted' => ['success', 'Data matakuliah berhasil dihapus.'],
    'dup'     => ['danger',  'Kode mata kuliah sudah terdaftar, gunakan yang lain.'],
    'invalid' => ['warning', 'Isian belum lengkap atau di luar batas.'],
    'error'   => ['danger',  'Terjadi kesalahan pada database.'],
];
$status = $_GET['status'] ?? '';
if (isset($pesan[$status])) {
    echo '<div class="alert alert-' . $pesan[$status][0] . '" data-auto>' . $pesan[$status][1] . '</div>';
}
?>

<div class="toolbar">
    <a href="index.php?page=matkul_input" class="btn">+ Tambah Matakuliah</a>
    <input type="search" class="cari" data-target="tabel-matkul" placeholder="Cari matakuliah...">
</div>

<div class="scroll">
<table id="tabel-matkul">
    <thead>
        <tr><th>Kode</th><th>Mata kuliah</th><th>SKS</th><th>Semester</th><th></th></tr>
    </thead>
    <tbody>
        <?php if (!$rows) { ?>
            <tr class="kosong"><td colspan="5">Belum ada data matakuliah.</td></tr>
        <?php } ?>
        <?php foreach ($rows as $row) { ?>
            <tr>
                <td><span class="chip"><?php echo e($row['matkul_kode']); ?></span></td>
                <td><?php echo e($row['matkul_nama'] ?: '-'); ?></td>
                <td><span class="chip"><?php echo (int) $row['matkul_sks']; ?> SKS</span></td>
                <td><span class="badge">Smt <?php echo (int) $row['matkul_semester']; ?></span></td>
                <td>
                    <div class="aksi">
                        <a href="index.php?page=matkul_edit&id=<?php echo (int) $row['matkul_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <form action="matkul_proses.php?action=delete" method="post" class="inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            <input type="hidden" name="matkul_id" value="<?php echo (int) $row['matkul_id']; ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
</div>
