<?php

require_once "inc/Koneksi.php";
require_once "app/Dosen.php";

$dosen = new App\Dosen();

$action = $_GET['action'] ?? '';
$isPost = $_SERVER['REQUEST_METHOD'] === 'POST';
$status = '';

// Validasi sisi server: kolom wajib tidak boleh kosong
$valid = true;
foreach (['dosen_nip', 'dosen_nama'] as $f) {
    if (trim($_POST[$f] ?? '') === '') {
        $valid = false;
    }
}

try {
    switch ($action) {
        case 'store':
            if ($isPost && isset($_POST['store'])) {
                if ($valid) { $dosen->store(); $status = 'saved'; } else { $status = 'invalid'; }
            }
            break;

        case 'update':
            if ($isPost && isset($_POST['update'])) {
                if ($valid) { $dosen->update(); $status = 'updated'; } else { $status = 'invalid'; }
            }
            break;

        case 'delete': // hapus hanya lewat POST (bukan link GET)
            if ($isPost && isset($_POST['dosen_id'])) {
                $dosen->delete($_POST['dosen_id']);
                $status = 'deleted';
            }
            break;
    }
} catch (PDOException $e) {
    // 23000 = pelanggaran UNIQUE (NIP kembar)
    $status = ($e->getCode() === '23000') ? 'dup' : 'error';
}

header("Location: index.php?page=dosen" . ($status ? "&status=" . $status : ""));
exit;
