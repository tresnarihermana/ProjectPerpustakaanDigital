<?php
session_start();
require '../koneksi.php';
require '../layout/sidebar-navbar-footbar.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul_buku = $_POST['judul_buku'];
    $tanggal_pinjam = $_POST['tanggal_pinjam'];
    $tanggal_kembali = $_POST['tanggal_kembali'];

    $query = "INSERT INTO peminjaman (judul_buku, tanggal_pinjam, tanggal_kembali) 
              VALUES ('$judul_buku', '$tanggal_pinjam', '$tanggal_kembali')";
    mysqli_query($conn, $query);

    header("Location: peminjaman.php");
    exit;
}
?>

<div class="mx-5 mt-4">
  <h2 class="mb-3 fw-bold">Tambah Peminjaman</h2>
  <div class="card shadow-sm p-4">
    <form method="post">
      <div class="mb-3">
        <label class="form-label">Judul Buku</label>
        <input type="text" name="judul_buku" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Tanggal Peminjaman</label>
        <input type="date" name="tanggal_pinjam" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Tanggal Pengembalian</label>
        <input type="date" name="tanggal_kembali" class="form-control" required>
      </div>
      <button class="btn btn-primary" type="submit">Simpan</button>
      <a href="peminjaman.php" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
</div>
