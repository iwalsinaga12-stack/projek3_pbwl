# Project 3 - SIAKAD Mini (namespace)

Tema tampilan: **cetak biru sistem**.

## Cara menjalankan
1. Import `database.sql` lewat phpMyAdmin (membuat database `db_projek3_si2` + data contoh).
2. Taruh folder ini di `htdocs` (XAMPP), buka `http://localhost/project3/`.
3. Koneksi default: `localhost`, user `root`, tanpa password (ubah di `inc/Koneksi.php`).

## Konsep: Namespace
File kelas: inc/Koneksi.php (Inc\Koneksi), app/*.php (App\Mahasiswa, App\Dosen, App\Matakuliah)

## Modul
Mahasiswa, Dosen, dan Matakuliah: masing-masing lengkap (daftar + cari, tambah, edit, hapus).
Halaman: `X.php`, `X_input.php`, `X_edit.php`, `X_proses.php` (X = mhsw / dosen / matkul).
