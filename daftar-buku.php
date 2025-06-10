<?php
session_start();
if (!isset($_SESSION['status'])) {
    header('Location: login.php');
    exit;
}

require 'koneksi.php';
require 'layout/navbar.php';
include 'layout/scrolltop.php';

// Pagination setup
$limit = 20; // misal 20 buku per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
$offset = ($page - 1) * $limit;

// Hitung total buku
$result_total = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM buku");
$row_total = mysqli_fetch_assoc($result_total);
$total_data = $row_total['total'];
$total_pages = ceil($total_data / $limit);
$order = isset($_GET['order']) ? mysqli_real_escape_string($koneksi, $_GET['order']) : 'BukuID DESC';
$ebook = isset($_GET['ebook']) ? mysqli_real_escape_string($koneksi, $_GET['ebook']) : '';
// if(isset($ebook)){
//   $books = mysqli_query($koneksi, "SELECT * FROM buku WHERE ebook != '' ORDER BY $order LIMIT $limit OFFSET $offset");
// }else{
  $books = mysqli_query($koneksi, "SELECT * FROM buku ORDER BY $order LIMIT $limit OFFSET $offset");
// }


// Ambil buku untuk halaman sekarang
?>

<style>
/* Styling breadcrumb (biar tetap bagus) */
.breadcrumb {
  font-size: 1.2rem;
}
.breadcrumb-item a {
  color: rgb(0, 136, 255);
  text-decoration: none;
}
.breadcrumb-item a:hover {
  text-decoration: underline;
}

/* Card styles */
.ratio {
  aspect-ratio: 2/3;
}
.card:hover {
  cursor: pointer;
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
  transform: translateY(-4px);
  transition: all 0.3s ease;
}

/* Pagination Styling */
.pagination {
  justify-content: center;
  margin-top: 2rem;
  gap: 0.5rem;
}

.page-item:not(.active) .page-link {
  color: #007bff;
  border: 1.5px solid #007bff;
  border-radius: 0.375rem;
  padding: 0.5rem 0.85rem;
  transition: background-color 0.25s ease, color 0.25s ease;
}

.page-item:not(.active) .page-link:hover {
  background-color: #007bff;
  color: white;
  text-decoration: none;
}

.page-item.active .page-link {
  background-color: #0056b3;
  border-color: #0056b3;
  color: white;
  font-weight: 600;
  padding: 0.5rem 0.85rem;
  border-radius: 0.375rem;
  cursor: default;
  box-shadow: 0 0 8px rgba(0, 86, 179, 0.6);
}

.page-item.disabled .page-link {
  color: #6c757d;
  cursor: not-allowed;
  background-color: transparent;
  border-color: #dee2e6;
}

/* Responsive adjustment for smaller screens */
@media (max-width: 576px) {
  .pagination {
    flex-wrap: wrap;
    gap: 0.3rem;
  }
  .page-item .page-link {
    padding: 0.35rem 0.65rem;
    font-size: 0.9rem;
  }
}
</style>

<div class="mx-5 mt-4">
  <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Books</li>
    </ol>
  </nav>
  <div class="d-flex flex-row justify-content-between">
    <h2 class="fw-bold mt-3">Koleksi Buku</h2>
    <div class="dropdown btn-sm ms-3">
  <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    Sortir berdasarkan
  </button>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="?order=BukuID DESC">Terbaru</a></li>
    <li><a class="dropdown-item" href="?order=BukuID ASC">Terlama</a></li>
    <li><a class="dropdown-item" href="?order=Judul ASC">Judul (A-Z)</a></li>
    <li><a class="dropdown-item" href="?order=Judul DESC">Judul (Z-A)</a></li>
    <li><a class="dropdown-item" href="daftar-ebook.php">Ebook</a></li>
  </ul>
</div>
  </div>
  
  

  <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 g-4 mt-3">
  <?php while ($row = mysqli_fetch_assoc($books)): ?>
    <?php
      $image = !empty($row['imagecover']) && file_exists('storage/upload/' . $row['imagecover']) 
          ? 'storage/upload/' . htmlspecialchars($row['imagecover']) 
          : 'storage/img/default-cover.png';
    ?>
    <div class="col">
      <a style="text-decoration: none;" href="detail-buku.php?id=<?= $row['BukuID'] ?>">
      <div class="card h-100 shadow-sm border-0">
        <div class="ratio">
          <img src="<?= $image; ?>" class="card-img-top rounded" alt="cover buku" style="object-fit: cover;">
        </div>
        <div class="card-body text-center px-2 py-3">
          <h6 class="card-title mb-1"><?= htmlspecialchars($row['Judul']); ?></h6>
          <p class="text-muted small mb-0"><?= htmlspecialchars($row['Penulis'] ?? ''); ?></p>
        </div>
      </div>
      </a>
    </div>
  <?php endwhile; ?>
  </div>
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
  <!-- Pagination -->
  <nav aria-label="Page navigation example" class="mt-4">
    <ul class="pagination justify-content-center">
      <?php if($page > 1): ?>
        <li class="page-item"><a class="page-link" href="?page=<?= $page-1 ?>&order=<?= $order;?>">Previous</a></li>
      <?php endif; ?>

      <?php for($i=$start_page; $i <= $end_page; $i++): ?>
        <?php if($i == $page): ?>
          <li class="page-item active" aria-current="page">
            <span class="page-link"><?= $i ?></span>
          </li>
        <?php else: ?>
          <li class="page-item"><a class="page-link" href="?page=<?= $i ?>&order=<?= $order;?>"><?= $i ?></a></li>
        <?php endif; ?>
      <?php endfor; ?>

      <?php if($page < $total_pages): ?>
        <li class="page-item"><a class="page-link" href="?page=<?= $page+1 ?>&order=<?= $order;?>">Next</a></li>
      <?php endif; ?>
    </ul>
  </nav>
</div>

<?php include 'layout/footer.php'; ?>
