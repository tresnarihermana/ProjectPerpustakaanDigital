<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}

require '../koneksi.php';


// Ambil data kategori
$result = mysqli_query(
    $koneksi,
    "SELECT KategoriID, Namakategori FROM kategoribuku"
) or die("Query gagal: " . mysqli_error($koneksi));

// Include layout (sidebar + navbar)
include '../layout/sidebar-navbar-footbar.php';
include '../layout/alert.php';
?>
<style>
  @media (min-width: 992px) {
    body { margin-left: 240px; }
  }
</style>

<div class="mx-5 mt-4">
  <!-- Judul -->
  <h1 class="mb-3">Kategori Buku</h1>
  <!-- Tombol di bawah judul -->
  <a href="kategori-add.php" class="btn btn-primary mb-4">+ Tambah Data</a>

  <!-- Tabel dalam card -->
  <div class="card shadow-sm mb-4">
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-bordered mb-0">
          <thead>
            <tr>
              <th style="width:5%">No</th>
              <th>Nama Kategori</th>
              <th style="width:20%">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php if (mysqli_num_rows($result) === 0): ?>
              <tr>
                <td colspan="3" class="text-center">Belum ada kategori.</td>
              </tr>
            <?php else: 
              $no = 1;
              while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= htmlspecialchars($row['Namakategori']) ?></td>
                  <td>
                    <a href="kategori-edit.php?id=<?= $row['KategoriID'] ?>"
                       class="btn btn-info btn-sm me-1">Ubah</a>
                    <a href="crud-delete-kategori.php?id=<?= $row['KategoriID'] ?>"
                       onclick="return confirm('Yakin ingin menghapus?')"
                       class="btn btn-danger btn-sm">Hapus</a>
                  </td>
                </tr>
            <?php endwhile; endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

</body>
</html>
