<?php
session_start();
if (!isset($_SESSION['status'])) {
    header('Location: login.php');
    exit;
}

require 'koneksi.php';
require 'layout/navbar.php';

$books = mysqli_query($koneksi, "SELECT * FROM buku");
?>

<style>

.ratio {
  aspect-ratio: 2/3;
}
.card:hover{
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
  <h2 class="fw-bold mt-3">Koleksi Buku</h2>

  <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 g-4 mt-3">
  <?php while ($row = mysqli_fetch_assoc($books)): ?>
    <?php
      $image = !empty($row['imagecover']) && file_exists('storage/upload/' . $row['imagecover']) 
          ? 'storage/upload/' . htmlspecialchars($row['imagecover']) 
          : 'storage/img/default-cover.png';
    ?>
    <div class="col">
      <a href="detail-buku.php?id=<?= $row['BukuID'] ?>">
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
</div>

<?php include 'layout/footer.php'; ?>
</body>
</html>
