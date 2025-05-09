<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}

require '../koneksi.php';

// Proses hapus
if (isset($_GET['hapus'])) {
    $id = (int) $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM buku WHERE BukuID = $id") or die("Gagal hapus: " . mysqli_error($koneksi));
    header('Location: buku.php');
    exit;
}

// Ambil data buku
$result = mysqli_query($koneksi, "SELECT * FROM buku") or die("Query gagal: " . mysqli_error($koneksi));

// Include layout
include '../layout/sidebar-navbar-footbar.php';
include '../layout/alert.php';
?>
<style>
  @media (min-width: 992px) {
    body { margin-left: 240px; }
  }
</style>

<div class="mx-5 mt-4">
  <h1 class="mb-3">Buku</h1>
  <a href="buku-add.php" class="btn btn-success mb-4">+ Tambah Buku</a>

  <div class="card shadow-sm mb-4">
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-bordered mb-0">
          <thead>
            <tr>
              <th style="width:5%">No</th>
              <th>BukuID</th>
              <th>Judul</th>
              <th>Deskripsi</th>
              <th>Penulis</th>
              <th>Penerbit</th>
              <th>Tahun Terbit</th>
              <th style="width:20%">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php if (mysqli_num_rows($result) === 0): ?>
              <tr>
                <td colspan="6" class="text-center">Belum ada data buku.</td>
              </tr>
            <?php else: 
              $no = 1;
              while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= htmlspecialchars($row['BukuID']) ?></td>
                  <td><?= htmlspecialchars($row['Judul']) ?></td>
                  <td><?= htmlspecialchars($row['Deskripsi']) ?></td>
                  <td><?= htmlspecialchars($row['Penulis']) ?></td>
                  <td><?= htmlspecialchars($row['penerbit']) ?></td>
                  <td><?= htmlspecialchars($row['TahunTerbit']) ?></td>
                  <td>
                    <a href="buku-edit.php?id=<?= $row['BukuID'] ?>" class="btn btn-info btn-sm me-1">Ubah</a>
                    <a href="crud-delete-buku.php?id=<?= $row['BukuID'] ?>" onclick="return confirm('Yakin ingin menghapus?')" class="btn btn-danger btn-sm">Hapus</a>
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
