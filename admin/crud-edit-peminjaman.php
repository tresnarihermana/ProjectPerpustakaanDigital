<?php
include '../koneksi.php';

$peminjamanID = $_POST['PeminjamanID'];
$UserID = $_POST['user'];
$BukuID = $_POST['buku'];
$TanggalPeminjaman = $_POST['TanggalPeminjaman'];
$TanggalPengembalian = $_POST['TanggalPengembalian'];
$StatusPeminjaman = $_POST['StatusPeminjaman'];

// Cek apakah tombol "Selesaikan Peminjaman" ditekan
if (isset($_POST['selesaikan'])) {
    $StatusPeminjaman = 'dikembalikan';
    $TanggalPengembalian = date('Y-m-d'); // Tanggal hari ini
}

$query = "UPDATE peminjaman SET 
            UserID = '$UserID',
            BukuID = '$BukuID',
            TanggalPeminjaman = '$TanggalPeminjaman',
            TanggalPengembalian = '$TanggalPengembalian',
            StatusPeminjaman = '$StatusPeminjaman'
          WHERE PeminjamanID = '$peminjamanID'";

if (mysqli_query($koneksi, $query)) {
    header("Location: peminjaman.php?pesan=berhasil");
} else {
    header("Location: peminjaman.php?pesan=gagal");
}
?>
