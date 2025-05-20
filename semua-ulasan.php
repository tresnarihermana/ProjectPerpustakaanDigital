<?php
session_start();
if (!isset($_SESSION['status'])) {
    header("Location: login.php");
    exit;
}

include 'layout/navbar.php';
include 'koneksi.php';

// Ambil semua ulasan beserta nama buku dan user
$query = mysqli_query($koneksi, "
  SELECT ulasanbuku.*, buku.Judul, user.Username
  FROM ulasanbuku
  JOIN buku ON ulasanbuku.BukuID = buku.BukuID
  JOIN user ON ulasanbuku.UserID = user.UserID
  
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Semua Ulasan Buku</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    .star-rating {
      color: #ffc107;
    }
  </style>
</head>
<body>
<div class="container my-5">
  <h2 class="fw-bold mb-4 text-center">Semua Ulasan Buku</h2>

  <?php if (mysqli_num_rows($query) > 0): ?>
    <?php while ($ulasan = mysqli_fetch_assoc($query)): ?>
      <div class="card mb-4 shadow-sm border-0">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center mb-2">
            <h5 class="card-title mb-0"><?= htmlspecialchars($ulasan['Judul']) ?></h5>
            <div class="star-rating">
              <?php
                for ($i = 1; $i <= 5; $i++) {
                  echo $i <= $ulasan['Rating'] ? '<i class="bi bi-star-fill"></i>' : '<i class="bi bi-star"></i>';
                }
              ?>
            </div>
          </div>
          <h6 class="card-subtitle text-muted mb-2">oleh <strong><?= htmlspecialchars($ulasan['Username']) ?></strong></h6>
          <p class="card-text"><?= nl2br(htmlspecialchars($ulasan['Ulasan'])) ?></p>
        </div>
      </div>
    <?php endwhile; ?>
  <?php else: ?>
    <p class="text-muted text-center">Belum ada ulasan yang tersedia.</p>
  <?php endif; ?>
</div>

<?php include 'layout/footer.php'; ?>
</body>
</html>
