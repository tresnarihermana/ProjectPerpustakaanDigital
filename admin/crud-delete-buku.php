<?php
include '../koneksi.php';

$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM buku WHERE BukuID = '$id'");
$cek = mysqli_fetch_assoc($data);

if (!$cek) {
    header("location: buku.php?pesan=gagali");
    exit;
}

// Hapus relasi dari tabel terkait
mysqli_query($koneksi, "DELETE FROM kategoribuku_relasi WHERE BukuID = '$id'");

// Hapus file cover jika ada
$cover = $cek['imagecover'];
if (!empty($cover)) {
    $filePath = "../storage/upload/" . $cover;
    if (file_exists($filePath)) {
        unlink($filePath);
    }
}

// Hapus buku
$query = "DELETE FROM buku WHERE BukuID = '$id'";
if (mysqli_query($koneksi, $query)) {
    header("location: buku.php?pesan=berhasil");
} else {
    header("location: buku.php?pesan=gagalo");
}
?>
