<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}

require '../koneksi.php';

// if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['nama_kategori'])) {
//     $nama = mysqli_real_escape_string($koneksi, $_POST['nama_kategori']);
//     mysqli_query($koneksi, "INSERT INTO kategoribuku (Namakategori) VALUES ('$nama')")
//         or die('Gagal menyimpan: '.mysqli_error($koneksi));
//     header('Location: kategori.php');
//     exit;
// }

require '../layout/sidebar-navbar-footbar.php';
?>
<style>
@media (min-width: 992px) { body { margin-left: 240px; } }
</style>

<div class="mx-5 mt-4">
  <h2 class="mb-3 fw-bold">Kategori Buku</h2>
  <div class="card shadow-sm">
    <div class="card-body">
      <form method="post" action="crud-add-kategori.php" class="p-4">
        <div class="mb-3">
          <label for="nama_kategori" class="form-label">Nama Kategori</label>
          <input type="text" class="form-control bg-light" id="nama_kategori" name="nama_kategori" placeholder="Masukkan nama kategori..." required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <button type="reset" class="btn btn-light">Reset</button>
        <a href="kategori.php" class="btn btn-danger">Kembali</a>
      </form>
    </div>
  </div>
</div>

</body>
</html>
