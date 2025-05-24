<?php
session_start();
require '../koneksi.php';

$user_id = $_SESSION['UserID'];
$buku = mysqli_real_escape_string($koneksi, $_POST['buku_id']);
$tgl_pinjam = $_POST['tanggal_pinjam'];
$tgl_kembali = $_POST['tanggal_kembali'];
$status = "Dipinjam";

// cek stok buku
$cek_stok = mysqli_query($koneksi, "SELECT Stok FROM buku WHERE BukuID = '$buku'");
$data_stok = mysqli_fetch_assoc($cek_stok);
if ($data_stok['Stok'] <= 0) {
    header('Location: ../daftar-peminjaman.php?pesan=stokhabis');
    exit;
}


// Cek apakah user sudah meminjam buku ini dan belum dikembalikan
$cek_duplikat = mysqli_query($koneksi, "SELECT * FROM peminjaman 
    WHERE BukuID = '$buku' AND UserID = '$user_id' AND StatusPeminjaman = '$status'");
if (mysqli_num_rows($cek_duplikat) > 0) {
    header('Location: ../daftar-peminjaman.php?pesan=sudahdipinjam');
    exit;
}

// Cek jumlah buku yang sedang dipinjam oleh user
$cek_jumlah = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM peminjaman 
    WHERE UserID = '$user_id' AND StatusPeminjaman = '$status'");
$data = mysqli_fetch_assoc($cek_jumlah);

if ($data['total'] >= 3) {
    header('Location: ../daftar-peminjaman.php?pesan=maxpinjam');
    exit;
}

// Validasi selisih hari maksimal 7 hari
$start_date = new DateTime($tgl_pinjam);
$end_date = new DateTime($tgl_kembali);
$selisih_hari = $start_date->diff($end_date)->days;

if ($selisih_hari > 7) {
    header('Location: ../daftar-peminjaman.php?pesan=harimaksimal');
    exit;
}

// Jika lolos semua validasi, lakukan peminjaman
$query = "INSERT INTO peminjaman (UserID, BukuID, TanggalPeminjaman, TanggalPengembalian, StatusPeminjaman) 
          VALUES ('$user_id', '$buku', '$tgl_pinjam', '$tgl_kembali', '$status')";
$stok = mysqli_query($koneksi, "UPDATE buku SET Stok = Stok - 1 WHERE BukuID = '$buku'");
if (mysqli_query($koneksi, $query) && $stok) {
    header('Location: ../daftar-peminjaman.php?pesan=berhasil');
} else {
    header('Location: ../daftar-peminjaman.php?pesan=gagal');
}
?>
