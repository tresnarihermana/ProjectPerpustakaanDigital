<?php
include 'koneksi.php';
$username = $_POST['Username'];
$password = $_POST['Password'];
$Email = $_POST['Email'];
$Alamat = $_POST['Alamat'];
$NamaLengkap = $_POST['NamaLengkap'];
$role = 'user';
$data = mysqli_query($koneksi, "INSERT INTO user VALUES ('', '$username', '$password', '$Email', '$NamaLengkap', '$Alamat', '$role')");
header("location: login.html");
?>