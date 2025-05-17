<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['role'] == 'user') {
    header("location:../login.php");
    exit;
}
require 'koneksi.php';
require 'layout/navbar.php';

$keyword = isset($_GET['keyword']) ? mysqli_real_escape_string($koneksi, $_GET['keyword']) : '';
$result = [];

if ($keyword) {
    $query = mysqli_query($koneksi, "SELECT * FROM buku 
        WHERE Judul LIKE '%$keyword%' 
        OR Penulis LIKE '%$keyword%' 
        OR Penerbit LIKE '%$keyword%'");

    if ($query && mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $result[] = $row;
        }
    }
}
?>

<style>
@media (min-width: 992px) {
    body { margin-left: 240px; }
}
.ratio {
  aspect-ratio: 2/3;
}
.card:hover {
  cursor: pointer;
}
</style>

<div class="mx-5 mt-4">
  <a href="javascript:history.back()">&lt; back</a>

  <?php if ($keyword): ?>
    <?php if (count($result) > 0): ?>
      <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 g-4 mt-2">
        <?php foreach ($result as $row): ?>
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
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <div class="alert alert-warning mt-3">Buku tidak ditemukan.</div>
    <?php endif; ?>
  <?php endif; ?>
</div>

<?php include 'layout/footer.php'; ?>
</body>
</html>
