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
  <title>Syarat dan Ketentuan | Perpustakaan Digital</title>
<body>
  <div class="container my-5">
    <h1 class="mb-4 text-center">Syarat dan Ketentuan Perpustakaan Digital</h1>
    <div class="accordion" id="accordionSyarat">

      <!-- Layanan Perpustakaan Digital -->
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
            Layanan Perpustakaan Digital
          </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionSyarat">
          <div class="accordion-body">
            Perpustakaan Digital merupakan penyedia layanan ("Layanan"), yang mengizinkan Anda untuk mengakses, membeli, berlangganan, atau menyewa lisensi konten digital seperti majalah digital, buku digital, koran digital, dan publikasi lainnya, untuk penggunaan konsumen akhir saja berdasarkan syarat dan ketentuan yang diatur dalam perjanjian ini.
          </div>
        </div>
      </div>

      <!-- Persyaratan Penggunaan -->
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingTwo">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
            Persyaratan Penggunaan Layanan
          </button>
        </h2>
        <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionSyarat">
          <div class="accordion-body">
            Hanya orang berusia 17 tahun atau lebih yang bisa membuat akun. Anak di bawah usia tersebut harus didampingi orang tua/wali. Penggunaan Layanan membutuhkan perangkat dan akses internet yang sesuai. Anda bertanggung jawab untuk memastikan semua persyaratan teknis terpenuhi agar dapat mengakses layanan secara optimal.
          </div>
        </div>
      </div>

      <!-- Akun Anda -->
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingThree">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
            Akun Anda
          </button>
        </h2>
        <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionSyarat">
          <div class="accordion-body">
            Anda bertanggung jawab penuh atas keamanan akun Anda. Jangan bagikan informasi login dengan siapa pun. Untuk mengakses konten, Anda harus login dengan akun Perpustakaan Digital. Login sebagai Tamu hanya memberikan akses terbatas. Semua informasi pendaftaran harus akurat dan diperbarui secara berkala.
          </div>
        </div>
      </div>

      <!-- Pengiriman dan Pengunduhan -->
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingFour">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour">
            Pengiriman dan Pengunduhan Pembelian Sebelumnya
          </button>
        </h2>
        <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionSyarat">
          <div class="accordion-body">
            Konten yang dibeli dapat diunduh ke perangkat yang telah terhubung. Beberapa konten mungkin berukuran besar dan memerlukan koneksi internet stabil. Perangkat hanya bisa dikaitkan dengan satu akun, dan pengunduhan bisa dilakukan otomatis atau manual tergantung jenis perangkat.
          </div>
        </div>
      </div>

      <!-- Berlangganan dan Pembaruan Otomatis -->
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingFive">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive">
            Berlangganan dan Pembaruan Otomatis
          </button>
        </h2>
        <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionSyarat">
          <div class="accordion-body">
            Layanan menyediakan konten berbasis langganan tanpa pengembalian dana. Data pengguna dapat diberikan kepada penerbit untuk keperluan pemasaran sesuai dengan kebijakan privasi masing-masing penerbit. Kami menyarankan Anda membaca kebijakan tersebut sebelum menyetujui pembagian data pribadi.
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
