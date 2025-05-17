<?php
require 'config/session.php';

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
        peminjaman.PeminjamanID,
        user.namalengkap AS Username,
        buku.Judul AS Judul,
        peminjaman.TanggalPeminjaman,
        peminjaman.TanggalPengembalian,
        peminjaman.StatusPeminjaman
    FROM peminjaman
    JOIN user ON peminjaman.UserID = user.UserID
    JOIN buku ON peminjaman.BukuID = buku.BukuID
") or die("Query gagal: " . mysqli_error($koneksi));

// Layout
include '../layout/sidebar-navbar-footbar.php';
include '../layout/alert.php';
?>

<style>
  @media (min-width: 992px) {
    body { margin-left: 240px; }
  }
</style>

<div class="mx-5 mt-4">
  <h1 class="mb-3">Laporan Peminjaman Buku</h1>
  <a href="peminjaman-add.php" class="btn btn-success mb-4">+ Tambah</a>
  <br>

  <div class="card shadow-sm mb-4">
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-bordered mb-0">
          <thead>
            <tr>
              <th>No</th>
              <th>User</th>
              <th>Buku</th>
              <th>Tanggal Peminjaman</th>
              <th>Tanggal Pengembalian</th>
              <th>Status Peminjaman </th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php if (mysqli_num_rows($query) === 0): ?>
              <tr><td colspan="7" class="text-center">Belum ada data peminjaman.</td></tr>
            <?php else:
              $no = 1;
              while ($row = mysqli_fetch_assoc($query)): ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= htmlspecialchars($row['Username']) ?></td>
                  <td><?= htmlspecialchars($row['Judul']) ?></td>
                  <td><?= htmlspecialchars($row['TanggalPeminjaman']) ?></td>
                  <td><?= htmlspecialchars($row['TanggalPengembalian']) ?></td>
                  <td>
                    <span class="badge bg-<?= $row['StatusPeminjaman'] == 'Dikembalikan' ? 'success' : 'warning' ?>">
                      <?= htmlspecialchars($row['StatusPeminjaman']) ?>
                    </span>
                  </td>
                  <td>
                    <a href="peminjaman-edit.php?id=<?= $row['PeminjamanID'] ?>" class="btn btn-info btn-sm me-1">Ubah</a>
                    <a href="crud-delete-peminjaman.php?id=<?= $row['PeminjamanID'] ?>" onclick="return confirm('Yakin ingin menghapus?')" class="btn btn-danger btn-sm me-1">Hapus</a>
                    <a href="cetak.php?id=<?= $row['PeminjamanID'] ?>" class="btn btn-success btn-sm"><i class="fa fa-print"></i> Cetak</a>
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
