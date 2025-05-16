<?php
include "../koneksi.php";

$id = $_GET['id'];
$query = mysqli_query($koneksi, "DELETE FROM Kategoribuku_relasi WHERE KategoriID = '$id'");
if ($query) {
        header("location: koleksi-kategori.php?pesan=berhasil");
    } else {
        header("location: koleksi-kategori.php?pesan=gagal");
    }
?>