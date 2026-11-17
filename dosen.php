<?php
require_once "inc/Koneksi.php";
require_once "app/Dosen.php";

$dosen = new App\Dosen();

$rows = $dosen->index();
?>

<h2>🧑‍🏫 Dosen</h2>
<p class="sub"><?php echo count($rows); ?> data tercatat</p>

<?php
$pesan = [
    'saved'   => ['success', 'Dosen baru berhasil disimpan.'],
    'updated' => ['success', 'Data dosen berhasil diperbarui.'],
    'deleted' => ['success', 'Data dosen berhasil dihapus.'],
    'dup'     => ['danger',  'NIP sudah terdaftar, gunakan yang lain.'],
    'invalid' => ['warning', 'Isian belum lengkap atau di luar batas.'],
    'error'   => ['danger',  'Terjadi kesalahan pada database.'],
];
$status = $_GET['status'] ?? '';
if (isset($pesan[$status])) {
    echo '<div class="alert alert-' . $pesan[$status][0] . '" data-auto>' . $pesan[$status][1] . '</div>';
}
?>

<div class="toolbar">
    <a href="index.php?page=dosen_input" class="btn">+ Tambah Dosen</a>
    <input type="search" class="cari" data-target="tabel-dosen" placeholder="Cari dosen...">
</div>

<div class="scroll">
<table id="tabel-dosen">
    <thead>
        <tr><th>NIP</th><th>Nama</th><th>Golongan</th><th></th></tr>
    </thead>
    <tbody>
        <?php if (!$rows) { ?>
            <tr class="kosong"><td colspan="4">Belum ada data dosen.</td></tr>
        <?php } ?>
        <?php foreach ($rows as $row) { ?>
            <tr>
                <td><span class="chip"><?php echo e($row['dosen_nip']); ?></span></td>
                <td><div class="orang"><span class="avatar" style="--h:<?php echo abs(crc32($row['dosen_nama'])) % 360; ?>"><?php echo e(inisial($row['dosen_nama'])); ?></span><span><?php echo e($row['dosen_nama']); ?></span></div></td>
                <td><span class="badge"><?php echo e($row['dosen_golongan'] ?: '-'); ?></span></td>
                <td>
                    <div class="aksi">
                        <a href="index.php?page=dosen_edit&id=<?php echo (int) $row['dosen_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <form action="dosen_proses.php?action=delete" method="post" class="inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            <input type="hidden" name="dosen_id" value="<?php echo (int) $row['dosen_id']; ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
</div>
