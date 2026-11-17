<?php
date_default_timezone_set('Asia/Jakarta');

// Daftar halaman yang boleh di-include (whitelist, mencegah akses file sembarang)
$pages = ['mhsw', 'mhsw_input', 'mhsw_edit', 'dosen', 'dosen_input', 'dosen_edit', 'matkul', 'matkul_input', 'matkul_edit'];
$page  = $_GET['page'] ?? 'dashboard';
$menu  = explode('_', $page)[0]; // mhsw_input -> mhsw (untuk menu aktif)

// Escape output agar aman dari XSS
function e($v) { return htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8'); }

// Inisial nama untuk avatar: "Aisyah Putri Lubis" -> "AL"
function inisial($nama) {
    $kata = preg_split('/\s+/u', trim((string) $nama), -1, PREG_SPLIT_NO_EMPTY);
    if (!$kata) return '?';
    preg_match('/^./u', reset($kata), $a);
    $hasil = strtoupper($a[0] ?? '');
    if (count($kata) > 1) { preg_match('/^./u', end($kata), $b); $hasil .= strtoupper($b[0] ?? ''); }
    return $hasil;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project 3 - SIAKAD Mini</title>
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body class="p3">
<div class="shell">
    <aside>
        <header>
            <div class="brand">P3</div>
            <div class="user">SIAKAD Mini</div>
        </header>

        <nav>
            <ul>
                <li><a href="index.php" class="<?php echo ($menu === 'dashboard') ? 'active' : ''; ?>">🏠 Dashboard</a></li>
                <li><a href="index.php?page=mhsw" class="<?php echo ($menu === 'mhsw') ? 'active' : ''; ?>">🎓 Mahasiswa</a></li>
                <li><a href="index.php?page=dosen" class="<?php echo ($menu === 'dosen') ? 'active' : ''; ?>">🧑‍🏫 Dosen</a></li>
                <li><a href="index.php?page=matkul" class="<?php echo ($menu === 'matkul') ? 'active' : ''; ?>">📚 Matakuliah</a></li>
            </ul>
        </nav>
    </aside>

    <main>
        <article>
            <?php
            if ($page === 'dashboard') {
                include "main.php";
            } elseif (in_array($page, $pages, true)) {
                include $page . ".php";
            } else {
                echo '<div class="alert alert-warning">Halaman tidak ditemukan.</div>';
            }
            ?>
        </article>

        <footer>Project 3 · namespace · // blueprint v1.0</footer>
    </main>
</div>

<script>
(function () {
    // Jam & tanggal hidup
    var jam = document.getElementById('jam');
    function tik() {
        if (!jam) return;
        var d = new Date();
        jam.textContent = d.toLocaleDateString('id-ID', {weekday: 'long', day: 'numeric', month: 'long', year: 'numeric'}) +
                          ' · ' + d.toLocaleTimeString('id-ID');
    }
    tik(); setInterval(tik, 1000);

    // Angka statistik berhitung naik
    document.querySelectorAll('[data-n]').forEach(function (el) {
        var t = +el.dataset.n, i = 0, step = Math.max(1, Math.ceil(t / 25));
        var h = setInterval(function () { i = Math.min(t, i + step); el.textContent = i; if (i >= t) clearInterval(h); }, 30);
    });

    // Pencarian langsung pada tabel
    document.querySelectorAll('.cari').forEach(function (inp) {
        var tb = document.getElementById(inp.dataset.target);
        inp.addEventListener('input', function () {
            var q = inp.value.toLowerCase();
            tb.querySelectorAll('tbody tr:not(.kosong)').forEach(function (tr) {
                tr.style.display = tr.textContent.toLowerCase().indexOf(q) > -1 ? '' : 'none';
            });
        });
    });

    // Pesan status hilang sendiri
    document.querySelectorAll('.alert[data-auto]').forEach(function (a) {
        setTimeout(function () { a.classList.add('hilang'); }, 4500);
    });
})();
</script>
</body>

</html>
