<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['role'] == 'user') {
    header('Location: ../login.php');
    exit;
}

require 'koneksi.php';
require 'layout/navbar.php';

// Contoh data koleksi (bisa diganti dengan hasil query dari database)
$koleksi = [
    ['judul' => 'title', 'gambar' => 'kue-roti.jpg'],
    ['judul' => 'title', 'gambar' => 'kue-roti.jpg'],
    ['judul' => 'title', 'gambar' => 'kue-roti.jpg']
];
?>

<style>
@media (min-width: 992px) { body { margin-left: 180px; } }
</style>

<div class="mx-5 mt-4">
  <h2 class="mb-3 fw-bold">Koleksi Pribadi</h2>
  <p><?= $_SESSION['username']; ?></p>

  <?php foreach ($koleksi as $item): ?>
  <div class="card mb-3 shadow-sm">
    <div class="row g-0">
      <div class="col-md-2 d-flex align-items-center justify-content-center">
        <img src="storage/img/cover-kreativitas.png" class="img-fluid p-3" alt="Cover Buku" style="max-height: 200px;">
      </div>
      <div class="col-md-10">
        <div class="card-body">
          <h5 class="card-title"><?= $item['judul']; ?></h5>
          <p class="card-text">Body text for whatever you'd like to say. Add main takeaway points, quotes, anecdotes, or even a very very short story.</p>
          <a href="#" class="btn btn-primary btn-sm me-2">Kunjungi Halaman</a>
          <a href="#" class="btn btn-warning btn-sm">Beri Ulasan</a>
        </div>
      </div>
    </div>
  </div>
  <?php endforeach; ?>

  <div class="text-center mt-4">
    <a href="#" class="btn btn-primary">Lihat Lebih Banyak</a>
  </div>
</div>

<?php
    include 'layout/footer.php';
    ?>
</body>
</html>