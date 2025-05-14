<?php
include '../koneksi.php';

$peminjamanID = $_POST['PeminjamanID'];
$UserID = $_POST['user'];
$BukuID = $_POST['buku'];
$TanggalPeminjaman = $_POST['TanggalPeminjaman'];
$TanggalPengembalian = $_POST['TanggalPengembalian'];
$StatusPeminjaman = $_POST['StatusPeminjaman'];
// var_dump($peminjamanID, $UserID, $BukuID, $TanggalPeminjaman, $TanggalPengembalian, $StatusPeminjaman);
$query = "UPDATE peminjaman SET 
            UserID = '$UserID',
            BukuID = '$BukuID',
            TanggalPeminjaman = '$TanggalPeminjaman',
            TanggalPengembalian = '$TanggalPengembalian',
            StatusPeminjaman = '$StatusPeminjaman'
          WHERE peminjamanID = '$peminjamanID'";

if (mysqli_query($koneksi, $query)) {
    header("Location: peminjaman.php?pesan=berhasil");
} else {
    header("Location: peminjaman.php?pesan=gagal");
}
?>
