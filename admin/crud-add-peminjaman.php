<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}

require '../koneksi.php';

// Ambil data dari form
$user = $_POST['user'];
$buku = $_POST['buku'];
$tgl_pinjam = $_POST['tgl_pinjam'];
$tgl_kembali = $_POST['tgl_kembali'];
$status = $_POST['status'];
$cek_duplikat = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE UserID = '$user' AND BukuID = '$buku' AND StatusPeminjaman = 'dipinjam'");
if (mysqli_num_rows($cek_duplikat) > 0) {
    // Jika data sudah ada, redirect dengan pesan gagal
    header('Location: peminjaman.php?pesan=duplikat');
    exit;
}
$cek_batas = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM peminjaman WHERE UserID = '$user' AND StatusPeminjaman = 'dipinjam'");
$data_batas = mysqli_fetch_assoc($cek_batas);
if ($data_batas['total'] >= 3) {
    // Jika sudah meminjam 3 buku, redirect dengan pesan max pinjam,
    header('Location: peminjaman.php?pesan=maxpinjam');
    exit;
}
$query = "INSERT INTO peminjaman (UserID, BukuID, TanggalPeminjaman, TanggalPengembalian, StatusPeminjaman) 
          VALUES ('$user', '$buku', '$tgl_pinjam', '$tgl_kembali', '$status')";
// mysqli_query($koneksi, $query) or die("Gagal tambah data: " . mysqli_error($koneksi));
if (!mysqli_query($koneksi, $query)) {
    header('Location: peminjaman.php?pesan=gagal');
} else {
    header('Location: peminjaman.php?pesan=berhasil');
}

exit;
?>
