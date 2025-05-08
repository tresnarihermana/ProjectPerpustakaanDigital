<?php
include '../koneksi.php';

$bukuid = $_POST['BukuID'];
$judul = $_POST['Judul'];
$deskripsi = $_POST['Deskripsi'];
$penulis = $_POST['Penulis'];
$penerbit = $_POST['Penerbit'];
$tahun = $_POST['TahunTerbit'];

// Cek apakah buku dengan judul yang sama sudah ada
$cek = mysqli_query($koneksi, "SELECT * FROM buku WHERE Judul = '$judul'");

if (mysqli_num_rows($cek) > 0) {
    header("location: buku.php?pesan=duplikat");
    exit;
} else {
    // Sesuaikan dengan jumlah dan urutan kolom di tabel buku
    $query = mysqli_query($koneksi, 
        "INSERT INTO buku (BukuID, Judul, Deskripsi, Penulis, Penerbit, TahunTerbit) 
        VALUES ('$bukuid', '$judul', '$deskripsi', '$penulis', '$penerbit', '$tahun')"
    );

    if ($query) {
        header("location: buku.php?pesan=berhasil");
    } else {
        header("location: buku.php?pesan=gagal");
    }
}
?>
