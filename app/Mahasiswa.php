<?php

// NAMESPACE: kelas ini berada di namespace App, Koneksi diambil dari namespace Inc.
namespace App;

use Inc\Koneksi;

class Mahasiswa extends Koneksi
{

    // Menampilkan semua data
    public function index(): array
    {
        return $this->koneksi->query("SELECT * FROM tb_mhsw ORDER BY mhsw_nim")->fetchAll();
    }

    // Data terbaru (dipakai dashboard)
    public function latest(int $n = 5): array
    {
        return $this->koneksi->query("SELECT * FROM tb_mhsw ORDER BY mhsw_id DESC LIMIT " . (int) $n)->fetchAll();
    }

    public function total(): int
    {
        return (int) $this->koneksi->query("SELECT COUNT(*) FROM tb_mhsw")->fetchColumn();
    }

    // Menyimpan data baru (prepared statement -> aman dari SQL injection)
    public function store(): void
    {
        $stmt = $this->koneksi->prepare("INSERT INTO tb_mhsw (mhsw_nim, mhsw_nama, mhsw_alamat) VALUES (:mhsw_nim, :mhsw_nama, :mhsw_alamat)");
        $stmt->execute([
            ':mhsw_nim' => trim($_POST['mhsw_nim'] ?? ''),
            ':mhsw_nama' => trim($_POST['mhsw_nama'] ?? ''),
            ':mhsw_alamat' => trim($_POST['mhsw_alamat'] ?? ''),
        ]);
    }

    public function edit($id)
    {
        $stmt = $this->koneksi->prepare("SELECT * FROM tb_mhsw WHERE mhsw_id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function update(): void
    {
        $stmt = $this->koneksi->prepare("UPDATE tb_mhsw SET mhsw_nim = :mhsw_nim, mhsw_nama = :mhsw_nama, mhsw_alamat = :mhsw_alamat WHERE mhsw_id = :id");
        $stmt->execute([
            ':mhsw_nim' => trim($_POST['mhsw_nim'] ?? ''),
            ':mhsw_nama' => trim($_POST['mhsw_nama'] ?? ''),
            ':mhsw_alamat' => trim($_POST['mhsw_alamat'] ?? ''),
            ':id' => $_POST['mhsw_id'] ?? 0,
        ]);
    }

    public function delete($id): void
    {
        $stmt = $this->koneksi->prepare("DELETE FROM tb_mhsw WHERE mhsw_id = :id");
        $stmt->execute([':id' => $id]);
    }
}
