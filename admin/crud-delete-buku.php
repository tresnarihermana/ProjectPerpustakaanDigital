<?php
include '../koneksi.php';

$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM buku WHERE BukuID = '$id'");
$cek = mysqli_fetch_assoc($data);

if (mysqli_num_rows($data) == 0) {
    header("location: buku.php?pesan=gagali");
} else {
$query = "DELETE FROM buku WHERE BukuID = '$id'";

    if (mysqli_query($koneksi, $query) && $id > 0) {
        header("location: buku.php?pesan=berhasil");
    } else {
        header("location: buku.php?pesan=gagalo");
    }
}

?>