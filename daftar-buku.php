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

</style>

<div class="mx-5 mt-4">
  <a href="javascript:history.back()">&lt; back</a>
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
