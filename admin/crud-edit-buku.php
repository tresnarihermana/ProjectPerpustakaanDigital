<?php
include '../koneksi.php';

$bukuid = $_POST['BukuID'];
$judul = $_POST['Judul'];
$deskripsi = $_POST['Deskripsi'];
$penulis = $_POST['Penulis'];
$penerbit = $_POST['penerbit'];
$tahun = $_POST['TahunTerbit'];

$data = mysqli_query($koneksi, "SELECT * FROM buku WHERE BukuID != '$bukuid' AND Judul = '$judul'");
$cek = mysqli_fetch_assoc($data);

if (mysqli_num_rows($data) > 0) {
    header("location: buku.php?pesan=duplikat");
} else {
    $query = "UPDATE buku SET BukuID = '$bukuid', Judul = '$judul', Deskripsi = '$deskripsi', Penulis = '$penulis', penerbit = '$penerbit', TahunTerbit = '$tahun' WHERE BukuID = '$bukuid'";
    if (mysqli_query($koneksi, $query) && $bukuid > 0) {
        header("location: buku.php?pesan=berhasil");
    } else {
        header("location: buku.php?pesan=gagal");
    }
}