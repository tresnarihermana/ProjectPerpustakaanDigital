<?php
include 'koneksi.php';
$username = $_POST['Username'];
$password = $_POST['Password'];
$Email = $_POST['Email'];
$Alamat = $_POST['Alamat'];
$NamaLengkap = $_POST['NamaLengkap'];
$role = 'user';

if (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.com$/', $email)) {
    header("location:register.html?pesan=gagal");
    die;
}else{

$data = mysqli_query($koneksi, "INSERT INTO user VALUES ('', '$username', '$password', '$Email', '$NamaLengkap', '$Alamat', '$role')");
header("location: login.html");
}
?>