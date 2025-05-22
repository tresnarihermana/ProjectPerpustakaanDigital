<?php
session_start();
if (!isset($_SESSION['status'])) {
    header('Location: login.html');
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
  <title>Hubungi Kami | Perpustakaan Digital</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }

    .contact-box {
      border: 1px solid #e0e0e0;
      border-radius: 15px;
      padding: 30px;
      background-color: #fff;
      box-shadow: 0 6px 18px rgba(0,0,0,0.03);
    }

    .btn-contact {
      background-color: #0066cc;
      color: #fff;
      font-weight: 600;
      border-radius: 10px;
      transition: 0.2s ease-in-out;
    }

    .btn-contact:hover {
      background-color: #004c99;
    }

    .icon-btn {
      margin-right: 8px;
    }
  </style>
</head>
<body>

<div class="container my-5">
  <h2 class="mb-4 fw-bold">Hubungi Kami</h2>

  <div class="row g-4">
    <!-- Live Chat -->
    <div class="col-md-6">
      <div class="contact-box h-100 d-flex flex-column justify-content-between">
        <div>
          <h5 class="fw-semibold">Live Chat</h5>
          <p class="text-muted">Melayani pada pukul 08:00 - 17.00 WIB</p>
        </div>
        <div class="text-end">
          <a href="https://wa.me/6281238664523" target="_blank" class="btn btn-contact">
            <i class="bi bi-whatsapp icon-btn"></i> Chat Sekarang
          </a>
        </div>
      </div>
    </div>

    <!-- Email -->
    <div class="col-md-6">
      <div class="contact-box h-100 d-flex flex-column justify-content-between">
        <div>
          <h5 class="fw-semibold">Email</h5>
          <p class="text-muted">
            Alamat email: <a href="mailto:support@perpustakaan.digital">support@perpustakaan.digital</a><br>
            Melayani pada pukul 08:00 - 17.00 WIB
          </p>
        </div>
        <div class="text-end">
          <a href="mailto:support@perpustakaan.digital" class="btn btn-contact">
            <i class="bi bi-envelope-fill icon-btn"></i> Kirim Email
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'layout/footer.php'; ?>
</body>
</html>
