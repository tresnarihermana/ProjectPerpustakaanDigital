<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}

require '../koneksi.php';

// Proses hapus peminjaman jika diminta
// if (isset($_GET['hapus'])) {
//     $id = (int) $_GET['hapus'];
//     mysqli_query($koneksi, "DELETE FROM peminjaman WHERE PeminjamanID = $id") or die("Gagal hapus: " . mysqli_error($koneksi));
//     header('Location: peminjaman.php');
//     exit;
// }

// Ambil data peminjaman buku
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
") or die("Query gagal: " . mysqli_error($koneksi));
$data = mysqli_fetch_assoc($query);
// Layout
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
        <div class="mb-3 row">
          <label for="UserID" class="col-sm-3 col-form-label">User</label>
          <div class="col-sm-9">
           <select name="user" id="user" class="form-control bg-light" required>
              <option value="" disabled selected>-- Pilih User --</option>
              <?php
              $user = mysqli_query($koneksi, "SELECT * FROM user WHERE role = 'user'");
              while ($data = mysqli_fetch_array($user)) {
                  echo "<option value='$data[UserID]'>$data[UserID]. $data[Username]</option>";
              }
              ?>
            </select>
          </div>
        </div>

        <div class="mb-3 row">
          <label for="BukuID" class="col-sm-3 col-form-label">Buku</label>
          <div class="col-sm-9">
            <select name="buku" id="buku" class="form-control bg-light" required>
              <option value="" disabled selected>-- Pilih Buku --</option>
              <?php
              $buku = mysqli_query($koneksi, "SELECT * FROM buku");
              while ($data = mysqli_fetch_array($buku)) {
                  echo "<option value='$data[BukuID]'>$data[BukuID]. $data[Judul]</option>";
              }
              ?>
            </select>
          </div>
        </div>

        <div class="mb-3 row">
          <label for="TanggalPeminjaman" class="col-sm-3 col-form-label">Tanggal Peminjaman</label>
          <div class="col-sm-9">
            <input type="date" class="form-control bg-light" id="TanggalPeminjaman" name="TanggalPeminjaman" 
              value="<?php echo htmlspecialchars($data['TanggalPeminjaman']); ?>" required>
          </div>
        </div>

        <div class="mb-3 row">
          <label for="TanggalPengembalian" class="col-sm-3 col-form-label">Tanggal Pengembalian</label>
          <div class="col-sm-9">
            <input type="date" class="form-control bg-light" id="TanggalPengembalian" name="TanggalPengembalian" 
              value="<?php echo htmlspecialchars($data['TanggalPengembalian']); ?>" required>
          </div>
        </div>

        <div class="mb-3 row">
          <label for="StatusPeminjaman" class="col-sm-3 col-form-label">Status Pengembalian</label>
          <div class="col-sm-9">
            <select class="form-control bg-light" id="StatusPeminjaman" name="StatusPeminjaman" required>
              <option value="dipinjam" <?php if ($data['StatusPeminjaman'] == 'dipinjam') echo 'selected'; ?>>Dipinjam</option>
              <option value="dikembalikan" <?php if ($data['StatusPeminjaman'] == 'dikembalikan') echo 'selected'; ?>>Dikembalikan</option>
            </select>
          </div>
        </div>
            <label for="hiddenTextInput" class="form-label"></label>
            <input type="hidden" class="form-control" id="hiddenTextInput" aria-describedby="nameHelp" required value="<?php echo htmlspecialchars($_GET['id']); ?>" name="PeminjamanID">
            <div id="nameHelp" class="form-text"></div>
        <div class="text-end">
          <button type="submit" class="btn btn-primary">Simpan</button>
          <button type="reset" class="btn btn-secondary">Reset</button>
          <a href="peminjaman.php" class="btn btn-danger">Kembali</a>
        </div>
      </form>
    </div>
  </div>
</div>
