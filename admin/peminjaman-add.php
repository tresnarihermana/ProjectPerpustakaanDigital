<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['role'] == 'user') {
    header('Location: ../login.php');
    exit;
}

require '../koneksi.php';
require '../layout/sidebar-navbar-footbar.php';
?>

<style>
@media (min-width: 992px) { body { margin-left: 240px; } }
</style>

<div class="mx-5 mt-4">
  <h2 class="mb-3 fw-bold">Laporan Peminjaman Buku</h2>
  <div class="card shadow-sm">
    <div class="card-body">
      <form method="post" action="crud-add-peminjaman.php" class="p-4">
        <div class="mb-3 row">
          <label for="user" class="col-sm-2 col-form-label">User</label>
          <div class="col-sm-10">
            <select class="form-select bg-light" id="user" name="id_user" required>
              <option value="">-- Pilih User --</option>
              <?php
              $user = mysqli_query($koneksi, "SELECT * FROM user");
              while ($row = mysqli_fetch_assoc($user)) {
                  echo "<option value='{$row['id_user']}'>{$row['nama']}</option>";
              }
              ?>
            </select>
          </div>
        </div>

        <div class="mb-3 row">
          <label for="buku" class="col-sm-2 col-form-label">Buku</label>
          <div class="col-sm-10">
            <select class="form-select bg-light" id="buku" name="id_buku" required>
              <option value="">-- Pilih Buku --</option>
              <?php
              $buku = mysqli_query($koneksi, "SELECT * FROM buku");
              while ($row = mysqli_fetch_assoc($buku)) {
                  echo "<option value='{$row['id_buku']}'>{$row['Judul']}</option>";
              }
              ?>
            </select>
          </div>
        </div>

        <div class="mb-3 row">
          <label for="tgl_pinjam" class="col-sm-2 col-form-label">Tanggal Peminjaman</label>
          <div class="col-sm-10">
            <input type="date" class="form-control bg-light" id="tgl_pinjam" name="tgl_pinjam" required>
          </div>
        </div>

        <div class="mb-3 row">
          <label for="tgl_kembali" class="col-sm-2 col-form-label">Tanggal Pengembalian</label>
          <div class="col-sm-10">
            <input type="date" class="form-control bg-light" id="tgl_kembali" name="tgl_kembali" required>
          </div>
        </div>

        <div class="mb-3 row">
          <label for="status" class="col-sm-2 col-form-label">Status</label>
          <div class="col-sm-10">
            <select class="form-select bg-light" id="status" name="status" required>
              <option value="Dipinjam">Dipinjam</option>
              <option value="Dikembalikan">Dikembalikan</option>
            </select>
          </div>
        </div>

        <div class="text-end">
          <button type="submit" class="btn btn-primary">Simpan</button>
          <button type="reset" class="btn btn-secondary">Reset</button>
          <a href="peminjaman.php" class="btn btn-danger">Kembali</a>
        </div>
      </form>
    </div>
  </div>
</div>

</body>
</html>
