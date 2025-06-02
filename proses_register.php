<?php
include 'koneksi.php';
$username = $_POST['Username'];
$password = md5($_POST['Password']);
$Email = $_POST['Email'];
$Alamat = $_POST['Alamat'];
$NamaLengkap = $_POST['NamaLengkap'];
$role = 'user';

if (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.com$/', $Email)) {
    header("location:register.php?pesan=datainvalid");
    die;
}else{

$data = mysqli_query($koneksi, "INSERT INTO user VALUES ('', '$username', '$password', '$Email', '$NamaLengkap', '$Alamat', '$role')");
header("location: login.php?pesan=berhasildaftar");
}
?>