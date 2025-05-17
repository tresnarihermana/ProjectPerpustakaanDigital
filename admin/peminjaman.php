<?php
require 'config/session.php';

require '../koneksi.php';
include '../layout/sidebar-navbar-footbar.php';
include '../layout/alert.php';

// Filter tanggal
$dari = isset($_GET['tgl_dari']) ? $_GET['tgl_dari'] : '';
$sampai = isset($_GET['tgl_sampai']) ? $_GET['tgl_sampai'] : '';

$where = '';
if ($dari && $sampai) {
    $where = "WHERE peminjaman.TanggalPeminjaman BETWEEN '$dari' AND '$sampai'";
}

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
    $where
    ORDER BY peminjaman.TanggalPeminjaman DESC
") or die("Query gagal: " . mysqli_error($koneksi));
?>

<style>
@media (min-width: 992px) {
    body { margin-left: 240px; }
}
</style>

<div class="mx-5 mt-4">
  <h1 class="mb-3">Laporan Peminjaman Buku</h1>
  <a href="peminjaman-add.php" class="btn btn-success mb-4">+ Tambah</a>

  <!-- Filter Form -->
  <div class="card shadow-sm mb-4">
    <div class="card-header fw-bold">Filter Tanggal</div>
    <div class="card-body">
      <form method="get" action="peminjaman.php">
        <div class="row g-3 align-items-end">
          <div class="col-md-4">
            <label for="tgl_dari" class="form-label">Dari Tanggal</label>
            <input type="date" name="tgl_dari" class="form-control" value="<?= htmlspecialchars($dari) ?>">
          </div>
          <div class="col-md-4">
            <label for="tgl_sampai" class="form-label">Sampai Tanggal</label>
            <input type="date" name="tgl_sampai" class="form-control" value="<?= htmlspecialchars($sampai) ?>">
          </div>
          <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Filter</button>
          </div>
          <?php if ($dari && $sampai): ?>
            <div class="col-md-2">
              <a href="peminjaman.php" class="btn btn-secondary w-100">Reset</a>
            </div>
          <?php endif; ?>
        </div>
      </form>
    </div>
  </div>

  <?php if ($dari && $sampai): ?>
    <div class="alert alert-info">
      Menampilkan data peminjaman dari <strong><?= htmlspecialchars($dari) ?></strong> sampai <strong><?= htmlspecialchars($sampai) ?></strong>.
      <a href="cetak.php?dari=<?= $dari ?>&sampai=<?= $sampai ?>" target="_blank" class="btn btn-sm btn-outline-primary ms-3">
        <i class="fa fa-print"></i> Cetak
      </a>
    </div>
  <?php endif; ?>

  <!-- Tabel Peminjaman -->
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
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php if (mysqli_num_rows($query) === 0): ?>
              <tr><td colspan="7" class="text-center">Tidak ada data.</td></tr>
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
                    <?php
                    $warna = $row['StatusPeminjaman'] == 'dikembalikan' ? 'success' :
                     ($row['StatusPeminjaman'] == 'dipinjam' ? 'warning' : 'danger');
                    ?>
                    <span class="badge bg-<?=$warna?>">
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
