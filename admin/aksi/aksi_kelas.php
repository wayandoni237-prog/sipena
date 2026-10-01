<?php
include("../../koneksi.php");

// cek aksi dari form
if ($aksi = $_POST['aksi']) {

    // buat nambah data
    if ($aksi == 'tambah') {
        $id_kelas = $_POST['id_kelas'];
        $nama_kelas = $_POST['nama_kelas'];
        $jurusan = $_POST['jurusan'];
        $tingkat = $_POST['tingkat'];
        $wali_kelas = $_POST['wali_kelas'];

        // masukin data kelas
        $query = "INSERT INTO Kelas VALUES('$id_kelas','$nama_kelas','$jurusan','$tingkat','$wali_kelas')";

        mysqli_query($koneksi, $query);

        header("location:../index.php?menu=data_kelas&pesan=berhasil");

    // edit data
    } elseif ($aksi == 'edit') {
        $id_kelas = $_POST['id_kelas'];
        $nama_kelas = $_POST['nama_kelas'];
        $jurusan = $_POST['jurusan'];
        $tingkat = $_POST['tingkat'];
        $wali_kelas = $_POST['wali_kelas'];

        // ubah data kelas
        $query = "UPDATE Kelas SET
            nama_kelas = '$nama_kelas',
            jurusan = '$jurusan',
            tingkat = '$tingkat',
            wali_kelas = '$wali_kelas'
        WHERE id_kelas = '$id_kelas'";

        mysqli_query($koneksi, $query);

        // balik setelah edit
        header("location:../index.php?menu=data_kelas&pesan=edit");
    }
}

// cek kalo mau hapus
if ($aksi = $_GET['aksi']) {

    if ($aksi == 'hapus') {
        $id = $_GET['id_kelas'];

        // hps data yg dipilih
        $query = "DELETE FROM kelas WHERE id_kelas='$id'";

        mysqli_query($koneksi, $query);

        header("location:../index.php?menu=data_kelas&pesan=hapus");
    }
}

