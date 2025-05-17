<?php
include '../koneksi.php';

$buku = $_POST['buku'];
$kategori = $_POST['kategori'];

$query = "INSERT INTO Kategoribuku_relasi (BukuID, KategoriID) VALUES ('$buku', '$kategori')";

if (mysqli_query($koneksi, $query)) {
    header("Location: koleksi-kategori.php?pesan=berhasil");
} else {
    header("Location: koleksi-kategori.php?pesan=gagal");
}
?>
