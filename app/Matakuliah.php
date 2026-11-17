<?php

// NAMESPACE: kelas ini berada di namespace App, Koneksi diambil dari namespace Inc.
namespace App;

use Inc\Koneksi;

class Matakuliah extends Koneksi
{

    // Menampilkan semua data
    public function index(): array
    {
        return $this->koneksi->query("SELECT * FROM tb_matakuliah ORDER BY matkul_semester, matkul_kode")->fetchAll();
    }

    // Data terbaru (dipakai dashboard)
    public function latest(int $n = 5): array
    {
        return $this->koneksi->query("SELECT * FROM tb_matakuliah ORDER BY matkul_id DESC LIMIT " . (int) $n)->fetchAll();
    }

    public function total(): int
    {
        return (int) $this->koneksi->query("SELECT COUNT(*) FROM tb_matakuliah")->fetchColumn();
    }

    // Menyimpan data baru (prepared statement -> aman dari SQL injection)
    public function store(): void
    {
        $stmt = $this->koneksi->prepare("INSERT INTO tb_matakuliah (matkul_kode, matkul_nama, matkul_sks, matkul_semester) VALUES (:matkul_kode, :matkul_nama, :matkul_sks, :matkul_semester)");
        $stmt->execute([
            ':matkul_kode' => trim($_POST['matkul_kode'] ?? ''),
            ':matkul_nama' => trim($_POST['matkul_nama'] ?? ''),
            ':matkul_sks' => trim($_POST['matkul_sks'] ?? ''),
            ':matkul_semester' => trim($_POST['matkul_semester'] ?? ''),
        ]);
    }

    public function edit($id)
    {
        $stmt = $this->koneksi->prepare("SELECT * FROM tb_matakuliah WHERE matkul_id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function update(): void
    {
        $stmt = $this->koneksi->prepare("UPDATE tb_matakuliah SET matkul_kode = :matkul_kode, matkul_nama = :matkul_nama, matkul_sks = :matkul_sks, matkul_semester = :matkul_semester WHERE matkul_id = :id");
        $stmt->execute([
            ':matkul_kode' => trim($_POST['matkul_kode'] ?? ''),
            ':matkul_nama' => trim($_POST['matkul_nama'] ?? ''),
            ':matkul_sks' => trim($_POST['matkul_sks'] ?? ''),
            ':matkul_semester' => trim($_POST['matkul_semester'] ?? ''),
            ':id' => $_POST['matkul_id'] ?? 0,
        ]);
    }

    public function delete($id): void
    {
        $stmt = $this->koneksi->prepare("DELETE FROM tb_matakuliah WHERE matkul_id = :id");
        $stmt->execute([':id' => $id]);
    }

    // Total SKS seluruh mata kuliah
    public function totalSks(): int
    {
        return (int) $this->koneksi->query("SELECT COALESCE(SUM(matkul_sks), 0) FROM tb_matakuliah")->fetchColumn();
    }

    // Jumlah mata kuliah per semester (untuk grafik batang di dashboard)
    public function perSemester(): array
    {
        return $this->koneksi->query(
            "SELECT matkul_semester AS smt, COUNT(*) AS jml FROM tb_matakuliah GROUP BY matkul_semester ORDER BY smt"
        )->fetchAll();
    }
}
