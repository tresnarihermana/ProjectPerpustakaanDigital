<?php
require 'config/session.php';
require '../koneksi.php';

// Ambil data peminjaman berdasarkan ID
if (!isset($_GET['id'])) {
    header("Location: peminjaman.php");
    exit;
}

$id = $_GET['id'];
$query = mysqli_query($koneksi, "
    SELECT 
        peminjaman.PeminjamanID AS PinjamID,
        user.UserID AS UserID,
        buku.BukuID AS BukuID,
        peminjaman.TanggalPeminjaman,
        peminjaman.TanggalPengembalian,
        peminjaman.StatusPeminjaman
    FROM peminjaman
    JOIN user ON peminjaman.UserID = user.UserID
    JOIN buku ON peminjaman.BukuID = buku.BukuID
    WHERE peminjaman.PeminjamanID = '$id'
") or die("Query gagal: " . mysqli_error($koneksi));

$data = mysqli_fetch_assoc($query);

include '../layout/sidebar-navbar-footbar.php';
include '../layout/alert.php';
?>

<style>
@media (min-width: 992px) {
  body {
    margin-left: 240px;
  }
}
</style>

<div class="mx-5 mt-4">
  <h2 class="mb-3 fw-bold">Laporan Peminjaman Buku</h2>
  <div class="card shadow-sm">
    <div class="card-body">
      <form method="post" action="crud-edit-peminjaman.php" class="p-4">

        <!-- User -->
        <div class="mb-3 row">
          <label for="user" class="col-sm-3 col-form-label">User</label>
          <div class="col-sm-9">
            <select name="user" id="user" class="form-control bg-light" required>
              <option value="" disabled>-- Pilih User --</option>
              <?php
              $userList = mysqli_query($koneksi, "SELECT * FROM user WHERE role = 'user'");
              while ($u = mysqli_fetch_array($userList)) {
                  $selected = ($u['UserID'] == $data['UserID']) ? 'selected' : '';
                  echo "<option value='$u[UserID]' $selected>$u[UserID]. $u[Username]</option>";
              }
              ?>
            </select>
          </div>
        </div>

        <!-- Buku -->
        <div class="mb-3 row">
          <label for="buku" class="col-sm-3 col-form-label">Buku</label>
          <div class="col-sm-9">
            <select name="buku" id="buku" class="form-control bg-light" required>
              <option value="" disabled>-- Pilih Buku --</option>
              <?php
              $bukuList = mysqli_query($koneksi, "SELECT * FROM buku");
              while ($b = mysqli_fetch_array($bukuList)) {
                  $selected = ($b['BukuID'] == $data['BukuID']) ? 'selected' : '';
                  echo "<option value='$b[BukuID]' $selected>$b[BukuID]. $b[Judul]</option>";
              }
              ?>
            </select>
          </div>
        </div>

        <!-- Tanggal Peminjaman -->
        <div class="mb-3 row">
          <label for="TanggalPeminjaman" class="col-sm-3 col-form-label">Tanggal Peminjaman</label>
          <div class="col-sm-9">
            <input type="date" class="form-control bg-light" id="TanggalPeminjaman" name="TanggalPeminjaman"
              value="<?= htmlspecialchars($data['TanggalPeminjaman']); ?>" required>
          </div>
        </div>

        <!-- Tanggal Pengembalian -->
        <div class="mb-3 row">
          <label for="TanggalPengembalian" class="col-sm-3 col-form-label">Tanggal Pengembalian</label>
          <div class="col-sm-9">
            <input type="date" class="form-control bg-light" id="TanggalPengembalian" name="TanggalPengembalian"
              value="<?= htmlspecialchars($data['TanggalPengembalian']); ?>" required>
          </div>
        </div>

        <!-- Status -->
        <div class="mb-3 row">
          <label for="StatusPeminjaman" class="col-sm-3 col-form-label">Status Pengembalian</label>
          <div class="col-sm-9">
            <select class="form-control bg-light" id="StatusPeminjaman" name="StatusPeminjaman" required>
              <option value="" disabled>-- Pilih Status --</option>
              <option value="Dipinjam" <?= $data['StatusPeminjaman'] == 'Dipinjam' ? 'selected' : '' ?>>Dipinjam</option>
              <option value="Dikembalikan" <?= $data['StatusPeminjaman'] == 'Dikembalikan' ? 'selected' : '' ?>>Dikembalikan</option>
            </select>
          </div>
        </div>

        <!-- Hidden Input untuk ID -->
        <input type="hidden" name="PeminjamanID" value="<?= htmlspecialchars($data['PinjamID']); ?>">

        <!-- Tombol -->
        <div class="text-end">
          <button type="submit" class="btn btn-primary">Simpan</button>
          <button type="reset" class="btn btn-secondary">Reset</button>
          <a href="peminjaman.php" class="btn btn-danger">Kembali</a>
          <button type="submit" name="selesaikan" 
          class="btn btn-success ms-2">
          <i class="fa fa-check-circle"></i> Selesaikan Peminjaman
        </a>
        </div>

      </form>
    </div>
  </div>
</div>
