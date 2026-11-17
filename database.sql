CREATE DATABASE IF NOT EXISTS db_projek3_si2 CHARACTER SET utf8mb4;
USE db_projek3_si2;

CREATE TABLE IF NOT EXISTS tb_mhsw (
      mhsw_id INT(11) NOT NULL AUTO_INCREMENT,
      mhsw_nim VARCHAR(25) NOT NULL,
      mhsw_nama VARCHAR(100) NOT NULL,
      mhsw_alamat TEXT DEFAULT NULL,
      PRIMARY KEY(mhsw_id),
      UNIQUE KEY(mhsw_nim)
);

CREATE TABLE IF NOT EXISTS tb_dosen (
      dosen_id INT(11) NOT NULL AUTO_INCREMENT,
      dosen_nip VARCHAR(25) NOT NULL,
      dosen_nama VARCHAR(100) NOT NULL,
      dosen_golongan VARCHAR(100) DEFAULT NULL,
      PRIMARY KEY(dosen_id),
      UNIQUE KEY(dosen_nip)
);

CREATE TABLE IF NOT EXISTS tb_matakuliah (
      matkul_id INT(11) NOT NULL AUTO_INCREMENT,
      matkul_kode VARCHAR(25) NOT NULL,
      matkul_nama VARCHAR(100) NOT NULL,
      matkul_sks TINYINT(3) NOT NULL,
      matkul_semester TINYINT(3) NOT NULL,
      PRIMARY KEY(matkul_id),
      UNIQUE KEY(matkul_kode)
);

-- ===== DATA CONTOH (hapus bagian ini jika ingin tabel kosong) =====
INSERT IGNORE INTO tb_mhsw (mhsw_nim, mhsw_nama, mhsw_alamat) VALUES
('2201001', 'Aisyah Putri Lubis', 'Jl. Gatot Subroto No. 12, Medan'),
('2201002', 'Rizky Ramadhan Siregar', 'Jl. Setia Budi No. 45, Medan'),
('2201003', 'Nadia Salsabila', 'Jl. Sisingamangaraja Km 5, Medan'),
('2201004', 'Fajar Hidayat Nasution', 'Jl. Merak Jingga, Binjai'),
('2201005', 'Dewi Anggraini', 'Jl. Williem Iskandar, Deli Serdang'),
('2201006', 'Bagas Prasetyo', 'Jl. Pancing, Medan');

INSERT IGNORE INTO tb_dosen (dosen_nip, dosen_nama, dosen_golongan) VALUES
('198501012010011001', 'Dr. Hendra Wijaya, M.Kom.', 'III/c'),
('198703152012012002', 'Sari Maharani, M.T.', 'III/b'),
('197912202005011003', 'Prof. Ahmad Fauzi, Ph.D.', 'IV/a'),
('199001102019031004', 'Rina Oktaviani, M.Cs.', 'III/a');

INSERT IGNORE INTO tb_matakuliah (matkul_kode, matkul_nama, matkul_sks, matkul_semester) VALUES
('TIF101', 'Algoritma dan Pemrograman', 3, 1),
('TIF102', 'Matematika Diskrit', 3, 1),
('TIF201', 'Struktur Data', 3, 2),
('TIF202', 'Pemrograman Berorientasi Objek', 3, 2),
('TIF301', 'Basis Data', 3, 3),
('TIF302', 'Jaringan Komputer', 3, 3),
('TIF401', 'Rekayasa Perangkat Lunak', 3, 4),
('TIF501', 'Pemrograman Berbasis Web Lanjutan', 4, 5),
('TIF502', 'Kecerdasan Buatan', 3, 5),
('TIF601', 'Keamanan Informasi', 2, 6);
