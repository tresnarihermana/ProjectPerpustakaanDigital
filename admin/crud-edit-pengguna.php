<?php
include '../koneksi.php';

$id = $_POST['userID'];
$username = $_POST['username'];
$password = md5($_POST['password']);
$email = $_POST['email'];
$namalengkap = $_POST['namalengkap'];
$alamat = $_POST['alamat'];
$role = $_POST['role'];

if (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.com$/', $email)) {
    header("location:pengguna.php?pesan=gagal");
    die;
}

$data = mysqli_query($koneksi, "SELECT * FROM user WHERE Username = '$username' AND UserID != '$id'");
$cek = mysqli_fetch_assoc($data);

if (mysqli_num_rows($data) > 0) {
    header("location: pengguna.php?pesan=duplikat");
} else {
    $query = "UPDATE user SET Username = '$username', Password = '$password', Email = '$email', NamaLengkap = '$namalengkap', Alamat = '$alamat', role = '$role' WHERE UserID = '$id'";
    if (mysqli_query($koneksi, $query)) {
        header("location: pengguna.php?pesan=berhasil");
    } else {
        header("location: pengguna.php?pesan=gagal");
    }
}



?>