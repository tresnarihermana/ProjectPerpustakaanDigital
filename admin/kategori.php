<?php
require 'config/session.php';
require '../koneksi.php';


// Ambil data kategori
$rows_per_page = isset($_GET['rows_per_page']) ? (int) $_GET['rows_per_page'] : 10;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $rows_per_page;
$order = isset($_GET['order']) ? $_GET['order'] : 'KategoriID ASC';
$result = mysqli_query(
    $koneksi,
    "SELECT KategoriID, Namakategori FROM kategoribuku ORDER BY $order LIMIT $rows_per_page OFFSET $offset"
) or die("Query gagal: " . mysqli_error($koneksi));
$total_query = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM kategoribuku") or die("Query gagal: " . mysqli_error($koneksi));
$total_rows = mysqli_fetch_assoc($total_query)['total'];
$total_pages = ceil($total_rows / $rows_per_page);
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
   <div class="d-flex">
  <a href="kategori-add.php" class="btn btn-success mb-4">+ Tambah Data</a>
  <div class="dropdown btn-sm ms-3">
  <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    Sortir berdasarkan
  </button>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="?order=KategoriID DESC&rows_per_page=<?= $rows_per_page ?>">Terbaru</a></li>
    <li><a class="dropdown-item" href="?order=KategoriID ASC&rows_per_page=<?= $rows_per_page ?>">Terlama</a></li>
    <li><a class="dropdown-item" href="?order=Namakategori ASC&rows_per_page=<?= $rows_per_page ?>">Judul (A-Z)</a></li>
    <li><a class="dropdown-item" href="?order=Namakategori DESC&rows_per_page=<?= $rows_per_page ?>">Judul (Z-A)</a></li>
  </ul>
</div>
</div>

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
              $no = $offset + 1;
              while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= htmlspecialchars($row['Namakategori']) ?></td>
                  <td>
                    <a href="kategori-edit.php?id=<?= $row['KategoriID'] ?>"
                       class="btn btn-info btn-sm me-1">Ubah</a>
                       <?php $buttonId = 'hapusbutton_' . $row['KategoriID']; ?>
                    <button type="button" class="btn btn-danger btn-sm" id="<?= $buttonId ?>">Hapus</button>
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script>
                      document.getElementById('<?= $buttonId ?>').addEventListener('click', function() {
                        Swal.fire({
                          title: 'Hapus Kategori?',
                          text: "Kamu yakin ingin menghapus kategori ini?",
                          icon: 'warning',
                          showCancelButton: true,
                          confirmButtonColor: '#d33',
                          cancelButtonColor: '#3085d6',
                          confirmButtonText: 'Hapus',
                          cancelButtonText: 'Batal'
                        }).then((result) => {
                          if (result.isConfirmed) {
                            window.location.href = 'crud-delete-kategori.php?id=<?= $row['KategoriID'] ?>';
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
        </style>
  <div class="pagination-minimal">
    <a href="?page=1&rows_per_page=<?= $rows_per_page ?>&order=<?= $order?>" class="page-link">First</a>
    <a href="?page=<?= max(1, $page - 1) ?>&rows_per_page=<?= $rows_per_page ?>&order=<?= $order?>" class="page-link">Previous</a>

    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
      <a href="?page=<?= $i ?>&rows_per_page=<?= $rows_per_page ?>&order=<?= $order?>" class="page-link"><?= $i ?></a>
    <?php endfor; ?>

    <a href="?page=<?= min($total_pages, $page + 1) ?>&rows_per_page=<?= $rows_per_page ?>&order=<?= $order?>" class="page-link">Next</a>
    <a href="?page=<?= $total_pages ?>&rows_per_page=<?= $rows_per_page ?>&order=<?= $order?>" class="page-link">Last</a>
    <form action="" method="get">
      <input type="number" name="rows_per_page" class="form-control form-control-sm" value="<?= $rows_per_page ?>" min="10" max="100">
    </form>
  </div>
  <!-- akhit pagination -->
</div>
<?php
include '../layout/admin-footer.php';
?>
</body>
</html>
