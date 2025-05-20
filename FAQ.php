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
  <title>FAQ | Perpustakaan Digital</title>
</head>
<body>

<div class="container my-5">
  <h1 class="mb-4 text-center">FAQ (Pertanyaan yang Sering Diajukan)</h1>

  <div class="accordion" id="accordionFAQ">

    <!-- FAQ 1 -->
    <div class="accordion-item">
      <h2 class="accordion-header" id="faqHeadingOne">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseOne">
          Apa itu Perpustakaan Digital?
        </button>
      </h2>
      <div id="faqCollapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionFAQ">
        <div class="accordion-body">
          Perpustakaan Digital adalah layanan yang menyediakan akses ke berbagai konten digital seperti buku, majalah, dan koran yang dapat dibeli, disewa, atau dilanggan oleh pengguna akhir.
        </div>
      </div>
    </div>

    <!-- FAQ 2 -->
    <div class="accordion-item">
      <h2 class="accordion-header" id="faqHeadingTwo">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseTwo">
          Siapa saja yang bisa menggunakan layanan ini?
        </button>
      </h2>
      <div id="faqCollapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFAQ">
        <div class="accordion-body">
          Layanan hanya dapat digunakan oleh individu berusia 17 tahun ke atas. Anak-anak di bawah usia tersebut harus mendapat izin dan pendampingan dari orang tua atau wali.
        </div>
      </div>
    </div>

    <!-- FAQ 3 -->
    <div class="accordion-item">
      <h2 class="accordion-header" id="faqHeadingThree">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseThree">
          Apa yang harus saya lakukan jika lupa kata sandi?
        </button>
      </h2>
      <div id="faqCollapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFAQ">
        <div class="accordion-body">
          Silakan gunakan fitur "Lupa Kata Sandi" pada halaman login untuk mereset kata sandi Anda. Petunjuk pemulihan akan dikirimkan ke email yang terdaftar.
        </div>
      </div>
    </div>

    <!-- FAQ 4 -->
    <div class="accordion-item">
      <h2 class="accordion-header" id="faqHeadingFour">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseFour">
          Apakah saya bisa mengakses konten dari perangkat berbeda?
        </button>
      </h2>
      <div id="faqCollapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionFAQ">
        <div class="accordion-body">
          Setiap akun hanya dapat terhubung ke satu perangkat aktif pada satu waktu. Jika Anda ingin menggunakan perangkat lain, silakan keluar dari perangkat sebelumnya terlebih dahulu.
        </div>
      </div>
    </div>

    <!-- FAQ 5 -->
    <div class="accordion-item">
      <h2 class="accordion-header" id="faqHeadingFive">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseFive">
          Apakah langganan bisa dibatalkan?
        </button>
      </h2>
      <div id="faqCollapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionFAQ">
        <div class="accordion-body">
          Setelah proses pembayaran dilakukan, langganan tidak dapat dibatalkan dan tidak tersedia pengembalian dana. Pastikan untuk membaca detail langganan sebelum melanjutkan pembayaran.
        </div>
      </div>
    </div>

  </div>
</div>

<?php
include 'layout/footer.php'
?>
</body>
</html>
