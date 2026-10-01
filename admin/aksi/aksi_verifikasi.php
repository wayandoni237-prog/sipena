<?php
session_start();
include("../../koneksi.php");

if (isset($_POST['aksi']) && $_POST['aksi'] == 'verifikasi') {
    if (!isset($_SESSION['username'])) {
        header("Location: ../login.php");
        exit;
    }

    // cari id_user (guru yang login) dari session
    $query_user = "SELECT id_user FROM users WHERE username = '" . $_SESSION['username'] . "'";
    $res_user = mysqli_query($koneksi, $query_user);
    $row_user = mysqli_fetch_assoc($res_user);

    if (!$row_user) {
        header("Location: ../index.php?menu=data_verifikasi&pesan=gagal");
        exit;
    }

    $id_guru     = $row_user['id_user'];
    $id_izin     = $_POST['id_izin'];
    $keputusan   = $_POST['keputusan'];
    $catatan     = $_POST['catatan'];
    $tgl_verifikasi = date('Y-m-d H:i:s');

    // validasi keputusan
    if (!in_array($keputusan, ['disetujui', 'ditolak'])) {
        header("Location: ../index.php?menu=data_verifikasi&pesan=gagal");
        exit;
    }

    // cek apakah izin sudah pernah diverifikasi
    $cek = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT id_verifikasi FROM verifikasi WHERE id_izin = '$id_izin'"));
    if ($cek) {
        header("Location: ../index.php?menu=data_verifikasi&pesan=sudah");
        exit;
    }

    // simpan catatan verifikasi
    $query_insert = "INSERT INTO verifikasi (id_izin, id_guru, keputusan, catatan, tgl_verifikasi)
                     VALUES ('$id_izin', '$id_guru', '$keputusan', '$catatan', '$tgl_verifikasi')";
    mysqli_query($koneksi, $query_insert);

    // update status izin sesuai keputusan
    mysqli_query($koneksi, "UPDATE izin SET status = '$keputusan' WHERE id_izin = '$id_izin'");

    header("Location: ../index.php?menu=data_verifikasi&pesan=berhasil");
    exit;
}

header("Location: ../index.php?menu=data_verifikasi");
exit;