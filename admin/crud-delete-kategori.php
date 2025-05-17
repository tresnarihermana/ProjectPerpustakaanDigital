<?php
include '../koneksi.php';

$kategoriID = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM kategoribuku WHERE KategoriID = '$kategoriID'");
$cek = mysqli_fetch_assoc($data);

if (mysqli_num_rows($data) == 0) {
    header("location: kategori.php?pesan=gagal");
} else {
    $query = "DELETE FROM kategoribuku WHERE KategoriID = '$kategoriID'";
    if (mysqli_query($koneksi, $query) && $kategoriID > 0) {
        header("location: kategori.php?pesan=berhasil");
    } else {
        header("location: kategori.php?pesan=gagal");
    }
}
// Hapus file cover jika ada
$cover = $cek['coverkategori'];
if (!empty($cover)) {
    $filePath = "../storage/upload/" . $cover;
    if (file_exists($filePath)) {
        unlink($filePath);
    }
}
?>