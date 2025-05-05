<?php
include '../koneksi.php';
$namakategori = $_POST['namakategori'];
$kategoriID = $_POST['kategoriID'];
$data = mysqli_query($koneksi, "SELECT * FROM kategoribuku WHERE Namakategori = '$namakategori' AND KategoriID = '$kategoriID'");
$cek = mysqli_fetch_assoc($data);
 if (mysqli_num_rows($data) == 0) {
    header("location: kategori.php?pesan=duplikat");
} else {
    $query = "UPDATE kategoribuku SET Namakategori = '$namakategori' WHERE KategoriID = '$kategoriID'";
    if (mysqli_query($koneksi, $query) && $kategoriID > 0) {
        header("location: kategori.php?pesan=berhasil");
    } else {
        header("location: kategori.php?pesan=gagal");
    }
}