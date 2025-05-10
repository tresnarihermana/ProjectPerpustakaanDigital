<?php
session_start();
if (!isset($_SESSION['status'])) {
    header('Location: ../login.php');
    exit;
}

require 'koneksi.php';

// Konfigurasi
$kategori = isset($_GET['kategori']) ? $_GET['kategori'] : 'kategoribuku';
$limit = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Query buku
if ($kategori == 'kategoribuku') {
    $query = "SELECT * FROM buku LIMIT $start, $limit";
    $countQuery = "SELECT COUNT(*) FROM buku";
} else {
    $query = "SELECT * FROM buku WHERE kategori = '$kategori' LIMIT $start, $limit";
    $countQuery = "SELECT COUNT(*) FROM buku WHERE kategori = '$kategori'";
}

$result = mysqli_query($koneksi, $query);
$totalBooks = mysqli_fetch_row(mysqli_query($koneksi, $countQuery))[0];
$nextPage = $page + 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Perpustakaan Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-search {
            background-color: #1e1e1e;
            padding: 10px 20px;
        }
        .navbar-search input {
            background-color: #2c2c2c;
            border: 1px solid #444;
            color: #fff;
        }
        .navbar-menu {
            background-color: #f1f1f1;
        }
        .profile-btn {
            background-color: #a5b4fc;
            border-radius: 20px;
            padding: 5px 15px;
        }
    </style>
</head>
<body>

<!-- Navbar Search Bar -->
<div class="navbar-search d-flex justify-content-between align-items-center">
    <div class="d-flex align-items-center">
        <img src="storage/img/logo.svg" alt="Logo" width="40" class="me-2">
        <span class="text-white fw-bold">Perpustakaan Digital</span>
    </div>
    <form class="d-flex w-50">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-light" type="submit"><i class="bi bi-search"></i></button>
    </form>
    <div>
        <button class="btn profile-btn">Username</button>
    </div>
</div>

<!-- Navbar Menu -->
<nav class="navbar navbar-expand-lg navbar-menu">
    <div class="container justify-content-center">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Books</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Peminjaman</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Koleksi</a></li>
            <li class="nav-item"><a class="nav-link" href="#">About Us</a></li>
        </ul>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Bootstrap icons (untuk ikon search) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</body>
</html>
  <?php if ($totalBooks > $page * $limit): ?>
    <div class="text-center">
      <a href="?kategori=<?= urlencode($kategori); ?>&page=<?= $nextPage; ?>" class="btn btn-primary">Lihat Lebih Banyak</a>
    </div>

    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>