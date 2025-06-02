<?php
session_start();
if (!isset($_SESSION['status'])) {
    header('Location: login.php');
    exit;
}

require 'koneksi.php';
require 'layout/navbar.php';
include 'layout/scrolltop.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tentang Kami | Perpustakaan Digital</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .section {
      background-color: #fff;
      border-radius: 10px;
      padding: 40px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.05);
      margin-bottom: 30px;
    }
    .section h3, .section h4 {
      color: #0d6efd;
      font-weight: 600;
    }
    .section p, .section li {
      text-align: justify;
      line-height: 1.7;
    }
    ul {
      padding-left: 20px;
    }
  </style>
</head>
<body>

<div class="container my-5">
  <h2 class="text-center fw-bold mb-4">Tentang Perpustakaan Digital</h2>

  <div class="section">
    <p>
      Pengguna dapat mengakses koleksi perpustakaan digital kapan saja dan dari mana saja selama terhubung ke internet.
      Hal ini sangat menguntungkan bagi mereka yang berada di lokasi terpencil atau memiliki keterbatasan waktu.
      Perpustakaan digital dapat menyimpan sejumlah besar informasi dalam ruang penyimpanan elektronik yang lebih efisien
      dan dengan biaya pemeliharaan yang lebih rendah dibandingkan dengan perpustakaan fisik.
    </p>
    <p>
      <strong>Pencarian Informasi yang Cepat dan Efisien:</strong> Dengan adanya sistem pencarian digital, pengguna dapat dengan
      mudah mencari informasi menggunakan kata kunci atau metadata, yang mempercepat proses pencarian dibandingkan dengan
      mencari manual di perpustakaan fisik.
    </p>
  </div>

  <div class="section">
    <h3>Tentang Kami</h3>
    <p>
      Selamat datang di <strong>PERPUSTAKAAN DIGITAL</strong>, platform perpustakaan digital yang didedikasikan untuk menyediakan
      akses informasi berkualitas bagi masyarakat luas. Kami percaya bahwa literasi digital adalah kunci untuk membuka
      potensi tak terbatas dalam dunia pendidikan dan pengetahuan.
    </p>

    <h4>Visi Kami</h4>
    <p>
      Menjadi pusat informasi dan literasi digital yang menyediakan akses informasi berkualitas bagi masyarakat luas
      untuk mendukung pembelajaran sepanjang hayat.
    </p>

    <h4>Misi Kami</h4>
    <ul>
      <li>Menyediakan koleksi sumber daya digital yang lengkap dan terpercaya.</li>
      <li>Mempermudah akses masyarakat terhadap informasi melalui platform digital yang user-friendly.</li>
      <li>Mengembangkan literasi digital dan budaya baca.</li>
      <li>Mendukung riset, pendidikan, dan pengembangan pengetahuan dengan akses terbuka.</li>
    </ul>

    <h4>Tim Kami</h4>
    <p>
      Kelompok kami terdiri dari 4 orang dengan latar belakang dan keahlian yang beragam, namun memiliki tujuan yang sama.
      Setiap anggota membawa perspektif unik yang memperkaya dinamika kelompok. Bersama-sama, kami berusaha untuk menciptakan
      dampak positif yang nyata.
    </p>
  </div>
</div>

<?php include 'layout/footer.php'; ?>
</body>
</html>
