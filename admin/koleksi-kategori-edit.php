<?php
require 'config/session.php';

require '../koneksi.php';

// Ambil KategoriID dari URL
if (isset($_GET['id'])) {
    $kategoriID = $_GET['id'];
} else {
    echo "ID Kategori tidak ditemukan!";
    exit;
}

// Ambil data kategori dari database
$query_kategori = "SELECT KategoriID, Namakategori FROM Kategoribuku";
$result_kategori = mysqli_query($koneksi, $query_kategori);

// Ambil data buku dari database
$query_buku = "SELECT BukuID, Judul FROM buku";
$result_buku = mysqli_query($koneksi, $query_buku);

// Ambil buku yang sudah terkait dengan kategori ini
$qRelasi = mysqli_query($koneksi, "SELECT BukuID FROM kategoribuku_relasi WHERE KategoriID = '$kategoriID'");
$bukuTerpilih = [];
while ($row = mysqli_fetch_assoc($qRelasi)) {
    $bukuTerpilih[] = $row['BukuID'];
}

include '../layout/sidebar-navbar-footbar.php';
include '../layout/alert.php';
?>

<style>
@media (min-width: 992px) { body { margin-left: 240px; } }
</style>

<div class="mx-5 mt-4">
  <h2 class="mb-3 fw-bold">Edit Kategori Buku</h2>
  <div class="card shadow-sm">
    <div class="card-body">
      <form method="post" action="crud-edit-koleksi-kategori.php" class="p-4">

<div class="mb-3 row">
          <label for="namakategori" class="col-sm-2 col-form-label">Nama Kategori</label>
          <div class="col-sm-10">
<select name="kategori" id="kategori" class="form-control bg-light" required>
  <option value="">-- Pilih kategori --</option>
  <?php
  $data = mysqli_query($koneksi, "SELECT * FROM kategoribuku");
  while ($k = mysqli_fetch_array($data)) {
      $selected = ($k['KategoriID'] == $kategoriID) ? 'selected' : '';
      echo "<option value='$k[KategoriID]' $selected>$k[Namakategori]</option>";
  }
  ?>
</select>
          </div>
            </div>

        <div class="mb-3 row">
          <label class="col-sm-2 col-form-label">Pilih Buku</label>
          <div class="col-sm-10">
            <div class="row">
              <?php while ($b = mysqli_fetch_assoc($result_buku)): ?>
                <div class="col-md-6">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="buku[]" value="<?= $b['BukuID'] ?>" id="buku<?= $b['BukuID'] ?>" <?= in_array($b['BukuID'], $bukuTerpilih) ? 'checked' : '' ?>>
                    <label class="form-check-label" for="buku<?= $b['BukuID'] ?>">
                      <?= htmlspecialchars($b['Judul']) ?>
                    </label>
                  </div>
                </div>
              <?php endwhile; ?>
            </div>
          </div>
        </div>

        <input type="hidden" name="KategoriID" value="<?= htmlspecialchars($kategoriID) ?>">

        <div class="text-end">
          <button type="submit" class="btn btn-primary">Simpan</button>
          <button type="reset" class="btn btn-secondary">Reset</button>
          <a href="kategori-buku.php" class="btn btn-danger">Kembali</a>
        </div>

      </form>
    </div>
  </div>
</div>

</body>
</html>
