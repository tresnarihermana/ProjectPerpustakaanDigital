<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['role'] === 'user') {
    header('Location: ../login.php');
    exit;
}

require '../koneksi.php';

// Ambil data kategori dari database
$query_kategori = "SELECT KategoriID, Namakategori FROM Kategoribuku";
$result_kategori = mysqli_query($koneksi, $query_kategori);

// Ambil data buku dari database
$query_buku = "SELECT BukuID, Judul FROM buku";
$result_buku = mysqli_query($koneksi, $query_buku);

require '../layout/sidebar-navbar-footbar.php';
?>

<style>
@media (min-width: 992px) { body { margin-left: 240px; } }
</style>

<div class="mx-5 mt-4">
  <h2 class="mb-3 fw-bold">Kategori Buku</h2>
  <div class="card shadow-sm">
    <div class="card-body">
      <form method="post" action="crud-add-koleksi-kategori.php" class="p-4" enctype="multipart/form-data">
        
        <!-- Dropdown untuk memilih kategori -->
        <div class="mb-3">
          <label for="kategori" class="form-label">Pilih Kategori</label>
          <select class="form-control bg-light" id="kategori" name="kategori" required>
            <option value="" disabled selected>Pilih Kategori Buku</option>
            <?php while ($row_kategori = mysqli_fetch_assoc($result_kategori)): ?>
              <option value="<?= $row_kategori['KategoriID'] ?>"><?= htmlspecialchars($row_kategori['Namakategori']) ?></option>
            <?php endwhile; ?>
          </select>
        </div>

        <!-- Dropdown untuk memilih judul buku -->
        <div class="mb-3">
          <label for="buku" class="form-label">Pilih Judul Buku</label>
          <select class="form-control bg-light" id="buku" name="buku" required>
            <option value="" disabled selected>Pilih Judul Buku</option>
            <?php while ($row_buku = mysqli_fetch_assoc($result_buku)): ?>
              <option value="<?= $row_buku['BukuID'] ?>"><?= htmlspecialchars($row_buku['Judul']) ?></option>
            <?php endwhile; ?>
          </select>
        </div>

        <!-- Tombol submit dan reset -->
        <button type="submit" class="btn btn-success">Simpan</button>
        <button type="reset" class="btn btn-light">Reset</button>
        <a href="kategori.php" class="btn btn-danger">Kembali</a>

      </form>
    </div>
  </div>
</div>

</body>
</html>
