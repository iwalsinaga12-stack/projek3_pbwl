<?php
require_once "inc/Koneksi.php";
require_once "app/Mahasiswa.php";

$mhsw = new App\Mahasiswa();

$rows = $mhsw->index();
?>

<h2>🎓 Mahasiswa</h2>
<p class="sub"><?php echo count($rows); ?> data tercatat</p>

<?php
$pesan = [
    'saved'   => ['success', 'Mahasiswa baru berhasil disimpan.'],
    'updated' => ['success', 'Data mahasiswa berhasil diperbarui.'],
    'deleted' => ['success', 'Data mahasiswa berhasil dihapus.'],
    'dup'     => ['danger',  'NIM sudah terdaftar, gunakan yang lain.'],
    'invalid' => ['warning', 'Isian belum lengkap atau di luar batas.'],
    'error'   => ['danger',  'Terjadi kesalahan pada database.'],
];
$status = $_GET['status'] ?? '';
if (isset($pesan[$status])) {
    echo '<div class="alert alert-' . $pesan[$status][0] . '" data-auto>' . $pesan[$status][1] . '</div>';
}
?>

<div class="toolbar">
    <a href="index.php?page=mhsw_input" class="btn">+ Tambah Mahasiswa</a>
    <input type="search" class="cari" data-target="tabel-mhsw" placeholder="Cari mahasiswa...">
</div>

<div class="scroll">
<table id="tabel-mhsw">
    <thead>
        <tr><th>NIM</th><th>Nama</th><th>Alamat</th><th></th></tr>
    </thead>
    <tbody>
        <?php if (!$rows) { ?>
            <tr class="kosong"><td colspan="4">Belum ada data mahasiswa.</td></tr>
        <?php } ?>
        <?php foreach ($rows as $row) { ?>
            <tr>
                <td><span class="chip"><?php echo e($row['mhsw_nim']); ?></span></td>
                <td><div class="orang"><span class="avatar" style="--h:<?php echo abs(crc32($row['mhsw_nama'])) % 360; ?>"><?php echo e(inisial($row['mhsw_nama'])); ?></span><span><?php echo e($row['mhsw_nama']); ?></span></div></td>
                <td><?php echo e($row['mhsw_alamat'] ?: '-'); ?></td>
                <td>
                    <div class="aksi">
                        <a href="index.php?page=mhsw_edit&id=<?php echo (int) $row['mhsw_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <form action="mhsw_proses.php?action=delete" method="post" class="inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            <input type="hidden" name="mhsw_id" value="<?php echo (int) $row['mhsw_id']; ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
</div>
