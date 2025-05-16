<?php
session_start();
if (!isset($_SESSION['status'])) {
    header("Location: login.php");
    exit;
} else {
    include 'layout/navbar.php';
    include 'koneksi.php';
}
$data = mysqli_query($koneksi, "SELECT * FROM buku WHERE BukuID = '$_GET[id]'");
$buku = mysqli_fetch_assoc($data);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman User</title>
    <style>

    </style>
</head>
<body>
<div class="mx-5 mt-4">
  <h2 class="mb-3 fw-bold">Detail Buku</h2>
  <div class="card shadow-sm mb-4">
    <div class="card-body d-flex">
      <img src="storage/img/cover-kreativitas.png" alt="Cover Buku" class="me-4" style="width: 200px; height: auto;">
      <div>
        <h4 class="fw-bold"><?=htmlspecialchars($buku['Judul'])?></h4>
        <table class="table table-borderless">
          <tr>
            <th>Bahasa</th><td>: bahasa-buku</td>
            <th>Halaman</th><td>: ...pages</td>
          </tr>
          <tr>
            <th>Tahun Rilis</th><td>:<?=htmlspecialchars($buku['TahunTerbit'])?></td>
            <th>Penerbit</th><td>:<?=htmlspecialchars($buku['penerbit'])?></td>
          </tr>
          <tr>
            <th>Penulis</th><td>: nama-penulis</td>
            <th>Kategori</th><td>: kategori-buku</td>
          </tr>
        </table>
        <div class="mt-3">
          <a href="#" class="btn btn-primary me-2">Pinjam</a>
          <a href="#" class="btn btn-success">Simpan ke Koleksi</a>
        </div>
      </div>
    </div>
  </div>

  <div class="card shadow-sm mb-4">
    <div class="card-body">
      <h5 class="fw-bold mb-3">Deskripsi</h5>
      <p>Kreativitas dalam pengolahan kue dan roti melibatkan kemampuan untuk mengembangkan dan menerapkan ide-ide inovatif dalam resep dan teknik pembuatan pastry. Buku ini lebih berfokus pada organisasi dalam dunia pastry, termasuk deskripsi pekerjaan di departemen pastry, serta bahan-bahan pembuat kue yang penting...</p>
    </div>
  </div>

  <div class="card shadow-sm">
    <div class="card-body">
      <h5 class="fw-bold mb-3">Comment Section</h5>
      <!-- Komentar user bisa ditambahkan di sini -->
    </div>
  </div>
</div>

    <?php
    include 'layout/footer.php';
    ?>
</body>
</html>