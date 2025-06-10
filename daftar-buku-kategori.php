<?php
session_start();
if (!isset($_SESSION['status'])) {
    header('Location: login.php');
    exit;
}

require 'koneksi.php';
require 'layout/navbar.php';

// Ambil ID kategori dari URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<h2 class='mx-5 mt-4'>Kategori tidak ditemukan!</h2>";
    exit;
}
// Pagination setup
$limit = 20; // misal 20 buku per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
$offset = ($page - 1) * $limit;

// Hitung total buku
$kategoriID = $_GET['id'];
$result_total = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM Kategoribuku_relasi WHERE KategoriID=$kategoriID");
$row_total = mysqli_fetch_assoc($result_total);
$total_data = $row_total['total'];
$total_pages = ceil($total_data / $limit);
$order = isset($_GET['order']) ? mysqli_real_escape_string($koneksi, $_GET['order']) : 'BukuID DESC';
// Ambil nama kategori untuk ditampilkan di judul
$getNamaKategori = mysqli_query($koneksi, "SELECT Namakategori FROM Kategoribuku WHERE KategoriID = $kategoriID");
$namaKategoriData = mysqli_fetch_assoc($getNamaKategori);
$namaKategori = $namaKategoriData['Namakategori'] ?? 'Kategori Tidak Diketahui';

// Query buku berdasarkan kategori
$result = mysqli_query(
    $koneksi,
    "SELECT Kategoribuku_relasi.*, buku.*, Kategoribuku.* 
    FROM Kategoribuku_relasi 
    JOIN buku ON Kategoribuku_relasi.BukuID = buku.BukuID
    JOIN Kategoribuku ON Kategoribuku_relasi.KategoriID = Kategoribuku.KategoriID
    WHERE Kategoribuku_relasi.KategoriID = $kategoriID
    ORDER BY buku.$order LIMIT $limit OFFSET $offset"
) or die("Query gagal: " . mysqli_error($koneksi));
?>

<style>
.ratio {
  aspect-ratio: 2/3;
}
.card:hover {
  cursor: pointer;
}
</style>

<div class="mx-5 mt-4">
        <style>
        .breadcrumb {
        font-size : 1.2rem;
      }
      .breadcrumb-item a{
        color :rgb(0, 136, 255);
        text-decoration: none;
      }
    </style>
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
    <li class="breadcrumb-item"><a href="daftar-buku.php">Books</a></li>
    <li class="breadcrumb-item active"><?=htmlspecialchars($namaKategoriData['Namakategori'])?></a></li>
  </ol>
</nav>
  <h2 class="fw-bold mt-3 nunito-sans" style="font-size: 3rem;"><?= htmlspecialchars($namaKategori); ?></h2>

  <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 g-4 mt-3">
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
      <?php
        $image = !empty($row['imagecover']) && file_exists('storage/upload/' . $row['imagecover']) 
            ? 'storage/upload/' . htmlspecialchars($row['imagecover']) 
            : 'storage/img/default-cover.jpg';
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

  <!-- Pagination -->
  <nav aria-label="Page navigation example" class="mt-4">
    <ul class="pagination justify-content-center">
      <?php if($page > 1): ?>
        <li class="page-item"><a class="page-link" href="?page=<?= $page-1 ?>&order=<?= $order;?>&id=<?=$kategoriID?>">Previous</a></li>
      <?php endif; ?>

      <?php for($i=1; $i <= $total_pages; $i++): ?>
        <?php if($i == $page): ?>
          <li class="page-item active" aria-current="page">
            <span class="page-link"><?= $i ?></span>
          </li>
        <?php else: ?>
          <li class="page-item"><a class="page-link" href="?page=<?= $i ?>&order=<?= $order;?>&id=<?=$kategoriID?>"><?= $i ?></a></li>
        <?php endif; ?>
      <?php endfor; ?>

      <?php if($page < $total_pages): ?>
        <li class="page-item"><a class="page-link" href="?page=<?= $page+1 ?>&order=<?= $order;?>&id=<?=$kategoriID?>">Next</a></li>
      <?php endif; ?>
    </ul>
  </nav>
</div>

<?php include 'layout/footer.php'; ?>
</body>
</html>
