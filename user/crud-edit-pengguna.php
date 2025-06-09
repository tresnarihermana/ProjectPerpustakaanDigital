<?php
session_start();
include '../koneksi.php';

$id = $_POST['UserID'];
$username = trim($_POST['Username']);
$email = trim($_POST['Email']);
$namalengkap = trim($_POST['NamaLengkap']);
$alamat = trim($_POST['Alamat']);

$oldpass = md5($_POST['oldpass']); // Hash inputan password lama
$passwordBaru = md5($_POST['Password']);
$confpass = md5($_POST['confpass']);

// Ambil data user dari DB
$user = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM user WHERE UserID = '$id'"));

// Cek apakah password lama cocok
if ($oldpass !== $user['Password']) {
    header("Location:../edit-profile.php?pesan=password_salah");
    exit;
}

// Cek konfirmasi password
if ($passwordBaru !== $confpass) {
    header("Location:../edit-profile.php?pesan=konfirmasi_gagal");
    exit;
}

// Lanjut update
$update = mysqli_query($koneksi, "UPDATE user SET 
    Username = '$username', 
    Email = '$email', 
    NamaLengkap = '$namalengkap', 
    Alamat = '$alamat', 
    Password = '$passwordBaru' 
    WHERE UserID = '$id'
");

if ($update) {
    $_SESSION['username'] = $username;
    header("Location:../edit-profile.php?pesan=berhasil");
} else {
    header("Location:../edit-profile.php?pesan=gagal");
}
