<?php
include '../koneksi.php';

$UlasanID = $_POST['UlasanID'];
$UserID   = $_POST['user'];
$BukuID   = $_POST['buku'];
$Ulasan   = $_POST['ulasan'];
$Rating   = $_POST['rating'];

$query = "UPDATE ulasanbuku SET 
            UserID = '$UserID',
            BukuID = '$BukuID',
            Ulasan = '$Ulasan',
            Rating = '$Rating'
          WHERE UlasanID = '$UlasanID'";

if (mysqli_query($koneksi, $query)) {
    header("Location: ulasan.php?pesan=berhasil");
} else {
    header("Location: ulasan.php?pesan=gagal");
}
?>
