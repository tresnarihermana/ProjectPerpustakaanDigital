<?php
include 'koneksi.php';
$username = $_POST['Username'];
$password = $_POST['Password'];
$Email = $_POST['Email'];
$Alamat = $_POST['Alamat'];
$NamaLengkap = $_POST['NamaLengkap'];
$level = 1;

$data = mysqli_query($koneksi, "INSERT INTO user VALUES ('', '$username', '$password', '$Email', '$NamaLengkap', '$Alamat')");
if ($level == 1) {
    header("location: index.html");
} else {
    header("location: admin/index.php");
}
?>