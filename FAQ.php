<?php
session_start();
if (!isset($_SESSION['status'])) {
    header('Location: login.php');
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
<style>
    .accordion-button:not(.collapsed) {
      background-color: #0d6efd;
      color: white;
    }
</style>
<div class="container my-5">
  <h1 class="mb-4 text-center">FAQ (Pertanyaan yang Sering Diajukan)</h1>

  <div class="accordion" id="accordionFAQ">

    <!-- FAQ 1 -->
    <div class="accordion-item">
      <h2 class="accordion-header" id="faqHeadingOne">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseOne">
          Bagaimana cara meminjam buku di Perpustakaan Digital?
        </button>
      </h2>
      <div id="faqCollapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionFAQ">
        <div class="accordion-body">
          Anda dapat meminjam buku dengan login ke akun Anda, memilih buku yang tersedia, lalu klik tombol <strong>"Pinjam Buku"</strong>. Pastikan Anda belum melebihi batas maksimal peminjaman.
        </div>
      </div>
    </div>

    <!-- FAQ 2 -->
    <div class="accordion-item">
      <h2 class="accordion-header" id="faqHeadingTwo">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseTwo">
          Berapa lama durasi peminjaman buku?
        </button>
      </h2>
      <div id="faqCollapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFAQ">
        <div class="accordion-body">
          Durasi peminjaman buku adalah <strong>7 hari</strong> sejak tanggal peminjaman. Tanggal pengembalian akan tertera otomatis pada halaman riwayat peminjaman Anda.
        </div>
      </div>
    </div>

    <!-- FAQ 3 -->
    <div class="accordion-item">
      <h2 class="accordion-header" id="faqHeadingThree">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseThree">
          Bagaimana cara mengembalikan buku?
        </button>
      </h2>
      <div id="faqCollapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFAQ">
        <div class="accordion-body">
          Untuk mengembalikan buku, masuk ke halaman <strong>Riwayat Peminjaman</strong>, lalu klik tombol <strong>"Kembalikan Buku"</strong> pada buku yang ingin Anda kembalikan. Proses akan diselesaikan setelah diverifikasi oleh petugas.
        </div>
      </div>
    </div>

    <!-- FAQ 4 -->
    <div class="accordion-item">
      <h2 class="accordion-header" id="faqHeadingFour">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseFour">
          Apa yang terjadi jika saya terlambat mengembalikan buku?
        </button>
      </h2>
      <div id="faqCollapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionFAQ">
        <div class="accordion-body">
          Jika Anda mengembalikan buku setelah batas waktu yang ditentukan, akun Anda akan mendapatkan peringatan. Pengulangan keterlambatan bisa menyebabkan pembatasan hak akses sementara.
        </div>
      </div>
    </div>

    <!-- FAQ 5 -->
    <div class="accordion-item">
      <h2 class="accordion-header" id="faqHeadingFive">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseFive">
          Apakah saya bisa meminjam lebih dari satu buku?
        </button>
      </h2>
      <div id="faqCollapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionFAQ">
        <div class="accordion-body">
          Ya, setiap pengguna dapat meminjam hingga <strong>3 buku</strong> dalam waktu bersamaan, selama semua buku tersedia dan Anda tidak sedang memiliki buku yang terlambat dikembalikan.
        </div>
      </div>
    </div>

    <!-- FAQ 6 -->
    <div class="accordion-item">
      <h2 class="accordion-header" id="faqHeadingSix">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseSix">
          Bagaimana jika buku yang saya pinjam rusak atau hilang?
        </button>
      </h2>
      <div id="faqCollapseSix" class="accordion-collapse collapse" data-bs-parent="#accordionFAQ">
        <div class="accordion-body">
          Anda bertanggung jawab atas buku yang Anda pinjam. Jika buku rusak atau hilang, Anda wajib menggantinya sesuai dengan ketentuan yang berlaku di Perpustakaan Digital. Hubungi petugas untuk proses lebih lanjut.
        </div>
      </div>
    </div>

  </div>
</div>

<?php include 'layout/footer.php' ?>
</body>
</html>