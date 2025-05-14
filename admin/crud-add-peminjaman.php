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

// // Validasi data (opsional, tapi disarankan)
// if (empty($user) || empty($buku) || empty($tgl_pinjam) || empty($tgl_kembali) || empty($status)) {
//     die("Semua data harus diisi!");
// }

// Masukkan ke database
$query = "INSERT INTO peminjaman (UserID, BukuID, TanggalPeminjaman, TanggalPengembalian, StatusPeminjaman) 
          VALUES ('$user', '$buku', '$tgl_pinjam', '$tgl_kembali', '$status')";
mysqli_query($koneksi, $query) or die("Gagal tambah data: " . mysqli_error($koneksi));

header('Location: peminjaman.php');
exit;
?>
