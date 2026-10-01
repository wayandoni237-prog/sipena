<?php
//Mengecek parameter menu yang ada di URL
if (isset($_GET['menu'])) {
    $menu = $_GET['menu'];
    //Menyertakan halaman berdasarkan menu yang dipilih
    switch ($menu) {
        case 'beranda':
            include('konten/beranda.php'); //menyertakan halaman
            // home.php
            break;
        case 'data_user':
            include('konten/data_user.php'); //menyertakan halaman
            // data_users.php
            break;
        case 'data_siswa':
            include('konten/data_siswa.php'); //menyertakan halaman
            // data_siswa.php
            break;
        case 'data_kelas':
            include('konten/data_kelas.php'); //menyertakan halaman
            // data_kelas.php
            break;
        case 'data_jenis_izin':
            include('konten/data_jenis_izin.php'); //menyertakan halaman
            // data_jenis_izin.php
            break;
        case 'data_izin':
            include('konten/data_izin.php'); //menyertakan halaman
            // data_izin.php
            break;
        case 'data_verifikasi':
            include('konten/data_verifikasi.php'); //menyertakan halaman
            // data_verifikasi.php
            break;
    }
} else {
    include('konten/beranda.php'); //default,menampilkan beranda.
    //php jika tidak ada parameter menu 
}
