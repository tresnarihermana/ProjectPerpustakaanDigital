<?php
include '../koneksi.php';

$user = $_POST['user'];
$buku = $_POST['buku'];
$ulasan = $_POST['ulasan'];
$rating = $_POST['rating'];

// Cek apakah user sudah pernah mengulas buku ini
$cek = mysqli_query($koneksi, "SELECT * FROM ulasan WHERE id_user = '$user' AND id_buku = '$buku'");

if (mysqli_num_rows($cek) > 0) {
    header("location: ulasan.php?pesan=duplikat");
    exit;
} else {
    $query = mysqli_query($koneksi, 
        "INSERT INTO ulasan (id_user, id_buku, isi_ulasan, rating) 
        VALUES ('$user', '$buku', '$ulasan', '$rating')"
    );

    if ($query) {
        header("location: ulasan.php?pesan=berhasil");
    } else {
        header("location: ulasan.php?pesan=gagal");
    }
}
?>
