<?php
include("../../koneksi.php");

// cek aksi dari form
if ($aksi = $_POST['aksi']) {

    // buat nambah data
    if ($aksi == 'tambah') {
        $id_user = $_POST['id_user'];
        $nis = $_POST['nis'];
        $nama_siswa = $_POST['nama_siswa'];
        $id_kelas = $_POST['id_kelas'];
        $tgl_lahir = $_POST['tgl_lahir'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $alamat = $_POST['alamat'];
        $no_hp = $_POST['no_hp'];

        // memasukin data ke tabel
        $query = "INSERT INTO siswa VALUES(NULL,'$id_user','$nis','$nama_siswa','$id_kelas','$tgl_lahir','$jenis_kelamin','$alamat','$no_hp')";

        mysqli_query($koneksi, $query);

        // balik ke data siswa
        header("location:../index.php?menu=data_siswa&pesan=berhasil");

    // buat edit data
    } elseif ($aksi == 'edit') {
        $id_siswa = $_POST['id_siswa'];
        $id_user = $_POST['id_user'];
        $nis = $_POST['nis'];
        $nama_siswa = $_POST['nama_siswa'];
        $id_kelas = $_POST['id_kelas'];
        $tgl_lahir = $_POST['tgl_lahir'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $alamat = $_POST['alamat'];
        $no_hp = $_POST['no_hp'];

        // ubah data yg dipilih
        $query = "UPDATE siswa SET
            id_user = '$id_user',
            nis = '$nis',
            nama_siswa = '$nama_siswa',
            id_kelas = '$id_kelas',
            tgl_lahir = '$tgl_lahir',
            jenis_kelamin = '$jenis_kelamin',
            alamat = '$alamat',
            no_hp = '$no_hp'
        WHERE id_siswa = '$id_siswa'";

        mysqli_query($koneksi, $query);

        header("location:../index.php?menu=data_siswa&pesan=edit");
    }
}

// cek kalo mau hapus
if ($aksi = $_GET['aksi']) {

    if ($aksi == 'hapus') {
        $id = $_GET['id_siswa'];

        // hapus data yg dipilih
        $query = "DELETE FROM siswa WHERE id_siswa='$id'";

        mysqli_query($koneksi, $query);

        header("location:../index.php?menu=data_siswa&pesan=hapus");
    }
}

