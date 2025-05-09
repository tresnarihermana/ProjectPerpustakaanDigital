<?php
include '../koneksi.php';

$user = $_POST['user'];
$buku = $_POST['buku'];
$ulasan = $_POST['ulasan'];
$rating = $_POST['rating'];
// Validasi: Cek apakah user sudah pernah mengulas buku tersebut
$cek = mysqli_query($koneksi, "
    SELECT *
    FROM ulasanbuku ub 
    JOIN user u ON ub.UserID = u.UserID 
    JOIN buku b ON ub.BukuID = b.BukuID 
    WHERE ub.Username = '$user' AND ub.judul = '$buku'
");

if (mysqli_num_rows($cek) > 0) {
    // Jika sudah pernah ulas, kembali dengan pesan
    header("location: ulasan.php?pesan=duplikat");
    exit;
} else {
    // Insert data ulasan
    $query = mysqli_query($koneksi, "
        INSERT INTO ulasanbuku VALUES ('','',''
    ");

    if ($query) {
        header("location: ulasan.php?pesan=berhasil");
    } else {
        header("location: ulasan.php?pesan=gagal");
    }
}
?>
