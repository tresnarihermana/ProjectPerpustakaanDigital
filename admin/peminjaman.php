<?php
require 'config/session.php';
require '../koneksi.php';
include '../layout/sidebar-navbar-footbar.php';
include '../layout/alert.php';

// Filter tanggal
$dari = isset($_GET['tgl_dari']) ? $_GET['tgl_dari'] : '';
$sampai = isset($_GET['tgl_sampai']) ? $_GET['tgl_sampai'] : '';
$rows_per_page = isset($_GET['rows_per_page']) ? (int) $_GET['rows_per_page'] : 10; // Default 10 rows per page
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1; // Default to page 1 if not set

$where = '';
if ($dari && $sampai) {
    $where = "WHERE peminjaman.TanggalPeminjaman BETWEEN '$dari' AND '$sampai'";
}

// Get the total number of rows
$total_query = mysqli_query($koneksi, "
    SELECT COUNT(*) AS total
    FROM peminjaman
    JOIN user ON peminjaman.UserID = user.UserID
    JOIN buku ON peminjaman.BukuID = buku.BukuID
    $where
") or die("Query gagal: " . mysqli_error($koneksi));
$total_rows = mysqli_fetch_assoc($total_query)['total'];
$total_pages = ceil($total_rows / $rows_per_page);

// Calculate the offset for the current page
$offset = ($page - 1) * $rows_per_page;

// Fetch data for the current page
$query = mysqli_query($koneksi, "
    SELECT 
        peminjaman.PeminjamanID,
        user.username AS Username,
        buku.Judul AS Judul,
        peminjaman.TanggalPeminjaman,
        peminjaman.TanggalPengembalian,
        peminjaman.StatusPeminjaman
    FROM peminjaman
    JOIN user ON peminjaman.UserID = user.UserID
    JOIN buku ON peminjaman.BukuID = buku.BukuID
    $where
    ORDER BY peminjaman.TanggalPeminjaman DESC
    LIMIT $rows_per_page OFFSET $offset
") or die("Query gagal: " . mysqli_error($koneksi));
?>

<!-- Pagination and Filter Form -->
    <style>
        @media (min-width: 992px) {
    body { margin-left: 240px; }
}
    </style>

<div class="mx-5 mt-4">
  <h1 class="mb-3">Laporan Peminjaman Buku</h1>
  <a href="peminjaman-add.php" class="btn btn-success mb-4">+ Tambah</a>
  <a href="scan-barcode.php" class="btn btn-primary mb-4"><i class="fa-solid fa-qrcode"></i> Scan barcode</a>

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
    </div>
  <?php endif; ?>


  <!-- Table Display -->
  <div class="card shadow-sm mb-4">
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-bordered mb-0" style="width: 105%;">
          <thead>
            <tr>
              <th>No</th>
              <th>Username</th>
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
              $no = $offset + 1;
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
                    <span class="badge bg-<?=$warna?>"><?= htmlspecialchars($row['StatusPeminjaman']) ?></span>
                  </td>
                  <td>
                    <a href="peminjaman-edit.php?id=<?= $row['PeminjamanID'] ?>" class="btn btn-info btn-sm me-1">Ubah</a>
                    <a href="crud-delete-peminjaman.php?id=<?= $row['PeminjamanID'] ?>" onclick="return confirm('Yakin ingin menghapus?')" class="btn btn-danger btn-sm me-1">Hapus</a>
                    <a href="cetak.php?id=<?= $row['PeminjamanID'] ?>" class="btn btn-success btn-sm me-1"><i class="fa fa-print"></i> Cetak</a>
                  </td>
                </tr>
            <?php endwhile; endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!-- Pagination Controls -->
   <style>
     .pagination-minimal {
            margin: 2rem 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .pagination-minimal .page-link {
            border: none;
            padding: 10px 16px;
            color: #6c757d;
            font-weight: 500;
            transition: all 0.2s ease;
            position: relative;
        }

        .pagination-minimal .page-item.active .page-link {
            background: none;
            color: #007bff;
        }

        .pagination-minimal .page-item.active .page-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: #007bff;
            transition: all 0.2s ease;
        }

        .pagination-minimal .page-link:hover {
            background: none;
            color: #007bff;
            cursor: pointer;
        }

        .pagination-minimal .page-link:focus {
            box-shadow: none;
        }

        .pagination-minimal .page-item .input-number {
            width: 60px;
            height: 36px;
            padding: 0 10px;
            margin: 0 10px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            font-size: 14px;
            text-align: center;
        }

        .pagination-minimal .page-item .btn-go {
            background-color: #007bff;
            color: white;
            border: 1px solid #007bff;
            padding: 7px 16px;
            border-radius: 4px;
            cursor: pointer;
        }

        .pagination-minimal .page-item .btn-go:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .page-link.active {
          color: #007bff;
        }        
        </style>
          <?php
$visible_limit = 5; // Maksimal jumlah halaman yang ditampilkan

// Hitung halaman awal dan akhir yang akan ditampilkan
$start_page = max(1, $page - floor($visible_limit / 2));
$end_page = min($start_page + $visible_limit - 1, $total_pages);

// Jika end_page kurang dari visible_limit dan masih ada halaman sebelumnya
if ($end_page - $start_page + 1 < $visible_limit) {
    $start_page = max(1, $end_page - $visible_limit + 1);
}
?>
  <div class="pagination-minimal">
    <a href="?page=1&rows_per_page=<?= $rows_per_page ?>" class="page-link">First</a>
    <a href="?page=<?= max(1, $page - 1) ?>&rows_per_page=<?= $rows_per_page ?>" class="page-link">Previous</a>

    <?php for ($i = $start_page; $i <= $end_page; $i++): ?>
      <a href="?page=<?= $i ?>&rows_per_page=<?= $rows_per_page ?>" class="page-link <?= ($i == $page) ? 'active' : '' ?>"><?= $i ?></a>
    <?php endfor; ?>

    <a href="?page=<?= min($total_pages, $page + 1) ?>&rows_per_page=<?= $rows_per_page ?>" class="page-link">Next</a>
    <a href="?page=<?= $total_pages ?>&rows_per_page=<?= $rows_per_page ?>" class="page-link">Last</a>
    <form action="" method="get">
      <input type="number" name="rows_per_page" class="form-control form-control-sm" value="<?= $rows_per_page ?>" min="10" max="100">
    </form>
  </div>
</div>
<?php
include '../layout/admin-footer.php';
?>
</body>
</html>
