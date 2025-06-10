<?php
require 'config/session.php';
require '../koneksi.php';



// Ambil data ulasan buku
// $query = "
//     SELECT ub.UlasanID, u.namalengkap AS UserNama, b.Judul AS BukuJudul, ub.Ulasan, ub.Rating 
//     FROM ulasanbuku ub 
//     JOIN user u ON ub.UserID = u.UserID 
//     JOIN buku b ON ub.BukuID = b.BukuID
// ";
$rows_per_page = isset($_GET['rows_per_page']) ? (int) $_GET['rows_per_page'] : 10; // Default 10 rows per page
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1; 
$offset = ($page - 1) * $rows_per_page;
$query = mysqli_query($koneksi, "
    SELECT 
        ulasanbuku.UlasanID,
        user.username AS NamaUser,
        buku.Judul AS JudulBuku,
        ulasanbuku.Ulasan,
        ulasanbuku.Rating
    FROM ulasanbuku
    JOIN user ON ulasanbuku.UserID = user.UserID
    JOIN buku ON ulasanbuku.BukuID = buku.BukuID
    LIMIT $rows_per_page OFFSET $offset
") or die("Query gagal: " . mysqli_error($koneksi));
$total_query = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM ulasanbuku") or die("Query gagal: " . mysqli_error($koneksi));
$total_rows = mysqli_fetch_assoc($total_query)['total'];
$total_pages = ceil($total_rows / $rows_per_page);

// $result = mysqli_query($koneksi, $query) or die("Query gagal: " . mysqli_error($koneksi));

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
  <h1 class="mb-3">Ulasan Buku</h1>
  <!-- <a href="ulasan-add.php" class="btn btn-success mb-4">+ Tambah</a> -->
  <br>

  <div class="card shadow-sm mb-4">
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-bordered mb-0">
          <thead>
            <tr>
              <th style="width:5%">No</th>
              <th>Username</th>
              <th>Judul Buku</th>
              <th>Ulasan</th>
              <th>Rating</th>
              <th style="width:20%">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php if (mysqli_num_rows($query) === 0): ?>
              <tr><td colspan="6" class="text-center">Belum ada ulasan.</td></tr>
            <?php else:
              $no = $offset + 1;
              while ($row = mysqli_fetch_assoc($query)): ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= htmlspecialchars($row['NamaUser']) ?></td>
                  <td><?= htmlspecialchars($row['JudulBuku']) ?></td>
                  <td><?= htmlspecialchars($row['Ulasan']) ?></td>
                  <td><?= htmlspecialchars($row['Rating']) ?></td>
                  <td>
                    <a href="ulasan-edit.php?id=<?= $row['UlasanID'] ?>" class="btn btn-info btn-sm me-1">Ubah</a>
                    <?php $buttonId = 'hapusbutton_' . $row['UlasanID']; ?>
                    <button type="button" class="btn btn-danger btn-sm" id="<?= $buttonId ?>">Hapus</button>
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script>
                      document.getElementById('<?= $buttonId ?>').addEventListener('click', function() {
                        Swal.fire({
                          title: 'Hapus Ulasan?',
                          text: "Kamu yakin ingin menghapus ulasan ini?",
                          icon: 'warning',
                          showCancelButton: true,
                          confirmButtonColor: '#d33',
                          cancelButtonColor: '#3085d6',
                          confirmButtonText: 'Ya, Hapus!',
                          cancelButtonText: 'Batal'
                        }).then((result) => {
                          if (result.isConfirmed) {
                            window.location.href = 'crud-delete-ulasan.php?id=<?= $row['UlasanID'] ?>';
                          }
                        });
                      });
                    </script>
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
        .page-link.active{
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
