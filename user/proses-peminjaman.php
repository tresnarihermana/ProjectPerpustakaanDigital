<?php
session_start();

require '../koneksi.php';

// Ambil UserID dari session (bukan dari form)
$user_id = $_SESSION['UserID'];

// Ambil data dari form
$buku = mysqli_real_escape_string($koneksi, $_POST['buku_id']);
$tgl_pinjam = $_POST['tanggal_pinjam'];
$tgl_kembali = $_POST['tanggal_kembali'];
$status = "Dipinjam";

$cek = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE BukuID = '$buku' && UserID = '$user_id' && StatusPeminjaman = '$status'");
if(mysqli_num_rows($cek) > 0){
    header('Location: ../daftar-peminjaman.php?pesan=duplikat');
} else{
$query = "INSERT INTO peminjaman (UserID, BukuID, TanggalPeminjaman, TanggalPengembalian, StatusPeminjaman) 
          VALUES ('$user_id', '$buku', '$tgl_pinjam', '$tgl_kembali', '$status')";

if (mysqli_query($koneksi, $query)) {
    header('Location: ../daftar-peminjaman.php?pesan=berhasil');
    exit;
} else {
    header('Location: ../daftar-peminjaman.php?pesan=gagal');
}
}

?>
