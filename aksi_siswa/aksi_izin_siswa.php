<?php
session_start();
include("../koneksi.php");

// cek udah login apa belum
if (!isset($_SESSION['nama_siswa'])) {
    header("Location: ../login.php?pesan=belum_login");
    exit;
}

// ambil id siswa dari session
if (isset($_SESSION['id_siswa'])) {
    $id_siswa = $_SESSION['id_siswa'];
} else {

    // kalo id belum ada, cari lewat nama
    $nama_siswa = $_SESSION['nama_siswa'];
    $query_cek = "SELECT id_siswa FROM siswa WHERE nama_siswa = '$nama_siswa' LIMIT 1";
    $result_cek = mysqli_query($koneksi, $query_cek);
    $row_cek = mysqli_fetch_assoc($result_cek);
    $id_siswa = $row_cek ? $row_cek['id_siswa'] : null;
}

// cek id siswa
if (empty($id_siswa)) {
    header("Location: ../index.php?pesan=gagal_session");
    exit;
}

// cek kalo mau nambah izin
if (isset($_POST['aksi']) && $_POST['aksi'] == 'tambah') {
    $id_jenis = $_POST['id_jenis'];
    $tanggal = $_POST['tanggal'];
    $waktu_mulai = $_POST['waktu_mulai'];
    $waktu_selesai = $_POST['waktu_selesai'];
    $alasan = $_POST['alasan'];
    $status = 'menunggu';
    $tgl_dibuat = date('Y-m-d H:i:s');

    // tempat nyimpen surat
    $upload_dir = "../admin/uploads/";

    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    // siapin file surat
    $file_surat = '';

    // cek kalo ada file
    if (isset($_FILES['file_surat']) && $_FILES['file_surat']['error'] == 0) {
        $file_name = time() . '_' . basename($_FILES['file_surat']['name']);
        move_uploaded_file($_FILES['file_surat']['tmp_name'], $upload_dir . $file_name);
        $file_surat = $file_name;
    }

    // masukin data izin
    $query = "INSERT INTO izin (id_siswa, id_jenis, tanggal, waktu_mulai, waktu_selesai, alasan, file_surat, status, tgl_dibuat) 
              VALUES ('$id_siswa','$id_jenis','$tanggal','$waktu_mulai','$waktu_selesai','$alasan','$file_surat','$status','$tgl_dibuat')";

    mysqli_query($koneksi, $query);

    header("Location: ../index.php?pesan=berhasil");
    exit;
}

// kalo gak ada aksi, balik aja
header("Location: ../index.php");
exit;
