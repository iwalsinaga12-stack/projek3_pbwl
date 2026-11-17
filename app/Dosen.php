<?php

// NAMESPACE: kelas ini berada di namespace App, Koneksi diambil dari namespace Inc.
namespace App;

use Inc\Koneksi;

class Dosen extends Koneksi
{

    // Menampilkan semua data
    public function index(): array
    {
        return $this->koneksi->query("SELECT * FROM tb_dosen ORDER BY dosen_nama")->fetchAll();
    }

    // Data terbaru (dipakai dashboard)
    public function latest(int $n = 5): array
    {
        return $this->koneksi->query("SELECT * FROM tb_dosen ORDER BY dosen_id DESC LIMIT " . (int) $n)->fetchAll();
    }

    public function total(): int
    {
        return (int) $this->koneksi->query("SELECT COUNT(*) FROM tb_dosen")->fetchColumn();
    }

    // Menyimpan data baru (prepared statement -> aman dari SQL injection)
    public function store(): void
    {
        $stmt = $this->koneksi->prepare("INSERT INTO tb_dosen (dosen_nip, dosen_nama, dosen_golongan) VALUES (:dosen_nip, :dosen_nama, :dosen_golongan)");
        $stmt->execute([
            ':dosen_nip' => trim($_POST['dosen_nip'] ?? ''),
            ':dosen_nama' => trim($_POST['dosen_nama'] ?? ''),
            ':dosen_golongan' => trim($_POST['dosen_golongan'] ?? ''),
        ]);
    }

    public function edit($id)
    {
        $stmt = $this->koneksi->prepare("SELECT * FROM tb_dosen WHERE dosen_id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function update(): void
    {
        $stmt = $this->koneksi->prepare("UPDATE tb_dosen SET dosen_nip = :dosen_nip, dosen_nama = :dosen_nama, dosen_golongan = :dosen_golongan WHERE dosen_id = :id");
        $stmt->execute([
            ':dosen_nip' => trim($_POST['dosen_nip'] ?? ''),
            ':dosen_nama' => trim($_POST['dosen_nama'] ?? ''),
            ':dosen_golongan' => trim($_POST['dosen_golongan'] ?? ''),
            ':id' => $_POST['dosen_id'] ?? 0,
        ]);
    }

    public function delete($id): void
    {
        $stmt = $this->koneksi->prepare("DELETE FROM tb_dosen WHERE dosen_id = :id");
        $stmt->execute([':id' => $id]);
    }
}
