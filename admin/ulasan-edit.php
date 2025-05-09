<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['role'] == 'user') {
    header('Location: ../login.php');
    exit;
}

require '../koneksi.php';
require '../layout/sidebar-navbar-footbar.php';

// Ambil PenggunaID dari URL
if (isset($_GET['id'])) {
    $id = $_GET['id']; // Mengambil ID Pengguna dari parameter URL
} else {
    echo "Pengguna ID tidak ditemukan!";
    exit;
}

// Ambil data Pengguna berdasarkan PenggunaID
$query = "
    SELECT ub.UlasanID, u.namalengkap AS UserNama, b.Judul AS BukuJudul, ub.Ulasan, ub.Rating 
    FROM ulasanbuku ub 
    JOIN user u ON ub.UserID = u.UserID 
    JOIN buku b ON ub.BukuID = b.BukuID
";
$data = mysqli_fetch_assoc($query);
?>

<style>
@media (min-width: 992px) { body { margin-left: 240px; } }
</style>

<div class="mx-5 mt-4">
  <h2 class="mb-3 fw-bold">Ulasan Buku</h2>
  <div class="card shadow-sm">
    <div class="card-body">
      <form method="post" action="crud-add-ulasan.php" class="p-4">

        <div class="mb-3 row">
          <label for="user" class="col-sm-2 col-form-label">Nama User</label>
          <div class="col-sm-10">
            <select name="user" id="user" class="form-control bg-light" required>
              <option value="" disabled selected>-- Pilih User --</option>
              <?php
              $user = mysqli_query($koneksi, "SELECT * FROM user WHERE role = 'user'");
              while ($data = mysqli_fetch_array($user)) {
                  echo "<option value='$data[UserID]'>$data[Username]</option>";
              }
              ?>
            </select>
          </div>
        </div>

        <div class="mb-3 row">
          <label for="buku" class="col-sm-2 col-form-label">Judul Buku</label>
          <div class="col-sm-10">
            <select name="buku" id="buku" class="form-control bg-light" required>
              <option value="" disabled selected>-- Pilih Buku --</option>
              <?php
              $buku = mysqli_query($koneksi, "SELECT * FROM buku");
              while ($data = mysqli_fetch_array($buku)) {
                  echo "<option value='$data[BukuID]'>$data[Judul]</option>";
              }
              ?>
            </select>
          </div>
        </div>

        <div class="mb-3 row">
          <label for="ulasan" class="col-sm-2 col-form-label">Ulasan</label>
          <div class="col-sm-10">
            <textarea class="form-control bg-light" name="ulasan" id="ulasan" rows="4" required></textarea>
          </div>
        </div>

        <div class="mb-3 row">
          <label for="rating" class="col-sm-2 col-form-label">Rating</label>
          <div class="col-sm-10">
            <select name="rating" id="rating" class="form-control bg-light" required>
              <option value="" disabled selected>-- Pilih Rating --</option>
              <option value="1">1 - Sangat Buruk</option>
              <option value="2">2 - Buruk</option>
              <option value="3">3 - Cukup</option>
              <option value="4">4 - Baik</option>
              <option value="5">5 - Sangat Baik</option>
            </select>
          </div>
        </div>

        <div class="text-end">
          <button type="submit" class="btn btn-primary">Simpan</button>
          <button type="reset" class="btn btn-secondary">Reset</button>
          <a href="ulasan.php" class="btn btn-danger">Kembali</a>
        </div>
      </form>
    </div>
  </div>
</div>

</body>
</html>
