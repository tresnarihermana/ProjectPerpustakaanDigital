<?php
include '../koneksi.php';
$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM user WHERE UserID = '$id'");
$cek = mysqli_fetch_assoc($data);

if (mysqli_num_rows($data) == 0) {
    header("location: pengguna.php?pesan=gagal");
} else {
    $query = "DELETE FROM user WHERE UserID = '$id'";
    if (mysqli_query($koneksi, $query) && $id > 0) {
        header("location: pengguna.php?pesan=berhasil");
    } else {
        header("location: pengguna.php?pesan=gagal");
    }
}

?>