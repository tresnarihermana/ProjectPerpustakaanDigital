<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['role'] == 'user') {
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
  <title>Kebijakan Privasi | Perpustakaan Digital</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }

    .accordion-button:not(.collapsed) {
      background-color: #0d6efd;
      color: white;
    }

    .privacy-container {
      max-width: 900px;
      margin: 60px auto;
      background: #fff;
      border-radius: 12px;
      padding: 30px;
      box-shadow: 0 8px 24px rgba(0,0,0,0.06);
    }
  </style>
</head>
<body>

<div class="container privacy-container">
  <h1 class="text-center mb-4">Kebijakan Privasi</h1>
  <p class="text-center text-muted mb-4">Diperbarui terakhir: Mei 2025</p>

  <div class="accordion" id="privacyAccordion">

    <!-- Item 1 -->
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingOne">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
          1. Informasi yang Kami Kumpulkan
        </button>
      </h2>
      <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#privacyAccordion">
        <div class="accordion-body">
          Kami dapat mengumpulkan informasi pribadi seperti nama, email, dan aktivitas Anda saat:
          <ul>
            <li>Mendaftar akun</li>
            <li>Melakukan peminjaman atau menyimpan koleksi</li>
            <li>Memberi ulasan atau masukan</li>
          </ul>
        </div>
      </div>
    </div>

    <!-- Item 2 -->
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingTwo">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
          2. Bagaimana Kami Menggunakan Informasi Anda
        </button>
      </h2>
      <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#privacyAccordion">
        <div class="accordion-body">
          Kami menggunakan informasi Anda untuk:
          <ul>
            <li>Mengelola akun dan layanan</li>
            <li>Memberikan akses ke konten dan fitur</li>
            <li>Meningkatkan pengalaman dan personalisasi</li>
          </ul>
        </div>
      </div>
    </div>

    <!-- Item 3 -->
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingThree">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
          3. Keamanan dan Perlindungan Data
        </button>
      </h2>
      <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#privacyAccordion">
        <div class="accordion-body">
          Kami melindungi data Anda dengan teknologi enkripsi, firewall, dan sistem keamanan lainnya untuk mencegah akses tidak sah.
        </div>
      </div>
    </div>

    <!-- Item 4 -->
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingFour">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour">
          4. Hak dan Kendali Pengguna
        </button>
      </h2>
      <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#privacyAccordion">
        <div class="accordion-body">
          Anda dapat:
          <ul>
            <li>Melihat dan memperbarui informasi pribadi</li>
            <li>Meminta penghapusan akun dan data</li>
            <li>Menghubungi tim kami untuk klarifikasi</li>
          </ul>
        </div>
      </div>
    </div>

    <!-- Item 5 -->
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingFive">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive">
          5. Perubahan Kebijakan
        </button>
      </h2>
      <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#privacyAccordion">
        <div class="accordion-body">
          Kebijakan ini dapat diperbarui sewaktu-waktu. Perubahan akan diumumkan melalui halaman ini dengan tanggal pembaruan terbaru.
        </div>
      </div>
    </div>

  </div>

  <div class="text-center mt-5 text-muted">
    Jika ada pertanyaan, hubungi kami di <a href="mailto:support@perpustakaan.digital">support@perpustakaan.digital</a>
  </div>
</div>

<?php include 'layout/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
