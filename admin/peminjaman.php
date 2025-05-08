<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}

require '../koneksi.php';

// Proses hapus peminjaman jika diminta
if (isset($_GET['hapus'])) {
    $id = (int) $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM peminjaman WHERE PeminjamanID = $id") or die("Gagal hapus: " . mysqli_error($koneksi));
    header('Location: peminjaman_buku.php');
    exit;
}

// Ambil data peminjaman buku
$query = "
    SELECT p.PeminjamanID, u.namalengkap AS UserNama, b.Judul AS BukuJudul, 
           p.TanggalPeminjaman, p.TanggalPengembalian, p.StatusPeminjaman 
    FROM peminjaman p 
    JOIN user u ON p.UserID = u.UserID 
    JOIN buku b ON p.BukuID = b.BukuID
";
$result = mysqli_query($koneksi, $query) or die("Query gagal: " . mysqli_error($koneksi));

// Layout
include '../layout/sidebar-navbar-footbar.php';
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
            <?php if (mysqli_num_rows($result) === 0): ?>
              <tr><td colspan="7" class="text-center">Belum ada data peminjaman.</td></tr>
            <?php else:
              $no = 1;
              while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= htmlspecialchars($row['UserNama']) ?></td>
                  <td><?= htmlspecialchars($row['BukuJudul']) ?></td>
                  <td><?= htmlspecialchars($row['TanggalPeminjaman']) ?></td>
                  <td><?= htmlspecialchars($row['TanggalPengembalian']) ?></td>
                  <td>
                    <span class="badge bg-<?= $row['Status'] == 'Selesai' ? 'success' : 'warning' ?>">
                      <?= htmlspecialchars($row['Status']) ?>
                    </span>
                  </td>
                  <td>
                    <a href="ubah_peminjaman.php?id=<?= $row['PeminjamanID'] ?>" class="btn btn-info btn-sm me-1">Ubah</a>
                    <a href="?hapus=<?= $row['PeminjamanID'] ?>" onclick="return confirm('Yakin ingin menghapus?')" class="btn btn-danger btn-sm me-1">Hapus</a>
                    <a href="cetak_peminjaman.php?id=<?= $row['PeminjamanID'] ?>" class="btn btn-success btn-sm">Cetak</a>
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
