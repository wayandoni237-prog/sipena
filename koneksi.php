<?php
//Set konfigurasi koneksei ke database
$host = "localhost"; //server database
$username = "root"; //ussername MysQl
$password = ""; //password mysql
$database = "absen-siswa"; //nama database

//membuat koneksi
$koneksi = new mysqli($host, $username, $password, $database);

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Jika berhasil, echo ini
// echo "Koneksi berhasil!";