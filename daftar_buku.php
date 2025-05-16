<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['role'] == 'user') {
    header('Location: ../login.php');
    exit;
}

require 'koneksi.php';
require 'layout/navbar.php';

// Contoh data dummy koleksi buku kategori
$books = array_fill(0, 10, [
    'judul' => 'Judul Buku',
    'deskripsi' => 'Deskripsi singkat buku.',
    'gambar' => 'storage/img/cover-nonfiksi.png'
]);
?>

<style>
@media (min-width: 992px) {
    body { margin-left: 240px; }
}
.card-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 1rem;
}
.card-item {
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 0.75rem;
    text-align: center;
}
.card-item img {
    width: 100%;
    height: 180px;
    object-fit: cover;
    border-radius: 4px;
}
.card-item h6 {
    margin-top: 0.5rem;
    font-weight: 600;
}
</style>

<div class="mx-5 mt-4">
  <a href="javascript:history.back()">&lt; back</a>
  <h2 class="fw-bold mt-3">Koleksi “kategoribuku”</h2>
  
  <div class="card-grid mt-4">
    <?php foreach ($books as $book): ?>
      <div class="card-item">
        <img src="storage/img/cover-nonfiksi.png" alt="cover buku">
        <h6><?= $book['judul']; ?></h6>
        <p class="text-muted" style="font-size: 0.875rem;"><?= $book['deskripsi']; ?></p>
      </div>
    <?php endforeach; ?>
  </div>

  <div class="text-center mt-4">
    <a href="#" class="btn btn-primary">Lihat Lebih Banyak</a>
  </div>
</div>
<?php 
    include 'layout/footer.php';
    ?>
</body>
</html>
