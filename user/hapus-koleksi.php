<?php
include '../koneksi.php';

$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM koleksipribadi WHERE koleksiID = '$id'");
$cek = mysqli_fetch_assoc($data);

if (mysqli_num_rows($data) == 0) {
    header("location: ../koleksi-pribadi.php?pesan=gagal");
} else {
    $query = "DELETE FROM koleksipribadi WHERE koleksiID = '$id'";
    if (mysqli_query($koneksi, $query)){
        header("location: ../koleksi-pribadi.php?pesan=berhasil");
    } else {
        header("location: ../koleksi-pribadi.php?pesan=gagal");
    }
}

?>