<?php
include '../koneksi.php';

$namakategori = $_POST['nama_kategori'];

// Cek apakah kategori dengan nama yang sama sudah ada
$cek = mysqli_query($koneksi, "SELECT * FROM kategoribuku WHERE Namakategori = '$namakategori'");

if (mysqli_num_rows($cek) > 0) {
    // Kategori duplikat
    header("location: kategori.php?pesan=duplikat");
    exit;
} else {
    // Insert data baru
    $query = mysqli_query($koneksi, "INSERT INTO kategoribuku VALUES (NULL, '$namakategori')");

    if ($query) {
        header("location: kategori.php?pesan=berhasil");
    } else {
        header("location: kategori.php?pesan=gagal");
    }
}
?>