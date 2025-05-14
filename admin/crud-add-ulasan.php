<?php
include '../koneksi.php';

$user = $_POST['user'];
$buku = $_POST['buku'];
$ulasan = $_POST['ulasan'];
$rating = $_POST['rating'];

// Cek apakah user sudah mengulas buku ini
$cek = mysqli_query($koneksi, "
    SELECT * FROM ulasanbuku 
    WHERE UserID = '$user' AND BukuID = '$buku'
");

if (mysqli_num_rows($cek) > 0) {
    // Sudah pernah mengulas
    header("location: ulasan.php?pesan=duplikat");
    exit;
} else {
    // Tambah ulasan baru
    $query = mysqli_query($koneksi, "
        INSERT INTO ulasanbuku (UserID, BukuID, Ulasan, Rating) 
        VALUES ('$user', '$buku', '$ulasan', '$rating')
    ");

    if ($query) {
        header("location: ulasan.php?pesan=berhasil");
    } else {
        header("location: ulasan.php?pesan=gagal");
    }
}
?>
