<?php
session_start();
if (!isset($_SESSION['status'])) {
    header('Location: ../login.php');
    exit;
}

require 'koneksi.php';
require 'layout/navbar.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Fitur | Perpustakaan Digital</title>
  <style>
    .fitur-card {
      transition: all 0.3s ease;
      border: none;
      border-radius: 16px;
      box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    }
    .fitur-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 30px rgba(0,0,0,0.1);
    }
    .fitur-icon {
      font-size: 2.5rem;
      color: #0d6efd;
    }
    .fitur-title {
      font-weight: 600;
    }
  </style>
</head>
<body>

<div class="container my-5">
  <h2 class="text-center mb-4 fw-bold">Fitur Unggulan Kami</h2>

  <div class="row g-4">

    <!-- Fitur 1 -->
    <div class="col-md-4">
      <div class="card p-4 text-center fitur-card">
        <div class="fitur-icon mb-3">📚</div>
        <h5 class="fitur-title">Koleksi Buku </h5>
        <p>pinjam ribuan judul buku nik dari berbagai kategori dan genre, tersedia kapan saja dan di mana saja.</p>
      </div>
    </div>

    <!-- Fitur 2 -->
    <div class="col-md-4">
      <div class="card p-4 text-center fitur-card">
        <div class="fitur-icon mb-3">🔍</div>
        <h5 class="fitur-title">Pencarian Cerdas</h5>
        <p>Temukan buku dengan cepat menggunakan kata kunci, filter kategori, atau metadata yang relevan.</p>
      </div>
    </div>

    <!-- Fitur 3 -->
    <div class="col-md-4">
      <div class="card p-4 text-center fitur-card">
        <div class="fitur-icon mb-3">📝</div>
        <h5 class="fitur-title">Ulasan & Rating</h5>
        <p>Berikan ulasan dan nilai buku yang telah Anda baca untuk membantu pengguna lain memilih bacaan terbaik.</p>
      </div>
    </div>

    <!-- Fitur 4 -->
    <div class="col-md-4">
      <div class="card p-4 text-center fitur-card">
        <div class="fitur-icon mb-3">📥</div>
        <h5 class="fitur-title">Peminjaman Digital</h5>
        <p>Pinjam buku digital langsung dari platform dan baca di perangkat Anda tanpa harus datang ke perpustakaan.</p>
      </div>
    </div>

    <!-- Fitur 5 -->
    <div class="col-md-4">
      <div class="card p-4 text-center fitur-card">
        <div class="fitur-icon mb-3">👥</div>
        <h5 class="fitur-title">Akun Pribadi</h5>
        <p>Kelola daftar bacaan, riwayat peminjaman, dan rekomendasi pribadi sesuai preferensi Anda.</p>
      </div>
    </div>

    <!-- Fitur 6 -->
    <div class="col-md-4">
      <div class="card p-4 text-center fitur-card">
        <div class="fitur-icon mb-3">⚙️</div>
        <h5 class="fitur-title">kelola buku dengan mudah</h5>
        <p>Kelola koleksi buku digital Anda dengan praktis unggah, edit, dan hapus hanya dalam beberapa klik.</p>
      </div>
    </div>

  </div>
</div>

<?php include 'layout/footer.php'; ?>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> -->
</body>
</html>
