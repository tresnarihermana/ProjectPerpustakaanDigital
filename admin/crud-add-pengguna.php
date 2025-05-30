<?php
include '../koneksi.php';
$username = $_POST['username'];
$password = md5($_POST['password']);
$email = $_POST['email'];
$namaLengkap = $_POST['namalengkap'];
$alamat = $_POST['alamat'];
$role = $_POST['role'];

if (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.com$/', $email)) {
    header("location:pengguna.php?pesan=gagal");
    die;
}

$data = mysqli_query($koneksi, "SELECT * FROM user WHERE Username = '$username'");
$cek = mysqli_fetch_assoc($data);
if (mysqli_num_rows($data) > 0) {
    // Username sudah ada
    header("location: pengguna.php?pesan=duplikat");
} else {
    // Insert data baru
    $query = mysqli_query($koneksi, "INSERT INTO user VALUES ('', '$username', '$password', '$email', '$namaLengkap', '$alamat', '$role')");

    if ($query) {
        header("location: pengguna.php?pesan=berhasil");
    } else {
        header("location: pengguna.php?pesan=gagal");
    }
}


?>