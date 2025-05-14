<?php
include '../koneksi.php';

$UlasanID = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM ulasanbuku WHERE UlasanID = '$UlasanID'");
$cek = mysqli_fetch_assoc($data);

if (mysqli_num_rows($data) == 0) {
    header("location: ulasan.php?pesan=gagal");
} else {
    $query = "DELETE FROM ulasanbuku WHERE UlasanID = '$UlasanID'";
    if (mysqli_query($koneksi, $query) && $UlasanID){
        header("location: ulasan.php?pesan=berhasil");
    } else {
        header("location: ulasan.php?pesan=gagal");
    }
}

?>