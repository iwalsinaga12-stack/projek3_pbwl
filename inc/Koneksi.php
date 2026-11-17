<?php

namespace Inc;

use PDO;
use PDOException;

class Koneksi
{
    protected PDO $koneksi;

    public function __construct()
    {
        try {
            $this->koneksi = new PDO(
                "mysql:host=localhost;dbname=db_projek3_si2;charset=utf8mb4", "root", "",
                [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]
            );
        } catch (PDOException $e) {
            die("Koneksi gagal: " . $e->getMessage());
        }
    }
}
