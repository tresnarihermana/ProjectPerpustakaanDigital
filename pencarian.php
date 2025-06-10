<?php
session_start();
if (!isset($_SESSION['status'])) {
    header("location: login.php");
    exit;
}
require 'koneksi.php';
require 'layout/navbar.php';
$limit = 20; // misal 20 buku per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
$offset = ($page - 1) * $limit;
$keyword = isset($_GET['keyword']) ? mysqli_real_escape_string($koneksi, $_GET['keyword']) : '';
// Hitung total buku
$result_total = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM buku WHERE Judul LIKE '%$keyword%' 
        OR Penulis LIKE '%$keyword%' 
        OR Penerbit LIKE '%$keyword%'
        OR TahunTerbit LIKE '%$keyword%'");
$row_total = mysqli_fetch_assoc($result_total);
$total_data = $row_total['total'];
$total_pages = ceil($total_data / $limit);
$result = [];

// Jika ada pencarian
if ($keyword !== '') {
    $query = mysqli_query($koneksi, "SELECT * FROM buku 
        WHERE Judul LIKE '%$keyword%' 
        OR Penulis LIKE '%$keyword%' 
        OR Penerbit LIKE '%$keyword%'
        OR TahunTerbit LIKE '%$keyword%'
        LIMIT $limit OFFSET $offset");
} else {
    // Jika keyword kosong, ambil semua buku
    $query = mysqli_query($koneksi, "SELECT * FROM buku LIMIT $limit OFFSET $offset");
}

// Proses hasil query
if ($query && mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
        $result[] = $row;
    }
}
// echo "Keyword: '$keyword'<br>";
?>

<style>
.ratio {
  aspect-ratio: 2/3;
}
.card:hover {
  cursor: pointer;
}
.breadcrumb {
  font-size : 1.2rem;
}
.breadcrumb-item a{
  color :rgb(0, 136, 255);
  text-decoration: none;
}
</style>

<div class="mx-5 mt-4">
  <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Books</li>
  </ol>
</nav>

    <?php if (count($result) > 0): ?>
      <?php if ($_GET['keyword'] == ''): ?>
      <div class="nav">Menampilkan Seluruh Buku</div>
      <?php else: ?>
      <div class="nav">Menampilkan hasil pencarian <strong>"<?php echo htmlspecialchars($keyword); ?>"</strong></div>
      <?php endif; ?>
      <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 g-4 mt-2">
        <?php foreach ($result as $row): ?>
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
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <div class="alert alert-warning mt-3">Buku tidak ditemukan.</div>
    <?php endif; ?>
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
        <li class="page-item"><a class="page-link" href="?page=<?= $page-1 ?>&keyword=<?= htmlspecialchars($_GET['keyword']); ?>">Previous</a></li>
      <?php endif; ?>

      <?php for($i=$start_page; $i <= $end_page; $i++): ?>
        <?php if($i == $page): ?>
          <li class="page-item active" aria-current="page">
            <span class="page-link"><?= $i ?></span>
          </li>
        <?php else: ?>
          <li class="page-item"><a class="page-link" href="?page=<?= $i ?>&keyword=<?= htmlspecialchars($_GET['keyword']); ?>"><?= $i ?></a></li>
        <?php endif; ?>
      <?php endfor; ?>

      <?php if($page < $total_pages): ?>
        <li class="page-item"><a class="page-link" href="?page=<?= $page+1 ?>&keyword=<?= htmlspecialchars($_GET['keyword']); ?>">Next</a></li>
      <?php endif; ?>
    </ul>
  </nav>
</div>
<?php include 'layout/footer.php'; ?>
</body>
</html>
