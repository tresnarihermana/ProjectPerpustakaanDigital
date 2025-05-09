<?php
include '../koneksi.php';

$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM buku WHERE BukuID = '$id'");
$cek = mysqli_fetch_assoc($data);

if (mysqli_num_rows($data) == 0) {
    header("location: pengguna.php?pesan=gagal");
} else {
$query1 = mysqli_query($koneksi, "DELETE FROM ulasanbuku WHERE BukuID = '$id'");
$query2 = mysqli_query($koneksi, "DELETE FROM buku WHERE BukuID = '$id'");

    if (mysqli_query($koneksi, $query1, $query2) && $id > 0) {
        header("location: buku.php?pesan=berhasil");
    } else {
        header("location: buku.php?pesan=gagal");
    }
}

?>