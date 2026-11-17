<?php

require_once "inc/Koneksi.php";
require_once "app/Matakuliah.php";

$matkul = new App\Matakuliah();

$action = $_GET['action'] ?? '';
$isPost = $_SERVER['REQUEST_METHOD'] === 'POST';
$status = '';

// Validasi sisi server: kolom wajib tidak boleh kosong
$valid = true;
foreach (['matkul_kode', 'matkul_nama', 'matkul_sks', 'matkul_semester'] as $f) {
    if (trim($_POST[$f] ?? '') === '') {
        $valid = false;
    }
}
$valid = $valid && filter_var($_POST['matkul_sks'] ?? '', FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'max_range' => 6]]) !== false;
$valid = $valid && filter_var($_POST['matkul_semester'] ?? '', FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'max_range' => 8]]) !== false;

try {
    switch ($action) {
        case 'store':
            if ($isPost && isset($_POST['store'])) {
                if ($valid) { $matkul->store(); $status = 'saved'; } else { $status = 'invalid'; }
            }
            break;

        case 'update':
            if ($isPost && isset($_POST['update'])) {
                if ($valid) { $matkul->update(); $status = 'updated'; } else { $status = 'invalid'; }
            }
            break;

        case 'delete': // hapus hanya lewat POST (bukan link GET)
            if ($isPost && isset($_POST['matkul_id'])) {
                $matkul->delete($_POST['matkul_id']);
                $status = 'deleted';
            }
            break;
    }
} catch (PDOException $e) {
    // 23000 = pelanggaran UNIQUE (Kode mata kuliah kembar)
    $status = ($e->getCode() === '23000') ? 'dup' : 'error';
}

header("Location: index.php?page=matkul" . ($status ? "&status=" . $status : ""));
exit;
