<?php
include '../koneksi.php';

$peminjamanID = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE peminjamanID = '$peminjamanID'");
$cek = mysqli_fetch_assoc($data);

if (mysqli_num_rows($data) == 0) {
    header("location: peminjaman.php?pesan=gagal");
} else {
    $query = "DELETE FROM peminjaman WHERE peminjamanID = '$peminjamanID'";
    if (mysqli_query($koneksi, $query) && $peminjamanID > 0) {
        header("location: peminjaman.php?pesan=berhasil");
    } else {
        header("location: peminjaman.php?pesan=gagal");
    }
}

?>