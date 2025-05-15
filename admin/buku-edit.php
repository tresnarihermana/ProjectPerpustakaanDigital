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
$query = mysqli_query($koneksi, "SELECT * FROM buku WHERE BukuID = '$id'");
$data = mysqli_fetch_assoc($query);

?>

<style>
@media (min-width: 992px) { body { margin-left: 240px; } }
</style>

<div class="mx-5 mt-4">
  <h2 class="mb-3 fw-bold">Buku</h2>
  <div class="card shadow-sm">
    <div class="card-body">
      <form method="post" action="crud-edit-buku.php" class="p-4" enctype="multipart/form-data">
          <div class="mb-3 row">
            <label for="BukuID" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10">
              <input type="hidden" class="form-control bg-light" id="BukuID" name="BukuID" value="<?php echo htmlspecialchars($data['BukuID']); ?>" required>
            </div>
          </div>
          
        <div class="mb-3 row">
          <label for="Judul" class="col-sm-2 col-form-label">Judul</label>
          <div class="col-sm-10">
            <input type="text" class="form-control bg-light" id="Judul" name="Judul" value="<?php echo htmlspecialchars($data['Judul']); ?>" required>
          </div>
        </div>
        <div class="mb-3 row">
          <label for="Deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
          <div class="col-sm-10">
            <input type="text" class="form-control bg-light" id="Deskripsi" name="Deskripsi" value="<?php echo htmlspecialchars($data['Deskripsi']); ?>" required>
          </div>
        </div>

        <div class="mb-3 row">
          <label for="Penulis" class="col-sm-2 col-form-label">Penulis</label>
          <div class="col-sm-10">
            <input type="text" class="form-control bg-light" id="Penulis" name="Penulis" value="<?php echo htmlspecialchars($data['Penulis']); ?>" required>
          </div>
        </div>

        <div class="mb-3 row">
          <label for="Penerbit" class="col-sm-2 col-form-label">Penerbit</label>
          <div class="col-sm-10">
            <input type="text" class="form-control bg-light" id="penerbit" name="penerbit" value="<?php echo htmlspecialchars($data['penerbit']); ?>" required>
          </div>
        </div>

        <div class="mb-3 row">
          <label for="TahunTerbit" class="col-sm-2 col-form-label">Tahun Terbit</label>
          <div class="col-sm-10">
            <input type="text" class="form-control bg-light" id="TahunTerbit" name="TahunTerbit" value="<?php echo htmlspecialchars($data['TahunTerbit']); ?>" required>
          </div>
        </div>
<div class="mb-3 row">
  <label for="image" class="col-sm-2 col-form-label">Upload Gambar Cover Baru</label>
  <div class="col-sm-10">
    <input 
      type="file" 
      name="image" 
      id="image" 
      class="form-control" 
      accept="image/*"
      aria-describedby="imageHelp"
    >
    <div id="imageHelp" class="form-text">Kosongkan jika tidak ingin mengganti gambar cover.</div>
  </div>
</div>

<div class="mb-3 row">
  <label class="col-sm-2 col-form-label">Gambar Cover Saat Ini</label>
  <div class="col-sm-10">
    <?php if (!empty($data['imagecover'])): ?>
      <img 
        src="../storage/upload/<?php echo htmlspecialchars($data['imagecover']); ?>" 
        alt="Cover Buku" 
        class="img-thumbnail" 
        style="max-height: 200px;"
      >
    <?php else: ?>
      <p><em>Tidak ada gambar cover</em></p>
    <?php endif; ?>
  </div>
</div>

        <div class="text-end">
          <button type="submit" class="btn btn-primary">Simpan</button>
          <button type="reset" class="btn btn-secondary">Reset</button>
          <a href="buku.php" class="btn btn-danger">Kembali</a>
        </div>
      </form>
    </div>
  </div>
</div>

</body>
</html>
