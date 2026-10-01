<?php
include("../../koneksi.php");

// cek aksi dari form
if ($aksi = $_POST['aksi']) {

    // buat nambah data
    if ($aksi == 'tambah') {
        $nama_jenis_izin = $_POST['nama_jenis_izin'];
        $deskripsi = $_POST['deskripsi'];

        // masukin data izin
        $query = "INSERT INTO jenis_izin (nama_jenis, deskripsi)
                  VALUES('$nama_jenis_izin','$deskripsi')";

        mysqli_query($koneksi, $query);

        // balik ke data jenis izin
        header("location:../index.php?menu=data_jenis_izin&pesan=berhasil");

    // buat edit data
    } elseif ($aksi == 'edit') {
        $id_jenis_izin = $_POST['id_jenis_izin'];
        $nama_jenis_izin = $_POST['nama_jenis_izin'];
        $deskripsi = $_POST['deskripsi'];

        // ubah data izin
        $query = "UPDATE jenis_izin SET
            nama_jenis = '$nama_jenis_izin',
            deskripsi = '$deskripsi'
        WHERE id_jenis = '$id_jenis_izin'";

        mysqli_query($koneksi, $query);

        // balik setelah edit
        header("location:../index.php?menu=data_jenis_izin&pesan=edit");
    }
}

// cek kalo mau hapus
if ($aksi = $_GET['aksi']) {

    if ($aksi == 'hapus') {
        $id = $_GET['id_jenis'];

        // hapus data yg dipilih
        $query = "DELETE FROM jenis_izin WHERE id_jenis='$id'";

        mysqli_query($koneksi, $query);

        header("location:../index.php?menu=data_jenis_izin&pesan=hapus");
    }
}
