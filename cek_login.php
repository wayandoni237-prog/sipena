<?php
session_start();
include("koneksi.php");

$nis = $_POST['nis'];
$password = $_POST['password'];

$query = "SELECT * FROM siswa WHERE nis = ? AND id_user = ?";
$stmt  = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, "ss", $nis, $password);
mysqli_stmt_execute($stmt);
$sql = mysqli_stmt_get_result($stmt);
$row = mysqli_num_rows($sql);

if ($row > 0) {
    $r = mysqli_fetch_array($sql);
    $_SESSION['nama_siswa'] = $r['nama_siswa'];
    $_SESSION['id_siswa']   = $r['id_siswa'];
    $_SESSION['id_kelas']   = $r['id_kelas'];

    header("location:index.php");
} else {
    header("location:login.php?pesan=gagal");
}