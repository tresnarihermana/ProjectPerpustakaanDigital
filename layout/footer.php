<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Footer</title>
  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
  <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@400;700&display=swap" rel="stylesheet">
  <style>
    footer {
      background-color: #1e1e1e;
      color: white;
      margin-top: 100px;
    }
    .footer-logo {
      height: 60px;
    }
    .footer-icons i {
      font-size: 1.5rem;
      margin-right: 10px;
      color: white;
      transition: color 0.3s;
    }
    .footer-icons i:hover {
      color: #8eaeff;
    }
    .footer-section h6 {
      font-weight: bold;
      margin-bottom: 1rem;
    }
    .footer-section ul {
      list-style: none;
      padding: 0;
    }
    .footer-section ul li {
      margin-bottom: 0.5rem;
    }
    .footer-section ul li a {
      color: #9ea1a1;
      text-decoration: none;
      transition: color 0.3s;
    }
    .footer-section ul li a:hover {
      color: #8eaeff;
    }
    .libre-baskerville-regular {
      font-family: "Libre Baskerville", serif;
      font-weight: 400;
    }
  </style>
</head>
<body>
  <footer class="py-5">
    <div class="container">
      <div class="row">
        <!-- Logo dan Sosial Media -->
        <div class="col-md-3 mb-4">
          <div class="d-flex align-items-center mb-3" style="cursor: pointer;" onclick="window.location.href='#'">
            <img src="storage/img/logo.svg" alt="Perpustakaan Digital" class="footer-logo me-2">
            <div class="libre-baskerville-regular">
              <h5 class="mb-0">Perpustakaan</h5>
              <h5 class="mb-0">Digital</h5>
            </div>
          </div>
          <div class="footer-icons mt-3">
            <i class="bi bi-twitter-x"></i>
            <i class="bi bi-instagram"></i>
            <i class="bi bi-youtube"></i>
            <i class="bi bi-linkedin"></i>
          </div>
        </div>

        <!-- Informasi -->
        <div class="col-md-3 footer-section mb-4">
          <h6>Tentang</h6>
          <ul>
            <li><a href="about-us.php">Tentang Kami</a></li>
            <li><a href="#">Fitur</a></li>
            <li><a href="#">Testimoni</a></li>
            <li><a href="#">Kebijakan Privasi</a></li>
          </ul>
        </div>

        <!-- Layanan -->
        <div class="col-md-3 footer-section mb-4">
          <h6>Layanan</h6>
          <ul>
            <li><a href="daftar-peminjaman.php">Riwayat Pinjam Buku</a></li>
            <li><a href="daftar-buku.php">Daftar Buku</a></li>
            <li><a href="koleksi-pribadi.php">Koleksi Pribadi</a></li>
            <li><a href="daftar-kategori.php">Daftar Kategori</a></li>
          </ul>
        </div>

        <!-- Bantuan -->
        <div class="col-md-3 footer-section mb-4">
          <h6>Bantuan</h6>
          <ul>
            <li><a href="FAQ.php">FAQ</a></li>
            <li><a href="contact-us.php">Hubungi Kami</a></li>
            <li><a href="syarat-dan-ketentuan.php">Syarat & Ketentuan</a></li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
</body>
</html>
