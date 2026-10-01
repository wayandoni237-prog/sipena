<?php 
include("../../koneksi.php"); 

//Mengecek aksi yang dikirim melalui form
if ($aksi = $_POST['aksi']) { 
    
    if ($aksi == 'tambah') { 

        //Mengambil data dari form
        $username = $_POST['username']; 
        $password = $_POST['password']; 
        $email = $_POST['email']; 
        $no_hp = $_POST['no_hp']; 
        $nama_lengkap = $_POST['nama_lengkap']; 
        $role = $_POST['role']; 

        //Query untuk menambahkan data user
        $query = "INSERT INTO Users VALUES(NULL,'$username', 
        '$password','$nama_lengkap','$email','$no_hp','$role')"; 
        
        //menjalankan query
        mysqli_query($koneksi, $query); 

        //kembali ke data user
        header("location:../index.php?menu=data_user&pesan=berhasil"); 

    } elseif ($aksi == 'edit') { 

        // ambil id
        $id = $_POST['id']; 

        // Mengambil data dari form
        $username = $_POST['username']; 
        $password = $_POST['password']; 
        $email = $_POST['email']; 
        $no_hp = $_POST['no_hp']; 
        $nama_lengkap = $_POST['nama_lengkap']; 
        $role = $_POST['role']; 

        //Query untuk mengedit data user
        $query = "UPDATE users SET  
        username= '$username', 
        password='$password', 
        nama_lengkap='$nama_lengkap', 
        email='$email', 
        no_hp='$no_hp', 
        role='$role' 
        WHERE id_user='$id'"; 

        mysqli_query($koneksi, $query); 

        // kembali
        header("location:../index.php?menu=data_user&pesan=edit"); 
    } 
} 

//cek aksi hapus
if($aksi = $_GET['aksi']) { 

    if($aksi == 'hapus') { 

        //ambil id user
        $id = $_GET['id_user']; 

        //query hapus
        $query = "DELETE FROM users WHERE id_user='$id'"; 

        mysqli_query($koneksi, $query); 

        
        header("location:../index.php?menu=data_user&pesan=hapus"); 
    } 
}